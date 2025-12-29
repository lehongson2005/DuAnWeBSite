<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CalendarRegion extends Model
{
    protected $fillable = [
        'code',
        'name',
        'timezone',
        'is_active',
    ];
}
