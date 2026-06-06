<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\IncomingDonation;
use App\Models\OutgoingDistribution;

class ReportController extends Controller
{
    public function index()
    {
        $items = Item::with('category')
            ->orderBy('name', 'asc')
            ->get();

        $incomingDonations = IncomingDonation::with(['donor', 'details.item'])
            ->orderBy('donation_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $outgoingDistributions = OutgoingDistribution::with(['recipient', 'details.item'])
            ->orderBy('distribution_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $totalStock = Item::sum('stock');
        $totalIncoming = 0;
        $totalOutgoing = 0;

        foreach ($incomingDonations as $donation) {
            foreach ($donation->details as $detail) {
                $totalIncoming += $detail->quantity;
            }
        }

        foreach ($outgoingDistributions as $distribution) {
            foreach ($distribution->details as $detail) {
                $totalOutgoing += $detail->quantity;
            }
        }

        return view('reports.index', compact(
            'items',
            'incomingDonations',
            'outgoingDistributions',
            'totalStock',
            'totalIncoming',
            'totalOutgoing'
        ));
    }
}