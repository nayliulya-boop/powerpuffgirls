<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    /**
     * Display the administrator profile view with agency system overview.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        $totalUsers = User::count();
        $totalAdmins = DB::table('login')->where('role', 'admin')->whereNull('deleted_at')->count();
        $totalCustomers = DB::table('login')->where('role', 'customer')->whereNull('deleted_at')->count();
        $totalVacations = Vacation::count();
        $totalRevenue = (float) Vacation::whereIn('status', ['upcoming', 'ongoing', 'completed'])->sum('price');

        $systemStats = [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalCustomers' => $totalCustomers,
            'totalVacations' => $totalVacations,
            'totalRevenue' => $totalRevenue,
        ];

        return view('admin.profile', [
            'user' => $user,
            'systemStats' => $systemStats,
        ]);
    }

    /**
     * Update the administrator profile and credentials.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'department' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($user, $validated): void {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] ?? null;
            $user->department = $validated['department'] ?? null;
            $user->bio = $validated['bio'] ?? null;

            if (! empty($validated['new_password'])) {
                $user->password = Hash::make($validated['new_password']);
            }

            $user->save();

            $loginUpdates = [
                'email' => Str::lower($user->email),
            ];

            if (! empty($validated['new_password'])) {
                $loginUpdates['password'] = Hash::make($validated['new_password']);
            }

            DB::table('login')->updateOrInsert(
                ['user_id' => $user->id],
                array_merge($loginUpdates, [
                    'role' => 'admin',
                    'deleted_at' => null,
                ])
            );
        });

        return redirect()->route('admin.profile')
            ->with('status', '🛡️ Administrator credentials & profile updated successfully in the system database.');
    }
}
