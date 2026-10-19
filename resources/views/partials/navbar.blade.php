<!-- Top Announcement Bar -->
<div class="bg-gradient-to-r from-sky-700 via-blue-700 to-sky-800 text-white text-xs sm:text-sm py-2 px-4 shadow-sm border-b border-sky-600/30">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-amber-400 text-slate-900 shadow-sm animate-pulse">
                PROMOSI KHAS
            </span>
            <span class="text-sky-100 font-medium">✨ Diskaun sehingga <strong class="text-white font-bold">30%</strong> untuk Pakej Percutian & Umrah! Gunakan Kod: <strong class="underline decoration-amber-400 font-bold text-white tracking-wider">AZURE2026</strong></span>
        </div>
        <div class="hidden lg:flex items-center gap-6 text-xs text-sky-100 font-medium">
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                Talian Concierge: +60 3-8888 2026
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Lesen MOTAC KPK/LN 8921 & IATA
            </span>
        </div>
    </div>
</div>

<!-- Main Navigation Header -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-sky-100 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand / Logo -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
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
                            Agensi Pelancongan Mewah
                        </span>
                    </div>
                </a>
            </div>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-7 text-sm font-semibold">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-sky-600 font-bold bg-sky-50/80 px-3 py-1.5 rounded-lg' : 'text-slate-700 hover:text-sky-600' }} transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Home</span>
                </a>

                <a href="{{ route('packages.index') }}" class="{{ request()->routeIs('packages.*') || request()->routeIs('booking.*') ? 'text-sky-600 font-bold bg-sky-50/80 px-3 py-1.5 rounded-lg' : 'text-slate-700 hover:text-sky-600' }} transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Packages</span>
                </a>

                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-sky-600 font-bold bg-sky-50/80 px-3 py-1.5 rounded-lg' : 'text-slate-700 hover:text-sky-600' }} transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>About Us</span>
                </a>

                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-sky-600 font-bold bg-sky-50/80 px-3 py-1.5 rounded-lg' : 'text-slate-700 hover:text-sky-600' }} transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span>Contact & Testimonials</span>
                </a>
            </nav>

            <!-- Actions / Auth Area -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <!-- Logged in Customer Dropdown / Links -->
                    <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition">
                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>My Bookings</span>
                    </a>

                    <div class="relative group">
                        <a href="{{ route('customer.profile') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-sky-600 hover:bg-slate-50 transition border border-slate-200">
                            <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-sky-500 to-blue-600 text-white flex items-center justify-center text-[10px] font-black uppercase">
                                {{ substr(Auth::user()->name ?? 'P', 0, 1) }}
                            </div>
                            <span class="max-w-[110px] truncate">{{ Auth::user()->name ?? 'Profil' }}</span>
                            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-1 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 hidden group-hover:block transition-all z-50">
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-xs font-extrabold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[11px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <span>Sejarah Tempahan</span>
                            </a>
                            <a href="{{ route('customer.profile') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Kemaskini Profil</span>
                            </a>
                            <div class="border-t border-slate-100 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>Log Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest View: Tempahan Saya & Sign Up & Login -->
                    <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-600 hover:text-sky-600 transition">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Tempahan Saya</span>
                    </a>

                    <a href="{{ route('signup') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-bold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition">
                        <span>Daftar Akaun</span>
                    </a>

                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 shadow-md shadow-sky-500/20 transition-all duration-200 transform hover:-translate-y-0.5 gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        <span>Log Masuk</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="md:hidden flex items-center gap-2">
                @auth
                    <a href="{{ route('customer.dashboard') }}" class="p-2 rounded-xl text-sky-600 bg-sky-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </a>
                @endauth
                <button type="button" onclick="document.getElementById('mobile-drawer').classList.toggle('hidden')" class="p-2.5 rounded-xl text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition" aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-drawer" class="hidden md:hidden border-t border-sky-100 bg-white px-4 pt-3 pb-6 space-y-2">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'text-sky-600 bg-sky-50' : 'text-slate-700' }}">
            <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span>Home</span>
        </a>
        <a href="{{ route('packages.index') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-sm font-semibold {{ request()->routeIs('packages.*') ? 'text-sky-600 bg-sky-50' : 'text-slate-700' }}">
            <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Packages</span>
        </a>
        <a href="{{ route('about') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-sm font-semibold {{ request()->routeIs('about') ? 'text-sky-600 bg-sky-50' : 'text-slate-700' }}">
            <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>About Us</span>
        </a>
        <a href="{{ route('contact') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-sm font-semibold {{ request()->routeIs('contact') ? 'text-sky-600 bg-sky-50' : 'text-slate-700' }}">
            <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            <span>Contact & Testimonials</span>
        </a>
        <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-xl text-sm font-semibold {{ request()->routeIs('customer.*') ? 'text-sky-600 bg-sky-50' : 'text-slate-700' }}">
            <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <span>My Bookings</span>
        </a>                
        <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
            @auth
                <a href="{{ route('customer.profile') }}" class="flex items-center justify-between py-2 px-3 rounded-xl bg-slate-50 text-slate-800 text-xs font-bold">
                    <span>Profil Saya ({{ Auth::user()->name }})</span>
                    <span class="text-sky-600">Edit →</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-center py-2.5 px-4 rounded-xl text-xs font-bold text-rose-600 bg-rose-50">
                        Log Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('signup') }}" class="w-full text-center py-2.5 px-4 rounded-xl text-xs font-bold text-sky-700 bg-sky-50 border border-sky-200">
                    Daftar Akaun Percuma
                </a>
                <a href="{{ route('login') }}" class="w-full text-center py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-sky-600 to-blue-600 shadow-md">
                    Log Masuk
                </a>
            @endauth
        </div>
    </div>
</header>

