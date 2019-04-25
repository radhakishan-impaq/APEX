<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	private $table = 'user';
	public function __construct() {
        $this->load->database();
    }

    function login($email, $password){
    	$query = $this->db->query('SELECT * FROM user where email = "'.$email.'" AND password = "'.md5($password).'" AND status = "1"');
    	foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }
}