<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerServiceSurvey extends Model
{
    use HasFactory;
    protected $table="customer_service_surveys";
    protected $guarded=[];
}
