<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Realstate extends Model
{

    use SoftDeletes;
    
    protected $table = "realstates";

    protected $fillable = ['opu_ip', 'address', 'status', 'meter_price', 'area', 'initial_cost_total', 'construction_total', 'contractor_total', 'finished_at'];

    protected $appends = [];

    protected $casts = [
        'finished_at' => 'date'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'realstate_id');
    }

    public function construction_payments()
    {
        return $this->hasMany(ConstructionPayment::class, 'realstate_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    
}
