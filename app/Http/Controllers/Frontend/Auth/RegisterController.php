<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\ImageHelper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

     /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
         'your_name'  => 'required|string|max:255',
         'your_email' => 'required|max:255|unique:users,email,null,id,deleted_at,NULL',
         'your_mobile_number' => 'required|max:20|unique:users,phone,null,id,deleted_at,NULL',
         'your_birth_date' => 'date',
         'your_password' => 'required|string|min:6',
         'profile_image' => 'mimes:jpeg,jpg,png,gif'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       $image = null;
       $fileName = str_replace(" ","-",$data['your_name']);
       if(isset($data['profile_image']) && !empty($data['profile_image']))
         $image = ImageHelper::upload(ImageHelper::$userImagePath,$data['profile_image'],$fileName);
        
        $insertData = array(
            'user_name' => $data['your_name'],
            'email' => $data['your_email'],
            'phone' => $data['your_mobile_number'],
            'dob' => $data['your_birth_date'],
            'password' => Hash::make($data['your_password']),
        );
        if($image)
        $insertData['user_image'] = $image;
        return User::create($insertData);
    }

}
