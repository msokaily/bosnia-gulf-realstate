<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $appends = ['letter', 'city', 'postal_code', 'full_name'];

    public static $images_dir = 'public/uploads/users/';
    public static $default_image = 'images/default_user.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'address',
        'country',
        'city',
        'postal_code',
        'oib',
        'password',
        'status',
        'verified_at',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at', 'deleted_at','activation_token' ,'api_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    private $city;
    private $postal_code;

    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public function setStatusAttribute($value) {
        $updatedValue = $value;
        if ($value) {
            $updatedValue = 'Active';
        }else if ($value == 0) {
            $updatedValue = 'InActive';
        } else if ($value == -1) {
            $updatedValue = 'Block';
        }
        $this->attributes['status'] = $updatedValue;
    }

    public function setPasswordAttribute($value) {
        if ($value) {
            if (Hash::isHashed($value)) {
                $this->attributes['password'] = $value;
            }else {
                $this->attributes['password'] = bcrypt($value);
            }
        }
    }

    public function setVerifiedAtAttribute($value) {
        if ($value) {
            $this->attributes['verified_at'] = Carbon::now();
        } else {
            $this->attributes['verified_at'] = null;
        }
    }

    public function getLetterAttribute() {
        return Str::upper(Str::substr($this->first_name, 0, 1));
    }

}
