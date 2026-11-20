<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceCatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::where('is_active', true)
            ->with(['category'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        $keyword = $request->input('q', $request->input('search'));
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($request->filled('category')) {
            $cat = $request->category;
            if (is_numeric($cat)) {
                $query->where('category_id', (int)$cat);
            } else {
                $query->whereHas('category', fn($q) => $q->where('slug', $cat));
            }
        }

        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', (int)$request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', (int)$request->max_price);
        }

        if ($request->filled('rating')) {
            $query->having('reviews_avg_rating', '>=', (float)$request->rating);
        }

        $sortField = match($request->sort) {
            'price_asc'    => ['base_price', 'asc'],
            'price_desc'   => ['base_price', 'desc'],
            'rating'       => ['reviews_avg_rating', 'desc'],
            'newest'       => ['created_at', 'desc'],
            default        => ['created_at', 'desc'],
        };

        $services   = $query->orderBy($sortField[0], $sortField[1])->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('public.services.index', compact('services', 'categories'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'providerServices.providerProfile.user'])
            ->withAvg('reviews', 'rating')
            ->firstOrFail();

        $reviews = $service->reviews()
            ->with('customer')
            ->latest()
            ->paginate(5);

        $relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('public.services.show', compact('service', 'reviews', 'relatedServices'));
    }
}
