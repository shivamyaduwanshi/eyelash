<?php

namespace App\Helpers;

use Session;
use App;
use Carbon\Carbon;
use Image;
use url;

class ImageHelper {

  public static $eyesImagePath         = 'assets/uploads/eyes/';
  public static $uploadBannerPath      = 'assets/uploads/banners/'; 
  public static $serviceImagePath      = 'assets/uploads/services/';
  public static $productImagePath      = 'assets/uploads/products/';
  public static $eyeImagePath          = 'assets/uploads/eyes/';
  public static $userImagePath         = 'assets/uploads/users/';
  public static $userImageNotAvailable = 'systems/images/user-image-not-available.jpg';
  public static $imageNotAvailabe      = 'systems/images/image-not-available.png';     

  public  static function upload($path , $files , $fileNamePrefix = null){
        
     if(gettype($files) == 'array'){ // Multiple File Upload

        $filesName = array();

        foreach($files as $key => $file){
           
           $fileName = str_random('10').'.'.time().'.'.$file->getClientOriginalExtension();

           if($fileNamePrefix)
               $fileName = $fileNamePrefix . '-' . $fileName;

           $destinationPath = public_path($path);

           $file->move($destinationPath, $fileName);

           array_push($filesName, $fileName );

        } 

           return $filesName;

         
     }elseif(gettype($files) == 'object'){ // Single File Upload

        $fileName = str_random('10').'.'.time().'.'.$files->getClientOriginalExtension();

        if($fileNamePrefix)
           $fileName = $fileNamePrefix . '-' . $fileName;

        $destinationPath = public_path($path);

        $files->move($destinationPath, $fileName);

        return $fileName;

     }else{

       return false;
       
     }

  }

  public static function get($path,$file){

    if($file){
       if(file_exists('public/' . $path . $file)){
              return url('public/'. $path . $file);
        }
    }
      
      if($path == static::$userImagePath){
         return url('public/'.static::$userImageNotAvailable);
      }
         return url('public/'.static::$imageNotAvailabe);
  }

}
