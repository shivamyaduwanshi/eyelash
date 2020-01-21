<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\ImageHelper;
use App\Models\Appointment;
use App\Models\Product;
use App\Models\BatchClass;
use App\Http\Controllers\PaymentController;
use Auth;
use DB;
use Validator;
use Srmklive\PayPal\Services\ExpressCheckout;
use Session;

class HomeController extends Controller
{
     public function index(Request $request) {
        $data['products'] = products();
        $data['services'] = services();
        $data['classes']  = classes();
    	  return view('frontend.index',compact('data'));
     }

     public function myAccount(Request $request) {

        $data['user'] = User::find(auth::id());

        $orders = DB::table('orders')
            ->select('orders.id as order_id','products.product_name','orders.total_cost','products.product_image','product_description','orders.name','orders.email','orders.phone','orders.address','orders.payment_status', 'products.product_cost' ,'orders.payment_mode','orders.created_at')
            ->leftJoin('users' , 'orders.user_id' , '=' , 'users.id')
            ->leftJoin('products' , 'orders.product_id' , '=' , 'products.id')
            ->where('user_id',auth::id())
            ->orderBy('orders.id','desc')
            ->get();

        $appointments = DB::table('appointments')
            ->select('appointments.id as appointment_id','appointments.appointment_date','appointments.time_slot','appointments.total_cost','appointments.paid_amount','appointments.payment_status','appointments.payment_mode','appointments.name','appointments.email','appointments.phone','appointments.address','review_ratings.rating','review_ratings.review','appointments.created_at')
            ->leftJoin('appointment_services' , 'appointments.id' , '=' , 'appointment_services.appointment_id')
            ->leftJoin('users' , 'appointments.user_id' , '=' , 'users.id')
            ->leftJoin('review_ratings' , 'appointments.id' , '=' , 'review_ratings.appointment_id')
            ->where('appointments.user_id',auth::id())
            ->orderBy('appointments.id','desc')
            ->get();

        $myClasses = DB::table('class_booking')
            ->select('class_booking.id as booking_id' , 'classes.class_name','classes.class_description','class_booking.total_cost','classes.class_start_date','classes.class_end_date','classes.class_start_time','classes.class_end_time','class_booking.name','class_booking.phone','class_booking.address','class_booking.email','class_booking.payment_status','class_booking.payment_mode','class_booking.created_at')
            ->leftJoin('users' , 'class_booking.user_id' , '=' , 'users.id')
            ->leftJoin('classes' , 'class_booking.class_id' , '=' , 'classes.id')
            ->where('user_id',auth::id())
            ->orderBy('class_booking.id','desc')
            ->get();

        if($orders->toArray()){
           foreach ($orders as $key => $value) {
             $value->payment_status = $value->payment_status ? 'Paid' : 'Due';              
             $value->total_cost     = env('CURRENCY').' '.$value->total_cost;  
             $orders[$key]->product_image = ImageHelper::get(ImageHelper::$productImagePath,$value->product_image);
             $orders[$key]->json_data = json_encode($value);           
           }          
        }

         if($myClasses->toArray()){
           foreach ($myClasses as $key => $value) {
             $value->payment_status    = $value->payment_status ? 'Paid' : 'Due';
             $value->class_start_date  = date('d-M-y' , strtotime($value->class_start_date));
             $value->class_end_date    = date('d-M-y' , strtotime($value->class_end_date));
             $value->class_start_time  = date('h : s A' , strtotime($value->class_start_time));
             $value->class_end_time    = date('h : s A' , strtotime($value->class_end_time));

             $myClasses[$key]->class_start_date  = date('d-M-y' , strtotime($value->class_start_date));
             $myClasses[$key]->class_end_date    = date('d-M-y' , strtotime($value->class_end_date));
             $myClasses[$key]->class_start_time  = date('h : s A' , strtotime($value->class_start_time));
             $myClasses[$key]->class_end_time    = date('h : s A' , strtotime($value->class_end_time));
             $myClasses[$key]->total_cost        = env('CURRENCY').' '.$value->total_cost;
           
             $myClasses[$key]->class_image = '';
             $myClasses[$key]->json_data = json_encode($value);           
           }          
         }

         if($appointments->toArray()){
            foreach ($appointments as $key => $value) {

              $services = DB::table('appointment_services')
                               ->select('service_name','service_price')
                               ->where('appointment_id',$value->appointment_id)
                               ->get();
              $serviceName = array();
              if($services){
                foreach ($services as $key2 => $value2) {
                   array_push($serviceName,$value2->service_name);
                }
                $serviceName = implode(',', $serviceName);
              }
              $appointments[$key]->total_cost       = env('CURRENCY').' '.$value->total_cost;
              $appointments[$key]->service_names    = $serviceName;
              $appointments[$key]->appointment_booking_id   = generateOrderID($value->created_at,$value->appointment_id);
              $appointments[$key]->payment_status   = $value->payment_status ? 'Paid' : 'Due';
              $appointments[$key]->appointment_date = date('Y-M-d',strtotime($value->appointment_date));
              $appointments[$key]->service_name = $services;
              $appointments[$key]->json_data = json_encode($value);
            }
         }

        // return $appointments;

        $data['orders']         = $orders ?? array();
        $data['classes']        = $myClasses ?? array();
        $data['appointments'] = $appointments ?? array();
        $data['user']->user_image = ImageHelper::get(ImageHelper::$userImagePath,$data['user']->user_image);
    	 return view('frontend.my_account',compact('data'));
     }
      
     public function contactUs(Request $request) {
        $data['products'] = products();
        $data['services'] = services();
        $data['classes']  = classes();
      	return view('frontend.index',compact('data'));
    	  return view('frontend.contact_us');
     }
     
     /**
     *  Product Module
     */

     public function products(Request $request) {
        $data['products'] = products();
    	  return view('frontend.products',compact('data'));
     }

     public function productDetails(Request $request,$id) {
        $data['products'] = products(['product_id' => decrypt($id)]);
      	$data['product']  = $data['products'][0];
        $data['products'] = products();
        return view('frontend.product_details',compact('data'));
     }
     
     public function productPayment(Request $request){

        $data = array();
        $data['product_id'] = decrypt($request->product_id);
        $product = Product::find($data['product_id']);
        $data['totalCast']  = $product->product_cost;
        $data['product_id'] = $product->id;

        if(auth::check()){
          $data['name']        = auth::user()->user_name;
          $data['email']       = auth::user()->email;
          $data['phone']       = auth::user()->phone;
          $data['address']     = auth::user()->address;
        }else{
          $data['name']        = '';
          $data['email']       = '';
          $data['phone']       = '';
          $data['address']     = '';
        }
        return view('frontend.product_payment',compact('data'));
     }

     public function productOrder(Request $request){
       
       if(auth::check()){
            $user_id = auth::id();
            $userType = '1';
       }else{
            $user_id = clientIP();
            $userType = '0';
       }

       $input = $request->all();

       $rules = [
           'product_id' => 'required',
           'name'  => 'required',
           'email' => 'required|email',
           'phone' => 'required',
           'payment_mode' => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

        $insertData = $input;
        $product_id = decrypt($input['product_id']); 

        $product = Product::find($product_id);

        $insertData = array();
        $insertData['product_id']   = $product_id;
        $insertData['product_name'] = $product->product_name;
        $insertData['name']         = $input['name'];
        $insertData['email']        = $input['email'];
        $insertData['phone']        = $input['phone'];
        $insertData['address']      = $input['address'] ?? null;
        $insertData['payment_mode'] = $input['payment_mode'];
        $insertData['user_type']    = $userType;
        $insertData['total_cost']   = $product->product_cost;

        if(auth::check()){
            $insertData['user_id'] = auth::id();
        }

        if($input['payment_mode'] == 'card'){

        if(empty($input['nonce'])){
          return ['status' => false , 'message' => 'Something went wrong please try letter'];
        }

        $BrainTree = new PaymentController();
        $response  = $BrainTree->makePayment([
         'amount' => $product->product_cost,
         'nonce'  => $input['nonce'],
        ]);

          if(!$response['status']){
           return ['status' => false , 'message' => 'Something went wrong please try letter'];
          }else{
            $input['transaction_id'] = DB::table('transactions')->insertGetId([
              'transaction_id'  => $response['data']['id'],
              'user_id'         => $user_id,
              'payment_mode'    => 'card',
              'transaction_for' => 'product',
              'card_type'       => $response['data']['card_type'],
              'currency'        => $response['data']['currency_iso_Code'],
              'amount'          => $response['data']['amount'],
              'transaction_status' => '1'
            ]);
             $insertData['payment_status'] = '1';
          }

        }
        if($input['payment_mode'] == 'paypal'){
          $insertData['payment_status'] = '1';
        }
        $orderId   =  DB::table('orders')->insertGetId($insertData);
        if($input['payment_mode'] == 'paypal' || $input['payment_mode'] == 'card'){
          DB::table('transactions')->where('id',$input['transaction_id'])->update(['item_id' => $orderId]);
        }
        $orderId   = generateOrderID(date('Y-m-d') , $orderId);
        if($input['payment_mode'] == 'paypal'){
           return redirect()->route('confirm.order',['id' => $orderId ]);
        }
        return ['status' => true , 'message' => 'Order placed successfully' , 'id' => $orderId ];
     }

     /**
     *  Service Module
     */

     public function services(Request $request) {
        $data['services'] = services();
    	  return view('frontend.services',compact('data'));
     }

     public function serviceDetails(Request $request) {
         
         if(auth::check())
            $user_id = auth::id();
         else
            $user_id = clientIP();

          if($request->id)
            $service_id = decrypt($request->id);
          else
            $service_id = null;

          if($service_id){

            $where = array(
            'user_id'   => $user_id,
            'item_type' => 'Service',
            'item_id'   => $service_id,
            );

            $isServiceExist    = DB::table('cart')
                                ->join('cart_items' , 'cart.id' , '=' , 'cart_items.cart_id')
                                ->where($where)->count();

            if($isServiceExist <= 0 ){
              $insertData = array(
                'user_id'   => $user_id,
                'item_type' => 'Service',
                'item_id'   => $service_id,
              );

              $isCartExist = DB::table('cart')->where(['user_id' => $user_id])->first();
              if($isCartExist){
                $cartID = $isCartExist->id;
              }else{
                $cartID = DB::table('cart')->insertGetId(['user_id' => $user_id]);
              }
              $insertData['cart_id'] = $cartID;
              unset($insertData['user_id']);
              DB::table('cart_items')->insert($insertData);
            }

          }

         $data['totalCartServices'] = DB::table('cart_items')
                                      ->join('cart' , 'cart_items.cart_id' , '=' , 'cart.id')
                                      ->where(['user_id' => $user_id , 'item_type' => 'Service'])
                                      ->count();
         $where = array(
            'user_id'   => $user_id,
            'item_type' => 'Service',
         );                           

         $data['cart_services'] = services(cartItems($where));
         $data['services']      = services();
         $data['timeSlots']     = timeSlots();
         if($request->addMore){
             return back();
         }
    	   return view('frontend.service_details',compact('data'));
     }

     public function getTimeSlots(Request $request){
       $date  = $request->date;
       $data['timeSlots'] = timeSlots($date);
       return view('frontend.time_slots',compact('data'));
     }

     public function removeItem(Request $request){

         if(auth::check())
            $user_id = auth::id();
         else
           $user_id = clientIP();

          $where = array(
             'user_id'   => $user_id,
             'item_type' => $request->item_type,
             'item_id'   => decrypt($request->item_id),
           );

          $cartData = DB::table('cart')->where('user_id',$user_id)->first();
          $cartId   = $cartData->id;
          unset($where['user_id']);
          $where['cart_id'] = $cartId;
          DB::table('cart_items')->where($where)->delete();
          return redirect()->route('service.details');
     }

     public function servicePayment(Request $request) {
        
        if(auth::check())
            $user_id = auth::id();
        else
            $user_id = clientIP();

        $appointmentDate = $request->appointment_date;
        $timeSlot       = $request->time_slot;

        $metaData = array(
           'appointment_date' => $appointmentDate,
           'time_slot'       => $timeSlot,
        );

        DB::table('cart')->where('user_id',$user_id)->update(['meta_data' => serialize($metaData) ]);
       
        $where = array(
           'user_id'   => $user_id,
           'item_type' => 'Service',
         );

        $data['cart_services'] = services(cartItems($where));
        $totalCast = 0;
        if($data['cart_services']){
            foreach ($data['cart_services'] as $key => $value) {
                $totalCast += $value->service_cost;
            }
        }else{
            return back();
        }
        $data['totalCast'] = $totalCast;
        return view('frontend.service_payment',compact('data'));
     }

     public function bookAppointment(Request $request){
       return $request;
     }

     public function confirmOrder(Request $request) {
        $data['id'] = $request->id;
        return view('frontend.confirm_order',compact('data'));
     }

     public function confirmAppointment(Request $request) {
        $data['id'] = $request->id;
        return view('frontend.confirm_appointment',compact('data'));
     }

      public function procedePayment(Request $request){
      
       if(auth::check()){
            $user_id = auth::id();
       }else{
            $user_id = clientIP();
       }

         $input = $request->all();
       
         $rules = [
           'name'  => 'required',
           'email' => 'required|email',
           'phone' => 'required',
           'payment_type' => 'required',
           'payment_mode' => 'required',
         ];

         if($input['payment_type'] == '2'){
            $rules['partial_amount'] = 'required';
         }     

         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
         }

       $cart = DB::table('cart')->where('user_id' , $user_id )->first();
       $metaData = $cart->meta_data;
       $metaData = unserialize($metaData);              
       $metaData = array_merge($metaData,$input);
       DB::table('cart')->where('user_id' , $user_id )->update(['meta_data' => serialize($metaData)]);
       $cart = DB::table('cart')->where('user_id' , $user_id )->first();
       $totalCast = DB::table('cart_items')->where('cart_id',$cart->id)->join('services','cart_items.item_id' , '=' , 'services.id')->where('cart_items.item_type','Service')->sum('service_cost');
       $metaData = $cart->meta_data;
       $metaData = unserialize($metaData);
       $timeSlot = $metaData['time_slot'];
      
       $paidCast = '0';
       if($input['payment_type'] == '2'){
          if($input['partial_amount'] >= $totalCast){
             $input['payment_type'] = '1';
          }
          $paidCast = $input['partial_amount'];
       }

       if($input['payment_type'] == '1'){
          $paidCast = $totalCast;
       }

       if($input['payment_mode'] == 'card'){
         
         if(empty($input['nonce'])){
            return ['status' => false , 'message' => 'Something went wrong please try letter'];
         }
         
         $BrainTree = new PaymentController();
         $response  = $BrainTree->makePayment([
           'amount' => $paidCast,
           'nonce'  => $input['nonce'],
         ]);

         if(!$response['status']){
          return ['status' => false , 'message' => 'Something went wrong please try letter'];
         }else{
          $transaction_id =  DB::table('transactions')->insertGetId([
            'transaction_id'  => $response['data']['id'],
            'user_id'         => $user_id,
            'payment_mode'    => 'card',
            'transaction_for' => 'appointment',
            'card_type'       => $response['data']['card_type'],
            'currency'        => $response['data']['currency_iso_Code'],
            'amount'          => $response['data']['amount'],
            'transaction_status' => '1'
          ]);
          $input['transaction_id'] = $transaction_id;
         }

       }

       $insertData = array(
                      'appointment_by' => 'user',
                      'appointment_date' => date('Y-m-d',strtotime($metaData['appointment_date'])),
                      'name'    => $metaData['name'],
                      'email'   => $metaData['email'],
                      'phone'   => $metaData['phone'],
                      'address' => $metaData['address'],
                      'payment_type'  => $input['payment_type'],
                      'payment_mode'  => $input['payment_mode'],
                      'total_cost'    => $totalCast,
                      'paid_amount'   => $paidCast,
                      'time_slot'     => $timeSlot,
                    );

       if($input['payment_type'] == '1'){
         $insertData['payment_status'] = '1';
       }

       if(auth::check()){
           $insertData['user_type'] = '1';
           $insertData['user_id']   = auth::id();
       }
      
       DB::beginTransaction();
       try {
         
       $appointmentId = DB::table('appointments')->insertGetId($insertData);

       $servicesInsertData  = array();

        $where = array(
           'user_id'   => $user_id,
           'item_type' => 'Service',
         );

        $cart_services = services(cartItems($where));
       
        $serviceId = null;
        
        foreach ($cart_services as $key => $value) {
          array_push($servicesInsertData,[ 'appointment_id' => $appointmentId , 'service_id' => $value->id , 'service_price' => $value->service_cost , 'service_name' => $value->service_name ]);
            $totalCast += $value->service_cost;
        }

           DB::table('appointment_services')->insert($servicesInsertData);
           DB::table('cart')->where('user_id',$user_id)->delete();
           if($input['payment_type'] == '2'){
            DB::table('appointment_partial_payment')->insert(['appointment_id'  => $appointmentId , 'partial_amount' => $paidCast]);
           }
           $appointment_id = generateOrderID(date('Y-m-d') , $appointmentId);

            if($input['payment_mode'] == 'card' || $input['payment_mode'] == 'paypal'){
               DB::table('transactions')->where('id',$input['transaction_id'])->update(['item_id' => $appointmentId]);
            }

           DB::commit();
           if($input['payment_mode'] == 'paypal'){
               return redirect()->route('confirm.order',['id'=>$appointmentId]);
           }
           return ['status' => true , 'message' => 'Appointment booked successfully' , 'id' => $appointment_id ];
        } catch (\Exception $e) {
          DB::rollback();
          return $e->getMessage();
          return ['status' => false , 'message' => 'Failed to book appointment' ];
       }
    }

    /**
    * Class Module
    */

    public function classes(Request $request) {
        $data['classes']  = classes();
      	return view('frontend.classes',compact('data'));
    }

    public function classDetails(Request $request,$id) {
        $data['classes'] = classes(['class_id' => decrypt($id)]);
        $data['class']   = $data['classes'][0];
        $data['classes'] = classes();
    	  return view('frontend.class_details',compact('data'));
    }

    public function classPayment(Request $request){
        $data = array();
        $data['class_id'] = decrypt($request->id);
        $class = BatchClass::find($data['class_id']);
        $data['class']     = $class;
        $data['totalCast']  = $class->class_cost;
         if(auth::check()){
          $data['name']        = auth::user()->user_name;
          $data['email']       = auth::user()->email;
          $data['phone']       = auth::user()->phone;
          $data['address']     = auth::user()->address;
        }else{
          $data['name']        = '';
          $data['email']       = '';
          $data['phone']       = '';
          $data['address']     = '';
        }
        return view('frontend.classes_payment',compact('data'));
    }

    public function classBook(Request $request){
       
       if(auth::check()){
          $user_id = auth::id();
          $user_type = '1';
       }else{
          $user_id = clientIP();
          $user_type = '0';
       }

       $input = $request->all();

       $rules = [
         'class_id'     => 'required',
         'name'         => 'required',
         'email'        => 'required|email',
         'phone'        => 'required',
         'payment_type' => 'required',
         'payment_mode' => 'required',
       ];
       
       if($input['payment_mode'] != 'cod'){
         if($input['payment_type'] == '2'){
           $rules['partial_amount'] = 'required';
         }       
       }

       $validator = Validator::make($request->all(), $rules);

       $classId = decrypt($input['class_id']);

         if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
         }

         $class = BatchClass::find($classId);
         
         if($input['payment_type'] == '2'){
            if($input['partial_amount'] >= $class->class_cost){
                $input['payment_type'] = '1';
                $input['partial_amount'] = $class->class_cost;
            }
         }else{
            $input['partial_amount'] = $class->class_cost;
         }

         if($input['payment_mode'] == 'card'){
         
         if(empty($input['nonce'])){
            return ['status' => false , 'message' => 'Something went wrong please try letter'];
         }
         
         $BrainTree = new PaymentController();
         $response  = $BrainTree->makePayment([
           'amount' => $input['partial_amount'],
           'nonce'  => $input['nonce'],
         ]);

         if(!$response['status']){ 
          return ['status' => false , 'message' => 'Something went wrong please try letter'];
         }else{
            $transaction_id =  DB::table('transactions')->insertGetId([
              'transaction_id'  => $response['data']['id'],
              'user_id'         => $user_id,
              'payment_mode'    => 'card',
              'transaction_for' => 'class',
              'card_type'       => $response['data']['card_type'],
              'currency'        => $response['data']['currency_iso_Code'],
              'amount'          => $response['data']['amount'],
              'transaction_status' => '1'
             ]);
             $input['transaction_id'] = $transaction_id;
             $input['payment_status'] = '1';
         }
       }

       if($input['payment_mode'] == 'paypal'){
          $input['payment_status'] = '1';
       }


          DB::beginTransaction();

          try {
            $insertData = array();
            $insertData['class_id']    = $class->id;
            $insertData['class_name']  = $class->class_name;
            $insertData['total_cost']  = $class->class_cost;
            $insertData['paid_amount'] = $input['partial_amount'];
            $insertData['name']  = $input['name'];
            $insertData['email'] = $input['email'];
            $insertData['phone'] = $input['phone'];
            $insertData['payment_type'] = $input['payment_type'];
            $insertData['payment_mode'] = $input['payment_mode'];
            $insertData['address']      = $input['address'] ?? null;
            $insertData['phone'] = $input['phone'];
            $insertData['user_type'] = $user_type;

            if($input['payment_type'] == '1'){
               $insertData['payment_status'] = '1';
            }


            if(auth::check()){
              $insertData['user_id'] = auth::id();
            }

            $insertGetId  = DB::table('class_booking')->insert($insertData);

            $id = generateOrderID(date('Y-m-d') , $insertGetId);

            if($input['payment_mode'] != 'cod'){
              if($input['payment_type'] == '2'){
                DB::table('class_booking_partial_payment')
                ->insert(['booking_id' => $insertGetId , 'partial_amount' => $input['partial_amount']]);
              }
            }

             if($input['payment_mode'] == 'card' || $input['payment_mode'] == 'paypal'){
                if($input['payment_mode'] == 'paypal' || $input['payment_mode'] == 'card'){
                  DB::table('transactions')->where('id',$input['transaction_id'])->update(['item_id' => $insertGetId]);
                }
             }
            DB::commit();
             if($input['payment_mode'] == 'paypal'){
              return redirect()->route('confirm.order',['id' => $insertGetId ]);
             }
            return ['status' => true , 'message' => 'Book class successfully' , 'id' => $id ];
         } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
            return ['status' => false , 'message' => 'Failed to book class' ];
         }
    }

    public function classConfirm(Request $request){
       $data['id'] = $request->id;
       return view('frontend.confirm_class_booking',compact('data'));
    }

    public function transactionFailed(Request $request){
       return view('frontend.transaction_failed');
    }

    public function paypalPayment(Request $request) {
        
         $input = $request->all();

        $rules = [
         'name'         => 'required',
         'email'        => 'required|email',
         'phone'        => 'required',
         'payment_for'  => 'required',
       ];

       if($input['payment_for'] == 'product'){
           $rules['product_id'] = 'required';
       }

       if($input['payment_for'] == 'class'){
           $rules['class_id'] = 'required';
           $rules['payment_type'] = 'required';
           if($input['payment_for'] == '2'){
              $rules['partial_amount'] = 'required';
           }
       }

       if($input['payment_for'] == 'class' || $input['payment_for'] == 'appointment' ){
         $rules['payment_type'] = 'required';
       }

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
         $errors =  $validator->errors()->all();
         return response(['status' => false , 'message' => $errors[0]]);              
       }

       if($input['payment_for'] == 'product'){
         $id = decrypt($input['product_id']);
         $product = DB::table('products')->where('id',$id)->first();
         $product_name = $product->product_name;
         $product_cost = $product->product_cost;
         $product_description = $product->product_description;

         $data = [];
         $data['items'] =[
            [
            'name'  => $product_name,
            'price' => $product_cost,
            'desc'  => $product_description,
            'qty'   => 1
           ]
         ];
         
         $input['payment_mode'] = 'paypal';
         Session::push('data',$input);

         $data['invoice_id'] = 1;
         $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
         $data['return_url'] = url('/paypal/success?data=');
         $data['cancel_url'] = url('paypal/cancel');
         $data['total'] = $product_cost;
         $data['shipping_discount'] = 0;
       }

        if($input['payment_for'] == 'class'){
         $id = decrypt($input['class_id']);
         $class = DB::table('classes')->where('id',$id)->first();
         $class_name = $class->class_name;
         $class_cost = $class->class_cost;
         $class_description = $class->class_description;

         if($input['partial_amount'] > $class_cost){
             $totalCast  = $class_cost;
         }else{
             $totalCast  = $class_cost;
         }

         $data = [];
         $data['items'] =[
            [
            'name'  => $class_name,
            'price' => $class_cost,
            'desc'  => $class_description,
            'qty'   => 1
           ]
         ];
         
         $input['payment_mode'] = 'paypal';
         Session::push('data',$input);

         $data['invoice_id'] = 1;
         $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
         $data['return_url'] = url('/paypal/success?data=');
         $data['cancel_url'] = url('paypal/cancel');
         $data['total'] = $totalCast;
         $data['shipping_discount'] = 0;
       }
        if($input['payment_for'] == 'appointment'){
        $data = [];
        $data['items'] = array();
        $totalCast = 0;
        $services = DB::table('cart_items')
                         ->select('services.service_name','services.service_cost','services.service_description')
                         ->join('cart' , 'cart_items.cart_id' , '=' , 'cart.id')
                         ->join('services' , 'cart_items.item_id' , '=' , 'services.id')
                         ->where(['user_id' => auth::id() , 'item_type' => 'Service'])
                         ->get();

         if($services->toArray()){
              foreach ($services as $key => $value) {
                $temp = array();
                $temp['name']  = $value->service_name;
                $temp['price'] = $value->service_cost;
                $temp['desc']  = $value->service_description;
                $temp['qty']   = 1;
                $totalCast += $value->service_cost;
                array_push($data['items'],$temp);
              }
         }else{
            return 'Hello';
         }

         if($input['partial_amount'] > $totalCast){
             $totalCast  = $totalCast;
         }else{
             $totalCast  = $totalCast;
         }

         $input['payment_mode'] = 'paypal';
         Session::push('data',$input);

         $data['invoice_id'] = 1;
         $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
         $data['return_url'] = url('/paypal/success?data=');
         $data['cancel_url'] = url('paypal/cancel');
         $data['total'] = $totalCast;
         $data['shipping_discount'] = 0;
       }

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
       return redirect($response['paypal_link']);
    }

    public function paypalSuccess(Request $request){
        $input    = $request->all();
        $sessionData = Session::get('data');
       // Session::flush('data');
        $input = array_merge( $input , $sessionData[0] );
        $token    = $input['token'];
        $provider = new ExpressCheckout;  
        $response = $provider->getExpressCheckoutDetails($token);
        if($response['ACK'] == 'Success'){
           $insertData['transaction_id']  = $response['PAYERID'];
           $insertData['user_id']         = auth::id();
           $insertData['payment_mode']    = 'paypal';
           $insertData['currency']        = $response['CURRENCYCODE'];
           $insertData['amount']             = $response['AMT'];
           $insertData['transaction_status'] = '1';
          if($input['payment_for'] == 'product'){
             $insertData['transaction_for'] = 'product';
             $transaction_id = DB::table('transactions')->insertGetId($insertData);
             $input['transaction_id'] = $transaction_id;
             $input['payment_mode'] = 'paypal';
             return redirect()->route('product.order',$input);
          }
           if($input['payment_for'] == 'class'){
             $insertData['transaction_for'] = 'class';
             $transaction_id = DB::table('transactions')->insertGetId($insertData);
             $input['transaction_id'] = $transaction_id;
             $input['payment_mode'] = 'paypal';
             return redirect()->route('class.paypal.book',$input);
          }
           if($input['payment_for'] == 'appointment'){
             $insertData['transaction_for'] = 'appointment';
             $transaction_id = DB::table('transactions')->insertGetId($insertData);
             $input['transaction_id'] = $transaction_id;
             $input['payment_mode'] = 'paypal';
             return redirect()->route('procede.payment',$input);
           }
        }
    }

    public function paypalCancel(Request $request){
        return $request->all();
    }

    public function giveReviewRating(Request $request){
       
       $input = $request->all();

       $rules = [
         'appId'   => 'required',
         'rating'  => 'required',
         'review'  => 'required',
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
         $errors =  $validator->errors()->all();
         return response(['status' => false , 'message' => $errors[0]]);              
       }

       if(DB::table('review_ratings')->where('user_id',auth::id())->where('appointment_id',$input['appId'])->first() ){
         $status = 1;
         DB::table('review_ratings')
                        ->where(['user_id' => auth::id() , 'appointment_id' => $input['appId']])
                        ->update(['review' => $input['review'] , 'rating' => $input['rating']]);
       }else{
        $status = DB::table('review_ratings')
                        ->insert(['user_id' => auth::id() , 'appointment_id' => $input['appId'] , 'review' => $input['review'] , 'rating' => $input['rating']]);
       }

      if($status){
         return ['status' => true , 'message' => 'Thank you for giving rating & review'];
      }
         return ['status' => false , 'message' => 'Failed to give rating & review'];

    }

}
