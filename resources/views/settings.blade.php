<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Settings & Preferences') }} | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="Manage your AzureVoyage portal settings, language preferences, and system localization options.">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(56, 189, 248, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(224, 242, 254, 0.4) 0px, transparent 50%);
        }
        h1, h2, h3, h4 {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white overflow-x-hidden">

    @if ($user && $user->isAdmin())
        <!-- Top Admin Executive Bar -->
        <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40">
            <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
                <div class="flex items-center gap-2.5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-400 text-slate-950 shadow-sm">
                        ⚡ ADMIN COMMAND CENTER
                    </span>
                    <span class="text-slate-200">
                        Signed in as Executive Administrator: <strong class="text-white">{{ $user->name }}</strong> ({{ $user->email }})
                    </span>
                </div>
                <div class="hidden md:flex items-center gap-6 text-xs text-sky-200">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Global Concierge Operations: <strong>Active</strong>
                    </span>
                    <span>Role: <strong class="text-amber-300 uppercase tracking-wider">Administrator</strong></span>
                </div>
            </div>
        </div>

        <!-- Main Navigation Bar -->
        <header class="sticky top-0 z-40 glass-nav shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20 gap-4">
                    <!-- Brand / Logo -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group shrink-0">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-slate-900 via-sky-700 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center whitespace-nowrap">
                                Azure<span class="text-sky-600">Voyage</span>
                            </span>
                            <span class="block text-[10px] uppercase tracking-widest font-bold text-sky-700 -mt-1 whitespace-nowrap">
                                Admin Control Center
                            </span>
                        </div>
                    </a>

                    <!-- Navigation Links & Admin Actions -->
                    <div class="flex items-center gap-3 sm:gap-6">
                        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                            <a href="{{ route('admin.dashboard') }}#bookings-management" class="hover:text-sky-600 transition">{{ __('Bookings') }}</a>
                            <a href="{{ route('admin.dashboard') }}#clients-directory" class="hover:text-sky-600 transition">VIP Clients</a>
                            <a href="{{ route('admin.dashboard') }}#destinations-catalog" class="hover:text-sky-600 transition">{{ __('Destination') }}</a>
                            <a href="{{ route('admin.profile') }}" class="hover:text-sky-600 transition">{{ __('Admin Profile') }}</a>
                            <a href="{{ route('home') }}" class="hover:text-sky-600 transition flex items-center gap-1">
                                <span>{{ __('Home') }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </nav>

                        <div class="h-6 w-px bg-slate-200 hidden md:block"></div>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.dashboard') }}#new-destination-form" class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white text-xs sm:text-sm font-semibold shadow-md shadow-sky-500/20 transition whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Add Destination
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 text-slate-700 text-xs sm:text-sm font-semibold transition shadow-sm whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    {{ __('Sign Out') }}
                                </button>
                            </form>

                            @include('partials.language-switcher')
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @elseif ($user)
        <!-- Top Customer Executive Bar -->
        <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40">
            <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-400 text-slate-900 shadow-sm">
                        ★ VIP TRAVELER
                    </span>
                    <span class="text-slate-200">
                        Welcome to your private traveler sanctuary, <strong class="text-white">{{ $user->name }}</strong>.
                    </span>
                </div>
                <div class="hidden md:flex items-center gap-6 text-xs text-sky-200">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        24/7 Dedicated Concierge Online: <strong>+1 (800) 429-8732</strong>
                    </span>
                    <span>Passport ID: <strong class="text-white">AV-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</strong></span>
                </div>
            </div>
        </div>

        <!-- Main Customer Navigation Bar -->
        <header class="sticky top-0 z-40 glass-nav shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Brand / Logo -->
                    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center whitespace-nowrap">
                                Azure<span class="text-sky-600">Voyage</span>
                            </span>
                            <span class="block text-[10px] uppercase tracking-widest font-bold text-sky-600 -mt-1">
                                Luxury Traveler Portal
                            </span>
                        </div>
                    </a>

                    <!-- Navigation Links & User Menu -->
                    <div class="flex items-center gap-3 sm:gap-6">
                        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                            <a href="{{ route('customer.dashboard') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('profile') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ __('My Profile') }}
                            </a>
                            <a href="{{ route('customer.history') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ __('History') }}
                            </a>
                        </nav>

                        <!-- User Profile & Sign Out -->
                        <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                            <a href="{{ route('profile') }}" title="{{ __('Edit Profile') }}" class="flex items-center gap-2.5 group hover:opacity-90 transition">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-700 text-white font-extrabold flex items-center justify-center text-sm shadow-md shadow-sky-500/20 group-hover:scale-105 transition-transform">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <span class="text-sm font-bold text-slate-900 block leading-tight group-hover:text-sky-600 transition">{{ $user->name }}</span>
                                    <span class="text-xs font-semibold text-sky-600 block">{{ __('Edit Profile') . ' →' }}</span>
                                </div>
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button
                                    type="submit"
                                    title="{{ __('Sign Out') }}"
                                    class="p-2 sm:px-3 sm:py-2 text-xs font-bold text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-xl border border-slate-200 hover:border-red-200 transition flex items-center gap-1.5 whitespace-nowrap"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span class="hidden sm:inline">{{ __('Sign Out') }}</span>
                                </button>
                            </form>

                            @include('partials.language-switcher')
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @else
        <!-- Top Guest Bar -->
        <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2 px-4 shadow-sm border-b border-sky-900/40">
            <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-400 text-slate-900 shadow-sm">
                        ⚙️ {{ __('System Settings') }}
                    </span>
                    <span class="text-slate-200">
                        {{ __('AzureVoyage Global Localization & Preferences Control Desk') }}
                    </span>
                </div>
                <div class="hidden md:flex items-center gap-6 text-xs text-sky-200">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ __('Language Engine') }}: <strong class="text-white">{{ strtoupper(app()->getLocale()) }}</strong>
                    </span>
                    <span>24/7 {{ __('Dedicated Concierge') }}: <strong>+1 (800) 429-8732</strong></span>
                </div>
            </div>
        </div>

        <header class="sticky top-0 z-40 glass-nav shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center whitespace-nowrap">
                                Azure<span class="text-sky-600">Voyage</span>
                            </span>
                            <span class="block text-[10px] uppercase tracking-widest font-bold text-sky-600 -mt-1">
                                Luxury Travel Agency
                            </span>
                        </div>
                    </a>

                    <div class="flex items-center gap-3 sm:gap-6">
                        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                            <a href="{{ route('home') }}" class="hover:text-sky-600 transition">{{ __('Home') }}</a>
                            <a href="{{ route('about') }}" class="hover:text-sky-600 transition">{{ __('About') }}</a>
                            <a href="{{ route('login') }}" class="hover:text-sky-600 transition">{{ __('Login') }}</a>
                        </nav>
                        <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                            @include('partials.language-switcher')
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endif

    <!-- Main Container -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 flex-1 w-full space-y-8">

        <!-- Status Notification -->
        @if (session('status'))
            <div class="rounded-2xl p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-semibold flex items-center gap-3 shadow-sm animate-in fade-in duration-200">
                <span class="text-2xl">✨</span>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <!-- Executive Hero Header -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white p-8 sm:p-10 shadow-xl border border-sky-900/50">
            <div class="relative z-10 max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-500/20 border border-sky-400/30 text-sky-300 text-xs font-bold uppercase tracking-widest">
                    <span>⚙️</span>
                    <span>{{ __('System & Account Settings') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    {{ __('Portal Settings & Language') }}
                </h1>
                <p class="text-sky-100/80 text-sm sm:text-base leading-relaxed">
                    {{ __('Choose your preferred language and system options. Selecting a language will immediately convert the entire website, tables, booking forms, and notifications automatically.') }}
                </p>
            </div>
        </section>

        <!-- Language & Localization Settings Section -->
        <section class="glass-card rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200 space-y-6">
            <div class="border-b border-slate-200 pb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl shadow-inner font-black">
                        🌐
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900">
                            {{ __('Language & Localization') }}
                        </h2>
                        <p class="text-xs sm:text-sm font-medium text-slate-500 mt-0.5">
                            {{ __('Choose between English and Bahasa Melayu. All data, titles, status badges, and pages will update automatically.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Language Choice Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">

                <!-- 1. English Option Card -->
                <div class="rounded-2xl p-6 border-2 transition-all duration-300 flex flex-col justify-between {{ $currentLocale === 'en' ? 'border-sky-500 bg-sky-50/50 shadow-md ring-4 ring-sky-500/10' : 'border-slate-200 bg-white hover:border-slate-300 hover:shadow-sm' }}">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-4xl shadow-sm rounded-lg p-1">🇬🇧</span>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900">English</h3>
                                    <span class="text-xs font-semibold text-slate-500">United Kingdom / International</span>
                                </div>
                            </div>
                            @if ($currentLocale === 'en')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-black bg-sky-600 text-white shadow-sm">
                                    ✓ {{ __('Active') }}
                                </span>
                            @endif
                        </div>

                        <p class="text-xs text-slate-600 leading-relaxed">
                            Display all portal menus, luxury client reservation tables, booking details, receipts, and administrator controls in <strong>English</strong>.
                        </p>
                    </div>

                    <div class="pt-6 border-t border-slate-200/80 mt-6">
                        @if ($currentLocale === 'en')
                            <button disabled class="w-full py-3 px-4 rounded-xl font-bold text-xs sm:text-sm bg-sky-600/20 text-sky-800 border border-sky-300 cursor-default flex items-center justify-center gap-2">
                                <span>✓ Current Language (Aktif)</span>
                            </button>
                        @else
                            <a
                                href="{{ route('lang.switch', ['locale' => 'en', 'return_to' => route('settings', ['return_to' => $returnTo ?? ''])]) }}"
                                class="w-full py-3 px-4 rounded-xl font-bold text-xs sm:text-sm bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white shadow-md shadow-sky-500/20 hover:scale-[1.02] active:scale-[0.98] transition flex items-center justify-center gap-2"
                            >
                                <span>🇬🇧 Switch to English</span>
                                <span>→</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- 2. Bahasa Melayu Option Card -->
                <div class="rounded-2xl p-6 border-2 transition-all duration-300 flex flex-col justify-between {{ $currentLocale === 'ms' ? 'border-sky-500 bg-sky-50/50 shadow-md ring-4 ring-sky-500/10' : 'border-slate-200 bg-white hover:border-slate-300 hover:shadow-sm' }}">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-4xl shadow-sm rounded-lg p-1">🇲🇾</span>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900">Bahasa Melayu</h3>
                                    <span class="text-xs font-semibold text-slate-500">Bahasa Rasmi Malaysia</span>
                                </div>
                            </div>
                            @if ($currentLocale === 'ms')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-black bg-sky-600 text-white shadow-sm">
                                    ✓ {{ __('Active') }}
                                </span>
                            @endif
                        </div>

                        <p class="text-xs text-slate-600 leading-relaxed">
                            Papar semua menu portal, jadual tempahan pelanggan mewah, butiran percutian, resit pembayaran rasmi, dan kawalan pentadbir dalam <strong>Bahasa Melayu</strong>.
                        </p>
                    </div>

                    <div class="pt-6 border-t border-slate-200/80 mt-6">
                        @if ($currentLocale === 'ms')
                            <button disabled class="w-full py-3 px-4 rounded-xl font-bold text-xs sm:text-sm bg-sky-600/20 text-sky-800 border border-sky-300 cursor-default flex items-center justify-center gap-2">
                                <span>✓ Bahasa Semasa (Aktif)</span>
                            </button>
                        @else
                            <a
                                href="{{ route('lang.switch', ['locale' => 'ms', 'return_to' => route('settings', ['return_to' => $returnTo ?? ''])]) }}"
                                class="w-full py-3 px-4 rounded-xl font-bold text-xs sm:text-sm bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white shadow-md shadow-sky-500/20 hover:scale-[1.02] active:scale-[0.98] transition flex items-center justify-center gap-2"
                            >
                                <span>🇲🇾 Tukar ke Bahasa Melayu</span>
                                <span>→</span>
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </section>

        <!-- System Information & Security Summary Card -->
        <section class="glass-card rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200">
            <h3 class="text-base font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                <span>🛡️</span>
                <span>{{ __('Portal Specifications & Security') }}</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs font-semibold text-slate-600">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                    <span class="block text-slate-400 text-[10px] uppercase font-bold tracking-wider mb-1">{{ __('Platform Engine') }}</span>
                    <span class="text-slate-900 font-extrabold text-sm">AzureVoyage Enterprise 2026</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                    <span class="block text-slate-400 text-[10px] uppercase font-bold tracking-wider mb-1">{{ __('Active Currency') }}</span>
                    <span class="text-slate-900 font-extrabold text-sm">Ringgit Malaysia (MYR - RM)</span>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                    <span class="block text-slate-400 text-[10px] uppercase font-bold tracking-wider mb-1">{{ __('Live Support') }}</span>
                    <span class="text-emerald-700 font-extrabold text-sm flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        24/7 Dedicated Concierge
                    </span>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-200 flex flex-wrap items-center justify-between gap-4">
                <a
                    href="{{ $returnTo ?? ($user ? ($user->isAdmin() ? route('admin.dashboard') : route('customer.dashboard')) : route('home')) }}"
                    class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-sky-700 hover:text-sky-900 transition"
                >
                    <span>←</span>
                    <span>{{ __('Back to Dashboard') }}</span>
                </a>

                <span class="text-xs text-slate-400 font-medium">
                    {{ __('Preferences are automatically saved to your session and browser.') }}
                </span>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-slate-900 text-slate-400 py-8 border-t border-slate-800 text-xs text-center">
        <div class="max-w-7xl mx-auto px-4">
            <p>© {{ date('Y') }} AzureVoyage Luxury Travel Agency. All rights reserved. ATOL & IATA Accredited Member.</p>
        </div>
    </footer>

    @include('partials.logout-toastr')
</body>
</html>
