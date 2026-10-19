@extends('layouts.app')

@section('title', 'Baucar Tiket Tempahan ' . $booking->booking_code . ' | AzureVoyage')

@push('styles')
<style>
    @media print {
        header, footer, .no-print, .flash-message {
            display: none !important;
        }
        body {
            background-color: white !important;
            color: black !important;
            padding: 0 !important;
        }
        .print-container {
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
            margin: 0 auto !important;
            max-width: 100% !important;
            border-radius: 0 !important;
        }
    }
</style>
@endpush

@section('content')
<!-- Booking Flow Progress Steps (Hidden on Print) -->
<div class="no-print bg-white border-b border-slate-200 py-4 shadow-sm">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between text-xs sm:text-sm font-extrabold">
            <div class="flex items-center gap-2 text-emerald-600">
                <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">✓</span>
                <span>Maklumat Tempahan</span>
            </div>
            <div class="w-12 sm:w-24 h-0.5 bg-emerald-500"></div>
            <div class="flex items-center gap-2 text-emerald-600">
                <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs">✓</span>
                <span>Pembayaran</span>
            </div>
            <div class="w-12 sm:w-24 h-0.5 bg-emerald-500"></div>
            <div class="flex items-center gap-2 text-sky-600">
                <span class="w-7 h-7 rounded-full bg-sky-600 text-white flex items-center justify-center text-xs">3</span>
                <span>Baucar Tiket</span>
            </div>
        </div>
    </div>
</div>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Action Toolbar (Print / Download PDF / Go to Dashboard) -->
    <div class="no-print flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-2">
            <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                ← Kembali ke Sejarah Tempahan
            </a>
            <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                Katalog Pakej
            </a>
        </div>

        <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white text-xs sm:text-sm font-black shadow-lg shadow-sky-600/30 transition transform hover:-translate-y-0.5 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Cetak / Muat Turun Baucar (PDF)</span>
        </button>
    </div>

    <!-- Official Printable Voucher Card -->
    <div class="print-container bg-white rounded-3xl border-2 border-slate-200 shadow-xl overflow-hidden p-8 sm:p-10">
        <!-- Top Voucher Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-8 border-b-2 border-slate-100 gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-sky-600 to-blue-600 flex items-center justify-center text-white shadow-md">
                    <svg class="w-7 h-7 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                    </svg>
                </div>
                <div>
                    <span class="text-2xl font-black tracking-tight text-slate-900">
                        Azure<span class="text-sky-600">Voyage</span>
                    </span>
                    <span class="block text-[10px] uppercase tracking-widest font-bold text-slate-400">
                        Official Travel Booking Voucher & Receipt
                    </span>
                </div>
            </div>

            <!-- Booking Status Badge -->
            <div class="text-left sm:text-right">
                @if($booking->status === 'Confirmed')
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Disahkan (CONFIRMED)
                    </span>
                @elseif($booking->status === 'Completed')
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-blue-100 text-blue-800 border border-blue-300">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Selesai (COMPLETED)
                    </span>
                @elseif($booking->status === 'Cancelled')
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-rose-100 text-rose-800 border border-rose-300">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span> Dibatalkan (CANCELLED)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-amber-100 text-amber-800 border border-amber-300">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span> Menunggu (PENDING)
                    </span>
                @endif
                <p class="text-[11px] text-slate-400 mt-1">Dikeluarkan: {{ $booking->created_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>

        <!-- Key Booking Barcode / QR Simulation -->
        <div class="my-6 p-5 bg-sky-50/60 rounded-2xl border border-sky-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-sky-800 block">Nombor Rujukan Tempahan</span>
                <span class="text-2xl font-black font-mono text-sky-900 tracking-wider">{{ $booking->booking_code }}</span>
                <span class="block text-xs text-sky-700 mt-0.5">Sila kemukakan kod ini kepada pegawai lapangan semasa ketibaan.</span>
            </div>
            <!-- Simulated QR Pattern Box -->
            <div class="flex items-center gap-3">
                <div class="w-20 h-20 bg-white border border-slate-300 rounded-xl p-1.5 flex items-center justify-center shadow-sm">
                    <svg class="w-full h-full text-slate-900" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 2h8v8H2V2zm2 2v4h4V4H4zm10-2h8v8h-8V2zm2 2v4h4V4h-4zM2 14h8v8H2v-8zm2 2v4h4v-4H4zm14 0h4v2h-4v-2zm-4 0h2v4h-2v-4zm4 4h4v2h-4v-2zm-2-2h2v2h-2v-2zm-2 2h2v2h-2v-2z"/>
                    </svg>
                </div>
                <div class="text-[11px] text-slate-500 font-mono">
                    <p class="font-bold text-slate-800">AZV-AUTH-VERIFIED</p>
                    <p>Status: {{ strtoupper($booking->payment_status) }}</p>
                    <p>MOTAC: 8921/KPK</p>
                </div>
            </div>
        </div>

        <!-- Two Column Trip & Contact Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-6">
            <!-- Trip Information -->
            <div class="space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Maklumat Destinasi & Pakej</h3>
                <div class="bg-slate-50 p-4 rounded-2xl space-y-2 text-xs">
                    <p><strong class="text-slate-900 text-sm block">{{ $package->title }}</strong></p>
                    <p class="text-slate-600">Kategori: <strong class="text-slate-800">{{ $package->category }}</strong></p>
                    <p class="text-slate-600">Destinasi: <strong class="text-slate-800">{{ $package->destination }}</strong></p>
                    <p class="text-slate-600">Tempoh: <strong class="text-slate-800">{{ $package->duration }}</strong></p>
                    <p class="text-slate-600">Tarikh Trip: <strong class="text-sky-700 text-sm">{{ date('d F Y', strtotime($booking->trip_date)) }}</strong></p>
                </div>
            </div>

            <!-- Representative Information -->
            <div class="space-y-3">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Maklumat Wakil Tempahan</h3>
                <div class="bg-slate-50 p-4 rounded-2xl space-y-2 text-xs">
                    <p class="text-slate-600">Nama Wakil: <strong class="text-slate-900 text-sm block">{{ $booking->contact_name }}</strong></p>
                    <p class="text-slate-600">Emel: <strong class="text-slate-800">{{ $booking->contact_email }}</strong></p>
                    <p class="text-slate-600">No. Telefon: <strong class="text-slate-800">{{ $booking->contact_phone }}</strong></p>
                    <p class="text-slate-600">Kaedah Bayaran: <strong class="text-slate-800 uppercase">{{ $booking->payment_method }}</strong></p>
                    @if($booking->special_notes)
                        <p class="text-slate-600">Nota Khas: <span class="italic text-slate-800">{{ $booking->special_notes }}</span></p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Participants Table -->
        <div class="my-6">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-3">Senarai Peserta Berdaftar (Travelers)</h3>
            <div class="overflow-x-auto rounded-2xl border border-slate-200">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-100 text-slate-700 font-extrabold uppercase text-[10px]">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Nama Peserta</th>
                            <th class="py-3 px-4">No. IC / Pasport</th>
                            <th class="py-3 px-4">Telefon</th>
                            <th class="py-3 px-4">Kategori</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-semibold text-slate-800">
                        @if(!empty($booking->participants))
                            @foreach($booking->participants as $index => $part)
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 text-slate-400">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4 font-bold">{{ $part['name'] ?? $booking->contact_name }}</td>
                                    <td class="py-3 px-4 font-mono">{{ $part['ic_passport'] ?? '-' }}</td>
                                    <td class="py-3 px-4">{{ $part['phone'] ?? $booking->contact_phone }}</td>
                                    <td class="py-3 px-4">
                                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700">
                                            {{ $part['type'] ?? 'Dewasa' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="py-3 px-4">1</td>
                                <td class="py-3 px-4 font-bold">{{ $booking->contact_name }}</td>
                                <td class="py-3 px-4">Utama</td>
                                <td class="py-3 px-4">{{ $booking->contact_phone }}</td>
                                <td class="py-3 px-4">Dewasa</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Breakdown Summary -->
        <div class="my-6 pt-6 border-t-2 border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="text-xs text-slate-500 max-w-sm">
                <p class="font-bold text-slate-700 mb-1">Terma & Pengesahan Baucar:</p>
                <p>Baucar ini adalah bukti rasmi tempahan perjalanan bersama AzureVoyage Travel & Tours Sdn Bhd. Sebarang pembatalan tertakluk kepada polisi agensi.</p>
            </div>

            <div class="text-right w-full sm:w-auto bg-slate-50 p-4 rounded-2xl border border-slate-200">
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider block">Jumlah Keseluruhan Dibayar</span>
                <span class="text-2xl font-black text-sky-600">RM {{ number_format($booking->total_price, 2) }}</span>
                <span class="block text-[11px] font-bold text-emerald-600 mt-0.5">Status Bayaran: {{ strtoupper($booking->payment_status) }}</span>
            </div>
        </div>

        <!-- Footer Sign-off on Print -->
        <div class="mt-8 pt-6 border-t border-slate-200 text-center text-xs text-slate-400">
            <p>AzureVoyage Travel & Tours Sdn Bhd | Aras 15, Menara Voyage, Jalan Ampang, 50450 Kuala Lumpur</p>
            <p>Hotline: +60 3-8888 2026 | Emel: support@azurevoyage.com | MOTAC: KPK/LN 8921</p>
        </div>
    </div>
</section>
@endsection

