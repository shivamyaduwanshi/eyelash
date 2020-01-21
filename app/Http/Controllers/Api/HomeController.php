<?php

namespace App\Http\Controllers\Api;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\NotifyMail;
use Mail;
use Response;
use DB;
use App\Helpers\NotificationHelper;
use App\Models\Service;
use App\Models\BusinessWeekDay;
use App\Models\Config;
use App\Models\BatchClass;
use App\Models\Appointment;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Address;
use App\Models\Order;
use DateTime;

class HomeController extends Controller
{
    /**
    *  Application Setting Api's 
    *********************/

     public function blockTimeSlot(Request $request){
   
       $input = $request->
all();

       $rules = [
          'date'       => 'required',
          'note'       => 'required',
          'time_slots' => 'required', 
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
         $errors =  $validator->errors()->all();
         return response(['status' => false , 'message' => $errors[0]]);              
       }

       $insertData['date'] = date('Y-m-d',strtotime($input['date']));
       $insertData['note'] = $input['note'];

       $timeSlots = explode(',', $input['time_slots'] );

       $insertData = array();

       foreach ($timeSlots as $key => $value) {
          $temp = array();
          $temp['date'] = date('Y-m-d',strtotime($input['date']));
          $temp['note'] = $input['note'];
          $temp['time_slot'] = $value;
          array_push($insertData, $temp);
       }

       $BlockTimeSlot = DB::table('time_slot_blockers')->insert($insertData);

       if($BlockTimeSlot){
        return ['status'=>true,'message'=>'Block time slot successfully'];
       }
        return ['status'=>false,'message'=>'Failed to block time slot'];
     }

     public function updateBlockTimeSlot(Request $request){
   
       $input = $request->all();

       $rules = [
          'date'       => 'required',
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
         $errors =  $validator->errors()->all();
         return response(['status' => false , 'message' => $errors[0]]);              
       }

       $insertData['date'] = date('Y-m-d',strtotime($input['date']));
       $insertData['note'] = $input['note'];
       
       if($input['time_slots']){

       $timeSlots = explode(',', $input['time_slots'] );

       $insertData = array();
       
       foreach ($timeSlots as $key => $value) {
          $temp = array();
          $temp['date'] = date('Y-m-d',strtotime($input['date']));
          $temp['note'] = $input['note'];
          $temp['time_slot'] = $value;
          array_push($insertData, $temp);
       }
        DB::beginTransaction();
       try {
         DB::table('time_slot_blockers')->where('date',$input['date'])->delete();
         DB::table('time_slot_blockers')->insert($insertData);
         DB::commit();
         return ['status'=>true,'message'=>'Block time slot updated successfully'];
       } catch ( \Exception $e) {
        DB::rollback(); 
         return ['status'=>false,'message'=>'Failed to block time slot update'];        
        }
      }else{
         DB::table('time_slot_blockers')->where('date',$input['date'])->delete();
         return ['status'=>true,'message'=>'Block time slot updated successfully'];
      }

     }

    function updateBanner(Request $request){
       
         try {

         $input = $request->all();
         $input['banner_id'] = '1';

         $rules = [
            'heading_text'      => 'required',
            'sub_heading_text'  => 'required', 
            'banner_image'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Banner = Banner::find($input['banner_id']);
            
            $Banner->heading_text     =  $input['heading_text'];
            $Banner->sub_heading_text = $input['sub_heading_text'];

            if(isset($input['banner_image']) && !empty($input['banner_image'])){
              $fileName = ImageHelper::upload(ImageHelper::$uploadBannerPath,$input['banner_image']);
              $Banner->banner_image        = $fileName ?? Null;
            }

            if($Banner->update()){
              return response(['status' => true , 'message' => 'Banner updated successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to update banner' ]);
        
      } catch ( \Exception $e) {
            return response(['status' => false , 'message' => 'Somethign went wrong,Please try later' ]);
      }
    }

    public function getBanner(){
       $banner = Banner::select('banner_image' , 'heading_text' , 'sub_heading_text')->first();
       $banner->banner_image = ImageHelper::get(ImageHelper::$uploadBannerPath,$banner->banner_image);
       return ['status'=>true , 'message' => 'Record found' , 'data'  => $banner ];
    }

    function updateAddress(Request $request){
       
         try {

         $input = $request->all();
         $input['id'] = '1';

         $rules = [
            'lat'      => 'required',
            'lng'      => 'required', 
            'address'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Address = Address::find($input['id']);
            
            $Address->lat      =  $input['lat'];
            $Address->lng      = $input['lng'];
            $Address->address  = $input['address'];

            if($Address->update()){
              return response(['status' => true , 'message' => 'Address updated successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to update address' ]);
        
      } catch ( \Exception $e) {
            return response(['status' => false , 'message' => 'Somethign went wrong,Please try later' ]);
      }
    }

    public function getAddress(){
       $Address = Address::select('lat' , 'lng' , 'address')->first();
       return ['status'=>true , 'message' => 'Record found' , 'data'  => $Address ];
    }

    public function setBusinessDayHours(Request $request){
     $weekDays = $request->all();
     $weekDays = $weekDays['week_days'];
     $weekDays = json_decode($weekDays);
       foreach($weekDays as $key => $value){
            $value = (Array) $value;
            $BusinessWeekDay = BusinessWeekDay::find($value['id']);
            $BusinessWeekDay->open_time       = date('H:i',strtotime($value['from']));
            $BusinessWeekDay->close_time      = date('H:i',strtotime($value['to']));
            $BusinessWeekDay->is_open         = $value['enable'];
            $BusinessWeekDay->update();
       }
       return response(['status' => true , 'message' => 'Successfully updated hours']);
    }

    public function setTimeSlot(Request $request){
 
       $input = $request->all();
 
        $rules = [
            'time'  => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }
        
        $configs = DB::table('configs')->where('key','slot_duration')->update(['value'=>$input['time']]); DB::table('configs')->where('time');

       return response(['status' => true , 'message' => 'Time sloat updated successfully' ]);

    }

    public function viewTimeSlot(){
       return response(['status' => true , 'message' => 'Record found' , 'data' => timeSlotDuration() ]);
    }

    public function getBusinessDays(Request $request){
       $BusinessWeekDay = BusinessWeekDay::select('id' , 'open_time' , 'close_time' , 'is_open' )->get();
       if($BusinessWeekDay->toArray()){
         return response(['status' => true , 'message' => 'Record found' , 'data' => $BusinessWeekDay ]);
       }
         return response(['status' => false , 'message' => 'Record not found' ]);
    }

    public function setWeekStartDay(Request $request){

        $input = $request->all();
 
        $rules = [
            'day_id'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $configs =  Config::where('key','week_start_day')->first();

            if($configs->where('key','week_start_day')->update(['value' => $input['day_id'] ])){
              return response(['status' => true , 'message' => 'Week start day updated successfully']);
            }
              return response(['status' => false , 'message' => 'Failed to update start week day']);

    }

    /**
    *  Service Api's 
    *********************/

    public function getServices(Request $request){
       
       try{

       $Services = Service::select('id','service_name' , 'service_description' , 'service_color' , 'service_cost' , 'service_image' , 'is_active' , 'created_at')->get();

       if($Services->toArray()){
         
         foreach($Services as $key => $value){
            $Services[$key]->id = $value->id;
            $Services[$key]->service_cost = number_format($value->service_cost,2);
            $Services[$key]->service_image = ImageHelper::get(ImageHelper::$serviceImagePath,$value->service_image);
         }

         return response(['status' => true , 'message' => 'Record found' , 'data' => $Services ]);
       }
         return response(['status' => false , 'message' => 'Record not found' ]);
       } catch ( \Exception $e) {
          return response(['status' => false , 'message' => 'Somethign went wrong,Please try later' ]);
       }
    }

    public function getServiceDetails(Request $request){

     try{

           $input = $request->all();

            $rules = [
                'service_id'                => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
            }

           $Service = Service::select('id','service_name' , 'service_description' , 'service_color' , 'service_cost' , 'service_image' , 'is_active' , 'created_at')->where('id',$input['service_id'])->first();

           if($Service){
             $Service->service_cost  = number_format($Service->service_cost,2);
             $Service->service_image = ImageHelper::get(ImageHelper::$serviceImagePath,$Service->service_image);

             return response(['status' => true , 'message' => 'Record found' , 'data' => $Service ]);
           }
             return response(['status' => false , 'message' => 'Record not found' ]);

       } catch ( \Exception $e) {
          return response(['status' => false , 'message' => 'Somethign went wrong,Please try later' ]);
       }

    }

    public function createService(Request $request){

        try{

       $input = $request->all();
                  
        $rules = [
            'service_name' => 'required|unique:services,service_name,NULL,id,deleted_at,NULL',
            'service_cost'  => 'required',
            'service_description'   => 'required',
            'service_color'         => 'required',
            'service_image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Service = new Service;
            
            $Service->service_name   = $input['service_name'];
            $Service->service_cost    = $input['service_cost'];
            $Service->service_description    = $input['service_description'];
            $Service->service_color        = $input['service_color'];
            $fileName = ImageHelper::upload(ImageHelper::$serviceImagePath,$input['service_image']);
            $Service->service_image        = $fileName ?? Null;
            if($Service->save()){
              return response(['status' => true , 'message' => 'Service added Successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to add service' ]);
       } catch ( \Exception $e) {
          return response(['status' => false , 'message' => 'Somethign went wrong,Please try later' ]);
      }

    }

    public function updateService(Request $request){

      try {
        $input = $request->all();

        $rules = [
            'service_id'    => 'required', 
            'service_name' => 'required|unique:services,service_name,'.$input['service_id'].',id,deleted_at,NULL',
            'service_cost'  => 'required',
            'service_description'   => 'required',
            'service_color'         => 'required',
            'service_image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Service = Service::find($input['service_id']);
            
            $Service->service_name   = $input['service_name'];
            $Service->service_cost    = $input['service_cost'];
            $Service->service_description    = $input['service_description'];
            $Service->service_color        = $input['service_color'];
            if(isset($input['service_image']) && !empty($service_image)){
              $fileName = ImageHelper::upload(ImageHelper::$serviceImagePath,$input['service_image']);
              $Service->service_image        = $fileName ?? Null;
            }
            if($Service->update()){
              return response(['status' => true , 'message' => 'Service updated Successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to update service' ]);
        
      } catch ( \Exception $e) {
            return response(['status' => false , 'message' => 'Somethign went wrong,Please try later' ]);
      }
      
    }

    public function deleteService(Request $request){
      
      $input = $request->all();

        $rules = [
            'service_id'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Service = Service::find($input['service_id']);

            if($Service->delete()){
               return response(['status' => true , 'message' => 'Service deleted Successfully' ]);
            }

              return response(['status' => false , 'message' => 'Failed to delete service' ]);
    }


    /**
    *  Class Api's 
    *********************/
    
    public function createClass(Request $request){
        
        $input = $request->all();
                  
        $rules = [
            'class_name'        => 'required|unique:classes,class_name,NULL,id,deleted_at,NULL',
            'class_cost'        => 'required',
            'allotted_seats'    => 'required',
            'class_start_date'  => 'required',
            'class_end_date'    => 'required',
            'class_start_time'  => 'required',
            'class_end_time'    => 'required',
            'class_description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }
           $class_start_date  = $input['class_start_date'] .' '. $input['class_start_time']; 
           $class_end_date    = $input['class_end_date'] .' '. $input['class_end_time'];
           $class_start_date  = date('Y-m-d H:i',strtotime($class_start_date));
           $class_end_date    = date('Y-m-d H:i',strtotime($class_end_date));

            if(strtotime($class_start_date) > strtotime($class_end_date)){
               return [ 'status' => false , 'message' => 'End date time can not be less than open date time' ];
            }

            $Class = new BatchClass;
            $Class->class_name       = $input['class_name'];
            $Class->class_cost       = $input['class_cost'];
            $Class->allotted_seats   = $input['allotted_seats'];
            $Class->class_start_date = date('Y-m-d',strtotime($input['class_start_date']));
            $Class->class_end_date   = date('Y-m-d',strtotime($input['class_end_date']));
            $Class->class_start_time = date('H:i',strtotime($input['class_start_time']));
            $Class->class_end_time   = date('H:i',strtotime($input['class_end_time']));
            $Class->class_description= $input['class_description'];
            $Class->is_active        = isset($input['is_active']) && $input['is_active'] == '0' ? '0' :'1';

            if($Class->save()){
              return response(['status' => true , 'message' => 'Class Created Successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to add class' ]);
    }

    public function updateClass(Request $request){
        
        $input = $request->all();

        $id    = isset($input['class_id']) ? $input['class_id'] :  Null;

        $rules = [
            'class_id'          => 'required',
            'class_name'        => 'required|unique:classes,class_name,'.$id.',id,deleted_at,NULL',
            'class_cost'        => 'required',
            'allotted_seats'    => 'required',
            'class_start_date'  => 'required',
            'class_end_date'    => 'required',
            'class_start_time'  => 'required',
            'class_end_time'    => 'required',
            'class_description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Class = BatchClass::find($input['class_id']);
            $Class->class_name       = $input['class_name'];
            $Class->class_cost       = $input['class_cost'];
            $Class->allotted_seats   = $input['allotted_seats'];
            $Class->class_start_date = $input['class_start_date'];
            $Class->class_end_date   = $input['class_end_date'];
            $Class->class_start_time = $input['class_start_time'];
            $Class->class_end_time   = $input['class_end_time'];
            $Class->class_description= $input['class_description'];
            if(isset($input['is_active']))
            $Class->is_active        = isset($input['is_active']) && $input['is_active'] == '1' ? '1' :'0';

            if($Class->update()){
              return response(['status' => true , 'message' => 'Class Updated Successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to update class' ]);
    }

    public function deleteClass(Request $request){

       $input = $request->all();

        $rules = [
            'class_id'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Class = BatchClass::findOrFail($input['class_id']);

            if($Class->delete()){
               return response(['status' => true , 'message' => 'Class deleted Successfully' ]);
            }

              return response(['status' => false , 'message' => 'Failed to delete class' ]);
    }

    public function getClasses(Request $request){
     
       $Class = BatchClass::select('id','class_name' , 'class_description' , 'class_cost' , 'allotted_seats' , 'class_start_date' , 'class_end_date' , 'class_start_time' , 'class_end_time' ,'class_description' , 'is_active' , 'created_at')->get();

       if($Class->toArray()){
         return response(['status' => true , 'message' => 'Record found' , 'data' => $Class ]);
       }
         return response(['status' => false , 'message' => 'Record not found' ]);
    }

    public function getClassDetails(Request $request){

        $input = $request->all();

        $rules = [
            'class_id'                => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }
     
       $Class = BatchClass::select('id','class_name' , 'class_description' , 'class_cost' , 'allotted_seats' , 'class_start_date' , 'class_end_date' , 'class_start_time' , 'class_end_time' ,'class_description' , 'is_active' , 'created_at')->where('id',$input['class_id'])->first();

       if($Class){
         return response(['status' => true , 'message' => 'Record found' , 'data' => $Class ]);
       }
         return response(['status' => false , 'message' => 'Record not found' ]);

    }

public function getProducts(Request $request){
       
       $Products = Product::select('id','product_name' , 'product_cost' , 'product_description' , 'product_image' , 'is_active' , 'created_at')->get();

       if($Products->toArray()){
         
         foreach($Products as $key => $value){
            $Products[$key]->product_image = ImageHelper::get(ImageHelper::$productImagePath,$value->product_image);
         }

         return response(['status' => true , 'message' => 'Record found' , 'data' => $Products ]);
       }
         return response(['status' => false , 'message' => 'Record not found' ]);
    }

    public function getProductDetails(Request $request){

       $input = $request->all();

        $rules = [
            'product_id'                => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

       $Product = Product::select('id','product_name' , 'product_description' , 'product_cost' , 'product_image'  , 'is_active' , 'created_at')->where('id',$input['product_id'])->first();

       if($Product){
         
         $Product->product_image = ImageHelper::get(ImageHelper::$productImagePath,$Product->product_image);

         return response(['status' => true , 'message' => 'Record found' , 'data' => $Product ]);
       }
         return response(['status' => false , 'message' => 'Record not found' ]);

    }

    public function createProduct(Request $request){
       $input = $request->all();
        $rules = [
            'product_name'        => 'required|unique:products,product_name,NULL,id,deleted_at,NULL',
            'product_cost'        => 'required',
            'product_description' => 'required',
            'product_image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Product = new Product;
            $Product->product_name         = $input['product_name'];
            $Product->product_cost         = $input['product_cost'];
            $Product->product_description  = $input['product_description'];
            $Product->is_active            = isset($input['is_active']) && $input['is_active'] == '0' ? '0' :'1';
            $fileName = ImageHelper::upload(ImageHelper::$productImagePath,$input['product_image']);
            $Product->product_image        = $fileName ?? Null;
            if($Product->save()){
              return response(['status' => true , 'message' => 'Product added Successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to add product' ]);
    }

    public function updateProduct(Request $request){
         

        $input = $request->all();

        $id    = isset($input['product_id']) ? $input['product_id'] : null; 

        $rules = [
            'product_id'          => 'required',
            'product_name'        => 'required|unique:products,product_name,'.$id.',id,deleted_at,NULL',
            'product_cost'        => 'required',
            'product_description' => 'required',
            'product_image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
            }

            $Product = Product::find($id);
            $Product->product_name         = $input['product_name'];
            $Product->product_cost         = $input['product_cost'];
            $Product->product_description  = $input['product_description'];
            $Product->is_active            = isset($input['is_active']) && $input['is_active'] == '0' ? '0' :'1';
            if(isset($input['product_image']) && !is_null($input['product_image']))
            $fileName = ImageHelper::upload(ImageHelper::$productImagePath,$input['product_image']);
            $Product->product_image        = $fileName ?? Null;
            // 
            if($Product->save()){
              return response(['status' => true , 'message' => 'Product updated Successfully' ]);
            }
              return response(['status' => false , 'message' => 'Failed to update product' ]);
    }

    public function deleteProduct(Request $request){
      
        $input = $request->all();

        $rules = [
            'product_id'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $Product = Product::find($input['product_id']);

            if($Product->delete()){
               return response(['status' => true , 'message' => 'Service deleted Successfully' ]);
            }

              return response(['status' => false , 'message' => 'Failed to delete service' ]);
    }
    
    public function getTimeSlot(Request $request){
        
        $input = $request->all();

        $rules = [
            'date'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

        $date = $input['date'];

        $data['timeSlots'] = timeSlots($date);
        
        $sloat = array();
        foreach ($data['timeSlots'] as $key => $value) {
           $temp = array();
           $temp['time']       = $value;
           $temp['is_booked']  = '0';
           $temp['is_blocked'] = '0';
           array_push($sloat,$temp);
        }
        return ['status' => true , 'message' => 'Record found' , 'data' => $sloat];
    }

    public function bookAppointment(Request $request){
     
        $input = $request->all();

        $rules = [
          'appointment_date' => 'required|date',
          'time_slot'  => 'required',
          'service_ids' => 'required',
          'name'        => 'required',
          'email'       => 'required',
          'phone'       => 'required',
         // 'address'     => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

        $servicesIds = explode(',', $input['service_ids']);

        $services = DB::table('services')->whereIn('id',$servicesIds)->get();

        
        $serviceTotalCost = 0;
        $serviceInserData = array();
        $sloatInserData   = array();

        DB::beginTransaction();

         try {
         
        $appointmentData = [
            'appointment_by' => 'admin',
            'appointment_date' => date('Y-m-d',strtotime($input['appointment_date'])),
            'name'    => $input['name'],
            'email'   => $input['email'],
            'phone'   => $input['phone'],
            'address' => $input['address'],
            'time_slot' => $input['time_slot'],
        ];

        if($input['repeat_type']){
           $appointmentData['repeat_type'] = $input['repeat_type'];
        }

        $appointmentId = DB::table('appointments')->insertGetId($appointmentData);

         foreach ($services as $key => $value) {
           $temp['appointment_id'] = $appointmentId;
           $temp['service_id']     = $value->id;
           $temp['service_name']   = $value->service_name;
           $temp['service_price']  = $value->service_cost;
           $serviceTotalCost += $value->service_cost;
          }

        /* foreach ($timeSlots as $key => $value) {
           $temp['appointment_id'] = $appointmentId;
           $temp['time_slot']      = $value;
         } */ 

        //  DB::table('appointment_times')->insert($sloatInserData);
          DB::table('appointment_services')->insert($serviceInserData);
          $input['id'] = $appointmentId;
          DB::commit();
          return ['status' => true , 'message' => 'Appointment booked successfully' , 'data' => $input ];
          } catch (\Exception $e) {
           DB::rollback();
          return ['status' => false , 'message' => 'Failed to book appointment' ];
         }

    }

    public function cancelAppointment(Request $request){

       $input = $request->all();

       $rules = [
         'appointment_id'     => 'required',
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
         $errors =  $validator->errors()->all();
         return response(['status' => false , 'message' => $errors[0]]);              
       }

       $Appointment = Appointment::find($input['appointment_id']);

       $Appointment->appointment_status = '2';

       if($Appointment->update()){
         return ['status' => false , 'message' => 'Appointment cancelled successfully'];
       }else{
         return ['status' => false , 'message' => 'Failed to cancel appointment'];
       }

    }
    
    public function completeAppointment(Request $request){

       $input = $request->all();

       $rules = [
         'appointment_id'     => 'required',
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
         $errors =  $validator->errors()->all();
         return response(['status' => false , 'message' => $errors[0]]);              
       }

       $Appointment = Appointment::find($input['appointment_id']);

       $Appointment->appointment_status = '1';

       if($Appointment->update()){
         return ['status' => false , 'message' => 'Appointment completed successfully'];
       }else{
         return ['status' => false , 'message' => 'Failed to complete appointment'];
       }

    }

    public function getAppointment(Request $request){
      
      $totaIncome = '0';

      $apppointments = DB::table('appointments')
                           ->select('appointments.*')
                           ->selectRaw('GROUP_CONCAT(appointment_services.service_id) as service_ids')
                           ->leftJoin('appointment_services' , 'appointments.id' , '=' , 'appointment_services.appointment_id')
                           ->groupBy('appointments.id')
                           ->get();

       $classes = DB::table('class_booking')
                        ->select('class_booking.*','classes.class_start_time','classes.class_end_time')
                        ->join('classes','class_booking.class_id', '=', 'classes.id')
                        ->get();

      $appData = array();
      if($apppointments->toArray()){
        foreach ($apppointments as $key => $value) {
           $temp = array();
           $services = DB::table('appointment_services')->join('services','appointment_services.service_id' , '=' , 'services.id')->select('services.service_name','appointment_services.service_price','services.service_color')->where('appointment_id',$value->id)->get();
           
           if($services->toArray()){
                $temp['service_name']  = $services[0]->service_name;
                $temp['service_price'] = $services[0]->service_price;
                $temp['service_color'] = $services[0]->service_color;
                $temp['service_count'] = (String) count($services);
           }else{
                $temp['service_name']  = '';
                $temp['service_count'] = '0';
                $temp['service_color'] = '';
                $temp['service_price'] = '';
           }

           $temp['id']   = $value->id;
           $temp['type'] = 'appointment';
           $temp['user_name'] = $value->name;
           $temp['date']      = date('D d M',strtotime($value->appointment_date));
           $temp['time']      = $value->time_slot;
           $temp['class_name'] = '';
           $temp['slot_blocked'] = '0';
           $temp['total_cost']  = $value->total_cost;
           $temp['paid_amount'] = $value->paid_amount;
           $serviceIds = explode(',', $value->service_ids);
           $temp['services'] = DB::table('services')->select('id','service_name','service_description','service_cost','service_color')->whereIn('id',$serviceIds)->groupBy('services.id')->get();
           array_push($appData,$temp);
        }
      }
      
      $classData = array();
      if($classes->toArray()){
          foreach ($classes as $key => $value) {
             $temp = array();
             $temp['service_name']  = '';
             $temp['service_count'] = '0';
             $temp['service_color'] = '';
             $temp['service_price'] = '';
             $temp['id']   = $value->id;
             $temp['type'] = 'class';
             $temp['user_name'] = $value->name;
             $temp['date'] = date('D d M',strtotime($value->created_at));
             $temp['time'] = getTimeDiff($value->class_start_time,$value->class_end_time);
             $temp['class_name'] = $value->class_name;
             $temp['slot_blocked']   = '0';
             $temp['total_cost']  = $value->total_cost;
             $temp['paid_amount'] = $value->paid_amount;
             $temp['services']  = array();
             array_push($classData, $temp);
          }
      }

      $data = array_merge($appData,$classData);

        $data = $this->groupBy('date',$data);
        $newData = array();
        foreach ($data as $key => $value) {
          $temp = array();
          $temp['date'] = $key;
          $temp['data'] = $value;
          array_push($newData, $temp);
        }
        return ['satus' => true , 'message' => 'Record found' , 'total_income' => $totaIncome ,'data' => $newData];
    }

    public function addNotes(Request $request){

         $input = $request->all();

         $rules = [
            'appointment_id'     => 'required',
            'image1'             => 'required',
            'image2'             => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

        $fileName1 = null;
        $fileName2 = null;

        if(isset($input['image1']) && !empty($input['image1'])){
              $fileName1 = ImageHelper::upload(ImageHelper::$eyesImagePath,$input['image1']);
        }

        if(isset($input['image2']) && !empty($input['image2'])){
              $fileName2 = ImageHelper::upload(ImageHelper::$eyesImagePath,$input['image2']);
        }

        $notes = array();
        
        if($fileName1)
           array_push($notes,$fileName1);

        if($fileName2)
           array_push($notes,$fileName2);
        
        $insertData = array();
        foreach ($notes as $key => $value) {
            $temp = array();
            $temp['appointment_id']   = $input['appointment_id'];
            $temp['appointment_note'] = $value;
            array_push($insertData, $temp);
        }

        if($insertData){
           DB::table('appointment_notes')->insert($insertData);
           return ['status' => false , 'message' => 'Notes added successfully'];
        }else{
          return ['status' => false , 'message' => 'Notes added failed'];
        }

    }

    public function uploadVideo(Request $request){
    
         try {
         $input = $request->all();

         $rules = [
            'video'      => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

         if(isset($input['video']) && !empty($input['video'])){
              $fileName = ImageHelper::upload(ImageHelper::$uploadBannerPath,$input['video']);
         }

         $url = ImageHelper::get(ImageHelper::$uploadBannerPath,$fileName);

         return response(['status' => true , 'message' => 'Video uploaded successfully' , 'url' => $url ]);

        } catch ( \Exception $e) {
            return response(['status' => false , 'message' => 'Somethign went wrong,Please try later' ]);
       }
    }

    public function getOrders(Request $request){
      
      $orders = Order::get();

      $data = array();
      if($orders->toArray()){
        foreach ($orders as $key => $value) {
          $temp = array();
          $temp['order_id']   =  $value->id;
          $temp['order_date'] =  date('d M y,D',strtotime($value->created_at));
          $temp['order_time'] =  'You have received an order from '.$value->name. ' for EyeLash Extensions';
          array_push($data,$temp);
        }
        $data = $this->groupBy('order_date',$data);
        $newData = array();
        foreach ($data as $key => $value) {
          $temp = array();
          $temp['date'] = $key;
          $temp['order_data'] = $value;
          array_push($newData, $temp);
        }
       return ['status'=>true,'message'=>'Record found','data' => $newData];
      }

      return ['status'=>false,'message'=>'Record not found'];

    }

     public function getOrderDetails(Request $request){

         $input = $request->all();

         $rules = [
            'order_id' => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

       $order = Order::select('orders.*','products.product_image')
                       ->join('products','orders.product_id' , '=' , 'products.id' )
                       ->where('orders.id',$input['order_id'])
                       ->first();
       if($order){
        $order->product_image = ImageHelper::get(ImageHelper::$productImagePath,$order->product_image);
       return ['status'=>true,'message'=>'Record found','data' => $order ];
      }
      return ['status'=>false,'message'=>'Record not found'];
     }

     function groupBy($key, $data) {
        $result = array();
        foreach($data as $val) {
            if(array_key_exists($key, $val)){
                 $result[$val[$key]][] = $val;
            }else{
                $result[""][] = $val;
            }
        }
       return $result;
     }

     public function appointmentDetails(Request $request){

         $input = $request->all();

         $rules = [
            'appointment_id' => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }
         
          $apppointment = DB::table('appointments')
                       ->select('appointments.*')
                       ->selectRaw('GROUP_CONCAT(appointment_services.service_id) as service_ids')
                       ->leftJoin('appointment_services' , 'appointments.id' , '=' , 'appointment_services.appointment_id')
                       ->groupBy('appointments.id')
                       ->where('id',$input['appointment_id'])
                       ->first();

          if($apppointment){
            $data = array();
            $data['id']           = $apppointment->id;
            $data['booking_id']   = generateOrderID($apppointment->created_at,$apppointment->id);
            $data['date']         = date('D M d y',strtotime($apppointment->appointment_date));
            $data['time_slot']    = $apppointment->time_slot;
            $data['name']         = $apppointment->name;
            $data['email']        = $apppointment->email;
            $data['phone']        = $apppointment->phone;
            $data['address']      = $apppointment->address;
            $data['total_cost']   = $apppointment->total_cost;
            $data['paid_cost']    = '34';
            $data['remaing_cost'] = '20';
            $data['currency']     = env('CURRENCY');
           return ['satus' => true , 'message' => 'Recound found' , 'data' => $data ];
          }

          return ['satus' => true , 'message' => 'Recound not found'];

     }

      public function getReviewRating(Request $request){

      $ratingReviews = DB::table('review_ratings as rr')->select('rr.id','rr.rating' , 'rr.review' , 'rr.created_at as review_date' , 'u.user_name' , 'u.user_image' , 'rr.status')->join('users as u','rr.user_id' , '=' , 'u.id')->whereNull('rr.deleted_at')->get();
      
      if($ratingReviews->toArray()){
          foreach ($ratingReviews as $key => $value) {
            $ratingReviews[$key]->user_image  = ImageHelper::get(ImageHelper::$userImagePath,$value->user_image);
            $ratingReviews[$key]->review_date = date('d-M-y',strtotime($value->review_date));
          }

          return ['status' => true , 'message' => 'Record found' , 'data' => $ratingReviews ];
      }

      return ['status' => true , 'message' => 'Record not found' ];

     }

     public function approvedReview(Request $request){

         $input = $request->all();

         $rules = [
            'id' => 'required',
         ];

         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
         }

         $status = DB::table('review_ratings')->where('id',$input['id'])->update(['status' => '1']);
         
         if($status){
           return ['status' => true , 'message' => 'Successfully approved review'];
         }else{
           return ['status' => false , 'message' => 'failed to approve review'];
         }


     }

     public function declineReview(Request $request){

         $input = $request->all();

         $rules = [
            'id' => 'required',
         ];

         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
         }

         $status = DB::table('review_ratings')
                      ->where('id',$input['id'])
                      ->update(['status' => '2' , 'deleted_at' => date('Y-m-d H:i:s')]);
         
         if($status){
           return ['status' => true , 'message' => 'Successfully declined review'];
         }else{
           return ['status' => false , 'message' => 'failed to decline review'];
         }
     }

     public function getClassStudent(Request $request){
        
        $input = $request->all();

        $rules = [
          'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
         }

        $bookings = DB::table('class_booking as cd')
            ->select('cd.id','cd.class_id' , 'cd.name' , 'u.user_image' , 'cd.total_cost' , 'cd.paid_amount' )
            ->join('classes as c','cd.class_id' , '=' , 'c.id')
            ->leftJoin('users as u','cd.class_id' , '=' , 'u.id')
            ->where('cd.class_id',$input['id'])
            ->where('cd.booking_status', '!=' ,'2')
            ->get();

       if($bookings->toArray()){

         foreach ($bookings as $key => $value) {
           $bookings[$key]->user_image = ImageHelper::get(ImageHelper::$userImagePath,$value->user_image);
           $bookings[$key]->remaing_amount = $value->total_cost - $value->paid_amount;
         }

       return ['status' => true , 'message' => 'Record found' , 'data' => $bookings ];
       }
        return ['status' => false , 'message' => 'Record not found' ];
     }

     public function getClassStudentDetails(Request $request){

        $input = $request->all();

        $rules = [
          'booking_id'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
         }

        $booking = DB::table('class_booking as cd')
            ->select('cd.class_id' , 'cd.name' , 'cd.email' , 'cd.phone' , 'cd.address' , 'cd.booking_status' ,'u.user_image' , 'cd.total_cost' , 'cd.paid_amount' )
            ->join('classes as c','cd.class_id' , '=' , 'c.id')
            ->leftJoin('users as u','cd.class_id' , '=' , 'u.id')
            ->where('cd.id',$input['booking_id'])
            ->first();

       if($booking){
          
           $booking->address = $booking->address ?? '';
           $booking->user_image = ImageHelper::get(ImageHelper::$userImagePath,$booking->user_image);
           $booking->remaing_amount = $booking->total_cost - $booking->paid_amount;

       return ['status' => true , 'message' => 'Record found' , 'data' => $booking ];
       }
        return ['status' => false , 'message' => 'Record not found' ];

     }

     public function getHistory(){

         $totaIncome = 0;
         
         $apppointments = DB::table('appointments')
                           ->select('appointments.*')
                           ->selectRaw('GROUP_CONCAT(appointment_services.service_id) as service_ids')
                           ->leftJoin('appointment_services' , 'appointments.id' , '=' , 'appointment_services.appointment_id')
                           ->groupBy('appointments.id')
                           ->where('appointments.payment_status' , '1')
                           ->get();

       $classes = DB::table('class_booking')
                        ->select('class_booking.*','classes.class_start_time','classes.class_end_time')
                        ->join('classes','class_booking.class_id', '=', 'classes.id')
                        ->where('class_booking.payment_status' , '1')
                        ->get();

       $appData = array();
      if($apppointments->toArray()){
        foreach ($apppointments as $key => $value) {
           $temp = array();
           $temp['id']   = $value->id;
           $temp['type'] = 'appointment';
           $temp['user_name'] = $value->name;
           $temp['date']      = date('D d M',strtotime($value->appointment_date));
           $temp['time']      = $value->time_slot;
           $temp['class_name'] = '';
           $temp['slot_blocked'] = '0';
           $temp['total_cost']  = $value->total_cost;
           $temp['paid_amount'] = $value->paid_amount;
           $serviceIds = explode(',', $value->service_ids);
           $temp['services'] = DB::table('services')->select('id','service_name','service_description','service_cost','service_color')->whereIn('id',$serviceIds)->groupBy('services.id')->get();
           $totaIncome += $value->total_cost;
           array_push($appData,$temp);
        }
      }
      
      $classData = array();
      if($classes->toArray()){
          foreach ($classes as $key => $value) {
             $temp = array();
             $temp['id']   = $value->id;
             $temp['type'] = 'class';
             $temp['user_name'] = $value->name;
             $temp['date'] = date('D d M',strtotime($value->created_at));
             $temp['time'] = getTimeDiff($value->class_start_time,$value->class_end_time);
             $temp['class_name'] = $value->class_name;
             $temp['slot_blocked']   = '0';
             $temp['total_cost']  = $value->total_cost;
             $temp['paid_amount'] = $value->paid_amount;
             $temp['services']  = array();
             $totaIncome += $value->total_cost;
             array_push($classData, $temp);
          }
      }

      $data = array_merge($appData,$classData);

        $data = $this->groupBy('date',$data);
        $newData = array();
        foreach ($data as $key => $value) {
          $temp = array();
          $temp['date'] = $key;
          $temp['data'] = $value;
          array_push($newData, $temp);
        }


        return ['satus' => true , 'message' => 'Record found' , 'total_income' => $totaIncome ,'data' => $newData];
       
     }

      public function getTotalIncome(Request $request){

         $startDate = $request->start_date ? date('Y-m-d',strtotime($request->start_date)) : null;
         $endDate   = $request->end_date   ? date('Y-m-d',strtotime($request->end_date))   : null;

         $totaIncome = 0;

         $apppointments = DB::table('appointments')
                           ->select('appointments.*')
                           ->selectRaw('GROUP_CONCAT(appointment_services.service_id) as service_ids')
                           ->leftJoin('appointment_services' , 'appointments.id' , '=' , 'appointment_services.appointment_id')
                           ->groupBy('appointments.id')
                           ->where('appointments.payment_status' , '1')
                           ->where(function($query) use ($startDate,$endDate){
                              
                               if($startDate){
                                 $query->whereDate('appointments.created_at' , '>=' , date('Y-m-d' , strtotime($startDate)) );
                               }
  
                               if($endDate){
                                 $query->whereDate('appointments.created_at' , '<=' , date('Y-m-d' , strtotime($endDate)) );
                               }

                           })
                           ->get();

       $classes = DB::table('class_booking')
                        ->select('class_booking.*','classes.class_start_time','classes.class_end_time')
                        ->join('classes','class_booking.class_id', '=', 'classes.id')
                        ->where('class_booking.payment_status' , '1')
                        ->where(function($query) use ($startDate,$endDate){
                              
                               if($startDate){
                                 $query->whereDate('class_booking.created_at' , '>=' , date('Y-m-d' , strtotime($startDate)) );
                               }
  
                               if($endDate){
                                 $query->whereDate('class_booking.created_at' , '<=' , date('Y-m-d' , strtotime($endDate)) );
                               }

                         })
                        ->get();

       $appData = array();
      if($apppointments->toArray()){
        foreach ($apppointments as $key => $value) {
           $temp = array();
           $temp['id']   = $value->id;
           $temp['type'] = 'appointment';
           $temp['user_name'] = $value->name;
           $temp['date']      = date('D d M',strtotime($value->appointment_date));
           $temp['time']      = $value->time_slot;
           $temp['class_name'] = '';
           $temp['slot_blocked'] = '0';
           $temp['total_cost']  = $value->total_cost;
           $temp['paid_amount'] = $value->paid_amount;
           $serviceIds = explode(',', $value->service_ids);
           $temp['services'] = DB::table('services')->select('id','service_name','service_description','service_cost','service_color')->whereIn('id',$serviceIds)->groupBy('services.id')->get();
           $totaIncome += $value->total_cost;
           array_push($appData,$temp);
        }
      }
      
      $classData = array();
      if($classes->toArray()){
          foreach ($classes as $key => $value) {
             $temp = array();
             $temp['id']   = $value->id;
             $temp['type'] = 'class';
             $temp['user_name'] = $value->name;
             $temp['date'] = date('D d M',strtotime($value->created_at));
             $temp['time'] = getTimeDiff($value->class_start_time,$value->class_end_time);
             $temp['class_name'] = $value->class_name;
             $temp['slot_blocked']   = '0';
             $temp['total_cost']  = $value->total_cost;
             $temp['paid_amount'] = $value->paid_amount;
             $temp['services']  = array();
             $totaIncome += $value->total_cost;
             array_push($classData, $temp);
          }
      }

        $data = array_merge($appData,$classData);
        return ['satus' => true , 'message' => 'Record found' , 'total_income' => $totaIncome ,'data' => $data];
       
     }

     public function dismissStudentClass(Request $request){
        
        $input = $request->all();

        $rules = [
        'booking_id'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
        $errors =  $validator->errors()->all();
        return response(['status' => false , 'message' => $errors[0]]);              
        }

          $booking = DB::table('class_booking')
                     ->where('id',$input['booking_id'])
                     ->update(['booking_status' => '2']);

          if($booking){
             return ['status' => true , 'message' => 'Dismiss class successfully'];
          }
             return ['status' => false , 'message' => 'Failed to dismiss class'];
     }


}
