<?php

namespace App\Http\Controllers;

use App\Models\IncomingDonation;
use App\Models\IncomingDonationDetail;
use App\Models\Donor;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomingDonationController extends Controller
{
    public function index()
    {
        $incomingDonations = IncomingDonation::with(['donor', 'details.item'])
            ->orderBy('donation_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('incoming_donations.index', compact('incomingDonations'));
    }

    public function create()
    {
        $donors = Donor::orderBy('name', 'asc')->get();
        $items = Item::with('category')->orderBy('name', 'asc')->get();

        return view('incoming_donations.create', compact('donors', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'item_id' => 'required|exists:items,id',
            'donation_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable',
        ]);

        DB::transaction(function () use ($request) {
            $incomingDonation = IncomingDonation::create([
                'donor_id' => $request->donor_id,
                'user_id' => null,
                'donation_date' => $request->donation_date,
                'notes' => $request->notes,
            ]);

            IncomingDonationDetail::create([
                'incoming_donation_id' => $incomingDonation->id,
                'item_id' => $request->item_id,
                'quantity' => $request->quantity,
            ]);

            $item = Item::findOrFail($request->item_id);
            $item->stock = $item->stock + $request->quantity;
            $item->save();
        });

        return redirect()->route('incoming-donations.index')
            ->with('success', 'Bantuan masuk berhasil dicatat dan stok barang bertambah.');
    }

    public function show(IncomingDonation $incomingDonation)
    {
        $incomingDonation->load(['donor', 'details.item.category']);

        return view('incoming_donations.show', compact('incomingDonation'));
    }

    public function destroy(IncomingDonation $incomingDonation)
    {
        DB::transaction(function () use ($incomingDonation) {
            $incomingDonation->load('details.item');

            foreach ($incomingDonation->details as $detail) {
                $item = $detail->item;

                if ($item) {
                    $item->stock = max(0, $item->stock - $detail->quantity);
                    $item->save();
                }
            }

            $incomingDonation->delete();
        });

        return redirect()->route('incoming-donations.index')
            ->with('success', 'Data bantuan masuk berhasil dihapus dan stok dikurangi kembali.');
    }
}