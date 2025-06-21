<?php

namespace App\Models;

use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $table="products";
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo(Category::class,"category_id");
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class,"product_id");
    }
    public function colors()
    {
        return $this->hasMany(ProductColors::class,"product_id");
    }

    protected $casts = [
        'colors' => 'array',
    ];
}
