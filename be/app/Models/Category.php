<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'icon',
        'status', 'sort_order'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
