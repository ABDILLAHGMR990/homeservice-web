<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses()->latest()->get();
        return view('customer.addresses.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'          => 'required|string|max:50',
            'recipient_name' => 'required|string|max:100',
            'phone'          => 'required|string|max:20',
            'address_line'   => 'required|string|max:255',
            'rt_rw'          => 'nullable|string|max:10',
            'kelurahan'      => 'nullable|string|max:100',
            'kecamatan'      => 'nullable|string|max:100',
            'city'           => 'required|string|max:100',
            'province'       => 'required|string|max:100',
            'postal_code'    => 'nullable|string|max:10',
            'notes'          => 'nullable|string|max:255',
            'is_primary'     => 'boolean',
        ]);

        $data['user_id'] = Auth::id();

        if (!empty($data['is_primary'])) {
            Auth::user()->addresses()->update(['is_primary' => false]);
        }

        if (Auth::user()->addresses()->count() === 0) {
            $data['is_primary'] = true;
        }

        Address::create($data);

        return back()->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function update(Request $request, Address $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);

        $data = $request->validate([
            'label'          => 'required|string|max:50',
            'recipient_name' => 'required|string|max:100',
            'phone'          => 'required|string|max:20',
            'address_line'   => 'required|string|max:255',
            'rt_rw'          => 'nullable|string|max:10',
            'kelurahan'      => 'nullable|string|max:100',
            'kecamatan'      => 'nullable|string|max:100',
            'city'           => 'required|string|max:100',
            'province'       => 'required|string|max:100',
            'postal_code'    => 'nullable|string|max:10',
            'notes'          => 'nullable|string|max:255',
        ]);

        $address->update($data);

        return back()->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy(Address $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);

        if ($address->bookings()->count() > 0) {
            return back()->with('error', 'Alamat tidak dapat dihapus karena terkait dengan pesanan.');
        }

        $wasPrimary = $address->is_primary;
        $address->delete();

        if ($wasPrimary) {
            Auth::user()->addresses()->first()?->update(['is_primary' => true]);
        }

        return back()->with('success', 'Alamat berhasil dihapus.');
    }

    public function setPrimary(Address $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);

        Auth::user()->addresses()->update(['is_primary' => false]);
        $address->update(['is_primary' => true]);

        return back()->with('success', 'Alamat utama berhasil diperbarui.');
    }
}
