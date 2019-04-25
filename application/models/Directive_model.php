<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directive_model extends CI_Model {
	private $table = 'directive';
	public function __construct() {
        $this->load->database();
    }

    function getCasetype()
    {
        $sql = 'SELECT * from casetype where status = "1" and is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->table, $data);
    }

    public function case_report($data)
    {
        $query = $this->db->query('SELECT c.id, c.regular_number , c.filling_date, c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, GROUP_CONCAT(car.respondent_name) as respondent_name
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE c.regular_number = "'.$data["regular_no"].'" AND 
                  c.case_type = "'.$data["case_type"].'" AND 
                  DATE_FORMAT(DATE(c.filling_date), "%Y") = "'.$data["year"].'" 
            GROUP BY c.id');
        return $query->result_array();
    }

    public function directive_report($data)
    {
        $query = $this->db->query('
            SELECT *
            FROM directive 
            WHERE case_id = "'. $data[0]["id"] .'"
            ');
        return $query->result_array();
    }

    public function fetch_directive_report($data)
    {
        $query = $this->db->query('SELECT d.id as directive_id, d.status as d_status, c.id as id, c.regular_number , c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, GROUP_CONCAT(car.respondent_name) as respondent_name
            FROM directive AS d
            JOIN cases AS c ON d.case_id = c.id
            JOIN case_applicant_respondent AS car ON car.case_id = c.id
            WHERE c.id = "'. $data[0]["case_id"] .'" group by d.id');
        return $query->result_array();
    }

    public function getDepartment()
    {
        $query = $this->db->query('SELECT * FROM department where status = "1" and is_deleted = "0"');
        return $query->result_array();
    }

    public function getDirective($id) {
        // $data = FALSE;
        $sql = 'SELECT * from directive where id = "'.$id.'"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }
}

?>