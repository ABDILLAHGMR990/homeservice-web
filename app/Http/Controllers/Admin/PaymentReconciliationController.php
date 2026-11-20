<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentReconciliationController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['booking.customer','booking.provider'])->latest('paid_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('method')) {
            $query->where('payment_method', $request->method);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('paid_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('paid_at', '<=', $request->date_to);
        }

        $payments = $query->paginate(20)->withQueryString();

        $totals = [
            'total_revenue' => Payment::where('status','paid')->sum('amount'),
            'platform_fee'  => Payment::where('status','paid')->sum('platform_fee'),
            'provider_earn' => Payment::where('status','paid')->sum('provider_earning'),
        ];

        return view('admin.payments.index', compact('payments','totals'));
    }

    public function markAsPaid(Payment $payment)
    {
        $payment->update(['status' => 'paid', 'paid_at' => now()]);
        $payment->booking()->update(['payment_status' => 'paid']);

        return back()->with('success', 'Pembayaran berhasil ditandai sebagai lunas.');
    }
}
