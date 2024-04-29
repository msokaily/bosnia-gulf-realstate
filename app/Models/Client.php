<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Client extends Model
{

    use HasTranslations;

    protected $table = "clients";

    protected $translatable = [];

    protected $fillable = ['name', 'mobile', 'email', 'status'];

    protected $appends = [];

    public function realstates()
    {
        return $this->hasMany(Realstate::class, 'client_id');
    }

}
