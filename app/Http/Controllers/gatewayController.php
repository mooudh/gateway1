<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\gateway;

class gatewayController extends Controller
{




   public function gate(Request $request){

              // $this->validate($request,[
              //   'bank'  => 'required',
              //   'username'  => 'required',
              //   'password'  => 'required',
              //   'terminalId'  => 'required',
              //   'callback_url'  => 'required'
              // ]);



 // this function adds [$prop=>$val]value to the bank array in current user's gateway file

    function address($bank,$prop,$val) {

    $id=auth()->user()->id;

    config(['gateway'.$id.'.'.$bank.'.'.$prop => $val]);
    $fp = fopen(base_path() .'/config/gateway'.$id.'.php' , 'w');
    fwrite($fp, '<?php return ' . var_export(config('gateway'.$id), true) . ';');
    fclose($fp);

    }


// get values from homepage

      $bank=$request->get('bank');
      $username=$request->get('username');
      $password=$request->get('password');
      $terminalId=$request->get('terminalId');
      $callback_url=$request->get('callback_url');


// make these properties and put them into gateway file

      address($bank,'username',$username);
      address($bank,'password',$password);
      address($bank,'terminalId',$terminalId);
      address($bank,'callback_url',$callback_url);


// delete the current bank properties from Database
    $gate =gateway::where('bank',$request->get('bank'))->first();
    
    if ($gate != null) {
         $gate->Delete();
    }



//insert the new properties of our bank into Database
    $gateway = new gateway;
    $gateway->bank=$request->get('bank');
    $gateway->username=$request->get('username');
    $gateway->password=$request->get('password');
    $gateway->terminalId=$request->get('terminalId');
    $gateway->callback_url=$request->get('callback_url');
    $gateway->user_id=auth()->user()->id;

    $gateway -> save();

    return redirect()->back();


 }


  public function index(){


    try {

   $gateway = \Gateway::make('mellat');

      $gateway->setCallback(url('/bank/response')); // You can also change the callback
      $gateway->price(4000)
           // setShipmentPrice(10) // optional - just for paypal
           // setProductName("My Product") // optional - just for paypal
           ->ready();


/*
   $refId =  $gateway->refId(); // شماره ارجاع بانک
   $transID = $gateway->transactionId(); // شماره تراکنش

   // در اینجا
   //  شماره تراکنش  بانک را با توجه به نوع ساختار دیتابیس تان
   //  در جداول مورد نیاز و بسته به نیاز سیستم تان
   // ذخیره کنید .

   return $gateway->redirect();
*/
} catch (\Exception $e) {

   echo $e->getMessage();
}



  }


  public function store(){

    try {

         $gateway = \Gateway::verify();
         $trackingCode = $gateway->trackingCode();
         $refId = $gateway->refId();
         $cardNumber = $gateway->cardNumber();

         // تراکنش با موفقیت سمت بانک تایید گردید
         // در این مرحله عملیات خرید کاربر را تکمیل میکنیم

        } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {

          // تراکنش قبلا سمت بانک تاییده شده است و
          // کاربر احتمالا صفحه را مجددا رفرش کرده است
          // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم

          echo $e->getMessage() . "<br>";

        } catch (\Exception $e) {

          // نمایش خطای بانک
          echo $e->getMessage();
        }


  }


}
