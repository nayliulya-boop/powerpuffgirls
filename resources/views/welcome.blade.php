<!DOCTYPE html>  //testttt
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — ulyaboolatkepalastoopid Travel Agency</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Syne"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-900 font-sans antialiased flex items-center justify-center p-4 sm:p-6 lg:p-10">

    <!-- Background Ambient Glow -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-orange-500/20 blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-pink-500/20 blur-3xl"></div>
    </div>

    <!-- Main Login Card Container -->
    <div class="relative z-10 w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[640px]">

        <!-- Left Visual Banner (Travel Agency Showcase) -->
        <div class="lg:col-span-6 relative bg-slate-900 text-white p-8 sm:p-12 flex flex-col justify-between overflow-hidden">
            <img
                src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=85"
                alt="Tropical Beach"
                class="absolute inset-0 w-full h-full object-cover opacity-55 scale-105"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/50 to-slate-950/60"></div>

            <!-- Brand Header -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-orange-500 via-pink-500 to-amber-400 flex items-center justify-center text-white font-display font-extrabold text-xl shadow-lg shadow-orange-500/30">
                    U
                </div>
                <div>
                    <span class="font-display font-extrabold text-lg sm:text-xl tracking-tight text-white block leading-none">
                        ulyaboolatkepalastoopid
                    </span>
                    <span class="text-[11px] font-bold uppercase tracking-widest text-amber-300">
                        Travel Agency Portal
                    </span>
                </div>
            </div>

            <!-- Tagline & Stats -->
            <div class="relative z-10 my-10 lg:my-0">
                <span class="inline-block px-3.5 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-xs font-semibold text-amber-300 mb-4">
                    ✈️ Explorer Member Club
                </span>
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl leading-tight mb-4">
                    Pack Your Bags.<br>Leave the Thinking to Us.
                </h1>
                <p class="text-sm text-slate-200/90 leading-relaxed max-w-md">
                    Sign in to your <strong>ulyaboolatkepalastoopid</strong> account to manage your flight tickets, secret island villas, and 24/7 concierge requests.
                </p>
            </div>

            <!-- Bottom Testimonial Pill -->
            <div class="relative z-10 bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-4 flex items-center justify-between">
                <div>
                    <div class="text-amber-400 text-xs font-bold">★★★★★ 4.98 Agency Rating</div>
                    <div class="text-xs text-slate-200 mt-0.5">"Best zero-stress vacation we ever booked!"</div>
                </div>
                <span class="text-xs font-bold text-white bg-orange-500/80 px-3 py-1 rounded-full">120+ Destinations</span>
            </div>
        </div>

        <!-- Right Login Form -->
        <div class="lg:col-span-6 p-8 sm:p-12 flex flex-col justify-center bg-white">
            <div class="max-w-md mx-auto w-full">
                <div class="mb-8">
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900">
                        Welcome Back! 👋
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Log in to your <span class="font-semibold text-orange-600">ulyaboolatkepalastoopid</span> traveler dashboard.
                    </p>
                </div>

                <!-- Alert Banner (Hidden by default, shown on submit) -->
                <div id="loginSuccessAlert" class="hidden mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                    🎉 Logged in! Redirecting to your ulyaboolatkepalastoopid itinerary...
                </div>

                <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-5">
                    @csrf
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                required
                                placeholder="ulya@boolatkepalastoopid.com"
                                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 text-sm font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition"
                            >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                                Password
                            </label>
                            <a href="#" onclick="alert('Password reset link sent to your email!'); return false;" class="text-xs font-bold text-orange-600 hover:text-orange-700">
                                Forgot password?
                            </a>
                        </div>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="••••••••••••"
                                class="w-full px-4 py-3.5 pr-16 rounded-xl bg-slate-50 border border-slate-200 text-sm font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition"
                            >
                            <button
                                type="button"
                                onclick="togglePassword()"
                                id="toggleBtn"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400 hover:text-slate-700 px-2 py-1"
                            >
                                SHOW
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" checked class="w-4 h-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                            <span class="text-xs font-semibold text-slate-600">Keep me signed in for my next trip</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-orange-500 via-orange-600 to-pink-500 hover:from-orange-600 hover:to-pink-600 text-white font-bold text-sm shadow-lg shadow-orange-500/25 transition transform active:scale-[0.99]"
                    >
                        Sign In to Travel Portal →
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-7">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white px-3 text-slate-400 font-bold tracking-wider">Or continue with</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" onclick="handleSocialLogin('Google')" class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border border-slate-200 hover:bg-slate-50 text-xs font-bold text-slate-700 transition">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M12 5c1.6 0 3 .6 4.1 1.7l3.1-3.1C17.3 1.8 14.8 1 12 1 7.4 1 3.5 3.6 1.6 7.4l3.7 2.8C6.2 7.2 8.9 5 12 5z"/>
                            <path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.6l3.7 2.9c2.2-2 3.7-5 3.7-8.7z"/>
                            <path fill="#FBBC05" d="M5.3 14.8c-.2-.8-.4-1.6-.4-2.5s.2-1.7.4-2.5L1.6 7C.6 9 0 11.2 0 13.5s.6 4.5 1.6 6.5l3.7-2.9z"/>
                            <path fill="#34A853" d="M12 24c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3.1 0-5.8-2.1-6.7-5l-3.7 2.8C3.5 21.4 7.4 24 12 24z"/>
                        </svg>
                        <span>Google</span>
                    </button>
                    <button type="button" onclick="handleSocialLogin('Apple Pass')" class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border border-slate-200 hover:bg-slate-50 text-xs font-bold text-slate-700 transition">
                        <span></span>
                        <span>Apple ID</span>
                    </button>
                </div>

                <!-- Sign Up Prompt -->
                <p class="text-center text-xs text-slate-500 mt-8">
                    New to <span class="font-bold text-slate-700">ulyaboolatkepalastoopid</span>?
                    <a href="#" onclick="alert('Registration portal opening soon!'); return false;" class="font-bold text-orange-600 hover:underline ml-1">
                        Create a traveler account
                    </a>
                </p>
            </div>
        </div>
    </div>

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
        }

        function handleSocialLogin(provider) {
            const alertBox = document.getElementById('loginSuccessAlert');
            alertBox.textContent = `🎉 Authenticating with ${provider} for ulyaboolatkepalastoopid...`;
            alertBox.classList.remove('hidden');
        }
    </script>
</body>
</html>

