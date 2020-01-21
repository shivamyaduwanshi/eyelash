<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Braintree;

 class PaymentController extends Controller
 {   
 	  private $environment = 'sandbox';
 	  private $merchantId  = '9z8qnsjxsr8ywfrh';
 	  private $publicKey   = 'ckr9kgsbzyr24h3p';
 	  private $privateKey  = 'f8e4aa9daf362987f04a2fbb4be48e78';
 	  private $gateway     = null;

      public function __construct(){
       $this->gateway = new Braintree\Gateway([
        'environment'  => $this->environment,
        'merchantId'   => $this->merchantId,
        'publicKey'    => $this->publicKey,
        'privateKey'   => $this->privateKey,
      ]);
     }

     public function makePayment($data = array()){
        
        $transaction = $this->gateway->transaction()->sale([
          'amount'             => $data['amount'],
          'paymentMethodNonce' => $data['nonce'],
          'options'            => [ 'submitForSettlement' => true ]
        ]);
        
        if($transaction->success){
          $transaction = $this->gateway->transaction()->find($transaction->transaction->id);
          $trans['id'] = $transaction->id;
          $trans['currency_iso_Code'] = $transaction->currencyIsoCode;
          $trans['card_type']  = $transaction->creditCard['cardType'];
          $trans['created_at'] = $transaction->createdAt;
          $trans['updated_at'] = $transaction->updatedAt ;
          $trans['amount']     = $transaction->amount;
          return array('status'=> true , 'message' => 'Transaction successfully', 'data' => $trans);
        }else{
          return array('status' => false , 'message' => 'Transaction failed');
      }

    } 

    public function getBraintreeToken(){

	 return $this->gateway->ClientToken()->generate();

   }


 }
