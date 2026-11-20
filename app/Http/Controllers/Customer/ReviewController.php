<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(string $code)
    {
        $booking = Booking::where('booking_code', $code)
            ->where('customer_id', Auth::id())
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->with(['items','provider'])
            ->firstOrFail();

        return view('customer.reviews.create', compact('booking'));
    }

    public function store(Request $request, string $code)
    {
        $booking = Booking::where('booking_code', $code)
            ->where('customer_id', Auth::id())
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->firstOrFail();

        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        Review::create([
            'booking_id'  => $booking->id,
            'customer_id' => Auth::id(),
            'provider_id' => $booking->provider_id,
            'rating'      => $data['rating'],
            'comment'     => $data['comment'],
        ]);

        if ($booking->provider_id) {
            $provider = $booking->provider;
            $avg = Review::where('provider_id', $booking->provider_id)->avg('rating');
            $count = Review::where('provider_id', $booking->provider_id)->count();
            $provider->providerProfile?->update([
                'rating_avg'    => round($avg, 2),
                'total_reviews' => $count,
            ]);
        }

        return redirect()->route('customer.bookings.show', $code)
            ->with('success', 'Ulasan berhasil dikirim. Terima kasih!');
    }
}
