<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator Profile & Security | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="Manage administrator credentials, operational staff information, and system parameters for AzureVoyage.">

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
                radial-gradient(at 0% 0%, rgba(15, 23, 42, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(2, 132, 199, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(241, 245, 249, 0.8) 0px, transparent 50%);
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.9);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-slate-900 selection:text-white">

    <!-- Top Admin Executive Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-400 text-slate-950 shadow-sm whitespace-nowrap">
                    ⚡ Administrator Portal
                </span>
                <span class="text-slate-200">
                    Signed in as Executive Administrator: <strong class="text-white">{{ $user->name }}</strong> ({{ $user->email }})
                </span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-200">
                <span class="flex items-center gap-1.5 whitespace-nowrap">
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

                <!-- Navigation Links & User Menu -->
                <div class="flex items-center gap-3 sm:gap-6">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                        <a href="{{ route('admin.bookings.index') }}" class="hover:text-amber-600 transition flex items-center gap-1.5 font-bold text-amber-700 bg-amber-50 px-3 py-1.5 rounded-xl border border-amber-200">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            {{ __('Bookings') }}
                        </a>
                        <a href="{{ route('admin.profile') }}" class="text-slate-900 font-bold flex items-center gap-1.5 border-b-2 border-slate-900 py-1">
                            <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ __('Admin Profile') }}
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('home') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            {{ __('Home') }}
                        </a>

                    </nav>

                    @include('partials.language-switcher')

                    <!-- User Profile & Sign Out -->
                    <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 font-extrabold flex items-center justify-center text-sm shadow-md">
                                AD
                            </div>
                            <div class="hidden sm:block text-left">
                                <span class="text-sm font-bold text-slate-900 block leading-tight">{{ $user->name }}</span>
                                <span class="text-xs font-semibold text-amber-600 block">Administrator</span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button
                                type="submit"
                                title="{{ __('Sign Out') }}"
                                class="p-2 sm:px-3 sm:py-2 text-xs font-bold text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-xl border border-slate-200 hover:border-red-200 transition flex items-center gap-1.5"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span class="hidden sm:inline">{{ __('Sign Out') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-8">

        <!-- Status Alerts -->
        @if (session('status'))
            <div class="p-4 sm:p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 font-bold text-sm flex items-center gap-3 shadow-sm">
                <span class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">✓</span>
                <p>{{ session('status') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 sm:p-5 rounded-2xl bg-red-50 border border-red-200 text-red-900 text-sm shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-2">
                    <span class="w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">!</span>
                    <span>Please correct the errors below:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 font-semibold text-red-800">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Admin Profile Hero Header -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-sky-950 text-white p-6 sm:p-10 shadow-2xl border border-slate-800">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-tr from-amber-400 via-amber-300 to-yellow-500 p-1 shadow-xl shadow-amber-500/20">
                        <div class="w-full h-full rounded-[22px] bg-slate-950 flex items-center justify-center text-2xl font-extrabold text-amber-400">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-amber-400 text-slate-950 shadow-sm">
                                🛡️ System Administrator
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-500/20 text-sky-200 border border-sky-400/30">
                                Staff Level 1 (Full Access)
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                            {{ $user->name }}
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 font-medium">
                            {{ $user->email }} • Department: <strong class="text-amber-300">{{ $user->department ?? 'Operations & VIP Concierge' }}</strong>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Admin Agency System Overview Row -->
            <div class="relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-8 border-t border-slate-800 text-center">
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-slate-400 tracking-wider">Total Customers</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-sky-300 mt-1 block">{{ $systemStats['totalCustomers'] }}</span>
                </div>
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-slate-400 tracking-wider">Staff Accounts</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-amber-300 mt-1 block">{{ $systemStats['totalAdmins'] }}</span>
                </div>
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-slate-400 tracking-wider">Agency Vacations</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-emerald-400 mt-1 block">{{ $systemStats['totalVacations'] }}</span>
                </div>
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-slate-400 tracking-wider">Booking Volume</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-white mt-1 block">RM {{ number_format($systemStats['totalRevenue'], 2) }}</span>
                </div>
            </div>
        </section>

        <!-- Admin Profile Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Info Card -->
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm border border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 flex items-center justify-center font-bold">
                            🛡️
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">Privileged Access</h3>
                            <p class="text-xs font-semibold text-slate-500">Administrator role authority</p>
                        </div>
                    </div>

                    <div class="space-y-4 text-sm font-medium text-slate-600">
                        <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200">
                            <span class="block text-xs font-extrabold uppercase text-amber-900 mb-1">Staff Security Notice</span>
                            <p class="text-xs text-amber-800 leading-relaxed">
                                Updating your administrator email or password synchronizes both the core <code>users</code> table and the authentication credential table (<code>login</code>).
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <span class="block text-xs font-extrabold uppercase text-slate-800">Administrative Capabilities</span>
                            <ul class="text-xs space-y-1.5 text-slate-600">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Manage customer accounts & itineraries</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Coordinate luxury villa & private jet charters</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Access full database management endpoints</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Edit Form -->
            <div class="lg:col-span-2">
                <div class="glass-card rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200">
                    <div class="mb-8 pb-6 border-b border-slate-100">
                        <h2 class="text-2xl font-extrabold text-slate-900">
                            Edit Administrator Profile
                        </h2>
                        <p class="text-sm font-semibold text-slate-500 mt-1">
                            Modify administrator credentials, official contact channels, and system security keys.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Section: Administrative Information -->
                        <div>
                            <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-900 mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Administrator Information
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Administrator Name <span class="text-rose-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                    >
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Official Staff Email <span class="text-rose-500">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                    >
                                    <span class="text-[11px] font-semibold text-slate-400 mt-1 block">Used for administrator sign-in.</span>
                                </div>

                                <div>
                                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Direct Office Extension / Phone
                                    </label>
                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="+1 (800) 429-8732 ext. 101"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                    >
                                </div>

                                <div>
                                    <label for="department" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Department / Title
                                    </label>
                                    <input
                                        type="text"
                                        id="department"
                                        name="department"
                                        value="{{ old('department', $user->department) }}"
                                        placeholder="Executive Concierge & VIP Operations"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Section: Administrative Responsibilities -->
                        <div>
                            <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-900 mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Staff Responsibilities & Notes
                            </h3>

                            <div>
                                <label for="bio" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Responsibilities & Operational Scope
                                </label>
                                <textarea
                                    id="bio"
                                    name="bio"
                                    rows="3"
                                    placeholder="e.g. Lead administrator overseeing Mediterranean charters, luxury villa partnerships, and client VIP escalation."
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                >{{ old('bio', $user->bio) }}</textarea>
                                <span class="text-[11px] font-semibold text-slate-400 mt-1 block">Internal administrative profile notes.</span>
                            </div>
                        </div>

                        <!-- Section: Security & Password Update -->
                        <div class="pt-6 border-t border-slate-100">
                            <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-900 mb-2 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Administrator Password Update (Optional)
                            </h3>
                            <p class="text-xs font-semibold text-slate-500 mb-4">
                                Leave blank if you do not want to alter your administrative password.
                            </p>

                            <div class="space-y-4 max-w-lg">
                                <div>
                                    <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Current Password
                                    </label>
                                    <input
                                        type="password"
                                        id="current_password"
                                        name="current_password"
                                        autocomplete="current-password"
                                        placeholder="••••••••••••"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                    >
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="new_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                            New Password
                                        </label>
                                        <input
                                            type="password"
                                            id="new_password"
                                            name="new_password"
                                            autocomplete="new-password"
                                            placeholder="Min. 8 characters"
                                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                        >
                                    </div>

                                    <div>
                                        <label for="new_password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                            Confirm New Password
                                        </label>
                                        <input
                                            type="password"
                                            id="new_password_confirmation"
                                            name="new_password_confirmation"
                                            autocomplete="new-password"
                                            placeholder="Repeat new password"
                                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-slate-900 focus:bg-white transition"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                            <a
                                href="{{ route('customer.dashboard') }}"
                                class="px-6 py-3 rounded-xl border border-slate-300 text-sm font-bold text-slate-700 hover:bg-slate-100 transition"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-slate-950 via-slate-900 to-sky-950 hover:from-slate-900 hover:to-slate-800 text-amber-400 font-extrabold text-sm shadow-xl shadow-slate-950/25 hover:scale-[1.01] active:scale-[0.99] transition flex items-center gap-2 border border-amber-400/30"
                            >
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Save Admin Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-slate-950 text-slate-500 py-8 border-t border-slate-900 text-xs text-center">
        <div class="max-w-7xl mx-auto px-4">
            <p>© {{ date('Y') }} AzureVoyage Luxury Travel Agency — Internal Administrator System</p>
        </div>
    </footer>

    @include('partials.logout-toastr')
</body>
</html>

