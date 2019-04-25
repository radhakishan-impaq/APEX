<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Directive extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Directive_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function search_directive()
    {
        if($this->input->post())
        {   
            $data['record_found'] = 'asdfasdf';
            $datas = array(
                'case_type'     =>  $this->input->post('case_type'),
                'regular_no'    =>  $this->input->post('regular_no'),
                'year'          =>  $this->input->post('year')
            );
            $data['fetch_case'] = $this->Directive_model->case_report($this->input->post());

            $data['fetch_directive'] = $this->Directive_model->directive_report($data['fetch_case']);

            $data['datalist'] = $this->Directive_model->fetch_directive_report($data['fetch_directive']);
        }

        $data['year'] = array(date('Y')-1,date('Y'));
        $data['case_type'] = $this->Directive_model->getCasetype();
        $data['page_title'] = 'Search Directive';
        $data['middle_view'] = "search/search_directive";
        $this->load->view('template/main_template',$data); 
    }

    public function add($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('department', 'Department', 'required');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('duration', 'Duration', 'required');
            $this->form_validation->set_rules('end_date', 'Start Date', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {

                $data = array(
                    'case_id'           =>  $this->input->post('case_id'),
                    'department'        =>  $this->input->post('department'),
                    'start_date'        =>  $this->input->post('start_date'),
                    'duration'          =>  $this->input->post('duration'),
                    'end_date'          =>  $this->input->post('end_date'),
                    'subject'           =>  $this->input->post('subject'),
                    'body'              =>  $this->input->post('body'),
                    'status'            =>  "Pending",
                    'added_on'          =>  date('Y-m-d H:i:s')
                );

                $result = $this->Directive_model->save($data);
                $this->session->set_flashdata('success_message', 'Directive added successfully');
                redirect(base_url('directive/search_directive'));
            }
        }
        $data['case_id'] = $id;
        $data['department'] = $this->Directive_model->getDepartment();
        $data['page_title'] = 'Directive Add';
        $data['middle_view'] = "search/add_directive";
        $this->load->view('template/main_template',$data); 
    }


    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {

                $data = array(
                    'id'        =>  $this->input->post('id'),
                    'status'        =>  $this->input->post('status'),
                    'update_on'     =>  date('Y-m-d H:i:s')
                );

                $result = $this->Directive_model->update($data);

                $this->session->set_flashdata('success_message', 'Directive Update successfully');
                redirect(base_url('directive/search_directive'));
            }
        }

        $data['detail'] = $this->Directive_model->getDirective($id);
        $data['id'] = $id;
        $data['page_title'] = 'Directive Edit';
        $data['middle_view'] = "search/edit_directive";
        $this->load->view('template/main_template',$data); 
    }


        
    
}