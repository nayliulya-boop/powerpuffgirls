<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up | AzureVoyage Luxury Travel Agency</title>
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

    <!-- Minimal Navigation Header (Synced with Home, About & Login) -->
    <header class="sticky top-0 z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25">
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

                <!-- Nav Links -->
                <nav class="flex items-center gap-6 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-sky-600 transition">Home</a>
                    <a href="{{ route('about') }}" class="text-slate-600 hover:text-sky-600 transition">About</a>
                    <a href="{{ route('customer') }}" class="text-slate-600 hover:text-sky-600 transition">Customer</a>
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-sky-600 transition">Login</a>
                    <a href="{{ route('signup') }}" class="px-5 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-sky-600 to-blue-600 shadow-md shadow-sky-500/20">
                        Sign Up
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Minimal Centered Sign Up Card -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-sky-100 p-8 sm:p-10">

            <div class="text-center mb-8">
                <h1 class="font-extrabold text-3xl text-slate-900">
                    Create Account
                </h1>
                <p class="text-sm font-semibold text-slate-500 mt-1">
                    Join <span class="text-sky-600 font-bold">AzureVoyage</span> to plan your next escape.
                </p>
            </div>

            <!-- Alert Banner (Shown on Submit) -->
            <div id="signupSuccessAlert" class="hidden mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-sm font-bold text-center">
                🎉 Account created! Redirecting to Login...
            </div>

            <form id="signupForm" onsubmit="handleSignup(event)" class="space-y-5" novalidate>
                @csrf
                <div>
                    <label for="name" class="block text-xs font-extrabold uppercase tracking-wide text-slate-700 mb-1.5">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Jane Doe"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                    >
                </div>

                <div>
                    <label for="email" class="block text-xs font-extrabold uppercase tracking-wide text-slate-700 mb-1.5">
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="traveler@azurevoyage.com"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                    >
                </div>

                <div>
                    <label for="password" class="block text-xs font-extrabold uppercase tracking-wide text-slate-700 mb-1.5">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••••••"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm shadow-lg shadow-sky-600/25 transition"
                >
                    Sign Up →
                </button>
            </form>

            <p class="text-center text-sm font-semibold text-slate-600 mt-6 pt-6 border-t border-slate-100">
                Already have an account?
                <a href="{{ route('login') }}" class="text-sky-600 font-extrabold hover:underline ml-1">
                    Sign In
                </a>
            </p>
        </div>
    </main>

    <script>
        function handleSignup(e) {
            e.preventDefault();
            document.getElementById('signupSuccessAlert').classList.remove('hidden');
            setTimeout(() => {
                window.location.href = '/login';
            }, 800);
        }
    </script>
</body>
</html>

