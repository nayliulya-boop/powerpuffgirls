<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Vacation;
use App\Services\VoucherPdfService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CustomerPaymentController extends Controller
{
    /**
     * Display the payment settlement view for an approved vacation booking.
     */
    public function show(Vacation $vacation, Request $request): View|RedirectResponse
    {
        if ($vacation->user_id !== $request->user()->id && ! $request->user()->isAdmin()) {
            abort(403, 'Unauthorized. This booking belongs to another traveler.');
        }

        if ($vacation->isPaid()) {
            return redirect()->route('customer.payment.receipt', $vacation)
                ->with('status', 'This booking has already been settled and confirmed. View your receipt and e-voucher below.');
        }

        if ($vacation->isRejected()) {
            return redirect()->route('customer.dashboard')
                ->with('info', "Booking #{$vacation->package_code} was marked as unavailable. Notes: {$vacation->admin_notes}");
        }

        $banks = [
            'Maybank2u' => 'Maybank (Malayan Banking Berhad)',
            'CIMB Clicks' => 'CIMB Bank Berhad',
            'Public Bank' => 'Public Bank Online',
            'RHB Now' => 'RHB Bank Berhad',
            'Hong Leong' => 'Hong Leong Connect',
            'Bank Islam' => 'Bank Islam Internet Banking',
            'AmBank' => 'AmOnline (AmBank)',
            'Affin Bank' => 'AffinAlways',
            'Alliance Bank' => 'Alliance Online',
            'BSN' => 'myBSN (Bank Simpanan Nasional)',
        ];

        return view('customer.payment', [
            'vacation' => $vacation,
            'user' => $request->user(),
            'banks' => $banks,
        ]);
    }

    /**
     * Process and record the payment transaction for the vacation.
     */
    public function process(Vacation $vacation, Request $request): RedirectResponse
    {
        if ($vacation->user_id !== $request->user()->id && ! $request->user()->isAdmin()) {
            abort(403, 'Unauthorized. This booking belongs to another traveler.');
        }

        if ($vacation->isPaid()) {
            return redirect()->route('customer.payment.receipt', $vacation);
        }

        if ($vacation->isRejected()) {
            return redirect()->route('customer.dashboard')
                ->with('info', 'Payment cannot be processed because this booking was marked as unavailable.');
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'string', 'in:fpx,card,qr'],
            'bank_name' => ['required_if:payment_method,fpx', 'nullable', 'string', 'max:100'],
            'card_name' => ['required_if:payment_method,card', 'nullable', 'string', 'max:255'],
            'card_number' => ['required_if:payment_method,card', 'nullable', 'string', 'min:12', 'max:20'],
            'card_expiry' => ['required_if:payment_method,card', 'nullable', 'string', 'max:10'],
            'card_cvv' => ['required_if:payment_method,card', 'nullable', 'string', 'min:3', 'max:4'],
            'qr_reference' => ['nullable', 'string', 'max:100'],
        ]);

        $cardLastFour = null;
        if ($validated['payment_method'] === 'card' && ! empty($validated['card_number'])) {
            $digitsOnly = preg_replace('/[^0-9]/', '', $validated['card_number']);
            $cardLastFour = substr($digitsOnly, -4);
        }

        $txnReference = 'AV-TXN-'.now()->format('Ymd').'-'.strtoupper(Str::random(6));

        DB::transaction(function () use ($vacation, $request, $validated, $cardLastFour, $txnReference): void {
            Payment::create([
                'vacation_id' => $vacation->id,
                'user_id' => $request->user()->id,
                'amount' => $vacation->price,
                'payment_method' => $validated['payment_method'],
                'bank_name' => $validated['bank_name'] ?? ($validated['payment_method'] === 'qr' ? 'DuitNow QR' : null),
                'card_last_four' => $cardLastFour,
                'transaction_reference' => $txnReference,
                'status' => 'completed',
                'notes' => 'Settlement processed successfully for '.$vacation->title,
                'paid_at' => now(),
            ]);

            $vacation->update([
                'payment_status' => 'paid',
                'status' => 'upcoming',
            ]);
        });

        return redirect()->route('customer.payment.receipt', $vacation)
            ->with('status', '🎉 Payment of RM '.number_format($vacation->price, 2).' successfully processed! Your luxury vacation is now 100% confirmed.');
    }

    /**
     * Display the official payment receipt and confirmed E-Voucher.
     */
    public function receipt(Vacation $vacation, Request $request): View
    {
        if ($vacation->user_id !== $request->user()->id && ! $request->user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $vacation->load(['user', 'latestPayment', 'reviewer']);

        return view('customer.receipt', [
            'vacation' => $vacation,
            'payment' => $vacation->latestPayment,
            'user' => $vacation->user,
        ]);
    }

    /**
     * Generate official E-Voucher and payment receipt PDF via TCPDF.
     */
    public function pdf(Vacation $vacation, Request $request, VoucherPdfService $pdfService): Response
    {
        if ($vacation->user_id !== $request->user()->id && ! $request->user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $mode = 'stream';
        if ($request->has('download')) {
            $mode = 'download';
        } elseif ($request->has('print')) {
            $mode = 'print';
        } elseif ($request->filled('mode')) {
            $mode = (string) $request->input('mode');
        }

        return $pdfService->render($vacation, $mode);
    }
}
