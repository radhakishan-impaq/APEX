<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Advocate extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Advocate_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists() {
        
        $data['page_title'] = 'Advocate';
        $data['middle_view'] = "master/advocate_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Advocate_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('advocate/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("advocate/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['advocate_name'],
            $r['mobile'],
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
            $this->form_validation->set_rules('advocate_name', 'Advocate Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[10]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'advocate_name'     =>  $this->input->post('advocate_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'address'           =>  $this->input->post('address'),
                    'status'           =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Advocate_model->save($data);
                $this->session->set_flashdata('success_message', 'Advocate <b><u>'.$this->input->post('advocate_name').'</u></b> added successfully');
                redirect(base_url('advocate/lists'));
            }
        }
        $data['page_title'] = 'Advocate Add';
        $data['middle_view'] = "master/advocate_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('advocate_name', 'Advocate Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[10]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'advocate_name'     =>  $this->input->post('advocate_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'address'           =>  $this->input->post('address'),
                    'status'           =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Advocate_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Advocate <b><u>'.$this->input->post('advocate_name').'</u></b> added successfully');
                redirect(base_url() . "advocate/lists");
            }
        }
        $data['detail']=$this->Advocate_model->getAdvocate($id);

        $data['id']=$id;

        $data['page_title'] = 'Advocate Edit';
        $data['middle_view'] = "master/advocate_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Advocate_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Advocate deleted successfully');
        redirect(base_url('advocate/lists'));
    }
}