<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akaun Pelanggan | AzureVoyage</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
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
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white">

    <!-- Global Synced Navbar -->
    @include('partials.navbar')

    <!-- Flash Error / Success Alerts -->
    <div class="max-w-md mx-auto px-4 mt-6 w-full">
        @if($errors->any())
            <div class="p-4 rounded-2xl bg-amber-50 border border-amber-300 text-amber-900 text-xs font-semibold space-y-1">
                @foreach($errors->all() as $err)
                    <p>• {{ $err }}</p>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Centered Sign Up Card -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-sky-100 p-8 sm:p-10">

            <div class="text-center mb-8">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3.5 py-1 rounded-full mb-3">
                    Modul Pelanggan
                </span>
                <h1 class="font-extrabold text-3xl text-slate-900">
                    Pendaftaran Akaun
                </h1>
                <p class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">
                    Sertai <span class="text-sky-600 font-bold">AzureVoyage</span> untuk tempahan dan promosi pakej.
                </p>
            </div>

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                        Nama Penuh <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Jane Doe"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                    >
                </div>

                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                        Alamat Emel <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="traveler@azurevoyage.com"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                    >
                </div>

                <div>
                    <label for="phone" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                        Nombor Telefon
                    </label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="012-3456789"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                    >
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="password" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                            Kata Laluan <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Min 6 aksara"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                            Sahkan Kata Laluan <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulang kata laluan"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border-2 border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                        >
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm shadow-lg shadow-sky-600/25 transition"
                >
                    Daftar Akaun Sekarang →
                </button>
            </form>

            <p class="text-center text-xs font-semibold text-slate-600 mt-6 pt-6 border-t border-slate-100">
                Sudah mempunyai akaun?
                <a href="{{ route('login') }}" class="text-sky-600 font-extrabold hover:underline ml-1">
                    Log Masuk
                </a>
            </p>
        </div>
    </main>

    <!-- Global Synced Footer -->
    @include('partials.footer')

</body>
</html>
