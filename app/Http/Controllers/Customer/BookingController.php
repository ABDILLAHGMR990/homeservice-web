<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Service;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct(private BookingService $bookingService) {}

    public function index(Request $request)
    {
        $user  = Auth::user();
        $tab   = $request->get('tab', 'all');

        $query = Booking::where('customer_id', $user->id)
            ->with(['items','provider'])
            ->latest();

        if ($tab !== 'all') {
            $statusMap = [
                'active'    => ['pending','accepted','on_the_way','in_progress'],
                'completed' => ['completed'],
                'cancelled' => ['cancelled','rejected'],
            ];
            if (isset($statusMap[$tab])) {
                $query->whereIn('status', $statusMap[$tab]);
            }
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('customer.bookings.index', compact('bookings','tab'));
    }

    public function show(string $code)
    {
        $booking = Booking::where('booking_code', $code)
            ->where('customer_id', Auth::id())
            ->with(['items.service','provider.providerProfile','statusLogs.changedBy','payment','review','address'])
            ->firstOrFail();

        return view('customer.bookings.show', compact('booking'));
    }

    public function create(Request $request)
    {
        $serviceId = $request->get('service_id');
        $providerId = $request->get('provider_id');

        $service    = $serviceId ? Service::find($serviceId) : null;
        $categories = Category::where('is_active', true)->get();
        $addresses  = Auth::user()->addresses()->get();

        return view('customer.bookings.create', compact('service','categories','addresses','providerId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items'              => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.quantity'   => 'required|integer|min:1|max:10',
            'booking_date'       => 'required|date|after_or_equal:today',
            'booking_time'       => 'required',
            'address_id'         => 'required|exists:addresses,id',
            'payment_method'     => 'required|in:cash,online',
            'notes'              => 'nullable|string|max:500',
        ]);

        $booking = $this->bookingService->createBooking(
            $request->only('items','booking_date','booking_time','address_id','payment_method','notes','provider_id'),
            Auth::user()
        );

        if ($request->payment_method === 'online') {
            return redirect()->route('customer.bookings.payment', $booking->booking_code);
        }

        return redirect()->route('customer.bookings.show', $booking->booking_code)
            ->with('success', 'Pesanan berhasil dibuat! Kode pesanan: ' . $booking->booking_code);
    }

    public function cancel(Request $request, string $code)
    {
        $booking = Booking::where('booking_code', $code)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        $this->bookingService->cancelBooking($booking, Auth::user(), $request->get('reason'));

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
