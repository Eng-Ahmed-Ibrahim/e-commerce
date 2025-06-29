<?php

namespace App\Models;

use App\Models\User;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table="carts";
    protected $guarded=[];
    public function product()
    {
        return $this->belongsTo(Products::class,"product_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
