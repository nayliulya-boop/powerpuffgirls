@extends('layouts.app')

@section('title', 'Log Masuk Pelanggan | AzureVoyage')

@section('content')
<section class="min-h-[75vh] flex items-center justify-center p-4 sm:p-6 bg-mesh-blue">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-sky-100 p-8 sm:p-10 my-8">

        <div class="text-center mb-8">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3.5 py-1 rounded-full mb-3">
                Portal Pelanggan
            </span>
            <h1 class="font-black text-3xl text-slate-900">
                Selamat Kembali
            </h1>
            <p class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">
                Log masuk ke akaun anda untuk melihat tempahan & tiket percutian.
            </p>
        </div>

        <!-- Quick 1-Click Demo Login Box (For Testing & Review) -->
        <div class="mb-6 p-4 rounded-2xl bg-amber-50/80 border border-amber-200">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-black text-amber-900 uppercase tracking-wider">Akaun Demo Pelanggan</span>
                <span class="text-[10px] font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded-full">Ujian Pantas</span>
            </div>
            <p class="text-[11px] text-amber-800 mb-3">
                Log masuk terus tanpa perlu mengisi borang:
            </p>
            <a href="{{ route('auth.demo') }}" class="w-full py-2.5 px-4 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs shadow-sm flex items-center justify-center gap-1.5 transition">
                <span>⚡ Log Masuk Sebagai Pelanggan Demo</span>
            </a>
        </div>

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-xs font-black uppercase tracking-wide text-slate-700 mb-1.5">
                    Alamat Emel <span class="text-rose-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', 'pelanggan@azurevoyage.com') }}" required placeholder="traveler@azurevoyage.com"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:ring-2 focus:ring-sky-100">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="text-xs font-black uppercase tracking-wide text-slate-700">
                        Kata Laluan <span class="text-rose-500">*</span>
                    </label>
                </div>
                <input type="password" id="password" name="password" value="password123" required placeholder="••••••••"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:ring-2 focus:ring-sky-100">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer font-semibold text-slate-600">
                    <input type="checkbox" name="remember" class="rounded text-sky-600">
                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-black text-sm shadow-lg shadow-sky-600/25 transition">
                Log Masuk Akaun →
            </button>
        </form>

        <p class="text-center text-xs font-semibold text-slate-600 mt-6 pt-6 border-t border-slate-100">
            Belum mempunyai akaun?
            <a href="{{ route('signup') }}" class="text-sky-600 font-extrabold hover:underline ml-1">
                Daftar Akaun Baharu
            </a>
        </p>
    </div>
</section>
@endsection
