<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterServiceController extends Controller
{
    public function index()
    {
        $services   = Service::with('category')->withCount('providerServices')->latest()->paginate(20);
        $categories = Category::where('is_active', true)->get();
        return view('admin.services.index', compact('services','categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:150',
            'category_id'       => 'required|exists:categories,id',
            'description'       => 'nullable|string|max:1000',
            'base_price'        => 'required|numeric|min:0',
            'price_unit'        => 'required|in:per_visit,per_hour,per_unit,custom',
            'duration_estimate' => 'nullable|integer|min:1',
            'is_active'         => 'boolean',
        ]);

        $data['slug']                       = Str::slug($data['name']) . '-' . Str::random(4);
        $data['is_active']                  = $request->boolean('is_active', true);
        $data['estimated_duration_minutes'] = $data['duration_estimate'] ?? 60;

        Service::create($data);

        return back()->with('success', 'Layanan master berhasil ditambahkan.');
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:150',
            'category_id'       => 'required|exists:categories,id',
            'description'       => 'nullable|string|max:1000',
            'base_price'        => 'required|numeric|min:0',
            'price_unit'        => 'required|in:per_visit,per_hour,per_unit,custom',
            'duration_estimate' => 'nullable|integer|min:1',
            'is_active'         => 'boolean',
        ]);

        $data['is_active']                  = $request->boolean('is_active');
        $data['estimated_duration_minutes'] = $data['duration_estimate'] ?? $service->estimated_duration_minutes ?? 60;
        $service->update($data);

        return back()->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->bookingItems()->count() > 0) {
            return back()->with('error', 'Layanan tidak dapat dihapus karena terkait dengan pesanan.');
        }

        $service->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }
}
