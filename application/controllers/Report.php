<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Report extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
        $this->load->library('form_validation');
    }

    public function status_report()
    {
    	if($this->input->post())
        {
        	$data = array(
        		'start_date'	=>	$this->input->post('start_date'),
        		'end_date'		=>	$this->input->post('end_date'),
        		'status'		=>	$this->input->post('status'),
        		);

        	$data['detail'] = $this->Report_model->status_report($data);

            $data['record_found'] = 'asdfasdf';
            // echo "<pre>";print_r($data['detail']); die();

        }
        
        $data['page_title'] = 'Status Report';
        $data['middle_view'] = "report/status_report";
        $this->load->view('template/main_template',$data); 
    }

    public function close_case()
    {
        if($this->input->post())
        {
            $data = array(
                'case_type'    =>  $this->input->post('case_type'),
                'year'      =>  $this->input->post('year')
                );

            $data['detail'] = $this->Report_model->closed_case_report($data);

            $data['record_found'] = 'asdfasdf';
            // echo "<pre>";print_r($data['detail']); die();

        }

        $data['case_type'] = $this->Report_model->case_types();
        $data['year'] = array(date('Y')-1,date('Y'));
        $data['page_title'] = 'Closed Case Report';
        $data['middle_view'] = "report/closed_case_report";
        $this->load->view('template/main_template',$data); 
    }

    public function name_report()
    {
        if($this->input->post())
        {
            $data = array(
                'case_type'         =>  $this->input->post('case_type'),
                'society_name'      =>  $this->input->post('society_name'),
                'applicant'         =>  $this->input->post('applicant'),
                'year'              =>  $this->input->post('year')
            );
            $data['detail'] = $this->Report_model->name_report($data);

            $data['record_found'] = 'asdfasdf';
            // echo "<pre>";print_r($data['detail']); die();

        }

        $data['society_name'] = $this->Report_model->society_name();
        $data['applicant'] = $this->Report_model->applicant();
        $data['case_type'] = $this->Report_model->case_types();
        $data['year'] = array(date('Y')-1,date('Y'));
        $data['page_title'] = 'By Name Report';
        $data['middle_view'] = "report/name_report";
        $this->load->view('template/main_template',$data);
    }

    public function multiple_report()
    {
        if($this->input->post())
        {
            $data = array(
                'case_type'         =>  $this->input->post('case_type'),
                'start_date'        =>  $this->input->post('start_date'),
                'end_date'          =>  $this->input->post('end_date'),
                'status'            =>  $this->input->post('status'),
                'applicant'         =>  $this->input->post('applicant'),
                'respondent'        =>  $this->input->post('respondent'),
                'society_name'      =>  $this->input->post('society_name'),
                'year'              =>  $this->input->post('year')
            );

            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');

            $data['detail'] = $this->Report_model->multiple_report($data);

            // var_dump($data['detail']);
            // die();

            $data['record_found'] = 'asdfasdf';
            // echo "<pre>";print_r($data['detail']); die();

        }

        $data['society_name'] = $this->Report_model->society_name();
        $data['applicant'] = $this->Report_model->applicant();
        $data['respondent'] = $this->Report_model->respondent();
        $data['case_type'] = $this->Report_model->case_types();
        $data['year'] = array(date('Y')-1,date('Y'));

        $data['page_title'] = 'Multiple Report';
        $data['middle_view'] = "report/multiple_report";
        $this->load->view('template/main_template',$data);
    }

    public function pending_report()
    {
        if($this->input->post())
        {
            $data = array(
                'case_type'         =>  $this->input->post('case_type'),
                'start_date'        =>  $this->input->post('start_date'),
                'end_date'          =>  $this->input->post('end_date'),
                'year'              =>  $this->input->post('year')
            );

            $data['start_date'] = $this->input->post('start_date');
            $data['end_date'] = $this->input->post('end_date');

            $data['detail'] = $this->Report_model->pending_report($data);

            $data['record_found'] = 'asdfasdf';
            // echo "<pre>";print_r($data['detail']); die();

        }
        $data['case_type'] = $this->Report_model->case_types();
        $data['year'] = array(date('Y')-1,date('Y'));

        $data['page_title'] = 'Pending Report';
        $data['middle_view'] = "report/pending_report";
        $this->load->view('template/main_template',$data);
    }

    public function area_report()
    {
        if($this->input->post())
        {
            $data = array(
                'case_type'         =>  $this->input->post('case_type'),
                'area_name'         =>  $this->input->post('area_name'),
                'society_name'      =>  $this->input->post('society_name'),
                'year'              =>  $this->input->post('year')
            );

            $data['detail'] = $this->Report_model->area_report($data);

            $data['record_found'] = 'asdfasdf';
            // echo "<pre>";print_r($data['detail']); die();

        }

        $data['society_name'] = $this->Report_model->society_name();
        $data['area'] = $this->Report_model->area();
        $data['case_type'] = $this->Report_model->case_types();
        $data['year'] = array(date('Y')-1,date('Y'));

        $data['page_title'] = 'Multiple Report';
        $data['middle_view'] = "report/area_report";
        $this->load->view('template/main_template',$data);
    }

    public function directive_report()
    {
        $date = date('Y-m-d');

        $data['date'] = date('Y-m-d');

        $data['detail'] = $this->Report_model->directive_report($date);

        $data['page_title'] = 'Directive Report';
        $data['middle_view'] = "report/directive_pending_report";
        $this->load->view('template/main_template',$data);
    }
}