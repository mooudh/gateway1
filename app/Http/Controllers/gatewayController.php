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



 // this function adds [$prop=>$val]value to the bank array in its own gateway file

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


// make these properties to put into gateway file

      address($bank,'username',$username);
      address($bank,'password',$password);
      address($bank,'terminalId',$terminalId);
      address($bank,'callback_url',$callback_url);



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

}
