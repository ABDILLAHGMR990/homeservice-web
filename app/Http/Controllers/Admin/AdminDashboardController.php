<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Complaint;
use App\Models\Payment;
use App\Models\ProviderProfile;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'       => User::where('role','customer')->count(),
            'total_providers'   => User::where('role','provider')->count(),
            'total_bookings'    => Booking::count(),
            'active_bookings'   => Booking::whereIn('status',['pending','accepted','on_the_way','in_progress'])->count(),
            'pending_verif'     => ProviderProfile::where('verification_status','pending')->count(),
            'total_revenue'     => Payment::where('status','paid')->sum('platform_fee'),
            'open_complaints'   => Complaint::where('status','open')->count(),
        ];

        $pendingVerifications = ProviderProfile::where('verification_status','pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentBookings = Booking::with(['customer','provider','items'])
            ->latest()
            ->take(10)
            ->get();

        $recentComplaints = Complaint::where('status','open')
            ->with(['customer','booking'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats','pendingVerifications','recentBookings','recentComplaints'));
    }
}
