<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'unit',
        'stock',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function incomingDonationDetails()
    {
        return $this->hasMany(IncomingDonationDetail::class);
    }

    public function outgoingDistributionDetails()
    {
        return $this->hasMany(OutgoingDistributionDetail::class);
    }
}