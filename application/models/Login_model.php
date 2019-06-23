<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function check_user($email, $password)
    {
        $this->db->where('email', $email)->where('password', $password)->where('customer_type','register')->where('active_status','Y');
        $row = $this->db->get('igc_site_users')->row_array();
        return $row;
    }

    public function get_admin_user_name($customer_id)
    {
        $this->db->select('username');
        $row = $this->db->where('customer_id', $customer_id)->get('igc_package_customer')->row_array();
        return $row;
    }



    public function check_email_exist($email)
    {
        $this->db->where('email', $email);
        $this->db->where('customer_type','register');
        $result = $this->db->get('igc_site_users')->row_array();
        return $result;
    }


    public function get_activation_detail($code)
    {
        $this->db->where('activation_code', $code);
        $this->db->where('customer_type','register');
        $this->db->where('active_status','N');
        $result = $this->db->get('igc_site_users')->row_array();
        return $result;
    }

//    public function customer_register($insert)
//    {
//        $result = $this->db->insert('igc_package_customer', $insert);
//        if($result)
//        {
//            return $result;
//        }
//        else
//        {
//            return false;
//        }
//    }


    public function update_activation($email, $update)
    {
        $this->db->where('email', $email);
        $this->db->where('customer_type','register');
        $result = $this->db->update('igc_site_users', $update);
        return $result;

    }

    public function update_password($email, $update)
    {
        $this->db->where('email', $email);
        $this->db->where('customer_type','register');
        $result = $this->db->update('igc_package_customer', $update);
        return $result;

    }











}