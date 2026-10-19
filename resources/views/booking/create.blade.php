@extends('layouts.app')

@section('title', 'Tempahan: ' . $package->title . ' | AzureVoyage')

@section('content')
<!-- Booking Flow Progress Steps -->
<div class="bg-white border-b border-slate-200 py-4 shadow-sm">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between text-xs sm:text-sm font-extrabold">
            <div class="flex items-center gap-2 text-sky-600">
                <span class="w-7 h-7 rounded-full bg-sky-600 text-white flex items-center justify-center text-xs">1</span>
                <span>Maklumat Tempahan</span>
            </div>
            <div class="w-12 sm:w-24 h-0.5 bg-slate-200"></div>
            <div class="flex items-center gap-2 text-slate-400">
                <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs">2</span>
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

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left 2 Cols: Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <div class="mb-8">
                    <span class="text-xs font-bold uppercase tracking-wider text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                        Borang Tempahan Rasmi
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">
                        Lengkapkan Butiran Tempahan Anda
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Sila pastikan maklumat peserta sepadan dengan dokumen pengenalan (MyKad / Pasport).
                    </p>
                </div>

                <form action="{{ route('booking.store', $package->slug) }}" method="POST" id="bookingForm" class="space-y-8">
                    @csrf

                    <!-- 1. Tarikh & Bilangan Slot -->
                    <div class="space-y-4">
                        <h2 class="text-base font-black text-slate-900 flex items-center gap-2 pb-2 border-b border-slate-100">
                            <span class="w-6 h-6 rounded-lg bg-sky-600 text-white flex items-center justify-center text-xs">1</span>
                            Tarikh Trip & Bilangan Peserta
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="trip_date" class="block text-xs font-extrabold uppercase text-slate-700 mb-1">
                                    Tarikh Trip <span class="text-rose-500">*</span>
                                </label>
                                <input type="date" id="trip_date" name="trip_date"
                                       value="{{ old('trip_date', $initialDate) }}"
                                       min="{{ date('Y-m-d') }}"
                                       required
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-800 focus:outline-none focus:border-sky-500">
                            </div>

                            <div>
                                <label for="adult_count" class="block text-xs font-extrabold uppercase text-slate-700 mb-1">
                                    Dewasa (12+ thn) <span class="text-rose-500">*</span>
                                </label>
                                <input type="number" id="adult_count" name="adult_count"
                                       value="{{ old('adult_count', $initialAdults) }}"
                                       min="1" max="50" required
                                       oninput="updatePricingAndParticipants()"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-800 focus:outline-none focus:border-sky-500">
                            </div>

                            <div>
                                <label for="child_count" class="block text-xs font-extrabold uppercase text-slate-700 mb-1">
                                    Kanak-kanak (2-11 thn)
                                </label>
                                <input type="number" id="child_count" name="child_count"
                                       value="{{ old('child_count', $initialChildren) }}"
                                       min="0" max="50"
                                       oninput="updatePricingAndParticipants()"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-800 focus:outline-none focus:border-sky-500">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Maklumat Perhubungan Utama -->
                    <div class="space-y-4">
                        <h2 class="text-base font-black text-slate-900 flex items-center gap-2 pb-2 border-b border-slate-100">
                            <span class="w-6 h-6 rounded-lg bg-sky-600 text-white flex items-center justify-center text-xs">2</span>
                            Maklumat Perhubungan Utama (Wakil Tempahan)
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label for="contact_name" class="block text-xs font-extrabold uppercase text-slate-700 mb-1">
                                    Nama Penuh Wakil <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="contact_name" name="contact_name"
                                       value="{{ old('contact_name', Auth::user()->name ?? '') }}"
                                       placeholder="Nama seperti dalam MyKad" required
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                            </div>

                            <div>
                                <label for="contact_email" class="block text-xs font-extrabold uppercase text-slate-700 mb-1">
                                    Alamat Emel <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" id="contact_email" name="contact_email"
                                       value="{{ old('contact_email', Auth::user()->email ?? '') }}"
                                       placeholder="emel@contoh.com" required
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                            </div>

                            <div>
                                <label for="contact_phone" class="block text-xs font-extrabold uppercase text-slate-700 mb-1">
                                    Nombor Telefon / WhatsApp <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="contact_phone" name="contact_phone"
                                       value="{{ old('contact_phone', Auth::user()->phone ?? '') }}"
                                       placeholder="012-3456789" required
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Borang Butiran Peserta (Nama, No IC/Pasport, Telefon) -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-sky-600 text-white flex items-center justify-center text-xs">3</span>
                                Senarai Butiran Peserta / Travelers
                            </h2>
                            <button type="button" onclick="addParticipantRow()" class="px-3 py-1 rounded-lg text-xs font-bold text-sky-600 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition">
                                + Tambah Peserta
                            </button>
                        </div>

                        <p class="text-xs text-slate-500">
                            Diperlukan untuk perlindungan insurans perjalanan dan pendaftaran penerbangan / feri / permit.
                        </p>

                        <!-- Participant List Container -->
                        <div id="participantsContainer" class="space-y-3">
                            <!-- Default Row 1 (Primary Traveler) -->
                            <div class="participant-row bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase text-sky-700 tracking-wider">
                                        Peserta #1 (Ketua / Dewasa)
                                    </span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Nama Penuh</label>
                                        <input type="text" name="participants[0][name]" placeholder="Nama Peserta 1" required
                                               class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-900">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-600 mb-1">No. IC / Pasport</label>
                                        <input type="text" name="participants[0][ic_passport]" placeholder="000101-14-1234 / A1234567" required
                                               class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-900">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-600 mb-1">No. Telefon</label>
                                        <input type="text" name="participants[0][phone]" placeholder="012-XXXXXXX"
                                               class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-900">
                                        <input type="hidden" name="participants[0][type]" value="Dewasa">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Permintaan Khas -->
                    <div class="space-y-2">
                        <label for="special_notes" class="block text-xs font-extrabold uppercase text-slate-700">
                            Permintaan Khas / Nota Tambahan (Pilihan)
                        </label>
                        <textarea id="special_notes" name="special_notes" rows="3"
                                  placeholder="Contoh: Makanan halal tanpa kacang, bantuan kerusi roda, permintaan bilik bersebelahan..."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-500">{{ old('special_notes') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-sm sm:text-base shadow-xl shadow-sky-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span>Langkah Seterusnya: Pembayaran</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Right 1 Col: Package Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-28 bg-white rounded-3xl p-6 border border-slate-200 shadow-md space-y-5">
                <div class="rounded-2xl overflow-hidden h-40 bg-slate-100 relative">
                    <img src="{{ $package->featured_image }}" alt="{{ $package->title }}" class="w-full h-full object-cover">
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-xs font-bold bg-white/95 text-slate-900">
                        {{ $package->category }}
                    </span>
                </div>

                <div>
                    <h3 class="font-extrabold text-base text-slate-900">{{ $package->title }}</h3>
                    <div class="mt-2 text-xs text-slate-500 space-y-1">
                        <p>📍 Destinasi: <strong class="text-slate-800">{{ $package->destination }}</strong></p>
                        <p>⏱️ Tempoh: <strong class="text-slate-800">{{ $package->duration }}</strong></p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 space-y-2 text-xs font-semibold text-slate-600">
                    <div class="flex justify-between">
                        <span>Dewasa (<span id="side_adult_count">1</span>x @ RM {{ number_format($package->price_adult, 2) }})</span>
                        <span id="side_adult_total">RM {{ number_format($package->price_adult, 2) }}</span>
                    </div>
                    @if($package->price_child > 0)
                        <div class="flex justify-between">
                            <span>Kanak-kanak (<span id="side_child_count">0</span>x @ RM {{ number_format($package->price_child, 2) }})</span>
                            <span id="side_child_total">RM 0.00</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-slate-500">
                        <span>Cukai & Yuran Perkhidmatan</span>
                        <span class="text-emerald-600 font-bold">Termasuk</span>
                    </div>

                    <div class="pt-3 border-t border-dashed border-slate-200 flex justify-between items-baseline text-slate-900">
                        <span class="text-sm font-extrabold">Jumlah Keseluruhan:</span>
                        <span id="side_grand_total" class="text-2xl font-black text-sky-600">
                            RM {{ number_format($package->price_adult, 2) }}
                        </span>
                    </div>
                </div>

                <div class="bg-sky-50 rounded-2xl p-4 text-xs text-sky-800 space-y-1.5 font-medium">
                    <p class="font-bold flex items-center gap-1.5 text-sky-900">
                        <span>🛡️</span> Jaminan AzureVoyage:
                    </p>
                    <p>• Pilihan Pembayaran Atas Talian (FPX/Stripe) atau Slip Bank Manual.</p>
                    <p>• Baucar sah & tiket rasmi dijana sebaik pembayaran selesai.</p>
                </div>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
    const priceAdult = {{ (float) $package->price_adult }};
    const priceChild = {{ (float) $package->price_child }};
    let participantIndex = 1;

    function updatePricingAndParticipants() {
        const adults = parseInt(document.getElementById('adult_count').value) || 0;
        const children = parseInt(document.getElementById('child_count').value) || 0;

        const adultTotal = adults * priceAdult;
        const childTotal = children * priceChild;
        const grandTotal = adultTotal + childTotal;

        document.getElementById('side_adult_count').textContent = adults;
        document.getElementById('side_adult_total').textContent = 'RM ' + adultTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        const sideChildCount = document.getElementById('side_child_count');
        const sideChildTotal = document.getElementById('side_child_total');
        if (sideChildCount) sideChildCount.textContent = children;
        if (sideChildTotal) sideChildTotal.textContent = 'RM ' + childTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        document.getElementById('side_grand_total').textContent = 'RM ' + grandTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function addParticipantRow() {
        const container = document.getElementById('participantsContainer');
        const idx = participantIndex++;
        const row = document.createElement('div');
        row.className = 'participant-row bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-3';
        row.innerHTML = `
            <div class="flex items-center justify-between">
                <span class="text-xs font-black uppercase text-sky-700 tracking-wider">
                    Peserta #${idx + 1}
                </span>
                <button type="button" onclick="this.closest('.participant-row').remove()" class="text-xs text-rose-600 font-bold hover:underline">
                    ✕ Padam
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Nama Penuh</label>
                    <input type="text" name="participants[${idx}][name]" placeholder="Nama Peserta ${idx + 1}" required
                           class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-900">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">No. IC / Pasport</label>
                    <input type="text" name="participants[${idx}][ic_passport]" placeholder="No. IC atau Pasport" required
                           class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-900">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Kategori</label>
                    <select name="participants[${idx}][type]" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-900">
                        <option value="Dewasa">Dewasa</option>
                        <option value="Kanak-kanak">Kanak-kanak</option>
                    </select>
                </div>
            </div>
        `;
        container.appendChild(row);
    }

    document.addEventListener('DOMContentLoaded', updatePricingAndParticipants);
</script>
@endpush
@endsection

