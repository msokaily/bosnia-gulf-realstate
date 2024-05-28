<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reasons extends Model
{

    protected $table = "reasons";

    protected $fillable = ['name', 'status', 'sort'];

    protected $appends = [];
    
}
