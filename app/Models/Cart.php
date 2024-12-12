<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
