<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Client extends Model
{

    use HasTranslations, SoftDeletes;

    protected $table = "clients";

    protected $translatable = [];

    protected $fillable = ['name', 'mobile', 'email', 'currency', 'status'];

    protected $appends = [];

    public function realstates()
    {
        return $this->hasMany(Realstate::class, 'client_id');
    }

}
