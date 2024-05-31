<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractorPayment extends Model
{

    protected $table = "contractor_payments";

    protected $fillable = ['realstate_id', 'reason', 'amount', 'note', 'paid_at'];

    protected $appends = [];

    protected $casts = [
        'paid_at' => 'date'
    ];

    public function realstate()
    {
        return $this->belongsTo(Realstate::class, 'realstate_id', 'id');
    }
    
}
