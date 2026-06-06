<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::orderBy('id', 'asc')->get();

        return view('donors.index', compact('donors'));
    }

    public function create()
    {
        return view('donors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'phone' => 'nullable|max:30',
            'address' => 'nullable',
            'institution' => 'nullable|max:150',
        ]);

        Donor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'institution' => $request->institution,
        ]);

        return redirect()->route('donors.index')
            ->with('success', 'Data donatur berhasil ditambahkan.');
    }

    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    public function update(Request $request, Donor $donor)
    {
        $request->validate([
            'name' => 'required|max:150',
            'phone' => 'nullable|max:30',
            'address' => 'nullable',
            'institution' => 'nullable|max:150',
        ]);

        $donor->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'institution' => $request->institution,
        ]);

        return redirect()->route('donors.index')
            ->with('success', 'Data donatur berhasil diperbarui.');
    }

    public function destroy(Donor $donor)
    {
        $donor->delete();

        return redirect()->route('donors.index')
            ->with('success', 'Data donatur berhasil dihapus.');
    }
}