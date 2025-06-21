<?php

namespace App\Http\Controllers\PA;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class PABankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('pa.banks.index', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:banks,account_number',
        ]);

        try {
            Bank::create($request->all());
            return redirect()->route('pa.banks.index')->with('success', 'Data bank berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data bank: ' . $e->getMessage());
        }
    }

    public function edit(Bank $bank)
    {
        $banks = Bank::all();
        return view('pa.banks.index', compact('bank', 'banks'));
    }


    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:banks,account_number,' . $bank->id,
        ]);

        try {
            $bank->update($request->all());
            return redirect()->route('pa.banks.index')->with('success', 'Data bank berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data bank: ' . $e->getMessage());
        }
    }

    public function destroy(Bank $bank)
    {
        try {
            $bank->delete();
            return redirect()->route('pa.banks.index')->with('success', 'Data bank berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data bank: ' . $e->getMessage());
        }
    }
}
