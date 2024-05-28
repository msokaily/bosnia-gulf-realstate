<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionPayment extends Model
{

    protected $table = "construction_payments";

    protected $fillable = ['realstate_id', 'reason', 'amount', 'amount_km', 'note', 'paid_at'];

    protected $appends = [];

    protected $casts = [
        'paid_at' => 'date'
    ];

    public function realstate()
    {
        return $this->belongsTo(Realstate::class, 'realstate_id', 'id');
    }
    
}
