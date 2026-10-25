<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Executive Portal | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="AzureVoyage Admin Executive Portal — Manage client bookings, VIP travelers, revenue metrics, and curated luxury destinations.">

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
            background: rgba(255, 255, 255, 0.96);
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
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
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
                        <span class="block text-[10px] uppercase tracking-widest font-bold text-sky-700 -mt-1">
                            Admin Control Center
                        </span>
                    </div>
                </a>

                <!-- Navigation Links & Admin Actions -->
                <div class="flex items-center gap-3 sm:gap-6">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                        <a href="{{ route('admin.bookings.index') }}" class="text-amber-800 hover:text-amber-950 font-bold transition flex items-center gap-2 bg-amber-50 hover:bg-amber-100 px-3.5 py-1.5 rounded-xl border border-amber-300 shadow-sm">
                            <span>📋 Availability & Approvals</span>
                            @if ($stats['pendingApprovalCount'] > 0)
                                <span class="w-5 h-5 rounded-full bg-amber-600 text-white text-[10px] flex items-center justify-center font-black animate-pulse">
                                    {{ $stats['pendingApprovalCount'] }}
                                </span>
                            @endif
                        </a>
                        <a href="#bookings-management" class="hover:text-sky-600 transition">Bookings Table</a>
                        <a href="#clients-directory" class="hover:text-sky-600 transition">VIP Clients</a>
                        <a href="#destinations-catalog" class="hover:text-sky-600 transition">Destinations</a>
                        <a href="{{ route('admin.profile') }}" class="hover:text-sky-600 transition">Admin Profile</a>
                        <a href="{{ route('home') }}" class="hover:text-sky-600 transition flex items-center gap-1">
                            <span>Public Site</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </nav>

                    <div class="h-6 w-px bg-slate-200 hidden md:block"></div>

                    <div class="flex items-center gap-3">
                        <a href="#new-destination-form" class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white text-xs sm:text-sm font-semibold shadow-md shadow-sky-500/20 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Add Destination
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 text-slate-700 text-xs sm:text-sm font-semibold transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">

        <!-- Flash Notifications -->
        @if (session('success'))
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 flex items-start gap-3 text-emerald-900 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm font-semibold">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('info'))
            <div class="rounded-2xl bg-sky-50 border border-sky-200 p-4 flex items-start gap-3 text-sky-900 shadow-sm">
                <svg class="w-5 h-5 text-sky-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm font-semibold">{{ session('info') }}</div>
            </div>
        @endif

        <!-- High-Priority Notification for New Bookings Needing Approval -->
        @if ($stats['pendingApprovalCount'] > 0)
            <div class="rounded-3xl p-6 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-400 text-slate-950 shadow-lg border border-amber-300 flex flex-col md:flex-row md:items-center justify-between gap-4 animate-in fade-in duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-950 text-amber-300 flex items-center justify-center text-2xl font-black shrink-0 shadow-md">
                        ⏳
                    </div>
                    <div>
                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-slate-950 text-amber-300 tracking-wider mb-1">
                            Perlu Tindakan Segera
                        </div>
                        <h3 class="text-base sm:text-lg font-black leading-tight text-slate-950">
                            {{ $stats['pendingApprovalCount'] }} Tempahan Baharu Menunggu Semakan Ketersediaan Admin!
                        </h3>
                        <p class="text-xs font-semibold text-slate-900 mt-0.5">
                            Pelanggan telah membuat tempahan (termasuk <strong>redang</strong> & pakej lain). Sahkan ketersediaan slot hotel & penerbangan agar pelanggan boleh terus membuat bayaran.
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('admin.bookings.index', ['status' => 'pending_approval']) }}" class="px-5 py-3 rounded-2xl bg-slate-950 hover:bg-slate-900 text-amber-300 hover:text-white text-xs font-black shadow-md transition flex items-center gap-2">
                        <span>Semak & Luluskan Sekarang →</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Executive Hero Banner -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-sky-950 to-blue-950 text-white p-8 sm:p-10 shadow-xl">
            <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-sky-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-72 h-72 rounded-full bg-cyan-400/10 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-3 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-500/20 border border-sky-400/30 text-sky-300 text-xs font-bold uppercase tracking-widest">
                        AzureVoyage Executive Portal
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                        Welcome Admin, {{ $user->name }}
                    </h1>
                    <p class="text-sky-100/80 text-sm sm:text-base leading-relaxed">
                        Oversee all luxury client itineraries, approve or update booking statuses across the agency, monitor VIP client portfolios, and curate bespoke destinations.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 shrink-0">
                    <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-4 text-center">
                        <span class="block text-xs text-sky-200 uppercase font-semibold">Settled Revenue</span>
                        <span class="text-xl sm:text-2xl font-extrabold text-white mt-1 block">
                            RM {{ number_format($stats['totalRevenue'], 2) }}
                        </span>
                    </div>
                    <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-4 text-center">
                        <span class="block text-xs text-sky-200 uppercase font-semibold">VIP Clients</span>
                        <span class="text-xl sm:text-2xl font-extrabold text-amber-300 mt-1 block">
                            {{ $stats['totalCustomers'] }}
                        </span>
                    </div>
                    <div class="col-span-2 sm:col-span-1 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-4 text-center">
                        <span class="block text-xs text-sky-200 uppercase font-semibold">Destinations</span>
                        <span class="text-xl sm:text-2xl font-extrabold text-cyan-300 mt-1 block">
                            {{ $stats['totalDestinations'] }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Agency KPI Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Total Bookings -->
            <div class="glass-card rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Bookings</span>
                    <span class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs">
                        {{ $stats['totalBookings'] }}
                    </span>
                </div>
                <p class="text-2xl font-extrabold text-slate-900 mt-2">{{ $stats['totalBookings'] }}</p>
                <p class="text-xs text-slate-500 mt-1">All agency records</p>
            </div>

            <!-- Pending Availability Check (Highlighted) -->
            <a href="{{ route('admin.dashboard', ['status' => 'pending_approval']) }}" class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-l-amber-500 bg-amber-50/40 hover:bg-amber-50/70 transition block group">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-800">⏳ Needs Check</span>
                    <span class="w-9 h-9 rounded-xl bg-amber-200 text-amber-900 flex items-center justify-center font-black text-xs {{ $stats['pendingApprovalCount'] > 0 ? 'animate-pulse' : '' }}">
                        {{ $stats['pendingApprovalCount'] }}
                    </span>
                </div>
                <p class="text-2xl font-extrabold text-amber-900 mt-2">{{ $stats['pendingApprovalCount'] }}</p>
                <p class="text-xs text-amber-700 mt-1 font-semibold group-hover:underline">Pending availability check →</p>
            </a>

            <!-- Approved Awaiting Pay -->
            <a href="{{ route('admin.dashboard', ['status' => 'approved']) }}" class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-l-teal-500 bg-teal-50/30 hover:bg-teal-50/60 transition block group">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-teal-800">✨ Approved</span>
                    <span class="w-9 h-9 rounded-xl bg-teal-100 text-teal-900 flex items-center justify-center font-bold text-xs">
                        {{ $stats['approvedCount'] }}
                    </span>
                </div>
                <p class="text-2xl font-extrabold text-teal-900 mt-2">{{ $stats['approvedCount'] }}</p>
                <p class="text-xs text-teal-700 mt-1 font-semibold group-hover:underline">Awaiting payment →</p>
            </a>

            <!-- Upcoming Confirmed Trips -->
            <div class="glass-card rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-sky-600">Upcoming Trips</span>
                    <span class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-xs">
                        {{ $stats['upcomingCount'] }}
                    </span>
                </div>
                <p class="text-2xl font-extrabold text-slate-900 mt-2">{{ $stats['upcomingCount'] }}</p>
                <p class="text-xs text-slate-500 mt-1">Confirmed future departures</p>
            </div>

            <!-- Completed Journeys -->
            <div class="glass-card rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Completed</span>
                    <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                        {{ $stats['completedCount'] }}
                    </span>
                </div>
                <p class="text-2xl font-extrabold text-slate-900 mt-2">{{ $stats['completedCount'] }}</p>
                <p class="text-xs text-slate-500 mt-1">Fulfilled luxury itineraries</p>
            </div>
        </section>

        <!-- All Client Bookings Management -->
        <section id="bookings-management" class="glass-card rounded-3xl shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Global Reservation Desk</span>
                    <h2 class="text-2xl font-extrabold text-slate-900 mt-1">All Client Bookings</h2>
                    <p class="text-sm text-slate-500">Filter, search, and update booking statuses for every traveler across AzureVoyage.</p>
                </div>

                <!-- Filter & Search Bar -->
                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-wrap items-center gap-3">
                    <select name="status" onchange="this.form.submit()" class="rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
                        <option value="all" @selected($status === 'all')>All Statuses ({{ $stats['totalBookings'] }})</option>
                        <option value="pending_approval" @selected($status === 'pending_approval') class="font-bold text-amber-700">⏳ Pending Check ({{ $stats['pendingApprovalCount'] }})</option>
                        <option value="approved" @selected($status === 'approved') class="font-bold text-teal-700">✨ Approved / Ready ({{ $stats['approvedCount'] }})</option>
                        <option value="upcoming" @selected($status === 'upcoming')>Upcoming ({{ $stats['upcomingCount'] }})</option>
                        <option value="ongoing" @selected($status === 'ongoing')>Ongoing ({{ $stats['ongoingCount'] }})</option>
                        <option value="completed" @selected($status === 'completed')>Completed ({{ $stats['completedCount'] }})</option>
                        <option value="rejected" @selected($status === 'rejected')>Rejected ({{ $stats['rejectedCount'] }})</option>
                        <option value="cancelled" @selected($status === 'cancelled')>Cancelled ({{ $stats['cancelledCount'] }})</option>
                    </select>

                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search client, code, destination..."
                            class="w-60 sm:w-72 rounded-xl border border-slate-200 bg-white pl-3.5 pr-9 py-2 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>

                    @if ($status !== 'all' || $search !== '')
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-800 underline">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-3.5 px-6">Package</th>
                            <th class="py-3.5 px-6">Client</th>
                            <th class="py-3.5 px-6">Destination & Title</th>
                            <th class="py-3.5 px-6">Travel Dates</th>
                            <th class="py-3.5 px-6">Tier & Price</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-right">Update Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($vacations as $vacation)
                            <tr class="transition {{ $vacation->status === 'pending_approval' ? 'bg-amber-50/70 hover:bg-amber-100/60 font-semibold' : 'hover:bg-sky-50/30' }}">
                                <td class="py-4 px-6 font-mono text-xs font-bold whitespace-nowrap">
                                    <span class="px-2 py-1 rounded {{ $vacation->status === 'pending_approval' ? 'bg-amber-200 text-amber-950 font-black' : 'text-sky-700' }}">
                                        {{ $vacation->package_code }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900">{{ $vacation->user?->name ?? 'Unknown Client' }}</div>
                                    <div class="text-xs text-slate-500">{{ $vacation->user?->email ?? 'N/A' }}</div>
                                </td>
                                <td class="py-4 px-6 max-w-xs">
                                    <div class="font-bold text-slate-900">{{ $vacation->destination }}</div>
                                    <div class="text-xs text-slate-500 truncate">{{ $vacation->title }}</div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap text-xs text-slate-600">
                                    <div>{{ $vacation->start_date->format('M d, Y') }}</div>
                                    <div class="text-slate-400">to {{ $vacation->end_date->format('M d, Y') }} ({{ $vacation->travelers_count }} {{ Str::plural('guest', $vacation->travelers_count) }})</div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-extrabold text-slate-900">RM {{ number_format((float) $vacation->price, 2) }}</div>
                                    <div class="text-[11px] font-semibold text-amber-600">{{ $vacation->tier }}</div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    @php
                                        $badgeClasses = match ($vacation->status) {
                                            'pending_approval' => 'bg-amber-100 text-amber-900 border-amber-300 font-extrabold shadow-sm',
                                            'approved' => 'bg-teal-100 text-teal-900 border-teal-300 font-extrabold',
                                            'upcoming' => 'bg-sky-100 text-sky-800 border-sky-200',
                                            'ongoing' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                            'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                            'rejected' => 'bg-rose-100 text-rose-800 border-rose-300',
                                            'cancelled' => 'bg-rose-100 text-rose-800 border-rose-200',
                                            default => 'bg-slate-100 text-slate-700 border-slate-200',
                                        };
                                        $statusLabel = match ($vacation->status) {
                                            'pending_approval' => '⏳ Pending Check',
                                            'approved' => '✨ Approved / Ready',
                                            'upcoming' => ($vacation->payment_status === 'paid' ? '✓ Paid & Confirmed' : 'Upcoming'),
                                            'ongoing' => 'Ongoing',
                                            'completed' => 'Completed',
                                            'rejected' => 'Rejected',
                                            'cancelled' => 'Cancelled',
                                            default => ucfirst($vacation->status),
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border {{ $badgeClasses }}">
                                        {{ $statusLabel }}
                                    </span>
                                    @if ($vacation->payment_status === 'paid')
                                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-500 text-white mt-1">
                                            PAID
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap text-right">
                                    @if ($vacation->status === 'pending_approval')
                                        <div class="inline-flex items-center gap-1.5">
                                            <form method="POST" action="{{ route('admin.bookings.approve', $vacation) }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="admin_notes" value="Ketersediaan slot hotel & penerbangan disahkan. Sila buat pembayaran.">
                                                <button
                                                    type="submit"
                                                    class="px-3 py-1.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-xs font-black shadow-sm hover:scale-105 transition flex items-center gap-1"
                                                    title="Sahkan ketersediaan slot hotel & penerbangan"
                                                >
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    <span>Sahkan (Approve)</span>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.bookings.reject', $vacation) }}" class="inline" onsubmit="return confirm('Tolak tempahan ini kerana slot tidak tersedia?');">
                                                @csrf
                                                <input type="hidden" name="admin_notes" value="Slot tidak tersedia pada tarikh yang diminta.">
                                                <button
                                                    type="submit"
                                                    class="px-2.5 py-1.5 rounded-xl border border-rose-300 text-rose-700 hover:bg-rose-50 text-xs font-bold transition"
                                                    title="Tolak tempahan kerana tidak tersedia"
                                                >
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($vacation->payment_status === 'paid')
                                        <div class="inline-flex items-center gap-1.5">
                                            <a
                                                href="{{ route('customer.payment.receipt', $vacation) }}"
                                                target="_blank"
                                                class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition flex items-center gap-1 shadow-sm"
                                            >
                                                <span>👁️ Resit ↗</span>
                                            </a>
                                        </div>
                                    @else
                                        <form method="POST" action="{{ route('admin.vacations.status', $vacation) }}" class="inline-flex items-center gap-2">
                                            @csrf
                                            <select name="status" class="rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                                <option value="pending_approval" @selected($vacation->status === 'pending_approval')>Pending Approval</option>
                                                <option value="approved" @selected($vacation->status === 'approved')>Approved</option>
                                                <option value="upcoming" @selected($vacation->status === 'upcoming')>Upcoming</option>
                                                <option value="ongoing" @selected($vacation->status === 'ongoing')>Ongoing</option>
                                                <option value="completed" @selected($vacation->status === 'completed')>Completed</option>
                                                <option value="cancelled" @selected($vacation->status === 'cancelled')>Cancelled</option>
                                                <option value="rejected" @selected($vacation->status === 'rejected')>Rejected</option>
                                            </select>
                                            <button type="submit" class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-sky-600 text-white text-xs font-semibold transition">
                                                Save
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-500">
                                    No client bookings matched your filter criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Client Directory & Accounts -->
        <section id="clients-directory" class="glass-card rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Member Registry</span>
                <h2 class="text-2xl font-extrabold text-slate-900 mt-1">Registered Accounts & VIP Clients</h2>
                <p class="text-sm text-slate-500">Overview of all portal users, their assigned login role, total bookings, and cumulative luxury spend.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($customers as $account)
                    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm flex flex-col justify-between gap-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="font-bold text-slate-900 text-base">{{ $account->name }}</h3>
                                <p class="text-xs text-slate-500">{{ $account->email }}</p>
                            </div>
                            @if ($account->role === 'admin')
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200 uppercase">
                                    Admin
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-sky-100 text-sky-800 border border-sky-200 uppercase">
                                    Customer
                                </span>
                            @endif
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <div>
                                <span class="text-slate-400 block">Bookings</span>
                                <span class="font-bold text-slate-800 text-sm">{{ $account->vacations_count }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-slate-400 block">Active Portfolio Spend</span>
                                <span class="font-extrabold text-sky-700 text-sm">${{ number_format((float) ($account->total_spend ?? 0), 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Curated Destinations Catalog & Add New Destination -->
        <section id="destinations-catalog" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left 2 Columns: Existing Destinations -->
            <div class="lg:col-span-2 glass-card rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Curated Collection</span>
                        <h2 class="text-2xl font-extrabold text-slate-900 mt-1">Luxury Destinations ({{ $destinations->count() }})</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @forelse ($destinations as $destination)
                        <div class="rounded-2xl border border-slate-200/80 bg-white overflow-hidden shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="h-40 bg-slate-100 relative overflow-hidden">
                                    <img src="{{ $destination->image_path }}" alt="{{ $destination->title }}" class="w-full h-full object-cover">
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-900/80 text-white backdrop-blur-sm">
                                        {{ $destination->badge }}
                                    </span>
                                </div>
                                <div class="p-4 space-y-1.5">
                                    <div class="text-xs font-bold text-sky-600">{{ $destination->location }} • {{ $destination->duration_days }} Days</div>
                                    <h3 class="font-bold text-slate-900 text-base">{{ $destination->title }}</h3>
                                    <p class="text-xs text-slate-500 line-clamp-2">{{ $destination->description }}</p>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                                <span class="font-extrabold text-slate-900 text-sm">${{ number_format((float) $destination->price, 2) }}</span>
                                <form method="POST" action="{{ route('admin.destinations.destroy', $destination) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-800">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 py-8 text-center text-slate-500 text-sm">
                            No destinations in catalog yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Column: Add New Destination Form -->
            <div id="new-destination-form" class="glass-card rounded-3xl p-6 sm:p-8 shadow-sm space-y-5">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Catalog Builder</span>
                    <h3 class="text-xl font-extrabold text-slate-900 mt-1">Publish New Destination</h3>
                    <p class="text-xs text-slate-500">Add a bespoke package visible to customers on their dashboard.</p>
                </div>

                <form method="POST" action="{{ route('admin.destinations.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Package Title</label>
                        <input type="text" name="title" required placeholder="e.g., Amalfi Cliffside Sanctuary" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Location</label>
                        <input type="text" name="location" required placeholder="e.g., Positano, Italy" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Duration (Days)</label>
                            <input type="number" name="duration_days" value="7" min="1" max="60" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Price (USD)</label>
                            <input type="number" step="0.01" name="price" value="6500" min="100" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Badge Label</label>
                        <input type="text" name="badge" placeholder="e.g., VIP Pick" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Image URL (Optional)</label>
                        <input type="url" name="image_path" placeholder="https://images.unsplash.com/..." class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Description</label>
                        <textarea name="description" rows="3" required placeholder="Describe the private yacht charters, villa amenities..." class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
                    </div>

                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <input type="checkbox" name="is_featured" value="1" checked class="rounded text-sky-600 focus:ring-sky-500">
                        Feature on Home & Customer Portal
                    </label>

                    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-bold text-sm shadow-md shadow-sky-500/20 transition">
                        Publish Destination
                    </button>
                </form>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200/80 bg-white py-6 px-4 text-center text-xs text-slate-500 mt-12">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>© {{ date('Y') }} <strong>AzureVoyage</strong> Luxury Travel Agency — Executive Admin Portal</span>
            <span>Branch: <code class="text-sky-700 font-semibold">admin</code></span>
        </div>
    </footer>

    @include('partials.logout-toastr')
</body>
</html>

