<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderstatus extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_status_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
	}

    public function bynumber()
    {
        if($this->input->post())
        {
            $data = array(
                'case_type'         =>  $this->input->post('case_type'),
                'regular_number'    =>  $this->input->post('regular_number'),
                'year'              =>  $this->input->post('year')
                );

            $data['detail'] = $this->Order_status_model->status_report_by_number($data);
            // var_dump($data['detail']);
            // die();
            $data['record_found'] = 'asdfasdf';
        }
        $data['year'] = array(date('Y')-1,date('Y'));
        $data['case_type'] = $this->Order_status_model->getCasetype();
        $data['page_title'] = 'Order Status';
        $data['middle_view'] = "front/orderstatus_bynumber";
        $this->load->view('template/main_template',$data); 
    }

    public function byname()
    {
        if($this->input->post())
        {
            $data = array(
                'case_type'     =>  $this->input->post('case_type'),
                'name'          =>  $this->input->post('name'),
                'year'          =>  $this->input->post('year')
                );

            $data['detail'] = $this->Order_status_model->status_report_by_name($data);
            // var_dump($data['detail']);
            // die();
            $data['record_found'] = 'asdfasdf';
        }
        $data['year'] = array(date('Y')-1,date('Y'));
        $data['case_type'] = $this->Order_status_model->getCasetype();
        $data['page_title'] = 'Order Status';
        $data['middle_view'] = "front/orderstatus_byname";
        $this->load->view('template/main_template',$data); 
    }
}