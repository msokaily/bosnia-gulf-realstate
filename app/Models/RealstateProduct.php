<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealstateProduct extends Model
{

    protected $table = "realstate_products";

    protected $fillable = ['realstate_id', 'product_id', 'amount', 'paid_at'];

    protected $appends = [];

    protected $casts = [
        'paid_at' => 'date'
    ];

    public function realstate()
    {
        return $this->belongsTo(Realstate::class, 'realstate_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
}
