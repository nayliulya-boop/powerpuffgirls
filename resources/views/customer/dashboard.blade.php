<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Dashboard & Vacations | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="Manage your AzureVoyage luxury vacation bookings, explore itineraries, book bespoke private getaways, and connect with your 24/7 dedicated concierge.">

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

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 glass-nav shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
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
                            Luxury Traveler Portal
                        </span>
                    </div>
                </a>

                <!-- Navigation Links & User Menu -->
                <div class="flex items-center gap-3 sm:gap-6">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                        <a href="{{ route('customer.dashboard') }}" class="transition flex items-center gap-1.5 {{ request()->routeIs('customer.dashboard') ? 'text-sky-600 font-bold' : 'hover:text-sky-600' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('customer.dashboard') ? 'text-sky-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('profile') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ __('My Profile') }}
                        </a>
                        <a href="{{ route('customer.history') }}" class="transition flex items-center gap-1.5 {{ request()->routeIs('customer.history') ? 'text-sky-600 font-bold' : 'hover:text-sky-600' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('customer.history') ? 'text-sky-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('History') }}
                        </a>
                        @if ($user->isAdmin())
                            <a href="{{ route('admin.profile') }}" class="px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-400/20 text-amber-800 border border-amber-300 hover:bg-amber-300 transition flex items-center gap-1">
                                🛡️ {{ __('Admin Portal') }}
                            </a>
                        @endif
                    </nav>

                    <!-- User Profile & Sign Out -->
                    <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                        <a href="{{ route('profile') }}" title="{{ __('Edit Profile') }}" class="flex items-center gap-2.5 group hover:opacity-90 transition">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-700 text-white font-extrabold flex items-center justify-center text-sm shadow-md shadow-sky-500/20 group-hover:scale-105 transition-transform">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <span class="text-sm font-bold text-slate-900 block leading-tight group-hover:text-sky-600 transition">{{ $user->name }}</span>
                                <span class="text-xs font-semibold text-sky-600 block">{{ $user->role === 'admin' ? __('Admin Profile') . ' →' : __('Edit Profile') . ' →' }}</span>
                            </div>
                        </a>

                        <!-- Logout Form -->
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

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-8">

        <!-- Flash Session Alerts -->
        @if (session('success'))
            <div class="p-4 sm:p-5 rounded-2xl bg-emerald-50 border-2 border-emerald-200 text-emerald-900 flex items-start gap-3 shadow-sm animate-fadeIn">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-sm text-emerald-900">Success!</h4>
                    <p class="text-sm font-semibold text-emerald-800 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="p-4 sm:p-5 rounded-2xl bg-sky-50 border-2 border-sky-200 text-sky-900 flex items-start gap-3 shadow-sm animate-fadeIn">
                <div class="w-8 h-8 rounded-xl bg-sky-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-sm text-sky-900">Notice</h4>
                    <p class="text-sm font-semibold text-sky-800 mt-0.5">{{ session('info') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 sm:p-5 rounded-2xl bg-red-50 border-2 border-red-200 text-red-900 flex items-start gap-3 shadow-sm">
                <div class="w-8 h-8 rounded-xl bg-red-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-red-900">Please review your booking details:</h4>
                    <ul class="list-disc list-inside text-sm font-semibold text-red-800 mt-1 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Customer Welcome Hero & VIP Membership Banner -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-sky-950 text-white p-6 sm:p-10 shadow-2xl border border-sky-900/50">
            <!-- Decorative Background Glows -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <!-- Welcome Copy -->
                <div class="max-w-2xl space-y-3">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-widest bg-sky-500/20 text-sky-300 border border-sky-400/30">
                            ✈️ Customer Dashboard
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-widest bg-amber-400/20 text-amber-300 border border-amber-400/30">
                            {{ $stats['vipTier'] }}
                        </span>
                    </div>

                    <!-- Welcome Heading: Includes "Welcome Customer" to maintain full greeting and test compatibility -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Welcome Customer, <span class="bg-gradient-to-r from-sky-400 via-cyan-300 to-white bg-clip-text text-transparent">{{ $user->name }}</span>!
                    </h1>

                    <p class="text-slate-300 text-sm sm:text-base font-medium leading-relaxed">
                        Here is your bespoke travel portal. Manage your upcoming vacations, review past itineraries, and request new luxury escapes with your dedicated private concierge.
       
                    </p>

                    <div class="pt-2 flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-300">
                        <span class="flex items-center gap-1.5 font-semibold">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Verified VIP Traveler
                        </span>
                        <span class="flex items-center gap-1.5 font-semibold">
                            <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Instant Flight & Villa Confirmation
                        </span>
                        <span class="flex items-center gap-1.5 font-semibold">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            {{ number_format($stats['loyaltyPoints']) }} AzureMiles Available
                        </span>
                    </div>
                </div>

                <!-- Action Button: Book New Vacation -->
                <div class="flex flex-col sm:flex-row lg:flex-col gap-3 shrink-0">
                    <button
                        onclick="document.getElementById('bookingModal').classList.remove('hidden')"
                        class="px-6 py-3.5 rounded-2xl font-extrabold text-sm text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-300 hover:from-amber-300 hover:to-yellow-200 shadow-lg shadow-amber-400/25 hover:scale-[1.02] active:scale-[0.98] transition flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Book A New Vacation</span>
                    </button>
                    <a
                        href="#vacationTableSection"
                        class="px-6 py-3.5 rounded-2xl font-bold text-sm text-white bg-white/10 hover:bg-white/15 border border-white/20 transition flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        <span>View My Vacations ({{ $stats['totalBookings'] }})</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Stats Overview Cards Grid -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Vacations -->
            <div class="glass-card rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Bookings</span>
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-slate-900">{{ $stats['totalBookings'] }}</span>
                    <span class="text-xs font-semibold text-slate-500">Escapes</span>
                </div>
                <div class="mt-2 text-xs font-medium text-slate-500 flex items-center gap-1">
                    <span>Curated luxury itineraries</span>
                </div>
            </div>

            <!-- Upcoming Trips -->
            <div class="glass-card rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Upcoming Trips</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-emerald-600">{{ $stats['upcomingCount'] }}</span>
                    <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Confirmed</span>
                </div>
                <div class="mt-2 text-xs font-medium text-slate-500">
                    Next departure: {{ $nextTrip ? \Carbon\Carbon::parse($nextTrip->start_date)->format('M d, Y') : 'None scheduled' }}
                </div>
            </div>

            <!-- Completed Escapes -->
            <div class="glass-card rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Completed Journeys</span>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-slate-900">{{ $stats['completedCount'] }}</span>
                    <span class="text-xs font-semibold text-slate-500">Memories</span>
                </div>
                <div class="mt-2 text-xs font-medium text-slate-500">
                    Total spent: RM {{ number_format($stats['totalSpend'], 2) }}
                </div>
            </div>

            <!-- VIP Reward Points -->
            <div class="glass-card rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">AzureMiles Loyalty</span>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-amber-500">{{ number_format($stats['loyaltyPoints']) }}</span>
                    <span class="text-xs font-semibold text-slate-500">Points</span>
                </div>
                <div class="mt-2 text-xs font-medium text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full inline-block">
                    Redeemable for upgrades
                </div>
            </div>
        </section>

        <!-- Next Journey Spotlight (If upcoming vacation exists and viewing all or upcoming, with no active search) -->
        @if ($nextTrip && in_array($status, ['all', 'upcoming'], true) && empty($search))
            <section class="rounded-3xl overflow-hidden glass-card shadow-md border border-sky-100 grid grid-cols-1 md:grid-cols-12 bg-white">
                <div class="md:col-span-4 h-64 md:h-auto relative overflow-hidden group">
                    <img
                        src="{{ $nextTrip->image_url ?? 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80' }}"
                        alt="{{ $nextTrip->destination }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <span class="inline-block px-2.5 py-0.5 rounded-md text-xs font-extrabold uppercase bg-emerald-500 text-white mb-1">
                            Next Upcoming Journey
                        </span>
                        <h4 class="font-bold text-lg leading-tight">{{ $nextTrip->destination }}</h4>
                    </div>
                </div>
                <div class="md:col-span-8 p-6 sm:p-8 flex flex-col justify-between">
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                                Package: {{ $nextTrip->package_code }}
                            </span>
                            <span class="text-xs font-bold text-slate-500">
                                {{ \Carbon\Carbon::parse($nextTrip->start_date)->diffForHumans() }}
                            </span>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900 leading-snug">
                            {{ $nextTrip->title }}
                        </h3>
                        <p class="text-slate-600 text-sm mt-2 font-medium">
                            {{ $nextTrip->notes ?? 'Your private chauffeur and personal villa concierge are assigned and ready for your arrival.' }}
                        </p>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-6 border-t border-slate-100">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase block">Dates</span>
                                <span class="text-sm font-bold text-slate-800 block mt-0.5">
                                    {{ \Carbon\Carbon::parse($nextTrip->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($nextTrip->end_date)->format('M d, Y') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase block">Travelers</span>
                                <span class="text-sm font-bold text-slate-800 block mt-0.5">
                                    {{ $nextTrip->travelers_count }} Guests
                                </span>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase block">Experience Tier</span>
                                <span class="text-sm font-bold text-amber-600 block mt-0.5">
                                    {{ $nextTrip->tier }}
                                </span>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase block">Price</span>
                                <span class="text-sm font-bold text-slate-900 block mt-0.5">
                                    RM {{ number_format($nextTrip->price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <button
                            onclick="openItineraryModal({{ json_encode($nextTrip) }})"
                            class="px-5 py-2.5 rounded-xl text-xs font-extrabold text-white bg-sky-600 hover:bg-sky-700 shadow-md shadow-sky-600/20 transition flex items-center gap-1.5"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ __('View Comprehensive Itinerary') }}
                        </button>
                        <a
                            href="{{ route('customer.payment.receipt.pdf', ['vacation' => $nextTrip, 'print' => 1]) }}"
                            target="_blank"
                            class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition flex items-center gap-1.5"
                            title="{{ __('Print voucher via TCPDF') }}"
                        >
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            {{ __('Print') }}
                        </a>
                        <a
                            href="{{ route('customer.payment.receipt.pdf', ['vacation' => $nextTrip, 'download' => 1]) }}"
                            class="px-4 py-2.5 rounded-xl text-xs font-bold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition flex items-center gap-1.5"
                            title="{{ __('Download voucher PDF generated via TCPDF') }}"
                        >
                            <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            {{ __('Download') }}
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- VACATION TABLE SECTION (Primary user requirement) -->
        <section id="vacationTableSection" class="space-y-4">
            <!-- Section Header & Filter Toolbar -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-sky-600"></span>
                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                            My Vacations & Travel Bookings Table
                        </h2>
                    </div>
                    <p class="text-sm font-semibold text-slate-500 mt-1">
                        Detailed database records of all your booked, ongoing, and completed luxury voyages.
                    </p>
                </div>

                <!-- Book New Vacation Button (Desktop & Mobile) -->
                <div class="flex items-center gap-2">
                    <button
                        onclick="document.getElementById('bookingModal').classList.remove('hidden')"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-sky-600 hover:bg-sky-700 shadow-md shadow-sky-600/20 hover:scale-[1.02] active:scale-[0.98] transition flex items-center gap-1.5"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>{{ __('New Vacation Booking') }}</span>
                    </button>
                </div>
            </div>

            <!-- Filters & Search Bar Card -->
            <div class="glass-card rounded-2xl p-4 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Status Filter Pills -->
                <div class="flex flex-wrap items-center gap-2 text-xs font-bold">
                    <a
                        href="{{ route('customer.dashboard', ['status' => 'all', 'search' => $search]) }}"
                        class="px-3.5 py-2 rounded-xl transition {{ $status === 'all' ? 'bg-slate-900 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                    >
                        {{ __('All Escapes') }} ({{ $stats['totalBookings'] }})
                    </a>
                    <a
                        href="{{ route('customer.dashboard', ['status' => 'upcoming', 'search' => $search]) }}"
                        class="px-3.5 py-2 rounded-xl transition flex items-center gap-1.5 {{ $status === 'upcoming' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100' }}"
                    >
                        <span class="w-2 h-2 rounded-full {{ $status === 'upcoming' ? 'bg-white' : 'bg-emerald-500' }}"></span>
                        {{ __('Upcoming Escapes') }} ({{ $stats['upcomingCount'] }})
                    </a>
                    <a
                        href="{{ route('customer.dashboard', ['status' => 'completed', 'search' => $search]) }}"
                        class="px-3.5 py-2 rounded-xl transition {{ $status === 'completed' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-indigo-50 text-indigo-800 hover:bg-indigo-100' }}"
                    >
                        {{ __('Completed') }} ({{ $stats['completedCount'] }})
                    </a>
                    <a
                        href="{{ route('customer.dashboard', ['status' => 'cancelled', 'search' => $search]) }}"
                        class="px-3.5 py-2 rounded-xl transition {{ $status === 'cancelled' ? 'bg-rose-600 text-white shadow-sm' : 'bg-rose-50 text-rose-800 hover:bg-rose-100' }}"
                    >
                        {{ __('Cancelled') }} ({{ $stats['cancelledCount'] }})
                    </a>
                </div>

                <!-- Search Input Form -->
                <form method="GET" action="{{ route('customer.dashboard') }}" class="flex items-center gap-2 w-full md:w-auto">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <div class="relative w-full md:w-64">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search destination, code..."
                            class="w-full text-xs font-semibold pl-9 pr-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition"
                        >
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    @if ($search !== '')
                        <a
                            href="{{ route('customer.dashboard', ['status' => $status]) }}"
                            class="px-2.5 py-2 text-xs font-bold text-slate-500 hover:text-slate-800 bg-slate-100 rounded-xl transition"
                            title="Clear search"
                        >
                            ✕
                        </a>
                    @endif
                    <button
                        type="submit"
                        class="px-3.5 py-2 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition"
                    >
                        Search
                    </button>
                </form>
            </div>

            <!-- THE VACATIONS DATA TABLE -->
            <div class="glass-card rounded-3xl overflow-hidden shadow-sm border border-slate-200 bg-white">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-extrabold uppercase tracking-wider text-slate-500">
                                <th class="py-4 px-4 sm:px-6">Destination & Package</th>
                                <th class="py-4 px-4">Travel Dates</th>
                                <th class="py-4 px-4">Guests</th>
                                <th class="py-4 px-4">VIP Tier</th>
                                <th class="py-4 px-4">Price</th>
                                <th class="py-4 px-4">Status</th>
                                <th class="py-4 px-4 text-center sm:pr-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse ($vacations as $vacation)
                                <tr class="hover:bg-sky-50/40 transition duration-150">
                                    <!-- Destination, Title, and Thumbnail -->
                                    <td class="py-4 px-4 sm:px-6">
                                        <div class="flex items-center gap-3.5">
                                            <div class="w-14 h-14 rounded-2xl overflow-hidden shrink-0 border border-slate-200 shadow-sm relative group">
                                                <img
                                                    src="{{ $vacation->image_url ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=400&q=80' }}"
                                                    alt="{{ $vacation->destination }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                                >
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-extrabold text-slate-900 text-sm sm:text-base leading-tight truncate block">
                                                        {{ $vacation->destination }}
                                                    </span>
                                                </div>
                                                <span class="text-xs font-semibold text-slate-600 block truncate max-w-xs mt-0.5">
                                                    {{ $vacation->title }}
                                                </span>
                                                <span class="inline-block text-[10px] font-bold tracking-wider uppercase text-sky-700 bg-sky-50 px-2 py-0.5 rounded-md mt-1 border border-sky-100">
                                                    #{{ $vacation->package_code }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Dates & Duration -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-sky-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            <div>
                                                <span class="font-bold text-slate-800 text-xs block">
                                                    {{ \Carbon\Carbon::parse($vacation->start_date)->format('M d, Y') }}
                                                </span>
                                                <span class="text-[11px] font-semibold text-slate-500 block">
                                                    to {{ \Carbon\Carbon::parse($vacation->end_date)->format('M d, Y') }}
                                                    ({{ max(1, \Carbon\Carbon::parse($vacation->start_date)->diffInDays(\Carbon\Carbon::parse($vacation->end_date))) }} nights)
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Travelers Count -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <div class="flex items-center gap-1.5 text-xs font-bold text-slate-700">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                            <span>{{ $vacation->travelers_count }} {{ Str::plural('Guest', $vacation->travelers_count) }}</span>
                                        </div>
                                    </td>

                                    <!-- VIP Tier -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $vacation->tier === 'Diamond Sovereign' ? 'bg-amber-100 text-amber-800 border border-amber-200' : ($vacation->tier === 'Platinum Horizon' ? 'bg-sky-100 text-sky-800 border border-sky-200' : 'bg-slate-100 text-slate-800 border border-slate-200') }}">
                                            ★ {{ $vacation->tier ?? 'Signature Gold' }}
                                        </span>
                                    </td>

                                    <!-- Price -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="font-extrabold text-slate-900 text-sm block">
                                            RM {{ number_format($vacation->price, 2) }}
                                        </span>
                                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">
                                            All-Inclusive VIP
                                        </span>
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if ($vacation->status === 'completed')
                                            <div class="flex flex-col items-start gap-1">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                                    ✓ {{ __('Completed') }}
                                                </span>
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-sky-700">
                                                    <svg class="w-3 h-3 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                    <span>{{ __('Confirmed & Paid') }}</span>
                                                </span>
                                            </div>
                                        @elseif ($vacation->status === 'cancelled' || $vacation->status === 'rejected')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200">
                                                ✕ {{ __('Cancelled') }}
                                            </span>
                                        @else
                                            <div class="flex flex-col items-start gap-1">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    {{ __('Upcoming Escapes') }}
                                                </span>
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-sky-700">
                                                    <svg class="w-3 h-3 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                    <span>{{ __('Confirmed & Paid') }}</span>
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Action Buttons -->
                                    <td class="py-4 px-4 sm:pr-6 whitespace-nowrap text-right align-middle">
                                        <div class="inline-flex flex-col items-stretch gap-1 w-24 ml-auto">
                                            @if ($vacation->status !== 'cancelled' && $vacation->status !== 'rejected')
                                                <!-- Receipt Link for Upcoming and Completed -->
                                                <a
                                                    href="{{ route('customer.payment.receipt', $vacation) }}"
                                                    class="w-full inline-flex items-center justify-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition"
                                                    title="View official receipt"
                                                >
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                    <span>Receipt</span>
                                                </a>
                                                <!-- Download PDF Voucher via TCPDF -->
                                                <a
                                                    href="{{ route('customer.payment.receipt.pdf', ['vacation' => $vacation, 'download' => 1]) }}"
                                                    class="w-full inline-flex items-center justify-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 transition"
                                                    title="{{ __('Download official PDF generated via TCPDF') }}"
                                                >
                                                    <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                    <span>PDF</span>
                                                </a>
                                            @endif

                                            <!-- View Details Modal Trigger -->
                                            <button
                                                onclick="openItineraryModal({{ json_encode($vacation) }})"
                                                class="w-full inline-flex items-center justify-center px-2.5 py-1 rounded-lg text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition"
                                                title="View itinerary & concierge details"
                                            >
                                                Details
                                            </button>

                                            <!-- Cancel Vacation Booking (Only if upcoming or active) -->
                                            @if ($vacation->status !== 'completed' && $vacation->status !== 'cancelled' && $vacation->status !== 'rejected')
                                                <form
                                                    method="POST"
                                                    action="{{ route('customer.vacations.cancel', $vacation) }}"
                                                    onsubmit="return confirm('Are you sure you wish to cancel this vacation booking ({{ $vacation->destination }})?');"
                                                    class="w-full block"
                                                >
                                                    @csrf
                                                    <button
                                                        type="submit"
                                                        class="w-full inline-flex items-center justify-center px-2.5 py-1 rounded-lg text-xs font-bold text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-transparent hover:border-rose-200 transition"
                                                        title="Cancel this booking"
                                                    >
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 px-6 text-center">
                                        <div class="max-w-md mx-auto space-y-3">
                                            <div class="w-16 h-16 rounded-3xl bg-sky-50 text-sky-600 mx-auto flex items-center justify-center">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <h3 class="text-lg font-bold text-slate-800">No Vacation Bookings Found</h3>
                                            <p class="text-xs text-slate-500">
                                                @if ($search !== '' || $status !== 'all')
                                                    No results match your current filters. Try resetting the search or filter tabs.
                                                @else
                                                    You haven't scheduled any luxury vacation escapes yet. Click the button below to reserve your first journey!
                                                @endif
                                            </p>
                                            <div class="pt-2">
                                                <button
                                                    onclick="document.getElementById('bookingModal').classList.remove('hidden')"
                                                    class="px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-sky-600 hover:bg-sky-700 shadow-md shadow-sky-600/20 transition inline-flex items-center gap-1.5"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                    Reserve A Luxury Vacation Now
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Vacation Table Footer Summary -->
                <div class="bg-slate-50/75 px-6 py-4 border-t border-slate-200 flex flex-wrap items-center justify-between gap-3 text-xs font-semibold text-slate-500">
                    <div>
                        Showing <strong>{{ $vacations->count() }}</strong> of <strong>{{ $stats['totalBookings'] }}</strong> total vacation bookings.
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Instant ATOL/IATA Protection
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-sky-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            24/7 Global Concierge Guarantee
                        </span>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- BOOKING MODAL (Add New Vacation to Database Table) -->
    <div id="bookingModal" class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-sky-100 animate-fadeIn">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-sky-700 via-blue-600 to-sky-800 text-white p-6 sm:p-8 flex items-center justify-between rounded-t-3xl">
                <div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/20 text-white mb-1">
                        ✈️ AzureVoyage Reservation
                    </span>
                    <h3 class="text-2xl font-extrabold text-white">Book A New Luxury Vacation</h3>
                    <p class="text-xs text-sky-100 mt-1">Fill out the details below to add a new bespoke escape to your itinerary table.</p>
                </div>
                <button
                    type="button"
                    onclick="document.getElementById('bookingModal').classList.add('hidden')"
                    class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition"
                >
                    ✕
                </button>
            </div>

            <!-- Modal Form -->
            <form method="POST" action="{{ route('customer.vacations.store') }}" class="p-6 sm:p-8 space-y-5">
                @csrf

                <!-- Destination Selection (Auto-filled from Admin Catalog) -->
                <div class="space-y-3.5">
                    <div>
                        <label for="destinationInput" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            {{ __('Destination') }} *
                        </label>
                        <select
                            id="destinationSelect"
                            name="destination_id"
                            required
                            onchange="onDestinationChange(this)"
                            class="w-full text-sm font-bold p-3.5 rounded-2xl border-2 border-sky-300 focus:outline-none focus:ring-2 focus:ring-sky-500 bg-sky-50/50 text-slate-900 transition cursor-pointer"
                        >
                            @forelse ($destinations ?? [] as $dest)
                                <option
                                    value="{{ $dest->id }}"
                                    data-location="{{ $dest->location }}"
                                    data-title="{{ $dest->title }}"
                                    data-price="{{ $dest->price }}"
                                    data-capacity="{{ $dest->capacity ?? 2 }}"
                                    data-days="{{ $dest->duration_days ?? 4 }}"
                                    data-start="{{ $dest->start_date ? $dest->start_date->format('Y-m-d') : '' }}"
                                    data-end="{{ $dest->end_date ? $dest->end_date->format('Y-m-d') : '' }}"
                                    data-dates-label="{{ $dest->start_date && $dest->end_date ? $dest->start_date->format('d M Y') . ' — ' . $dest->end_date->format('d M Y') : ($dest->duration_days ? $dest->duration_days . ' Days Trip' : 'Open Booking') }}"
                                    data-image="{{ $dest->image_path ? (str_starts_with($dest->image_path, 'http') ? $dest->image_path : asset($dest->image_path)) : 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80' }}"
                                    @selected($loop->first)
                                >
                                    {{ $dest->title }} — {{ $dest->location }} (RM {{ number_format($dest->price, 2) }} / org • Max {{ $dest->capacity ?? 2 }} Pax)
                                </option>
                            @empty
                                <option value="" disabled selected>Tiada destinasi ditemui dalam pangkalan data</option>
                            @endforelse
                        </select>
                    </div>

                    <!-- Clickable Destination Shortcut Badges -->
                    <div>
                        <span class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">
                            Atau Klik Terus Destinasi Pilihan:
                        </span>
                        <div class="flex flex-wrap gap-2 text-xs">
                            @foreach ($destinations ?? [] as $dest)
                                <button
                                    type="button"
                                    data-id="{{ $dest->id }}"
                                    onclick="pickDestinationById({{ $dest->id }})"
                                    class="dest-chip px-3 py-1.5 rounded-xl border border-sky-200 bg-sky-50 text-sky-800 hover:bg-sky-100 transition font-bold flex items-center gap-1.5 shadow-sm cursor-pointer"
                                >
                                    <span>📍</span>
                                    <span>{{ $dest->title }}</span>
                                    <span class="text-[10px] font-extrabold text-sky-700 bg-white px-1.5 py-0.5 rounded-md border border-sky-200">RM {{ number_format($dest->price, 2) }} / org</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Live Destination Preview Card -->
                    <div id="selectedDestinationPreview" class="p-4 rounded-2xl bg-gradient-to-r from-sky-50 via-blue-50/60 to-indigo-50 border border-sky-200 shadow-sm flex items-center gap-4">
                        <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 border border-sky-300 shadow-sm relative group">
                            <img
                                id="previewDestImg"
                                src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80"
                                alt="Preview"
                                class="w-full h-full object-cover group-hover:scale-105 transition"
                            >
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-1.5">
                                <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    ⚡ Ketersediaan Segera Disahkan
                                </span>
                                <span id="previewDestDays" class="text-[11px] font-bold text-sky-700 bg-sky-100 px-2 py-0.5 rounded-md">
                                    4 Hari / 3 Malam
                                </span>
                            </div>
                            <h4 id="previewDestTitle" class="text-sm sm:text-base font-extrabold text-slate-900 truncate mt-1">
                                Pulau Redang Sunset Villa
                            </h4>
                            <p id="previewDestLocation" class="text-xs font-semibold text-slate-600 truncate">
                                Malaysia • Pulau Redang, Terengganu
                            </p>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 text-white shadow-sm font-extrabold text-xs">
                                    <span class="text-[10px] uppercase font-bold text-sky-100 tracking-wider">Total Price:</span>
                                    <span id="previewDestPrice">RM 1,250.00</span>
                                </div>
                                <span id="previewPriceRate" class="text-[11px] font-bold text-sky-800 bg-sky-100/90 border border-sky-200 px-2.5 py-1 rounded-xl shadow-xs">
                                    RM 1,250.00 / org × 1 Tetamu
                                </span>
                                <span id="previewDestSchedule" class="text-[11px] font-bold text-slate-700 bg-white/90 border border-sky-200 px-2.5 py-1 rounded-xl shadow-xs">
                                    📅 Open Booking
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Inputs for Form Submission (Auto-filled by JS) -->
                    <input type="hidden" id="destinationInput" name="destination" value="">
                    <input type="hidden" id="titleInput" name="title" value="">
                    <input type="hidden" id="startDateInput" name="start_date" value="">
                    <input type="hidden" id="endDateInput" name="end_date" value="">
                </div>

                <!-- Guests & Tier -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="travelersCountInput" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                {{ __('Guests / Capacity') }} *
                            </label>
                            <span id="capacityBadge" class="text-[10px] font-bold text-sky-700 bg-sky-100 px-2 py-0.5 rounded-md">
                                Max: 2 Tetamu
                            </span>
                        </div>
                        <select
                            id="travelersCountInput"
                            name="travelers_count"
                            required
                            onchange="onTravelersChange()"
                            class="w-full text-sm font-semibold p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white cursor-pointer"
                        >
                            <option value="1">1 Tetamu (Solo)</option>
                            <option value="2" selected>2 Tetamu (Couples Escape)</option>
                        </select>
                        <p class="text-[11px] text-slate-400 mt-1">Harga pakej dikira secara automatik berdasarkan kapasiti tetamu.</p>
                    </div>
                    <div>
                        <label for="tierInput" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Pakej VIP (Experience Tier) *
                        </label>
                        <select
                            id="tierInput"
                            name="tier"
                            required
                            class="w-full text-sm font-semibold p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white cursor-pointer"
                        >
                            <option value="Diamond Sovereign" selected>Diamond Sovereign (Butler Peribadi & Yacht)</option>
                            <option value="Platinum Horizon">Platinum Horizon (Chauffeur & Oceanfront)</option>
                            <option value="Signature Gold">Signature Gold (VIP Suite & Concierge)</option>
                        </select>
                    </div>
                </div>

                <!-- Special Concierge Notes -->
                <div>
                    <label for="notesInput" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Permintaan Khas / Nota Concierge (Pilihan)
                    </label>
                    <textarea
                        id="notesInput"
                        name="notes"
                        rows="3"
                        placeholder="Contoh: Pemindahan helikopter dari lapangan terbang, chef peribadi untuk makan malam ulang tahun, champagne kegemaran..."
                        class="w-full text-sm font-semibold p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white"
                    ></textarea>
                </div>

                <!-- Modal Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button
                        type="button"
                        onclick="document.getElementById('bookingModal').classList.add('hidden')"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition"
                    >
                        {{ __('Cancel') }}
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-2.5 rounded-xl text-xs font-extrabold text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 shadow-md shadow-sky-600/25 transition flex items-center gap-1.5"
                    >
                        <span>{{ __('Proceed to Payment') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ITINERARY DETAILS MODAL -->
    <div id="itineraryModal" class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl shadow-2xl max-w-xl w-full max-h-[90vh] overflow-y-auto border border-sky-100 animate-fadeIn">
            <div class="relative h-48 bg-slate-900 overflow-hidden rounded-t-3xl">
                <img
                    id="modalImage"
                    src=""
                    alt="Destination"
                    class="w-full h-full object-cover opacity-80"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                <button
                    type="button"
                    onclick="document.getElementById('itineraryModal').classList.add('hidden')"
                    class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/40 hover:bg-black/60 text-white flex items-center justify-center transition"
                >
                    ✕
                </button>
                <div class="absolute bottom-4 left-6 right-6 text-white">
                    <span id="modalCode" class="inline-block text-[10px] font-extrabold tracking-widest uppercase bg-sky-500 text-white px-2 py-0.5 rounded-md mb-1"></span>
                    <h3 id="modalDestination" class="text-2xl font-extrabold leading-tight"></h3>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <h4 id="modalTitle" class="text-lg font-extrabold text-slate-900"></h4>
                    <p id="modalNotes" class="text-xs text-slate-600 mt-1 leading-relaxed"></p>
                </div>

                <div class="grid grid-cols-2 gap-3 p-4 rounded-2xl bg-sky-50/60 border border-sky-100 text-xs">
                    <div>
                        <span class="text-slate-400 font-bold block uppercase text-[10px]">Travel Dates</span>
                        <span id="modalDates" class="font-extrabold text-slate-800 block mt-0.5"></span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold block uppercase text-[10px]">Travelers</span>
                        <span id="modalGuests" class="font-extrabold text-slate-800 block mt-0.5"></span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold block uppercase text-[10px]">VIP Tier</span>
                        <span id="modalTier" class="font-extrabold text-amber-700 block mt-0.5"></span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold block uppercase text-[10px]">Total Price</span>
                        <span id="modalPrice" class="font-extrabold text-slate-900 block mt-0.5"></span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs space-y-2">
                    <div class="flex items-center gap-2 font-bold text-slate-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Dedicated Concierge Assistance
                    </div>
                    <p class="text-slate-600 text-[11px] leading-relaxed">
                        For any last-minute amendments, special dining requests, or airport luggage assistance, contact our 24/7 VIP Travel Desk at <strong>+1 (800) 429-8732</strong> with your package code.
                    </p>
                </div>

                <div class="pt-2 flex flex-wrap items-center justify-end gap-2">
                    <a
                        id="modalPdfDownloadBtn"
                        href="#"
                        class="px-3.5 py-2 rounded-xl text-xs font-bold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download PDF
                    </a>
                    <a
                        id="modalPdfPrintBtn"
                        href="#"
                        target="_blank"
                        class="px-3.5 py-2 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Print PDF
                    </a>
                    <button
                        type="button"
                        onclick="document.getElementById('itineraryModal').classList.add('hidden')"
                        class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 transition"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-10 mt-12 border-t border-sky-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:flex sm:items-center sm:justify-between text-xs text-slate-400">
            <div class="flex items-center justify-center sm:justify-start gap-2 mb-4 sm:mb-0">
                <span class="font-extrabold text-base text-white">Azure<span class="text-sky-400">Voyage</span></span>
                <span>— Private Customer Travel Management System</span>
            </div>
            <div>
                © 2026 AzureVoyage Luxury Travel Agency. All rights reserved. IATA & ATOL protected.
            </div>
        </div>
    </footer>

    <!-- JavaScript for Modals & Presets -->
    <script>
        function onDestinationChange(selectEl) {
            if (!selectEl) return;
            const selectedOpt = selectEl.options[selectEl.selectedIndex];
            if (!selectedOpt || !selectedOpt.value) return;

            const loc = selectedOpt.getAttribute('data-location') || '';
            const title = selectedOpt.getAttribute('data-title') || '';
            const price = parseFloat(selectedOpt.getAttribute('data-price') || '0');
            const capacity = parseInt(selectedOpt.getAttribute('data-capacity') || '2', 10);
            const days = parseInt(selectedOpt.getAttribute('data-days') || '4', 10);
            const img = selectedOpt.getAttribute('data-image') || '';
            const startDate = selectedOpt.getAttribute('data-start') || '';
            const endDate = selectedOpt.getAttribute('data-end') || '';
            const datesLabel = selectedOpt.getAttribute('data-dates-label') || '';

            // Auto-fill hidden inputs
            document.getElementById('destinationInput').value = loc;
            document.getElementById('titleInput').value = title;
            if (document.getElementById('startDateInput')) {
                document.getElementById('startDateInput').value = startDate;
            }
            if (document.getElementById('endDateInput')) {
                document.getElementById('endDateInput').value = endDate;
            }

            // Dynamically populate guest capacity options up to the package's max capacity
            const travelersSelect = document.getElementById('travelersCountInput');
            if (travelersSelect) {
                const prevVal = parseInt(travelersSelect.value, 10) || 1;
                travelersSelect.innerHTML = '';
                for (let i = 1; i <= capacity; i++) {
                    const opt = document.createElement('option');
                    opt.value = i;
                    let label = i + ' Tetamu';
                    if (i === 1) label += ' (Solo)';
                    else if (i === 2) label += ' (Couples Escape)';
                    else if (i === capacity) label += ' (Maksimum Pakej)';
                    opt.textContent = label;
                    if (i === prevVal || (prevVal > capacity && i === capacity)) {
                        opt.selected = true;
                    }
                    travelersSelect.appendChild(opt);
                }
            }

            const capacityBadge = document.getElementById('capacityBadge');
            if (capacityBadge) {
                capacityBadge.textContent = 'Max: ' + capacity + ' Tetamu';
            }

            // Update live preview card details
            const previewCard = document.getElementById('selectedDestinationPreview');
            if (previewCard) {
                previewCard.classList.remove('hidden');
                document.getElementById('previewDestTitle').textContent = title;
                document.getElementById('previewDestLocation').textContent = loc;
                document.getElementById('previewDestDays').textContent = days + ' Hari / ' + Math.max(1, days - 1) + ' Malam';
                const schedEl = document.getElementById('previewDestSchedule');
                if (schedEl) {
                    schedEl.textContent = '📅 ' + (datesLabel || 'Ditetapkan oleh Admin');
                }
                if (img) {
                    document.getElementById('previewDestImg').src = img;
                }
            }

            // Calculate price based on selected capacity
            calculateDynamicPrice();

            // Highlight matching destination badge
            document.querySelectorAll('.dest-chip').forEach(chip => {
                if (chip.getAttribute('data-id') === selectedOpt.value) {
                    chip.classList.add('ring-2', 'ring-sky-600', 'bg-sky-200', 'text-sky-950', 'font-black');
                    chip.classList.remove('bg-sky-50', 'text-sky-800');
                } else {
                    chip.classList.remove('ring-2', 'ring-sky-600', 'bg-sky-200', 'text-sky-950', 'font-black');
                    chip.classList.add('bg-sky-50', 'text-sky-800');
                }
            });
        }

        function onTravelersChange() {
            calculateDynamicPrice();
        }

        function calculateDynamicPrice() {
            const selectEl = document.getElementById('destinationSelect');
            if (!selectEl) return;
            const selectedOpt = selectEl.options[selectEl.selectedIndex];
            if (!selectedOpt) return;

            const pricePerPerson = parseFloat(selectedOpt.getAttribute('data-price') || '0');
            const travelersSelect = document.getElementById('travelersCountInput');
            const count = parseInt(travelersSelect ? travelersSelect.value : '1', 10) || 1;
            const totalPrice = pricePerPerson * count;

            const previewPrice = document.getElementById('previewDestPrice');
            if (previewPrice) {
                previewPrice.textContent = 'RM ' + totalPrice.toLocaleString('en-US', { minimumFractionDigits: 2 });
            }

            const previewRate = document.getElementById('previewPriceRate');
            if (previewRate) {
                previewRate.textContent = 'RM ' + pricePerPerson.toLocaleString('en-US', { minimumFractionDigits: 2 }) + ' / org × ' + count + ' Tetamu';
            }
        }

        function pickDestinationById(id) {
            const selectEl = document.getElementById('destinationSelect');
            if (!selectEl) return;
            selectEl.value = id;
            onDestinationChange(selectEl);
        }

        // Initialize default selection on page load
        document.addEventListener('DOMContentLoaded', function() {
            const selectEl = document.getElementById('destinationSelect');
            if (selectEl && selectEl.value) {
                onDestinationChange(selectEl);
            }
        });

        function openItineraryModal(vacation) {
            document.getElementById('modalImage').src = vacation.image_url || 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80';
            document.getElementById('modalCode').textContent = '#' + vacation.package_code;
            document.getElementById('modalDestination').textContent = vacation.destination;
            document.getElementById('modalTitle').textContent = vacation.title;
            document.getElementById('modalDates').textContent = vacation.start_date + ' to ' + vacation.end_date;
            document.getElementById('modalGuests').textContent = vacation.travelers_count + ' Guests';
            document.getElementById('modalTier').textContent = vacation.tier || 'Signature Gold';
            document.getElementById('modalPrice').textContent = 'RM ' + Number(vacation.price).toLocaleString('en-US', { minimumFractionDigits: 2 });
            document.getElementById('modalNotes').textContent = vacation.notes || 'No custom notes submitted. Standard luxury itinerary perks apply.';

            const downloadBtn = document.getElementById('modalPdfDownloadBtn');
            const printBtn = document.getElementById('modalPdfPrintBtn');
            if (vacation && vacation.id) {
                if (downloadBtn) {
                    downloadBtn.href = '/customer/bookings/' + vacation.id + '/pdf?download=1';
                }
                if (printBtn) {
                    printBtn.href = '/customer/bookings/' + vacation.id + '/pdf?print=1';
                }
            }

            document.getElementById('itineraryModal').classList.remove('hidden');
        }

        // Close modals on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.getElementById('bookingModal').classList.add('hidden');
                document.getElementById('itineraryModal').classList.add('hidden');
            }
        });
    </script>
    @include('partials.logout-toastr')
</body>
</html>