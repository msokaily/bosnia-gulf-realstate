<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contactus extends Model
{
    use SoftDeletes;
    protected $table = 'contact_us';
    protected $hidden = ['updated_at','deleted_at'];
    protected $fillable = ['full_name','email', 'mobile', 'title', 'details', 'user_id', 'is_read', 'is_replied', 'type'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}



