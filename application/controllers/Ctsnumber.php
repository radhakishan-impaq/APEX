<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ctsnumber extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ctsnumber_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data = array();
        $data['page_title'] = 'CTS Number';
        $data['middle_view'] = "master/ctsnumber_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Ctsnumber_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('ctsnumber/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("ctsnumber/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['cts_number'],
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
            $this->form_validation->set_rules('cts_number', 'CTS Number', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'cts_number'    =>  $this->input->post('cts_number'),
                    'status'        =>  $this->input->post('status'),
                    'added_on'      =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Ctsnumber_model->save($data);
                $this->session->set_flashdata('success_message', 'CTS Number <b><u>'.$this->input->post('ctsnumber').'</u></b> added successfully');
                redirect(base_url('ctsnumber/lists'));
            }
        }
        $data['page_title'] = 'CTS Number Add';
        $data['middle_view'] = "master/ctsnumber_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('cts_number', 'CTS Number', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'cts_number'        =>  $this->input->post('cts_number'),
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Ctsnumber_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'CTS Number <b><u>'.$this->input->post('cts_name').'</u></b> added successfully');
                redirect(base_url() . "ctsnumber/lists");
            }
        }

        $data['detail']=$this->Ctsnumber_model->getCtsnumber($id);
        $data['id']=$id;

        $data['page_title'] = 'CTS Number Edit';
        $data['middle_view'] = "master/ctsnumber_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Ctsnumber_model->delete($id);
        $this->session->set_flashdata('delete_message', 'CTS Number deleted successfully');
        redirect(base_url('ctsnumber/lists'));
    }
}