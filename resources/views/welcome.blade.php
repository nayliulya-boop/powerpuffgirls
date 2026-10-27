<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | AzureVoyage Luxury Travel Agency</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: #0f172a;
            background-color: #082f49;
            background-image:
                linear-gradient(135deg, rgba(12, 74, 110, 0.78) 0%, rgba(15, 23, 42, 0.72) 50%, rgba(3, 105, 161, 0.75) 100%),
                url('https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=2000&q=85');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-topbar {
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.14);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(22px) saturate(180%);
            -webkit-backdrop-filter: blur(22px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.55);
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.15);
        }
        .glass-shell {
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(28px) saturate(190%);
            -webkit-backdrop-filter: blur(28px) saturate(190%);
            border: 1px solid rgba(255, 255, 255, 0.42);
            box-shadow:
                0 30px 60px -15px rgba(2, 6, 23, 0.45),
                inset 0 1px 1px 0 rgba(255, 255, 255, 0.65);
        }
        .glass-showcase {
            background: linear-gradient(155deg, rgba(14, 116, 144, 0.52) 0%, rgba(3, 105, 161, 0.62) 55%, rgba(15, 23, 42, 0.72) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.22);
        }
        .glass-form-panel {
            background: rgba(255, 255, 255, 0.84);
            backdrop-filter: blur(26px) saturate(180%);
            -webkit-backdrop-filter: blur(26px) saturate(180%);
        }
        .glass-pill {
            background: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.28);
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.35);
        }
        .glass-input {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1.5px solid rgba(186, 230, 253, 0.85);
            box-shadow: inset 0 2px 4px 0 rgba(15, 23, 42, 0.03);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.96);
            border-color: #0284c7;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.18), 0 8px 20px -6px rgba(2, 132, 199, 0.18);
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-14px) scale(1.04); }
        }
        .orb-float {
            animation: floatSlow 9s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white relative overflow-x-hidden">

    <!-- Ambient Decorative Glass Orbs -->
    <div class="fixed -top-28 -left-28 w-96 h-96 rounded-full bg-cyan-400/30 blur-3xl pointer-events-none orb-float"></div>
    <div class="fixed top-1/3 -right-28 w-[28rem] h-[28rem] rounded-full bg-sky-500/30 blur-3xl pointer-events-none orb-float" style="animation-delay: -4s;"></div>
    <div class="fixed -bottom-32 left-1/3 w-96 h-96 rounded-full bg-blue-600/25 blur-3xl pointer-events-none orb-float" style="animation-delay: -2s;"></div>

    <!-- Top Announcement Bar -->
    <div class="glass-topbar text-white text-xs sm:text-sm py-2.5 px-4 relative z-40">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2.5">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-400/25 text-sky-200 border border-sky-300/30 backdrop-blur-md">
                    ✈️ Traveler Portal
                </span>
                <span class="text-sky-100/95">Sign in to manage your <strong class="text-white">AzureVoyage</strong> luxury escapes & bespoke itineraries</span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-200 font-medium">
                <span>24/7 Concierge: +1 (800) 429-8732</span>
                <span class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>IATA & ATOL Protected</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Frosted Glass Navigation Header -->
    <header class="sticky top-0 z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/30 group-hover:scale-105 transition-transform duration-300">
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
                            Luxury Travel Agency
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links & Language Switcher -->
                <nav class="flex items-center gap-3 sm:gap-6 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="text-slate-700 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span class="hidden sm:inline">{{ __('Home') }}</span>
                    </a>
                    <a href="{{ route('about') }}" class="text-slate-700 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="hidden sm:inline">{{ __('About') }}</span>
                    </a>
                    <a href="{{ route('signup') }}" class="text-slate-700 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        <span class="hidden sm:inline">{{ __('Sign Up') }}</span>
                    </a>
                    <a href="{{ url('/login') }}" class="px-5 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-sky-600 via-blue-600 to-cyan-500 shadow-lg shadow-sky-500/25 whitespace-nowrap">
                        {{ __('Login') }}
                    </a>
                    @include('partials.language-switcher')
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Glassmorphic Login Showcase -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-12 relative z-10">
        <div class="w-full max-w-5xl glass-shell rounded-[2rem] p-2 sm:p-3">
            <div class="rounded-[1.6rem] overflow-hidden grid grid-cols-1 lg:grid-cols-12">

                <!-- Left Frosted Glass Showcase Panel -->
                <div class="lg:col-span-5 glass-showcase text-white p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden">
                    <!-- Specular Light Highlight -->
                    <div class="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-cyan-300/25 blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-24 -right-24 w-64 h-64 rounded-full bg-sky-400/20 blur-2xl pointer-events-none"></div>

                    <!-- Top Brand Badge -->
                    <div class="relative z-10 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 shrink-0 rounded-2xl glass-pill flex items-center justify-center text-white shadow-lg">
                                <svg class="w-6 h-6 transform -rotate-45 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                    <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                                </svg>
                            </div>
                            <div>
                                <span class="font-extrabold text-xl tracking-tight text-white block leading-tight">
                                    AzureVoyage
                                </span>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-cyan-200 block">
                                    Luxury Travel Sanctuary
                                </span>
                            </div>
                        </div>
                        <span class="glass-pill px-3 py-1 rounded-full text-[11px] font-bold text-cyan-100">
                            ★ 4.98 / 5
                        </span>
                    </div>

                    <!-- Center Editorial Copy -->
                    <div class="relative z-10 my-10 space-y-5">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full glass-pill text-xs font-bold text-cyan-100 tracking-wide">
                            <span>✨</span>
                            <span>Explorer Member Club</span>
                        </span>
                        <h1 class="font-extrabold text-3xl sm:text-4xl leading-tight text-white drop-shadow-sm">
                            Where Blue Skies Meet Crystal Horizons.
                        </h1>
                        <p class="text-sm sm:text-base font-medium text-sky-100/90 leading-relaxed">
                            Sign in to your <strong>AzureVoyage</strong> account to manage your flight tickets, overwater villas, and 24/7 concierge requests.
                        </p>

                        <!-- Floating Glass Feature Pills -->
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <div class="glass-pill rounded-2xl p-3.5">
                                <div class="text-cyan-200 text-xs font-extrabold uppercase tracking-wider">VIP Perks</div>
                                <div class="text-xs font-semibold text-white/95 mt-1">Suite upgrades & private transfers</div>
                            </div>
                            <div class="glass-pill rounded-2xl p-3.5">
                                <div class="text-amber-300 text-xs font-extrabold uppercase tracking-wider">Protected</div>
                                <div class="text-xs font-semibold text-white/95 mt-1">100% ATOL & IATA financial bonding</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Glass Destination Spotlight -->
                    <div class="relative z-10 glass-pill rounded-2xl p-4 flex items-center justify-between gap-3">
                        <div>
                            <div class="text-[11px] font-bold uppercase tracking-widest text-cyan-200">Featured Member Sanctuary</div>
                            <div class="text-sm font-extrabold text-white mt-0.5">Overwater Sunset Villa • Baa Atoll, Maldives</div>
                        </div>
                        <span class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-white shrink-0">
                            🏝️
                        </span>
                    </div>
                </div>

                <!-- Right Frosted Glass Login Form -->
                <div class="lg:col-span-7 glass-form-panel p-8 sm:p-12 flex flex-col justify-center">
                    <div class="max-w-md mx-auto w-full">
                        <div class="mb-8">
                            <div class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-sky-700 bg-sky-100/80 border border-sky-200/80 backdrop-blur-sm px-3.5 py-1.5 rounded-full mb-3">
                                <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                                <span>Secure Traveler Sign-In</span>
                            </div>
                            <h2 class="font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
                                Welcome Back! 👋
                            </h2>
                            <p class="text-sm sm:text-base font-medium text-slate-600 mt-1.5">
                                Log in to your <span class="font-extrabold text-sky-600">AzureVoyage</span> traveler dashboard.
                            </p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-6 p-4 rounded-2xl bg-rose-50/90 backdrop-blur-md border border-rose-200 text-rose-800 text-sm font-bold shadow-sm" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form id="loginForm" method="POST" action="{{ route('login.store') }}" class="space-y-5">
                            @csrf
                            <div>
                                <label for="email" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2">
                                    {{ __('Email Address') }}
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </span>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="traveler@azurevoyage.com"
                                        autocomplete="email"
                                        required
                                        class="w-full pl-12 pr-4 py-3.5 rounded-2xl glass-input text-sm sm:text-base font-semibold text-slate-900 placeholder-slate-400 focus:outline-none"
                                    >
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="password" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                                        {{ __('Password') }}
                                    </label>
                                    <a href="#" onclick="alert('Password reset link sent!'); return false;" class="text-xs font-bold text-sky-600 hover:text-sky-700 hover:underline">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                </div>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    </span>
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="••••••••••••"
                                        autocomplete="current-password"
                                        required
                                        class="w-full pl-12 pr-20 py-3.5 rounded-2xl glass-input text-sm sm:text-base font-semibold text-slate-900 placeholder-slate-400 focus:outline-none"
                                    >
                                    <button
                                        type="button"
                                        onclick="togglePassword()"
                                        id="toggleBtn"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-[11px] font-extrabold text-sky-800 bg-sky-100/90 hover:bg-sky-200/90 border border-sky-200/80 backdrop-blur-sm rounded-xl px-3 py-1.5 transition"
                                    >
                                        SHOW
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between pt-1">
                                <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                                    <input type="checkbox" name="remember" value="1" @checked(old('remember')) class="w-4 h-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                                    <span class="text-xs sm:text-sm font-semibold text-slate-700">{{ __('Remember Me') }}</span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-sky-600 via-blue-600 to-cyan-500 hover:from-sky-500 hover:via-blue-500 hover:to-cyan-400 text-white font-extrabold text-base shadow-xl shadow-sky-600/25 hover:shadow-2xl hover:shadow-sky-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 flex items-center justify-center gap-2"
                            >
                                <span>{{ __('Sign In') }}</span>
                                <span>→</span>
                            </button>
                        </form>

                        <!-- Quick Links to Other Pages -->
                        <div class="mt-8 pt-6 border-t border-slate-200/70 flex flex-wrap items-center justify-between gap-3 text-xs sm:text-sm font-bold">
                            <a href="{{ route('about') }}" class="text-slate-600 hover:text-sky-600 hover:underline transition">About Us</a>
                            <a href="{{ route('signup') }}" class="text-sky-600 hover:text-sky-700 hover:underline transition">Create Account (Sign Up) →</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Frosted Footer -->
    <footer class="py-5 text-center text-xs text-sky-100/80 relative z-10">
        <p>© {{ date('Y') }} AzureVoyage Luxury Travel Agency. ATOL & IATA Protected.</p>
    </footer>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const btn = document.getElementById('toggleBtn');
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = 'HIDE';
            } else {
                input.type = 'password';
                btn.textContent = 'SHOW';
            }
        }
    </script>
    @include('partials.logout-toastr')
</body>
</html>
