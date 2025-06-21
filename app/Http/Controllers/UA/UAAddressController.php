<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UAAddressController extends Controller
{
    public function index()
    {
        $customer = Customer::where('user_id', Auth::id())->firstOrFail();
        $addresses = CustomerAddress::where('customer_id', $customer->id)->get();

        return view('ua.dashboard.address', compact('addresses', 'customer'));
    }

    public function store(Request $request)
    {
        $customer = Customer::where('user_id', Auth::id())->firstOrFail();
        $request->validate([
            'label' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'full_address' => 'required|string',
        ]);

        if ($request->is_default) {
            CustomerAddress::where('customer_id', $customer->id)->update(['is_default' => false]);
        }

        CustomerAddress::create([
            'customer_id' => $customer->id,
            'label' => $request->label,
            'recipient_name' => $request->recipient_name,
            'phone_number' => $request->phone_number,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'full_address' => $request->full_address,
            'is_default' => $request->is_default ? true : false,
        ]);

        return redirect()->route('ua.address.index')->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $address = CustomerAddress::findOrFail($id);

        $request->validate([
            'label' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'full_address' => 'required|string',
        ]);

        if ($request->is_default) {
            CustomerAddress::where('customer_id', $address->customer_id)->update(['is_default' => false]);
        }

        $address->update([
            'label' => $request->label,
            'recipient_name' => $request->recipient_name,
            'phone_number' => $request->phone_number,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'full_address' => $request->full_address,
            'is_default' => $request->is_default ? true : false,
        ]);

        return redirect()->route('ua.address.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $address = CustomerAddress::findOrFail($id);
        $address->delete();

        return redirect()->route('ua.address.index')->with('success', 'Alamat berhasil dihapus.');
    }
}
