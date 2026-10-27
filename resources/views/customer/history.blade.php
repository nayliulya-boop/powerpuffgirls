<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vacation History & Past Journeys | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="View your historical AzureVoyage vacation itineraries, completed journeys, and archived bookings.">

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
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white overflow-x-hidden">

    <!-- Top VIP Notification Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-400 text-slate-900 shadow-sm">
                    ★ {{ $stats['vipTier'] ?? 'Signature Gold VIP' }}
                </span>
                <span class="text-slate-200">
                    {{ __('Travel History & Archives') }}: <strong class="text-white">{{ $user->name }}</strong>
                </span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-200">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ __('Completed Trips') }}: <strong class="text-white">{{ $stats['completedCount'] ?? 0 }}</strong>
                </span>
                <span>24/7 {{ __('Dedicated Concierge') }}: <strong>+1 (800) 429-8732</strong></span>
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
                            {{ __('Luxury Traveler Portal') }}
                        </span>
                    </div>
                </a>

                <!-- Navigation Links & User Menu -->
                <div class="flex items-center gap-3 sm:gap-6">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                        <a href="{{ route('customer.dashboard') }}" class="transition flex items-center gap-1.5 whitespace-nowrap {{ request()->routeIs('customer.dashboard') ? 'text-sky-600 font-bold' : 'hover:text-sky-600' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('customer.dashboard') ? 'text-sky-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('customer.profile') }}" class="hover:text-sky-600 transition flex items-center gap-1.5 whitespace-nowrap {{ request()->routeIs('customer.profile') ? 'text-sky-600 font-bold' : '' }}">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ __('My Profile') }}
                        </a>
                        <a href="{{ route('customer.history') }}" class="transition flex items-center gap-1.5 whitespace-nowrap {{ request()->routeIs('customer.history') ? 'text-sky-600 font-bold' : 'hover:text-sky-600' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('customer.history') ? 'text-sky-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('History') }}
                        </a>
                        @if ($user->isAdmin())
                            <a href="{{ route('admin.profile') }}" class="px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-400/20 text-amber-800 border border-amber-300 hover:bg-amber-300 transition flex items-center gap-1 whitespace-nowrap">
                                🛡️ {{ __('Admin Portal') }}
                            </a>
                        @endif
                    </nav>

                    <!-- User Profile & Sign Out -->
                    <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                        <a href="{{ route('customer.profile') }}" title="{{ __('Edit Profile') }}" class="flex items-center gap-2.5 group hover:opacity-90 transition">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-700 text-white font-extrabold flex items-center justify-center text-sm shadow-md shadow-sky-500/20 group-hover:scale-105 transition-transform">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <span class="text-sm font-bold text-slate-900 block leading-tight group-hover:text-sky-600 transition whitespace-nowrap">{{ $user->name }}</span>
                                <span class="text-xs font-semibold text-sky-600 block whitespace-nowrap">{{ $user->isAdmin() ? __('Admin Profile') . ' →' : __('Edit Profile') . ' →' }}</span>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full space-y-8">

        <!-- Page Header -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white p-8 sm:p-10 shadow-xl border border-sky-900/50">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-sky-500/20 text-sky-300 border border-sky-400/30 mb-3">
                    {{ __('Travel Archive') }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    {{ __('Your Travel History') }}
                </h1>
                <p class="mt-2 text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ __('Cherish memories from past luxury escapes and review past itineraries fulfilled by AzureVoyage.') }}
                </p>
            </div>
        </div>

        <!-- History Vacation List -->
        @if ($vacations->isEmpty())
            <div class="glass-card rounded-3xl p-12 text-center border border-slate-200 shadow-sm">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-2xl font-bold shadow-inner">
                    ✈️
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">{{ __('No Past Journeys Yet') }}</h3>
                <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
                    {{ __('Once you complete trips or archive vacations, their full itineraries and memories will appear here.') }}
                </p>
                <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm shadow-md shadow-sky-500/20 transition">
                    {{ __('View Active Bookings') }}
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($vacations as $vacation)
                    <div class="glass-card rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group">
                        <div class="h-52 relative overflow-hidden bg-slate-100">
                            <img
                                src="{{ $vacation->image_url ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80' }}"
                                alt="{{ $vacation->destination }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-extrabold uppercase bg-emerald-500 text-white shadow-sm">
                                    ✓ {{ __('Completed Journey') }}
                                </span>
                            </div>
                            <div class="absolute bottom-3 right-3 bg-slate-900/80 backdrop-blur-md px-3 py-1 rounded-lg text-white font-extrabold text-xs shadow">
                                RM {{ number_format((float) $vacation->price, 2) }}
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <span class="text-xs font-bold text-sky-600 uppercase tracking-wider block mb-1">
                                    #{{ $vacation->package_code }} • {{ $vacation->tier }}
                                </span>
                                <h3 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-sky-600 transition">{{ $vacation->title }}</h3>
                                <p class="text-xs font-semibold text-slate-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $vacation->destination }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-semibold">
                                <span>{{ $vacation->start_date?->format('M d, Y') }} - {{ $vacation->end_date?->format('M d, Y') }}</span>
                                <span>{{ $vacation->travelers_count }} {{ __('Guests') }}</span>
                            </div>

                            <div class="pt-2 flex items-center justify-between gap-2">
                                <a
                                    href="{{ route('customer.payment.receipt', $vacation) }}"
                                    class="text-xs font-bold text-sky-600 hover:text-sky-700 transition"
                                >
                                    {{ __('View Receipt') }} &rarr;
                                </a>
                                <a
                                    href="{{ route('customer.payment.receipt.pdf', ['vacation' => $vacation, 'download' => 1]) }}"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition"
                                    title="{{ __('Download official PDF generated via TCPDF') }}"
                                >
                                    <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    <span>PDF</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

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
