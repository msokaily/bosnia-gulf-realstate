<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realstate extends Model
{

    protected $table = "realstates";

    protected $fillable = ['opu_ip', 'address', 'status'];

    protected $appends = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'realstate_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    
}
