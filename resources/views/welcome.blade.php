<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — ulyaboolatkepalastoopid Travel Agency</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-900 text-slate-900 font-sans antialiased flex items-center justify-center p-4 sm:p-6 lg:p-10">

    <!-- Main Login Card Container -->
    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        <!-- Left Branding Panel (No Photo, Clean High-Contrast Gradient) -->
        <div class="lg:col-span-5 bg-gradient-to-br from-orange-600 via-orange-500 to-pink-600 text-white p-8 sm:p-10 flex flex-col justify-between">
            <!-- Brand Header -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-white text-orange-600 flex items-center justify-center font-black text-2xl shadow-md">
                    U
                </div>
                <div>
                    <span class="font-extrabold text-xl tracking-tight text-white block leading-tight break-all">
                        ulyaboolatkepalastoopid
                    </span>
                    <span class="text-xs font-bold uppercase tracking-widest text-orange-100">
                        Travel Agency Portal
                    </span>
                </div>
            </div>

            <!-- Tagline -->
            <div class="my-10">
                <span class="inline-block px-3.5 py-1.5 rounded-full bg-white/20 text-sm font-bold text-white mb-4">
                    ✈️ Explorer Member Club
                </span>
                <h1 class="font-black text-3xl sm:text-4xl leading-snug mb-4 text-white">
                    Pack Your Bags.<br>Leave the Thinking to Us.
                </h1>
                <p class="text-base font-medium text-white/95 leading-relaxed">
                    Sign in to your <strong>ulyaboolatkepalastoopid</strong> account to manage your flight tickets, island villas, and concierge requests.
                </p>
            </div>

            <!-- Bottom Rating Pill -->
            <div class="bg-black/20 rounded-2xl p-4">
                <div class="text-amber-300 text-sm font-extrabold">★★★★★ 4.98 Agency Rating</div>
                <div class="text-sm font-semibold text-white mt-1">120+ Global Destinations</div>
            </div>
        </div>

        <!-- Right Login Form -->
        <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">
            <div class="max-w-md mx-auto w-full">
                <div class="mb-8">
                    <h2 class="font-black text-3xl text-slate-900">
                        Welcome Back! 👋
                    </h2>
                    <p class="text-base font-semibold text-slate-600 mt-2">
                        Log in to <span class="font-extrabold text-orange-600">ulyaboolatkepalastoopid</span> travel dashboard.
                    </p>
                </div>

                <!-- Alert Banner (Hidden by default, shown on submit) -->
                <div id="loginSuccessAlert" class="hidden mb-6 p-4 rounded-2xl bg-emerald-50 border-2 border-emerald-300 text-emerald-900 text-base font-bold">
                    🎉 Test Login Successful! Welcome to ulyaboolatkepalastoopid!
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
                            placeholder="ulya@boolatkepalastoopid.com"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-50 border-2 border-slate-300 text-base font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:bg-white transition"
                        >
                    </div>

                    <!-- Password Input (Not Required for Testing) -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-extrabold uppercase tracking-wide text-slate-800">
                                Password <span class="text-slate-400 font-semibold normal-case">(Optional for test)</span>
                            </label>
                            <a href="#" onclick="alert('Password reset link sent!'); return false;" class="text-sm font-bold text-orange-600 hover:underline">
                                Forgot password?
                            </a>
                        </div>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••••••"
                                class="w-full px-4 py-3.5 pr-20 rounded-xl bg-slate-50 border-2 border-slate-300 text-base font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:bg-white transition"
                            >
                            <button
                                type="button"
                                onclick="togglePassword()"
                                id="toggleBtn"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-extrabold text-slate-700 bg-slate-200 hover:bg-slate-300 rounded-lg px-2.5 py-1.5"
                            >
                                SHOW
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" checked class="w-5 h-5 rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                            <span class="text-sm font-bold text-slate-700">Keep me signed in</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-4 px-6 rounded-xl bg-orange-600 hover:bg-orange-700 text-white font-extrabold text-base shadow-lg shadow-orange-600/25 transition"
                    >
                        Sign In (Test Login) →
                    </button>
                </form>

                <!-- Quick Links to Other Pages -->
                <div class="mt-8 pt-6 border-t border-slate-200 flex items-center justify-between text-sm font-bold">
                    <a href="{{ url('/home') }}" class="text-orange-600 hover:underline">Go to Home Page →</a>
                    <a href="{{ url('/about') }}" class="text-slate-600 hover:text-slate-900 hover:underline">About Us</a>
                </div>
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
            setTimeout(() => {
                window.location.href = '/home';
            }, 800);
        }
    </script>
</body>
</html>
