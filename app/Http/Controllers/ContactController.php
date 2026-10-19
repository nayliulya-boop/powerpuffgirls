<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show Contact Us page with Inquiry form and Customer Reviews / Testimonials.
     */
    public function index(): View
    {
        $reviews = Review::with('package')
            ->where('is_approved', true)
            ->latest()
            ->paginate(6);

        $packages = Package::orderBy('title')->get();

        return view('contact', [
            'reviews' => $reviews,
            'packages' => $packages,
        ]);
    }

    /**
     * Store a new customer inquiry.
     */
    public function storeInquiry(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Inquiry::create($validated);

        return back()->with('inquiry_success', 'Terima kasih! Pertanyaan anda telah diterima. Pegawai AzureVoyage akan menghubungi anda dalam masa 24 jam.');
    }

    /**
     * Store customer review/testimonial after trip.
     */
    public function storeReview(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'author_name' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'trip_category' => ['nullable', 'string', 'max:100'],
            'package_id' => ['nullable', 'exists:packages,id'],
            'review_text' => ['required', 'string', 'max:1000'],
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'author_name' => $validated['author_name'],
            'rating' => (int) $validated['rating'],
            'trip_category' => $validated['trip_category'] ?? null,
            'package_id' => $validated['package_id'] ?? null,
            'review_text' => $validated['review_text'],
            'is_approved' => true,
        ]);

        return back()->with('review_success', 'Terima kasih atas perkongsian ulasan & testimoni anda! Kami amat menghargai sokongan anda.');
    }
}

