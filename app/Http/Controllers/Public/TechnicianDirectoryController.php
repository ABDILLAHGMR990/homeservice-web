<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class TechnicianDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'provider')
            ->whereHas('providerProfile', fn($q) => $q->where('verification_status', 'verified'))
            ->with(['providerProfile'])
            ->withAvg('providerReviews', 'rating')
            ->withCount('providerReviews');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('providerProfile.providerServices.service',
                fn($q) => $q->where('category_id', $request->category)
            );
        }

        if ($request->filled('min_rating')) {
            $query->having('provider_reviews_avg_rating', '>=', (float)$request->min_rating);
        }

        $providers  = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('public.technicians.index', compact('providers', 'categories'));
    }

    public function show(string|int $username)
    {
        $query = User::where('role', 'provider')
            ->with([
                'providerProfile.documents',
                'providerProfile.providerServices.service.category',
                'providerProfile.areas',
            ])
            ->withAvg('providerReviews', 'rating')
            ->withCount('providerReviews');

        if (is_numeric($username)) {
            $provider = $query->find($username);
        } else {
            $nameSearch = str_replace('-', ' ', $username);
            $provider = $query->where('name', 'like', "%{$nameSearch}%")->first();
        }

        // Graceful fallback to first provider if requested username/id not matched
        if (!$provider) {
            $provider = $query->firstOrFail();
        }

        $reviews = $provider->providerReviews()
            ->with('customer')
            ->latest()
            ->paginate(5);

        return view('public.technicians.show', compact('provider', 'reviews'));
    }
}
