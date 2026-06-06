<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'location',
        'notes',
    ];

    public function outgoingDistributions()
    {
        return $this->hasMany(OutgoingDistribution::class);
    }
}