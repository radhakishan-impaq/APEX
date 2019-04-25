<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Area extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Area_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists() {
        
        $data['page_title'] = 'Area';
        $data['middle_view'] = "master/area_list";
        $this->load->view('template/main_template',$data); 
    }

    public function ajaxlist()
    {
        $data_list = $this->Area_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('area/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("area/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['name'],
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
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'name'      =>  $this->input->post('name'),
                    'status'    =>  $this->input->post('status'),
                    'added_on'  =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Area_model->save($data);
                $this->session->set_flashdata('success_message', 'Area <b><u>'.$this->input->post('department_name').'</u></b> added successfully');
                redirect(base_url('area/lists'));
            }
        }
        $data['page_title'] = 'Area Add';
        $data['middle_view'] = "master/area_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'name'              =>  $this->input->post('name'),
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Area_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Area <b><u>'.$this->input->post('department_name').'</u></b> added successfully');
                redirect(base_url() . "area/lists");
            }
        }

        $data['detail']=$this->Area_model->getArea($id);

        $data['id']=$id;

        $data['page_title'] = 'Area Edit';
        $data['middle_view'] = "master/area_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Area_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Area deleted successfully');
        redirect(base_url('area/lists'));
    }
}