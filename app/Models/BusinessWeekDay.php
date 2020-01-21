<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessWeekDay extends Model
{
   use SoftDeletes;

   protected $table = 'business_week_days';
   
}
