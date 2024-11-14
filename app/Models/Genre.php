<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $guarded = false;
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
