<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Members extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Members_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data = array();
        $data['page_title'] = 'Member';
        $data['middle_view'] = "master/members_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Members_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('members/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("members/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));
        $data[] = array(
            $r['member_name'],
            $r['designation_name'],
            $r['department_name'],
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
            $this->form_validation->set_rules('member_name', 'Member Name', 'required');
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
            $this->form_validation->set_rules('department_name', 'Department Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'member_name'       =>  $this->input->post('member_name'),
                    'designation_name'  =>  $this->input->post('designation_name'),
                    'department_name'   =>  $this->input->post('department_name'),
                    'status'            =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                );
                $result = $this->Members_model->save($data);
                $this->session->set_flashdata('success_message', 'Member <b><u>'.$this->input->post('member_name').'</u></b> added successfully');
                redirect(base_url('members/lists'));
            }
        }
        $data['designation'] = $this->Members_model->getDesignation();
        $data['department'] = $this->Members_model->getDepartment();

        $data['page_title'] = 'Member Add';
        $data['middle_view'] = "master/members_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('member_name', 'Member Name', 'required');
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
            $this->form_validation->set_rules('department_name', 'Department Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'member_name'       =>  $this->input->post('member_name'),
                    'designation_name'  =>  $this->input->post('designation_name'),
                    'department_name'   =>  $this->input->post('department_name'),
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Members_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Members <b><u>'.$this->input->post('member_name').'</u></b> added successfully');
                redirect(base_url() . "members/lists");
            }
        }

        $data['detail']=$this->Members_model->getMembers($id);
        $data['designation'] = $this->Members_model->getDesignation();
        $data['department'] = $this->Members_model->getDepartment();
        $data['id']=$id;

        $data['page_title'] = 'Member Edit';
        $data['middle_view'] = "master/members_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Members_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Member deleted successfully');
        redirect(base_url('members/lists'));
    }
}