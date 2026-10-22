<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel History | AzureVoyage Luxury Travel Agency</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
        }
        h1, h2, h3, h4 {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.9);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white">

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 glass-nav shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 group">
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
                        <span class="block text-[10px] uppercase tracking-widest font-bold text-sky-600 -mt-1">
                            Customer Portal
                        </span>
                    </div>
                </a>

                <div class="flex items-center gap-3 sm:gap-6">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                        <a href="{{ route('customer.dashboard') }}" class="hover:text-sky-600 transition">Dashboard</a>
                        <a href="{{ route('customer.profile') }}" class="hover:text-sky-600 transition">My Profile</a>
                        <a href="{{ route('customer.history') }}" class="text-sky-600 font-bold">History</a>
                    </nav>

                    <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                        <span class="hidden sm:inline text-sm font-bold text-slate-900">{{ $user->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 sm:px-3 sm:py-2 text-xs font-bold text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-xl border border-slate-200 hover:border-red-200 transition flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span class="hidden sm:inline">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Travel Archive</span>
            <h1 class="text-3xl font-extrabold text-slate-900 mt-1">Completed & Past Journeys</h1>
            <p class="text-sm text-slate-500">Review your completed luxury itineraries and archived bookings.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($vacations as $vacation)
                <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm flex flex-col justify-between gap-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="font-mono text-xs font-bold text-sky-600">{{ $vacation->package_code }}</span>
                            <h3 class="text-lg font-extrabold text-slate-900 mt-0.5">{{ $vacation->destination }}</h3>
                            <p class="text-sm text-slate-600">{{ $vacation->title }}</p>
                        </div>
                        @if ($vacation->status === 'completed')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                Completed Journey
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                Cancelled
                            </span>
                        @endif
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span>{{ $vacation->start_date->format('M d, Y') }} – {{ $vacation->end_date->format('M d, Y') }}</span>
                        <span class="font-extrabold text-slate-900 text-sm">${{ number_format((float) $vacation->price, 2) }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-2 rounded-2xl bg-white border border-slate-200 p-10 text-center text-slate-500">
                    No past or completed journeys recorded yet.
                </div>
            @endforelse
        </div>
    </main>

    @include('partials.logout-toastr')
</body>
</html>

