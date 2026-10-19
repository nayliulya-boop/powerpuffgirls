<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AzureVoyage | Premium Luxury Travel Agency & Global Escapes</title>
    <meta name="description" content="Discover breathtaking bespoke travel packages, island getaways, luxury cruises, and alpine adventures with AzureVoyage. Your dream journey begins here.">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite compiled assets (run `npm run build` to generate) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .bg-mesh-blue {
            background-color: #f0f7ff;
            background-image:
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(224, 242, 254, 0.6) 0px, transparent 50%);
        }
        .hero-gradient-overlay {
            background: linear-gradient(180deg, rgba(7, 24, 53, 0.55) 0%, rgba(11, 27, 60, 0.75) 100%);
        }
        /* Glassmorphism Nav */
        .glass-nav {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.8);
        }
        /* Glassmorphism Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(224, 242, 254, 0.9);
        }
        .glass-card-hover {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -10px rgba(2, 132, 199, 0.15), 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        /* Card shadows */
        .travel-shadow {
            box-shadow: 0 10px 30px -5px rgba(2, 132, 199, 0.08), 0 4px 6px -2px rgba(15, 23, 42, 0.03);
        }
        .travel-shadow-lg {
            box-shadow: 0 20px 40px -12px rgba(2, 132, 199, 0.16), 0 8px 16px -4px rgba(15, 23, 42, 0.04);
        }
        /* Gradient text */
        .text-gradient-azure {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 50%, #0369a1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 text-white text-xs sm:text-sm py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                    Special Offer
                </span>
                <span>✨ Save up to <strong>30%</strong> on Summer Island Escapes with code <strong class="underline decoration-sky-300">AZURE2026</strong></span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-100">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    24/7 Concierge: +1 (800) 429-8732
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    IATA & ATOL Protected
                </span>
            </div>
        </div>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
                            <!-- Modern Compass / Wings SVG Icon -->
                            <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center gap-1">
                                Azure<span class="text-sky-600">Voyage</span>
                            </span>
                            <span class="block text-[10px] uppercase tracking-widest font-semibold text-sky-600 -mt-1">
                                Luxury Travel Agency
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-sky-600 font-semibold transition hover:text-sky-700 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('about') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>About</span>
                    </a>
                    <a href="{{ route('customer') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Customer</span>
                    </a>
                </nav>

                <!-- Actions / Login -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ url('/login') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl font-semibold text-sm text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 shadow-md shadow-sky-500/20 hover:shadow-lg hover:shadow-sky-500/30 transition-all duration-200 transform hover:-translate-y-0.5 gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        <span>Login</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="p-2.5 rounded-xl text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition" aria-label="Toggle Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-sky-100 bg-white/95 backdrop-blur-lg px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-semibold text-sky-600 bg-sky-50">
                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Home</span>
            </a>
            <a href="{{ route('about') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>About</span>
            </a>
            <a href="{{ route('customer') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span>Customer</span>
            </a>
            <div class="pt-3 border-t border-slate-100">
                <a href="{{ url('/login') }}" class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 shadow-md shadow-sky-500/20 transition gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <span>Login</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-[640px] lg:min-h-[720px] flex items-center justify-center overflow-hidden">
        <!-- Hero Background Image with Subtle Parallax / Contrast -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/travel/maldives.jpg') }}" alt="Tropical Maldives Resort Ocean" class="w-full h-full object-cover object-center scale-105 transition-transform duration-1000 ease-out">
            <div class="absolute inset-0 hero-gradient-overlay"></div>
            <!-- Decorative Light Blur Accent -->
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-sky-400/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-white text-xs sm:text-sm font-medium mb-6 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                <span>The Leading White & Blue Luxury Escape Network</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight max-w-4xl mx-auto drop-shadow-sm">
                Where Blue Skies Meet <br class="hidden sm:inline"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-300 via-cyan-200 to-white">
                    Crystal Ocean Horizons
                </span>
            </h1>

            <p class="mt-6 text-lg sm:text-xl text-sky-100/90 max-w-2xl mx-auto font-light leading-relaxed">
                Handcrafted luxury holidays, secluded overwater villas, private yacht expeditions, and bespoke global journeys tailored to your soul.
            </p>

            <!-- Search Console Widget Container -->
            <div id="search-section" class="mt-10 max-w-5xl mx-auto">
                <div class="glass-card rounded-3xl p-4 sm:p-6 travel-shadow-lg border border-white/60 text-left">
                    <!-- Category Tabs -->
                    <div class="flex items-center gap-2 sm:gap-4 border-b border-sky-100 pb-4 mb-5 overflow-x-auto">
                        <button type="button" class="search-tab active px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-2 bg-sky-600 text-white shadow-sm" data-tab="packages">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Holiday Packages</span>
                        </button>
                        <button type="button" class="search-tab px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-2 text-slate-600 hover:bg-sky-50 hover:text-sky-700" data-tab="flights">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            <span>Flights</span>
                        </button>
                        <button type="button" class="search-tab px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-2 text-slate-600 hover:bg-sky-50 hover:text-sky-700" data-tab="stays">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Luxury Stays</span>
                        </button>
                        <button type="button" class="search-tab px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-2 text-slate-600 hover:bg-sky-50 hover:text-sky-700" data-tab="cruises">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span>Yacht & Cruise</span>
                        </button>
                    </div>

                    <!-- Search Form -->
                    <form action="#packages" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Destination Field -->
                        <div class="relative bg-slate-50/80 rounded-2xl p-3 border border-sky-100 hover:border-sky-300 transition focus-within:border-sky-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-sky-100">
                            <label class="block text-xs font-semibold uppercase tracking-wider text-sky-800">Destination</label>
                            <div class="flex items-center mt-1">
                                <svg class="w-5 h-5 text-sky-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <select class="w-full bg-transparent text-sm font-medium text-slate-900 focus:outline-none">
                                    <option value="maldives">Maldives (Overwater Paradise)</option>
                                    <option value="santorini">Santorini, Greece</option>
                                    <option value="swiss">Swiss Alps & Lakes</option>
                                    <option value="mediterranean">Mediterranean Yacht Voyage</option>
                                    <option value="kyoto">Kyoto & Tokyo, Japan</option>
                                    <option value="amalfi">Amalfi Coast, Italy</option>
                                </select>
                            </div>
                        </div>

                        <!-- Departure Date -->
                        <div class="relative bg-slate-50/80 rounded-2xl p-3 border border-sky-100 hover:border-sky-300 transition focus-within:border-sky-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-sky-100">
                            <label class="block text-xs font-semibold uppercase tracking-wider text-sky-800">Check In / Departure</label>
                            <div class="flex items-center mt-1">
                                <svg class="w-5 h-5 text-sky-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <input type="date" value="2026-06-15" class="w-full bg-transparent text-sm font-medium text-slate-900 focus:outline-none">
                            </div>
                        </div>

                        <!-- Duration / Return Date -->
                        <div class="relative bg-slate-50/80 rounded-2xl p-3 border border-sky-100 hover:border-sky-300 transition focus-within:border-sky-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-sky-100">
                            <label class="block text-xs font-semibold uppercase tracking-wider text-sky-800">Return Date</label>
                            <div class="flex items-center mt-1">
                                <svg class="w-5 h-5 text-sky-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <input type="date" value="2026-06-22" class="w-full bg-transparent text-sm font-medium text-slate-900 focus:outline-none">
                            </div>
                        </div>

                        <!-- Guests & Submit -->
                        <div class="flex flex-col gap-2">
                            <div class="relative bg-slate-50/80 rounded-2xl p-3 border border-sky-100 hover:border-sky-300 transition focus-within:border-sky-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-sky-100">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-sky-800">Guests & Room</label>
                                <div class="flex items-center mt-1">
                                    <svg class="w-5 h-5 text-sky-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    <select class="w-full bg-transparent text-sm font-medium text-slate-900 focus:outline-none">
                                        <option>2 Adults, 1 Room</option>
                                        <option>1 Adult (Solo Explorer)</option>
                                        <option>2 Adults, 1 Child</option>
                                        <option>Family (4 Guests, 2 Rooms)</option>
                                        <option>VIP Private Charter Group</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Row across columns -->
                        <div class="sm:col-span-2 lg:col-span-4 flex flex-wrap items-center justify-between pt-2 gap-3">
                            <div class="flex items-center gap-2 text-xs text-slate-500 flex-wrap">
                                <span class="font-semibold text-slate-700">Popular Searches:</span>
                                <a href="#packages" class="px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 transition">Santorini Blue Domes</a>
                                <a href="#packages" class="px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 transition">Maldives Water Villa</a>
                                <a href="#packages" class="px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 transition">Swiss Glaciers</a>
                            </div>

                            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-2xl font-bold text-white bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 hover:from-sky-500 hover:to-blue-500 shadow-lg shadow-sky-600/30 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                <span>Find Exclusive Journeys</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats & Trust Strip -->
    <section class="bg-white border-y border-sky-100 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-y lg:divide-y-0 lg:divide-x divide-sky-100">
                <div class="pt-4 lg:pt-0">
                    <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight flex items-center justify-center gap-1">
                        120<span class="text-sky-600">k+</span>
                    </div>
                    <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Delighted Global Travelers</div>
                </div>
                <div class="pt-4 lg:pt-0">
                    <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight flex items-center justify-center gap-1">
                        150<span class="text-sky-600">+</span>
                    </div>
                    <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Bespoke Blue Destinations</div>
                </div>
                <div class="pt-4 lg:pt-0">
                    <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight flex items-center justify-center gap-1">
                        4.95<span class="text-sky-500 text-2xl">★</span>
                    </div>
                    <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Customer Satisfaction Score</div>
                </div>
                <div class="pt-4 lg:pt-0">
                    <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight flex items-center justify-center gap-1">
                        24<span class="text-sky-600">/7</span>
                    </div>
                    <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Dedicated White-Glove Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Curated Destinations -->
    <section id="destinations" class="py-20 lg:py-28 bg-mesh-blue">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="inline-block text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-100 px-3 py-1 rounded-full mb-3">
                        Curated Portfolios
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight">
                        Iconic White & Blue <span class="text-gradient-azure">Destinations</span>
                    </h2>
                    <p class="mt-3 text-slate-600 max-w-xl text-base">
                        Hand-selected coastal havens, alpine serenity, and Mediterranean islands with unrivaled azure backdrops.
                    </p>
                </div>
                <div class="mt-6 md:mt-0 flex items-center gap-3">
                    <a href="#packages" class="inline-flex items-center gap-2 text-sm font-semibold text-sky-600 hover:text-sky-800 transition group">
                        <span>View All 150+ Destinations</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Destinations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Santorini -->
                <div class="group relative rounded-3xl overflow-hidden bg-white glass-card-hover travel-shadow border border-sky-100/80 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/travel/santorini.jpg') }}" alt="Santorini Caldera" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-sky-900 backdrop-blur-md shadow-sm">
                            Best Seller
                        </span>
                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white">
                            <span class="text-xs font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                4.98 (340 reviews)
                            </span>
                            <span class="text-xs bg-sky-500/80 backdrop-blur-md px-2 py-0.5 rounded-md font-medium">7 Days</span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs uppercase font-bold text-sky-600 tracking-wider">Greece • Aegean Sea</div>
                            <h3 class="text-lg font-bold text-slate-900 mt-1 group-hover:text-sky-600 transition">
                                Santorini Caldera & Oia Villas
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                Iconic whitewashed cliffside suites, infinity pools, private catamaran sunset cruise, and wine tasting.
                            </p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block">Starting from</span>
                                <span class="text-lg font-extrabold text-slate-900">$1,450</span>
                                <span class="text-xs text-slate-500">/ person</span>
                            </div>
                            <button class="px-3.5 py-1.5 rounded-xl bg-sky-50 hover:bg-sky-600 text-sky-700 hover:text-white font-semibold text-xs transition duration-200">
                                View Deal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Maldives -->
                <div class="group relative rounded-3xl overflow-hidden bg-white glass-card-hover travel-shadow border border-sky-100/80 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/travel/maldives.jpg') }}" alt="Maldives Overwater Resort" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold bg-sky-600 text-white shadow-sm">
                            Exclusive
                        </span>
                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white">
                            <span class="text-xs font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                5.0 (480 reviews)
                            </span>
                            <span class="text-xs bg-sky-500/80 backdrop-blur-md px-2 py-0.5 rounded-md font-medium">6 Days</span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs uppercase font-bold text-sky-600 tracking-wider">Indian Ocean • Atoll</div>
                            <h3 class="text-lg font-bold text-slate-900 mt-1 group-hover:text-sky-600 transition">
                                Baa Atoll Overwater Villas
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                Private infinity pool over crystal lagoon, seaplane transfer, coral reef diving, and gourmet beach dining.
                            </p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block">Starting from</span>
                                <span class="text-lg font-extrabold text-slate-900">$2,190</span>
                                <span class="text-xs text-slate-500">/ person</span>
                            </div>
                            <button class="px-3.5 py-1.5 rounded-xl bg-sky-50 hover:bg-sky-600 text-sky-700 hover:text-white font-semibold text-xs transition duration-200">
                                View Deal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Swiss Alps -->
                <div class="group relative rounded-3xl overflow-hidden bg-white glass-card-hover travel-shadow border border-sky-100/80 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/travel/swiss_alps.jpg') }}" alt="Swiss Alps and Lake" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-sky-900 backdrop-blur-md shadow-sm">
                            Alpine Bliss
                        </span>
                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white">
                            <span class="text-xs font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                4.96 (210 reviews)
                            </span>
                            <span class="text-xs bg-sky-500/80 backdrop-blur-md px-2 py-0.5 rounded-md font-medium">8 Days</span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs uppercase font-bold text-sky-600 tracking-wider">Switzerland • Interlaken</div>
                            <h3 class="text-lg font-bold text-slate-900 mt-1 group-hover:text-sky-600 transition">
                                Lake Brienz & Jungfrau Alps
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                Turquoise glacial waters, scenic cogwheel trains, wooden mountain chalets, and crisp fresh mountain air.
                            </p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block">Starting from</span>
                                <span class="text-lg font-extrabold text-slate-900">$1,850</span>
                                <span class="text-xs text-slate-500">/ person</span>
                            </div>
                            <button class="px-3.5 py-1.5 rounded-xl bg-sky-50 hover:bg-sky-600 text-sky-700 hover:text-white font-semibold text-xs transition duration-200">
                                View Deal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Mediterranean Yacht -->
                <div class="group relative rounded-3xl overflow-hidden bg-white glass-card-hover travel-shadow border border-sky-100/80 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/travel/yacht.jpg') }}" alt="Luxury Yacht Blue Sea" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold bg-cyan-600 text-white shadow-sm">
                            VIP Charter
                        </span>
                        <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white">
                            <span class="text-xs font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                5.0 (125 reviews)
                            </span>
                            <span class="text-xs bg-sky-500/80 backdrop-blur-md px-2 py-0.5 rounded-md font-medium">5 Days</span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs uppercase font-bold text-sky-600 tracking-wider">French Riviera • Monaco</div>
                            <h3 class="text-lg font-bold text-slate-900 mt-1 group-hover:text-sky-600 transition">
                                Côte d'Azur Private Yacht Tour
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                Private captain, onboard champagne chef, secluded cove swimming, and docking along Saint-Tropez.
                            </p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block">Starting from</span>
                                <span class="text-lg font-extrabold text-slate-900">$3,100</span>
                                <span class="text-xs text-slate-500">/ person</span>
                            </div>
                            <button class="px-3.5 py-1.5 rounded-xl bg-sky-50 hover:bg-sky-600 text-sky-700 hover:text-white font-semibold text-xs transition duration-200">
                                View Deal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us / Value Proposition -->
    <section id="why-us" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                    The Azure Standard
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 tracking-tight">
                    Why Travel With AzureVoyage?
                </h2>
                <p class="text-slate-600 mt-3 text-base">
                    We transcend conventional travel planning with tailor-crafted itineraries, unmatched safety accreditations, and round-the-clock personal assistance.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-sky-100/70 hover:bg-sky-50/50 hover:border-sky-300 transition duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-sky-600 text-white flex items-center justify-center shadow-md shadow-sky-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mt-5">100% Secure & Protected</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Every booking is fully ATOL bonded and IATA certified. Your financial security is guaranteed at every step.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-sky-100/70 hover:bg-sky-50/50 hover:border-sky-300 transition duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mt-5">Bespoke Customization</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Customize daily schedules, private drivers, room configurations, and dietary preferences seamlessly.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-sky-100/70 hover:bg-sky-50/50 hover:border-sky-300 transition duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-600 text-white flex items-center justify-center shadow-md shadow-cyan-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mt-5">24/7 Global Concierge</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Live travel advisors reachable via phone, WhatsApp, or instant in-app chat at any moment during your journey.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-sky-100/70 hover:bg-sky-50/50 hover:border-sky-300 transition duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-sky-700 text-white flex items-center justify-center shadow-md shadow-sky-700/20 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mt-5">Best Rate Guarantee</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Exclusive wholesale partner contracts allow us to match or beat published 5-star hotel and flight rates.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Curated Travel Packages Table / Grid -->
    <section id="packages" class="py-20 bg-slate-50 border-t border-sky-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-100 px-3 py-1 rounded-full">
                        All-Inclusive Itineraries
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 tracking-tight">
                        Featured Travel Packages
                    </h2>
                    <p class="text-slate-600 mt-2">
                        Complete luxury packages covering first-class transit, boutique resorts, and VIP guided excursions.
                    </p>
                </div>
            </div>

            <!-- Packages Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Package 1 -->
                <div class="bg-white rounded-3xl p-6 travel-shadow border border-sky-100 flex flex-col justify-between hover:border-sky-300 transition duration-300">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-sky-700 bg-sky-50 px-3 py-1 rounded-full">Island Escape</span>
                            <span class="text-sm font-semibold text-emerald-600 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Available
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-4">Blue Lagoon Signature Maldives</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                            7 Days & 6 Nights at 5-Star Water Villa Resort with full board and seaplane transfer.
                        </p>
                        <div class="mt-6 space-y-2.5 text-xs text-slate-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Roundtrip International Flights & Seaplane</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Daily Champagne Breakfast & Chef's Dinner</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Complimentary Scuba Dive & Dolphin Safari</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Total per person</span>
                            <span class="text-2xl font-black text-slate-900">$2,499</span>
                        </div>
                        <button class="px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-sky-600 hover:bg-sky-700 transition">
                            Book Package
                        </button>
                    </div>
                </div>

                <!-- Package 2 (Highlighted) -->
                <div class="bg-gradient-to-b from-sky-900 to-slate-900 rounded-3xl p-6 text-white travel-shadow-lg border-2 border-sky-400 relative flex flex-col justify-between transform lg:-translate-y-2">
                    <span class="absolute -top-3.5 right-6 bg-gradient-to-r from-cyan-400 to-sky-400 text-slate-950 text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider shadow">
                        Most Popular
                    </span>
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-sky-300 bg-white/10 px-3 py-1 rounded-full">Greek Odyssey</span>
                            <span class="text-sm font-semibold text-cyan-300 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span> 3 Spots Left
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white mt-4">Santorini & Mykonos Azure Cruise</h3>
                        <p class="text-xs text-sky-200/80 mt-2 leading-relaxed">
                            8 Days & 7 Nights luxury island hopping with private yacht transfers between Cyclades islands.
                        </p>
                        <div class="mt-6 space-y-2.5 text-xs text-sky-100">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Caldera Cave Villa with Jacuzzi View</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Private High-Speed Catamaran Included</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Sunset Wine Tasting & Photography Guide</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-5 border-t border-white/10 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-sky-300/70 block">Total per person</span>
                            <span class="text-2xl font-black text-white">$2,150</span>
                        </div>
                        <button class="px-5 py-2.5 rounded-xl font-bold text-xs text-slate-950 bg-gradient-to-r from-cyan-300 to-sky-300 hover:from-cyan-200 hover:to-sky-200 transition shadow-md shadow-sky-400/20">
                            Book Package
                        </button>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="bg-white rounded-3xl p-6 travel-shadow border border-sky-100 flex flex-col justify-between hover:border-sky-300 transition duration-300">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-sky-700 bg-sky-50 px-3 py-1 rounded-full">Alpine Lakes</span>
                            <span class="text-sm font-semibold text-emerald-600 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Available
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-4">Swiss Grand Glacier & Lake Chalet</h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                            9 Days Swiss Travel Pass, 5-Star Lakefront Chalet in Interlaken, and First-Class Glacier Express.
                        </p>
                        <div class="mt-6 space-y-2.5 text-xs text-slate-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>First Class Swiss Rail Pass for 8 Days</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Mountain Top Excursions to Jungfraujoch</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Lake Brienz Steamboat & Fondue Dinner</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Total per person</span>
                            <span class="text-2xl font-black text-slate-900">$2,790</span>
                        </div>
                        <button class="px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-sky-600 hover:bg-sky-700 transition">
                            Book Package
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials / Traveler Reviews -->
    <section id="reviews" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                    Real Stories
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 tracking-tight">
                    Loved By Travelers Around The Globe
                </h2>
                <div class="flex items-center justify-center gap-1 mt-3">
                    <span class="text-amber-400 text-lg">★★★★★</span>
                    <span class="text-sm font-semibold text-slate-700 ml-1">4.95 / 5.0 Average Rating</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-slate-50/80 rounded-3xl p-6 border border-sky-100 flex flex-col justify-between">
                    <div>
                        <div class="text-amber-400 text-sm">★★★★★</div>
                        <p class="text-sm text-slate-600 mt-4 italic leading-relaxed">
                            "Booking our honeymoon through AzureVoyage was the best decision we made. The overwater bungalow in the Maldives was literally heaven on earth. Every detail was seamless!"
                        </p>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-sky-200 text-sky-800 font-bold flex items-center justify-center text-sm">
                            SL
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Sophia & Liam Carter</h4>
                            <p class="text-xs text-sky-600">Maldives Honeymoon • June 2026</p>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="bg-slate-50/80 rounded-3xl p-6 border border-sky-100 flex flex-col justify-between">
                    <div>
                        <div class="text-amber-400 text-sm">★★★★★</div>
                        <p class="text-sm text-slate-600 mt-4 italic leading-relaxed">
                            "The private yacht charter in Greece was beyond words. Having a dedicated 24/7 concierge made us feel totally relaxed. Pure white & blue luxury from start to finish."
                        </p>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-200 text-blue-800 font-bold flex items-center justify-center text-sm">
                            MD
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Marcus Davies</h4>
                            <p class="text-xs text-sky-600">Cyclades Yacht Tour • May 2026</p>
                        </div>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="bg-slate-50/80 rounded-3xl p-6 border border-sky-100 flex flex-col justify-between">
                    <div>
                        <div class="text-amber-400 text-sm">★★★★★</div>
                        <p class="text-sm text-slate-600 mt-4 italic leading-relaxed">
                            "Our family trip to Switzerland exceeded all expectations. The views of Lake Brienz and the chalet were unbelievable. We will definitely use AzureVoyage again!"
                        </p>
                    </div>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-cyan-200 text-cyan-800 font-bold flex items-center justify-center text-sm">
                            ET
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Elena & Tom Weber</h4>
                            <p class="text-xs text-sky-600">Swiss Alpine Escape • April 2026</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter & Secret Club -->
    <section class="py-16 bg-mesh-blue border-t border-sky-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-3xl p-8 sm:p-12 travel-shadow-lg text-center relative overflow-hidden border border-white">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-sky-700 bg-sky-100 px-3 py-1 rounded-full mb-3">
                    Exclusive Wanderlust Club
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Get Secret Travel Deals & Hidden Gems
                </h2>
                <p class="mt-3 text-slate-600 max-w-xl mx-auto text-sm sm:text-base">
                    Subscribe to receive secret flash discounts, luxury travel guides, and invitation-only yacht retreats straight to your inbox.
                </p>

                <form class="mt-8 max-w-md mx-auto flex flex-col sm:flex-row gap-3">
                    <input type="email" placeholder="Enter your email address" required class="flex-1 px-4 py-3.5 rounded-2xl bg-white border border-sky-200 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                    <button type="button" onclick="alert('Thank you for joining the Azure Club! Your promo code has been sent.')" class="px-6 py-3.5 rounded-2xl font-bold text-sm text-white bg-sky-600 hover:bg-sky-700 transition shadow-md shadow-sky-500/20">
                        Join Now
                    </button>
                </form>

                <div class="mt-4 text-xs text-slate-500 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>We respect your privacy. Unsubscribe anytime with 1 click.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 pt-16 pb-12 border-t border-sky-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Brand -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-500 to-blue-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-extrabold text-white tracking-tight">
                            Azure<span class="text-sky-400">Voyage</span>
                        </span>
                    </div>
                    <p class="mt-4 text-sm text-slate-400 max-w-sm leading-relaxed">
                        Curating sublime luxury journeys, pristine island retreats, and unforgettable expeditions across the globe.
                    </p>
                    <div class="mt-6 flex items-center gap-3">
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-sky-600 text-slate-300 hover:text-white flex items-center justify-center transition" aria-label="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-sky-600 text-slate-300 hover:text-white flex items-center justify-center transition" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-sky-600 text-slate-300 hover:text-white flex items-center justify-center transition" aria-label="Twitter">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Destinations -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Top Escapes</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a href="#destinations" class="hover:text-sky-400 transition">Maldives Overwater</a></li>
                        <li><a href="#destinations" class="hover:text-sky-400 transition">Santorini, Greece</a></li>
                        <li><a href="#destinations" class="hover:text-sky-400 transition">Swiss Alps & Lakes</a></li>
                        <li><a href="#destinations" class="hover:text-sky-400 transition">French Riviera Yacht</a></li>
                        <li><a href="#destinations" class="hover:text-sky-400 transition">Kyoto Bamboo Gardens</a></li>
                    </ul>
                </div>

                <!-- Col 3: Services -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Services</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a href="#packages" class="hover:text-sky-400 transition">Holiday Packages</a></li>
                        <li><a href="#search-section" class="hover:text-sky-400 transition">First Class Flights</a></li>
                        <li><a href="#search-section" class="hover:text-sky-400 transition">Luxury Villa Booking</a></li>
                        <li><a href="#search-section" class="hover:text-sky-400 transition">Private Yacht Charters</a></li>
                        <li><a href="#why-us" class="hover:text-sky-400 transition">Corporate Retreats</a></li>
                    </ul>
                </div>

                <!-- Col 4: Legal & Help -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Support & Trust</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a href="#" class="hover:text-sky-400 transition">24/7 Concierge Desk</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">ATOL Protection Certificate</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition">Travel Insurance FAQ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} AzureVoyage Agency. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <span>Theme: White & Blue Elegance</span>
                    <span>•</span>
                    <span>Crafted for Exceptional Travelers</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Script for Tabs & Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Search Tab Switching
            const tabs = document.querySelectorAll('.search-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => {
                        t.classList.remove('bg-sky-600', 'text-white', 'shadow-sm');
                        t.classList.add('text-slate-600', 'hover:bg-sky-50', 'hover:text-sky-700');
                    });
                    tab.classList.remove('text-slate-600', 'hover:bg-sky-50', 'hover:text-sky-700');
                    tab.classList.add('bg-sky-600', 'text-white', 'shadow-sm');
                });
            });
        });
    </script>
</body>
</html>