<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Show the booking form for a specific package.
     */
    public function create(Request $request, string $slug): View
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        $initialAdults = max(1, (int) $request->get('adults', 1));
        $initialChildren = max(0, (int) $request->get('children', 0));
        $initialDate = $request->get('date', now()->addDays(7)->format('Y-m-d'));

        return view('booking.create', [
            'package' => $package,
            'initialAdults' => $initialAdults,
            'initialChildren' => $initialChildren,
            'initialDate' => $initialDate,
        ]);
    }

    /**
     * Store the booking and proceed to payment.
     */
    public function store(Request $request, string $slug): RedirectResponse
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'trip_date' => ['required', 'date', 'after_or_equal:today'],
            'adult_count' => ['required', 'integer', 'min:1', 'max:50'],
            'child_count' => ['nullable', 'integer', 'min:0', 'max:50'],
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'special_notes' => ['nullable', 'string', 'max:1000'],
            'participants' => ['nullable', 'array'],
            'participants.*.name' => ['nullable', 'string', 'max:255'],
            'participants.*.ic_passport' => ['nullable', 'string', 'max:50'],
            'participants.*.phone' => ['nullable', 'string', 'max:50'],
            'participants.*.type' => ['nullable', 'string', 'in:Dewasa,Kanak-kanak'],
        ]);

        $adultCount = (int) $validated['adult_count'];
        $childCount = (int) ($validated['child_count'] ?? 0);

        $totalPrice = ($adultCount * (float) $package->price_adult) +
                      ($childCount * (float) $package->price_child);

        // Filter valid participants
        $participants = [];
        if (! empty($validated['participants'])) {
            foreach ($validated['participants'] as $p) {
                if (! empty($p['name'])) {
                    $participants[] = [
                        'name' => $p['name'],
                        'ic_passport' => $p['ic_passport'] ?? '-',
                        'phone' => $p['phone'] ?? '-',
                        'type' => $p['type'] ?? 'Dewasa',
                    ];
                }
            }
        }

        // If participants array was empty or fewer than adults, ensure at least primary contact is in
        if (empty($participants)) {
            $participants[] = [
                'name' => $validated['contact_name'],
                'ic_passport' => 'Utama / Primary',
                'phone' => $validated['contact_phone'],
                'type' => 'Dewasa',
            ];
        }

        // Generate unique booking code
        do {
            $bookingCode = 'AZV-'.date('Y').'-'.strtoupper(Str::random(6));
        } while (Booking::where('booking_code', $bookingCode)->exists());

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'user_id' => Auth::id(),
            'package_id' => $package->id,
            'trip_date' => $validated['trip_date'],
            'adult_count' => $adultCount,
            'child_count' => $childCount,
            'total_price' => $totalPrice,
            'contact_name' => $validated['contact_name'],
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'participants' => $participants,
            'special_notes' => $validated['special_notes'] ?? null,
            'payment_method' => 'pending',
            'payment_status' => 'pending',
            'status' => 'Pending',
        ]);

        return redirect()->route('booking.payment', $booking->booking_code)
            ->with('success', 'Tempahan anda berjaya dibuat! Sila lengkapkan pembayaran di bawah.');
    }

    /**
     * Show payment page (Gateway simulation ToyyibPay / Stripe / Billplz OR manual receipt upload).
     */
    public function payment(string $bookingCode): View
    {
        $booking = Booking::with('package')->where('booking_code', $bookingCode)->firstOrFail();

        return view('booking.payment', [
            'booking' => $booking,
            'package' => $booking->package,
        ]);
    }

    /**
     * Process payment submission (Online Gateway or Manual Slip Upload).
     */
    public function processPayment(Request $request, string $bookingCode): RedirectResponse
    {
        $booking = Booking::where('booking_code', $bookingCode)->firstOrFail();

        $validated = $request->validate([
            'payment_type' => ['required', 'string', 'in:gateway,manual'],
            'gateway_provider' => ['nullable', 'string', 'in:toyyibpay,billplz,stripe'],
            'receipt_file' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:5120'], // max 5MB
            'reference_no' => ['nullable', 'string', 'max:100'],
        ]);

        if ($validated['payment_type'] === 'gateway') {
            $provider = $validated['gateway_provider'] ?? 'toyyibpay';

            // Simulate instant successful payment gateway response
            $booking->update([
                'payment_method' => $provider,
                'payment_status' => 'paid',
                'status' => 'Confirmed',
            ]);

            return redirect()->route('booking.voucher', $booking->booking_code)
                ->with('success', 'Pembayaran via '.strtoupper($provider).' berjaya! Tempahan anda telah disahkan (Confirmed).');
        }

        // Manual Bank Transfer Receipt Upload
        if ($request->hasFile('receipt_file')) {
            $file = $request->file('receipt_file');
            $filename = 'receipt_'.$booking->booking_code.'_'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('receipts', $filename, 'public');

            $booking->update([
                'payment_method' => 'manual_receipt',
                'payment_status' => 'pending_verification',
                'payment_receipt' => $path,
                'status' => 'Pending',
            ]);

            return redirect()->route('booking.voucher', $booking->booking_code)
                ->with('success', 'Slip pemindahan bank berjaya dimuat naik! Tempahan kini dalam status Pengesahan (Pending). Sila muat turun baucar rujukan anda.');
        }

        return back()->withErrors(['receipt_file' => 'Sila muat naik fail slip pembayaran yang sah (PDF/JPG/PNG).']);
    }

    /**
     * Show booking ticket voucher / confirmation receipt (Printable PDF ready).
     */
    public function voucher(string $bookingCode): View
    {
        $booking = Booking::with('package')->where('booking_code', $bookingCode)->firstOrFail();

        return view('booking.voucher', [
            'booking' => $booking,
            'package' => $booking->package,
        ]);
    }
}
