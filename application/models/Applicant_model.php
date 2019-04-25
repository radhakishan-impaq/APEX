<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant_model extends CI_Model {
	private $table = 'applicant';
	public function __construct() {
        $this->load->database();
    }
    public function get() {
        // $data = FALSE;
        $sql = 'SELECT * from applicant where is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotal() {
        return $this->db->count_all($this->table);
    }

    public function getApplicant($id) {
        $data = FALSE;
        $sql = 'SELECT * from applicant where id = "'.$id.'"';
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

    public function update($data) {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->query('UPDATE applicant set is_deleted = "1" where id = "'.$id.'"');
    }
}

?>