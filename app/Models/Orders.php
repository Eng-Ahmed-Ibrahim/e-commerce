<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
