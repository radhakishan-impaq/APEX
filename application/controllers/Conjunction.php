<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Conjunction extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Conjunction_model');
        $this->load->helper(array('date'));
        $this->load->library('email');
        $this->load->library('form_validation');
    }

    public function search_case()
    {
        if($this->input->post())
        {
            $data['record_found'] = 'asdfasdf';
            $datas = array(
                'society'     =>  $this->input->post('society')
            );
            $data['datalist'] = $this->Conjunction_model->society_list($datas);

            // var_dump($data['datalist']);
            // die();
        }

        $data['society'] = $this->Conjunction_model->getSociety();
        $data['page_title'] = 'Search Case';
        $data['middle_view'] = "search/conjunction_list";
        $this->load->view('template/main_template',$data); 
    }

    public function join_case()
    {
        if($this->input->post())
        {
            $data = array(
                'case_id'   =>  $this->input->post('id')
            );

            $join = $this->Conjunction_model->join_society($data);

            var_dump($data);
            die();
        }
    }



    public function send_mail()
    {
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('someone@example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        // $this->email->send();

        if($this->email->send())
        {
            $this->session->set_flashdata("success_message","Congragulation Email Send Successfully.");
        }
        else
        {
            $this->session->set_flashdata("delete_message","You have encountered an error");
        }
        $data['middle_view'] = "search/conjunction_list";
        $this->load->view('template/main_template',$data); 
    }
}