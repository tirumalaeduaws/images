<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Sms_model extends CI_Model{

function sendSMS($phone, $message, $dlt = FALSE){
    $sender = 'ELOCRT';
    $route = '4';
    $country = '91';
    $message = $message;
    $mobile = $phone;
    $authKey = '330739AkE8Snh05603786e7P1';
    $smsData = '{
      "sender": "'.$sender.'",
      "route": "'.$route.'",
      "DLT_TE_ID": "'.$dlt.'",
      "country": "'.$country.'",
      "sms": [
          { "message": "'.$message.'",
            "to": [ "'.$mobile.'" ]
          }
        ]
    }';        
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $smsData,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTPHEADER => array(
        "authkey: $authKey",
        "content-type: application/json"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
       return FALSE;
    } else {
        return TRUE;
    }
  }
}

	