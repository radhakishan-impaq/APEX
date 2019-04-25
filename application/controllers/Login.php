<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct() {
        parent::__construct();
        
        // if(isset($this->session->userdata['user_data'])){
        //     redirect(base_url('home'));
        // }

		$this->load->model('Login_model');
		// $this->load->helper('cookie');
	}

	public function index()
	{
		if($this->input->post()){
			
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$result = $this->Login_model->login($email,$password);

			if(count($result)>0){
				$this->session->set_userdata('role',$result[0]['role']);
				$this->session->set_userdata('user_data',$result[0]);
				if($result[0]['role'] != 'admin')
				{
					redirect(base_url('casestatus/bynumber'));
				}
				else
				{
				    redirect(base_url('home'));
				}
			}
			else
			{
				$data['login_error']='Something Wrong'; 
			}
		}
		$data['middle_view'] = "login";
        //echo "<pre>";print_r($data);exit;
		$this->load->view('login',$data);
	}

	public function logout($id)
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}