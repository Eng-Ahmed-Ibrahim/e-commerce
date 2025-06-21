<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";
    protected $guarded=[];
    public function products()
    {
        return $this->hasMany(Products::class,"category_id");
    }
    public function sub_categories()
    {
        return $this->hasMany(Subcategory::class,"category_id");
    }
    public function features()
    {
        return $this->hasMany(CategoriesFeatures::class,"category_id");
    }
    
}
