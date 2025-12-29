<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'status', 'provider_name', 'provider_id'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}

