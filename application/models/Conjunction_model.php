<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conjunction_model extends CI_Model {
	private $table = 'society';
	public function __construct() {
        $this->load->database();
    }

    public function society_list($datas)
    {
        $query = $this->db->query('SELECT * FROM cases where society = "'.$datas['society'].'"');
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getSociety()
    {
        $query = $this->db->query('SELECT * from society where status = "1" and is_deleted = "0"');
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    // public function join_society($data)
    // {
        
    // }
}

?>