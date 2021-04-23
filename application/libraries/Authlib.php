<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authlib {
    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library("session");
        $this->CI->load->library("encryption");
    }

    public function logCheck($user_type)
    {
        $sKey= $this->CI->session->userdata('sessionkey');
        $sid= $this->CI->session->userdata('uid');
        $slgd= $this->CI->session->userdata('loggedin');
        $typ= $this->CI->session->userdata('utype');
        $dKey=$this->CI->encryption->decrypt($sKey);
        $ip=$this->CI->input->ip_address();
        $dt=$user_type;
        $st=explode('*', $dKey);
        if($st[0]===$dt&&$st[1]===$ip&&$st[2]===$sid&&$slgd===true&&$typ===$user_type){
            echo true; exit;
        }else{
            echo false; exit;
        }
    }
    public function genSessionKey($user_id, $user_type)
    {
        $ip = $this->CI->input->ip_address();
        return $this->CI->encryption->encrypt($user_type.'*'.$ip.'*'.$user_id);
    }

    public function keyCheck($key)
    {
        $dKey=$this->CI->encryption->decrypt($key);
        $ip=$this->CI->input->ip_address();
        $dt=date('Y-m-d');
        $st=explode('*', $dKey);
        if($st[0]===$dt && $st[1]===$ip){
            return true;
        }else{
            return false;
        }
    }
    public function genKey()
    {
        $ip = $this->CI->input->ip_address();
        $date = date('Y-m-d');
        return $this->CI->encryption->encrypt($date.'*'.$ip);
    }

    public function encryptOTP($code)
    {
        $ip = $this->CI->input->ip_address();
        $date = date('Y-m-d');
        return $this->CI->encryption->encrypt($date.'*'.$ip.'*'.$code);
    }
    public function decryptOTP($code)
    {
        $oKey= $this->CI->session->userdata('oKey');
        $dKey=$this->CI->encryption->decrypt($oKey);
        $ip=$this->CI->input->ip_address();
        $date = date('Y-m-d');
        $st=explode('*', $dKey);
        if($st[0]===$date&&$st[1]===$ip&&$st[2]===$code){
            return true;
        }else{
            return false;
        }
    }



}