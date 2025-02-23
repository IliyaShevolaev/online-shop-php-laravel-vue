<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Filterable;

    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->image_path);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_favorites');
    }
}
