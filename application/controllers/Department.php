<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Department extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Department_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        // $this->config->load('custom');
    }

    public function lists() {
        $data = array();
        $data['page_title'] = 'Department';
        $data['middle_view'] = "master/dept_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Department_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('department/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("department/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['department_name'],
            $r['designation_name'],
            $r['person_name'],
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
            $this->form_validation->set_rules('department_name', 'Department Name', 'required');
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
            $this->form_validation->set_rules('person_name', 'Person Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[10]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'department_name'   =>  $this->input->post('department_name'),
                    'designation_name'  =>  $this->input->post('designation_name'),
                    'person_name'       =>  $this->input->post('person_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'status'            =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Department_model->save($data);
                $this->session->set_flashdata('success_message', 'Department <b><u>'.$this->input->post('department_name').'</u></b> added successfully');
                redirect(base_url('department/lists'));
            }
        }
        $data['designation'] = $this->Department_model->designation_name();
        $data['page_title'] = 'Department Add';
        $data['middle_view'] = "master/dept_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('department_name', 'Department Name', 'required');
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
            $this->form_validation->set_rules('person_name', 'Person Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[10]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'department_name'   =>  $this->input->post('department_name'),
                    'designation_name'  =>  $this->input->post('designation_name'),
                    'person_name'       =>  $this->input->post('person_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Department_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Department <b><u>'.$this->input->post('department_name').'</u></b> added successfully');
                redirect(base_url() . "department/lists");
            }
        }

        $data['detail']=$this->Department_model->getDepartment($id);
        
        $data['designation'] = $this->Department_model->designation_name();

        $data['id']=$id;

        $data['page_title'] = 'Department Edit';
        $data['middle_view'] = "master/dept_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Department_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Department deleted successfully');
        redirect(base_url('department/lists'));
    }
}