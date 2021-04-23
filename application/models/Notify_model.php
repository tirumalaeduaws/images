<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Notify_model extends CI_Model{

    public function __construct() { parent::__construct(); $this->load->model('Sms_model'); }




function user($od, $type){
        $this->db->select('user_phone, user_token');
        $this->db->join('users', 'users.user_id = orders.order_user_id');
        $this->db->where('order_id', $od);
        $query = $this->db->get('orders')->row_array();
        if($type === "placed"){
            $msg = "Your order ELOCRT$od has been placed succcesfully! awaiting seller confirmation.";
            $dlt = "1207161527220058887";
        }else if($type === "confirm"){
            $msg = "Your order ELOCRT$od has been accepted by the Ellocart seller and delivery has been dispatched. You will receive your delivery shortly.";
            $dlt = "1207161527240764193";
        }else if($type === "delivered"){
            $msg = "Your order ELOCRT$od has been delivered successfully! Thank you for shopping at Ellocart.";
            $dlt = "1207161527220058887";
        }else if($type === "cancelled"){
         $msg =  "Sorry for the inconvenience, your order ELOCRT$od has been canceled by the Ellocart seller due to the unavailability of the product. Your transaction amount will be refunded in 2 to 3 days.";
         $dlt = "1207161527379776506";
        }
        $mob =  $query['user_phone'];
        $tkn =  $query['user_token'];
        $sent = $this->Sms_model->sendSMS($mob, $msg, $dlt);
        if($tkn != ""){ $this->noteUser(array($tkn), $msg); }
        return true;
}



function seller($od, $type){
    $this->db->select('seller_phone, seller_device_token');
    $this->db->join('sellers', 'sellers.seller_id = orders.order_seller_id');
    $this->db->where('order_id', $od);
    $query = $this->db->get('orders')->row_array();
    if($type === "received"){
        $msg = "A New order ELOCRT$od has been received! please confirm the order.";
    }
    $mob =  $query['seller_phone'];
    $tkn =  $query['seller_device_token'];
    $sent = $this->Sms_model->sendSMS($mob, $msg);
    if($tkn != ""){ $this->noteSeller(array($tkn), $msg); }

    $this->noteAdmin($msg);
    return true;
}


function boy($od){
    $this->db->select('user_phone, user_token');
    $this->db->join('users', 'users.user_id = orders.order_user_id');
    $this->db->where('order_id', $od);
    $query = $this->db->get('orders')->row_array();
    if($type === "assign"){
        $msg = "Hey Rider, you are assigned to deliver a order: ELOCRT$od. Please deliver according to schedule.";
    }
}



function b2b($od){
    $this->db->select('user_phone, user_token');
    $this->db->join('users', 'users.user_id = orders.order_user_id');
    $this->db->where('order_id', $od);
    $query = $this->db->get('orders')->row_array();
    if($type === "assign"){
        $msg = "Hey Rider, you are assigned to deliver a order: ELOCRT$od. Please deliver according to schedule.";
    }
}


function noteUser($array, $message){
    $content      = array("en" => $message);
    $hashes_array = array();
    $fields = array(
        'app_id' => "7f216e3e-6f04-44e8-8e51-0554837f462d",
        'include_player_ids' => $array,
        'contents' => $content,
        'priority' => 10,
        'big_picture' => 'https://www.ellocart.com/assets/img/ellocart.png',
        'web_buttons' => $hashes_array
    );
    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic Zjk2Y2IwZWMtMDdhYS00YWVhLThmNzQtYWJmMGZkYTc3NzFk'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $response = curl_exec($ch);
    curl_close($ch);
    if($response > 120){ return TRUE; } else { return FALSE; } exit;
}


function noteSeller($array, $message){
    $content      = array("en" => $message);
    $hashes_array = array();
    $fields = array(
        'app_id' => "322e226c-fc3c-4daf-99dd-e75f166dc60a",
        'include_player_ids' => $array,
        'contents' => $content,
        'priority' => 10,
        'big_picture' => 'https://www.ellocart.com/assets/img/ellocart.png',
        'web_buttons' => $hashes_array
    );
    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic MWJkMzI0NjMtYjdiNi00NjNhLTkzZTctYWIwZmJlYTUzMzdm'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $response = curl_exec($ch);
    curl_close($ch);
    if($response > 120){ return TRUE; } else { return FALSE; } exit;
}




function noteAdmin($message){
    $content      = array("en" => $message);
    $hashes_array = array();
    $fields = array(
        'app_id' => "8edf6d56-6dfe-4fdf-b11e-7863e9db1eb6",
        'included_segments' => array('Subscribed Users'),
        'contents' => $content,
        'priority' => 10,
        'big_picture' => 'https://www.ellocart.com/assets/img/ellocart.png',
        'web_buttons' => $hashes_array
    );

    $fields = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic MDFjNGQ1NzEtYWYzNy00OWY4LTg1YjItMjcxNDI5MWM5NGEx'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $response = curl_exec($ch);
    curl_close($ch);
    if($response > 120){ return TRUE; } else { return FALSE; } exit;
}






}