<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | AzureVoyage Luxury Travel Agency</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
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
            background-color: #f0f7ff;
            background-image:
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.14) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(56, 189, 248, 0.16) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(224, 242, 254, 0.7) 0px, transparent 50%);
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.9);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top Announcement Bar (Synced with Home & About) -->
    <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 text-white text-xs sm:text-sm py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                    ✈️ Traveler Portal
                </span>
                <span>Sign in to manage your <strong>AzureVoyage</strong> luxury escapes & bespoke itineraries</span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-100">
                <span>24/7 Concierge: +1 (800) 429-8732</span>
                <span>IATA & ATOL Protected</span>
            </div>
        </div>
    </div>

    <!-- Navigation Header (Synchronized with Home & About) -->
    <header class="sticky top-0 z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
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
                        <span class="block text-[10px] uppercase tracking-widest font-semibold text-sky-600 -mt-1">
                            Luxury Travel Agency
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="flex items-center gap-6 sm:gap-8 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('about') }}" class="text-slate-600 hover:text-sky-600 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>About</span>
                    </a>
                    <a href="{{ url('/login') }}" class="px-5 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-sky-600 to-blue-600 shadow-md shadow-sky-500/20">
                        Login
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Login Card Section -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-10">
        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl border border-sky-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

            <!-- Left Branding Panel (No Photo, Clean White & Blue Elegance Gradient) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-sky-700 via-blue-600 to-cyan-500 text-white p-8 sm:p-10 flex flex-col justify-between">
                <!-- Brand Header -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 shrink-0 rounded-2xl bg-white text-sky-600 flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                            <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span class="font-extrabold text-2xl tracking-tight text-white block leading-tight whitespace-nowrap">
                            AzureVoyage
                        </span>
                        <span class="text-xs font-bold uppercase tracking-widest text-sky-100 block mt-0.5">
                            Luxury Travel Agency
                        </span>
                    </div>
                </div>

                <!-- Tagline -->
                <div class="my-10">
                    <span class="inline-block px-3.5 py-1.5 rounded-full bg-white/20 text-sm font-bold text-white mb-4">
                        ✈️ Explorer Member Club
                    </span>
                    <h1 class="font-extrabold text-3xl sm:text-4xl leading-snug mb-4 text-white">
                        Where Blue Skies Meet Crystal Horizons.
                    </h1>
                    <p class="text-base font-medium text-white/95 leading-relaxed">
                        Sign in to your <strong>AzureVoyage</strong> account to manage your flight tickets, overwater villas, and 24/7 concierge requests.
                    </p>
                </div>

                <!-- Bottom Rating Pill -->
                <div class="bg-slate-900/25 border border-white/15 rounded-2xl p-4">
                    <div class="text-amber-300 text-sm font-extrabold">★★★★★ 4.98 Agency Rating</div>
                    <div class="text-sm font-semibold text-white mt-1">150+ Bespoke Blue Destinations</div>
                </div>
            </div>

            <!-- Right Login Form -->
            <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">
                <div class="max-w-md mx-auto w-full">
                    <div class="mb-8">
                        <span class="inline-block text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full mb-2">
                            No Database Connected (Test Mode)
                        </span>
                        <h2 class="font-extrabold text-3xl text-slate-900">
                            Welcome Back! 👋
                        </h2>
                        <p class="text-base font-semibold text-slate-600 mt-1">
                            Log in to your <span class="font-extrabold text-sky-600">AzureVoyage</span> traveler dashboard.
                        </p>
                    </div>

                    <!-- Alert Banner (Hidden by default, shown on submit) -->
                    <div id="loginSuccessAlert" class="hidden mb-6 p-4 rounded-2xl bg-emerald-50 border-2 border-emerald-300 text-emerald-900 text-base font-bold">
                        🎉 Test Login Successful! Redirecting to AzureVoyage Home...
                    </div>

                    <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-6" novalidate>
                        @csrf
                        <!-- Email Input (Not Required for Testing) -->
                        <div>
                            <label for="email" class="block text-sm font-extrabold uppercase tracking-wide text-slate-800 mb-2">
                                Email Address <span class="text-slate-400 font-semibold normal-case">(Optional for test)</span>
                            </label>
                            <input
                                type="text"
                                id="email"
                                name="email"
                                placeholder="traveler@azurevoyage.com"
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 border-2 border-slate-300 text-base font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                            >
                        </div>

                        <!-- Password Input (Not Required for Testing) -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-extrabold uppercase tracking-wide text-slate-800">
                                    Password <span class="text-slate-400 font-semibold normal-case">(Optional for test)</span>
                                </label>
                                <a href="#" onclick="alert('Password reset link sent!'); return false;" class="text-sm font-bold text-sky-600 hover:underline">
                                    Forgot password?
                                </a>
                            </div>
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••••••"
                                    class="w-full px-4 py-3.5 pr-20 rounded-xl bg-slate-50 border-2 border-slate-300 text-base font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    id="toggleBtn"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-extrabold text-sky-800 bg-sky-100 hover:bg-sky-200 rounded-lg px-2.5 py-1.5 transition"
                                >
                                    SHOW
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center gap-2.5 cursor-pointer">
                                <input type="checkbox" checked class="w-5 h-5 rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                                <span class="text-sm font-bold text-slate-700">Keep me signed in</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-base shadow-lg shadow-sky-600/25 transition"
                        >
                            Sign In (Test Login) →
                        </button>
                    </form>

                    <!-- Quick Links to Other Pages -->
                    <div class="mt-8 pt-6 border-t border-slate-200 flex flex-wrap items-center justify-between gap-3 text-sm font-bold">
                        <a href="{{ route('home') }}" class="text-sky-600 hover:underline">← Home</a>
                        <a href="{{ route('about') }}" class="text-slate-600 hover:text-sky-600 hover:underline">About Us</a>
                        <a href="{{ route('customer') }}" class="text-sky-600 hover:underline">Customer VIP Portal →</a>
                    <div class="mt-8 pt-6 border-t border-slate-200 flex items-center justify-between text-sm font-bold">
                        <a href="{{ route('home') }}" class="text-slate-600 hover:text-sky-600 hover:underline">← Home</a>
                        <a href="{{ route('signup') }}" class="text-sky-600 hover:underline">Create Account (Sign Up) →</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

        function handleLogin(e) {
            e.preventDefault();
            const alertBox = document.getElementById('loginSuccessAlert');
            alertBox.classList.remove('hidden');
            setTimeout(() => {
                window.location.href = '/home';
            }, 800);
        }
    </script>
</body>
</html>
