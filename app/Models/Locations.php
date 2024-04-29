<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $appends = ['image_url', 'image_urls'];

    public static $images_dir = 'public/uploads/services/';
    public static $default_image = 'images/default_service.png';

    protected $fillable = [
        'coordinates',
        'title',
        'description',
        'image',
        'status',
        'left_shift',
        'top_shift',
        'message'
    ];

    public function getImageUrlAttribute()
    {
        try { $images = json_decode($this->attributes['image']) ;} catch (\Throwable $th) { $images = ''; }
        if (is_array($images)) {
            return Media::whereIn('id', $images)->first();
        } else {
            return Media::find($this->attributes['image']);
        }
    }
    
    public function getImageUrlsAttribute()
    {
        try { $images = json_decode($this->attributes['image']) ;} catch (\Throwable $th) { $images = ''; }
        if (is_array($images)) {
            return Media::whereIn('id', $images)->get();
        } else {
            return Media::find($this->attributes['image']);
        }
    }
}
