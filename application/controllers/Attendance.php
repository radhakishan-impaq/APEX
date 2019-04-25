<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendance extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Attendance_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        // $this->config->load('custom');
    }

    public function lists() {
        
        $data['page_title'] = 'Attendance';
        $data['middle_view'] = "add/attendance_list";
        $this->load->view('template/main_template',$data); 
    }

    function ajaxlist()
    {
        $data_list = $this->Attendance_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('attendance/edit/'.$r['id']) .'"><button type="button" class="btn btn-success">Edit</button></a>';
        $delete = anchor("attendance/delete/".$r['id'],"Delete",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn btn-danger"));

        $data[] = array(
            date('d F - Y',strtotime($r['date'])),
            $r['present'],
            $r['absent'],
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
            $current_data=$this->Attendance_model->new_attendance_date();
            $date = $this->input->post('date');
            $reason = $this->input->post('reason');
            foreach ($current_data as $cd) {
                $attendance[] = $this->input->post($cd['id']);
            }
            $member = $this->input->post('member');

            $data = array(
                    'dates'         =>  $date,
                    'added_on'      =>  date('Y-m-d H:i:s')
                );
            $added_on = date('Y-m-d H:i:s');

            $insert_date = $this->Attendance_model->save($data);

            $insert_member = $this->Attendance_model->save_attendance($insert_date,$member,$reason,$attendance,$added_on);

            $this->session->set_flashdata('success_message', 'Attendance added successfully');
            redirect(base_url('attendance/lists'));

        }
        $data['page_title'] = 'Attendance Add';
        $data['middle_view'] = "add/attendance_add";
        $this->load->view('template/main_template',$data); 
    }

    public function members_for_attendance()
    {
        $date = $this->input->get('date');

        $previous_data = $this->Attendance_model->attendance_date($date);
        $current_data = $this->Attendance_model->new_attendance_date();

        if(count($current_data) > 0)
        {
            if(count($previous_data) > 0)
            {
                $data['previous_attendance_data'] = 1;
            }
            else
            {
                $data['previous_attendance_data'] = 0;
            }
            $data['current_attendance_data']=$current_data;
        }

        $this->load->view('add/ajax_members',$data);
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $date_id = $this->input->post('id');
            $detail = $this->Attendance_model->getAttendance($date_id);

            foreach ($detail as $d) {
                $attendance[] = $this->input->post($d['id']);
                $am_id[] = $d['am_id'];
            }
            $member = $this->input->post('member');
            $reason = $this->input->post('reason');
            $update_on = date('Y-m-d H:i:s');

            $update_member = $this->Attendance_model->update_attendance($am_id,$date_id,$member,$reason,$attendance,$update_on);

            $this->session->set_flashdata('success_message', 'Attendance added successfully');
            redirect(base_url('attendance/lists'));

        }
        $data['detail']=$this->Attendance_model->getAttendance($id);

        $data['id']=$id;

        $data['page_title'] = 'Attendance Edit';
        $data['middle_view'] = "add/attendance_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        echo "<script>alert('This card was not approved, Thanks.');</script>";
        $this->Attendance_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Attendance deleted successfully');
        redirect(base_url('attendance/lists'));
    }
}