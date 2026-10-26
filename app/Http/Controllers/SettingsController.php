<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the settings and language preferences page.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $currentLocale = app()->getLocale();
        $returnTo = $request->input('return_to', url()->previous());

        if (empty($returnTo) || $returnTo === $request->fullUrl() || $returnTo === route('settings')) {
            $returnTo = $user ? ($user->isAdmin() ? route('admin.dashboard') : route('customer.dashboard')) : route('home');
        }

        return view('settings', [
            'user' => $user,
            'currentLocale' => $currentLocale,
            'returnTo' => $returnTo,
        ]);
    }
}
