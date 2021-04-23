<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Admin_Model'); 
        $this->load->model('User_Model');
	}

	public function home(){
        $data['page'] = "home";
        $data['activities'] = $this->User_Model->get_activities();
        $this->load->view('front/includes/header',$data);
		$this->load->view('front/home');
		$this->load->view('front/includes/footer');
    }

    public function about(){
        $data['page'] = "about";
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/about');
        $this->load->view('front/includes/footer');
    }

    public function courses(){
        $data['page'] = "courses";
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/courses');
        $this->load->view('front/includes/footer');
    }

    public function facilities(){
        $data['page'] = "facilities";
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/facilities');
        $this->load->view('front/includes/footer');
    }



    public function gallery(){
       // $data['admissions'] = $this->Admin_Model->count('admission', array('t_status'=> '1'));
        $data['gallery'] = $this->User_Model->get_gallery();
        $data['page'] = "gallery";
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/gallery');
        $this->load->view('front/includes/footer');
    }
    
    public function branches(){
        $data['page'] = "branches";
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/branches');
        $this->load->view('front/includes/footer');
    }

    
    public function year2020(){
        $data['page'] = "2020";$data['results'] = $this->User_Model->get_2020();
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/year2020');
        $this->load->view('front/includes/footer');
    }

    
    public function year2019(){
        $data['page'] = "2019";
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/year2019');
        $this->load->view('front/includes/footer');
    }

    
    public function year2018(){
        $data['page'] = "2018";
        $this->load->view('front/includes/header',$data);
        $this->load->view('front/year2018');
        $this->load->view('front/includes/footer');
    }



    public function contact(){
        $data['page'] = "contact";
        $this->load->view('front/includes/header',$data);
        // $this->load->helper('string');
        // $data['rand'] =  rand(1000, 9999);
        // $data['bCaptcha'] = base64_encode($data['rand']);
        $this->load->view('front/contact');
        $this->load->view('front/includes/footer');
    }



    public function contact_post(){

        $vCaptcha = base64_encode(trim($_REQUEST['vCaptcha']));
        $bCaptcha = trim($_REQUEST['bCaptcha']);
        $page = trim($_REQUEST['page']);

        if ($vCaptcha === $bCaptcha){

            $name = strip_tags($_REQUEST['name']);
            $email = strip_tags($_REQUEST['email']);
            $subject = strip_tags($_REQUEST['subject']);
            $phone = strip_tags($_REQUEST['phone']);
            $message = strip_tags($_REQUEST['message']);
            $message = strip_tags($_REQUEST['message']);
            $type = strip_tags($_REQUEST['type']);

            $this->load->library('email');
            $this->load->helper('string');
            $orderID =  random_string('alnum', 5);
            $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => '',
            'smtp_port' => '',
            'smtp_user' => '',
            'smtp_pass' => '',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
            );
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $htmlContent = '<h1>ELLOCART CONTACT FORM SUBMISSION</h1>';
            $htmlContent .= '<p>This email has sent via Site server from ellocart!</p>';
            $htmlContent .= '<h2>'.$type.'</h2>';
            $htmlContent .= '<p>*__________________________________*</p>';
            $htmlContent .= '<h3><small>First Name:</small> '.$name.'</h3>';
            $htmlContent .= '<h3><small>Phone:</small> '.$phone.'</h3>';
            $htmlContent .= '<h3><small>Email:</small> '.$email.'</h3>';
            $htmlContent .= '<h3><small>Subject:</small> '.$subject.'</h3>';
            $htmlContent .= '<h3><small>Message:</small> '.$message.'</h3>';
            $htmlContent .= '<p>!__________________________________!</p>';
            $this->email->to('');
            $this->email->from('','ELLOCART-APP');
            $this->email->subject('Subject-'.$type);
            $this->email->message($htmlContent);
            $this->email->send();

                $this->session->set_flashdata('color','success');
                $this->session->set_flashdata('icon','flaticon-check-2');
                $this->session->set_flashdata('message','sent successfully');
                redirect(base_url($page));
                exit;
            }
            else{
        
                $this->session->set_flashdata('color','danger');
                $this->session->set_flashdata('icon','flaticon-delete');
                $this->session->set_flashdata('message','something wrong');
                redirect(base_url($page));
            exit;
            }

    }



}