<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {
	private $table = 'attendance_date';

	public function __construct() {
        $this->load->database();
    }

    public function get()
    {
        $query = $this->db->query('
            SELECT ad.id as id, ad.dates as date, count(case am.attendance when "1" then 1 else null end) as present, count(case am.attendance when "0" then 1 else null end) as absent 
            from attendance_member as am 
            join attendance_date as ad ON ad.id = am.date_id 
            join members as m ON m.id = am.member_id 
            where m.is_deleted = "0"
            group by ad.dates');
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function attendance_date($date)
    {
        $query = $this->db->query('SELECT * FROM attendance_date WHERE dates = "'.$date.'"');
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function new_attendance_date()
    {
        $query = $this->db->query('SELECT * FROM members WHERE status = "1"');
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

    public function save_attendance($insert_date,$member,$reason,$attendance,$added_on)
    {
        for ($i=0; $i < count($attendance); $i++) { 
            $query = $this->db->query("INSERT INTO `attendance_member` (`date_id`,`member_id`,`attendance`,`reason`,`added_on`) VALUES ('$insert_date', '$member[$i]', '$attendance[$i]', '$reason[$i]', '$added_on')");
        }
    }

    public function update_attendance($am_id,$date_id,$member,$reason,$attendance,$update_on)
    {
        for ($i=0; $i < count($attendance); $i++) { 
            $query = $this->db->query("UPDATE attendance_member SET 
                member_id = '".$member[$i]."',
                attendance = '".$attendance[$i]."',
                reason = '".$reason[$i]."',
                update_on = '".$update_on."' where date_id = '".$date_id."' AND id = '".$am_id[$i]."'
                ");
        }
    }

    public function getAttendance($id)
    {
        $query = $this->db->query("SELECT am.id as am_id, m.member_name, am.*, ad.dates as date FROM attendance_date as ad join attendance_member as am on am.date_id = ad.id join members as m ON m.id = am.member_id where ad.id = '".$id."'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM attendance_member WHERE date_id = "'.$id.'"');
        $this->db->query('DELETE FROM attendance_date WHERE id = "'.$id.'"');
    }
}

?>