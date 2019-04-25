<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
	private $table = 'case_order';
	public function __construct() {
        $this->load->database();
    }
    public function get() {
        // $data = FALSE;
        $sql = 'SELECT * from case_order';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotal() {
        return $this->db->count_all($this->table);
    }

    public function getOrder($id) {
        // $data = FALSE;
        $sql = 'SELECT * from case_order where id = "'.$id.'"';
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

    public function update_case_status($data)
    {
        $sql = $this->db->query('UPDATE cases set status = "'.$data['status'].'" WHERE id = "'.$data['case_id'].'"');
    }

    public function update($data) {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
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

    public function order_case($fetch_case)
    {
        $query = $this->db->query('
            SELECT *
            FROM case_order 
            WHERE case_id = "'. $fetch_case[0]["id"] .'"
            ');
        return $query->result_array();
    }

    public function case_order_report($fetch_case_order)
    {
        $query = $this->db->query('SELECT co.id as case_order_id, c.id as id, c.regular_number , co.date, c.case_type, co.status, GROUP_CONCAT(car.applicant_name) as applicant_name, GROUP_CONCAT(car.respondent_name) as respondent_name
            FROM case_order AS co
            JOIN cases AS c ON co.case_id = c.id
            JOIN case_applicant_respondent AS car ON car.case_id = c.id
            WHERE c.id = "'. $fetch_case_order[0]["case_id"] .'" group by co.id');
        return $query->result_array();
    }
}

?>