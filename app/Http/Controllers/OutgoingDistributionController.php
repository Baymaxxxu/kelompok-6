<?php

namespace App\Http\Controllers;

use App\Models\OutgoingDistribution;
use App\Models\OutgoingDistributionDetail;
use App\Models\Recipient;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutgoingDistributionController extends Controller
{
    public function index()
    {
        $outgoingDistributions = OutgoingDistribution::with(['recipient', 'details.item'])
            ->orderBy('distribution_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('outgoing_distributions.index', compact('outgoingDistributions'));
    }

    public function create()
    {
        $recipients = Recipient::orderBy('name', 'asc')->get();
        $items = Item::with('category')->orderBy('name', 'asc')->get();

        return view('outgoing_distributions.create', compact('recipients', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:recipients,id',
            'item_id' => 'required|exists:items,id',
            'distribution_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable',
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($request->quantity > $item->stock) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity' => 'Jumlah keluar melebihi stok tersedia. Stok saat ini: ' . $item->stock . ' ' . $item->unit,
                ]);
        }

        DB::transaction(function () use ($request, $item) {
            $outgoingDistribution = OutgoingDistribution::create([
                'recipient_id' => $request->recipient_id,
                'user_id' => null,
                'distribution_date' => $request->distribution_date,
                'notes' => $request->notes,
            ]);

            OutgoingDistributionDetail::create([
                'outgoing_distribution_id' => $outgoingDistribution->id,
                'item_id' => $request->item_id,
                'quantity' => $request->quantity,
            ]);

            $item->stock = $item->stock - $request->quantity;
            $item->save();
        });

        return redirect()->route('outgoing-distributions.index')
            ->with('success', 'Distribusi bantuan berhasil dicatat dan stok barang berkurang.');
    }

    public function show(OutgoingDistribution $outgoingDistribution)
    {
        $outgoingDistribution->load(['recipient', 'details.item.category']);

        return view('outgoing_distributions.show', compact('outgoingDistribution'));
    }

    public function destroy(OutgoingDistribution $outgoingDistribution)
    {
        DB::transaction(function () use ($outgoingDistribution) {
            $outgoingDistribution->load('details.item');

            foreach ($outgoingDistribution->details as $detail) {
                $item = $detail->item;

                if ($item) {
                    $item->stock = $item->stock + $detail->quantity;
                    $item->save();
                }
            }

            $outgoingDistribution->delete();
        });

        return redirect()->route('outgoing-distributions.index')
            ->with('success', 'Data distribusi berhasil dihapus dan stok dikembalikan.');
    }
}