@extends('layouts.app')

@section('title', 'Pembayaran Tempahan ' . $booking->booking_code . ' | AzureVoyage')

@section('content')
<!-- Booking Flow Progress Steps -->
<div class="bg-white border-b border-slate-200 py-4 shadow-sm">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between text-xs sm:text-sm font-extrabold">
            <div class="flex items-center gap-2 text-emerald-600">
                <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">✓</span>
                <span>Maklumat Tempahan</span>
            </div>
            <div class="w-12 sm:w-24 h-0.5 bg-emerald-500"></div>
            <div class="flex items-center gap-2 text-sky-600">
                <span class="w-7 h-7 rounded-full bg-sky-600 text-white flex items-center justify-center text-xs">2</span>
                <span>Pembayaran</span>
            </div>
            <div class="w-12 sm:w-24 h-0.5 bg-slate-200"></div>
            <div class="flex items-center gap-2 text-slate-400">
                <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs">3</span>
                <span>Baucar Tiket</span>
            </div>
        </div>
    </div>
</div>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Booking Reference Banner -->
    <div class="bg-gradient-to-r from-sky-800 via-blue-800 to-sky-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl mb-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-amber-400 text-slate-950">
                    Menunggu Pembayaran
                </span>
                <span class="text-xs text-sky-200 font-semibold">Kod Tempahan:</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black font-mono tracking-wider text-amber-300">
                {{ $booking->booking_code }}
            </h1>
            <p class="mt-2 text-xs sm:text-sm text-sky-100 font-medium">
                Pakej: <strong>{{ $package->title }}</strong> ({{ $booking->adult_count }} Dewasa{{ $booking->child_count > 0 ? ', ' . $booking->child_count . ' Kanak-kanak' : '' }})
            </p>
            <p class="text-xs text-sky-200">
                Tarikh Perjalanan: <strong>{{ date('d M Y', strtotime($booking->trip_date)) }}</strong>
            </p>
        </div>

        <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/20 text-center sm:text-right w-full sm:w-auto">
            <span class="text-xs text-sky-200 font-bold uppercase tracking-wider block">Jumlah Perlu Dibayar</span>
            <span class="text-3xl font-black text-white">RM {{ number_format($booking->total_price, 2) }}</span>
        </div>
    </div>

    <!-- Payment Methods Selection Box -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-md p-6 sm:p-8">
        <h2 class="text-xl font-black text-slate-900 mb-2">Pilih Kaedah Pembayaran</h2>
        <p class="text-xs sm:text-sm text-slate-500 mb-6">
            Pilih antara integrasi Payment Gateway atas talian segera (ToyyibPay / Billplz / Stripe) ATAU pemindahan bank manual dengan muat naik slip resit pembayaran.
        </p>

        <!-- Method Tabs Switcher -->
        <div class="grid grid-cols-2 gap-3 p-1.5 bg-slate-100 rounded-2xl mb-8">
            <button type="button" id="tabGatewayBtn" onclick="switchPaymentTab('gateway')"
                    class="py-3 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition shadow-sm bg-white text-sky-700">
                ⚡ 1. Online Payment Gateway (FPX / Kad)
            </button>
            <button type="button" id="tabManualBtn" onclick="switchPaymentTab('manual')"
                    class="py-3 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition text-slate-600 hover:text-slate-900">
                📄 2. Pemindahan Bank & Slip Manual
            </button>
        </div>

        <!-- 1. ONLINE PAYMENT GATEWAY OPTION -->
        <div id="sectionGateway" class="space-y-6">
            <form action="{{ route('booking.process_payment', $booking->booking_code) }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="payment_type" value="gateway">

                <div>
                    <label class="block text-xs font-black uppercase text-slate-700 mb-3">
                        Pilih Gerbang Pembayaran Pilihan:
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- ToyyibPay -->
                        <label class="relative flex flex-col p-4 rounded-2xl border-2 border-sky-500 bg-sky-50/50 cursor-pointer transition hover:border-sky-600">
                            <input type="radio" name="gateway_provider" value="toyyibpay" checked class="absolute top-4 right-4 text-sky-600">
                            <div class="font-extrabold text-sm text-slate-900 flex items-center gap-1.5 mb-1">
                                <span class="w-3 h-3 rounded-full bg-emerald-500"></span> ToyyibPay
                            </div>
                            <span class="text-[11px] font-bold text-sky-700">FPX Online Banking</span>
                            <span class="text-[10px] text-slate-500 mt-2">Maybank2u, CIMB Clicks, Bank Islam, RHB, Bank Muamalat</span>
                        </label>

                        <!-- Billplz -->
                        <label class="relative flex flex-col p-4 rounded-2xl border-2 border-slate-200 hover:border-sky-400 bg-white cursor-pointer transition">
                            <input type="radio" name="gateway_provider" value="billplz" class="absolute top-4 right-4 text-sky-600">
                            <div class="font-extrabold text-sm text-slate-900 flex items-center gap-1.5 mb-1">
                                <span class="w-3 h-3 rounded-full bg-blue-500"></span> Billplz
                            </div>
                            <span class="text-[11px] font-bold text-blue-700">Gerbang FPX Pantas</span>
                            <span class="text-[10px] text-slate-500 mt-2">Bayaran terus melalui perbankan internet Malaysia</span>
                        </label>

                        <!-- Stripe -->
                        <label class="relative flex flex-col p-4 rounded-2xl border-2 border-slate-200 hover:border-sky-400 bg-white cursor-pointer transition">
                            <input type="radio" name="gateway_provider" value="stripe" class="absolute top-4 right-4 text-sky-600">
                            <div class="font-extrabold text-sm text-slate-900 flex items-center gap-1.5 mb-1">
                                <span class="w-3 h-3 rounded-full bg-indigo-500"></span> Stripe
                            </div>
                            <span class="text-[11px] font-bold text-indigo-700">Kad Kredit / Debit</span>
                            <span class="text-[10px] text-slate-500 mt-2">Visa, MasterCard, Apple Pay, Google Pay Antarabangsa</span>
                        </label>
                    </div>
                </div>

                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shrink-0">✓</span>
                    <p class="text-xs text-emerald-900 font-medium">
                        Simulasi integrasi automatik diaktifkan. Mengklik butang di bawah akan mensimulasikan gerbang pembayaran berjaya dan mengesahkan tempahan secara serta-merta.
                    </p>
                </div>

                <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-emerald-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Bayar RM {{ number_format($booking->total_price, 2) }} Sekarang Melalui Gateway</span>
                </button>
            </form>
        </div>

        <!-- 2. MANUAL BANK TRANSFER OPTION -->
        <div id="sectionManual" class="hidden space-y-6">
            <div class="bg-amber-50/70 rounded-2xl p-5 border border-amber-200">
                <h3 class="text-sm font-extrabold text-amber-950 mb-3 flex items-center gap-2">
                    <span>🏦</span> Maklumat Akaun Bank Rasmi Syarikat
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="bg-white p-3.5 rounded-xl border border-amber-200">
                        <span class="font-bold text-slate-700 block text-xs">Maybank Islamic Berhad</span>
                        <span class="text-slate-900 font-mono font-black text-sm block my-1">5641 2345 8899</span>
                        <span class="text-slate-500 block">Nama Penerima: <strong>AzureVoyage Travel Sdn Bhd</strong></span>
                    </div>
                    <div class="bg-white p-3.5 rounded-xl border border-amber-200">
                        <span class="font-bold text-slate-700 block text-xs">CIMB Islamic Bank</span>
                        <span class="text-slate-900 font-mono font-black text-sm block my-1">8602 9911 3344</span>
                        <span class="text-slate-500 block">Nama Penerima: <strong>AzureVoyage Travel Sdn Bhd</strong></span>
                    </div>
                </div>
                <p class="text-[11px] text-amber-900 mt-3">
                    *Sila masukkan Kod Tempahan <strong>{{ $booking->booking_code }}</strong> dalam ruangan rujukan penerima pemindahan bank anda.
                </p>
            </div>

            <!-- Upload Slip Form -->
            <form action="{{ route('booking.process_payment', $booking->booking_code) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <input type="hidden" name="payment_type" value="manual">

                <div>
                    <label for="reference_no" class="block text-xs font-black uppercase text-slate-700 mb-1">
                        Nombor Rujukan Transaksi Bank (Ref No.)
                    </label>
                    <input type="text" id="reference_no" name="reference_no" placeholder="Cth: MBB20261019-987654"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                </div>

                <div>
                    <label for="receipt_file" class="block text-xs font-black uppercase text-slate-700 mb-1">
                        Muat Naik Slip Resit Pemindahan Bank (PDF / JPG / PNG) <span class="text-rose-500">*</span>
                    </label>
                    <input type="file" id="receipt_file" name="receipt_file" accept=".jpg,.jpeg,.png,.pdf" required
                           class="w-full px-4 py-3 rounded-xl border-2 border-dashed border-sky-300 bg-sky-50/50 text-xs text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-sky-600 file:text-white hover:file:bg-sky-500 cursor-pointer">
                    <p class="text-[11px] text-slate-400 mt-1">Saiz fail maksimum: 5MB.</p>
                </div>

                <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-sky-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span>Hantar Bukti Slip Pembayaran Manual</span>
                </button>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function switchPaymentTab(type) {
        const secGateway = document.getElementById('sectionGateway');
        const secManual = document.getElementById('sectionManual');
        const tabGatewayBtn = document.getElementById('tabGatewayBtn');
        const tabManualBtn = document.getElementById('tabManualBtn');

        if (type === 'gateway') {
            secGateway.classList.remove('hidden');
            secManual.classList.add('hidden');
            tabGatewayBtn.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition shadow-sm bg-white text-sky-700";
            tabManualBtn.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition text-slate-600 hover:text-slate-900";
        } else {
            secGateway.classList.add('hidden');
            secManual.classList.remove('hidden');
            tabGatewayBtn.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition text-slate-600 hover:text-slate-900";
            tabManualBtn.className = "py-3 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition shadow-sm bg-white text-sky-700";
        }
    }
</script>
@endpush
@endsection
