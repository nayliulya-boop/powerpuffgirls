<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us — ulyaboolatkepalastoopid Travel Agency</title>
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
<body class="bg-slate-50 text-slate-900 font-sans antialiased">

    <!-- Navbar -->
    <header class="bg-white/90 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-orange-500 via-pink-500 to-amber-400 flex items-center justify-center text-white font-display font-extrabold text-xl">
                    U
                </div>
                <div>
                    <span class="font-display font-extrabold text-lg sm:text-xl tracking-tight text-slate-900 block leading-none">
                        ulyaboolatkepalastoopid
                    </span>
                    <span class="text-xs font-semibold uppercase tracking-widest text-orange-600">
                        Global Travel Agency
                    </span>
                </div>
            </a>

            <nav class="flex items-center gap-6 text-sm font-semibold text-slate-600">
                <a href="{{ url('/') }}" class="hover:text-orange-600 transition">Home</a>
                <a href="{{ url('/#packages') }}" class="hover:text-orange-600 transition">Tour Packages</a>
                <a href="{{ url('/about') }}" class="text-orange-600 font-bold">About Us</a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="py-20 bg-slate-900 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-400/10 px-4 py-1.5 rounded-full">
                Our Origin Story
            </span>
            <h1 class="font-display font-extrabold text-4xl sm:text-6xl mt-6 mb-6">
                Behind <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-400 to-pink-400">ulyaboolatkepalastoopid</span>
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Born from chaotic group chats, missed airport gates, and a dream to let travelers turn their brains completely off while exploring the globe.
            </p>
        </div>
    </section>

    <!-- Story & Mission -->
    <section class="py-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=1000&q=80" alt="Travel Squad" class="rounded-3xl shadow-xl">
            </div>
            <div>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mb-4">
                    Why the name "ulyaboolatkepalastoopid"?
                </h2>
                <p class="text-slate-600 mb-4 leading-relaxed">
                    Because planning a vacation shouldn't require a PhD in spreadsheet engineering! Our founder, <strong>Ulya Boolat</strong>, realized that the best travel memories happen when you stop overthinking and start experiencing.
                </p>
                <p class="text-slate-600 mb-8 leading-relaxed">
                    Whether you're chasing the Northern Lights in Iceland, slurping midnight ramen in Tokyo, or floating in a private Maldives lagoon, our squad handles 100% of the logistics so you can simply show up and vibe.
                </p>
                <a href="{{ url('/#packages') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-orange-500/25 transition">
                    <span>Browse Our Packages</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-12 border-t border-slate-800 text-center text-xs">
        © {{ date('Y') }} ulyaboolatkepalastoopid Travel Agency. Built with love & wanderlust.
    </footer>

</body>
</html>
