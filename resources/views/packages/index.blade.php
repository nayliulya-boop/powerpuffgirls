@extends('layouts.app')

@section('title', 'Katalog Pakej Pelancongan | AzureVoyage')
@section('meta_description', 'Pilih pakej percutian pulau, umrah & haji, honeymoon eksklusif, dan day trip dengan harga terbaik di AzureVoyage.')

@section('content')
<!-- Hero Header Section -->
<section class="bg-mesh-blue py-12 md:py-16 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest text-sky-700 bg-sky-100/80 mb-4">
            🌍 Destinasi Impian Menanti Anda
        </span>
        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">
            Katalog Pakej Pelancongan
        </h1>
        <p class="mt-4 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Terokai pelbagai pilihan pakej percutian eksklusif serba lengkap dari pulau tropika, ziarah ibadah Umrah, percutian romantis honeymoon hingga day trip santai.
        </p>

        <!-- Category Pills Bar -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-2.5">
            <a href="{{ route('packages.index', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}"
               class="px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold transition-all {{ $selectedCategory === 'all' ? 'bg-sky-600 text-white shadow-md shadow-sky-500/25 scale-105' : 'bg-white text-slate-700 hover:bg-sky-50 hover:text-sky-600 border border-slate-200' }}">
                Semua Pakej
            </a>
            @foreach($categories as $key => $catName)
                <a href="{{ route('packages.index', array_merge(request()->except('category', 'page'), ['category' => $key])) }}"
                   class="px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold transition-all {{ $selectedCategory === $key ? 'bg-sky-600 text-white shadow-md shadow-sky-500/25 scale-105' : 'bg-white text-slate-700 hover:bg-sky-50 hover:text-sky-600 border border-slate-200' }}">
                    @if($key === 'Pakej Pulau') 🏝️ @elseif($key === 'Pakej Umrah/Haji') 🕋 @elseif($key === 'Honeymoon') 💖 @else 🚗 @endif
                    {{ $catName }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Main Catalog Area (Filter & Grid) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Filter & Search Toolbar -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 mb-8">
        <form method="GET" action="{{ route('packages.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <!-- Search Keyword -->
            <div>
                <label for="q" class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">
                    Carian Destinasi / Pakej
                </label>
                <div class="relative">
                    <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="Cth: Redang, Makkah, Langkawi..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Category Dropdown -->
            <div>
                <label for="category" class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">
                    Kategori Pakej
                </label>
                <select id="category" name="category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                    <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>Semua Kategori</option>
                    @foreach($categories as $key => $catName)
                        <option value="{{ $key }}" {{ $selectedCategory === $key ? 'selected' : '' }}>{{ $catName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Budget Filter -->
            <div>
                <label for="budget" class="block text-xs font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">
                    Bajet Maksimum (Dewasa)
                </label>
                <select id="budget" name="budget" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                    <option value="">Sebarang Bajet</option>
                    <option value="500" {{ request('budget') == '500' ? 'selected' : '' }}>Bawah RM 500</option>
                    <option value="1500" {{ request('budget') == '1500' ? 'selected' : '' }}>Bawah RM 1,500</option>
                    <option value="3000" {{ request('budget') == '3000' ? 'selected' : '' }}>Bawah RM 3,000</option>
                    <option value="10000" {{ request('budget') == '10000' ? 'selected' : '' }}>Bawah RM 10,000</option>
                </select>
            </div>

            <!-- Submit & Reset Buttons -->
            <div class="flex items-center gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-extrabold text-sm shadow-md shadow-sky-600/20 transition flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Tapis Pakej</span>
                </button>
                @if(request()->anyFilled(['q', 'category', 'budget', 'sort']))
                    <a href="{{ route('packages.index') }}" class="py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition" title="Kosongkan Tapis">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Package Results Summary -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <p class="text-sm font-bold text-slate-700">
            Menunjukkan <span class="text-sky-600 font-extrabold">{{ $packages->total() }}</span> pakej percutian ditemui
        </p>

        <!-- Sorting dropdown -->
        <div class="flex items-center gap-2 text-xs font-bold text-slate-600">
            <span>Susun Mengikut:</span>
            <a href="{{ route('packages.index', array_merge(request()->query(), ['sort' => 'featured'])) }}"
               class="px-3 py-1.5 rounded-lg {{ $selectedSort === 'featured' ? 'bg-sky-100 text-sky-700' : 'hover:bg-slate-100' }}">Pilihan Ramai</a>
            <a href="{{ route('packages.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}"
               class="px-3 py-1.5 rounded-lg {{ $selectedSort === 'price_low' ? 'bg-sky-100 text-sky-700' : 'hover:bg-slate-100' }}">Harga Rendah</a>
            <a href="{{ route('packages.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}"
               class="px-3 py-1.5 rounded-lg {{ $selectedSort === 'price_high' ? 'bg-sky-100 text-sky-700' : 'hover:bg-slate-100' }}">Harga Tinggi</a>
        </div>
    </div>

    <!-- Packages Grid -->
    @if($packages->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($packages as $pkg)
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 hover:border-sky-300 hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <!-- Image & Badge Container -->
                    <div class="relative h-60 overflow-hidden bg-slate-100">
                        <img src="{{ $pkg->featured_image }}" alt="{{ $pkg->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-extrabold bg-white/95 text-slate-900 shadow-sm backdrop-blur-sm">
                                @if($pkg->category === 'Pakej Pulau') 🏝️ @elseif($pkg->category === 'Pakej Umrah/Haji') 🕋 @elseif($pkg->category === 'Honeymoon') 💖 @else 🚗 @endif
                                {{ $pkg->category }}
                            </span>
                        </div>

                        <!-- Duration Pill -->
                        <div class="absolute bottom-4 left-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-900/80 text-white backdrop-blur-sm">
                                ⏱️ {{ $pkg->duration }}
                            </span>
                        </div>

                        <!-- Destination Pill -->
                        <div class="absolute bottom-4 right-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-sky-600/90 text-white backdrop-blur-sm">
                                📍 {{ $pkg->destination }}
                            </span>
                        </div>
                    </div>

                    <!-- Package Body Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 group-hover:text-sky-600 transition-colors line-clamp-1">
                                <a href="{{ route('packages.show', $pkg->slug) }}">{{ $pkg->title }}</a>
                            </h3>
                            <p class="mt-2 text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $pkg->description }}
                            </p>

                            <!-- Inclusions Preview -->
                            @if(!empty($pkg->included))
                                <div class="mt-4 flex flex-wrap gap-1.5">
                                    @foreach(array_slice($pkg->included, 0, 3) as $inc)
                                        <span class="inline-flex items-center text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
                                            ✓ {{ $inc }}
                                        </span>
                                    @endforeach
                                    @if(count($pkg->included) > 3)
                                        <span class="text-[11px] font-semibold text-slate-400 self-center">
                                            +{{ count($pkg->included) - 3 }} lagi
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Price & Action Section -->
                        <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Harga Bermula</span>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-2xl font-black text-sky-600">RM {{ number_format($pkg->price_adult, 2) }}</span>
                                    <span class="text-xs text-slate-500 font-semibold">/ org</span>
                                </div>
                                @if($pkg->price_child > 0)
                                    <span class="text-[11px] text-slate-500 block">Kanak-kanak: RM {{ number_format($pkg->price_child, 2) }}</span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('packages.show', $pkg->slug) }}" class="px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition border border-slate-200">
                                    Perincian
                                </a>
                                <a href="{{ route('booking.create', $pkg->slug) }}" class="px-4 py-2 rounded-xl text-xs font-extrabold text-white bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 shadow-md shadow-sky-500/20 transition transform hover:-translate-y-0.5">
                                    Tempah →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $packages->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300 p-8">
            <div class="w-16 h-16 rounded-full bg-sky-50 text-sky-600 mx-auto flex items-center justify-center text-2xl mb-4">
                🔍
            </div>
            <h3 class="text-xl font-extrabold text-slate-800">Tiada Pakej Ditemui</h3>
            <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">
                Maaf, tiada pakej yang sepadan dengan penapis atau carian anda. Sila cuba kata kunci lain atau kosongkan tapisan.
            </p>
            <div class="mt-6">
                <a href="{{ route('packages.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-sky-600 text-white font-bold text-xs shadow-md">
                    Lihat Semua Pakej
                </a>
            </div>
        </div>
    @endif
</section>
@endsection
