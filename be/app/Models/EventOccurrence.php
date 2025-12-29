<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventOccurrence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'event_id',
        'year',
        'solar_date',
        'lunar_day',
        'lunar_month',
        'is_leap_month',
        'timezone',
    ];

    protected $casts = [
        'solar_date' => 'date',
        'is_leap_month' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}