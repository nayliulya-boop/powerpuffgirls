<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="Learn about AzureVoyage, our story, core values, leadership team, and our commitment to curating bespoke luxury travel escapes worldwide.">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN for instant styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        heading: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
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
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }
        .hero-pattern {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.35) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(56, 189, 248, 0.25) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.9) 0px, transparent 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top Announcement Bar (Synced with Home) -->
    <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 text-white text-xs sm:text-sm py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                    ✨ About AzureVoyage
                </span>
                <span>Learn how we craft extraordinary escapes & world-class travel experiences</span>
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

    <!-- Navigation Header (Synchronized with Home & Login) -->
    <header class="sticky top-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
                            <!-- Modern Compass SVG Icon -->
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
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('about') }}" class="text-sky-600 font-semibold transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>About</span>
                    </a>
                    <a href="{{ route('customer') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Customer</span>
                    </a>
                </nav>

                <!-- Actions / Login & Logout -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-semibold text-sm text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 shadow-md shadow-sky-500/20 transition gap-2">
                            <span>Dashboard</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-semibold text-sm text-slate-700 bg-white border border-slate-200 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 shadow-sm transition gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ url('/login') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl font-semibold text-sm text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 shadow-md shadow-sky-500/20 hover:shadow-lg hover:shadow-sky-500/30 transition-all duration-200 transform hover:-translate-y-0.5 gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            <span>Login</span>
                        </a>
                    @endauth
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
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Home</span>
            </a>
            <a href="{{ route('about') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-semibold text-sky-600 bg-sky-50">
                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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

    <!-- Main About Page Hero Section -->
    <section class="relative hero-pattern text-white py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs sm:text-sm font-semibold mb-6">
                <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                <span>About Our Project & Travel Agency</span>
                <span class="text-white/40">|</span>
                <span class="text-emerald-300 font-medium">No Database Connected (Test Mode)</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight font-heading leading-tight max-w-4xl mx-auto">
                Crafting Extraordinary Escapes & <br class="hidden sm:inline"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-300 via-cyan-200 to-white">
                    Unforgettable Global Memories
                </span>
            </h1>

            <p class="mt-6 text-lg sm:text-xl text-slate-300 max-w-2xl mx-auto font-light leading-relaxed">
                Founded with a passion for wanderlust, AzureVoyage by Powerpuff Girls curates bespoke private expeditions, luxury island hideaways, and hand-tailored global journeys.
            </p>

            <!-- Quick Stats Row -->
            <div class="mt-14 grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 max-w-5xl mx-auto text-left">
                <div class="glass-card rounded-2xl p-6 border border-white/10 bg-white/5">
                    <div class="text-3xl sm:text-4xl font-extrabold text-sky-400 font-heading">120+</div>
                    <div class="text-sm font-semibold text-white mt-1">Global Destinations</div>
                    <div class="text-xs text-slate-400 mt-1">From private Pacific atolls to Swiss mountain retreats</div>
                </div>
                <div class="glass-card rounded-2xl p-6 border border-white/10 bg-white/5">
                    <div class="text-3xl sm:text-4xl font-extrabold text-cyan-300 font-heading">15,000+</div>
                    <div class="text-sm font-semibold text-white mt-1">Happy Voyagers</div>
                    <div class="text-xs text-slate-400 mt-1">Delivering exceptional experiences worldwide</div>
                </div>
                <div class="glass-card rounded-2xl p-6 border border-white/10 bg-white/5">
                    <div class="text-3xl sm:text-4xl font-extrabold text-amber-300 font-heading">99.4%</div>
                    <div class="text-sm font-semibold text-white mt-1">Client Satisfaction</div>
                    <div class="text-xs text-slate-400 mt-1">Consistent 5-star ratings across all trips</div>
                </div>
                <div class="glass-card rounded-2xl p-6 border border-white/10 bg-white/5">
                    <div class="text-3xl sm:text-4xl font-extrabold text-emerald-400 font-heading">24/7</div>
                    <div class="text-sm font-semibold text-white mt-1">Global Concierge</div>
                    <div class="text-xs text-slate-400 mt-1">Round-the-clock personalized human support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story & Mission Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Story Description -->
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-bold uppercase tracking-wider mb-4">
                        Our Heritage & Story
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight font-heading leading-tight mb-6">
                        We Don't Just Book Trips — We Design Lifelong Adventures
                    </h2>
                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-6">
                        AzureVoyage began with a single vision: to strip away the stress and uncertainty of luxury travel. We believe true luxury is effortless personalization — having every detail thoughtfully orchestrated before you even think of it.
                    </p>
                    <p class="text-base text-slate-600 leading-relaxed mb-8">
                        Whether it is chartered catamarans across the Greek Cyclades, secluded overwater villas in the Maldives, or alpine heli-skiing in the Swiss Alps, our agency collaborates with the world’s most trusted hospitality leaders to deliver flawless itineraries.
                    </p>

                    <!-- Trust Checklist -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6 border-t border-slate-100">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">100% Financial Protection</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Hand-Inspected Luxury Stays</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Direct VIP Access & Upgrades</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Zero Hidden Booking Fees</span>
                        </div>
                    </div>
                </div>

                <!-- Mission & Vision Cards -->
                <div class="space-y-6">
                    <div class="p-8 rounded-3xl bg-gradient-to-br from-sky-50 to-blue-50 border border-sky-100 shadow-sm relative overflow-hidden">
                        <div class="w-12 h-12 rounded-2xl bg-sky-600 text-white flex items-center justify-center mb-5 shadow-md shadow-sky-600/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 font-heading mb-3">Our Mission</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            To empower travelers to experience the earth’s most enchanting destinations with complete peace of mind, thoughtful sustainability, and unyielding attention to detail.
                        </p>
                    </div>

                    <div class="p-8 rounded-3xl bg-gradient-to-br from-slate-900 to-sky-950 text-white border border-slate-800 shadow-xl relative overflow-hidden">
                        <div class="w-12 h-12 rounded-2xl bg-sky-500 text-white flex items-center justify-center mb-5 shadow-md shadow-sky-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white font-heading mb-3">Our Vision</h3>
                        <p class="text-slate-300 text-sm leading-relaxed">
                            To be recognized globally as the gold standard in bespoke experiential travel, connecting discerning travelers with indigenous cultures and pristine environments responsibly.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-bold uppercase tracking-wider mb-4">
                    What Drives Us
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">
                    Our Core Values & Guarantees
                </h2>
                <p class="text-base text-slate-600 mt-4 leading-relaxed">
                    Every itinerary we craft is anchored by four fundamental commitments to our travelers.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Value 1 -->
                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center text-2xl mb-6">
                        💎
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 font-heading mb-2">Bespoke Curation</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        No cookie-cutter templates. Every travel package is built from scratch around your personal desires, pacing, and preferences.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mb-6">
                        🛡️
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 font-heading mb-2">Total Financial Security</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Full ATOL and IATA bonded partnerships. Your booking capital is safeguarded under international traveler protection standards.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl mb-6">
                        🌿
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 font-heading mb-2">Sustainable Tourism</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        We actively partner with eco-resorts, promote reef protection, and contribute a portion of every booking to local community heritage.
                    </p>
                </div>

                <!-- Value 4 -->
                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl mb-6">
                        🤝
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 font-heading mb-2">Human Concierge</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Real destination specialists who pick up your call in seconds, manage emergency changes, and handle reservations in real time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership / Team Section (Powerpuff Girls Team) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-bold uppercase tracking-wider mb-4">
                    The Minds Behind AzureVoyage
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">
                    Meet Our Leadership & Curators
                </h2>
                <p class="text-base text-slate-600 mt-4 leading-relaxed">
                    Our collaborative Powerpuff Girls development and expedition team brings together luxury hospitality, technology, and operations.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200 text-center hover:bg-sky-50/50 hover:border-sky-200 transition-all duration-300">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-orange-500 to-pink-500 text-white font-extrabold text-3xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-orange-500/20">
                        NU
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 font-heading">Nayli Ulya</h3>
                    <p class="text-xs font-semibold text-orange-600 uppercase tracking-wider mt-0.5 mb-3">Founder & Managing Director</p>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Directs agency vision, guest experience, and oversees luxury hospitality partnerships across global destinations.
                    </p>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200 text-center hover:bg-sky-50/50 hover:border-sky-200 transition-all duration-300">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-sky-600 to-cyan-500 text-white font-extrabold text-3xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-sky-500/20">
                        AF
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 font-heading">Aisyah Faqihah</h3>
                    <p class="text-xs font-semibold text-sky-600 uppercase tracking-wider mt-0.5 mb-3">Head of Global Partnerships</p>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Curates exclusive resort agreements, private aviation logistics, and seamless client portal experiences.
                    </p>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200 text-center hover:bg-sky-50/50 hover:border-sky-200 transition-all duration-300">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-400 text-white font-extrabold text-3xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-emerald-500/20">
                        NI
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 font-heading">Nur Izzati</h3>
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-0.5 mb-3">Chief Experience Architect</p>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Architects bespoke itineraries, client safety guidelines, and on-ground concierge support protocols.
                    </p>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200 text-center hover:bg-sky-50/50 hover:border-sky-200 transition-all duration-300">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-extrabold text-3xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-500/20">
                        MS
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 font-heading">Muhammad Syakir</h3>
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mt-0.5 mb-3">Lead Travel Technologist</p>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Develops digital booking systems, branch integrations, and test-driven architecture across the portal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section (Accordion) -->
    <section class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-bold uppercase tracking-wider mb-4">
                    Clear Answers
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">
                    Frequently Asked Questions
                </h2>
                <p class="text-base text-slate-600 mt-3">
                    Have questions about our agency, bookings, or guarantees? Here is how we operate.
                </p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <button class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 focus:outline-none" onclick="toggleFaq(1)">
                        <span>How does AzureVoyage curate personalized travel itineraries?</span>
                        <svg id="faq-icon-1" class="w-5 h-5 text-slate-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="faq-content-1" class="hidden px-6 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Our travel designers start with an in-depth consultation to understand your schedule, passions, and preferences. We then build an entirely bespoke itinerary, coordinate private transfers, and liaise directly with vetted local concierges.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <button class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 focus:outline-none" onclick="toggleFaq(2)">
                        <span>Are my bookings and payments financially protected?</span>
                        <svg id="faq-icon-2" class="w-5 h-5 text-slate-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="faq-content-2" class="hidden px-6 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Yes, 100%. AzureVoyage maintains bonded partnerships under IATA and ATOL regulations. Every transaction and booking reservation is insured against supplier default and flight cancellation.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <button class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 focus:outline-none" onclick="toggleFaq(3)">
                        <span>Can I request last-minute itinerary adjustments during my trip?</span>
                        <svg id="faq-icon-3" class="w-5 h-5 text-slate-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="faq-content-3" class="hidden px-6 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Absolutely. Your dedicated 24/7 concierge is reachable via WhatsApp, phone, or email to reschedule reservations, arrange yacht charters, or accommodate spontaneous travel requests.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <button class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 font-bold text-slate-900 focus:outline-none" onclick="toggleFaq(4)">
                        <span>Why does this page indicate "No Database Connected"?</span>
                        <svg id="faq-icon-4" class="w-5 h-5 text-slate-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="faq-content-4" class="hidden px-6 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        This About page is built as a pure, lightning-fast static Blade template. It does not require any SQL or database connection to run, ensuring rapid testing, maximum stability, and clean branch synchronization across team members.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agency Contact & Office Information -->
    <section class="py-20 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Contact Details -->
                <div class="lg:col-span-5 space-y-6">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-bold uppercase tracking-wider">
                        Get in Touch
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">
                        Speak With Our Travel Specialists
                    </h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Ready to plan your next milestone journey? Contact our private concierge team or visit our flagship lounges.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center shrink-0">
                                📍
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Global Headquarters</span>
                                <span class="text-sm font-bold text-slate-800">42 Ocean Breeze Blvd, Marina Bay, Singapore</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                📞
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Concierge Hotline</span>
                                <span class="text-sm font-bold text-slate-800">+1 (800) 429-8732 / +65 6789 0123</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-orange-600 text-white flex items-center justify-center shrink-0">
                                ✉️
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Direct Inquiries</span>
                                <span class="text-sm font-bold text-slate-800">concierge@azurevoyage.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Static Inquiry Box (Client-side only) -->
                <div class="lg:col-span-7 bg-slate-50 rounded-3xl p-8 sm:p-10 border border-slate-200">
                    <h3 class="text-2xl font-bold text-slate-900 font-heading mb-2">Send Us an Inquiry</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mb-6">
                        Fill in your dream destination or query. Our specialists will respond within 24 hours.
                    </p>

                    <div id="inquirySuccess" class="hidden mb-6 p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-900 text-sm font-bold">
                        🎉 Thank you! Your inquiry has been received. Our concierge will be in touch shortly.
                    </div>

                    <form onsubmit="handleInquiry(event)" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Your Name</label>
                                <input type="text" required placeholder="Jane Doe" class="w-full px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-medium focus:outline-none focus:border-sky-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Address</label>
                                <input type="email" required placeholder="jane@example.com" class="w-full px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-medium focus:outline-none focus:border-sky-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Destination of Interest</label>
                            <input type="text" placeholder="e.g. Maldives, Swiss Alps, Santorini..." class="w-full px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-medium focus:outline-none focus:border-sky-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Your Message / Special Requests</label>
                            <textarea rows="3" placeholder="Tell us about your trip vision..." class="w-full px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-medium focus:outline-none focus:border-sky-500"></textarea>
                        </div>
                        <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-bold text-sm shadow-md shadow-sky-600/25 transition">
                            Submit Inquiry →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="py-16 bg-gradient-to-r from-sky-600 via-blue-600 to-cyan-600 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-2xl sm:text-3xl font-bold font-heading">Ready to Discover Your Next Journey?</h3>
                <p class="text-sm text-sky-100 mt-1 max-w-lg">
                    Browse our bespoke package showcases on the Home page, or sign in to your explorer travel portal.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-white text-sky-700 font-bold text-sm shadow hover:bg-sky-50 transition">
                    ← Explore Home
                </a>
                <a href="{{ url('/login') }}" class="px-6 py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm shadow transition">
                    Sign In Portal →
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 text-sm border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-8 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-sky-500 text-white flex items-center justify-center font-bold">
                        ✈️
                    </div>
                    <span class="text-xl font-extrabold text-white">Azure<span class="text-sky-400">Voyage</span></span>
                </div>
                <div class="flex items-center gap-6 text-xs font-semibold text-slate-300">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                    <a href="{{ route('about') }}" class="text-sky-400 font-bold">About</a>
                    <a href="{{ route('customer') }}" class="hover:text-white transition">Customer</a>
                    <a href="{{ url('/login') }}" class="hover:text-white transition">Login</a>
                </div>
            </div>
            <div class="pt-8 text-center text-xs text-slate-500">
                <p>© {{ date('Y') }} AzureVoyage • Powerpuff Girls Travel Agency Project. All rights reserved. Zero database dependency.</p>
            </div>
        </div>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        // Mobile Menu Drawer Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // FAQ Accordion Toggle
        function toggleFaq(id) {
            const content = document.getElementById(`faq-content-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);
            if (content) {
                content.classList.toggle('hidden');
                if (icon) {
                    icon.classList.toggle('rotate-180');
                }
            }
        }

        // Static Inquiry Submission Handler
        function handleInquiry(e) {
            e.preventDefault();
            const alertBox = document.getElementById('inquirySuccess');
            if (alertBox) {
                alertBox.classList.remove('hidden');
            }
            e.target.reset();
        }
    </script>
    @include('partials.logout-toastr')
</body>
</html>
