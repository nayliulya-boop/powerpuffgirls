<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Redirect to the role-specific profile page.
     */
    public function index(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user !== null && $user->isAdmin()) {
            return redirect()->route('admin.profile');
        }

        return redirect()->route('customer.profile');
    }
}
