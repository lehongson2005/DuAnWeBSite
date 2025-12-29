<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Event;
use App\Models\User;


class EventMedia extends Model
{
    use SoftDeletes;

    protected $table = 'event_media';

    protected $fillable = [
        'event_id',
        'file_path',
        'file_type',
        'is_main',
        'sort_order',
        'created_by',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
