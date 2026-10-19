@extends('layouts.app')

@section('title', $package->title . ' | AzureVoyage')
@section('meta_description', Str::limit($package->description, 150))

@section('content')
<!-- Breadcrumbs -->
<div class="bg-slate-100 border-b border-slate-200 py-3 text-xs font-semibold text-slate-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <a href="{{ route('packages.index') }}" class="hover:text-sky-600">Packages</a>
        <span>/</span>
        <a href="{{ route('packages.index', ['category' => $package->category]) }}" class="hover:text-sky-600">{{ $package->category }}</a>
        <span>/</span>
        <span class="text-slate-900 font-bold truncate max-w-xs">{{ $package->title }}</span>
    </div>
</div>

<!-- Main Package Detail Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <!-- Header Titles & Category Badges -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex flex-wrap items-center gap-2.5 mb-2">
                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-sky-100 text-sky-800">
                    {{ $package->category }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-800">
                    ⏱️ {{ $package->duration }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                    📍 {{ $package->destination }}
                </span>
            </div>
            <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                {{ $package->title }}
            </h1>
        </div>

        <div class="text-right">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">Harga Tawaran</span>
            <div class="flex items-baseline gap-1.5">
                <span class="text-3xl font-black text-sky-600">RM {{ number_format($package->price_adult, 2) }}</span>
                <span class="text-xs text-slate-500 font-bold">/ Dewasa</span>
            </div>
            @if($package->price_child > 0)
                <span class="text-xs text-slate-500 font-semibold block">RM {{ number_format($package->price_child, 2) }} / Kanak-kanak</span>
            @endif
        </div>
    </div>

    <!-- Gallery / Featured Hero Image -->
    <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-200 mb-10 h-72 sm:h-96 md:h-[460px] relative bg-slate-900">
        <img src="{{ $package->featured_image }}" alt="{{ $package->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-black/20"></div>
        <div class="absolute bottom-6 left-6 text-white max-w-2xl">
            <span class="inline-block px-3 py-1 rounded-md text-xs font-black uppercase tracking-wider bg-sky-500 text-white mb-2">
                Pengalaman Eksklusif
            </span>
            <p class="text-sm sm:text-base font-semibold text-slate-100 drop-shadow">
                {{ $package->description }}
            </p>
        </div>
    </div>

    <!-- Two-Column Layout: Left (Tabs & Details), Right (Booking Calculator Widget) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Left Column: Details, Itinerary, Inclusions, Terms -->
        <div class="lg:col-span-2 space-y-10">

            <!-- 1. Perihal Pakej -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center text-sm font-black">1</span>
                    Gambaran Keseluruhan (Overview)
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    {{ $package->description }}
                </p>
                <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 gap-4 pt-6 border-t border-slate-100 text-xs font-bold text-slate-700">
                    <div class="bg-slate-50 p-3 rounded-2xl">
                        <span class="text-slate-400 block text-[10px] uppercase">Tempoh</span>
                        <span class="text-slate-900">{{ $package->duration }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-2xl">
                        <span class="text-slate-400 block text-[10px] uppercase">Kategori</span>
                        <span class="text-slate-900">{{ $package->category }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-2xl">
                        <span class="text-slate-400 block text-[10px] uppercase">Destinasi</span>
                        <span class="text-slate-900">{{ $package->destination }}</span>
                    </div>
                </div>
            </div>

            <!-- 2. Itinerary Hari demi Hari -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center text-sm font-black">2</span>
                    Aturcara Perjalanan (Itinerary)
                </h2>

                @if(!empty($package->itinerary) && is_array($package->itinerary))
                    <div class="relative border-l-2 border-sky-200 ml-4 space-y-6">
                        @foreach($package->itinerary as $step)
                            <div class="relative pl-6">
                                <span class="absolute -left-[11px] top-1 w-5 h-5 rounded-full bg-sky-600 border-4 border-white text-white"></span>
                                <h4 class="text-sm sm:text-base font-extrabold text-slate-900">
                                    {{ $step['day'] ?? 'Hari' }}: {{ $step['title'] ?? '' }}
                                </h4>
                                <p class="mt-1 text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    {{ $step['desc'] ?? '' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500 italic">Jadual terperinci akan dimaklumkan oleh mutawwif / pemandu pelancong sebelum tarikh pelepasan.</p>
                @endif
            </div>

            <!-- 3. Termasuk & Tidak Termasuk -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center text-sm font-black">3</span>
                    Apa Yang Termasuk & Tidak Termasuk
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Termasuk -->
                    <div class="bg-emerald-50/60 rounded-2xl p-5 border border-emerald-100">
                        <h3 class="text-sm font-extrabold text-emerald-900 flex items-center gap-2 mb-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs">✓</span>
                            Pakej Termasuk (Inclusions)
                        </h3>
                        @if(!empty($package->included))
                            <ul class="space-y-2 text-xs sm:text-sm text-emerald-800 font-semibold">
                                @foreach($package->included as $inc)
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">•</span>
                                        <span>{{ $inc }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Tidak Termasuk -->
                    <div class="bg-rose-50/60 rounded-2xl p-5 border border-rose-100">
                        <h3 class="text-sm font-extrabold text-rose-900 flex items-center gap-2 mb-3">
                            <span class="w-5 h-5 rounded-full bg-rose-500 text-white flex items-center justify-center text-xs">✕</span>
                            Tidak Termasuk (Exclusions)
                        </h3>
                        @if(!empty($package->excluded))
                            <ul class="space-y-2 text-xs sm:text-sm text-rose-800 font-semibold">
                                @foreach($package->excluded as $exc)
                                    <li class="flex items-start gap-2">
                                        <span class="text-rose-500 font-bold">•</span>
                                        <span>{{ $exc }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 4. Terma & Syarat -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center text-sm font-black">4</span>
                    Terma & Syarat (Terms & Conditions)
                </h2>
                <div class="prose prose-sm text-slate-600 max-w-none text-xs sm:text-sm leading-relaxed whitespace-pre-line">
                    {{ $package->terms ?? 'Semua tempahan tertakluk kepada kekosongan slot penerbangan dan bilik penginapan. Bayaran deposit 50% diperlukan semasa membuat tempahan awal.' }}
                </div>
            </div>

        </div>

        <!-- Right Column: Live Price & Booking Calculator Sticky Widget -->
        <div class="lg:col-span-1">
            <div class="sticky top-28 bg-white rounded-3xl p-6 sm:p-7 border-2 border-sky-200 shadow-xl">
                <div class="text-center pb-5 border-b border-slate-100">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider text-sky-700 bg-sky-100 mb-2">
                        Kalkulator Harga Tempahan
                    </span>
                    <h3 class="text-lg font-black text-slate-900">Rancang & Tempah Trip Anda</h3>
                </div>

                <form id="calculatorForm" action="{{ route('booking.create', $package->slug) }}" method="GET" class="mt-5 space-y-4">
                    <!-- Tarikh Trip -->
                    <div>
                        <label for="calc_date" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                            Pilih Tarikh Trip
                        </label>
                        <input type="date" id="calc_date" name="date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" min="{{ date('Y-m-d') }}"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-800 focus:outline-none focus:border-sky-500">
                    </div>

                    <!-- Dewasa (Adults) -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="calc_adults" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                Dewasa (RM {{ number_format($package->price_adult, 2) }})
                            </label>
                        </div>
                        <div class="flex items-center">
                            <button type="button" onclick="adjustCount('calc_adults', -1)" class="w-10 h-10 rounded-l-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-black text-lg">-</button>
                            <input type="number" id="calc_adults" name="adults" value="1" min="1" max="50" readonly
                                   class="w-full text-center py-2 border-y border-slate-200 text-sm font-black text-slate-900">
                            <button type="button" onclick="adjustCount('calc_adults', 1)" class="w-10 h-10 rounded-r-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-black text-lg">+</button>
                        </div>
                    </div>

                    <!-- Kanak-kanak (Children) -->
                    @if($package->price_child > 0)
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="calc_children" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                    Kanak-kanak (RM {{ number_format($package->price_child, 2) }})
                                </label>
                            </div>
                            <div class="flex items-center">
                                <button type="button" onclick="adjustCount('calc_children', -1)" class="w-10 h-10 rounded-l-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-black text-lg">-</button>
                                <input type="number" id="calc_children" name="children" value="0" min="0" max="50" readonly
                                       class="w-full text-center py-2 border-y border-slate-200 text-sm font-black text-slate-900">
                                <button type="button" onclick="adjustCount('calc_children', 1)" class="w-10 h-10 rounded-r-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-black text-lg">+</button>
                            </div>
                        </div>
                    @else
                        <input type="hidden" id="calc_children" name="children" value="0">
                    @endif

                    <!-- Price Calculation Breakdown -->
                    <div class="pt-4 border-t border-slate-100 space-y-2 text-xs font-semibold text-slate-600">
                        <div class="flex justify-between">
                            <span>Dewasa (<span id="txt_adults_count">1</span>x)</span>
                            <span id="txt_adults_total">RM {{ number_format($package->price_adult, 2) }}</span>
                        </div>
                        @if($package->price_child > 0)
                            <div class="flex justify-between">
                                <span>Kanak-kanak (<span id="txt_children_count">0</span>x)</span>
                                <span id="txt_children_total">RM 0.00</span>
                            </div>
                        @endif
                        <div class="pt-2 border-t border-dashed border-slate-200 flex justify-between items-baseline text-slate-900">
                            <span class="text-sm font-bold">Anggaran Jumlah:</span>
                            <span id="txt_grand_total" class="text-2xl font-black text-sky-600">
                                RM {{ number_format($package->price_adult, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span>Teruskan Tempahan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>

                    <p class="text-center text-[11px] text-slate-400 font-medium">
                        🔒 Pengesahan segera & resit rasmi dimuat turun
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- Related Packages Recommendation -->
    @if(isset($relatedPackages) && $relatedPackages->count() > 0)
        <div class="mt-16 pt-12 border-t border-slate-200">
            <h3 class="text-2xl font-black text-slate-900 mb-6">Pakej Berkaitan Yang Anda Mungkin Suka</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPackages as $rel)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 hover:shadow-lg transition">
                        <img src="{{ $rel->featured_image }}" alt="{{ $rel->title }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <span class="text-[10px] font-bold text-sky-600 uppercase">{{ $rel->category }}</span>
                            <h4 class="font-bold text-sm text-slate-900 line-clamp-1 mt-1">{{ $rel->title }}</h4>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-sm font-black text-sky-600">RM {{ number_format($rel->price_adult, 2) }}</span>
                                <a href="{{ route('packages.show', $rel->slug) }}" class="text-xs font-bold text-slate-600 hover:text-sky-600">Lihat →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>

@push('scripts')
<script>
    const priceAdult = {{ (float) $package->price_adult }};
    const priceChild = {{ (float) $package->price_child }};

    function adjustCount(id, delta) {
        const input = document.getElementById(id);
        if (!input) return;
        let val = parseInt(input.value) || 0;
        val += delta;
        if (id === 'calc_adults' && val < 1) val = 1;
        if (id === 'calc_children' && val < 0) val = 0;
        input.value = val;
        recalculate();
    }

    function recalculate() {
        const adultInput = document.getElementById('calc_adults');
        const childInput = document.getElementById('calc_children');

        const adults = parseInt(adultInput ? adultInput.value : 1) || 1;
        const children = parseInt(childInput ? childInput.value : 0) || 0;

        const adultTotal = adults * priceAdult;
        const childTotal = children * priceChild;
        const grandTotal = adultTotal + childTotal;

        const txtAdultCount = document.getElementById('txt_adults_count');
        const txtAdultTotal = document.getElementById('txt_adults_total');
        const txtChildCount = document.getElementById('txt_children_count');
        const txtChildTotal = document.getElementById('txt_children_total');
        const txtGrandTotal = document.getElementById('txt_grand_total');

        if (txtAdultCount) txtAdultCount.textContent = adults;
        if (txtAdultTotal) txtAdultTotal.textContent = 'RM ' + adultTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        if (txtChildCount) txtChildCount.textContent = children;
        if (txtChildTotal) txtChildTotal.textContent = 'RM ' + childTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        if (txtGrandTotal) txtGrandTotal.textContent = 'RM ' + grandTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
</script>
@endpush
@endsection

