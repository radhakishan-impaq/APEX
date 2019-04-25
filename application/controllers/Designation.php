<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Designation extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Designation_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data = array();
        $data['page_title'] = 'Designation';
        $data['middle_view'] = "master/designation_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Designation_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('designation/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("designation/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['designation_name'],
            $r['status']==1?'Active':'Inactive',
            $edit .''. $delete,
            );
        }

        $output = array(
            "data" => $data
        );
        
        echo json_encode($output);
        exit();
    }

    public function add()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'designation_name'   =>  $this->input->post('designation_name'),
                    'status'   =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Designation_model->save($data);
                $this->session->set_flashdata('success_message', 'Designation <b><u>'.$this->input->post('designation_name').'</u></b> added successfully');
                redirect(base_url('designation/lists'));
            }
        }
        $data['page_title'] = 'Designation Add';
        $data['middle_view'] = "master/designation_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'designation_name'  =>  $this->input->post('designation_name'),
                    'status'  =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Designation_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Designation <b><u>'.$this->input->post('designation_name').'</u></b> added successfully');
                redirect(base_url() . "designation/lists");
            }
        }

        $data['detail']=$this->Designation_model->getDesignation($id);

        $data['id']=$id;

        $data['page_title'] = 'Designation Edit';
        $data['middle_view'] = "master/designation_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Designation_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Designation deleted successfully');
        redirect(base_url('designation/lists'));
    }

}