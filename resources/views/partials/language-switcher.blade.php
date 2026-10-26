@php
    $currentLocale = app()->getLocale();
@endphp
<div data-no-translate="true" class="inline-flex items-center rounded-xl bg-slate-100/90 border border-slate-200/80 p-1 text-xs font-extrabold shadow-sm shrink-0">
    <a
        href="{{ route('lang.switch', 'en') }}"
        title="Switch to English"
        class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ $currentLocale === 'en' ? 'bg-white text-sky-700 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}"
    >
        <span>🇬🇧</span>
        <span>EN</span>
    </a>
    <a
        href="{{ route('lang.switch', 'ms') }}"
        title="Tukar ke Bahasa Melayu"
        class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ $currentLocale === 'ms' ? 'bg-white text-sky-700 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}"
    >
        <span>🇲🇾</span>
        <span>BM</span>
    </a>
</div>

@once
@php
    $msJsonPath = lang_path('ms.json');
    $enToMsDictionary = is_file($msJsonPath) ? (json_decode(file_get_contents($msJsonPath), true) ?: []) : [];
@endphp
<script>
(function () {
    const currentLocale = @json($currentLocale);
    const baseEnToMs = @json($enToMsDictionary);

    // Additional page titles & inline fragments across all 13 pages
    const extraEnToMs = {
        "AzureVoyage — Luxury Travel & Curated Escapes": "AzureVoyage — Pelancongan Mewah & Percutian Terpilih",
        "About Us — AzureVoyage | Luxury Travel & Curated Escapes": "Tentang Kami — AzureVoyage | Pelancongan Mewah & Percutian Terpilih",
        "Customer VIP Portal & Experiences — AzureVoyage | Luxury Travel": "Portal VIP Pelanggan & Pengalaman — AzureVoyage | Pelancongan Mewah",
        "Sign In | AzureVoyage Luxury Travel Agency": "Log Masuk | Agensi Pelancongan Mewah AzureVoyage",
        "Create Account | AzureVoyage Luxury Travel Agency": "Cipta Akaun | Agensi Pelancongan Mewah AzureVoyage",
        "My Vacation Dashboard | AzureVoyage Luxury Travel Agency": "Papan Pemuka Percutian Saya | Agensi Pelancongan Mewah AzureVoyage",
        "Customer Profile & Preferences | AzureVoyage Luxury Travel Agency": "Profil & Keutamaan Pelanggan | Agensi Pelancongan Mewah AzureVoyage",
        "Travel History | AzureVoyage Luxury Travel Agency": "Sejarah Perjalanan | Agensi Pelancongan Mewah AzureVoyage",
        "Secure Online Payment | AzureVoyage Luxury Travel Agency": "Pembayaran Dalam Talian Selamat | Agensi Pelancongan Mewah AzureVoyage",
        "Official Payment Receipt | AzureVoyage Luxury Travel Agency": "Resit Pembayaran Rasmi | Agensi Pelancongan Mewah AzureVoyage",
        "Admin Portal | AzureVoyage Luxury Travel Agency": "Portal Admin | Agensi Pelancongan Mewah AzureVoyage",
        "Administrator Profile & Security | AzureVoyage Luxury Travel Agency": "Profil & Keselamatan Pentadbir | Agensi Pelancongan Mewah AzureVoyage",
        "Customer Bookings & Availability Review | AzureVoyage Admin": "Semakan Tempahan & Ketersediaan Pelanggan | Admin AzureVoyage",
        "Official Receipt / Tax Invoice": "Resit Rasmi / Invois Cukai",
        "Description": "Butiran",
        "Customer": "Pelanggan",
        "1 Guest (Solo Luxury)": "1 Tetamu (Mewah Solo)",
        "2 Guests (Couple)": "2 Tetamu (Pasangan)",
        "3 Guests": "3 Tetamu",
        "4 Guests (Family Villa)": "4 Tetamu (Vila Keluarga)",
        "5 Guests": "5 Tetamu",
        "6 Guests (Private Estate)": "6 Tetamu (Estet Peribadi)",
        "8 Guests (Yacht Charter)": "8 Tetamu (Sewaan Kapal Layar)",
        "10 Guests (VIP Group)": "10 Tetamu (Kumpulan VIP)",
        "Signature Gold (5★ Luxury Suite)": "Signature Gold (Suite Mewah 5★)",
        "Platinum Horizon (Overwater / Cliffside Villa)": "Platinum Horizon (Vila Atas Air / Tepi Tebing)",
        "Diamond Sovereign (Private Yacht & Jet Charter)": "Diamond Sovereign (Kapal Layar & Jet Peribadi)",
        "Approve booking": "Luluskan tempahan",
        "Cancel booking": "Batalkan tempahan",
        "Close Modal": "Tutup Modal",
        "Credit/Debit Card": "Kad Kredit/Debit",
        "Online Banking": "Perbankan Dalam Talian",
        "Slot availability verified by administrator.": "Disahkan ketersediaan slot oleh pentadbir."
    };

    const enToMs = Object.assign({}, baseEnToMs, extraEnToMs);
    const msToEn = {};

    // Normalize quotes helper
    function normalizeText(str) {
        return str
            .replace(/[\u201C\u201D]/g, '"')
            .replace(/[\u2018\u2019]/g, "'")
            .replace(/\s+/g, ' ')
            .trim();
    }

    const normalizedEnToMs = {};
    const normalizedMsToEn = {};

    Object.keys(enToMs).forEach(function (enKey) {
        const msVal = enToMs[enKey];
        const normEn = normalizeText(enKey);
        const normMs = normalizeText(msVal);
        normalizedEnToMs[normEn] = msVal;
        if (!normalizedMsToEn[normMs]) {
            normalizedMsToEn[normMs] = enKey;
        }
        msToEn[msVal] = enKey;
    });

    // Dynamic regex patterns for numbers, dates, names, and counters
    const enToMsPatterns = [
        [/^(\d+)\s+Days$/i, '$1 Hari'],
        [/^\((\d+)\s+reviews\)$/i, '($1 ulasan)'],
        [/^Welcome Customer,\s*(.+)$/i, 'Selamat Datang Pelanggan, $1'],
        [/^Welcome Admin,\s*(.+)$/i, 'Selamat Datang Admin, $1'],
        [/^View My Vacations\s*\((\d+)\)$/i, 'Lihat Percutian Saya ($1)'],
        [/^Total spend:\s*RM\s*(.+)$/i, 'Jumlah perbelanjaan: RM $1'],
        [/^(\d+)\s+Nights$/i, '$1 Malam'],
        [/^(\d+)\s+nights?$/i, '$1 malam'],
        [/^(\d+)\s+Guests?$/i, '$1 Tetamu'],
        [/^(\d+)\s+guests?$/i, '$1 tetamu'],
        [/^(\d+)\s+Travelers?$/i, '$1 Pelancong'],
        [/^(\d+)\s+Orang Pelancong$/i, '$1 Orang Pelancong'],
        [/^to\s+([A-Za-z]+\s+\d+,\s+\d{4})\s*\((\d+)\s+nights?\)$/i, 'hingga $1 ($2 malam)'],
        [/^to\s+([A-Za-z]+\s+\d+,\s+\d{4})\s*\((\d+)\s+guests?\)$/i, 'hingga $1 ($2 tetamu)'],
        [/^Showing\s+(\d+)\s+of\s+(\d+)\s+total vacation bookings\.$/i, 'Memaparkan $1 daripada $2 jumlah tempahan percutian.'],
        [/^All Statuses\s*\((\d+)\)$/i, 'Semua Status ($1)'],
        [/^Pending\s*\((\d+)\)$/i, 'Menunggu ($1)'],
        [/^Approved\s*\((\d+)\)$/i, 'Diluluskan ($1)'],
        [/^Completed\s*\((\d+)\)$/i, 'Selesai ($1)'],
        [/^Rejected\s*\((\d+)\)$/i, 'Ditolak ($1)'],
        [/^Cancelled\s*\((\d+)\)$/i, 'Dibatalkan ($1)'],
        [/^All Bookings\s*\((\d+)\)$/i, 'Semua Tempahan ($1)'],
        [/^(\d+)\s+Paid$/i, '$1 Dibayar'],
        [/^PAID\s*\(RM\s*(.+)\)$/i, 'DIBAYAR (RM $1)'],
        [/^Pay Now\s*—\s*RM\s*(.+)$/i, 'Bayar Sekarang — RM $1'],
        [/^(\d+)\s+New Bookings Awaiting Admin Availability Review!$/i, '$1 Tempahan Baharu Menunggu Semakan Ketersediaan Admin!'],
        [/^•\s*Passport ID:$/i, '• ID Pasport:'],
        [/^•\s*Department:$/i, '• Jabatan:'],
        [/^•\s*Customer ID:$/i, '• ID Pelanggan:'],
        [/^Reviewed by\s+(.+)\s+on\s+(.+)$/i, 'Disemak oleh $1 pada $2'],
        [/^Approved by\s+(.+)\s+•\s+Reference\s+#(.+)$/i, 'Diluluskan oleh $1 • Rujukan #$2'],
        [/^Pay RM\s*(.+)\s*&\s*Confirm Booking$/i, 'Bayar RM $1 & Sahkan Tempahan'],
        [/^(\d+)\s+Persons?$/i, '$1 Orang'],
        [/^(\d+)\s+Pax$/i, '$1 Orang'],
        [/^★\s*(.+)\s+Tier$/i, '★ Tahap $1'],
        [/^Submitted\s+(.+)$/i, 'Dihantar $1'],
        [/^©\s*(\d{4})\s+AzureVoyage Luxury Travel Agency\.\s*All rights reserved\.\s*ATOL & IATA Accredited Member\.$/i, '© $1 Agensi Pelancongan Mewah AzureVoyage. Hak cipta terpelihara. Ahli Diperakui ATOL & IATA.'],
        [/^(.+)\s+•\s+(\d+)\s+Days\s+•\s+\$(.+)$/i, '$1 • $2 Hari • $$$3']
    ];

    const msToEnPatterns = [
        [/^(\d+)\s+Hari$/i, '$1 Days'],
        [/^\((\d+)\s+ulasan\)$/i, '($1 reviews)'],
        [/^Selamat Datang Pelanggan,\s*(.+)$/i, 'Welcome Customer, $1'],
        [/^Selamat Datang Admin,\s*(.+)$/i, 'Welcome Admin, $1'],
        [/^Lihat Percutian Saya\s*\((\d+)\)$/i, 'View My Vacations ($1)'],
        [/^Jumlah perbelanjaan:\s*RM\s*(.+)$/i, 'Total spend: RM $1'],
        [/^(\d+)\s+Malam$/i, '$1 Nights'],
        [/^(\d+)\s+malam$/i, '$1 nights'],
        [/^(\d+)\s+Tetamu$/i, '$1 Guests'],
        [/^(\d+)\s+tetamu$/i, '$1 guests'],
        [/^(\d+)\s+Pelancong$/i, '$1 Travelers'],
        [/^(\d+)\s+Orang Pelancong$/i, '$1 Travelers'],
        [/^hingga\s+([A-Za-z]+\s+\d+,\s+\d{4})\s*\((\d+)\s+malam\)$/i, 'to $1 ($2 nights)'],
        [/^hingga\s+([A-Za-z]+\s+\d+,\s+\d{4})\s*\((\d+)\s+tetamu\)$/i, 'to $1 ($2 guests)'],
        [/^Memaparkan\s+(\d+)\s+daripada\s+(\d+)\s+jumlah tempahan percutian\.$/i, 'Showing $1 of $2 total vacation bookings.'],
        [/^Semua Status\s*\((\d+)\)$/i, 'All Statuses ($1)'],
        [/^Menunggu\s*\((\d+)\)$/i, 'Pending ($1)'],
        [/^Diluluskan\s*\((\d+)\)$/i, 'Approved ($1)'],
        [/^Selesai\s*\((\d+)\)$/i, 'Completed ($1)'],
        [/^Ditolak\s*\((\d+)\)$/i, 'Rejected ($1)'],
        [/^Dibatalkan\s*\((\d+)\)$/i, 'Cancelled ($1)'],
        [/^Semua Tempahan\s*\((\d+)\)$/i, 'All Bookings ($1)'],
        [/^(\d+)\s+Dibayar$/i, '$1 Paid'],
        [/^DIBAYAR\s*\(RM\s*(.+)\)$/i, 'PAID (RM $1)'],
        [/^Bayar Sekarang\s*—\s*RM\s*(.+)$/i, 'Pay Now — RM $1'],
        [/^(\d+)\s+Tempahan Baharu Menunggu Semakan Ketersediaan Admin!$/i, '$1 New Bookings Awaiting Admin Availability Review!'],
        [/^•\s*ID Pasport:$/i, '• Passport ID:'],
        [/^•\s*Jabatan:$/i, '• Department:'],
        [/^•\s*ID Pelanggan:$/i, '• Customer ID:'],
        [/^Disemak oleh\s+(.+)\s+pada\s+(.+)$/i, 'Reviewed by $1 on $2'],
        [/^Diluluskan oleh\s+(.+)\s+•\s+Rujukan\s+#(.+)$/i, 'Approved by $1 • Reference #$2'],
        [/^Bayar RM\s*(.+)\s*&\s*Sahkan Tempahan$/i, 'Pay RM $1 & Confirm Booking'],
        [/^(\d+)\s+Orang$/i, '$1 Persons'],
        [/^★\s*Tahap\s+(.+)$/i, '★ $1 Tier'],
        [/^Dihantar\s+(.+)$/i, 'Submitted $1'],
        [/^Kad Kredit\/Debit\s*\((.+)\)$/i, 'Credit/Debit Card ($1)'],
        [/^©\s*(\d{4})\s+Agensi Pelancongan Mewah AzureVoyage\.\s*Hak cipta terpelihara\.\s*Ahli Diperakui ATOL & IATA\.$/i, '© $1 AzureVoyage Luxury Travel Agency. All rights reserved. ATOL & IATA Accredited Member.'],
        [/^(.+)\s+•\s+(\d+)\s+Hari\s+•\s+\$(.+)$/i, '$1 • $2 Days • $$$3']
    ];

    const activeDict = currentLocale === 'ms' ? normalizedEnToMs : normalizedMsToEn;
    const activePatterns = currentLocale === 'ms' ? enToMsPatterns : msToEnPatterns;

    function translateString(raw) {
        if (!raw || typeof raw !== 'string') {
            return null;
        }
        const norm = normalizeText(raw);
        if (!norm || norm.length < 2) {
            return null;
        }

        if (Object.prototype.hasOwnProperty.call(activeDict, norm)) {
            return activeDict[norm];
        }

        // Check if string has leading/trailing bullets or symbols like "• " or "★ "
        const prefixMatch = norm.match(/^([•★✓✨⏳❌🛡️🔒📍📞🧾⚡]+\s*)(.+)$/);
        if (prefixMatch) {
            const innerNorm = prefixMatch[2].trim();
            if (Object.prototype.hasOwnProperty.call(activeDict, innerNorm)) {
                return prefixMatch[1] + activeDict[innerNorm];
            }
        }

        // Check if string has trailing asterisk or colon
        const colonMatch = norm.match(/^(.+?)(\s*[:*→↑]+)$/);
        if (colonMatch) {
            const innerNorm = colonMatch[1].trim();
            if (Object.prototype.hasOwnProperty.call(activeDict, innerNorm)) {
                return activeDict[innerNorm] + colonMatch[2];
            }
        }

        for (let i = 0; i < activePatterns.length; i++) {
            const [regex, replacement] = activePatterns[i];
            if (regex.test(norm)) {
                return norm.replace(regex, replacement);
            }
        }

        return null;
    }

    const ignoredTags = new Set(['SCRIPT', 'STYLE', 'CODE', 'NOSCRIPT', 'TEXTAREA']);

    function translateTextNode(node) {
        const parent = node.parentElement;
        if (!parent || ignoredTags.has(parent.tagName) || parent.closest('[data-no-translate="true"]')) {
            return;
        }

        const raw = node.nodeValue;
        if (!raw || !raw.trim()) {
            return;
        }

        const translated = translateString(raw);
        if (translated && translated !== raw.trim()) {
            const leadingSpace = raw.match(/^\s*/)[0];
            const trailingSpace = raw.match(/\s*$/)[0];
            const nextValue = leadingSpace + translated + trailingSpace;
            if (node.nodeValue !== nextValue) {
                node.nodeValue = nextValue;
            }
        }
    }

    function translateElementAttributes(root) {
        if (!root || !root.querySelectorAll) {
            return;
        }
        const elements = root.querySelectorAll('[placeholder], [title], [aria-label], input[type="submit"], input[type="button"]');
        elements.forEach(function (el) {
            if (el.closest('[data-no-translate="true"]')) {
                return;
            }
            ['placeholder', 'title', 'aria-label'].forEach(function (attr) {
                if (el.hasAttribute(attr)) {
                    const val = el.getAttribute(attr);
                    const translated = translateString(val);
                    if (translated && translated !== val) {
                        el.setAttribute(attr, translated);
                    }
                }
            });
            if ((el.tagName === 'INPUT') && (el.type === 'submit' || el.type === 'button') && el.value) {
                const translated = translateString(el.value);
                if (translated && translated !== el.value) {
                    el.value = translated;
                }
            }
        });
    }

    function translateSubtree(root) {
        if (!root) {
            return;
        }
        if (root.nodeType === Node.TEXT_NODE) {
            translateTextNode(root);
            return;
        }
        const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null);
        const textNodes = [];
        let current;
        while ((current = walker.nextNode())) {
            textNodes.push(current);
        }
        textNodes.forEach(translateTextNode);
        translateElementAttributes(root);
    }

    function runFullPageTranslation() {
        if (document.title) {
            const translatedTitle = translateString(document.title);
            if (translatedTitle) {
                document.title = translatedTitle;
            }
        }
        translateSubtree(document.body);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', runFullPageTranslation);
    } else {
        runFullPageTranslation();
    }

    // Observe dynamic DOM updates (modals, price calculators, toastr notifications)
    let isTranslating = false;
    const observer = new MutationObserver(function (mutations) {
        if (isTranslating) {
            return;
        }
        isTranslating = true;
        try {
            mutations.forEach(function (mutation) {
                if (mutation.type === 'characterData') {
                    translateTextNode(mutation.target);
                } else if (mutation.type === 'childList') {
                    mutation.addedNodes.forEach(function (added) {
                        if (added.nodeType === Node.TEXT_NODE) {
                            translateTextNode(added);
                        } else if (added.nodeType === Node.ELEMENT_NODE) {
                            translateSubtree(added);
                        }
                    });
                }
            });
        } finally {
            isTranslating = false;
        }
    });

    function startObserver() {
        if (document.body) {
            observer.observe(document.body, {
                childList: true,
                subtree: true,
                characterData: true
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startObserver);
    } else {
        startObserver();
    }
})();
</script>
@endonce
