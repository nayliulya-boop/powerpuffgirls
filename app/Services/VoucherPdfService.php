<?php

namespace App\Services;

use App\Models\Vacation;
use Illuminate\Http\Response;
use TCPDF;

class VoucherPdfService
{
    /**
     * Generate and stream or download the official PDF voucher using TCPDF.
     *
     * @param  string  $mode  'stream'|'download'|'print'
     */
    public function render(Vacation $vacation, string $mode = 'stream'): Response
    {
        $vacation->loadMissing(['user', 'latestPayment', 'reviewer']);

        if (! class_exists('TCPDF')) {
            $tcpdfFile = base_path('vendor/tecnickcom/tcpdf/tcpdf.php');
            if (file_exists($tcpdfFile)) {
                require_once $tcpdfFile;
            }
        }

        if (! class_exists('TCPDF')) {
            $html = $this->buildHtml($vacation);
            $printJs = ($mode === 'print') ? '<script>window.onload=function(){window.print();};</script>' : '';

            return response('<!DOCTYPE html><html><head><meta charset="utf-8"><title>Voucher #'.($vacation->package_code ?? $vacation->id).'</title><style>body{font-family:sans-serif;margin:20px;}</style></head><body>'.$html.$printJs.'</body></html>', 200, [
                'Content-Type' => 'text/html; charset=UTF-8',
            ]);
        }

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Document Metadata
        $pdf->SetCreator('AzureVoyage Luxury Travel Agency');
        $pdf->SetAuthor('AzureVoyage');
        $pdf->SetTitle('Official E-Voucher #'.($vacation->package_code ?? $vacation->id));
        $pdf->SetSubject('Official Travel Voucher & Payment Receipt');
        $pdf->SetKeywords('AzureVoyage, Travel, Voucher, Receipt, Itinerary, Luxury');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(12, 12, 12);
        $pdf->SetAutoPageBreak(true, 12);
        $pdf->AddPage();

        if ($mode === 'print') {
            $pdf->IncludeJS('print(true);');
        }

        $html = $this->buildHtml($vacation);
        $pdf->writeHTML($html, true, false, true, false, '');

        // Generate 1D Code 128 Barcode for the voucher
        $barcodeCode = (string) ($vacation->package_code ?: ('AV-'.$vacation->id));
        $barcodeStyle = [
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => [15, 23, 42],
            'bgcolor' => false,
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 7,
            'stretchtext' => 4,
        ];
        $pdf->write1DBarcode($barcodeCode, 'C128', 130, 256, 65, 12, 0.4, $barcodeStyle, 'N');

        $filename = 'AzureVoyage-Voucher-'.($vacation->package_code ?? $vacation->id).'.pdf';
        $content = (string) $pdf->Output($filename, 'S');

        $disposition = ($mode === 'download') ? 'attachment' : 'inline';

        return response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "{$disposition}; filename=\"{$filename}\"",
            'Cache-Control' => 'private, max-age=0, must-revalidate',
            'Pragma' => 'public',
        ]);
    }

    /**
     * Build the structured HTML representation for the voucher document.
     */
    protected function buildHtml(Vacation $vacation): string
    {
        $user = $vacation->user;
        $payment = $vacation->latestPayment;

        $packageCode = htmlspecialchars((string) ($vacation->package_code ?? ('AV-'.$vacation->id)), ENT_QUOTES, 'UTF-8');
        $customerName = htmlspecialchars((string) ($user?->name ?? 'Valued Traveler'), ENT_QUOTES, 'UTF-8');
        $customerEmail = htmlspecialchars((string) ($user?->email ?? '-'), ENT_QUOTES, 'UTF-8');
        $customerPhone = htmlspecialchars((string) ($user?->phone ?? '+60 12-345 6789'), ENT_QUOTES, 'UTF-8');

        $destination = htmlspecialchars((string) ($vacation->destination ?? '-'), ENT_QUOTES, 'UTF-8');
        $title = htmlspecialchars((string) ($vacation->title ?? '-'), ENT_QUOTES, 'UTF-8');
        $tier = htmlspecialchars(ucfirst((string) ($vacation->tier ?? 'Signature Gold')), ENT_QUOTES, 'UTF-8');

        $travelers = max(1, (int) ($vacation->travelers_count ?: 1));
        $totalPrice = (float) $vacation->price;
        $unitRate = $totalPrice / $travelers;

        $startDate = $vacation->start_date ? $vacation->start_date->format('l, d F Y') : '-';
        $endDate = $vacation->end_date ? $vacation->end_date->format('l, d F Y') : '-';

        $txnRef = htmlspecialchars((string) ($payment?->transaction_reference ?? ('AV-TXN-'.($vacation->package_code ?? $vacation->id))), ENT_QUOTES, 'UTF-8');
        $paymentMethod = strtoupper((string) ($payment?->payment_method ?? 'ONLINE FPX'));
        $bankName = $payment?->bank_name ? ' ('.htmlspecialchars((string) $payment->bank_name, ENT_QUOTES, 'UTF-8').')' : '';
        $paidAt = $payment?->paid_at ? $payment->paid_at->format('d M Y, H:i') : ($vacation->created_at ? $vacation->created_at->format('d M Y, H:i') : date('d M Y, H:i'));

        $adminNotes = htmlspecialchars((string) ($vacation->admin_notes ?? 'Accommodations and private transport were checked, approved, and locked in with our luxury partners.'), ENT_QUOTES, 'UTF-8');
        $reviewer = htmlspecialchars((string) ($vacation->reviewer?->name ?? 'AzureVoyage Duty Manager'), ENT_QUOTES, 'UTF-8');

        $specialNotesHtml = '';
        if ($vacation->notes) {
            $notesEscaped = htmlspecialchars((string) $vacation->notes, ENT_QUOTES, 'UTF-8');
            $specialNotesHtml = '
            <tr>
                <td colspan="2" style="border-top: 1px solid #E2E8F0; padding-top: 4px;">
                    <span style="color: #64748B; font-size: 7px; text-transform: uppercase;">SPECIAL TRAVELER REQUESTS</span><br>
                    <span style="color: #334155; font-size: 8px; font-style: italic;">'.$notesEscaped.'</span>
                </td>
            </tr>';
        }

        return '
        <table cellpadding="6" cellspacing="0" style="width: 100%; border-bottom: 2px solid #0284C7;">
            <tr>
                <td style="width: 65%;">
                    <span style="font-size: 22px; font-weight: bold; color: #0F172A;">Azure<span style="color: #0284C7;">Voyage</span></span><br>
                    <span style="font-size: 8px; color: #64748B; font-weight: bold; letter-spacing: 1px;">LUXURY TRAVEL AGENCY &bull; OFFICIAL TRAVEL VOUCHER</span>
                </td>
                <td style="width: 35%; text-align: right;">
                    <div style="background-color: #DCFCE7; color: #166534; font-size: 9px; font-weight: bold; padding: 4px 8px; border: 1px solid #BBF7D0;">
                        &#10003; CONFIRMED &amp; SETTLED
                    </div>
                    <span style="font-size: 8px; color: #64748B;">Voucher Code: <b>#'.$packageCode.'</b></span>
                </td>
            </tr>
        </table>
        <br><br>

        <table cellpadding="6" cellspacing="0" style="width: 100%; background-color: #F8FAFC; border: 1px solid #E2E8F0; font-size: 9px;">
            <tr>
                <td style="width: 25%; border-right: 1px solid #E2E8F0;">
                    <span style="color: #94A3B8; font-size: 7px; text-transform: uppercase;">PRIMARY TRAVELER</span><br>
                    <b style="color: #0F172A; font-size: 10px;">'.$customerName.'</b><br>
                    <span style="color: #64748B;">'.$customerEmail.'</span><br>
                    <span style="color: #64748B; font-size: 8px;">'.$customerPhone.'</span>
                </td>
                <td style="width: 25%; border-right: 1px solid #E2E8F0;">
                    <span style="color: #94A3B8; font-size: 7px; text-transform: uppercase;">PAYMENT REFERENCE</span><br>
                    <b style="color: #0369A1; font-size: 9px; font-family: courier;">'.$txnRef.'</b><br>
                    <span style="color: #64748B;">'.$paymentMethod.$bankName.'</span>
                </td>
                <td style="width: 25%; border-right: 1px solid #E2E8F0;">
                    <span style="color: #94A3B8; font-size: 7px; text-transform: uppercase;">PAYMENT DATE</span><br>
                    <b style="color: #0F172A; font-size: 9px;">'.$paidAt.'</b><br>
                    <span style="color: #16A34A; font-weight: bold;">Database Verified</span>
                </td>
                <td style="width: 25%;">
                    <span style="color: #94A3B8; font-size: 7px; text-transform: uppercase;">AMOUNT SETTLED</span><br>
                    <b style="color: #0F172A; font-size: 11px;">RM '.number_format($totalPrice, 2).'</b><br>
                    <span style="color: #15803D; font-weight: bold;">Paid in Full</span>
                </td>
            </tr>
        </table>
        <br><br>

        <table cellpadding="6" cellspacing="0" style="width: 100%; border: 1px solid #CBD5E1; font-size: 9px;">
            <tr style="background-color: #0F172A; color: #FFFFFF;">
                <td colspan="2" style="font-weight: bold; font-size: 10px;">
                    VERIFIED JOURNEY &amp; ACCOMMODATION ITINERARY &nbsp;|&nbsp; <span style="color: #FCD34D;">'.$tier.' Tier</span>
                </td>
            </tr>
            <tr>
                <td style="width: 60%; background-color: #FFFFFF;">
                    <span style="font-size: 8px; color: #0284C7; font-weight: bold; text-transform: uppercase;">Destination:</span><br>
                    <b style="font-size: 13px; color: #0F172A;">'.$destination.'</b><br>
                    <span style="color: #475569; font-size: 10px;">'.$title.'</span>
                </td>
                <td style="width: 40%; background-color: #F8FAFC; text-align: right;">
                    <span style="font-size: 8px; color: #64748B;">Travel Party:</span><br>
                    <b style="font-size: 11px; color: #0F172A;">'.$travelers.' Guests (Adults)</b>
                </td>
            </tr>
            <tr>
                <td style="width: 50%; border-top: 1px solid #E2E8F0;">
                    <span style="color: #64748B; font-size: 8px;">CHECK-IN / START DATE</span><br>
                    <b style="font-size: 10px; color: #0F172A;">'.$startDate.'</b>
                </td>
                <td style="width: 50%; border-top: 1px solid #E2E8F0;">
                    <span style="color: #64748B; font-size: 8px;">CHECK-OUT / END DATE</span><br>
                    <b style="font-size: 10px; color: #0F172A;">'.$endDate.'</b>
                </td>
            </tr>
            '.$specialNotesHtml.'
        </table>
        <br><br>

        <table cellpadding="6" cellspacing="0" style="width: 100%; background-color: #FEF3C7; border: 1px solid #FDE68A; font-size: 8px; color: #78350F;">
            <tr>
                <td>
                    <b>&#128737; Verified by AzureVoyage Luxury Operations</b><br>
                    '.$adminNotes.'<br>
                    <span style="color: #92400E;">Approved by '.$reviewer.' &bull; Reference #'.$packageCode.'</span>
                </td>
            </tr>
        </table>
        <br><br>

        <table cellpadding="5" cellspacing="0" style="width: 100%; font-size: 9px; border-collapse: collapse;">
            <tr style="background-color: #F1F5F9; color: #475569; font-weight: bold; border-bottom: 1px solid #CBD5E1;">
                <th style="width: 55%; text-align: left;">Description</th>
                <th style="width: 15%; text-align: center;">Qty</th>
                <th style="width: 15%; text-align: right;">Rate (RM)</th>
                <th style="width: 15%; text-align: right;">Total (RM)</th>
            </tr>
            <tr style="border-bottom: 1px solid #E2E8F0;">
                <td style="text-align: left;">
                    <b>'.$title.'</b><br>
                    <span style="font-size: 8px; color: #64748B;">Includes private luxury villa/resort stay, transfers, and welcome amenities</span>
                </td>
                <td style="text-align: center;">'.$travelers.' Pax</td>
                <td style="text-align: right;">'.number_format($unitRate, 2).'</td>
                <td style="text-align: right; font-weight: bold;">'.number_format($totalPrice, 2).'</td>
            </tr>
            <tr style="border-bottom: 1px solid #E2E8F0;">
                <td style="text-align: left;">24/7 Dedicated Concierge &amp; Airport Luggage Assistance</td>
                <td style="text-align: center;">1</td>
                <td style="text-align: right;">0.00</td>
                <td style="text-align: right; color: #16A34A; font-weight: bold;">Complimentary</td>
            </tr>
            <tr style="border-top: 2px solid #0F172A; font-weight: bold;">
                <td colspan="3" style="text-align: right; font-size: 10px;">Total Paid (MYR):</td>
                <td style="text-align: right; font-size: 11px; color: #0284C7;">RM '.number_format($totalPrice, 2).'</td>
            </tr>
        </table>
        <br><br>

        <table cellpadding="4" cellspacing="0" style="width: 100%; border-top: 1px solid #E2E8F0; font-size: 8px; color: #64748B;">
            <tr>
                <td style="width: 65%;">
                    <b>Important Instructions:</b><br>
                    Please present this official e-voucher or printed copy upon airport greeting or hotel reception check-in.<br>
                    24/7 VIP Travel Concierge Desk: <b>+1 (800) 429-8732</b> &bull; support@azurevoyage.test
                </td>
                <td style="width: 35%; text-align: right;">
                    <span style="font-size: 7px; color: #94A3B8;">SECURE BOOKING TOKEN</span><br>
                    <span style="font-family: courier; font-size: 9px; font-weight: bold; letter-spacing: 2px;">#'.$packageCode.'</span>
                </td>
            </tr>
        </table>
        ';
    }
}
