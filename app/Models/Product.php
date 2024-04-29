<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{

    use HasTranslations;

    protected $table = "products";

    protected $translatable = [];

    protected $fillable = ['name', 'status', 'sort'];

    protected $appends = [];
    
}
