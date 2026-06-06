<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    public function index()
    {
        $recipients = Recipient::orderBy('id', 'asc')->get();

        return view('recipients.index', compact('recipients'));
    }

    public function create()
    {
        return view('recipients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'phone' => 'nullable|max:30',
            'address' => 'nullable',
            'location' => 'nullable|max:150',
            'notes' => 'nullable',
        ]);

        Recipient::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'location' => $request->location,
            'notes' => $request->notes,
        ]);

        return redirect()->route('recipients.index')
            ->with('success', 'Data penerima berhasil ditambahkan.');
    }

    public function edit(Recipient $recipient)
    {
        return view('recipients.edit', compact('recipient'));
    }

    public function update(Request $request, Recipient $recipient)
    {
        $request->validate([
            'name' => 'required|max:150',
            'phone' => 'nullable|max:30',
            'address' => 'nullable',
            'location' => 'nullable|max:150',
            'notes' => 'nullable',
        ]);

        $recipient->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'location' => $request->location,
            'notes' => $request->notes,
        ]);

        return redirect()->route('recipients.index')
            ->with('success', 'Data penerima berhasil diperbarui.');
    }

    public function destroy(Recipient $recipient)
    {
        $recipient->delete();

        return redirect()->route('recipients.index')
            ->with('success', 'Data penerima berhasil dihapus.');
    }
}