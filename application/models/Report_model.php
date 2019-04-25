<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
	private $table = 'cases';
	public function __construct() {
        $this->load->database();
    }

    public function case_types()
    {
        $query = $this->db->query('SELECT * FROM casetype where status = "1" and is_deleted = "0"');
        return $query->result_array();
    }

    public function society_name()
    {
        $query = $this->db->query('SELECT * FROM society where status = "1" and is_deleted = "0"');
        return $query->result_array();
    }

    public function applicant()
    {
        $query = $this->db->query('SELECT * FROM applicant where is_deleted = "0"');
        return $query->result_array();
    }

    public function respondent()
    {
        $query = $this->db->query('SELECT * FROM respondent where is_deleted = "0"');
        return $query->result_array();
    }

    public function area()
    {
        $query = $this->db->query('SELECT * FROM area where status = "1" and is_deleted = "0"');
        return $query->result_array();
    }

    public function status_report($data)
    {
    	$query = $this->db->query('
    		SELECT c.id, c.regular_number , c.filling_date, c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, c.status
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE c.filling_date >= "'.$data['start_date'].'" AND
                c.filling_date <= "'.$data['end_date'].'" AND
                c.status = "'.$data['status'].'"
            GROUP BY c.id
    		');
        return $query->result_array();
    }

    public function closed_case_report($data)
    {
        $query = $this->db->query('
            SELECT c.id, c.regular_number , c.filling_date, c.case_type, GROUP_CONCAT(car.applicant_name) as applicant_name, c.status, DATE_FORMAT(DATE(c.filling_date), "%Y") as year
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE c.case_type >= "'.$data['case_type'].'" AND
                DATE_FORMAT(DATE(c.filling_date), "%Y") = "'.$data['year'].'" AND
                c.status = "Close for order";
            GROUP BY c.id
            ');
        return $query->result_array();
    }

    public function name_report($data)
    {
        $query = $this->db->query('
            SELECT c.regular_number , c.society, c.filling_date, GROUP_CONCAT(car.applicant_name) as applicant_name, c.status, DATE_FORMAT(DATE(c.filling_date), "%Y") as year
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE c.society = "'.$data['society_name'].'" AND
                c.case_type = "'.$data['case_type'].'" AND
                DATE_FORMAT(DATE(c.filling_date), "%Y") <= "'.$data['year'].'"
            ');
        return $query->result_array();
    }

    public function multiple_report($data)
    {
        $query = $this->db->query('
            SELECT  c.regular_number , 
                    c.society, 
                    c.filling_date, 
                    GROUP_CONCAT(car.applicant_name) as applicant_name, 
                    GROUP_CONCAT(car.respondent_name) as respondent_name,
                    c.status, DATE_FORMAT(DATE(c.filling_date), "%Y") as year
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE   c.case_type = "'.$data['case_type'].'" AND
                    c.filling_date >= "'.$data['start_date'].'" AND
                    c.filling_date <= "'.$data['end_date'].'" AND
                    c.status = "'.$data['status'].'" AND
                    c.society = "'.$data['society_name'].'" AND
                    DATE_FORMAT(DATE(c.filling_date), "%Y") <= "'.$data['year'].'"
            GROUP BY c.id
            ');
        return $query->result_array();
    }

    public function pending_report($data)
    {
        $query = $this->db->query('
            SELECT  c.regular_number , 
                    c.society, 
                    c.filling_date, 
                    GROUP_CONCAT(car.applicant_name) as applicant_name, 
                    GROUP_CONCAT(car.respondent_name) as respondent_name,
                    c.status, DATE_FORMAT(DATE(c.filling_date), "%Y") as year
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE   c.case_type = "'.$data['case_type'].'" AND
                    c.filling_date >= "'.$data['start_date'].'" AND
                    c.filling_date <= "'.$data['end_date'].'" AND
                    DATE_FORMAT(DATE(c.filling_date), "%Y") <= "'.$data['year'].'"
            ');
        return $query->result_array();
    }

    public function area_report($data)
    {
        $query = $this->db->query('
            SELECT  c.regular_number , 
                    c.society, 
                    c.filling_date,
                    c.area,
                    c.society,
                    GROUP_CONCAT(car.applicant_name) as applicant_name, 
                    GROUP_CONCAT(car.respondent_name) as respondent_name,
                    c.status, DATE_FORMAT(DATE(c.filling_date), "%Y") as year
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            WHERE   c.case_type = "'.$data['case_type'].'" AND
                    c.area = "'.$data['area_name'].'" AND
                    c.society = "'.$data['society_name'].'" AND
                    DATE_FORMAT(DATE(c.filling_date), "%Y") = "'.$data['year'].'"
            ');
        return $query->result_array();
    }

    public function directive_report($date)
    {
        $query = $this->db->query('SELECT c.regular_number, GROUP_CONCAT(car.applicant_name) as applicant_name, DATE_FORMAT(DATE(c.filling_date), "%Y") as year, d.status, d.department, d.end_date
                    FROM directive as d
                    join cases as c on c.id = d.case_id
                    join case_applicant_respondent as car on car.case_id = c.id
                    where d.end_date >= "'.$date.'" and d.status = "pending" group by d.id 
                ');
        return $query->result_array();
    }
}