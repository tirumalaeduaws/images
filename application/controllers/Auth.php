<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('authlib'); 
		$this->load->model('Auth_Model'); 
	}



function admin(){
    $this->form_validation->set_rules('admin_phone', 'Phone', 'required|trim');
	$this->form_validation->set_rules('admin_password', 'Password', 'required|trim');
	if($this->form_validation->run()){
			 $phone=$this->input->post('admin_phone',TRUE);
			 $password=md5($this->input->post('admin_password',TRUE));
			 $loginResult=$this->Auth_Model->adminLogin($phone, $password);
		if($loginResult->num_rows() > 0){
			$adminData=$loginResult->row_array();
			$sessionkey=$this->authlib->genSessionKey($adminData['admin_id'], 'Admin');
				$login_data = array(
					'uid' => $adminData['admin_id'],
					'admin_name' => $adminData['admin_name'],
					'admin_phone' => $adminData['admin_phone'],
					'utype' => 'Admin',
					'sessionkey' => $sessionkey,
					'loggedin' => true,
				);
			$this->session->set_userdata($login_data);
			$this->session->set_flashdata('message', 'Login Successful');
			redirect(base_url('admin/dashboard'));
		}else{
		   $this->session->set_flashdata('message', 'Login Failed');
		   redirect(base_url('admin'));
		}
	}
	else{
		$data['page']="Admin login";
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/login');
		$this->load->view('admin/template/footer');
	}
}

public function logout(){ $this->session->sess_destroy(); redirect(base_url()); }

}