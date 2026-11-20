<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EarningsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Payment::whereHas('booking', fn($q) => $q->where('provider_id', $user->id))
            ->where('status', 'paid')
            ->with('booking.customer');

        if ($request->filled('month')) {
            $query->whereMonth('paid_at', $request->month);
        }
        if ($request->filled('year')) {
            $query->whereYear('paid_at', $request->year ?? date('Y'));
        }

        $earnings = $query->latest('paid_at')->paginate(20)->withQueryString();

        $stats = [
            'total_earning'      => Payment::whereHas('booking', fn($q)=>$q->where('provider_id',$user->id))
                ->where('status','paid')->sum('provider_earning'),
            'this_month'         => Payment::whereHas('booking', fn($q)=>$q->where('provider_id',$user->id))
                ->where('status','paid')->whereMonth('paid_at', now()->month)->sum('provider_earning'),
            'total_jobs'         => $user->providerProfile?->total_jobs_done ?? 0,
            'pending_withdrawal' => 0,
        ];

        return view('provider.earnings.index', compact('earnings','stats'));
    }
}
