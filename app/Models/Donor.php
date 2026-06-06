<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'institution',
    ];

    public function incomingDonations()
    {
        return $this->hasMany(IncomingDonation::class);
    }
}