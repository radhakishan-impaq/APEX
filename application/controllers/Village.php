<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Village extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Village_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data = array();
        $data['page_title'] = 'Village';
        $data['middle_view'] = "master/village_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Village_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('village/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("village/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['village_name'],
            $r['taluka'],
            $r['district'],
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
            $this->form_validation->set_rules('village_name', 'Village Name', 'required');
            $this->form_validation->set_rules('taluka', 'Taluka Name', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'village_name'      =>  $this->input->post('village_name'),
                    'taluka'            =>  $this->input->post('taluka'),
                    'district'          =>  $this->input->post('district'),
                    'status'            =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Village_model->save($data);
                $this->session->set_flashdata('success_message', 'Village <b><u>'.$this->input->post('village_name').'</u></b> added successfully');
                redirect(base_url('village/lists'));
            }
        }
        $data['page_title'] = 'Village Add';
        $data['middle_view'] = "master/village_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('village_name', 'Village Name', 'required');
            $this->form_validation->set_rules('taluka', 'Taluka Name', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'village_name'      =>  $this->input->post('village_name'),
                    'taluka'            =>  $this->input->post('taluka'),
                    'district'          =>  $this->input->post('district'),
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Village_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Village <b><u>'.$this->input->post('village_name').'</u></b> added successfully');
                redirect(base_url() . "village/lists");
            }
        }
        $data['detail']=$this->Village_model->getVillage($id);

        $data['id']=$id;

        $data['page_title'] = 'Village Edit';
        $data['middle_view'] = "master/village_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Village_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Village deleted successfully');
        redirect(base_url('village/lists'));
    }

}