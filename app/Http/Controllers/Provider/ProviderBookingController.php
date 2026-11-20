<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderBookingController extends Controller
{
    public function __construct(private BookingService $bookingService) {}

    public function index(Request $request)
    {
        $tab   = $request->get('tab', 'incoming');
        $user  = Auth::user();

        $query = Booking::where('provider_id', $user->id)
            ->with(['customer','items'])
            ->latest();

        $statusMap = [
            'incoming'  => ['pending'],
            'active'    => ['accepted','on_the_way','in_progress'],
            'completed' => ['completed'],
            'cancelled' => ['cancelled','rejected'],
        ];

        if (isset($statusMap[$tab])) {
            $query->whereIn('status', $statusMap[$tab]);
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('provider.bookings.index', compact('bookings','tab'));
    }

    public function show(string $code)
    {
        $booking = Booking::where('booking_code', $code)
            ->where('provider_id', Auth::id())
            ->with(['customer','items.service','statusLogs.changedBy','payment','address'])
            ->firstOrFail();

        $allowedNextStatuses = $this->bookingService->getAllowedNextStatuses($booking, 'provider');

        return view('provider.bookings.show', compact('booking','allowedNextStatuses'));
    }

    public function updateStatus(Request $request, string $code)
    {
        $request->validate([
            'status' => 'required|string',
            'notes'  => 'nullable|string|max:500',
        ]);

        $booking = Booking::where('booking_code', $code)
            ->where('provider_id', Auth::id())
            ->firstOrFail();

        $this->bookingService->transitionStatus(
            $booking,
            $request->status,
            Auth::user(),
            $request->notes
        );

        $labels = [
            'accepted'   => 'dikonfirmasi',
            'rejected'   => 'ditolak',
            'on_the_way' => 'dalam perjalanan',
            'in_progress'=> 'sedang dikerjakan',
            'completed'  => 'selesai',
        ];

        $label = $labels[$request->status] ?? $request->status;

        return back()->with('success', "Status pesanan berhasil diubah menjadi: {$label}.");
    }
}
