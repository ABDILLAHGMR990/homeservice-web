<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->withCount('services')
            ->orderBy('sort_order')
            ->take(10)
            ->get();

        $featuredServices = Service::where('is_active', true)
            ->with(['category', 'providerServices.providerProfile.user'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->take(6)
            ->get();

        $topProviders = User::where('role', 'provider')
            ->whereHas('providerProfile', fn($q) => $q->where('verification_status', 'verified'))
            ->with(['providerProfile'])
            ->withAvg('providerReviews', 'rating')
            ->withCount('providerReviews')
            ->orderByDesc('provider_reviews_avg_rating')
            ->take(4)
            ->get();

        $testimonials = Review::with(['customer', 'booking.items'])
            ->where('rating', '>=', 4)
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact('categories', 'featuredServices', 'topProviders', 'testimonials'));
    }
}
