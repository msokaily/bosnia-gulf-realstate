<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InitialPayment extends Model
{

    protected $table = "initial_payments";

    protected $fillable = ['realstate_id', 'reason_id', 'amount', 'note', 'paid_at'];

    protected $appends = [];

    protected $casts = [
        'paid_at' => 'date'
    ];

    public function realstate()
    {
        return $this->belongsTo(Realstate::class, 'realstate_id', 'id');
    }

    public function reason()
    {
        return $this->belongsTo(Reasons::class, 'reason_id', 'id');
    }
    
}
