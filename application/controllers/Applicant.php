<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Applicant extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Applicant_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists() {
        
        $data['page_title'] = 'Applicant';
        $data['middle_view'] = "master/applicant_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Applicant_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('applicant/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("applicant/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['applicant_name'],
            $r['mobile'],
            $r['email'],
            $r['concern_person'],
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
            $this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[12]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('concern_person', 'Concern Person', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'applicant_name'    =>  $this->input->post('applicant_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'address'           =>  $this->input->post('address'),
                    'concern_person'    =>  $this->input->post('concern_person'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Applicant_model->save($data);
                $this->session->set_flashdata('success_message', 'Applicant <b><u>'.$this->input->post('applicant_name').'</u></b> added successfully');
                redirect(base_url('applicant/lists'));
            }
        }
        $data['page_title'] = 'Applicant Add';
        $data['middle_view'] = "master/applicant_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[12]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('concern_person', 'Concern Person', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $this->input->post('id'),
                    'applicant_name'    =>  $this->input->post('applicant_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'address'           =>  $this->input->post('address'),
                    'concern_person'    =>  $this->input->post('concern_person'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Applicant_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Applicant <b><u>'.$this->input->post('applicant_name').'</u></b> added successfully');
                redirect(base_url() . "applicant/lists");
            }
        }
        $data['detail']=$this->Applicant_model->getApplicant($id);

        $data['id']=$id;

        $data['page_title'] = 'Applicant Edit';
        $data['middle_view'] = "master/applicant_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Applicant_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Applicant deleted successfully');
        redirect(base_url('applicant/lists'));
    }
}