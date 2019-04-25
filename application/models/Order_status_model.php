<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_status_model extends CI_Model {
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
    		SELECT co.date, co.order_file, c.regular_number, c.status
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            Join case_order as co ON c.id = co.case_id
            WHERE   c.case_type = "'.$data['case_type'].'" AND
                    c.regular_number = "'.$data['regular_number'].'" AND
                    DATE_FORMAT(DATE(c.filling_date), "%Y") = "'.$data['year'].'"
    		');
        return $query->result_array();
	}

	public function status_report_by_name($data)
	{
		$query = $this->db->query('
    		SELECT co.date, co.order_file, c.regular_number, c.status
            FROM cases as c
            JOIN case_applicant_respondent as car ON c.id = car.case_id
            Join case_order as co ON c.id = co.case_id
            WHERE   c.case_type = "'.$data['case_type'].'" AND
                    car.applicant_name = "'.$data['name'].'" AND
                    DATE_FORMAT(DATE(c.filling_date), "%Y") = "'.$data['year'].'"
    		');
        return $query->result_array();
	}
}