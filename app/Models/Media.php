<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Pawlox\VideoThumbnail\Facade\VideoThumbnail;

class Media extends Model
{
    // use SoftDeletes;

    protected $table = "media";

    protected $appends = [];

    public static $media_dir = 'public/uploads/media';
    public static $default_image = 'images/default_image.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['type', 'url', 'thumbnail'];

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

    private static $videoExtensions = ['mp4','ogx','oga','ogv','ogg','webm','avi','3gp'];

    protected static function booted(): void
    {
        static::deleted(function (Media $file) {
            Storage::disk('public')->delete($file->attributes['url']);
        });
    }
    
    public function setUrlAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $name = $value->store(null, 'public');  
            $this->attributes['url'] = $name;
            // if (in_array($this->fileExtension(), self::$videoExtensions))
            // {
            //     $this->setThumbnail();
            // }
        } else {
            $this->attributes['url'] = $value;
        }
    }

    public function getUrlAttribute()
    {
        return $this->attributes['url'] ? Storage::disk('public')->url($this->attributes['url']) : asset(self::$default_image);
    }

    public function getThumbnailAttribute()
    {
        return $this->attributes['thumbnail'] ? Storage::disk('public')->url('thumbnails/'.$this->attributes['thumbnail']) : asset(self::$default_image);
    }

    public function fileExtension()
    {
        return pathinfo($this->attributes['url'], PATHINFO_EXTENSION);
    }
    public function setThumbnail()
    {
        $fname = Str::random(12).'_thumbnail.png';
        VideoThumbnail::createThumbnail(
            Storage::disk('public')->path($this->attributes['url']),
            Storage::disk('public')->path(''),
            $fname,
            2,
            640,
            480
        );
        $this->attributes['thumbnail'] = $fname;
    }

}
