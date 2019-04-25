<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	private $table = 'case';
	public function __construct() {
        $this->load->database();
    }

    public function last_cases($day)
    {
    	$query = $this->db->query('SELECT c.id, c.regular_number , c.filling_date, c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, c.status, DATE_FORMAT(DATE(c.filling_date), "%d-%m-%Y")
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
  			where DATE_FORMAT(DATE(c.filling_date), "%d-%m-%Y") <= "'.$day.'"
            GROUP BY c.id
    		');
    	return $query->result_array();
    }

    public function directive()
    {
    	$query = $this->db->query('SELECT d.end_date, c.id, c.regular_number , c.filling_date, c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, d.status
            FROM directive as d
            JOIN cases as c ON d.case_id = c.id
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            GROUP BY d.id
    		');
    	return $query->result_array();
    }

}