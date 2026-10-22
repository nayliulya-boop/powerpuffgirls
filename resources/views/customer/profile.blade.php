<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Profile & Preferences | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="View and update your AzureVoyage customer profile, travel preferences, and account security details.">

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
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(56, 189, 248, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(224, 242, 254, 0.4) 0px, transparent 50%);
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top VIP Notification Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-400 text-slate-900 shadow-sm">
                    ★ {{ $stats['vipTier'] }}
                </span>
                <span class="text-slate-200">
                    Customer Profile: <strong class="text-white">{{ $user->name }}</strong>
                </span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-200">
                <span>Passport ID: <strong class="text-white">AV-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</strong></span>
                <span>24/7 VIP Concierge: <strong>+1 (800) 429-8732</strong></span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
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
                            Customer Portal
                        </span>
                    </div>
                </a>

                <!-- Navigation Links & User Menu -->
                <div class="flex items-center gap-3 sm:gap-6">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                        <a href="{{ route('customer.dashboard') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('customer') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            VIP Club Hub
                        </a>
                        <a href="{{ route('customer.profile') }}" class="text-sky-600 font-bold flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            My Profile
                        </a>
                    </nav>

                    <!-- User Profile & Sign Out -->
                    <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-700 text-white font-extrabold flex items-center justify-center text-sm shadow-md shadow-sky-500/20">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <span class="text-sm font-bold text-slate-900 block leading-tight">{{ $user->name }}</span>
                                <span class="text-xs font-semibold text-sky-600 block">Customer Account</span>
                            </div>
                        </div>

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button
                                type="submit"
                                title="Sign Out"
                                class="p-2 sm:px-3 sm:py-2 text-xs font-bold text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-xl border border-slate-200 hover:border-red-200 transition flex items-center gap-1.5"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span class="hidden sm:inline">Sign Out</span>
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
                <span class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">✓</span>
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

        <!-- Customer Profile Hero Header -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-sky-950 text-white p-6 sm:p-10 shadow-2xl border border-sky-900/50">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-tr from-sky-500 via-blue-600 to-cyan-400 p-1 shadow-xl shadow-sky-500/30">
                        <div class="w-full h-full rounded-[22px] bg-slate-900 flex items-center justify-center text-2xl font-extrabold text-sky-300">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-amber-400 text-slate-950 shadow-sm">
                                ★ {{ $stats['vipTier'] }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-500/20 text-sky-200 border border-sky-400/30">
                                Verified Customer
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                            {{ $user->name }}
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 font-medium">
                            {{ $user->email }} • Passport ID: <strong class="text-white">AV-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</strong>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a
                        href="{{ route('customer.dashboard') }}"
                        class="px-5 py-2.5 rounded-xl font-bold text-sm text-white bg-white/10 hover:bg-white/20 border border-white/20 transition flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Back to Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Customer Loyalty Stats Row -->
            <div class="relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 pt-8 border-t border-white/10 text-center">
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-sky-300 tracking-wider">AzureMiles</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-amber-300 mt-1 block">{{ number_format($stats['loyaltyPoints']) }}</span>
                </div>
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-sky-300 tracking-wider">Total Bookings</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-white mt-1 block">{{ $stats['totalBookings'] }}</span>
                </div>
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-sky-300 tracking-wider">Upcoming Trips</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-emerald-400 mt-1 block">{{ $stats['upcomingCount'] }}</span>
                </div>
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                    <span class="block text-xs uppercase font-bold text-sky-300 tracking-wider">Lifetime Spend</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-white mt-1 block">${{ number_format($stats['totalSpend'], 2) }}</span>
                </div>
            </div>
        </section>

        <!-- Profile Edit Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Info Card -->
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold">
                            ✈️
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">Customer Sanctuary</h3>
                            <p class="text-xs font-semibold text-slate-500">Your bespoke VIP details</p>
                        </div>
                    </div>

                    <div class="space-y-4 text-sm font-medium text-slate-600">
                        <div class="p-4 rounded-2xl bg-sky-50/60 border border-sky-100">
                            <span class="block text-xs font-extrabold uppercase text-sky-700 mb-1">Database Sync</span>
                            <p class="text-xs text-slate-600">
                                When you update your profile details or password here, your changes are immediately saved to the database and synchronized with your AzureVoyage login credentials.
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2">
                            <span class="block text-xs font-extrabold uppercase text-slate-700">VIP Membership Perks</span>
                            <ul class="text-xs space-y-1 text-slate-600">
                                <li>• Complimentary private airport transfers</li>
                                <li>• Priority concierge reservations</li>
                                <li>• Overwater villa upgrades upon availability</li>
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
                            Edit Customer Profile
                        </h2>
                        <p class="text-sm font-semibold text-slate-500 mt-1">
                            Manage your personal contact details, travel preferences, and login password.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('customer.profile.update') }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Section: Personal Information -->
                        <div>
                            <h3 class="text-sm font-extrabold uppercase tracking-wider text-sky-700 mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-sky-600"></span>
                                Personal Details
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Full Name <span class="text-rose-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                    >
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Email Address <span class="text-rose-500">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                    >
                                    <span class="text-[11px] font-semibold text-slate-400 mt-1 block">Used for sign in and booking confirmations.</span>
                                </div>

                                <div>
                                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Phone Number
                                    </label>
                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="+1 (555) 234-5678"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                    >
                                </div>

                                <div>
                                    <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Home / Billing Address
                                    </label>
                                    <input
                                        type="text"
                                        id="address"
                                        name="address"
                                        value="{{ old('address', $user->address) }}"
                                        placeholder="Beverly Hills, CA"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Section: Travel Preferences -->
                        <div>
                            <h3 class="text-sm font-extrabold uppercase tracking-wider text-sky-700 mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-sky-600"></span>
                                Travel Preferences & Notes
                            </h3>

                            <div>
                                <label for="bio" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Travel Preferences / Special Requests
                                </label>
                                <textarea
                                    id="bio"
                                    name="bio"
                                    rows="3"
                                    placeholder="e.g. Prefers overwater villas, king suite, high floor, sparkling water on arrival, gluten-free dining."
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                >{{ old('bio', $user->bio) }}</textarea>
                                <span class="text-[11px] font-semibold text-slate-400 mt-1 block">Shared with your private concierge for all future vacation bookings.</span>
                            </div>
                        </div>

                        <!-- Section: Security & Password Update -->
                        <div class="pt-6 border-t border-slate-100">
                            <h3 class="text-sm font-extrabold uppercase tracking-wider text-sky-700 mb-2 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Change Password (Optional)
                            </h3>
                            <p class="text-xs font-semibold text-slate-500 mb-4">
                                Leave blank if you do not wish to update your login password.
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
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
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
                                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
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
                                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
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
                                class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm shadow-lg shadow-sky-600/25 hover:scale-[1.01] active:scale-[0.99] transition flex items-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Save Profile Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-slate-900 text-slate-400 py-8 border-t border-slate-800 text-xs text-center">
        <div class="max-w-7xl mx-auto px-4">
            <p>© {{ date('Y') }} AzureVoyage Luxury Travel Agency. All rights reserved. ATOL & IATA Accredited Member.</p>
        </div>
    </footer>

</body>
</html>

