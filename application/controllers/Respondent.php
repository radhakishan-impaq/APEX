<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Respondent extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Respondent_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data['page_title'] = 'Respondent';
        $data['middle_view'] = "master/respondent_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Respondent_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('respondent/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("respondent/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['respondent_name'],
            $r['mobile'],
            $r['email'],
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
            $this->form_validation->set_rules('respondent_name', 'Respondent Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[12]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'respondent_name'   =>  $this->input->post('respondent_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'address'           =>  $this->input->post('address'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Respondent_model->save($data);
                $this->session->set_flashdata('success_message', 'Respondent <b><u>'.$this->input->post('respondent_name').'</u></b> added successfully');
                redirect(base_url('respondent/lists'));
            }
        }
        $data['page_title'] = 'Respondent Add';
        $data['middle_view'] = "master/respondent_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('respondent_name', 'Respondent Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[12]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $this->input->post('id'),
                    'respondent_name'   =>  $this->input->post('respondent_name'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'email'             =>  $this->input->post('email'),
                    'address'           =>  $this->input->post('address'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Respondent_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Respondent <b><u>'.$this->input->post('respondent_name').'</u></b> added successfully');
                redirect(base_url() . "respondent/lists");
            }
        }
        $data['detail']=$this->Respondent_model->getRespondent($id);

        $data['id']=$id;

        $data['page_title'] = 'Respondent Edit';
        $data['middle_view'] = "master/respondent_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Respondent_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Respondent deleted successfully');
        redirect(base_url('respondent/lists'));
    }
}