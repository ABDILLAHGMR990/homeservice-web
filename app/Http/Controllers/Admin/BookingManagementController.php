<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingManagementController extends Controller
{
    public function __construct(private BookingService $bookingService) {}

    public function index(Request $request)
    {
        $query = Booking::with(['customer','provider','items'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('booking_code', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $bookings = $query->paginate(20)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function forceCancel(Request $request, string $code)
    {
        $request->validate(['reason' => 'required|string|max:500']);

        $booking = Booking::where('booking_code', $code)->firstOrFail();

        $this->bookingService->cancelBooking($booking, Auth::user(), '[Admin] ' . $request->reason);

        return back()->with('success', 'Pesanan ' . $code . ' berhasil dibatalkan oleh admin.');
    }
}
