<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Portal | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="AzureVoyage Admin Portal — Manage packages, bookings, payments, customers, and reports.">

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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
        }
        @media print {
            header, nav, #quick-actions, .no-print, button, form {
                display: none !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .print-only {
                display: block !important;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top Admin Status Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40 no-print">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-400 text-slate-950 shadow-sm">
                    ⚡ ADMIN COMMAND CENTER
                </span>
                <span class="text-slate-200">
                    Administrator: <strong class="text-white">{{ $user->name }}</strong> ({{ $user->email }})
                </span>
            </div>
            <div class="flex items-center gap-6 text-xs text-sky-200">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Database Sync: <strong>Live</strong>
                </span>
                <span>Role: <strong class="text-amber-300 uppercase tracking-wider">Administrator</strong></span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 glass-nav shadow-sm no-print">
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

                <!-- Navigation Links for 5 Requirements -->
                <nav class="hidden lg:flex items-center gap-5 text-sm font-semibold text-slate-600">
                    <a href="#overview-section" class="hover:text-sky-600 transition">Dashboard</a>
                    <a href="#packages-section" class="hover:text-sky-600 transition">Manage Packages</a>
                    <a href="#bookings-section" class="hover:text-sky-600 transition">Manage Bookings</a>
                    <a href="#payments-section" class="hover:text-sky-600 transition">Manage Payments</a>
                    <a href="#customers-reports-section" class="hover:text-sky-600 transition">Customers & Reports</a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <button onclick="openModal('add-package-modal')" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white text-xs sm:text-sm font-semibold shadow-md shadow-sky-500/20 transition whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Add Package</span>
                    </button>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 text-slate-700 text-xs sm:text-sm font-semibold transition shadow-sm whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 flex items-start gap-3 text-emerald-900 shadow-sm no-print">
                <svg class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm font-semibold">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('info'))
            <div class="rounded-2xl bg-sky-50 border border-sky-200 p-4 flex items-start gap-3 text-sky-900 shadow-sm no-print">
                <svg class="w-5 h-5 text-sky-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm font-semibold">{{ session('info') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl bg-rose-50 border border-rose-200 p-4 text-rose-900 shadow-sm no-print">
                <p class="font-bold text-sm">Please correct the following errors:</p>
                <ul class="list-disc list-inside text-xs mt-1 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ========================================== -->
        <!-- 1. DASHBOARD OVERVIEW & KPIS              -->
        <!-- ========================================== -->
        <section id="overview-section" class="space-y-6">
            <!-- Executive Hero Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-sky-950 to-blue-950 text-white p-8 sm:p-10 shadow-xl">
                <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-sky-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-72 h-72 rounded-full bg-cyan-400/10 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="space-y-3 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-500/20 border border-sky-400/30 text-sky-300 text-xs font-bold uppercase tracking-widest">
                            AzureVoyage Executive Portal
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                            Welcome Admin, 
                        </h1>
                        <p class="text-sky-100/80 text-sm sm:text-base leading-relaxed">
                            Comprehensive travel agency management suite: oversee real-time client reservations, packages catalog, payment settlements, customer histories, and performance analytics.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        <button onclick="openModal('add-package-modal')" class="px-5 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 text-xs sm:text-sm font-bold shadow-lg shadow-sky-500/20 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                             New Package
                        </button>
                    </div>
                </div>
            </div>

            <!-- KPI Cards Specified in Requirements:
                 1. Total Bookings
                 2. Successful Payments Total & Count
                 3. Upcoming Trips
                 4. Completed Trips
                 5. Cancelled Bookings -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Total Bookings -->
                <div class="glass-card rounded-2xl p-5 shadow-sm hover:border-sky-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Bookings</span>
                        <span class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold text-xs">
                            📋
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900 mt-2">{{ $stats['totalBookings'] }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">All customer reservations</p>
                </div>

                <!-- Successful Payments -->
                <div class="glass-card rounded-2xl p-5 shadow-sm hover:border-emerald-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Successful Payments</span>
                        <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                            💳
                        </span>
                    </div>
                    <p class="text-2xl font-extrabold text-emerald-600 mt-2">
                        RM {{ number_format($stats['successfulPaymentsTotal'], 2) }}
                    </p>
                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $stats['successfulPaymentsCount'] }} completed transactions</p>
                </div>

                <!-- Upcoming Trips -->
                <div class="glass-card rounded-2xl p-5 shadow-sm hover:border-indigo-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">Upcoming Trips</span>
                        <span class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs">
                            ✈️
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-indigo-600 mt-2">{{ $stats['upcomingCount'] }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">Confirmed future departures</p>
                </div>

                <!-- Completed Trips -->
                <div class="glass-card rounded-2xl p-5 shadow-sm hover:border-blue-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Completed Trips</span>
                        <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">
                            🌴
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-blue-600 mt-2">{{ $stats['completedCount'] }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">Fulfilled luxury vacations</p>
                </div>

                <!-- Cancelled Bookings -->
                <div class="col-span-2 sm:col-span-1 glass-card rounded-2xl p-5 shadow-sm hover:border-rose-300 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-rose-600">Cancelled Bookings</span>
                        <span class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-xs">
                            ✖️
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-rose-600 mt-2">{{ $stats['cancelledCount'] }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">Revoked / refunded trips</p>
                </div>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 2. MANAGE PACKAGES                        -->
        <!-- ========================================== -->
        <section id="packages-section" class="glass-card rounded-3xl shadow-sm overflow-hidden space-y-6 p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-100 pb-5">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Catalog Operations</span>
                    <h2 class="text-2xl font-extrabold text-slate-900 mt-1">Manage Vacation Packages</h2>
                    <p class="text-sm text-slate-500">Create new travel packages, edit prices, set dates, capacity, amenities, and activate/deactivate packages.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-slate-100 text-slate-700">
                        Total: <strong>{{ $stats['totalDestinations'] }}</strong> ({{ $stats['activeDestinations'] }} Active)
                    </span>
                    <button onclick="openModal('add-package-modal')" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-500 text-white text-xs sm:text-sm font-bold shadow-md transition flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add New Package
                    </button>
                </div>
            </div>

            <!-- Packages Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-3 px-4">Package</th>
                            <th class="py-3 px-4">Location</th>
                            <th class="py-3 px-4">Duration & Capacity</th>
                            <th class="py-3 px-4">Dates</th>
                            <th class="py-3 px-4">Price (RM / Pax)</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($destinations as $pkg)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $pkg->image_path ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=150&q=80' }}" class="w-11 h-11 rounded-xl object-cover shrink-0 border border-slate-200" alt="{{ $pkg->title }}">
                                        <div>
                                            <div class="font-bold text-slate-900">{{ $pkg->title }}</div>
                                            <div class="text-[11px] text-sky-600 font-semibold">{{ $pkg->badge ?: 'Package' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-xs font-semibold text-slate-700 whitespace-nowrap">
                                    {{ $pkg->location }}
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-600 whitespace-nowrap">
                                    <div><strong>{{ $pkg->duration_days }}</strong> Days</div>
                                    <div class="text-slate-400">Max {{ $pkg->capacity ?? 2 }} Guests</div>
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-600 whitespace-nowrap">
                                    @if ($pkg->start_date && $pkg->end_date)
                                        <div><span class="text-slate-400 font-medium">Start:</span> <span class="font-bold text-slate-800">{{ $pkg->start_date->format('M d, Y') }}</span></div>
                                        <div class="mt-0.5"><span class="text-slate-400 font-medium">End:</span> <span class="font-bold text-slate-800">{{ $pkg->end_date->format('M d, Y') }}</span></div>
                                    @else
                                        <span class="text-slate-400 italic">Open Booking</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 font-extrabold text-slate-900 whitespace-nowrap">
                                    RM {{ number_format((float) $pkg->price, 2) }}
                                    <span class="text-[10px] font-normal text-slate-400 block">per person</span>
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    @if ($pkg->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            ● Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        <!-- Edit Button -->
                                        <button
                                            type="button"
                                            onclick='openEditPackageModal(@json($pkg))'
                                            class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 text-xs font-bold transition shadow-sm"
                                            title="Edit package info and price"
                                        >
                                            Edit
                                        </button>

                                        <!-- Toggle Active/Inactive -->
                                        <form method="POST" action="{{ route('admin.destinations.toggle', $pkg) }}" class="inline">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition shadow-sm {{ $pkg->is_active ? 'bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' }}"
                                                title="{{ $pkg->is_active ? 'Deactivate this package' : 'Activate this package' }}"
                                            >
                                                {{ $pkg->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <!-- Delete -->
                                        <form method="POST" action="{{ route('admin.destinations.destroy', $pkg) }}" class="inline" onsubmit="return confirm('Remove package {{ addslashes($pkg->title) }} from catalog?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Delete package">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-slate-500">
                                    No vacation packages found in database catalog. Click "Add New Package" above to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 3. MANAGE BOOKINGS                        -->
        <!-- ========================================== -->
        <section id="bookings-section" class="glass-card rounded-3xl shadow-sm overflow-hidden space-y-6 p-6 sm:p-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 border-b border-slate-100 pb-5">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Global Reservations</span>
                    <h2 class="text-2xl font-extrabold text-slate-900 mt-1">All Client Bookings</h2>
                    <p class="text-sm text-slate-500">View all customer bookings, package details, verify payment status, search by booking code or customer name, and update trip status.</p>
                </div>

                <!-- Search & Status Filter Form -->
                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-wrap items-center gap-3">
                    <select name="status" onchange="this.form.submit()" class="rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
                        <option value="all" @selected($status === 'all')>All Bookings ({{ $stats['totalBookings'] }})</option>
                        <option value="upcoming" @selected($status === 'upcoming')>Upcoming Escapes ({{ $stats['upcomingCount'] }})</option>
                        <option value="completed" @selected($status === 'completed')>Completed Trips ({{ $stats['completedCount'] }})</option>
                        <option value="cancelled" @selected($status === 'cancelled')>Cancelled ({{ $stats['cancelledCount'] }})</option>
                    </select>

                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search booking ID or customer name..."
                            class="w-64 sm:w-72 rounded-xl border border-slate-200 bg-white pl-3.5 pr-9 py-2 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>

                    @if ($status !== 'all' || $search !== '')
                        <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-800 underline">
                            Reset Filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- Bookings Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-3.5 px-4">Booking ID</th>
                            <th class="py-3.5 px-4">Customer</th>
                            <th class="py-3.5 px-4">Package & Destination</th>
                            <th class="py-3.5 px-4">Travel Dates</th>
                            <th class="py-3.5 px-4">Tier & Price</th>
                            <th class="py-3.5 px-4">Booking Status</th>
                            <th class="py-3.5 px-4">Payment Status</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($vacations as $vacation)
                            <tr class="hover:bg-sky-50/30 transition">
                                <td class="py-4 px-4 font-mono text-xs font-bold whitespace-nowrap">
                                    <span class="px-2 py-1 rounded bg-slate-100 text-slate-800 border border-slate-200">
                                        {{ $vacation->package_code }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-bold text-slate-900">{{ $vacation->user?->name ?? 'Guest User' }}</div>
                                    <div class="text-xs text-slate-500">{{ $vacation->user?->email ?? 'N/A' }}</div>
                                    @if ($vacation->user?->phone)
                                        <div class="text-[11px] text-slate-400">{{ $vacation->user->phone }}</div>
                                    @endif
                                </td>
                                <td class="py-4 px-4 max-w-xs">
                                    <div class="font-bold text-slate-900">{{ $vacation->destination }}</div>
                                    <div class="text-xs text-slate-500 truncate">{{ $vacation->title }}</div>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-xs text-slate-600">
                                    <div>{{ $vacation->start_date ? $vacation->start_date->format('M d, Y') : 'N/A' }}</div>
                                    <div class="text-slate-400">to {{ $vacation->end_date ? $vacation->end_date->format('M d, Y') : 'N/A' }} ({{ $vacation->travelers_count }} {{ Str::plural('guest', $vacation->travelers_count) }})</div>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <div class="font-extrabold text-slate-900">RM {{ number_format((float) $vacation->price, 2) }}</div>
                                    <div class="text-[11px] font-semibold text-amber-600">{{ $vacation->tier ?: 'VIP Sovereign' }}</div>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @php
                                        $bookingBadge = match ($vacation->status) {
                                            'upcoming', 'pending', 'pending_approval' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                            'approved' => 'bg-sky-100 text-sky-800 border-sky-200',
                                            'ongoing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'completed' => 'bg-purple-100 text-purple-800 border-purple-200',
                                            'cancelled', 'rejected' => 'bg-rose-100 text-rose-800 border-rose-200',
                                            default => 'bg-slate-100 text-slate-700 border-slate-200',
                                        };
                                        $bookingLabel = match ($vacation->status) {
                                            'upcoming', 'pending', 'pending_approval' => 'Upcoming',
                                            'approved' => 'Approved',
                                            'ongoing' => 'Ongoing',
                                            'completed' => 'Completed',
                                            'cancelled', 'rejected' => 'Cancelled',
                                            default => ucfirst($vacation->status),
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $bookingBadge }}">
                                        {{ $bookingLabel }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @if ($vacation->payment_status === 'paid' || $vacation->latestPayment?->status === 'completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            ✓ Paid
                                        </span>
                                    @elseif ($vacation->payment_status === 'refunded')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            Refunded
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                            Unpaid
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-right whitespace-nowrap">
                                    <button
                                        type="button"
                                        onclick='openBookingDetailsModal(@json($vacation), @json($vacation->user), @json($vacation->latestPayment))'
                                        class="px-3.5 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-sky-50 hover:text-sky-700 hover:border-sky-300 text-slate-700 text-xs font-bold transition shadow-sm inline-flex items-center gap-1.5"
                                    >
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-10 text-center text-slate-500">
                                    No customer bookings matched your search or status filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 4. MANAGE PAYMENTS                        -->
        <!-- ========================================== -->
        <section id="payments-section" class="glass-card rounded-3xl shadow-sm overflow-hidden space-y-6 p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-100 pb-5">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Financial Ledger</span>
                    <h2 class="text-2xl font-extrabold text-slate-900 mt-1">Manage Payment Records & Refunds</h2>
                    <p class="text-sm text-slate-500">Review all customer payment transactions, transaction reference codes, paid amounts, timestamps, view digital receipts, and manage refunds.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Total Settled: <strong>RM {{ number_format($stats['successfulPaymentsTotal'], 2) }}</strong>
                    </span>
                </div>
            </div>

            <!-- Payments Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-3 px-4">Transaction Reference</th>
                            <th class="py-3 px-4">Customer</th>
                            <th class="py-3 px-4">Package & Code</th>
                            <th class="py-3 px-4">Payment Method</th>
                            <th class="py-3 px-4">Amount (RM)</th>
                            <th class="py-3 px-4">Transaction Date</th>
                            <th class="py-3 px-4">Payment Status</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($payments as $payment)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-3.5 px-4 font-mono text-xs font-bold text-slate-800 whitespace-nowrap">
                                    {{ $payment->transaction_reference }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-900">{{ $payment->user?->name ?? 'Customer' }}</div>
                                    <div class="text-xs text-slate-500">{{ $payment->user?->email }}</div>
                                </td>
                                <td class="py-3.5 px-4 max-w-xs truncate">
                                    <div class="font-bold text-slate-900">{{ $payment->vacation?->destination ?? 'Luxury Package' }}</div>
                                    <div class="text-xs text-sky-600 font-mono">{{ $payment->vacation?->package_code ?? 'N/A' }}</div>
                                </td>
                                <td class="py-3.5 px-4 text-xs font-semibold text-slate-700 whitespace-nowrap">
                                    <div class="uppercase">{{ $payment->payment_method ?: 'FPX' }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $payment->bank_name ?: 'Online Banking' }}</div>
                                </td>
                                <td class="py-3.5 px-4 font-extrabold text-slate-900 whitespace-nowrap">
                                    RM {{ number_format((float) $payment->amount, 2) }}
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-600 whitespace-nowrap">
                                    {{ $payment->paid_at ? $payment->paid_at->format('M d, Y H:i') : ($payment->created_at ? $payment->created_at->format('M d, Y H:i') : 'N/A') }}
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    @if ($payment->status === 'completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            ✓ Completed
                                        </span>
                                    @elseif ($payment->status === 'refunded')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                            Refunded
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        @if ($payment->vacation_id)
                                            <a
                                                href="{{ route('customer.payment.receipt', $payment->vacation_id) }}"
                                                target="_blank"
                                                class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-sky-700 text-xs font-bold transition shadow-sm flex items-center gap-1"
                                                title="View official digital invoice/receipt"
                                            >
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Receipt
                                            </a>
                                        @endif

                                        @if ($payment->status === 'completed')
                                            <form method="POST" action="{{ route('admin.payments.refund', $payment) }}" class="inline" onsubmit="return confirm('Process refund for RM {{ number_format((float) $payment->amount, 2) }} (Transaction {{ $payment->transaction_reference }})? This will cancel the booking.')">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100 text-xs font-bold transition shadow-sm">
                                                    Refund
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-slate-500">
                                    No payment records found in database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 5. MANAGE CUSTOMERS & REPORTS             -->
        <!-- ========================================== -->
        <section id="customers-reports-section" class="space-y-8">
            <!-- Section Header -->
            <div class="border-b border-slate-200 pb-4">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Clientele & Analytics</span>
                <h2 class="text-2xl font-extrabold text-slate-900 mt-1">Manage Customers & Executive Reports</h2>
                <p class="text-sm text-slate-500">View registered customer profiles, inspect their booking histories, and analyze booking reports, revenue, and top popular packages.</p>
            </div>

            <!-- Customer List Directory -->
            <div class="glass-card rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Registered Customers Registry</h3>
                        <p class="text-xs text-slate-500">Total registered clients: {{ $stats['totalCustomers'] }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($customers as $account)
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm flex flex-col justify-between gap-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-slate-900 text-base">{{ $account->name }}</h4>
                                    <p class="text-xs text-slate-500">{{ $account->email }}</p>
                                    @if ($account->phone)
                                        <p class="text-[11px] text-slate-400 mt-0.5">📞 {{ $account->phone }}</p>
                                    @endif
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
                                    <span class="text-slate-400 block">Total Bookings</span>
                                    <span class="font-bold text-slate-800 text-sm">{{ $account->vacations_count }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-slate-400 block">Cumulative Spend</span>
                                    <span class="font-extrabold text-sky-700 text-sm">RM {{ number_format((float) ($account->total_spend ?? 0), 2) }}</span>
                                </div>
                            </div>

                            <button
                                type="button"
                                onclick='openCustomerHistoryModal(@json($account), @json($account->relationLoaded("vacations") ? $account->vacations : []))'
                                class="w-full py-2 rounded-xl border border-slate-200 bg-slate-50 hover:bg-sky-50 hover:text-sky-700 hover:border-sky-300 text-slate-700 text-xs font-bold transition flex items-center justify-center gap-1.5"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                View Booking History ({{ $account->vacations_count }})
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Executive Performance Reports -->
            <div id="executive-reports-container" class="glass-card rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-100 pb-5">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Analytics & Insights</span>
                        <h3 class="text-xl font-extrabold text-slate-900 mt-0.5">Booking, Revenue & Popular Packages Report</h3>
                        <p class="text-xs text-slate-500">Detailed breakdown of reservations, revenue distribution, and the top performing destination packages.</p>
                    </div>
                    <button onclick="window.print()" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-sky-600 text-white text-xs sm:text-sm font-bold shadow-md transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Print / Export Report
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Bookings Distribution -->
                    <div class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 space-y-4">
                        <h4 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Bookings Distribution</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between text-xs font-bold text-slate-700 mb-1">
                                    <span>Upcoming Trips</span>
                                    <span>{{ $stats['upcomingCount'] }} ({{ $stats['totalBookings'] > 0 ? round(($stats['upcomingCount'] / $stats['totalBookings']) * 100) : 0 }}%)</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-slate-200 overflow-hidden">
                                    <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $stats['totalBookings'] > 0 ? ($stats['upcomingCount'] / $stats['totalBookings']) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs font-bold text-slate-700 mb-1">
                                    <span>Completed Trips</span>
                                    <span>{{ $stats['completedCount'] }} ({{ $stats['totalBookings'] > 0 ? round(($stats['completedCount'] / $stats['totalBookings']) * 100) : 0 }}%)</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-slate-200 overflow-hidden">
                                    <div class="h-full bg-blue-500 rounded-full" style="width: {{ $stats['totalBookings'] > 0 ? ($stats['completedCount'] / $stats['totalBookings']) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs font-bold text-slate-700 mb-1">
                                    <span>Cancelled Trips</span>
                                    <span>{{ $stats['cancelledCount'] }} ({{ $stats['totalBookings'] > 0 ? round(($stats['cancelledCount'] / $stats['totalBookings']) * 100) : 0 }}%)</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-slate-200 overflow-hidden">
                                    <div class="h-full bg-rose-500 rounded-full" style="width: {{ $stats['totalBookings'] > 0 ? ($stats['cancelledCount'] / $stats['totalBookings']) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Overview -->
                    <div class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 space-y-4">
                        <h4 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Revenue Summary</h4>
                        <div class="space-y-3">
                            <div class="p-4 rounded-xl bg-white border border-slate-200">
                                <span class="text-xs text-slate-400 block font-semibold">Total Settled Revenue</span>
                                <span class="text-2xl font-extrabold text-emerald-600 block mt-1">RM {{ number_format($stats['successfulPaymentsTotal'], 2) }}</span>
                                <span class="text-[11px] text-slate-500 mt-0.5 block">From {{ $stats['successfulPaymentsCount'] }} settled customer payments</span>
                            </div>
                            <div class="p-4 rounded-xl bg-white border border-slate-200">
                                <span class="text-xs text-slate-400 block font-semibold">Average Value per Booking</span>
                                @php
                                    $avgValue = $stats['totalBookings'] > 0 ? $stats['totalRevenue'] / $stats['totalBookings'] : 0;
                                @endphp
                                <span class="text-xl font-extrabold text-slate-900 block mt-1">RM {{ number_format($avgValue, 2) }}</span>
                                <span class="text-[11px] text-slate-500 mt-0.5 block">Across {{ $stats['totalBookings'] }} total reservations</span>
                            </div>
                        </div>
                    </div>

                    <!-- Most Popular Packages -->
                    <div class="rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 space-y-4">
                        <h4 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Top Popular Packages</h4>
                        <div class="space-y-2">
                            @forelse ($popularPackages as $index => $popular)
                                <div class="flex items-center justify-between p-3 rounded-xl bg-white border border-slate-200 text-xs">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-6 h-6 rounded-lg bg-sky-100 text-sky-800 font-black flex items-center justify-center shrink-0">
                                            #{{ $index + 1 }}
                                        </span>
                                        <div>
                                            <div class="font-bold text-slate-900 truncate max-w-[140px]">{{ $popular->destination }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $popular->booking_count }} {{ Str::plural('booking', $popular->booking_count) }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right font-extrabold text-slate-900">
                                        RM {{ number_format((float) $popular->total_revenue, 2) }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-xs text-slate-500">
                                    No booking transactions recorded yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ========================================== -->
    <!-- MODALS SECTION                             -->
    <!-- ========================================== -->

    <!-- Add Package Modal -->
    <div id="add-package-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="relative bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl my-8">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-900">Add New Vacation Package</h3>
                    <p class="text-xs text-slate-500">Publish a new luxury package with capacity, dates, and amenities.</p>
                </div>
                <button type="button" onclick="closeModal('add-package-modal')" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                    ✕
                </button>
            </div>

            <form method="POST" action="{{ route('admin.destinations.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Package Title *</label>
                        <input type="text" name="title" required placeholder="e.g., Amalfi Cliffside Sanctuary" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Location *</label>
                        <input type="text" name="location" required placeholder="e.g., Positano, Italy" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Duration (Days) *</label>
                        <input type="number" name="duration_days" value="7" min="1" max="60" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Capacity (Max Guests) *</label>
                        <input type="number" name="capacity" value="2" min="1" max="50" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Price / Guest (RM) *</label>
                        <input type="number" step="0.01" name="price" value="12000" min="0" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Available Start Date</label>
                        <input type="date" name="start_date" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Available End Date</label>
                        <input type="date" name="end_date" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Badge Label</label>
                        <input type="text" name="badge" placeholder="e.g., Best Seller, Exclusive" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Image URL</label>
                        <input type="url" name="image_path" placeholder="https://images.unsplash.com/..." class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Description *</label>
                    <textarea name="description" rows="3" required placeholder="Details about this luxury escape..." class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded text-sky-600 focus:ring-sky-500">
                        Active (Visible for Booking)
                    </label>
                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <input type="checkbox" name="is_featured" value="1" checked class="rounded text-sky-600 focus:ring-sky-500">
                        Featured Package
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeModal('add-package-modal')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-xs hover:bg-slate-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-md transition">
                        Publish Package
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Package Modal -->
    <div id="edit-package-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="relative bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl my-8">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-900">Edit Package Details</h3>
                    <p class="text-xs text-slate-500">Update package information, pricing, capacity, dates, and amenities.</p>
                </div>
                <button type="button" onclick="closeModal('edit-package-modal')" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                    ✕
                </button>
            </div>

            <form id="edit-package-form" method="POST" action="" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Package Title *</label>
                        <input type="text" id="edit-title" name="title" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Location *</label>
                        <input type="text" id="edit-location" name="location" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Duration (Days) *</label>
                        <input type="number" id="edit-duration" name="duration_days" min="1" max="60" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Capacity (Max Guests) *</label>
                        <input type="number" id="edit-capacity" name="capacity" min="1" max="50" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Price / Guest (RM) *</label>
                        <input type="number" step="0.01" id="edit-price" name="price" min="0" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Available Start Date</label>
                        <input type="date" id="edit-start-date" name="start_date" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Available End Date</label>
                        <input type="date" id="edit-end-date" name="end_date" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Badge Label</label>
                        <input type="text" id="edit-badge" name="badge" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Image URL</label>
                        <input type="url" id="edit-image" name="image_path" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Description *</label>
                    <textarea id="edit-description" name="description" rows="3" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                        <input type="checkbox" id="edit-is-active" name="is_active" value="1" class="rounded text-sky-600 focus:ring-sky-500">
                        Active (Visible for Booking)
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeModal('edit-package-modal')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-xs hover:bg-slate-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-md transition">
                        Update Package
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div id="booking-details-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="relative bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl my-8 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <span id="detail-code-badge" class="px-2 py-0.5 rounded text-xs font-mono font-bold bg-sky-100 text-sky-800"></span>
                    <h3 class="text-xl font-extrabold text-slate-900 mt-1">Reservation & Client Details</h3>
                </div>
                <button type="button" onclick="closeModal('booking-details-modal')" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                    ✕
                </button>
            </div>

            <!-- Customer & Trip Details Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                    <span class="font-bold text-slate-400 uppercase tracking-wider block">Customer Information</span>
                    <div>
                        <span class="text-slate-500 block">Name:</span>
                        <strong id="detail-customer-name" class="text-slate-900 text-sm"></strong>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Email:</span>
                        <span id="detail-customer-email" class="text-slate-800 font-medium"></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Phone:</span>
                        <span id="detail-customer-phone" class="text-slate-800 font-medium"></span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                    <span class="font-bold text-slate-400 uppercase tracking-wider block">Package Information</span>
                    <div>
                        <span class="text-slate-500 block">Destination:</span>
                        <strong id="detail-destination" class="text-slate-900 text-sm"></strong>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Title:</span>
                        <span id="detail-title" class="text-slate-800 font-medium"></span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Dates & Guests:</span>
                        <span id="detail-dates" class="text-slate-800 font-medium"></span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="font-bold text-slate-400 uppercase tracking-wider block">Booking & Payment Status</span>
                    <div>Status: <span id="detail-status" class="font-bold"></span></div>
                    <div>Payment: <span id="detail-payment-status" class="font-bold"></span></div>
                    <div>Tier: <span id="detail-tier" class="font-semibold text-amber-700"></span></div>
                    <div>Total Price: <strong id="detail-price" class="text-slate-900 text-sm"></strong></div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="font-bold text-slate-400 uppercase tracking-wider block">Transaction Info</span>
                    <div>Ref: <code id="detail-txn-ref" class="font-mono text-slate-800"></code></div>
                    <div>Method: <span id="detail-txn-method"></span></div>
                    <div id="detail-receipt-container" class="pt-1"></div>
                </div>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider block">Client Concierge Notes</span>
                <p id="detail-notes" class="text-slate-700 italic"></p>
            </div>

            <div class="flex justify-end pt-3 border-t border-slate-100">
                <button type="button" onclick="closeModal('booking-details-modal')" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition">
                    Close Details
                </button>
            </div>
        </div>
    </div>

    <!-- Customer Booking History Modal -->
    <div id="customer-history-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="relative bg-white rounded-3xl max-w-3xl w-full p-6 sm:p-8 shadow-2xl my-8 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 id="history-customer-name" class="text-xl font-extrabold text-slate-900"></h3>
                    <p id="history-customer-email" class="text-xs text-slate-500"></p>
                </div>
                <button type="button" onclick="closeModal('customer-history-modal')" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                    ✕
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase font-bold tracking-wider">
                            <th class="py-2.5 px-3">Booking Code</th>
                            <th class="py-2.5 px-3">Destination</th>
                            <th class="py-2.5 px-3">Dates</th>
                            <th class="py-2.5 px-3">Price (RM)</th>
                            <th class="py-2.5 px-3">Status</th>
                            <th class="py-2.5 px-3 text-right">Receipt</th>
                        </tr>
                    </thead>
                    <tbody id="history-table-body" class="divide-y divide-slate-100">
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end pt-3 border-t border-slate-100">
                <button type="button" onclick="closeModal('customer-history-modal')" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-slate-200/80 bg-white py-6 px-4 text-center text-xs text-slate-500 mt-12 no-print">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>© {{ date('Y') }} <strong>AzureVoyage</strong> Luxury Travel Agency — Executive Admin Portal</span>
            <span>All systems synchronized with database</span>
        </div>
    </footer>

    <!-- JavaScript Helpers for Modals & Data Binding -->
    <script>
        function openModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.remove('hidden');
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.add('hidden');
        }

        function openEditPackageModal(pkg) {
            const form = document.getElementById('edit-package-form');
            form.action = `/admin/destinations/${pkg.id}`;

            document.getElementById('edit-title').value = pkg.title || '';
            document.getElementById('edit-location').value = pkg.location || '';
            document.getElementById('edit-duration').value = pkg.duration_days || 7;
            document.getElementById('edit-capacity').value = pkg.capacity || 2;
            document.getElementById('edit-price').value = pkg.price || 0;
            document.getElementById('edit-start-date').value = pkg.start_date ? pkg.start_date.substring(0, 10) : '';
            document.getElementById('edit-end-date').value = pkg.end_date ? pkg.end_date.substring(0, 10) : '';
            document.getElementById('edit-badge').value = pkg.badge || '';
            document.getElementById('edit-image').value = pkg.image_path || '';
            document.getElementById('edit-description').value = pkg.description || '';
            document.getElementById('edit-is-active').checked = !!pkg.is_active;

            openModal('edit-package-modal');
        }

        function openBookingDetailsModal(vacation, user, payment) {
            document.getElementById('detail-code-badge').textContent = vacation.package_code || 'N/A';
            document.getElementById('detail-customer-name').textContent = user ? user.name : 'Guest User';
            document.getElementById('detail-customer-email').textContent = user ? user.email : 'N/A';
            document.getElementById('detail-customer-phone').textContent = (user && user.phone) ? user.phone : 'Not provided';

            document.getElementById('detail-destination').textContent = vacation.destination || 'N/A';
            document.getElementById('detail-title').textContent = vacation.title || 'N/A';
            document.getElementById('detail-dates').textContent = `${vacation.start_date ? vacation.start_date.substring(0, 10) : 'N/A'} to ${vacation.end_date ? vacation.end_date.substring(0, 10) : 'N/A'} (${vacation.travelers_count || 1} guests)`;

            document.getElementById('detail-status').textContent = vacation.status ? vacation.status.toUpperCase() : 'UNKNOWN';
            document.getElementById('detail-payment-status').textContent = vacation.payment_status ? vacation.payment_status.toUpperCase() : 'UNPAID';
            document.getElementById('detail-tier').textContent = vacation.tier || 'VIP Sovereign';
            document.getElementById('detail-price').textContent = `RM ${parseFloat(vacation.price || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}`;

            document.getElementById('detail-txn-ref').textContent = payment ? payment.transaction_reference : (vacation.payment_status === 'paid' ? 'SETTLED' : 'None');
            document.getElementById('detail-txn-method').textContent = payment ? `${payment.payment_method || 'Online'} (${payment.bank_name || 'N/A'})` : 'N/A';

            const receiptContainer = document.getElementById('detail-receipt-container');
            if (vacation.id) {
                receiptContainer.innerHTML = `<a href="/customer/bookings/${vacation.id}/receipt" target="_blank" class="text-sky-600 hover:underline font-bold">View Official Receipt ↗</a>`;
            } else {
                receiptContainer.innerHTML = '';
            }

            document.getElementById('detail-notes').textContent = vacation.notes ? `"${vacation.notes}"` : 'No concierge requests submitted.';

            openModal('booking-details-modal');
        }

        function openCustomerHistoryModal(account, vacations) {
            document.getElementById('history-customer-name').textContent = `${account.name}'s Booking History`;
            document.getElementById('history-customer-email').textContent = `${account.email} • Total Bookings: ${vacations.length}`;

            const tbody = document.getElementById('history-table-body');
            tbody.innerHTML = '';

            if (!vacations || vacations.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="py-6 text-center text-slate-500">No booking history recorded for this customer yet.</td></tr>';
            } else {
                vacations.forEach(v => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-slate-50 transition';
                    const priceFormatted = parseFloat(v.price || 0).toLocaleString(undefined, {minimumFractionDigits: 2});
                    const dates = `${v.start_date ? v.start_date.substring(0, 10) : 'N/A'} - ${v.end_date ? v.end_date.substring(0, 10) : 'N/A'}`;
                    const receiptBtn = v.id ? `<a href="/customer/bookings/${v.id}/receipt" target="_blank" class="px-2 py-1 rounded bg-sky-50 text-sky-700 font-bold hover:bg-sky-100">Receipt</a>` : '-';
                    tr.innerHTML = `
                        <td class="py-2.5 px-3 font-mono font-bold text-slate-800">${v.package_code}</td>
                        <td class="py-2.5 px-3 font-semibold text-slate-900">${v.destination}</td>
                        <td class="py-2.5 px-3 text-slate-600">${dates}</td>
                        <td class="py-2.5 px-3 font-bold text-slate-900">RM ${priceFormatted}</td>
                        <td class="py-2.5 px-3 font-bold ${v.status === 'completed' ? 'text-emerald-600' : (v.status === 'cancelled' ? 'text-rose-600' : 'text-sky-600')}">${v.status.toUpperCase()}</td>
                        <td class="py-2.5 px-3 text-right">${receiptBtn}</td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            openModal('customer-history-modal');
        }
    </script>

    @include('partials.logout-toastr')
</body>
</html>
