<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingDistributionDetail extends Model
{
    protected $fillable = [
        'outgoing_distribution_id',
        'item_id',
        'quantity',
    ];

    public function outgoingDistribution()
    {
        return $this->belongsTo(OutgoingDistribution::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}