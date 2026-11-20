<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryCatalogController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->withCount(['services' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        return view('public.categories.index', compact('categories'));
    }
}
