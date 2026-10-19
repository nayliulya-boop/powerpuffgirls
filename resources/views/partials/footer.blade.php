<footer class="bg-slate-950 text-slate-300 pt-16 pb-12 border-t border-slate-800 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
            <!-- Col 1: Brand Info -->
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-sky-500 to-blue-600 flex items-center justify-center text-white shadow-md">
                        <svg class="w-5 h-5 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                            <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-white">
                        Azure<span class="text-sky-400">Voyage</span>
                    </span>
                </a>
                <p class="mt-4 text-sm text-slate-400 max-w-sm leading-relaxed">
                    Agensi pelancongan berdaftar terkemuka menyediakan pakej percutian pulau, pakej umrah & haji bimbingan mutawwif, honeymoon eksklusif, serta day trip santai dengan jaminan kualiti premium.
                </p>
                <div class="mt-4 flex items-center gap-4 text-xs text-slate-400">
                    <span class="inline-flex items-center gap-1.5 text-emerald-400 font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        MOTAC KPK/LN 8921
                    </span>
                    <span>•</span>
                    <span>IATA Certified</span>
                </div>
            </div>

            <!-- Col 2: Kategori Pakej -->
            <div>
                <h4 class="text-xs font-bold text-white uppercase tracking-wider text-sky-400">Kategori Pakej</h4>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('packages.index', ['category' => 'Pakej Pulau']) }}" class="hover:text-white transition">Pakej Pulau & Snorkeling</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'Pakej Umrah/Haji']) }}" class="hover:text-white transition">Pakej Umrah & Haji</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'Honeymoon']) }}" class="hover:text-white transition">Pakej Honeymoon Mewah</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'Day Trip']) }}" class="hover:text-white transition">Day Trip & Hujung Minggu</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-sky-400 font-semibold hover:underline">Semua Pakej (Katalog) →</a></li>
                </ul>
            </div>

            <!-- Col 3: Portal Pelanggan -->
            <div>
                <h4 class="text-xs font-bold text-white uppercase tracking-wider text-sky-400">Portal Pelanggan</h4>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('customer.dashboard') }}" class="hover:text-white transition">Sejarah Tempahan (My Bookings)</a></li>
                    <li><a href="{{ route('customer.profile') }}" class="hover:text-white transition">Profil & Tukar Kata Laluan</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition">Ulasan & Testimoni Pelanggan</a></li>
                    <li><a href="{{ route('signup') }}" class="hover:text-white transition">Pendaftaran Akaun Pengguna</a></li>
                    <li><a href="{{ route('auth.demo') }}" class="text-amber-400 hover:text-amber-300 font-medium">Log Masuk Demo Pelanggan ⚡</a></li>
                </ul>
            </div>

            <!-- Col 4: Hubungi & Sokongan -->
            <div>
                <h4 class="text-xs font-bold text-white uppercase tracking-wider text-sky-400">Hubungi Kami</h4>
                <ul class="mt-4 space-y-2.5 text-sm text-slate-400">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-sky-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Aras 15, Menara Voyage, Jalan Ampang, 50450 Kuala Lumpur</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>+60 3-8888 2026</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>tempahan@azurevoyage.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
            <p>&copy; {{ date('Y') }} AzureVoyage Travel & Tours Sdn Bhd (Co. Reg: 202601009988). Hak cipta terpelihara.</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('about') }}" class="hover:text-slate-400 transition">Tentang Kami</a>
                <span>•</span>
                <a href="{{ route('contact') }}" class="hover:text-slate-400 transition">Hubungi & Pertanyaan</a>
                <span>•</span>
                <a href="{{ route('packages.index') }}" class="hover:text-slate-400 transition">Katalog Pakej</a>
            </div>
        </div>
    </div>
</footer>
