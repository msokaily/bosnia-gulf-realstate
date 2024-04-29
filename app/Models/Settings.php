<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Settings extends Model
{

    use HasTranslations;

    public $translatable = ['site_description'];
    protected $appends = ['home_bg_url', 'menu_bg_url'];
    
    public static $images_dir = '';
    public static $default_image = 'images/default_cover.jpg';

    public function getHomeBgUrlAttribute()
    {
        try { $images = json_decode($this->attributes['home_bg']) ;} catch (\Throwable $th) { $images = ''; }
        if (is_array($images)) {
            return Media::whereIn('id', $images)->first();
        } else {
            return Media::find($this->attributes['home_bg']);
        }
    }

    public function getMenuBgUrlAttribute()
    {
        try { $images = json_decode($this->attributes['menu_bg']) ;} catch (\Throwable $th) { $images = ''; }
        if (is_array($images)) {
            return Media::whereIn('id', $images)->first();
        } else {
            return Media::find($this->attributes['menu_bg']);
        }
    }
}

