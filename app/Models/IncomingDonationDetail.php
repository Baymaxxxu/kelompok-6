<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingDonationDetail extends Model
{
    protected $fillable = [
        'incoming_donation_id',
        'item_id',
        'quantity',
    ];

    public function incomingDonation()
    {
        return $this->belongsTo(IncomingDonation::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}