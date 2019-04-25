<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Case_model extends CI_Model {
    private $table = 'cases';
    private $table2 = 'case_applicant_respondent';

    public function __construct() {
        $this->load->database();
    }

    public function getCase() {
        // $data = FALSE;
        $sql = 'SELECT * from cases';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

	public function getCasetype()
	{
		$sql = 'SELECT * from casetype where status = "1" and is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
	}

	public function getDepartment()
	{
		$sql = 'SELECT * from department where status = "1" and is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
	}

	public function getApplicant()
	{
		$sql = 'SELECT * from applicant where is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
	}

        public function getRespondent()
    {
        $sql = 'SELECT * from respondent where is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

	public function getAdvocate()
	{
		$sql = 'SELECT * from advocate where status = "1"  and is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
	}

	public function getCTS()
	{
		$sql = 'SELECT * from ctsnumber where status = "1"  and is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
	}

    public function getBench()
    {
        $sql = $this->db->query("SELECT * from bench where status = '1' and is_deleted = '0'");
        foreach ($sql->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getArea()
    {
        $sql = $this->db->query("SELECT * from area where status = '1' and is_deleted = '0'");
        foreach ($sql->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getVillage()
    {
        $sql = $this->db->query("SELECT * from village where status = '1' and is_deleted = '0'");
        foreach ($sql->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getSociety()
    {
        $sql = $this->db->query("SELECT * from society where status = '1' and is_deleted = '0'");
        foreach ($sql->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function save_case_data($case_data)
    {
        $this->db->insert($this->table, $case_data);
        return $this->db->insert_id();
    }

    public function save_application_respondent($case_application_data)
    {
        $case_id = $case_application_data['case_id'];
        $applicant_name = $case_application_data['applicant_name'];
        $respondent_name = $case_application_data['respondent_name'];
        $added_on = $case_application_data['added_on'];

        if(count($applicant_name) > count($respondent_name))
        {
        $count = count($applicant_name);
        }
        else
        {
        $count = count($respondent_name);
        }

        for ($i=0; $i < $count; $i++) 
        { 
            $sql = "INSERT INTO `case_applicant_respondent`(`case_id`, `applicant_name`, `respondent_name`, `added_on`) VALUES ('$case_id', '$applicant_name[$i]', '$respondent_name[$i]', '$added_on')";
            $query = $this->db->query($sql);
        }
    }

    public function getCaseDetail($id)
    {
        $sql = "SELECT * from cases where id = '".$id."'";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAppResDetail($id)
    {
        $sql = "SELECT * from case_applicant_respondent where case_id = '".$id."'";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function update_case_data($case_data)
    {
        $this->db->where('id', $case_data['id']);
        unset($case_data['id']);
        $this->db->update($this->table, $case_data);
    }

    public function update_application_respondent($case_application_data)
    {
        $case_id = $case_application_data['case_id'];
        $applicant_name = $case_application_data['applicant_name'];
        $respondent_name = $case_application_data['respondent_name'];
        $update_on = $case_application_data['update_on'];

        $select = $this->db->query("SELECT * from case_applicant_respondent where case_id = '$case_id'");
        foreach ($select->result_array() as $row) {
            $added_on = $row['added_on'];
        }

        $delete = "DELETE from `case_applicant_respondent` where `case_id`='$case_id'";
        $this->db->query($delete);

        if(count($applicant_name) > count($respondent_name))
        {
            $count = count($applicant_name);
        }
        else
        {
            $count = count($respondent_name);
        }

        for ($i=0; $i < $count; $i++) 
        { 
            $sql = "INSERT INTO `case_applicant_respondent`(`case_id`, `applicant_name`, `respondent_name`, `added_on`,`update_on`) VALUES ('$case_id', '$applicant_name[$i]', '$respondent_name[$i]' ,'$added_on' ,'$update_on')";
            $query = $this->db->query($sql);
        }
    }

    public function delete($id)
    {
        $cases_delete = $this->db->query("DELETE cases where id = '".$id."'");
        $case_applicant_respondent_delete = $this->db->query("DELETE case_applicant_respondent where case_id = '".$id."'");
    }
}
?>