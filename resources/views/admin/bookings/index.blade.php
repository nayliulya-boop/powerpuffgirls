<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Bookings & Availability Review | AzureVoyage Admin</title>

    <!-- Google Fonts -->
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top Admin Executive Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-400 text-slate-950 shadow-sm whitespace-nowrap">
                    ⚡ ADMIN COMMAND CENTER
                </span>
                <span class="text-slate-200">
                    Signed in as Executive Administrator: <strong class="text-white">{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})
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

                <!-- Navigation Links & Admin Actions -->
                <div class="flex items-center gap-2 lg:gap-4 shrink-0">
                    <nav class="hidden md:flex items-center gap-1 lg:gap-2 text-xs lg:text-sm font-semibold text-slate-600">
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="px-3 py-2 rounded-xl whitespace-nowrap flex items-center gap-1.5 transition hover:text-sky-600 hover:bg-slate-50"
                        >
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span>Admin Dashboard</span>
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="text-amber-400 font-bold transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            {{ __('Bookings') }}
                        </a>
                        <a href="{{ route('admin.profile') }}" class="hover:text-amber-400 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ __('Admin Profile') }}
                        </a>

                        <a
                            href="{{ route('admin.dashboard') }}#destinations-catalog"
                            class="px-2.5 py-2 rounded-xl whitespace-nowrap flex items-center gap-1.5 hover:text-sky-600 hover:bg-slate-50 transition"
                        >
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Destinations</span>
                        </a>

                        <a
                            href="{{ route('admin.profile') }}"
                            class="px-2.5 py-2 rounded-xl whitespace-nowrap flex items-center gap-1.5 hover:text-sky-600 hover:bg-slate-50 transition"
                        >
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>Admin Profile</span>
                        </a>

                    </nav>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button
                            type="submit"
                            title="{{ __('Sign Out') }}"
                            class="p-2 sm:px-3 sm:py-2 text-xs font-bold text-slate-300 hover:text-rose-400 hover:bg-rose-500/10 rounded-xl border border-slate-700 transition flex items-center gap-1.5 whitespace-nowrap"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span class="hidden sm:inline">{{ __('Sign Out') }}</span>
                        </button>
                    </form>

                    @include('partials.language-switcher')
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full space-y-8">

        <!-- Status Alerts -->
        @if (session('status'))
            <div class="rounded-2xl p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-semibold flex items-center gap-3 shadow-sm">
                <span class="text-xl">✅</span>
                <p>{{ session('status') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl p-4 bg-rose-50 border border-rose-200 text-rose-900 text-sm font-semibold flex items-center gap-3 shadow-sm">
                <span class="text-xl">⚠️</span>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Header & Quick Description -->
        <div class="rounded-3xl p-8 sm:p-10 bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white shadow-xl relative overflow-hidden border border-sky-900/40">
            <div class="relative z-10">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-sky-500/20 text-sky-300 border border-sky-400/30 mb-3">
                    Verification & Approval Desk
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Booking Availability Management</h1>
                <p class="mt-2 text-slate-300 text-sm sm:text-base max-w-2xl leading-relaxed">
                    Check if hotel slots and flight seats are available before authorizing customer payment. Approved bookings immediately unlock the customer's payment portal.
                </p>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <!-- Total Bookings -->
            <div class="glass-card rounded-2xl p-5 shadow-sm border border-slate-200">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Bookings</span>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-3xl font-extrabold text-slate-900">{{ number_format($stats['totalBookings']) }}</span>
                    <span class="text-xs font-bold text-slate-400">All Time</span>
                </div>
            </div>

            <!-- Pending Review -->
            <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-l-amber-500 border border-slate-200 bg-amber-50/30">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">⏳ Needs Availability Check</span>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-3xl font-extrabold text-amber-800">{{ number_format($stats['pendingApprovalCount']) }}</span>
                    <span class="text-xs font-bold text-amber-600 bg-amber-100 px-2 py-0.5 rounded-full">Pending</span>
                </div>
            </div>

            <!-- Approved (Ready to Pay) -->
            <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-l-emerald-500 border border-slate-200 bg-emerald-50/30">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">✨ Approved & Available</span>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-3xl font-extrabold text-emerald-800">{{ number_format($stats['approvedCount']) }}</span>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full">Awaiting Pay</span>
                </div>
            </div>

            <!-- Paid Revenue -->
            <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-l-sky-500 border border-slate-200 bg-sky-50/30">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-700">💰 Settled Revenue</span>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-2xl sm:text-3xl font-extrabold text-sky-900">RM {{ number_format($stats['totalRevenue'], 0) }}</span>
                    <span class="text-xs font-bold text-sky-600">{{ $stats['paidCount'] }} Paid</span>
                </div>
            </div>
        </div>

        <!-- Filter & Search Controls -->
        <div class="glass-card rounded-2xl p-4 shadow-sm border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Filter Tabs -->
            <div class="flex items-center gap-1.5 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 text-xs sm:text-sm font-semibold">
                <a
                    href="{{ route('admin.bookings.index', ['status' => 'all', 'search' => $search]) }}"
                    class="px-3.5 py-2 rounded-xl transition whitespace-nowrap {{ $status === 'all' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}"
                >
                    All Bookings ({{ $stats['totalBookings'] }})
                </a>
                <a
                    href="{{ route('admin.bookings.index', ['status' => 'pending_approval', 'search' => $search]) }}"
                    class="px-3.5 py-2 rounded-xl transition whitespace-nowrap flex items-center gap-1.5 {{ $status === 'pending_approval' ? 'bg-amber-500 text-slate-950 font-bold shadow-sm' : 'text-amber-800 bg-amber-50 hover:bg-amber-100' }}"
                >
                    <span>⏳ Pending Check</span>
                    <span class="w-5 h-5 rounded-full bg-amber-700 text-white text-[10px] flex items-center justify-center font-bold">{{ $stats['pendingApprovalCount'] }}</span>
                </a>
                <a
                    href="{{ route('admin.bookings.index', ['status' => 'approved', 'search' => $search]) }}"
                    class="px-3.5 py-2 rounded-xl transition whitespace-nowrap flex items-center gap-1.5 {{ $status === 'approved' ? 'bg-emerald-600 text-white font-bold shadow-sm' : 'text-emerald-800 bg-emerald-50 hover:bg-emerald-100' }}"
                >
                    <span>✓ Approved</span>
                    <span class="w-5 h-5 rounded-full bg-emerald-700 text-white text-[10px] flex items-center justify-center font-bold">{{ $stats['approvedCount'] }}</span>
                </a>
                <a
                    href="{{ route('admin.bookings.index', ['status' => 'upcoming', 'search' => $search]) }}"
                    class="px-3.5 py-2 rounded-xl transition whitespace-nowrap {{ $status === 'upcoming' ? 'bg-sky-600 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}"
                >
                    Paid / Confirmed
                </a>
                <a
                    href="{{ route('admin.bookings.index', ['status' => 'rejected', 'search' => $search]) }}"
                    class="px-3.5 py-2 rounded-xl transition whitespace-nowrap {{ $status === 'rejected' ? 'bg-rose-600 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}"
                >
                    Rejected
                </a>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="w-full md:w-80">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search package, client, email..."
                        class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 bg-white"
                    >
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>
        </div>

        <!-- Bookings List -->
        @if ($bookings->isEmpty())
            <div class="glass-card rounded-3xl p-12 text-center border border-slate-200">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold">
                    📋
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">No Bookings Found</h3>
                <p class="text-slate-500 text-sm max-w-md mx-auto mb-4">
                    There are no customer booking requests matching the selected filter or search keyword.
                </p>
                <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition">
                    Reset Filter
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($bookings as $booking)
                    <div class="glass-card rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                        <!-- Main Details Column -->
                        <div class="space-y-3 flex-1">
                            <div class="flex flex-wrap items-center gap-2.5">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-md bg-slate-100 text-slate-800 border border-slate-300">
                                    #{{ $booking->package_code }}
                                </span>

                                <!-- Availability Status Badge -->
                                @if ($booking->status === 'pending_approval')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-900 border border-amber-300 animate-pulse">
                                        ⏳ Menunggu Semakan Admin (Pending Check)
                                    </span>
                                @elseif ($booking->status === 'approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-900 border border-emerald-300">
                                        ✨ Available / Approved (Awaiting Payment)
                                    </span>
                                @elseif ($booking->status === 'rejected')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-900 border border-rose-300">
                                        ❌ Not Available / Rejected
                                    </span>
                                @elseif ($booking->payment_status === 'paid' || $booking->status === 'upcoming')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-sky-100 text-sky-900 border border-sky-300">
                                        ✓ Confirmed & Paid
                                    </span>
                                @elseif ($booking->status === 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-slate-100 text-slate-700 border border-slate-300">
                                        ✓ Completed Journey
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-slate-100 text-slate-700 border border-slate-300">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                @endif

                                <!-- Payment Status Badge -->
                                @if ($booking->payment_status === 'paid')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-500 text-white">
                                        PAID (RM {{ number_format($booking->price, 2) }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-200 text-slate-700">
                                        UNPAID
                                    </span>
                                @endif

                                <span class="text-xs font-semibold text-slate-400">
                                    Submitted {{ $booking->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <!-- Title & Destination -->
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 leading-snug">
                                    {{ $booking->title }}
                                </h3>
                                <p class="text-sm font-semibold text-sky-700 flex items-center gap-1.5 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $booking->destination }} • <span class="text-amber-700 font-bold">{{ $booking->tier }}</span>
                                </p>
                            </div>

                            <!-- Traveler & Booking Metadata -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <div>
                                    <span class="text-slate-400 block font-semibold uppercase">Customer</span>
                                    <span class="font-bold text-slate-800">{{ $booking->user->name }}</span>
                                    <span class="text-slate-500 block text-[11px]">{{ $booking->user->email }}</span>
                                    @if ($booking->user->phone)
                                        <span class="text-slate-500 block text-[11px]">📞 {{ $booking->user->phone }}</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-semibold uppercase">Travel Dates & Guests</span>
                                    <span class="font-bold text-slate-800">{{ $booking->start_date?->format('d M Y') }} - {{ $booking->end_date?->format('d M Y') }}</span>
                                    <span class="text-slate-500 block text-[11px]">{{ $booking->travelers_count }} Travelers</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-semibold uppercase">Total Price</span>
                                    <span class="font-extrabold text-sm text-slate-900">RM {{ number_format($booking->price, 2) }}</span>
                                    @if ($booking->latestPayment)
                                        <span class="text-emerald-700 font-semibold block text-[11px]">Txn: {{ $booking->latestPayment->transaction_reference }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Special Notes & Admin Feedback -->
                            @if ($booking->notes)
                                <div class="text-xs text-slate-600 bg-white p-2.5 rounded-lg border border-slate-200">
                                    <strong class="text-slate-700">Client Notes:</strong> {{ $booking->notes }}
                                </div>
                            @endif

                            @if ($booking->admin_notes)
                                <div class="text-xs text-amber-900 bg-amber-50 p-2.5 rounded-lg border border-amber-200">
                                    <strong class="text-amber-950">Admin Verification Note:</strong> {{ $booking->admin_notes }}
                                    @if ($booking->reviewed_at)
                                        <span class="text-[10px] text-amber-700 block mt-0.5">Reviewed by {{ $booking->reviewer->name ?? 'Admin' }} on {{ $booking->reviewed_at->format('d M Y H:i') }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons Column -->
                        <div class="lg:w-72 flex flex-col gap-2.5 lg:border-l lg:border-slate-200 lg:pl-6 justify-center">

                            @if ($booking->status === 'pending_approval')
                                <!-- Approve Form -->
                                <form method="POST" action="{{ route('admin.bookings.approve', $booking) }}" class="space-y-2">
                                    @csrf
                                    <input
                                        type="text"
                                        name="admin_notes"
                                        placeholder="Admin note (e.g. Flight & villa available)"
                                        class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-300 focus:outline-none focus:border-emerald-500"
                                    >
                                    <button
                                        type="submit"
                                        class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-extrabold text-xs shadow-md shadow-emerald-600/20 hover:scale-[1.01] transition flex items-center justify-center gap-1.5"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Sahkan Ketersediaan (Approve)</span>
                                    </button>
                                </form>

                                <!-- Reject Form -->
                                <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}" class="space-y-1.5">
                                    @csrf
                                    <input
                                        type="text"
                                        name="admin_notes"
                                        placeholder="Reason if unavailable (e.g. Dates full)"
                                        class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-300 focus:outline-none focus:border-rose-500"
                                    >
                                    <button
                                        type="submit"
                                        onclick="return confirm('Adakah anda pasti mahu tolak tempahan ini kerana tidak tersedia?')"
                                        class="w-full py-2 px-4 rounded-xl border border-rose-300 text-rose-700 hover:bg-rose-50 font-bold text-xs transition flex items-center justify-center gap-1.5"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        <span>Tidak Tersedia (Reject)</span>
                                    </button>
                                </form>

                            @elseif ($booking->status === 'approved')
                                <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-center">
                                    <span class="text-xs font-bold text-emerald-800 block">✓ Approved & Available</span>
                                    <span class="text-[11px] text-emerald-600 block mt-0.5">Waiting for customer to pay online</span>
                                </div>

                                <!-- Option to re-check or reject if needed -->
                                <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        onclick="return confirm('Cancel availability approval?')"
                                        class="w-full text-[11px] text-slate-500 hover:text-rose-600 text-center underline"
                                    >
                                        Revoke / Mark as Unavailable
                                    </button>
                                </form>

                            @elseif ($booking->payment_status === 'paid' || $booking->status === 'upcoming')
                                <div class="p-3 rounded-xl bg-sky-50 border border-sky-200 text-center">
                                    <span class="text-xs font-bold text-sky-900 block">✓ Payment Confirmed</span>
                                    <span class="text-[11px] text-sky-700 block mt-0.5">Booking is 100% secured</span>
                                </div>
                                <button
                                    type="button"
                                    onclick="openReceiptPreviewModal({{ json_encode([
                                        'package_code' => $booking->package_code,
                                        'title' => $booking->title,
                                        'destination' => $booking->destination,
                                        'tier' => $booking->tier,
                                        'customer_name' => $booking->user->name,
                                        'customer_email' => $booking->user->email,
                                        'customer_phone' => $booking->user->phone ?? 'N/A',
                                        'travelers_count' => $booking->travelers_count,
                                        'dates' => ($booking->start_date?->format('d M Y') ?? '-') . ' - ' . ($booking->end_date?->format('d M Y') ?? '-'),
                                        'amount' => 'RM ' . number_format($booking->price, 2),
                                        'txn_ref' => $booking->latestPayment?->transaction_reference ?? ('AV-TXN-' . $booking->package_code),
                                        'payment_method' => strtoupper($booking->latestPayment?->payment_method ?? 'FPX'),
                                        'bank_name' => $booking->latestPayment?->bank_name ?? ($booking->latestPayment?->card_last_four ? ('Kad Kredit/Debit (•••• ' . $booking->latestPayment->card_last_four . ')') : 'Online Banking'),
                                        'paid_at' => $booking->latestPayment?->paid_at ? $booking->latestPayment->paid_at->format('d M Y, h:i A') : ($booking->updated_at ? $booking->updated_at->format('d M Y, h:i A') : '-'),
                                        'admin_notes' => $booking->admin_notes ?? 'Disahkan ketersediaan slot oleh pentadbir.',
                                        'reviewer' => $booking->reviewer->name ?? 'Admin',
                                        'receipt_url' => route('customer.payment.receipt', $booking),
                                    ]) }})"
                                    class="w-full py-2.5 px-3 rounded-xl bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 hover:from-sky-500 hover:to-blue-500 text-white text-xs font-extrabold shadow-sm hover:scale-[1.01] active:scale-[0.99] transition flex items-center justify-center gap-1.5"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span> Preview Resit Pelanggan</span>
                                

                            @elseif ($booking->status === 'rejected')
                                <div class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-center">
                                    <span class="text-xs font-bold text-rose-800 block">❌ Rejected</span>
                                    <span class="text-[11px] text-rose-600 block mt-0.5">Customer notified of unavailability</span>
                                </div>
                                <!-- Option to re-approve if slot frees up -->
                                <form method="POST" action="{{ route('admin.bookings.approve', $booking) }}">
                                    @csrf
                                    <input type="hidden" name="admin_notes" value="Slot has now freed up! Approved for payment.">
                                    <button
                                        type="submit"
                                        class="w-full py-1.5 px-3 rounded-lg border border-emerald-300 text-emerald-700 hover:bg-emerald-50 text-[11px] font-bold transition"
                                    >
                                        Re-Approve Availability
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            </div>
        @endif

    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-slate-900 text-slate-400 py-8 border-t border-slate-800 text-xs text-center">
        <div class="max-w-7xl mx-auto px-4">
            <p>© 2026 AzureVoyage Luxury Travel Agency • Administrator Control System.</p>
        </div>
    </footer>

    <!-- Admin Customer Receipt Preview Modal -->
    <div id="receiptPreviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/75 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" aria-labelledby="receiptModalTitle" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all">
            
            <!-- Top Gradient Bar -->
            <div class="h-3 bg-gradient-to-r from-sky-600 via-amber-400 to-emerald-500"></div>

            <!-- Modal Header -->
            <div class="p-6 sm:p-8 pb-4 flex items-start justify-between border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center text-xl font-extrabold shadow-sm">
                        🧾
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-black uppercase tracking-wider text-sky-700 bg-sky-50 px-2.5 py-0.5 rounded-full border border-sky-200">
                                Official Payment Receipt
                            </span>
                            <span id="receiptModalCode" class="text-xs font-mono font-bold text-slate-500">
                                #AV-0000
                            </span>
                        </div>
                        <h2 id="receiptModalTitle" class="text-xl sm:text-2xl font-black text-slate-900 mt-1">
                            Preview Resit Pelanggan
                        </h2>
                    </div>
                </div>
            

                <button
                    type="button"
                    onclick="closeReceiptPreviewModal()"
                    class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition"
                    title="Tutup Modal"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Body Details -->
            <div class="p-6 sm:p-8 space-y-6 max-h-[75vh] overflow-y-auto">
                
                <!-- Status Banner -->
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-emerald-900">
                        <span class="text-xl">✅</span>
                        <div>
                            <strong class="block text-sm font-extrabold">BAYARAN BERJAYA & DISAHKAN</strong>
                            <span class="text-xs text-emerald-700">Tersimpan dalam pangkalan data MySQL (phpMyAdmin Live)</span>
                        </div>
                    </div>
                    <span id="receiptModalAmount" class="text-xl font-black text-emerald-800 whitespace-nowrap">
                        RM 0.00
                    </span>
                </div>

                <!-- Transaction Reference & Channel Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs bg-slate-50 p-4 rounded-2xl border border-slate-200">
                    <div>
                        <span class="text-slate-400 font-bold uppercase block text-[10px]">No. Rujukan Transaksi</span>
                        <strong id="receiptModalTxnRef" class="font-mono text-sm text-sky-800 select-all block mt-0.5">
                            AV-TXN-XXXXXXXX
                        </strong>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase block text-[10px]">Tarikh & Masa Bayaran</span>
                        <strong id="receiptModalPaidAt" class="text-slate-800 text-sm block mt-0.5">
                            -
                        </strong>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase block text-[10px]">Kaedah Pembayaran</span>
                        <span id="receiptModalMethod" class="inline-block px-2 py-0.5 rounded font-extrabold text-[11px] bg-slate-200 text-slate-800 mt-1">
                            FPX ONLINE
                        </span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase block text-[10px]">Saluran / Bank / Kad</span>
                        <strong id="receiptModalBank" class="text-slate-800 text-xs block mt-1">
                            -
                        </strong>
                    </div>
                </div>

                <!-- Customer Details Grid -->
                <div class="p-4 rounded-2xl border border-slate-200 space-y-3">
                    <span class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                        Maklumat Pelanggan (Traveler)
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                        <div>
                            <span class="text-slate-400 block font-semibold text-[10px] uppercase">Nama Penuh</span>
                            <strong id="receiptModalCustomer" class="text-slate-900 text-sm block"></strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold text-[10px] uppercase">Alamat Emel</span>
                            <span id="receiptModalEmail" class="text-slate-700 block text-xs"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold text-[10px] uppercase">No. Telefon</span>
                            <span id="receiptModalPhone" class="text-slate-700 block text-xs"></span>
                        </div>
                    </div>
                </div>

                <!-- Package & Itinerary Details -->
                <div class="p-4 rounded-2xl border border-slate-200 space-y-3">
                    <span class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                        Butiran Pakej & Perjalanan
                    </span>
                    <div>
                        <h4 id="receiptModalPackage" class="text-base font-extrabold text-slate-900"></h4>
                        <p class="text-xs font-semibold text-sky-700 mt-0.5">
                            📍 <span id="receiptModalDestination"></span> • <span id="receiptModalTier" class="text-amber-700 font-bold"></span>
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-xs pt-2 border-t border-slate-100">
                        <div>
                            <span class="text-slate-400 block font-semibold text-[10px] uppercase">Tarikh Perjalanan</span>
                            <strong id="receiptModalDates" class="text-slate-800"></strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold text-[10px] uppercase">Bilangan Pelancong</span>
                            <strong id="receiptModalGuests" class="text-slate-800"></strong>
                        </div>
                    </div>
                </div>

                <!-- Admin Approval Sign-off -->
                <div class="p-3.5 rounded-xl bg-amber-50/80 border border-amber-200 text-xs text-amber-950 space-y-1">
                    <span class="font-extrabold text-amber-900 block text-[11px]">🛡️ Kelulusan Ketersediaan oleh Pentadbir:</span>
                    <p id="receiptModalNotes" class="italic text-amber-900"></p>
                </div>

            </div>

            <!-- Modal Footer Actions -->
            <div class="p-4 sm:p-6 bg-slate-50 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                <button
                    type="button"
                    onclick="closeReceiptPreviewModal()"
                    class="px-4 py-2.5 rounded-xl bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 font-bold text-xs transition"
                >
                    Tutup
                </button>

                <div class="flex items-center gap-2">
                    <a
                        id="receiptModalLink"
                        href="#"
                        target="_blank"
                        class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs shadow-md transition flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Cetak</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal JavaScript -->
    <script>
        function openReceiptPreviewModal(data) {
            document.getElementById('receiptModalCode').textContent = '#' + data.package_code;
            document.getElementById('receiptModalCustomer').textContent = data.customer_name;
            document.getElementById('receiptModalEmail').textContent = data.customer_email;
            document.getElementById('receiptModalPhone').textContent = data.customer_phone;
            document.getElementById('receiptModalPackage').textContent = data.title;
            document.getElementById('receiptModalDestination').textContent = data.destination;
            document.getElementById('receiptModalTier').textContent = data.tier;
            document.getElementById('receiptModalDates').textContent = data.dates;
            document.getElementById('receiptModalGuests').textContent = data.travelers_count + ' Orang Pelancong';
            document.getElementById('receiptModalTxnRef').textContent = data.txn_ref;
            document.getElementById('receiptModalPaidAt').textContent = data.paid_at;
            document.getElementById('receiptModalMethod').textContent = data.payment_method;
            document.getElementById('receiptModalBank').textContent = data.bank_name;
            document.getElementById('receiptModalAmount').textContent = data.amount;
            document.getElementById('receiptModalNotes').textContent = data.admin_notes;
            document.getElementById('receiptModalLink').href = data.receipt_url;

            const modal = document.getElementById('receiptPreviewModal');
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeReceiptPreviewModal() {
            const modal = document.getElementById('receiptPreviewModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close on backdrop click
        document.getElementById('receiptPreviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReceiptPreviewModal();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeReceiptPreviewModal();
            }
        });
    </script>
</body>
</html>

