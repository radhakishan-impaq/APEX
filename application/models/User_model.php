<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	private $table = 'user';
	public function __construct() {
        $this->load->database();
    }
    public function get() {
        $data = FALSE;
        $sql = 'SELECT * from user where status = "1" AND is_deleted = "0" AND role != "admin"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotal() {
        return $this->db->count_all($this->table);
    }

    public function getUser($id) {
        $data = FALSE;
        $sql = 'SELECT * from user where id = "'.$id.'" AND status = "1"';
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
        $this->db->query('UPDATE user set is_deleted = "1" where id = "'.$id.'"');
    }
}

?>