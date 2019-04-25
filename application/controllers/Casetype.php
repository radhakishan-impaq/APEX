<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Casetype extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Casetype_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        $data = array();
        $data['page_title'] = 'Case Types';
        $data['middle_view'] = "master/casetype_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Casetype_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('casetype/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("casetype/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['case_name'],
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
            $this->form_validation->set_rules('case_name', 'Case Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'case_name'   =>  $this->input->post('case_name'),
                    'status'            =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Casetype_model->save($data);
                $this->session->set_flashdata('success_message', 'Case <b><u>'.$this->input->post('case_name').'</u></b> added successfully');
                redirect(base_url('casetype/lists'));
            }
        }
        $data['page_title'] = 'Case Add';
        $data['middle_view'] = "master/casetype_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('case_name', 'Case Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
            $data = array(
                'id'                =>  $id,
                'case_name'         =>  $this->input->post('case_name'),
                'status'            =>  $this->input->post('status'),
                'update_on'         =>  date('Y-m-d H:i:s')
                );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Casetype_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Case <b><u>'.$this->input->post('case_name').'</u></b> added successfully');
                redirect(base_url() . "casetype/lists");
            }
        }

        $data['detail']=$this->Casetype_model->getCasetype($id);
        
        $data['id']=$id;

        $data['page_title'] = 'Case Type Edit';
        $data['middle_view'] = "master/casetype_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Casetype_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Case deleted successfully');
        redirect(base_url('casetype/lists'));
    }
}