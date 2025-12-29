<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'full_name', 'avatar', 'phone',
        'address', 'gender', 'birthday', 'bio',
        'preferences', 'settings', 'locale', 'timezone'
    ];

    protected $casts = [
        'preferences' => 'array',
        'settings' => 'array',
        'birthday' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}