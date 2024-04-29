<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    // use SoftDeletes;

    protected $table = "contents";

    protected $appends = ['value_url'];

    public static $default_image = 'images/default_image.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['type', 'name', 'value'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * 
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    protected static function booted(): void
    {
    }
    
    public function getValueUrlAttribute()
    {
        if ($this->attributes['type'] == 'image' || $this->attributes['type'] == 'images') {
            try { $images = json_decode($this->attributes['value']) ;} catch (\Throwable $th) { $images = ''; }
            if (is_array($images)) {
                $images = Media::whereIn('id', $images)->get();
                if ($images->count() > 0) {
                    return json_decode(json_encode($images->map(function($img, $index) {
                        return $img->url;
                    })));
                } else {
                    return [];
                }
            } else {
                $image = Media::find($this->attributes['value']);
                return $image ? $image->url : '';
            }
        } else {
            return $this->attributes['value'];
        }
    }

}
