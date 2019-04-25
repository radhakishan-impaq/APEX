<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_cause_list extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_cause_list_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data['page_title'] = 'Cause List';
        $data['middle_view'] = "front/user_cause_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->User_cause_list_model->get();

        foreach($data_list as $r) {
        
        $cause_list_pdf = '<a href="'. base_url('uploads/pdf/'.$r['cause_list_pdf']) .'" target="_blank" class="btn btn-success btn-sm active"><span class="glyphicon glyphicon-download"></span> Download Pdf</a>';

        $data[] = array(
            date('d F - Y',strtotime($r['date'])),
            $cause_list_pdf,
            );
        }

        $output = array(
            "data" => $data
        );
        
        echo json_encode($output);
        exit();
    }
}