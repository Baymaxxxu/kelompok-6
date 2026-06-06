<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\IncomingDonationDetail;
use App\Models\OutgoingDistributionDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalItems = Item::count();
        $totalStock = Item::sum('stock');

        $totalIncoming = IncomingDonationDetail::sum('quantity');
        $totalOutgoing = OutgoingDistributionDetail::sum('quantity');

        $items = Item::with('category')
            ->orderBy('name', 'asc')
            ->get();

        return view('dashboard', compact(
            'totalCategories',
            'totalItems',
            'totalStock',
            'totalIncoming',
            'totalOutgoing',
            'items'
        ));
    }
}