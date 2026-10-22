<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Hub & VIP Club | AzureVoyage Luxury Travel Agency</title>
    <meta name="description" content="Discover AzureVoyage VIP Customer Club, membership tiers, client itineraries, verified traveler testimonials, and bespoke concierge booking services.">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN for instant responsive luxury styling -->
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
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(241, 245, 249, 1);
        }
        .hero-pattern {
            background-color: #0b1329;
            background-image: 
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.35) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(56, 189, 248, 0.25) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.9) 0px, transparent 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 text-white text-xs sm:text-sm py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                    ⭐ VIP Customer Portal
                </span>
                <span>Eksklusif untuk pelanggan AzureVoyage: Akses keahlian VIP, jadual pelancongan & tempahan peribadi</span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-100">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Bantuan Pelanggan: +1 (800) 429-8732
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    100% Kepuasan Terjamin
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
                            <!-- Compass SVG Icon -->
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

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('about') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>About</span>
                    </a>
                    <a href="{{ route('customer') }}" class="text-sky-600 font-semibold transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
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

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-sky-100 bg-white/95 backdrop-blur-lg px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Home</span>
            </a>
            <a href="{{ route('about') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-medium text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>About</span>
            </a>
            <a href="{{ route('customer') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-base font-semibold text-sky-600 bg-sky-50">
                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
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

    <!-- Hero Banner -->
    <section class="relative text-white py-20 lg:py-28 overflow-hidden hero-pattern">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold bg-white/10 text-sky-200 border border-white/15 backdrop-blur-md mb-6">
                ✨ AzureVoyage Elite Traveler Network
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight font-heading leading-tight max-w-4xl mx-auto">
                Customer Hub & <span class="bg-gradient-to-r from-sky-400 to-cyan-300 bg-clip-text text-transparent">VIP Traveler Portal</span>
            </h1>
            <p class="mt-6 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Selamat datang ke hab pelanggan eksklusif AzureVoyage. Nikmati keistimewaan keahlian mewah, semak ulasan pengembara, dan daftar percutian impian anda bersama pegawai concierge peribadi.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="#customer-form" class="px-8 py-3.5 rounded-xl font-bold text-sm bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white shadow-lg shadow-sky-500/30 transition transform hover:-translate-y-0.5">
                    Daftar Sebagai Pelanggan VIP →
                </a>
                <a href="#testimonials" class="px-8 py-3.5 rounded-xl font-bold text-sm bg-white/10 hover:bg-white/20 border border-white/20 text-white backdrop-blur-md transition">
                    Lihat Ulasan Pelanggan
                </a>
            </div>
        </div>
    </section>

    <!-- Customer Statistics Highlights -->
    <section class="relative -mt-10 z-20 max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-6 sm:p-8 rounded-3xl bg-white shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="text-center p-3">
                <div class="text-3xl sm:text-4xl font-extrabold text-sky-600 font-heading">15,000+</div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-1">Pelanggan Berpuas Hati</div>
                <div class="text-[11px] text-slate-400">Di seluruh dunia</div>
            </div>
            <div class="text-center p-3 border-l border-slate-100">
                <div class="text-3xl sm:text-4xl font-extrabold text-sky-600 font-heading">99.6%</div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-1">Penilaian 5 Bintang</div>
                <div class="text-[11px] text-slate-400">Berdasarkan ulasan sah</div>
            </div>
            <div class="text-center p-3 border-l-0 lg:border-l border-slate-100">
                <div class="text-3xl sm:text-4xl font-extrabold text-sky-600 font-heading">120+</div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-1">Destinasi Mewah</div>
                <div class="text-[11px] text-slate-400">Pulau peribadi & resort</div>
            </div>
            <div class="text-center p-3 border-l border-slate-100">
                <div class="text-3xl sm:text-4xl font-extrabold text-sky-600 font-heading">24/7</div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-1">Dedicated Concierge</div>
                <div class="text-[11px] text-slate-400">Sedia membantu bila-bila masa</div>
            </div>
        </div>
    </section>

    <!-- VIP Membership Tier Cards -->
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sky-100 text-sky-700 mb-3">
                Pelan Keahlian Eksklusif
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">
                Tahap Keahlian Pelanggan VIP
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3">
                Pilih tahap keahlian AzureVoyage yang bersesuaian dengan gaya hidup mewah anda. Nikmati perkhidmatan peribadi bertaraf 5 bintang dari saat anda berlepas hingga pulang.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tier 1: Silver Explorer -->
            <div class="glass-card rounded-3xl p-8 flex flex-col justify-between hover:shadow-xl hover:shadow-sky-100 transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center font-black text-xl mb-6 shadow-sm">
                        🥈
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Tier 01</span>
                    <h3 class="text-2xl font-bold text-slate-900 font-heading mt-1">Silver Explorer</h3>
                    <p class="text-xs text-slate-500 mt-2">Sesuai untuk pengembara individu & pasangan yang menggemari percutian santai berkualiti.</p>
                    
                    <div class="my-6 pt-6 border-t border-slate-100">
                        <span class="text-3xl font-extrabold text-slate-900 font-heading">Percuma</span>
                        <span class="text-xs text-slate-500 font-medium"> / pendaftaran asas</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Keutamaan tempahan tiket penerbangan
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Diskaun hotel 5-bintang terpilih (sehingga 15%)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Bantuan concierge waktu pejabat
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Panduan eksklusif destinasi rahsia
                        </li>
                    </ul>
                </div>
                <div class="mt-8 pt-4">
                    <a href="#customer-form" onclick="selectTier('Silver Explorer')" class="block text-center w-full py-3 rounded-xl border-2 border-slate-300 hover:border-sky-600 text-slate-800 hover:text-sky-600 font-bold text-sm transition">
                        Pilih Silver Explorer
                    </a>
                </div>
            </div>

            <!-- Tier 2: Gold Voyager (Featured) -->
            <div class="relative rounded-3xl p-8 bg-gradient-to-b from-sky-900 via-slate-900 to-slate-950 text-white shadow-2xl shadow-sky-900/30 flex flex-col justify-between transform md:-translate-y-4">
                <span class="absolute -top-3.5 right-6 bg-gradient-to-r from-amber-400 to-orange-400 text-slate-950 text-xs font-black uppercase tracking-wider px-3.5 py-1 rounded-full shadow-md">
                    Paling Popular
                </span>
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-400 to-amber-200 text-slate-950 flex items-center justify-center font-black text-xl mb-6 shadow-md">
                        🥇
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-300">Tier 02 • Recommended</span>
                    <h3 class="text-2xl font-bold text-white font-heading mt-1">Gold Voyager</h3>
                    <p class="text-xs text-sky-200/80 mt-2">Pakej kegemaran usahawan & keluarga VIP untuk layanan eksklusif dan selesa.</p>
                    
                    <div class="my-6 pt-6 border-t border-white/10">
                        <span class="text-3xl font-extrabold text-white font-heading">VIP Club</span>
                        <span class="text-xs text-sky-200 font-medium"> / jemputan khas</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-sky-100">
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400 font-bold">✓</span> Akses Airport Lounge antarabangsa percuma
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400 font-bold">✓</span> Naik taraf suite hotel mewah tanpa caj tambahan
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400 font-bold">✓</span> Pengangkutan peribadi (chauffeur) dari lapangan terbang
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400 font-bold">✓</span> Dedicated WhatsApp concierge 24/7
                        </li>
                    </ul>
                </div>
                <div class="mt-8 pt-4">
                    <a href="#customer-form" onclick="selectTier('Gold Voyager')" class="block text-center w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-400 to-orange-400 hover:from-amber-300 hover:to-orange-300 text-slate-950 font-black text-sm shadow-lg shadow-amber-500/20 transition">
                        Pilih Gold Voyager →
                    </a>
                </div>
            </div>

            <!-- Tier 3: Platinum Sovereign -->
            <div class="glass-card rounded-3xl p-8 flex flex-col justify-between hover:shadow-xl hover:shadow-sky-100 transition-all duration-300">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-500 to-blue-500 text-white flex items-center justify-center font-black text-xl mb-6 shadow-sm">
                        💎
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Tier 03</span>
                    <h3 class="text-2xl font-bold text-slate-900 font-heading mt-1">Platinum Sovereign</h3>
                    <p class="text-xs text-slate-500 mt-2">Tahap tertinggi kemewahan: kapal layar peribadi, jet persendirian & butler percutian 24 jam.</p>
                    
                    <div class="my-6 pt-6 border-t border-slate-100">
                        <span class="text-3xl font-extrabold text-slate-900 font-heading">Ultra VIP</span>
                        <span class="text-xs text-slate-500 font-medium"> / perkhidmatan tersuai</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Piagam jet peribadi & kapal layar mewah
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Butler peribadi sepanjang tempoh penginapan
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Akses meja eksklusif di restoran Michelin Star
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Jaminan pembatalan 100% fleksibel
                        </li>
                    </ul>
                </div>
                <div class="mt-8 pt-4">
                    <a href="#customer-form" onclick="selectTier('Platinum Sovereign')" class="block text-center w-full py-3 rounded-xl border-2 border-slate-300 hover:border-sky-600 text-slate-800 hover:text-sky-600 font-bold text-sm transition">
                        Pilih Platinum Sovereign
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Customer Trips & Directory Section -->
    <section class="py-16 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-sky-600 block mb-1">
                        Aktiviti Terkini Pelanggan
                    </span>
                    <h2 class="text-3xl font-extrabold text-slate-900 font-heading">
                        Jadual & Pengalaman Pelanggan AzureVoyage
                    </h2>
                </div>
                <div class="flex flex-wrap gap-2 text-xs font-bold">
                    <button onclick="filterCategory('all')" id="btn-all" class="px-4 py-2 rounded-xl bg-sky-600 text-white shadow-sm transition">
                        Semua
                    </button>
                    <button onclick="filterCategory('island')" id="btn-island" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        Pulau & Pantai
                    </button>
                    <button onclick="filterCategory('alpine')" id="btn-alpine" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        Pergunungan Salji
                    </button>
                    <button onclick="filterCategory('yacht')" id="btn-yacht" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        Kapal Layar & Pelayaran
                    </button>
                </div>
            </div>

            <!-- Customer Trip Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="customer-grid">
                <!-- Card 1 -->
                <div class="customer-card island bg-slate-50 rounded-2xl p-6 border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                Selesai • 5 Bintang
                            </span>
                            <span class="text-xs font-bold text-slate-400">Oktober 2026</span>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">Pakej Percutian Villa Atas Air Maldives</h4>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            "Pengalaman luar biasa! Pengambilan bot laju peribadi dan penginapan di overwater villa sangat menakjubkan. Servis tiada tandingan."
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-rose-400 text-white font-bold flex items-center justify-center text-sm shadow">
                            DS
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-slate-900">Datin Sofia & Keluarga</span>
                            <span class="block text-[11px] font-semibold text-sky-600">Gold Voyager Member • Kuala Lumpur</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="customer-card alpine bg-slate-50 rounded-2xl p-6 border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-800">
                                Akan Datang • Disahkan
                            </span>
                            <span class="text-xs font-bold text-slate-400">Disember 2026</span>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">Chalet Ski Mewah Swiss Alps Zermatt</h4>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            "Tempahan tiket helikopter persendirian dan jurulatih ski peribadi telah diselesaikan oleh concierge dalam masa kurang 24 jam!"
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-sky-600 to-blue-500 text-white font-bold flex items-center justify-center text-sm shadow">
                            TN
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-slate-900">Tengku Nazrin</span>
                            <span class="block text-[11px] font-semibold text-cyan-600">Platinum Sovereign • Shah Alam</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="customer-card yacht bg-slate-50 rounded-2xl p-6 border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                Selesai • 5 Bintang
                            </span>
                            <span class="text-xs font-bold text-slate-400">September 2026</span>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">Pelayaran Kapal Layar Peribadi Santorini</h4>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            "Makan malam matahari terbenam atas kapal layar Mediterranean adalah kemuncak bulan madu kami. Pasukan AzureVoyage memang terbaik."
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-purple-500 to-indigo-500 text-white font-bold flex items-center justify-center text-sm shadow">
                            AF
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-slate-900">Aisha & Farhan</span>
                            <span class="block text-[11px] font-semibold text-purple-600">Silver Explorer • Johor Bahru</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-sky-600 block mb-2">
                Ulasan Sebenar Pengembara
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">
                Apa Kata Pelanggan Kami
            </h2>
            <p class="text-sm text-slate-600 mt-2">
                Setiap senyuman dan kenangan indah pelanggan adalah pencapaian terbesar agensi kami.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-card rounded-3xl p-8 border border-slate-200 shadow-sm">
                <div class="text-amber-400 text-lg mb-4">★★★★★</div>
                <p class="text-sm text-slate-700 italic leading-relaxed">
                    "Saya tidak perlu risau tentang sebarang tiket, visa atau pendaftaran hotel. Dari hari pertama sampai pulang, pegawai peribadi sentiasa bersedia. Pengalaman 10/10."
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-500 text-white flex items-center justify-center font-bold text-sm">
                        MR
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Megat Radzi</h4>
                        <span class="text-xs text-slate-500">Lawatan Tokyo & Kyoto</span>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-8 border border-slate-200 shadow-sm">
                <div class="text-amber-400 text-lg mb-4">★★★★★</div>
                <p class="text-sm text-slate-700 italic leading-relaxed">
                    "Kami memilih AzureVoyage untuk sambutan ulang tahun perkahwinan di Greece. Villa di tebing Santorini sungguh memukau. Layanan peribadi yang sangat dihargai."
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center font-bold text-sm">
                        SN
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Dr. Sarah & Suami</h4>
                        <span class="text-xs text-slate-500">Santorini Romantic Getaway</span>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-8 border border-slate-200 shadow-sm">
                <div class="text-amber-400 text-lg mb-4">★★★★★</div>
                <p class="text-sm text-slate-700 italic leading-relaxed">
                    "Pakej keluarga kami ke Switzerland berjalan lancar tanpa cacat cela. Anak-anak sangat gembira dan hotel yang dicadangkan sangat selesa. Akan terus guna AzureVoyage!"
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">
                        AZ
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Encik Azlan & Keluarga</h4>
                        <span class="text-xs text-slate-500">Swiss Alps Family Escape</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Registration & Booking Form -->
    <section id="customer-form" class="py-20 bg-gradient-to-b from-slate-900 to-slate-950 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sky-500/20 text-sky-300 border border-sky-400/30 mb-3">
                    Borang Pendaftaran Pelanggan
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-heading">
                    Sertai Kelab Pelanggan VIP & Rancang Percutian
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-xl mx-auto">
                    Isi butiran ringkas di bawah. Pegawai percutian khas kami akan menghubungi anda dalam tempoh 2 jam berserta perincian jadual perjalanan.
                </p>
            </div>

            <!-- Success Alert Banner (Hidden by default, shown upon form submit) -->
            <div id="formSuccessAlert" class="hidden mb-8 p-5 rounded-2xl bg-emerald-500/20 border-2 border-emerald-400 text-emerald-200 text-sm font-bold flex items-center gap-3">
                <span class="text-2xl">🎉</span>
                <div>
                    <div>Permintaan Anda Berjaya Dihantar!</div>
                    <div class="text-xs font-normal text-emerald-300 mt-0.5">Pegawai Concierge AzureVoyage akan menghubungi nombor telefon anda sebentar lagi.</div>
                </div>
            </div>

            <!-- Form -->
            <form onsubmit="handleCustomerSubmit(event)" class="bg-white/5 border border-white/10 backdrop-blur-xl rounded-3xl p-8 sm:p-12 space-y-6 shadow-2xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="fullName" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Nama Penuh <span class="text-sky-400">*</span>
                        </label>
                        <input
                            type="text"
                            id="fullName"
                            required
                            placeholder="Contoh: Nur Izzati"
                            class="w-full px-4 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:border-sky-400 focus:bg-white/15 transition text-sm"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Alamat Emel <span class="text-sky-400">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            required
                            placeholder="izzati@example.com"
                            class="w-full px-4 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:border-sky-400 focus:bg-white/15 transition text-sm"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Nombor Telefon / WhatsApp <span class="text-sky-400">*</span>
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            required
                            placeholder="+60 12-345 6789"
                            class="w-full px-4 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:border-sky-400 focus:bg-white/15 transition text-sm"
                        >
                    </div>

                    <div>
                        <label for="vipTier" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Pilihan Tahap Keahlian VIP
                        </label>
                        <select
                            id="vipTier"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-900 border border-white/20 text-white focus:outline-none focus:border-sky-400 transition text-sm"
                        >
                            <option value="Gold Voyager">Gold Voyager (Paling Popular)</option>
                            <option value="Silver Explorer">Silver Explorer</option>
                            <option value="Platinum Sovereign">Platinum Sovereign (Ultra VIP)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="destination" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Destinasi Pilihan Anda
                        </label>
                        <select
                            id="destination"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-900 border border-white/20 text-white focus:outline-none focus:border-sky-400 transition text-sm"
                        >
                            <option value="Maldives">Maldives — Private Lagoon Overwater Villa</option>
                            <option value="Santorini">Santorini, Greece — Caldera Sunset Yacht Escape</option>
                            <option value="Swiss Alps">Swiss Alps — Zermatt 5-Star Ski Chalet</option>
                            <option value="Kyoto">Kyoto, Japan — Traditional Ryokan & Bamboo Forest</option>
                            <option value="Dubai">Dubai, UAE — Desert Oasis Luxury Resort</option>
                        </select>
                    </div>

                    <div>
                        <label for="guestCount" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Bilangan Pengembara
                        </label>
                        <select
                            id="guestCount"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-900 border border-white/20 text-white focus:outline-none focus:border-sky-400 transition text-sm"
                        >
                            <option value="1-2">1 - 2 Orang (Pasangan / Solo VIP)</option>
                            <option value="3-5">3 - 5 Orang (Keluarga Kecil)</option>
                            <option value="6+">6+ Orang (Keluarga Besar / Rombongan Khas)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Permintaan Khas / Maklumat Tambahan (Pilihan)
                    </label>
                    <textarea
                        id="notes"
                        rows="3"
                        placeholder="Contoh: Sambutan hari jadi, makanan halal sahaja, bilik mengadap pemandangan laut..."
                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:border-sky-400 focus:bg-white/15 transition text-sm"
                    ></textarea>
                </div>

                <button
                    type="submit"
                    class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-sky-500 via-blue-600 to-sky-600 hover:from-sky-400 hover:to-blue-500 text-white font-extrabold text-base shadow-xl shadow-sky-600/30 transition transform hover:-translate-y-0.5"
                >
                    Hantar Permintaan VIP & Daftar Sekarang →
                </button>
            </form>
        </div>
    </section>

    <!-- Customer FAQ Accordion -->
    <section class="py-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-sky-600 block mb-1">
                Bantuan & Soalan Lazim
            </span>
            <h2 class="text-3xl font-extrabold text-slate-900 font-heading">
                Soalan Lazim Pelanggan AzureVoyage
            </h2>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="glass-card rounded-2xl border border-slate-200 overflow-hidden">
                <button onclick="toggleFaq('faq1')" class="w-full p-6 text-left flex items-center justify-between font-bold text-slate-900 focus:outline-none">
                    <span>Bagaimana cara saya menyemak status jadual percutian saya?</span>
                    <span id="faq1-icon" class="text-sky-600 transition-transform duration-200">▼</span>
                </button>
                <div id="faq1-content" class="hidden px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Sebaik sahaja tempahan dibuat, anda akan diberikan pautan peribadi beserta log masuk portal. Pegawai concierge peribadi anda juga akan menghantar salinan digital melalui WhatsApp dan emel.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="glass-card rounded-2xl border border-slate-200 overflow-hidden">
                <button onclick="toggleFaq('faq2')" class="w-full p-6 text-left flex items-center justify-between font-bold text-slate-900 focus:outline-none">
                    <span>Apakah jaminan sekiranya saya perlu mengubah tarikh perjalanan?</span>
                    <span id="faq2-icon" class="text-sky-600 transition-transform duration-200">▼</span>
                </button>
                <div id="faq2-content" class="hidden px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Semua ahli VIP Gold dan Platinum dilindungi polisi "Flexi-Voyage", yang membolehkan anda menjadualkan semula tarikh penginapan tanpa sebarang caj penalti sehingga 72 jam sebelum berlepas.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="glass-card rounded-2xl border border-slate-200 overflow-hidden">
                <button onclick="toggleFaq('faq3')" class="w-full p-6 text-left flex items-center justify-between font-bold text-slate-900 focus:outline-none">
                    <span>Adakah makanan halal disediakan di semua destinasi pakej?</span>
                    <span id="faq3-icon" class="text-sky-600 transition-transform duration-200">▼</span>
                </button>
                <div id="faq3-content" class="hidden px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Ya. Pasukan kami mengkhusus dalam menyediakan pilihan makanan halal yang disahkan, termasuk koki persendirian di villa persendirian anda jika diperlukan.
                </div>
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
                    <a href="{{ route('about') }}" class="hover:text-white transition">About</a>
                    <a href="{{ route('customer') }}" class="text-sky-400 font-bold">Customer</a>
                    <a href="{{ url('/login') }}" class="hover:text-white transition">Login</a>
                </div>
            </div>
            <div class="pt-8 text-center text-xs text-slate-500">
                <p>© {{ date('Y') }} AzureVoyage • Powerpuff Girls Travel Agency Project. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        // Mobile Drawer Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Tier selection helper from cards
        function selectTier(tierName) {
            const selectEl = document.getElementById('vipTier');
            if (selectEl) {
                selectEl.value = tierName;
            }
        }

        // Category filter for customer cards
        function filterCategory(cat) {
            const cards = document.querySelectorAll('.customer-card');
            cards.forEach(card => {
                if (cat === 'all' || card.classList.contains(cat)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });

            // Button active states
            ['all', 'island', 'alpine', 'yacht'].forEach(key => {
                const btn = document.getElementById(`btn-${key}`);
                if (btn) {
                    if (key === cat) {
                        btn.className = 'px-4 py-2 rounded-xl bg-sky-600 text-white shadow-sm transition';
                    } else {
                        btn.className = 'px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition';
                    }
                }
            });
        }

        // FAQ Toggle
        function toggleFaq(id) {
            const content = document.getElementById(`${id}-content`);
            const icon = document.getElementById(`${id}-icon`);
            if (content) {
                content.classList.toggle('hidden');
                if (icon) {
                    icon.textContent = content.classList.contains('hidden') ? '▼' : '▲';
                }
            }
        }

        // Customer Registration Form Submission
        function handleCustomerSubmit(e) {
            e.preventDefault();
            const alertBox = document.getElementById('formSuccessAlert');
            if (alertBox) {
                alertBox.classList.remove('hidden');
            }
            e.target.reset();
        }
    </script>
    @include('partials.logout-toastr')
</body>
</html>

