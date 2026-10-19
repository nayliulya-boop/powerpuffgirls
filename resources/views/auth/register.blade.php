@extends('layouts.app')

@section('title', 'Pendaftaran Akaun Pengguna | AzureVoyage')

@section('content')
<section class="min-h-[75vh] flex items-center justify-center p-4 sm:p-6 bg-mesh-blue">
    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl border border-sky-100 p-8 sm:p-10 my-8">

        <div class="text-center mb-8">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3.5 py-1 rounded-full mb-3">
                Pendaftaran Akaun Pengguna
            </span>
            <h1 class="font-black text-3xl text-slate-900">
                Sertai AzureVoyage
            </h1>
            <p class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">
                Daftar akaun untuk menikmati tawaran eksklusif dan menguruskan tempahan tiket.
            </p>
        </div>

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                    Nama Penuh <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Jane Doe"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:ring-2 focus:ring-sky-100">
            </div>

            <div>
                <label for="email" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                    Alamat Emel <span class="text-rose-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="traveler@azurevoyage.com"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:ring-2 focus:ring-sky-100">
            </div>

            <div>
                <label for="phone" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                    Nombor Telefon
                </label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="012-3456789"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:ring-2 focus:ring-sky-100">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                        Kata Laluan <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" id="password" name="password" required placeholder="Min 6 aksara"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                        Sahkan Kata Laluan <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulang kata laluan"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-black text-sm shadow-lg shadow-sky-600/25 transition">
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
</section>
@endsection
