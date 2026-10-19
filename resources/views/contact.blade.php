@extends('layouts.app')

@section('title', 'Hubungi Kami & Testimoni Pelanggan | AzureVoyage')
@section('meta_description', 'Hubungi pasukan perunding pelancongan AzureVoyage untuk sebarang pertanyaan atau baca ulasan dan testimoni pelanggan kami.')

@section('content')
<!-- Header Banner -->
<section class="bg-mesh-blue py-12 md:py-16 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest text-sky-700 bg-sky-100 mb-3">
            💬 Khidmat Pelanggan 24/7
        </span>
        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">
            Hubungi Kami & Ulasan Pelanggan
        </h1>
        <p class="mt-4 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Ada sebarang persoalan tentang pakej atau ingin berkongsi pengalaman manis percutian anda? Pasukan AzureVoyage sedia membantu anda.
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Notifications -->
    @if(session('inquiry_success'))
        <div class="mb-8 p-5 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-900 flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shrink-0">✓</span>
            <p class="text-sm font-bold">{{ session('inquiry_success') }}</p>
        </div>
    @endif

    @if(session('review_success'))
        <div class="mb-8 p-5 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-900 flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shrink-0">⭐</span>
            <p class="text-sm font-bold">{{ session('review_success') }}</p>
        </div>
    @endif

    <!-- Grid: Inquiry Form & Office Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">
        <!-- 2 Cols: Borang Pertanyaan (Inquiry Form) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm">
            <div class="mb-6">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                    Borang Pertanyaan (Inquiry)
                </span>
                <h2 class="text-2xl font-black text-slate-900 mt-2">
                    Hantarkan Mesej / Pertanyaan Anda
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Pegawai perunding percutian kami akan memberi maklum balas melalui emel atau panggilan dalam tempoh 24 jam.
                </p>
            </div>

            <form action="{{ route('contact.inquiry') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Nama Penuh <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" required placeholder="Jane Doe"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Alamat Emel <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required placeholder="emel@contoh.com"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="phone" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Nombor Telefon / WhatsApp <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" required placeholder="012-3456789"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label for="subject" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Subjek Pertanyaan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required placeholder="Cth: Pakej Umrah Disember 2026"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Mesej Terperinci <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="message" name="message" rows="4" required placeholder="Nyatakan tarikh percutian pilihan, bilangan peserta, atau sebarang persoalan khusus..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm shadow-md shadow-sky-600/25 transition">
                    Hantar Pertanyaan →
                </button>
            </form>
        </div>

        <!-- 1 Col: Maklumat Agensi & Alamat Pejabat -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-base font-black text-slate-900 pb-3 border-b border-slate-100">
                    Ibu Pejabat AzureVoyage
                </h3>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                            📍
                        </div>
                        <div>
                            <span class="block font-bold text-slate-900">Alamat Galeri</span>
                            <span class="text-slate-500">Aras 15, Menara Voyage, Jalan Ampang, 50450 Kuala Lumpur, Malaysia.</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                            📞
                        </div>
                        <div>
                            <span class="block font-bold text-slate-900">Talian Khidmat Pelanggan</span>
                            <span class="text-slate-500">+60 3-8888 2026 / +60 12-9988 7766</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                            ✉️
                        </div>
                        <div>
                            <span class="block font-bold text-slate-900">Emel Rasmi</span>
                            <span class="text-slate-500">tempahan@azurevoyage.com</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                            ⏰
                        </div>
                        <div>
                            <span class="block font-bold text-slate-900">Waktu Operasi</span>
                            <span class="text-slate-500">Isnin - Jumaat: 9:00 AM - 6:00 PM<br>Sabtu: 9:00 AM - 1:00 PM (Ahad & Cuti Umum Tutup)</span>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-600 space-y-1">
                    <p class="font-bold text-slate-900">🛡️ Agensi Diperakui:</p>
                    <p>• Lesen MOTAC No: KPK/LN 8921</p>
                    <p>• Ahli Persatuan Syarikat Pelancongan MATTA</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Ruangan Testimoni atau Review Pelanggan Selepas Selesai Trip -->
    <div class="pt-12 border-t border-slate-200">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                    Ulasan & Pengalaman Pelanggan
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">
                    Apa Kata Pelanggan Kami Selepas Trip
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Ulasan jujur daripada tetamu yang telah selesai menikmati pakej bersama AzureVoyage.
                </p>
            </div>

            <!-- Button to open Add Review Form -->
            <a href="#tulis-review" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs shadow-md transition">
                <span>✍️ Tulis Testimoni Anda</span>
            </a>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($reviews as $rev)
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 text-amber-400 text-sm mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rev->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                            <span class="text-xs font-black text-slate-700 ml-1">({{ $rev->rating }}/5)</span>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-700 italic leading-relaxed mb-4">
                            "{{ $rev->review_text }}"
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <div>
                            <span class="font-extrabold text-slate-900 block">{{ $rev->author_name }}</span>
                            <span class="text-[11px] text-sky-600 font-semibold">
                                {{ $rev->package ? $rev->package->title : ($rev->trip_category ?? 'Pelanggan Sah') }}
                            </span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">
                            {{ $rev->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                    <p class="text-sm font-semibold text-slate-500">Belum ada testimoni diterbitkan. Jadilah yang pertama berkongsi pengalaman anda!</p>
                </div>
            @endforelse
        </div>

        <!-- Borang Tambah Review / Testimoni Selepas Trip -->
        <div id="tulis-review" class="bg-gradient-to-tr from-sky-50 via-white to-sky-50/50 rounded-3xl p-6 sm:p-10 border-2 border-sky-200 shadow-lg">
            <div class="max-w-2xl mx-auto text-center mb-8">
                <span class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 inline-flex items-center justify-center text-lg mb-2">⭐</span>
                <h3 class="text-2xl font-black text-slate-900">Kongsi Pengalaman Percutian Anda</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Maklum balas anda membantu kami terus meningkatkan mutu layanan bagi setiap pengembara.
                </p>
            </div>

            <form action="{{ route('contact.review') }}" method="POST" class="max-w-2xl mx-auto space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="author_name" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Nama Anda <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="author_name" name="author_name" value="{{ old('author_name', Auth::user()->name ?? '') }}" required placeholder="Nama Anda"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500 bg-white">
                    </div>

                    <div>
                        <label for="package_id" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Pakej Yang Dihadiri
                        </label>
                        <select id="package_id" name="package_id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500 bg-white">
                            <option value="">Pilih Pakej (Pilihan)</option>
                            @foreach($packages as $pkg)
                                <option value="{{ $pkg->id }}">{{ $pkg->title }} ({{ $pkg->category }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="rating" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Penarafan / Rating <span class="text-rose-500">*</span>
                        </label>
                        <select id="rating" name="rating" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500 bg-white">
                            <option value="5" selected>⭐⭐⭐⭐⭐ (5 Bintang - Cemerlang)</option>
                            <option value="4">⭐⭐⭐⭐ (4 Bintang - Sangat Baik)</option>
                            <option value="3">⭐⭐⭐ (3 Bintang - Baik)</option>
                            <option value="2">⭐⭐ (2 Bintang - Sederhana)</option>
                            <option value="1">⭐ (1 Bintang - Memerlukan Penambahbaikan)</option>
                        </select>
                    </div>

                    <div>
                        <label for="trip_category" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                            Kategori Trip
                        </label>
                        <input type="text" id="trip_category" name="trip_category" placeholder="Cth: Pakej Pulau / Honeymoon / Umrah"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500 bg-white">
                    </div>
                </div>

                <div>
                    <label for="review_text" class="block text-xs font-black uppercase text-slate-700 mb-1.5">
                        Ulasan / Pengalaman Anda <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="review_text" name="review_text" rows="4" required placeholder="Ceritakan tentang layanan krew, keselesaan hotel, ketepatan masa, atau tempat menarik sepanjang percutian..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500 bg-white"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm shadow-md shadow-sky-600/30 transition">
                    Hantar Ulasan Testimoni
                </button>
            </form>
        </div>
    </div>
</section>
@endsection

