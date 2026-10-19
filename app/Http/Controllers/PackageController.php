<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    /**
     * Display the catalog of travel packages with search and category filters.
     */
    public function index(Request $request): View
    {
        $query = Package::query();

        // Filter by Category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter by Search Keyword (Title, Destination, Description)
        if ($request->filled('q')) {
            $searchTerm = '%'.$request->q.'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                    ->orWhere('destination', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        }

        // Filter by Destination
        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%'.$request->destination.'%');
        }

        // Filter by Budget (Max Price Adult)
        if ($request->filled('budget')) {
            $budget = (float) $request->budget;
            if ($budget > 0) {
                $query->where('price_adult', '<=', $budget);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'featured');
        match ($sort) {
            'price_low' => $query->orderBy('price_adult', 'asc'),
            'price_high' => $query->orderBy('price_adult', 'desc'),
            'title_asc' => $query->orderBy('title', 'asc'),
            default => $query->orderByDesc('is_featured')->orderBy('title', 'asc'),
        };

        $packages = $query->paginate(9)->withQueryString();

        $categories = [
            'Pakej Pulau' => 'Pakej Pulau',
            'Pakej Umrah/Haji' => 'Pakej Umrah/Haji',
            'Honeymoon' => 'Honeymoon',
            'Day Trip' => 'Day Trip',
        ];

        return view('packages.index', [
            'packages' => $packages,
            'categories' => $categories,
            'selectedCategory' => $request->get('category', 'all'),
            'searchTerm' => $request->get('q', ''),
            'selectedBudget' => $request->get('budget', ''),
            'selectedSort' => $sort,
        ]);
    }

    /**
     * Display the detailed package page with itinerary, inclusions, and terms.
     */
    public function show(string $slug): View
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        $relatedPackages = Package::where('category', $package->category)
            ->where('id', '!=', $package->id)
            ->limit(3)
            ->get();

        return view('packages.show', [
            'package' => $package,
            'relatedPackages' => $relatedPackages,
        ]);
    }
}
