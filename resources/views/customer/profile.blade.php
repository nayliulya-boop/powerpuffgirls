@extends('layouts.app')

@section('title', 'Profil Pengguna | AzureVoyage')

@section('content')
<!-- Profile Header -->
<section class="bg-mesh-blue py-10 md:py-12 border-b border-sky-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-3xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 text-white flex items-center justify-center text-2xl font-black shadow-lg shadow-sky-500/25">
                {{ substr(Auth::user()->name ?? 'P', 0, 1) }}
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900">
                    {{ Auth::user()->name ?? 'Profil Pelanggan' }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                    {{ Auth::user()->email ?? 'pelanggan@azurevoyage.com' }} &bull; Ahli AzureVoyage Sejak {{ Auth::user()->created_at ? Auth::user()->created_at->format('Y') : date('Y') }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    <!-- 1. Maklumat Peribadi / Profil Diri -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center text-xs font-black">1</span>
                    Maklumat Profil Diri
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Kemaskini nama, nombor telefon dan alamat untuk memudahkan pengurusan tempahan tiket.
                </p>
            </div>
        </div>

        <form action="{{ route('customer.update_profile') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Nama Penuh <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                </div>

                <div>
                    <label for="email" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Alamat Emel <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Nombor Telefon
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="012-3456789"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Alamat Kediaman / Surat-Menyurat
                    </label>
                    <textarea id="address" name="address" rows="3" placeholder="No. Rumah, Jalan, Poskod, Bandar, Negeri"
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">{{ old('address', Auth::user()->address) }}</textarea>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-6 py-3 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-extrabold text-xs shadow-md shadow-sky-600/20 transition">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>

    <!-- 2. Kemaskini Kata Laluan -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <div class="mb-6 pb-4 border-b border-slate-100">
            <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                <span class="w-7 h-7 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center text-xs font-black">2</span>
                Kemaskini Kata Laluan (Password)
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Pastikan anda menggunakan kata laluan yang selamat sekurang-kurangnya 6 aksara.
            </p>
        </div>

        <form action="{{ route('customer.update_password') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="current_password" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                    Kata Laluan Semasa <span class="text-rose-500">*</span>
                </label>
                <input type="password" id="current_password" name="current_password" required placeholder="••••••••"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="password" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Kata Laluan Baharu <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" id="password" name="password" required placeholder="Minimum 6 aksara"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Sahkan Kata Laluan Baharu <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi kata laluan baharu"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs shadow-md transition">
                    Kemaskini Kata Laluan
                </button>
            </div>
        </form>
    </div>

</section>
@endsection
