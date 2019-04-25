<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data['page_title'] = 'Area';
        $data['middle_view'] = "master/user_list";
        $this->load->view('template/main_template',$data); 
    }

    public function ajaxlist()
    {
        $data_list = $this->User_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('user/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("user/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['name'],
            $r['email'],
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
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'name'      =>  $this->input->post('name'),
                    'email'      =>  $this->input->post('email'),
                    'password'      =>  md5($this->input->post('password')),
                    'status'    =>  $this->input->post('status'),
                    'role'      =>  'sub-admin',
                    'added_on'  =>  date('Y-m-d H:i:s')
                    );
                $data = $this->security->xss_clean($data);
                $result = $this->User_model->save($data);
                $this->session->set_flashdata('success_message', 'User <b><u>'.$this->input->post('name').'</u></b> added successfully');
                redirect(base_url('user/lists'));
            }
        }
        $data['page_title'] = 'User Add';
        $data['middle_view'] = "master/user_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $password = md5($this->input->post('password'));

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'name'              =>  $this->input->post('name'),
                    'email'             =>  $this->input->post('email'),
                    'password'          =>  $password,
                    'status'            =>  $this->input->post('status'),
                    'role'              =>  'sub-admin',
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->User_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'User <b><u>'.$this->input->post('name').'</u></b> added successfully');
                redirect(base_url() . "user/lists");
            }
        }

        $data['detail']=$this->User_model->getUser($id);

        $data['id']=$id;

        $data['page_title'] = 'User Edit';
        $data['middle_view'] = "master/user_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->User_model->delete($id);
        $this->session->set_flashdata('delete_message', 'User deleted successfully');
        redirect(base_url('user/lists'));
    }
}