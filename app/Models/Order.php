<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
   use SoftDeletes;

   public function product(){
   	 return $this->belongsTo('App\Models\Product','product_id','id');
   }

   public function getUserIdAttribute($value){
   	 if(is_null($value))
   	 	  return '';
   }

   public function getUpdatedAtAttribute($value){
   	 if(is_null($value))
   	 	  return '';
   }

   public function getDeletedAtAttribute($value){
   	 if(is_null($value))
   	 	  return '';
   }

}
