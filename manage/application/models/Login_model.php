<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function check_user($username, $password)
    {
        $this->db->where('username', $username)->where('password', $password)->where('status','1')->where('delete_status','0');
        $row = $this->db->get('igc_users')->row_array();
        return $row;
    }

    public function get_admin_user_name($user_id)
    {
        $this->db->select('username');
        $row = $this->db->where('user_id', $user_id)->get('igc_users')->row_array();
        return $row;
    }


    public function update_info($date , $admin_id)
    {
        $update['last_login'] = $date;
        $this->db->where('user_id', $admin_id);
        $this->db->update('igc_users', $update);
        return TRUE;
    }









}