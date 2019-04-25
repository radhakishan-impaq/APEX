<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Minutes extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Minutes_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function minutes_search()
    {
        if($this->input->post())
        {
            $data['record_found'] = 'asdfasdf';
            $datas = array(
                'case_type'     =>  $this->input->post('case_type'),
                'regular_no'    =>  $this->input->post('regular_no'),
                'year'          =>  $this->input->post('year')
            );
            $data['fetch_case'] = $this->Minutes_model->case_report($this->input->post());

            $data['fetch_minutes'] = $this->Minutes_model->minutes_report($data['fetch_case']);

            $data['datalist'] = $this->Minutes_model->fetch_minute_report($data['fetch_minutes']);

        }
        
        $data['year'] = array(date('Y')-1,date('Y'));
        $data['case_type'] = $this->Minutes_model->getCasetype();
        $data['page_title'] = 'Minutes';
        $data['middle_view'] = "add/minute_search";
        $this->load->view('template/main_template',$data); 
    }



    public function add($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {

                $config['upload_path']          = './uploads/minute/';
                $config['allowed_types']        = 'pdf|doc';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('file'))
                {
                    $error = $this->upload->display_errors();
                    echo "error";
                    die();
                }
                else
                {
                    $files = $this->upload->data();

                    $filepath = $files['full_path'];
                    $filename = $files['file_name'];
                }

                $data = array(
                    'case_id'           =>  $this->input->post('case_id'),
                    'minute_file'       =>  $filename,
                    'status'            =>  $this->input->post('status'),
                    'date'              =>  $this->input->post('date'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );

                $result = $this->Minutes_model->save($data);

                $update_case_status = $this->Minutes_model->update_case_status($data);

                $this->session->set_flashdata('success_message', 'Minutes added successfully');
                redirect(base_url('minutes/minutes_search'));
            }
        }
        $data['case_id'] = $id;
        $data['year'] = array(date('Y')-1,date('Y'));
        $data['page_title'] = 'Minutes Add';
        $data['middle_view'] = "add/minute_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {

                if(empty($_FILES["file"]['name']))
                {
                    $filename = $this->input->post('filename');
                }
                else
                {
                    $config['upload_path']          = './uploads/minute/';
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

                    $file = $this->Minutes_model->getMinutes($id);
                    unlink($filepath."".$file[0]['minute_file']);
                }

                $data = array(
                    'id'                =>  $this->input->post('id'),
                    'minute_file'       =>  $filename,
                    'status'            =>  $this->input->post('status'),
                    'date'              =>  $this->input->post('date'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $result = $this->Minutes_model->update($data);

                $data = array (
                    'status'    =>  $this->input->post('status'),
                    'case_id'   => $this->input->post('case_id')
                    );

                $update_case_status = $this->Minutes_model->update_case_status($data);

                $this->session->set_flashdata('success_message', 'Minutes Update successfully');
                redirect(base_url('minutes/minutes_search'));
            }
        }

        $data['detail'] = $this->Minutes_model->getMinutes($id);

        // var_dump($data['detail']);
        // echo count($data['detail']);
        // die();
        $data['id'] = $id;
        $data['year'] = array(date('Y')-1,date('Y'));
        $data['page_title'] = 'Minutes Edit';
        $data['middle_view'] = "add/minute_edit";
        $this->load->view('template/main_template',$data); 
    }

    public function delete($id)
    {
        $this->Minutes_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Minute deleted successfully');
        redirect(base_url('minutes/minutes_search'));
    }
}