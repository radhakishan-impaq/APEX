<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Society extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Society_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data = array();
        $data['page_title'] = 'Society';
        $data['middle_view'] = "master/society_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Society_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('society/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("society/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['society_name'],
            $r['secretary_name'],
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
            $this->form_validation->set_rules('society_name', 'Society Name', 'required');
            $this->form_validation->set_rules('secretary_name', 'Secretary Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[10]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'society_name'      =>  $this->input->post('society_name'),
                    'secretary_name'    =>  $this->input->post('secretary_name'),
                    'mobile'            =>  $this->input->post('mobile'),   
                    'email'             =>  $this->input->post('email'),
                    'status'            =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Society_model->save($data);
                $this->session->set_flashdata('success_message', 'Society <b><u>'.$this->input->post('society_name').'</u></b> added successfully');
                redirect(base_url('society/lists'));
            }
        }
        $data['page_title'] = 'Society Add';
        $data['middle_view'] = "master/society_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('society_name', 'Society Name', 'required');
            $this->form_validation->set_rules('secretary_name', 'Secretary Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|max_length[10]|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'society_name'      =>  $this->input->post('society_name'),
                    'secretary_name'    =>  $this->input->post('secretary_name'),
                    'mobile'            =>  $this->input->post('mobile'),   
                    'email'             =>  $this->input->post('email'),
                    'status'  =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Society_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Society <b><u>'.$this->input->post('society_name').'</u></b> added successfully');
                redirect(base_url() . "society/lists");
            }
        }

        $data['detail']=$this->Society_model->getSociety($id);

        $data['id']=$id;

        $data['page_title'] = 'Society Edit';
        $data['middle_view'] = "master/society_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Society_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Society deleted successfully');
        redirect(base_url('society/lists'));
    }

}