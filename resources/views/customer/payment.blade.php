<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure Booking Settlement | AzureVoyage Luxury Travel Agency</title>

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
            background-image:
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(56, 189, 248, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(224, 242, 254, 0.4) 0px, transparent 50%);
        }
        h1, h2, h3, h4, .brand-font {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(224, 242, 254, 0.9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-sky-500 selection:text-white">

    <!-- Top VIP Notification Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white text-xs sm:text-sm py-2.5 px-4 shadow-sm border-b border-sky-900/40">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-400 text-slate-900 shadow-sm">
                    🔒 256-bit SSL Secure Checkout
                </span>
                <span class="text-slate-200">
                    Payment Settlement for Package: <strong class="text-white">#{{ $vacation->package_code }}</strong>
                </span>
            </div>
            <div class="hidden md:flex items-center gap-6 text-xs text-sky-200">
                <span>24/7 Concierge: <strong>+1 (800) 429-8732</strong></span>
                <span>IATA & ATOL Protected</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 glass-nav shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-sky-600 via-blue-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/25 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                            <polygon points="12 4 15 12 12 20 9 12" fill="currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center whitespace-nowrap">
                            Azure<span class="text-sky-600">Voyage</span>
                        </span>
                        <span class="block text-[10px] uppercase tracking-widest font-bold text-sky-600 -mt-1">
                            Secure Settlement Gateway
                        </span>
                    </div>
                </a>

                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                        <a href="{{ route('customer.dashboard') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('customer.history') }}" class="hover:text-sky-600 transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            History
                        </a>
                    </nav>

                    <!-- Back link -->
                    <a href="{{ route('customer.dashboard') }}" class="text-xs sm:text-sm font-bold text-slate-600 hover:text-sky-600 flex items-center gap-1.5 transition">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full space-y-8">

        <!-- Flow Progress Indicator -->
        <div class="glass-card rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-center text-xs font-bold">
                <!-- Step 1 -->
                <div class="flex items-center gap-3 text-emerald-700 bg-emerald-50 sm:bg-transparent p-2 sm:p-0 rounded-xl justify-center sm:justify-start">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-black">✓</div>
                    <div class="text-left">
                        <span class="block text-[10px] uppercase text-emerald-600">Step 1</span>
                        <span>Booking Requested</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex items-center gap-3 text-emerald-700 bg-emerald-50 sm:bg-transparent p-2 sm:p-0 rounded-xl justify-center sm:justify-start">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-black">✓</div>
                    <div class="text-left">
                        <span class="block text-[10px] uppercase text-emerald-600">Step 2</span>
                        <span>Admin Verified Availability</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex items-center gap-3 text-sky-700 bg-sky-50 sm:bg-transparent p-2 sm:p-0 rounded-xl justify-center sm:justify-start border-2 border-sky-400 sm:border-0">
                    <div class="w-8 h-8 rounded-full bg-sky-600 text-white flex items-center justify-center font-black animate-pulse">3</div>
                    <div class="text-left">
                        <span class="block text-[10px] uppercase text-sky-600 font-extrabold">Step 3 (Active)</span>
                        <span class="font-extrabold text-slate-900">Payment Settlement</span>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex items-center gap-3 text-slate-400 p-2 sm:p-0 rounded-xl justify-center sm:justify-start">
                    <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-black">4</div>
                    <div class="text-left">
                        <span class="block text-[10px] uppercase text-slate-400">Step 4</span>
                        <span>Confirmed E-Voucher</span>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded-2xl p-4 bg-rose-50 border border-rose-200 text-rose-900 text-sm font-semibold">
                <strong class="block mb-1">Please correct the highlighted inputs:</strong>
                <ul class="list-disc list-inside space-y-0.5 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- Left Column: Payment Form -->
            <div class="lg:col-span-7 space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200">
                    <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Select Payment Method</h2>
                    <p class="text-slate-500 text-xs sm:text-sm mb-6">
                        Complete your payment via online banking (FPX), major cards, or DuitNow QR. Live database synchronization via phpMyAdmin.
                    </p>

                    <form method="POST" action="{{ route('customer.payment.process', $vacation) }}" id="paymentForm" class="space-y-6">
                        @csrf

                        <!-- Method Select Tabs -->
                        <div class="grid grid-cols-3 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="fpx" checked class="peer sr-only" onchange="togglePaymentSection('fpx')">
                                <div class="p-3.5 rounded-2xl border-2 border-slate-200 peer-checked:border-sky-600 peer-checked:bg-sky-50/50 text-center transition flex flex-col items-center justify-center gap-1.5 h-full">
                                    <span class="text-2xl">🏦</span>
                                    <span class="text-xs font-bold text-slate-800">Online Banking</span>
                                    <span class="text-[10px] font-semibold text-slate-400 uppercase">FPX Malaysia</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="card" class="peer sr-only" onchange="togglePaymentSection('card')">
                                <div class="p-3.5 rounded-2xl border-2 border-slate-200 peer-checked:border-sky-600 peer-checked:bg-sky-50/50 text-center transition flex flex-col items-center justify-center gap-1.5 h-full">
                                    <span class="text-2xl">💳</span>
                                    <span class="text-xs font-bold text-slate-800">Credit / Debit</span>
                                    <span class="text-[10px] font-semibold text-slate-400 uppercase">Visa / Master</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="qr" class="peer sr-only" onchange="togglePaymentSection('qr')">
                                <div class="p-3.5 rounded-2xl border-2 border-slate-200 peer-checked:border-sky-600 peer-checked:bg-sky-50/50 text-center transition flex flex-col items-center justify-center gap-1.5 h-full">
                                    <span class="text-2xl">📱</span>
                                    <span class="text-xs font-bold text-slate-800">DuitNow QR</span>
                                    <span class="text-[10px] font-semibold text-slate-400 uppercase">Instant Pay</span>
                                </div>
                            </label>
                        </div>

                        <!-- 1. FPX Online Banking Fields -->
                        <div id="section-fpx" class="space-y-4 pt-2">
                            <div>
                                <label for="bank_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Choose Your Bank (FPX Online Banking)
                                </label>
                                <select
                                    id="bank_name"
                                    name="bank_name"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-300 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                >
                                    @foreach ($banks as $code => $label)
                                        <option value="{{ $code }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-3.5 rounded-xl bg-sky-50 border border-sky-100 text-xs text-sky-800 leading-relaxed">
                                ℹ️ You will be redirected to your simulated secure online bank portal. Transaction will be recorded immediately into the AzureVoyage database.
                            </div>
                        </div>

                        <!-- 2. Credit/Debit Card Fields -->
                        <div id="section-card" class="space-y-4 pt-2 hidden">
                            <div>
                                <label for="card_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Cardholder Full Name
                                </label>
                                <input
                                    type="text"
                                    id="card_name"
                                    name="card_name"
                                    value="{{ old('card_name', $user->name) }}"
                                    placeholder="e.g. Johnathan Doe"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-300 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                >
                            </div>

                            <div>
                                <label for="card_number" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Card Number
                                </label>
                                <input
                                    type="text"
                                    id="card_number"
                                    name="card_number"
                                    placeholder="4111 2222 3333 4444"
                                    maxlength="19"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-300 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                >
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="card_expiry" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Expiry Date (MM/YY)
                                    </label>
                                    <input
                                        type="text"
                                        id="card_expiry"
                                        name="card_expiry"
                                        placeholder="12/28"
                                        maxlength="5"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-300 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                    >
                                </div>
                                <div>
                                    <label for="card_cvv" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Security Code (CVV)
                                    </label>
                                    <input
                                        type="password"
                                        id="card_cvv"
                                        name="card_cvv"
                                        placeholder="•••"
                                        maxlength="4"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-300 text-sm font-semibold text-slate-900 focus:outline-none focus:border-sky-600 focus:bg-white transition"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- 3. DuitNow QR Fields -->
                        <div id="section-qr" class="space-y-4 pt-2 hidden text-center">
                            <div class="p-6 rounded-2xl bg-white border border-slate-200 inline-block shadow-sm">
                                <div class="w-48 h-48 mx-auto bg-slate-900 rounded-xl flex flex-col items-center justify-center text-white p-3 space-y-2">
                                    <!-- QR Code Graphic Mockup -->
                                    <svg class="w-24 h-24 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M2 2h8v8H2V2zm2 2v4h4V4H4zm10-2h8v8h-8V2zm2 2v4h4V4h-4zM2 14h8v8H2v-8zm2 2v4h4v-4H4zm14-2h4v4h-4v-4zm-4 4h4v4h-4v-4zm4 0h4v4h-4v-4zm-4-4h4v4h-4v-4z"/>
                                    </svg>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-300">DuitNow QR</span>
                                    <span class="text-[9px] font-mono text-amber-300">AZUREVOYAGE-PAY</span>
                                </div>
                                <span class="block text-xs font-bold text-slate-700 mt-3">Scan with any Malaysian Banking App</span>
                            </div>
                            <p class="text-xs text-slate-500">
                                Scan the QR code above or proceed to simulate instant instant settlement.
                            </p>
                        </div>

                        <!-- Terms Agreement Checkbox -->
                        <div class="pt-2">
                            <label class="flex items-start gap-2.5 text-xs text-slate-600 font-semibold cursor-pointer">
                                <input type="checkbox" required checked class="mt-0.5 rounded text-sky-600 focus:ring-sky-500">
                                <span>I agree to the AzureVoyage luxury travel terms, VIP concierge booking conditions, and ATOL travel protection guarantees.</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            id="payButton"
                            class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-sky-600 via-blue-600 to-sky-700 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-base shadow-lg shadow-sky-600/30 hover:scale-[1.01] active:scale-[0.99] transition flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span>Pay RM {{ number_format($vacation->price, 2) }} & Confirm Booking</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Booking Summary & Price Breakdown -->
            <div class="lg:col-span-5 space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200">
                    <span class="text-xs font-bold text-sky-600 uppercase tracking-widest block mb-1">
                        Package Verification Summary
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-900 leading-snug">
                        {{ $vacation->title }}
                    </h3>

                    <!-- Image & Badge -->
                    <div class="h-44 rounded-2xl overflow-hidden my-4 relative shadow-inner bg-slate-100">
                        <img
                            src="{{ $vacation->image_url ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $vacation->destination }}"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute top-3 left-3 bg-slate-950/80 backdrop-blur-md px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase text-amber-300">
                            ★ {{ $vacation->tier }}
                        </div>
                        <div class="absolute bottom-3 left-3 right-3 bg-slate-950/80 backdrop-blur-md p-2 rounded-lg text-white text-xs font-bold flex items-center justify-between">
                            <span>#{{ $vacation->package_code }}</span>
                            <span>{{ $vacation->travelers_count }} Guests</span>
                        </div>
                    </div>

                    <!-- Admin Approval Status Highlight -->
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-900 space-y-1 mb-6">
                        <div class="flex items-center gap-1.5 font-extrabold text-emerald-800">
                            <span>✓ Availability Verified by Admin</span>
                        </div>
                        <p class="leading-relaxed">
                            {{ $vacation->admin_notes ?? 'Accommodations and private itinerary slots are confirmed available for your chosen dates.' }}
                        </p>
                    </div>

                    <!-- Details List -->
                    <div class="space-y-3 text-xs border-t border-slate-100 pt-4">
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Destination</span>
                            <span class="font-bold text-slate-900 text-right">{{ $vacation->destination }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Travel Dates</span>
                            <span class="font-bold text-slate-900">{{ $vacation->start_date?->format('d M Y') }} - {{ $vacation->end_date?->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Primary Traveler</span>
                            <span class="font-bold text-slate-900">{{ $user->name }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Guest Travelers</span>
                            <span class="font-bold text-slate-900">{{ $vacation->travelers_count }} Persons</span>
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-t border-slate-200 mt-6 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between text-slate-600 text-xs">
                            <span>Bespoke Itinerary & Luxury Suite</span>
                            <span class="font-bold text-slate-900">RM {{ number_format($vacation->price, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600 text-xs">
                            <span>24/7 Dedicated Concierge Fee</span>
                            <span class="font-bold text-emerald-600">FREE (Waived)</span>
                        </div>
                        <div class="flex justify-between text-slate-600 text-xs">
                            <span>ATOL & Insolvency Insurance</span>
                            <span class="font-bold text-emerald-600">Included</span>
                        </div>

                        <div class="border-t border-slate-200 pt-3 flex justify-between items-baseline">
                            <span class="font-black text-slate-900 text-base">Total Settlement</span>
                            <span class="font-black text-2xl text-sky-700">RM {{ number_format($vacation->price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="p-4 rounded-2xl bg-white border border-slate-200 text-center space-y-2">
                    <div class="flex items-center justify-center gap-4 text-xs font-bold text-slate-500">
                        <span>🛡️ PCI-DSS Compliant</span>
                        <span>•</span>
                        <span>🔒 TLS 1.3 Encrypted</span>
                        <span>•</span>
                        <span>✈️ ATOL Protected</span>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="mt-12 bg-slate-900 text-slate-400 py-8 border-t border-slate-800 text-xs text-center">
        <div class="max-w-7xl mx-auto px-4">
            <p>© 2026 AzureVoyage Luxury Travel Agency. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function togglePaymentSection(type) {
            document.getElementById('section-fpx').classList.add('hidden');
            document.getElementById('section-card').classList.add('hidden');
            document.getElementById('section-qr').classList.add('hidden');

            const target = document.getElementById('section-' + type);
            if (target) {
                target.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>

