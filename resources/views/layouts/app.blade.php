<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AzureVoyage | Pakej Pelancongan Mewah & Tempahan Dalam Talian')</title>
    <meta name="description" content="@yield('meta_description', 'Agensi pelancongan rasmi AzureVoyage - Pakej Pulau, Pakej Umrah/Haji, Honeymoon, dan Day Trip dengan tempahan serta pembayaran pantas.')">

    <!-- Fonts: Outfit & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN fallback for instant perfect rendering + Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .bg-mesh-blue {
            background-color: #f0f7ff;
            background-image:
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(224, 242, 254, 0.6) 0px, transparent 50%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(224, 242, 254, 0.9);
        }
        .travel-shadow {
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.08), 0 4px 6px -2px rgba(15, 23, 42, 0.03);
        }
        .travel-shadow-lg {
            box-shadow: 0 20px 40px -10px rgba(2, 132, 199, 0.14), 0 8px 16px -4px rgba(15, 23, 42, 0.04);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-slate-900 antialiased selection:bg-sky-500 selection:text-white">

    <!-- Global Navigation -->
    @include('partials.navbar')

    <!-- Flash Notifications -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-4">
        @if(session('success'))
            <div class="mb-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-900 flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0">✓</span>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 font-bold text-lg">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 rounded-2xl bg-rose-50 border border-rose-300 text-rose-900 flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-rose-500 text-white flex items-center justify-center font-bold text-sm shrink-0">!</span>
                    <p class="text-sm font-bold">{{ session('error') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 font-bold text-lg">&times;</button>
            </div>
        @endif

        @if(session('info'))
            <div class="mb-4 p-4 rounded-2xl bg-sky-50 border border-sky-300 text-sky-900 flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold text-sm shrink-0">i</span>
                    <p class="text-sm font-bold">{{ session('info') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-sky-700 hover:text-sky-900 font-bold text-lg">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 rounded-2xl bg-amber-50 border border-amber-300 text-amber-900 shadow-sm animate-fade-in">
                <div class="flex items-center gap-2 mb-2 font-bold text-sm">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>Sila semak maklumat yang dimasukkan:</span>
                </div>
                <ul class="list-disc list-inside text-xs font-semibold space-y-1 text-amber-800">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Page Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Global Footer -->
    @include('partials.footer')

    @stack('scripts')
</body>
</html>

