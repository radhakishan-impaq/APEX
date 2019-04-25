<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_cause_list_model extends CI_Model {
	private $table = 'causelist';
	public function __construct() {
        $this->load->database();
    }
    public function get() {
        // $data = FALSE;
        $sql = 'SELECT * from causelist order by added_on DESC';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }
}