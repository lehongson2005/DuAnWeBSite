<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'color_code', 'status'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
