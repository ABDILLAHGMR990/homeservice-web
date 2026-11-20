<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'incoming'  => Booking::where('provider_id', $user->id)->where('status','pending')->count(),
            'active'    => Booking::where('provider_id', $user->id)
                ->whereIn('status',['accepted','on_the_way','in_progress'])->count(),
            'completed' => Booking::where('provider_id', $user->id)->where('status','completed')->count(),
            'earnings'  => Payment::whereHas('booking', fn($q)=>$q->where('provider_id', $user->id))
                ->where('status','paid')->sum('provider_earning'),
        ];

        $incomingOrders = Booking::where('provider_id', $user->id)
            ->where('status','pending')
            ->with(['customer','items'])
            ->latest()
            ->take(5)
            ->get();

        $activeJobs = Booking::where('provider_id', $user->id)
            ->whereIn('status',['accepted','on_the_way','in_progress'])
            ->with(['customer','items'])
            ->latest()
            ->take(5)
            ->get();

        return view('provider.dashboard', compact('stats','incomingOrders','activeJobs'));
    }
}
