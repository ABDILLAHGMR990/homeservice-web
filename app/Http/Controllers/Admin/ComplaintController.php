<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $status    = $request->get('status', 'open');
        $priority  = $request->get('priority');

        $query = Complaint::with(['customer','booking'])->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($priority) {
            $query->where('priority', $priority);
        }

        $complaints = $query->paginate(15)->withQueryString();

        $stats = [
            'open'      => Complaint::where('status', 'open')->count(),
            'in_review' => Complaint::where('status', 'in_review')->count(),
            'resolved'  => Complaint::where('status', 'resolved')->count(),
        ];

        return view('admin.complaints.index', compact('complaints','stats','status'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status'      => 'required|in:open,in_review,waiting_info,resolved,closed',
            'admin_notes' => 'nullable|string|max:1000',
            'priority'    => 'nullable|in:low,medium,high,urgent',
        ]);

        $data = [
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ];

        if ($request->priority) {
            $data['priority'] = $request->priority;
        }

        if (in_array($request->status, ['resolved', 'closed'])) {
            $data['resolved_at'] = now();
            $data['resolved_by'] = Auth::id();
        }

        $complaint->update($data);

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
