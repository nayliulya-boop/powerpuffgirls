<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us — Powerpuff Girls Travel Agency</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN for instant styling without build dependency -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        heading: ['"Outfit"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 font-sans antialiased flex flex-col justify-between">

    <!-- Top Navigation Bar (Synchronized with Home & Login) -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand / Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white font-bold shadow-md shadow-sky-500/20 group-hover:scale-105 transition-transform">
                    ✈️
                </div>
                <div>
                    <span class="font-extrabold text-lg text-slate-900 leading-tight block">
                        Powerpuff<span class="text-sky-600">Girls</span>
                    </span>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-slate-500 block -mt-0.5">
                        Travel Agency
                    </span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="flex items-center gap-2 sm:gap-4 text-sm font-semibold">
                <a href="{{ route('home') }}" class="px-3 py-1.5 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-slate-100 transition">
                    Home
                </a>
                <a href="{{ route('about') }}" class="px-3 py-1.5 rounded-lg text-sky-600 bg-sky-50 font-bold transition">
                    About
                </a>
                <a href="{{ route('login') }}" class="ml-2 px-4 py-1.5 rounded-lg bg-orange-600 hover:bg-orange-700 text-white font-bold shadow-sm transition">
                    Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-12 flex-1 w-full">
        <!-- Hero Card -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl p-8 sm:p-12 mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Test Mode Active • No Database Connected</span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight font-heading mb-4">
                About Our Project
            </h1>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-6">
                This is a simple, lightweight <strong>About Page</strong> created for testing and branch synchronization. It operates completely in memory without requiring a database connection.
            </p>

            <!-- Quick Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-slate-100">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-2xl mb-2">🏖️</div>
                    <h2 class="font-bold text-slate-900 text-sm mb-1 font-heading">Travel Agency</h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        AzureVoyage & ulyaboolatkepalastoopid travel agency web portal.
                    </p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-2xl mb-2">⚡</div>
                    <h2 class="font-bold text-slate-900 text-sm mb-1 font-heading">Pure Static Test</h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Rendered purely via Laravel Blade without any database queries.
                    </p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="text-2xl mb-2">🔄</div>
                    <h2 class="font-bold text-slate-900 text-sm mb-1 font-heading">Branch Synced</h2>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Interconnected with the Home and Login pages across git branches.
                    </p>
                </div>
            </div>
        </div>

        <!-- Team & Navigation Quick Actions -->
        <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-cyan-600 rounded-3xl p-8 sm:p-10 text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-bold font-heading mb-1">
                    Ready to Explore?
                </h2>
                <p class="text-sm text-sky-100 max-w-md">
                    Switch between the travel home showcase, the test login portal, or return here at any time.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-white text-sky-700 font-bold text-sm shadow hover:bg-sky-50 transition">
                    ← Home Page
                </a>
                <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm shadow transition">
                    Login Page →
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        <div class="max-w-6xl mx-auto px-4">
            <p>© {{ date('Y') }} Powerpuff Girls Travel Agency Project. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
