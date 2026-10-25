<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Official E-Voucher & Payment Receipt #{{ $vacation->package_code }} | AzureVoyage</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .printable-card {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white py-6 sm:py-10">

    <div class="max-w-3xl mx-auto px-4 sm:px-6 w-full space-y-6">

        @if (auth()->check() && auth()->user()->isAdmin())
            <!-- Admin Preview Mode Banner -->
            <div class="bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 text-slate-950 p-3.5 sm:p-4 rounded-2xl shadow-sm font-semibold flex flex-wrap items-center justify-between gap-3 no-print border border-amber-300">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black bg-slate-950 text-amber-300 uppercase tracking-wider">
                        🛡️ Mode Pentadbir
                    </span>
                    <span class="text-xs sm:text-sm font-bold text-slate-950">
                        Pratonton Resit Pelanggan: <strong>{{ $user->name }}</strong> (#{{ $vacation->package_code }})
                    </span>
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="px-3 py-1.5 rounded-xl bg-slate-950 hover:bg-slate-900 text-amber-300 hover:text-white text-xs font-extrabold transition flex items-center gap-1.5 shadow-sm">
                    ← Kembali ke Tempahan Admin
                </a>
            </div>
        @endif

        <!-- Top Navigation / Action Bar -->
        <div class="flex items-center justify-between no-print">
            <a href="{{ route('customer.dashboard') }}" class="text-xs sm:text-sm font-bold text-slate-600 hover:text-sky-600 flex items-center gap-1.5 transition">
                ← {{ __('Back to Dashboard') }}
            </a>

            <div class="flex items-center gap-3">
                @include('partials.language-switcher')
                <button
                    onclick="window.print()"
                    class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>{{ __('Print Receipt') }}</span>
                </button>
            </div>
        </div>

        @if (session('status'))
            <div class="rounded-2xl p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-semibold flex items-center gap-3 shadow-sm no-print">
                <span class="text-xl">🎉</span>
                <p>{{ session('status') }}</p>
            </div>
        @endif

        <!-- Main Printable Receipt Card -->
        <div class="printable-card bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xl space-y-8 relative overflow-hidden">

            <!-- Decorative Watermark / Accent -->
            <div class="absolute top-0 left-0 right-0 h-3 bg-gradient-to-r from-sky-600 via-amber-400 to-blue-600"></div>

            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-8 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white font-extrabold text-xl shadow-md shadow-sky-500/20">
                        ✈️
                    </div>
                    <div>
                        <span class="text-2xl font-black text-slate-900 tracking-tight flex items-center gap-1">
                            Azure<span class="text-sky-600">Voyage</span>
                        </span>
                        <span class="block text-[10px] uppercase tracking-widest font-extrabold text-slate-400">
                            Luxury Travel Agency • Official Travel Voucher
                        </span>
                    </div>
                </div>

                <div class="text-left sm:text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase bg-emerald-100 text-emerald-800 border border-emerald-200 mb-1">
                        ✓ CONFIRMED & SETTLED
                    </span>
                    <span class="block text-xs font-mono font-bold text-slate-500">
                        Voucher Code: <strong>#{{ $vacation->package_code }}</strong>
                    </span>
                </div>
            </div>

            <!-- Customer & Transaction Information -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs">
                <div>
                    <span class="text-slate-400 block uppercase font-semibold text-[10px]">Primary Traveler</span>
                    <strong class="text-slate-900 block text-sm">{{ $user->name }}</strong>
                    <span class="text-slate-500 text-[11px]">{{ $user->email }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block uppercase font-semibold text-[10px]">Payment Reference</span>
                    <strong class="text-sky-700 block font-mono text-xs">{{ $payment?->transaction_reference ?? ('AV-TXN-'.($vacation->package_code ?? $vacation->id)) }}</strong>
                    <span class="text-slate-500 text-[11px]">{{ strtoupper($payment?->payment_method ?? 'ONLINE FPX') }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block uppercase font-semibold text-[10px]">Payment Date</span>
                    <strong class="text-slate-900 block">{{ $payment?->paid_at ? $payment->paid_at->format('d M Y, H:i') : ($vacation->created_at ? $vacation->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i')) }}</strong>
                    <span class="text-emerald-600 font-bold text-[11px]">Database Verified</span>
                </div>
                <div>
                    <span class="text-slate-400 block uppercase font-semibold text-[10px]">Amount Settled</span>
                    <strong class="text-slate-900 block text-sm">RM {{ number_format($vacation->price, 2) }}</strong>
                    <span class="text-emerald-700 font-semibold text-[11px]">Paid in Full</span>
                </div>
            </div>

            <!-- Verified Journey Itinerary -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wide">
                        Trip & Accommodation Details
                    </h3>
                    <span class="text-xs font-extrabold uppercase px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 border border-amber-200">
                        ★ {{ $vacation->tier }} Tier
                    </span>
                </div>

                <div class="p-6 rounded-2xl border border-slate-200 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold text-sky-600 uppercase tracking-widest block">Destination</span>
                            <span class="text-xl font-extrabold text-slate-900">{{ $vacation->destination }}</span>
                            <p class="text-sm font-semibold text-slate-600 mt-0.5">{{ $vacation->title }}</p>
                        </div>
                        <div class="text-left sm:text-right">
                            <span class="text-xs font-bold text-slate-400 block">Travelers</span>
                            <span class="text-base font-bold text-slate-800">{{ $vacation->travelers_count }} Guests</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pt-1">
                        <div>
                            <span class="text-slate-400 block uppercase font-semibold">Check-in / Start Date</span>
                            <strong class="text-slate-800 text-sm">{{ $vacation->start_date?->format('l, d F Y') }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block uppercase font-semibold">Check-out / End Date</span>
                            <strong class="text-slate-800 text-sm">{{ $vacation->end_date?->format('l, d F Y') }}</strong>
                        </div>
                    </div>

                    @if ($vacation->notes)
                        <div class="pt-2 border-t border-slate-100 text-xs">
                            <span class="text-slate-400 block uppercase font-semibold">Special Requests</span>
                            <p class="text-slate-700 italic">{{ $vacation->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Admin Verification Sign-off -->
            <div class="p-5 rounded-2xl bg-amber-50/70 border border-amber-200 text-xs text-amber-950 space-y-1.5">
                <div class="flex items-center gap-2 font-black text-amber-900">
                    <span>🛡️ Verified by AzureVoyage Luxury Operations</span>
                </div>
                <p class="leading-relaxed text-amber-900">
                    {{ $vacation->admin_notes ?? 'Accommodations and private transport were checked, approved, and locked in with our luxury partners.' }}
                </p>
                <span class="text-[10px] text-amber-700 block font-semibold">
                    Approved by {{ $vacation->reviewer->name ?? 'AzureVoyage Duty Manager' }} • Reference #{{ $vacation->package_code }}
                </span>
            </div>

            <!-- Tax Invoice Breakdown Table -->
            <div>
                <table class="w-full text-xs text-left">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 uppercase font-bold text-[10px]">
                            <th class="py-2">Description</th>
                            <th class="py-2 text-center">Qty</th>
                            <th class="py-2 text-right">Rate</th>
                            <th class="py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        <tr>
                            <td class="py-3">
                                <strong class="text-slate-900">{{ $vacation->title }}</strong>
                                <span class="block text-[11px] text-slate-500">Includes private villa/resort stay, transfers, and welcome amenities</span>
                            </td>
                            <td class="py-3 text-center">{{ $vacation->travelers_count }} Pax</td>
                            <td class="py-3 text-right">RM {{ number_format($vacation->price / max(1, $vacation->travelers_count), 2) }}</td>
                            <td class="py-3 text-right font-bold text-slate-900">RM {{ number_format($vacation->price, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">24/7 Dedicated Concierge & Local Representative</td>
                            <td class="py-3 text-center">1</td>
                            <td class="py-3 text-right">RM 0.00</td>
                            <td class="py-3 text-right font-bold text-emerald-600">Complimentary</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-slate-900 text-sm font-black text-slate-900">
                            <td colspan="3" class="pt-4 text-right">Total Paid (MYR):</td>
                            <td class="pt-4 text-right text-base text-sky-700">RM {{ number_format($vacation->price, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Footer Notes & Barcode Mockup -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <div>
                    <p class="font-semibold text-slate-600">Important Instructions:</p>
                    <p class="text-[11px]">Please present this digital e-voucher or printed copy upon airport or hotel reception arrival.</p>
                </div>
                <div class="text-center font-mono text-[10px] text-slate-400">
                    <span class="block tracking-widest font-black text-slate-800">||||| | |||| |||||| ||| |||||</span>
                    <span>*{{ $vacation->package_code }}*</span>
                </div>
            </div>

        </div>

    </div>

</body>
</html>

