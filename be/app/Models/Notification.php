<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'type',
        'title',
        'message',
        'data',
        'scheduled_at',
        'read_at',
        'is_sent',
    ];

    protected $casts = [
        'data' => 'array',
        'scheduled_at' => 'datetime',
        'read_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
