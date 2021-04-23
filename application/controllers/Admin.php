<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library('authlib');
		if($this->session->userdata('utype') != "Admin"){redirect(base_url('admin'));}
		$this->load->model('Admin_Model');
	}
	public function index(){ $this->dashboard(); }
	
	public function dashboard(){
			$data['title'] = 'Dashboard';
			$data['admissions'] = $this->Admin_Model->count('admission', array('t_status'=> '1'));
			$data['admissionss'] = $this->Admin_Model->count('admission', array('t_status'=> '0'));
			$data['gallery'] = $this->Admin_Model->count('gallery', array('gallery_status'=> '1'));
			$data['results'] = $this->Admin_Model->count('results', array('results_status'=> '1'));
			$data['sliders'] = $this->Admin_Model->count('sliders', array('sliders_status'=> '1'));
			$data['activities'] = $this->Admin_Model->count('activities', array('activities_status'=> '1'));
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/template/nav');
			$this->load->view('admin/template/topbar');
			$this->load->view('admin/pages/dashboard');
			$this->load->view('admin/template/footer');
	}

	public function settings(){
		if(!$this->uri->segment(3)){
		$data['sett'] = $this->Admin_Model->get_row('admin', array('admin_id ' => '1'));
		$data['title'] = 'Settings';
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/nav');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/pages/settings/settings');
		$this->load->view('admin/template/footer');
	}
		elseif($this->uri->segment(3)==='updatecred'){
			$data['admin_phone'] = $this->input->post('admin_phone');
			if($this->input->post('admin_password') != "" && $this->input->post('admin_passwordconfirm') != "" && $this->input->post('admin_password') == $this->input->post('admin_passwordconfirm')){
			  $data['admin_password'] = md5($this->input->post('admin_password'));
			 }else{
				$this->session->set_flashdata('message', 'Check all Details!');
				redirect(base_url('admin/settings'));
	
			 }
		$this->Admin_Model->update($data, 'admin', array('admin_id' => '1'));
		$this->session->set_flashdata('message', 'Successfully Updated!');
		redirect(base_url('admin/settings'));
	}
	}
	


// ADD GALLERY

public function gallery(){

	if(!$this->uri->segment(3)){
	   $data['gallery'] = $this->Admin_Model->get_gallery();
	   $data['title'] = 'GALLERY';
	   $this->load->view('admin/template/header', $data);
	   $this->load->view('admin/template/nav');
	   $this->load->view('admin/template/topbar');
	   $this->load->view('admin/pages/gallery/gallery');
	   $this->load->view('admin/template/footer');
	}
	elseif($this->uri->segment(3)==='add_gallery'){
	   $config['upload_path'] = './uploads/gallery/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['gallery_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('gallery_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $banner_image = "uploads/gallery/$filename";
		 }else{$banner_image = '0';}
	   $data = array(
		   'gallery_name' => strtoupper($this->input->post('gallery_name')),
		   'gallery_status' => $this->input->post('gallery_status'),
		   'gallery_type' => $this->input->post('gallery_type'),
		   'gallery_image' => $banner_image
	   );
	   $insert = $this->Admin_Model->addNew($data, 'gallery');
	   echo json_encode(array("status" => TRUE));
   }
   elseif($this->uri->segment(3)==='edit_gallery'){
	   if(!$this->uri->segment(4)){echo json_encode(array("status" => FALSE));}
	   else{
		   $banner_id=$this->uri->segment(4);
		   $data = $this->Admin_Model->get_gallery($banner_id);
		   echo json_encode($data);
	   }
   }
   elseif($this->uri->segment(3)==='update_gallery'){
   if(!empty($_FILES['gallery_image'])){
	   $config['upload_path'] = './uploads/gallery/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['gallery_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('gallery_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $data['gallery_image'] = "uploads/gallery/$filename";
	    }else{}
	 }
	   $data['gallery_name'] = strtoupper($this->input->post('gallery_name'));
	   $data['gallery_status'] = strtoupper($this->input->post('gallery_status'));
	   $data['gallery_type'] = $this->input->post('gallery_type');
	   $this->Admin_Model->update($data, 'gallery', array('gallery_id' => $this->input->post('gallery_id')));
	   echo json_encode(array("status" => TRUE));
   }
   else{show_404();}
   }


// END GALLERY

// RESULTS

public function results(){

	if(!$this->uri->segment(3)){
	   $data['results'] = $this->Admin_Model->get_results();
	   $data['title'] = 'results';
	   $this->load->view('admin/template/header', $data);
	   $this->load->view('admin/template/nav');
	   $this->load->view('admin/template/topbar');
	   $this->load->view('admin/pages/results/results');
	   $this->load->view('admin/template/footer');
	}
	elseif($this->uri->segment(3)==='add_results'){
	   $config['upload_path'] = './uploads/results/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['results_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('results_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $banner_image = "uploads/results/$filename";
		 }else{$banner_image = '0';}
	   $data = array(
		   'results_name' => strtoupper($this->input->post('results_name')),
		   'results_status' => $this->input->post('results_status'),
		   'results_year' => $this->input->post('results_year'),
		   'results_campus' => $this->input->post('results_campus'),
		   'results_image' => $banner_image
	   );
	   $insert = $this->Admin_Model->addNew($data, 'results');
	   echo json_encode(array("status" => TRUE));
   }
   elseif($this->uri->segment(3)==='edit_results'){
	   if(!$this->uri->segment(4)){echo json_encode(array("status" => FALSE));}
	   else{
		   $banner_id=$this->uri->segment(4);
		   $data = $this->Admin_Model->get_results($banner_id);
		   echo json_encode($data);
	   }
   }
   elseif($this->uri->segment(3)==='update_results'){
   if(!empty($_FILES['results_image'])){
	   $config['upload_path'] = './uploads/results/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['results_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('results_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $data['results_image'] = "uploads/results/$filename";
	    }else{}
	 }
	   $data['results_name'] = strtoupper($this->input->post('results_name'));
	   $data['results_status'] = strtoupper($this->input->post('results_status'));
	   $data['results_year'] = $this->input->post('results_year');
	   $data['results_campus'] = $this->input->post('results_campus');
	   $this->Admin_Model->update($data, 'results', array('results_id' => $this->input->post('results_id')));
	   echo json_encode(array("status" => TRUE));
   }
   else{show_404();}
   }

// END RESULTS

// ACTIVITIES


public function activities(){

	if(!$this->uri->segment(3)){
	   $data['activities'] = $this->Admin_Model->get_activities();
	   $data['title'] = 'activities';
	   $this->load->view('admin/template/header', $data);
	   $this->load->view('admin/template/nav');
	   $this->load->view('admin/template/topbar');
	   $this->load->view('admin/pages/activities/activities');
	   $this->load->view('admin/template/footer');
	}
	elseif($this->uri->segment(3)==='add_activities'){
	   $config['upload_path'] = './uploads/activities/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['activities_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('activities_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $banner_image = "uploads/activities/$filename";
		 }else{$banner_image = '0';}
	   $data = array(
		   'activities_name' => strtoupper($this->input->post('activities_name')),
		   'activities_status' => $this->input->post('activities_status'),
		   'activities_type' => $this->input->post('activities_type'),
		   'activities_image' => $banner_image
	   );
	   $insert = $this->Admin_Model->addNew($data, 'activities');
	   echo json_encode(array("status" => TRUE));
   }
   elseif($this->uri->segment(3)==='edit_activities'){
	   if(!$this->uri->segment(4)){echo json_encode(array("status" => FALSE));}
	   else{
		   $banner_id=$this->uri->segment(4);
		   $data = $this->Admin_Model->get_activities($banner_id);
		   echo json_encode($data);
	   }
   }
   elseif($this->uri->segment(3)==='update_activities'){
   if(!empty($_FILES['activities_image'])){
	   $config['upload_path'] = './uploads/activities/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['activities_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('activities_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $data['activities_image'] = "uploads/activities/$filename";
	    }else{}
	 }
	   $data['activities_name'] = strtoupper($this->input->post('activities_name'));
	   $data['activities_status'] = strtoupper($this->input->post('activities_status'));
	   $data['activities_type'] = $this->input->post('activities_type');
	   $this->Admin_Model->update($data, 'activities', array('activities_id' => $this->input->post('activities_id')));
	   echo json_encode(array("status" => TRUE));
   }
   else{show_404();}
   }

// END ACTIVITIES

// SLIDERS


public function sliders(){

	if(!$this->uri->segment(3)){
	   $data['sliders'] = $this->Admin_Model->get_sliders();
	   $data['title'] = 'sliders';
	   $this->load->view('admin/template/header', $data);
	   $this->load->view('admin/template/nav');
	   $this->load->view('admin/template/topbar');
	   $this->load->view('admin/pages/sliders/sliders');
	   $this->load->view('admin/template/footer');
	}
	elseif($this->uri->segment(3)==='add_sliders'){
	   $config['upload_path'] = './uploads/sliders/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['sliders_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('sliders_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $banner_image = "uploads/sliders/$filename";
		 }else{$banner_image = '0';}
	   $data = array(
		   'sliders_name' => strtoupper($this->input->post('sliders_name')),
		   'sliders_status' => $this->input->post('sliders_status'),
		   'sliders_type' => $this->input->post('sliders_type'),
		   'sliders_image' => $banner_image
	   );
	   $insert = $this->Admin_Model->addNew($data, 'sliders');
	   echo json_encode(array("status" => TRUE));
   }
   elseif($this->uri->segment(3)==='edit_sliders'){
	   if(!$this->uri->segment(4)){echo json_encode(array("status" => FALSE));}
	   else{
		   $banner_id=$this->uri->segment(4);
		   $data = $this->Admin_Model->get_sliders($banner_id);
		   echo json_encode($data);
	   }
   }
   elseif($this->uri->segment(3)==='update_sliders'){
   if(!empty($_FILES['sliders_image'])){
	   $config['upload_path'] = './uploads/sliders/';
	   $config['allowed_types'] = 'gif|jpg|png|jpeg';
	   $config['encrypt_name'] = TRUE;
	   $config['file_name'] = $_FILES['sliders_image']['name'];
	   $this->load->library('upload',$config);
	   $this->upload->initialize($config);
	   if($this->upload->do_upload('sliders_image')){
		   $uploadData = $this->upload->data();
		   $filename = $uploadData['file_name'];
		   $data['sliders_image'] = "uploads/sliders/$filename";
	    }else{}
	 }
	   $data['sliders_name'] = strtoupper($this->input->post('sliders_name'));
	   $data['sliders_status'] = strtoupper($this->input->post('sliders_status'));
	   $data['sliders_type'] = $this->input->post('sliders_type');
	   $this->Admin_Model->update($data, 'sliders', array('sliders_id' => $this->input->post('sliders_id')));
	   echo json_encode(array("status" => TRUE));
   }
   else{show_404();}
   }
// END SLIDERS

// ADMISSION REGISTEREED USERS


public function admission(){
	$data['type'] = "ALL REGISTERED STUDENTS";
	if(!$this->uri->segment(3)){
	   $data['admission'] = $this->Admin_Model->get_admission();
	   $data['title'] = 'admission';
	   $this->load->view('admin/template/header', $data);
	   $this->load->view('admin/template/nav');
	   $this->load->view('admin/template/topbar');
	   $this->load->view('admin/pages/admission/admission');
	   $this->load->view('admin/template/footer');
	}
    elseif($this->uri->segment(3)==='edit_admission'){
	   if(!$this->uri->segment(4)){ redirect(base_url('admin/admission')); }
	   else{
		   $seller_id = $this->uri->segment(4);
		   $data['admission'] = $this->Admin_Model->get_admission($seller_id);
		   $data['title'] = 'admission';
		   $this->load->view('admin/template/header', $data);
		   $this->load->view('admin/template/nav');
		   $this->load->view('admin/template/topbar');
		   $this->load->view('admin/pages/admission/editadmission');
		   $this->load->view('admin/template/footer');
	   }
   }


   else{show_404();}
}




public function update_admission(){

	$type = $this->uri->segment(3);
		   $data = array(
			   'boy_name'=>$this->input->post('boy_name',TRUE),
			   'boy_phone_code'=>$this->input->post('boy_phone_code',TRUE),
			   'boy_phone'=>$this->input->post('boy_phone',TRUE),
			   'boy_country'=>$this->input->post('boy_country',TRUE),
			   'boy_state'=>$this->input->post('boy_state',TRUE),
			   'boy_city'=>$this->input->post('boy_city',TRUE),
			   'boy_pincode'=>$this->input->post('boy_pincode',TRUE),
			   'boy_address'=>$this->input->post('boy_address',TRUE),
			   'boy_bank_name'=>$this->input->post('boy_bank_name',TRUE),
			   'boy_bank_branch'=>$this->input->post('boy_bank_branch',TRUE),
			   'boy_bank_acc'=>$this->input->post('boy_bank_acc',TRUE),
			   'boy_bank_ifsc'=>$this->input->post('boy_bank_ifsc',TRUE),
			   'boy_bank_phone'=>$this->input->post('boy_bank_phone',TRUE),
			   'boy_status'=>$this->input->post('boy_status',TRUE),
			   'boy_wallet'=>$this->input->post('boy_wallet',TRUE),

		   );

$updated = $this->Admin_Model->update($data, 'admission', array('id' => $this->input->post('id')));
$this->session->set_flashdata('message', 'Updated Successfully!');

if($type === "admission"){
	redirect(base_url('admin/admission'));
}else{	redirect(base_url('admin/admission'));

}

}







public function createExcel(){


	$frm = $this->input->post('from',TRUE);
	// $tfrm = $this->input->post('tfrom',TRUE);
	$to =  $this->input->post('to',TRUE);
	// $tto =  $this->input->post('tto',TRUE);

	$fileName = 'admission.xlsx';  
	$employeeData = $this->Admin_Model->get_expadmission($frm,$to);
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setCellValue('A1', 'Id');
	$sheet->setCellValue('B1', 'AppID');
	$sheet->setCellValue('C1', 'Campus');
	$sheet->setCellValue('D1', 'Type');
	$sheet->setCellValue('E1', 'PickUp');
	$sheet->setCellValue('F1', 'Sur.Name');
	$sheet->setCellValue('G1', 'Mdl.Name');
	$sheet->setCellValue('H1', 'Lst.Name');
	$sheet->setCellValue('I1', 'Aadhaar');
	$sheet->setCellValue('J1', 'Father');
	$sheet->setCellValue('K1', 'Mother');
	$sheet->setCellValue('L1', 'Father.Occup');
	$sheet->setCellValue('M1', 'Mother.Occup');
	$sheet->setCellValue('N1', 'Gender');
	$sheet->setCellValue('O1', 'Addmission');
	$sheet->setCellValue('P1', 'DOB');
	$sheet->setCellValue('Q1', 'Nationality');
	$sheet->setCellValue('R1', 'Religion');
	$sheet->setCellValue('S1', 'Caste');
	$sheet->setCellValue('T1', 'Reservation');
	$sheet->setCellValue('U1', 'Resrv.Quota');
	$sheet->setCellValue('V1', 'School');
	$sheet->setCellValue('W1', 'Place');
	$sheet->setCellValue('X1', 'Board');
	$sheet->setCellValue('Y1', 'Marks');
	$sheet->setCellValue('Z1', 'Door No');
	$sheet->setCellValue('AA1', 'City/Village');
	$sheet->setCellValue('AB1', 'Street');
	$sheet->setCellValue('AC1', 'Landmark');
	$sheet->setCellValue('AD1', 'Mandal');
	$sheet->setCellValue('AE1', 'District');
	$sheet->setCellValue('AF1', 'Pincode');
	$sheet->setCellValue('AG1', 'Email');
	$sheet->setCellValue('AH1', 'WhatsApp');
	$sheet->setCellValue('AI1', 'Mobile-1');
	$sheet->setCellValue('AJ1', 'Mobile-2');
	$sheet->setCellValue('AK1', 'Reg.Date');
	$sheet->setCellValue('AL1', 'Reg.Time');
	$sheet->setCellValue('AM1', 'Verified');
	$rows = 2;
	foreach ($employeeData as $val){
		$sheet->setCellValue('A' . $rows, $val['id']);
		$sheet->setCellValue('B' . $rows, $val['t_unique']);
		$sheet->setCellValue('C' . $rows, $val['t_campus']);
		$sheet->setCellValue('D' . $rows, $val['t_type']);
		$sheet->setCellValue('E' . $rows, $val['t_pickup']);
		$sheet->setCellValue('F' . $rows, $val['t_sname']);
		$sheet->setCellValue('G' . $rows, $val['t_mname']);
		$sheet->setCellValue('H' . $rows, $val['t_lname']);
		$sheet->setCellValue('I' . $rows, $val['t_adhar']);
		$sheet->setCellValue('J' . $rows, $val['t_father']);
		$sheet->setCellValue('K' . $rows, $val['t_mother']);
		$sheet->setCellValue('L' . $rows, $val['t_foccup']);
		$sheet->setCellValue('M' . $rows, $val['t_moccup']);
		$sheet->setCellValue('N' . $rows, $val['t_gender']);
		$sheet->setCellValue('O' . $rows, $val['t_admission']);
		$sheet->setCellValue('P' . $rows, $val['t_dob']);
		$sheet->setCellValue('Q' . $rows, $val['t_nationality']);
		$sheet->setCellValue('R' . $rows, $val['t_religion']);
		$sheet->setCellValue('S' . $rows, $val['t_caste']);
		$sheet->setCellValue('T' . $rows, $val['t_reserv']);
		$sheet->setCellValue('U' . $rows, $val['t_otherreserv']);
		$sheet->setCellValue('V' . $rows, $val['t_school']);
		$sheet->setCellValue('W' . $rows, $val['t_place']);
		$sheet->setCellValue('X' . $rows, $val['t_board']);
		$sheet->setCellValue('Y' . $rows, $val['t_marks']);
		$sheet->setCellValue('Z' . $rows, $val['t_dno']);
		$sheet->setCellValue('AA' . $rows, $val['t_village']);
		$sheet->setCellValue('AB' . $rows, $val['t_street']);
		$sheet->setCellValue('AC' . $rows, $val['t_landmark']);
		$sheet->setCellValue('AD' . $rows, $val['t_mandal']);
		$sheet->setCellValue('AE' . $rows, $val['t_district']);
		$sheet->setCellValue('AF' . $rows, $val['t_pincode']);
		$sheet->setCellValue('AG' . $rows, $val['t_email']);
		$sheet->setCellValue('AH' . $rows, $val['t_whatsapp']);
		$sheet->setCellValue('AI' . $rows, $val['t_mobile']);
		$sheet->setCellValue('AJ' . $rows, $val['t_mobile2']);
		$sheet->setCellValue('AK' . $rows, $val['t_date']);
		$sheet->setCellValue('AL' . $rows, $val['t_time']);
		$sheet->setCellValue('AM' . $rows, $val['t_status']);
		$rows++;
	}
	$writer = new Xlsx($spreadsheet);
	$writer->save("upload/".$fileName);
	header("Content-Type: application/vnd.ms-excel");
	redirect(base_url()."/upload/".$fileName);              
}  




public function logout(){ $this->session->sess_destroy(); redirect(base_url('admin')); }

}