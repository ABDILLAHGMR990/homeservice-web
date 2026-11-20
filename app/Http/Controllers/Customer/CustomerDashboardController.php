<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total'     => Booking::where('customer_id', $user->id)->count(),
            'active'    => Booking::where('customer_id', $user->id)
                ->whereIn('status', ['pending','accepted','on_the_way','in_progress'])->count(),
            'completed' => Booking::where('customer_id', $user->id)->where('status','completed')->count(),
            'cancelled' => Booking::where('customer_id', $user->id)->where('status','cancelled')->count(),
        ];

        $activeBookings = Booking::where('customer_id', $user->id)
            ->whereIn('status', ['pending','accepted','on_the_way','in_progress'])
            ->with(['items','provider'])
            ->latest()
            ->take(3)
            ->get();

        $recentBookings = Booking::where('customer_id', $user->id)
            ->with(['items','provider'])
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('stats','activeBookings','recentBookings'));
    }
}
