<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cause extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cause_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data['page_title'] = 'Cause List';
        $data['middle_view'] = "master/cause_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Cause_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('cause/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("cause/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $cause_list_pdf = '<a href="'. base_url('uploads/pdf/'.$r['cause_list_pdf']) .'" target="_blank" class="btn btn-success btn-sm active"><span class="glyphicon glyphicon-download"></span> Download Pdf</a>';

        $data[] = array(
            $cause_list_pdf,
            $r['date'],
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
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {

                $config['upload_path']          = './uploads/pdf/';
                $config['allowed_types']        = 'pdf|doc';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('file'))
                {
                    $error = $this->upload->display_errors();
                    exit($error);
                }
                else
                {
                    $files = $this->upload->data();

                    $filepath = $files['full_path'];
                    $filename = $files['file_name'];
                }

                $data = array(
                    'cause_list_pdf'    =>  $filename,
                    'date'              =>  $this->input->post('date'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );

                $result = $this->Cause_model->save($data);
                $this->session->set_flashdata('success_message', 'Cause List added successfully');
                redirect(base_url('cause/lists'));
            }
        }
        $data['page_title'] = 'Cause List Add';
        $data['middle_view'] = "master/cause_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {

                if(empty($_FILES["file"]['name']))
                {
                    $filename = $this->input->post('filename');
                }
                else
                {
                    $config['upload_path']          = './uploads/pdf/';
                    $config['allowed_types']        = 'pdf|doc';
                    $config['overwrite']            = TRUE;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('file'))
                    {
                        $error = $this->upload->display_errors();
                        exit($error);
                    }
                    else
                    {
                        $files = $this->upload->data();

                        $filepath = $files['file_path'];
                        $filename = $files['file_name'];
                    }

                    $file = $this->Cause_model->getCause($id);
                    unlink($filepath."".$file[0]['cause_list_pdf']);
                }
                $data = array(
                'id'                =>  $id,
                'cause_list_pdf'    =>  $filename,
                'date'              =>  $this->input->post('date'),
                'update_on'         =>  date('Y-m-d H:i:s')
                );

                $result = $this->Cause_model->update($data);
                $this->session->set_flashdata('success_message', 'Cause List update successfully');
                redirect(base_url('cause/lists'));
            }
        }
        $data['detail']=$this->Cause_model->getCause($id);

        $data['id']=$id;

        $data['page_title'] = 'Cause Edit';
        $data['middle_view'] = "master/cause_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Cause_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Cause List deleted successfully');
        redirect(base_url('cause/lists'));
    }
}