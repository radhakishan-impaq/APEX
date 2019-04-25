<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cases extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Case_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }


    public function lists() {
        
        $data = array();
        $data['page_title'] = 'Case List';
        $data['middle_view'] = "add/case_list";
        $this->load->view('template/main_template',$data); 
    }

    public function ajaxlist()
    {
        $data_list = $this->Case_model->getCase();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('cases/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("cases/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            $r['case_type'],
            $r['regular_number'],
            $r['filling_date'],
            $r['status'],
            $edit .''. $delete
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
            $this->form_validation->set_rules('case_type', 'Case Type', 'required');
            $this->form_validation->set_rules('regular_number', 'Regular Number', 'required');
            $this->form_validation->set_rules('lodging_number', 'Lodging Number', 'required');
            $this->form_validation->set_rules('filling_date', 'Filling Date', 'required');
            $this->form_validation->set_rules('department_name', 'Department Name', 'required');
            $this->form_validation->set_rules('bench', 'Bench', 'required');
            $this->form_validation->set_rules('advocate_name', 'Advocate Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('area', 'Area', 'required');
            $this->form_validation->set_rules('village', 'Village', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $case_data = array(
                    'case_type'         =>  $this->input->post('case_type'),
                    'regular_number'    =>  $this->input->post('regular_number'),
                    'lodging_number'    =>  $this->input->post('lodging_number'),
                    'filling_date'      =>  $this->input->post('filling_date'),
                    'department_name'   =>  $this->input->post('department_name'),
                    'bench'             =>  $this->input->post('bench'),
                    'complaint_detail'  =>  $this->input->post('complaint_detail'),
                    'advocate_name'     =>  $this->input->post('advocate_name'),
                    'status'            =>  $this->input->post('status'),
                    'cts_no'            =>  $this->input->post('cts_no'),
                    'society'            =>  $this->input->post('society'),
                    'area'              =>  $this->input->post('area'),
                    'village'           =>  $this->input->post('village'),
                    'description'       =>  $this->input->post('description'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );

                $insert_case_data = $this->Case_model->save_case_data($case_data);

                $case_application_data = array(
                    'case_id'           =>  $insert_case_data,
                    'applicant_name'    =>  $this->input->post('applicant_name'),
                    'respondent_name'   =>  $this->input->post('respondent_name'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                    );

                $insert_case_application_data = $this->Case_model->save_application_respondent($case_application_data);

                $this->session->set_flashdata('success_message', 'Case added successfully');
                redirect(base_url('cases/lists'));

            }
        }


        $data['society'] = $this->Case_model->getSociety();
        $data['area'] = $this->Case_model->getArea();
        $data['village'] = $this->Case_model->getVillage();
        $data['case_type'] = $this->Case_model->getCasetype();
        $data['department'] = $this->Case_model->getDepartment();
        $data['applicant'] = $this->Case_model->getApplicant();
        $data['respondent'] = $this->Case_model->getRespondent();
        $data['advocate'] = $this->Case_model->getAdvocate();
        $data['ctsno'] = $this->Case_model->getCTS();
        $data['bench'] = $this->Case_model->getBench();

        $data['page_title'] = 'Case Add';
        $data['middle_view'] = "add/case_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('case_type', 'Case Type', 'required');
            $this->form_validation->set_rules('regular_number', 'Regular Number', 'required');
            $this->form_validation->set_rules('lodging_number', 'Lodging Number', 'required');
            $this->form_validation->set_rules('filling_date', 'Filling Date', 'required');
            $this->form_validation->set_rules('department_name', 'Department Name', 'required');
            $this->form_validation->set_rules('bench', 'Bench', 'required');
            $this->form_validation->set_rules('advocate_name', 'Advocate Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('area', 'Area', 'required');
            $this->form_validation->set_rules('village', 'Village', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $case_data = array(
                    'id'                =>  $id,
                    'case_type'         =>  $this->input->post('case_type'),
                    'regular_number'    =>  $this->input->post('regular_number'),
                    'lodging_number'    =>  $this->input->post('lodging_number'),
                    'filling_date'      =>  $this->input->post('filling_date'),
                    'department_name'   =>  $this->input->post('department_name'),
                    'bench'             =>  $this->input->post('bench'),
                    'complaint_detail'  =>  $this->input->post('complaint_detail'),
                    'advocate_name'     =>  $this->input->post('advocate_name'),
                    'status'            =>  $this->input->post('status'),
                    'cts_no'            =>  $this->input->post('cts_no'),
                    'society'            =>  $this->input->post('society'),
                    'area'              =>  $this->input->post('area'),
                    'village'           =>  $this->input->post('village'),
                    'description'       =>  $this->input->post('description'),
                    'update_on'          =>  date('Y-m-d H:i:s')
                    );

                $insert_case_data = $this->Case_model->update_case_data($case_data);

                $case_application_data = array(
                    'case_id'           =>  $id,
                    'applicant_name'    =>  $this->input->post('applicant_name'),
                    'respondent_name'   =>  $this->input->post('respondent_name'),
                    'update_on'          =>  date('Y-m-d H:i:s')
                );

                $insert_case_application_data = $this->Case_model->update_application_respondent($case_application_data);

                $this->session->set_flashdata('success_message', 'Case update successfully');
                redirect(base_url('cases/lists'));

            }
        }
        
        $data['society'] = $this->Case_model->getSociety();
        $data['area'] = $this->Case_model->getArea();
        $data['village'] = $this->Case_model->getVillage();
        $data['case_type'] = $this->Case_model->getCasetype();
        $data['department'] = $this->Case_model->getDepartment();
        $data['applicant'] = $this->Case_model->getApplicant();
        $data['respondent'] = $this->Case_model->getRespondent();
        $data['advocate'] = $this->Case_model->getAdvocate();
        $data['ctsno'] = $this->Case_model->getCTS();
        $data['bench'] = $this->Case_model->getBench();

        $data['id']=$id;
        $data['case_detail'] = $this->Case_model->getCaseDetail($id);
        $data['app_res_detail'] = $this->Case_model->getAppResDetail($id);

        $data['page_title'] = 'Case Edit';
        $data['middle_view'] = "add/case_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Case_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Case deleted successfully');
        redirect(base_url('cases/lists'));
    }
}  
                                                                                                         
                                                                                                  
                                                                                                 
                                                                                                   
                                                                                                       
                                                                                                                                           
                                                                                                      
                                                                                               
                                                                                          
