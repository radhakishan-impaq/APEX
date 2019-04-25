<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Case_status_model extends CI_Model {
    private $table = 'cases';

    public function __construct() {
        $this->load->database();
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

	public function status_report_by_number($data)
	{
		$query = $this->db->query('
    		SELECT c.id, c.regular_number , c.filling_date, c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, GROUP_CONCAT(car.respondent_name) as respondent_name, c.status, DATE_FORMAT(DATE(c.filling_date), "%Y") as year
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE c.case_type = "'.$data['case_type'].'" AND
                c.regular_number = "'.$data['regular_number'].'" AND
                DATE_FORMAT(DATE(c.filling_date), "%Y") = "'.$data['year'].'"
            GROUP BY c.id
    		');
        return $query->result_array();
	}

	public function status_report_by_name($data)
	{
		$query = $this->db->query('
    		SELECT c.id, c.regular_number , c.filling_date, c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, GROUP_CONCAT(car.respondent_name) as respondent_name, c.status, DATE_FORMAT(DATE(c.filling_date), "%Y") as year
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE c.case_type = "'.$data['case_type'].'" AND
                car.applicant_name = "'.$data['name'].'" AND
                DATE_FORMAT(DATE(c.filling_date), "%Y") = "'.$data['year'].'"
            GROUP BY c.id
    		');
        return $query->result_array();
	}
}