<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingDistribution extends Model
{
    protected $fillable = [
        'recipient_id',
        'user_id',
        'distribution_date',
        'notes',
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OutgoingDistributionDetail::class);
    }
}