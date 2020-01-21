<?php

    function generateOrderID($orderDate , $orderId){
  	  $pre    = '';
    	$suffix = date('Ymd',strtotime($orderDate)) . '0000000';
    	$orderId =  (int) $suffix + $orderId;
      return $pre . $orderId;
   }

   function decryptOrderID($orderId){
      $id = substr($orderId,11);
      return (int) $id;
   }

   function dateFormate($date){
      return date('d M y',strtotime($date));
   }

   function timeFormate($time){
      return date('h:s A',strtotime($time));
   }

   function clientIP(){
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
   }

   function SplitTime($StartTime, $EndTime, $Duration="60"){
    
        $ReturnArray  = array ();// Define output
        $StartTime    = strtotime ($StartTime); //Get Timestamp
        $EndTime      = strtotime ($EndTime); //Get Timestamp

        $AddMins  = $Duration * 60;

         while ($StartTime <= $EndTime) //Run loop
        {
            $ReturnArray[] = date ("G:i A", $StartTime);
            $StartTime += $AddMins; //Endtime check
        }
        return array_unique($ReturnArray);
    }

    function getTimeDiff($from,$to){
      $datetime1 = new DateTime('2014-02-11 '.$from);
      $datetime2 = new DateTime('2014-02-11 '.$to);
      $interval = $datetime1->diff($datetime2);
      return $interval->format('%h')." hr ".$interval->format('%i')." mins";
    }