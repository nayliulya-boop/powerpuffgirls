@extends('layouts.app')

@section('title', 'Sejarah Tempahan Saya (My Bookings) | AzureVoyage')

@section('content')
<!-- Dashboard Header -->
<section class="bg-mesh-blue py-10 md:py-14 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-widest text-sky-700 bg-sky-100 mb-2">
                    Portal Pelanggan AzureVoyage
                </span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Sejarah Tempahan Saya (My Bookings)
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">
                    Uruskan status tempahan, muat turun baucar tiket percutian, dan semak maklumat perjalanan anda.
                </p>
            </div>

            <!-- Profile & New Booking CTAs -->
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('customer.profile') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 transition shadow-sm flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil Pengguna</span>
                </a>
                <a href="{{ route('packages.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-black text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 shadow-md shadow-sky-600/20 transition transform hover:-translate-y-0.5 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Tempah Pakej Baharu</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Guest Booking Search / Quick Lookup Box -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-sm mb-8">
        <form method="GET" action="{{ route('customer.dashboard') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="w-full sm:flex-1 relative">
                <input type="text" name="search_booking" value="{{ request('search_booking') }}" placeholder="Cari menggunakan Kod Tempahan (Cth: AZV-2026-XXXX)..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition">
                Cari Tempahan
            </button>
            @if(request('search_booking'))
                <a href="{{ route('customer.dashboard') }}" class="px-3 py-2 text-xs font-bold text-slate-500 hover:text-slate-800">
                    Kosongkan
                </a>
            @endif
        </form>
    </div>

    <!-- Status Tabs -->
    @if(!isset($isGuestLookup) || !$isGuestLookup)
        <div class="flex flex-wrap items-center gap-2 mb-8 border-b border-slate-200 pb-3">
            <a href="{{ route('customer.dashboard', ['status' => 'all']) }}"
               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-extrabold transition flex items-center gap-2 {{ $currentStatus === 'all' ? 'bg-sky-600 text-white shadow-md shadow-sky-600/20' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                <span>Semua Tempahan</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'all' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">{{ $counts['all'] ?? 0 }}</span>
            </a>

            <a href="{{ route('customer.dashboard', ['status' => 'Pending']) }}"
               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-extrabold transition flex items-center gap-2 {{ $currentStatus === 'Pending' ? 'bg-amber-500 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                <span>Menunggu (Pending)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'Pending' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-800' }}">{{ $counts['Pending'] ?? 0 }}</span>
            </a>

            <a href="{{ route('customer.dashboard', ['status' => 'Confirmed']) }}"
               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-extrabold transition flex items-center gap-2 {{ $currentStatus === 'Confirmed' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                <span>Disahkan (Confirmed)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'Confirmed' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800' }}">{{ $counts['Confirmed'] ?? 0 }}</span>
            </a>

            <a href="{{ route('customer.dashboard', ['status' => 'Completed']) }}"
               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-extrabold transition flex items-center gap-2 {{ $currentStatus === 'Completed' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                <span>Selesai (Completed)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'Completed' ? 'bg-white/20 text-white' : 'bg-blue-100 text-blue-800' }}">{{ $counts['Completed'] ?? 0 }}</span>
            </a>

            <a href="{{ route('customer.dashboard', ['status' => 'Cancelled']) }}"
               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-extrabold transition flex items-center gap-2 {{ $currentStatus === 'Cancelled' ? 'bg-rose-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                <span>Dibatalkan (Cancelled)</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $currentStatus === 'Cancelled' ? 'bg-white/20 text-white' : 'bg-rose-100 text-rose-800' }}">{{ $counts['Cancelled'] ?? 0 }}</span>
            </a>
        </div>
    @endif

    <!-- Bookings Cards List -->
    @if($bookings->count() > 0)
        <div class="space-y-6">
            @foreach($bookings as $item)
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <!-- Left: Package Photo & Meta -->
                    <div class="flex items-start gap-4">
                        <img src="{{ $item->package->featured_image }}" alt="{{ $item->package->title }}"
                             class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-cover shrink-0 border border-slate-100">
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="font-mono text-xs font-black px-2.5 py-0.5 rounded-md bg-slate-100 text-slate-800">
                                    {{ $item->booking_code }}
                                </span>
                                <!-- Status Badge -->
                                @if($item->status === 'Confirmed')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Disahkan
                                    </span>
                                @elseif($item->status === 'Completed')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Selesai
                                    </span>
                                @elseif($item->status === 'Cancelled')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Dibatalkan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu Bayaran
                                    </span>
                                @endif

                                <span class="text-[11px] text-slate-400">
                                    Ditempah pada {{ $item->created_at->format('d/m/Y') }}
                                </span>
                            </div>

                            <h3 class="text-base sm:text-lg font-black text-slate-900">
                                <a href="{{ route('packages.show', $item->package->slug) }}" class="hover:text-sky-600 transition">
                                    {{ $item->package->title }}
                                </a>
                            </h3>

                            <div class="mt-2 text-xs text-slate-500 flex flex-wrap items-center gap-4">
                                <span>📅 Tarikh Trip: <strong class="text-slate-800">{{ date('d M Y', strtotime($item->trip_date)) }}</strong></span>
                                <span>👥 Peserta: <strong class="text-slate-800">{{ $item->adult_count }} Dewasa{{ $item->child_count > 0 ? ', ' . $item->child_count . ' Kanak-kanak' : '' }}</strong></span>
                                <span>💳 Kaedah: <strong class="text-slate-800 uppercase">{{ $item->payment_method }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Price & Actions -->
                    <div class="w-full lg:w-auto flex flex-col sm:flex-row lg:flex-col items-start sm:items-center lg:items-end justify-between gap-4 border-t lg:border-t-0 pt-4 lg:pt-0 border-slate-100">
                        <div class="text-left lg:text-right">
                            <span class="text-[11px] uppercase font-bold text-slate-400 block">Jumlah Bayaran</span>
                            <span class="text-xl sm:text-2xl font-black text-sky-600">RM {{ number_format($item->total_price, 2) }}</span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            <!-- Button: Print/View Voucher -->
                            <a href="{{ route('booking.voucher', $item->booking_code) }}"
                               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-black text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition">
                                <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>Cetak Baucar (PDF)</span>
                            </a>

                            <!-- If Pending Payment, allow completing payment -->
                            @if($item->status === 'Pending' && $item->payment_status === 'pending')
                                <a href="{{ route('booking.payment', $item->booking_code) }}"
                                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-extrabold text-white bg-amber-500 hover:bg-amber-600 shadow-sm transition">
                                    <span>Bayar Sekarang →</span>
                                </a>
                            @endif

                            <!-- Cancel Button if not already cancelled or completed -->
                            @if(in_array($item->status, ['Pending', 'Confirmed']))
                                <form action="{{ route('customer.cancel_booking', $item->booking_code) }}" method="POST"
                                      onsubmit="return confirm('Adakah anda pasti mahu membatalkan tempahan {{ $item->booking_code }}?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-2 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50 transition">
                                        Batal
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $bookings->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300 p-8">
            <div class="w-16 h-16 rounded-full bg-sky-50 text-sky-600 mx-auto flex items-center justify-center text-3xl mb-4">
                🏝️
            </div>
            <h3 class="text-xl font-black text-slate-800">Tiada Tempahan Dijumpai</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-md mx-auto">
                Anda belum membuat sebarang tempahan dengan status ini. Terokai katalog pakej kami dan mulakan percutian impian anda hari ini!
            </p>
            <div class="mt-6">
                <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-sky-600 hover:bg-sky-500 text-white font-extrabold text-xs shadow-md">
                    <span>Lihat Katalog Pakej Percutian</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    @endif
</section>
@endsection
