<?php

use App\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\BatchClass;
use App\Helpers\ImageHelper;
use DB;

function timeSlotDuration(){
  $configs = DB::table('configs')->where('key','slot_duration')->first();
  return $configs->value;
}

function weekStartDay(){
  $configs = DB::table('configs')->where('key','week_start_day')->first();
  return $configs->value;
}

function businessHours($day){
  $hours = DB::table('business_week_days')->where('id',$day)->first();
  return [ $hours->open_time , $hours->close_time ];
}

function timeSlots($date = null){
         if($date){
           $dayofweek        =  date('w',strtotime($date));
         }else{
           $dayofweek        =  date('w');
         }

         if($dayofweek == '0'){
            $dayofweek = 7;
         }

         $businessHours    = businessHours($dayofweek);
        return SplitTime(timeFormate($businessHours[0]),timeFormate($businessHours[1]),timeSlotDuration());
    }

function services($id = array()){
  
  $ids = array();
  
  if(gettype($id) != 'array')
      array_push($ids,$id);
    else
      $ids = $id;

	$Services = Service::select('id','service_name' , 'service_description' , 'service_color' , 'service_cost' , 'service_image' , 'is_active' , 'created_at')
                ->where(function($query) use ($ids){
                      if($ids){
                      	 if(isset($ids) && !empty($ids)){
                      	 	 $query->whereIn('id',$ids);
                      	 }
                      }
                })
	            ->paginate();

       if($Services->toArray()){
         
         foreach($Services as $key => $value){
            $Services[$key]->id = $value->id;
            $Services[$key]->service_cost  = number_format($value->service_cost,2);
            $Services[$key]->currency = env('CURRENCY');
            $Services[$key]->service_image = ImageHelper::get(ImageHelper::$serviceImagePath,$value->service_image);
         }

         return $Services;

      }

	  return array();
}

function classes($where = array()){
	
	$where = (object) $where;

	$Class = BatchClass::select('id','class_name' , 'class_description' , 'class_cost' , 'allotted_seats' , 'class_start_date' , 'class_end_date' , 'class_start_time' , 'class_end_time' ,'class_description' , 'is_active' , 'created_at')
	       ->where(function($query) use ($where){
                      if($where){
                      	 if(isset($where->class_id) && !empty($where->class_id)){
                      	 	 $query->where('id',$where->class_id);
                      	 }
                      }
            })->paginate();
    
    if($Class->toArray()){
    	foreach($Class as $key => $class){
    		$Class[$key]->currency = env('CURRENCY');
    	}
    	return $Class;
    }
        return array();

}

function products($where = array()) {
	
	  $where = (object) $where;

	  $Products = Product::select('id','product_name' , 'product_cost' , 'product_description' , 'product_image' , 'is_active' , 'created_at')->where(function($query) use ($where){
                      if($where){
                      	 if(isset($where->product_id) && !empty($where->product_id)){
                      	 	 $query->where('id',$where->product_id);
                      	 }
                      }
            })->paginate();

       if($Products->toArray()){
         
         foreach($Products as $key => $value){
         	$Products[$key]->currency      = env('CURRENCY');
            $Products[$key]->product_image = ImageHelper::get(ImageHelper::$productImagePath,$value->product_image);
         }
         return $Products;
       }

       return false;
}

function cartItems($where = array()){

   $items = DB::table('cart_items')
                ->join('cart','cart_items.cart_id','=','cart.id')
                ->selectRaw('GROUP_CONCAT(item_id) as item_ids')
                ->where(function($query) use ($where){
                   if($where){
                      if(isset($where->user_id) && !empty($where->user_id)){
                       $query->where('cart.user_id',$where->user_id);
                      }

                      if(isset($where->item_type) && !empty($where->item_type)){
                       $query->where('cart_items.item_type',$where->item_type);
                      }
                   }
                })->get();

    if($items->toArray()){
       return explode(',', $items[0]->item_ids );
    }

   return array();

}


?>