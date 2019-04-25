<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bench extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bench_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists() {
        
        $data['page_title'] = 'Bench';
        $data['middle_view'] = "master/bench_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Bench_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('bench/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("bench/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['bench_name'],
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
            $this->form_validation->set_rules('bench_name', 'Bench Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'bench_name'     =>  $this->input->post('bench_name'),
                    'status'           =>  $this->input->post('status'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );
                $result = $this->Bench_model->save($data);
                $this->session->set_flashdata('success_message', 'Bench <b><u>'.$this->input->post('bench_name').'</u></b> added successfully');
                redirect(base_url('bench/lists'));
            }
        }
        $data['page_title'] = 'Bench Add';
        $data['middle_view'] = "master/bench_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('bench_name', 'Bench Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'             =>  $id,
                    'bench_name'     =>  $this->input->post('bench_name'),
                    'status'         =>  $this->input->post('status'),
                    'update_on'      =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Bench_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Bench <b><u>'.$this->input->post('bench_name').'</u></b> update successfully');
                redirect(base_url() . "bench/lists");
            }
        }

        $data['detail']=$this->Bench_model->getBench($id);

        $data['id']=$id;

        $data['page_title'] = 'Bench Edit';
        $data['middle_view'] = "master/bench_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Bench_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Bench deleted successfully');
        redirect(base_url('bench/lists'));
    }
}