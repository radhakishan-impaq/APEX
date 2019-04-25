<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        if($this->session->userdata['role']!='admin')
	 	{
	 		redirect(base_url('casestatus/bynumber'));
	 	}
    }

	public function index()
	{
		// cases detail
		// if ($this->is_logged_in())
		// {
			date_default_timezone_set('Asia/Kolkata');
			$date = strtotime("-20 day");
			$day = date('d-m-Y', $date);
			$data['last_cases'] = $this->Home_model->last_cases($day);


			// directive detail
			$data['directive'] = $this->Home_model->directive();
			

			$data['page_title'] = 'Dashboard';
			$data['middle_view'] = "home";
			$this->load->view('template/main_template',$data);
		// }
	}
}