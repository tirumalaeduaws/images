<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {

    function __construct() {
        parent::__construct();
       $this->load->model('Admin_Model'); 
       $this->load->model('User_Model'); 
	}

    public function registration(){
        $dt['page'] = "registration";
        $dt['num'] = rand(10000,999999);
        $dt['bnum'] = base64_encode(base64_encode($dt['num']));
        $dt['results'] = $this->User_Model->get_results();
        $this->load->view('front/includes/header', $dt);
        $this->load->view('front/registration');
        $this->load->view('front/includes/footer');
    }



    function numeric_wcomma($str)
    {
        return preg_match('/^[0-9,]+$/', $str);
    }

    public function saveregisterform(){
        $this->load->helper('email');
        $this->form_validation->set_rules('t_campus','Campus','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_type','Student Type','trim|required|min_length[1]|max_length[100]');
        // $this->form_validation->set_rules('t_name','Full Name','trim|required|min_length[4]|max_length[150]');
        $this->form_validation->set_rules('t_sname','SurName','trim|required|min_length[3]|max_length[150]');
     //   $this->form_validation->set_rules('t_mname','Middle Name','trim|required|min_length[4]|max_length[150]');
        $this->form_validation->set_rules('t_lname','Last Name','trim|required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('t_adhar','Aadhaar Number','trim|required|min_length[4]|max_length[150]');
        $this->form_validation->set_rules('t_father','Father Name','trim|required|min_length[4]|max_length[150]');
        $this->form_validation->set_rules('t_foccup','Father Occupation','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_mother','Mother Name','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_moccup','Mother Occupation','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_gender','Gender','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_admission','Admission for','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_dob','Date of Birth','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_nationality','Nationality','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_religion','Religion','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_caste','Caste','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_school','Previous School','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_place','Previous School Place','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_school','Previous School','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_board','Study Board','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_marks','Marks','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_dno','Door No','trim|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_village','City/Town/Village','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_street','Street/Area','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_mandal','Mandal','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_district','District','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_pincode','Pincode','trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('t_email', 'Email', 'trim|valid_email|max_length[150]');
        $this->form_validation->set_rules('t_mobile','Mobile','trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('t_mobile2','Alternative Mobile','trim|required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('t_captha','Security Code','trim|required|min_length[1]|max_length[20]');

        $mob1 = $this->input->post('t_mobile');
        $mob2 = $this->input->post('t_mobile2');

        if($mob1 != "" && $mob1 != $mob2){ $mvalid = true; }else{ $mvalid = false; $msg = "Enter Different Alternative Mobile"; }
        $bnum = base64_decode(base64_decode($this->input->post('t_bnum')));
        $num = $this->input->post('t_captha');
        if($bnum === $num){ $captha = true; }else{ $captha = false; $msg = "Invalid Security Code"; }
        $fvalid = $this->form_validation->run();
        if(!$fvalid){ $msg = validation_errors(); }

        $dob = $this->input->post('t_dob');
        $chk = $this->Admin_Model->checkAppl1($mob1, $dob);
        if(!$chk){ $msg = "Already Applied"; }

        if($captha && $fvalid && $mvalid && $chk){ $valid = true; }else{ $valid = false; }
        if($valid){
            $otp = rand(100000,999999);

        if(!$this->input->post('t_pickup')){ $tpick = "-no"; }else{ $tpick = $this->input->post('t_pickup'); }    
        date_default_timezone_set('Asia/Kolkata');

        $data = array(
            't_campus' => $this->input->post('t_campus'),
            't_type' => $this->input->post('t_type'),
            't_pickup' => $tpick,
            't_sname' => strtoupper($this->input->post('t_sname')),
            't_mname' => strtoupper($this->input->post('t_mname')),
            't_lname' => strtoupper($this->input->post('t_lname')),
            't_adhar' => strtoupper($this->input->post('t_adhar')),
            't_father' => strtoupper($this->input->post('t_father')),
            't_foccup' => $this->input->post('t_foccup'),
            't_mother' => strtoupper($this->input->post('t_mother')),
            't_moccup' => $this->input->post('t_moccup'),
            't_gender' => $this->input->post('t_gender'),
            't_admission' => $this->input->post('t_admission'),
            't_dob' => $this->input->post('t_dob'),
            't_nationality' => $this->input->post('t_nationality'),
            't_religion' => $this->input->post('t_religion'),
            't_caste' => $this->input->post('t_caste'),
            't_reserv' => $this->input->post('t_reserv'),
            't_otherreserv' => $this->input->post('t_otherreserv'),
            't_dexam' => $this->input->post('t_dexam'),
            't_school' => $this->input->post('t_school'),
            't_place' => $this->input->post('t_place'),
            't_board' => $this->input->post('t_board'),
            't_marks' => $this->input->post('t_marks'),
            't_dno' => $this->input->post('t_dno'),
            't_village' => $this->input->post('t_village'),
            't_street' => $this->input->post('t_street'),
            't_mandal' => $this->input->post('t_mandal'),
            't_district' => $this->input->post('t_district'),
            't_landmark' => $this->input->post('t_landmark'),
            't_pincode' => $this->input->post('t_pincode'),
            't_email' => $this->input->post('t_email'),
            't_whatsapp' => $this->input->post('t_whatsapp'),
            't_mobile' => $this->input->post('t_mobile'),
            't_mobile2' => $this->input->post('t_mobile2'),
            't_date' => date("Y-m-d"),
            't_time' => date("H:i:s"),
            't_otp' =>  $otp,
            't_status' => '0',
            't_unique' => '0'
        );
        $insert = $this->Admin_Model->addNew($data, 'admission');

        if($insert > 0){
                 $this->load->model('Sms_model'); 
                 $appname = 'TIRUMALAEDU';
                 $this->Sms_model->sendSMS($mob1, "Your OTP at $appname is $otp", "1207161864565549961");
            echo json_encode(array("status" => TRUE, "phone" => $mob1, "iid" => $insert, "msg" => "OTP SENT"));
        }else{
            echo json_encode(array("status" => FALSE, "msg" => "Something went wrong!"));
        }
    }else{
        echo json_encode(array("status" => FALSE, "msg" => $msg));
    }
    }

    function otp_verify(){
        $id = $this->input->post('t_id');
        $otp = $this->input->post('t_otp');
        $mob = $this->input->post('t_mob');
        $data['t_status'] = '1';
        $update = $this->Admin_Model->update($data, 'admission', array('t_mobile' => $mob, 't_otp' => $otp, 'id' => $id, 't_status' => '0'));
        if($update > 0){
            $msg = "ok";
            $appdt = $this->Admin_Model->get_row('admission', array('id' => $id));

            if($id < 10){ $uniq = "00000$id"; }
            elseif($id > 9 && $id < 100){ $uniq = "0000$id"; }
            elseif($id > 99 && $id < 1000){ $uniq = "000$id"; }
            elseif($id > 999 && $id < 2057){ $uniq = "00$id"; }
            elseif($id > 2056 && $id < 3000){ $uniq = "00200$id"; }
            elseif($id > 2099 && $id < 10000){ $uniq = "00$id"; }
            elseif($id > 9999 && $id < 100000){ $uniq = "0$id"; }
            $camp = $appdt['t_campus'];

            if($camp === "RAJAHMUNDRY"){ $cmp = "R";}
            elseif($camp === "VIASAKAPATNAM"){ $cmp = "V"; } 
            elseif($camp === "BHIMAVARAM"){ $cmp = "B"; }
            else{ $cmp = "NA"; }

            $appid = 'T'.$cmp.'21'.$appdt['t_admission'].$uniq;
            $data2['t_unique'] = $appid;
            $update2 = $this->Admin_Model->update($data2, 'admission', array('t_mobile' => $mob, 'id' => $id, 't_status' => '1'));
            $this->load->model('Sms_model'); 
            $this->Sms_model->sendSMS($mob, "Dear Student, Your Registration is Successful & ApplicationID is $appid. Please Save This For Correspondence - Tirumala Edu Inst", "1207161863664460975");
            echo json_encode(array("status" => TRUE, "msg" => $msg, "appid" => $appid));

        }else{
            $msg = "no";
            echo json_encode(array("status" => FALSE, "msg" => $msg));
        }
    }


    function success(){
        $id = $this->uri->segment('3');
        $dt['appid'] = $id;
        $dt['page'] = "success";
        $this->load->view('front/includes/header', $dt);
        $this->load->view('front/regsuccess');
        $this->load->view('front/includes/footer');
    }



    function check(){
        $this->form_validation->set_rules('c_mob','Mobile','trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('c_dob','Date of Birth','trim|required|min_length[1]|max_length[10]');
        $fvalid = $this->form_validation->run();
        if(!$fvalid){ $msg = validation_errors(); }

    if($fvalid)
    {

        $mob = $this->input->post('c_mob');
        $dob = $this->input->post('c_dob');
        $chk = $this->Admin_Model->checkAppl($mob, $dob);
        if(!empty($chk)){
            $str = "";
            $i=1;
            $ok=0;
            foreach ($chk as $row):
                if($row['t_status'] === '1'){
                $str .= '<p>('.$i.') App ID: '.$row['t_unique'].' ('.$row['t_date'].'#'.$row['t_time'].') - '.$row['t_lname'].'<i class="text-success"> -Success</i><p>';
                $ok=1;
                }else{
                $str .= '<p>('.$i.') ('.$row['t_date'].'#'.$row['t_time'].') '.$row['t_lname'].'<i>- Not Verified</i><p>';
                }
                $i++;
            endforeach;
            if($ok===0){ $str .= '<p>* Apply Again<p>'; }
            else if($ok===1){ $str .= '<p class="text-success">* Application Received<p>'; }
            echo json_encode(array("status" => TRUE, "msg" => $str));
        }else{
        $msg = "No Application Found";
        echo json_encode(array("status" => FALSE, "msg" => $msg));
        }

    }else{
        echo json_encode(array("status" => FALSE, "msg" => $msg));
    }


    }


}



