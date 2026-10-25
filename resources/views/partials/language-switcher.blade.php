{{-- Language Switcher Partial (English / Bahasa Melayu) --}}
<div class="inline-flex items-center p-0.5 bg-slate-100/90 hover:bg-slate-100 rounded-xl border border-slate-200/80 shadow-inner text-xs font-bold transition">
    <a
        href="{{ route('lang.switch', 'en') }}"
        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg transition-all duration-150 {{ app()->getLocale() === 'en' ? 'bg-white text-sky-700 shadow-sm font-extrabold' : 'text-slate-600 hover:text-slate-900' }}"
        title="Switch to English"
        aria-label="Switch to English"
    >
        <span>🇬🇧</span>
        <span>EN</span>
    </a>
    <a
        href="{{ route('lang.switch', 'ms') }}"
        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg transition-all duration-150 {{ app()->getLocale() === 'ms' ? 'bg-white text-sky-700 shadow-sm font-extrabold' : 'text-slate-600 hover:text-slate-900' }}"
        title="Tukar ke Bahasa Melayu"
        aria-label="Tukar ke Bahasa Melayu"
    >
        <span>🇲🇾</span>
        <span>BM</span>
    </a>
</div>

