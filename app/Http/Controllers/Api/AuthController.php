<?php

namespace App\Http\Controllers\Api;

use Hash;
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

class AuthController extends Controller
{
    protected $guard = 'web';
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
 
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request) {
        
       $input = $request->all();
                
        $rules = [
           'email'            => 'required',
           'password'         => 'min:6|required',
           'device_type'      => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

        if(!auth()->guard($this->guard)->attempt(array('email' => $input['email'] , 'password' => $input['password']))) {
           return response(['status' => false , 'message' => 'Invalid credientials' ]);       
        } 
            $User = User::find(auth()->guard($this->guard)->id());

            $User->device_type  = $input['device_type'] ?? NULL;
            $User->device_token = $input['device_token'] ?? NULL;
            $User->update();

            $data['user_id']           = $User->id;
            $data['first_name']        = $User->first_name ?? '';
            $data['last_name']         = $User->last_name  ?? '';
            $data['user_name']         = $User->user_name  ?? '';
            $data['user_image']        = ImageHelper::get(ImageHelper::$userImagePath,$User->user_image);
            $data['email']             = $User->email ?? '';
            $data['phone']             = $User->phone ?? '';

           return response(['status' => true , 'message' => 'Successfully login' , 'data' => $data ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request) {

           $input = $request->all();

                  
           $rules = [
              'user_id'            => 'required',
           ];

           $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
               $errors =  $validator->errors()->all();
               return response(['status' => false , 'message' => $errors[0]]);              
            } 

            $user_id = $input['user_id'];

            $User = User::find($user_id);

            $data['user_id']           = $User->id;
            $data['first_name']        = $User->first_name ?? '';
            $data['last_name']         = $User->last_name ?? '';
            $data['user_name']              = $User->user_name ?? '';
            $data['user_image']        =ImageHelper::get(ImageHelper::$userImagePath,$User->user_image);
            $data['email']             = $User->email ?? '';
            $data['phone']             = $User->phone ?? '';

            return response([
               'status'  => true,
               'message' => 'Record found',
               'data'    => $data
            ]);
            
    }

      /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateProfile(Request $request) {
        
         $input = $request->all();

         $id    = $input['user_id'] ?? '';
                  
        $rules = [
            'user_id'         => 'required',
            'first_name'      => 'required',
            'last_name'       => 'required',
            'email'           => 'required|unique:users,email,'.$id.',id,deleted_at,NULL',
            'phone'           => 'required|unique:users,phone,'.$id.',id,deleted_at,NULL',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]]);              
        }

            $User = User::find($input['user_id']);
            
            $User->first_name   = $input['first_name'];
            $User->last_name    = $input['last_name'];
            $User->user_name    = $input['first_name'] .' '.$input['last_name'];
            $User->email        = $input['email'];
            $User->phone        = $input['phone'];
            $User->device_type  = $input['device_type'] ?? NULL;
            $User->device_token = $input['device_token'] ?? NULL;
            $User->update();

            $data['user_id']           = $User->id;
            $data['first_name']        = $User->first_name ?? '';
            $data['last_name']         = $User->last_name  ?? '';
            $data['user_name']         = $User->user_name  ?? '';
            $data['user_image']        =ImageHelper::get(ImageHelper::$userImagePath,$User->user_image);
            $data['email']             = $User->email ?? '';
            $data['phone']             = $User->phone ?? '';

           return response(['status' => true , 'message' => 'Profile Update Successfully' , 'data' => $data ]);
    }

     public function changePassword(Request $request){
      
         $input    = $request->all();

         $rules = [
                   'user_id'           => 'required',
                   'old_password'      => 'required',
                   'new_password'      => 'min:6|required_with:confirm_password|same:confirm_password',
                   'confirm_password'  => 'required|min:6',
                  ];

         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
           $errors =  $validator->errors()->all();
           return response(['status' => false , 'message' => $errors[0]] , 200);              
         }

         $User = User::find($input['user_id']);

        if (!(Hash::check($request->old_password,  $User->password))) {
             return response(['status' => false , 'message' => 'Your old password does not matches with the current password  , Please try again'] , 200);
        }
        elseif(strcmp($request->old_password, $request->new_password) == 0){
             return response(['status' => false , 'message' => 'New password cannot be same as your current password,Please choose a different new password'] , 200);
        }

         $User  = User::find($input['user_id']);
         $User->password = Hash::make($input['new_password']);
         if($User->update()){
           return response(['status' => true , 'message' => 'Successfully updated password'] , 200);
        }
           return response(['status' => false , 'message' => 'Failed to update password'] , 200);
    }

}