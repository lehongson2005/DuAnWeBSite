<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'region_id',
        'created_by',
        'title',
        'slug',
        'summary',
        'content',
        'date_type',
        'day',
        'month',
        'is_leap_month',
        'priority',
        'view_count',
        'status',
    ];

    protected $casts = [
        'is_leap_month' => 'boolean',
        'view_count' => 'integer',
        'priority' => 'integer',
    ];

    // Quan hệ
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function region()
    {
        return $this->belongsTo(CalendarRegion::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}