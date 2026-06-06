<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingDonation extends Model
{
    protected $fillable = [
        'donor_id',
        'user_id',
        'donation_date',
        'notes',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(IncomingDonationDetail::class);
    }
}