<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail_setting_model extends CI_Model{

    public function get_mail_setting_list()
    {
        $this->db->where('delete_status','0');
        $result = $this->db->get('igc_mail_server_setting')->result_array();
        return $result;
    }

    public function get_mail_list()
    {
        $this->db->where('delete_status','0');
        $result = $this->db->get('igc_admin_email')->result_array();
        return $result;
    }

    public function insert_server_setting($insert)
    {
       $this->db->insert('igc_mail_server_setting', $insert);
        $result =  $this->db->insert_id();
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }

    public function update_server_setting($update, $id)
    {
        $this->db->where('delete_status', '0');
        $this->db->where('id', $id);
        $result = $this->db->update('igc_mail_server_setting', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }


    //function to get mail server detail

    public function get_server_detail($id)
    {
        $this->db->where('delete_status','0');
        $this->db->where('id',$id);
        $result = $this->db->get('igc_mail_server_setting')->row_array();
        return $result;

    }


    //function to change the server status

    public function change_server_status($id)
    {
        $update['active_status'] ="0";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('id !=', $id);
        $result = $this->db->update('igc_mail_server_setting', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }


    //function to check the server passsword

    public function check_password($password, $id)
    {
        $this->db->select('password');
        $this->db->where('delete_status','0');
        $this->db->where('id',$id);
        $this->db->where('password',$password);
        $result = $this->db->get('igc_mail_server_setting')->row_array();
        return $result;
    }

    //delete server setting

    public function delete_server_setting($id)
    {
        $update['updated'] = date('Y-m-d:H:i:s');
        $update['delete_status']= "1";
        $this->db->where('id', $id);
        $result = $this->db->update('igc_mail_server_setting', $update);
        return $result;
    }


    // function get admin email detail

    public function get_admin_email_detail($admin_id)
    {
        $this->db->where('delete_status','0');
        $this->db->where('admin_id',$admin_id);
        $result = $this->db->get('igc_admin_email')->row_array();
        return $result;

    }

    // function to insert new admin email

    public function insert_admin_mail($insert)
    {
       $this->db->insert('igc_admin_email', $insert);
        $result = $this->db->insert_id();
        if($result)
        {
            return $result;
        }
        else{
           return false;
        }
    }


    //function to update admin mail

    public function update_admin_mail($update, $id)
    {
        $this->db->where('delete_status', '0');
        $this->db->where('admin_id', $id);
        $result = $this->db->update('igc_admin_email', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    //function to delete admin email

    public function delete_admin_mail($id)
    {
        $update['delete_status'] = "1";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('admin_id', $id);
        $result = $this->db->update('igc_admin_email', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }

    //function get all mailing types


    public function get_mailing_types()
    {
        $result = $this->db->get('igc_mailing_type')->result_array();
        return $result;
    }


    //function to get mail setting detail

    public function get_mail_setting($admin_id, $type_id)
    {
        $this->db->where('admin_id',$admin_id);
        $this->db->where('type_id',$type_id);
        $result = $this->db->get('igc_admin_mail_setting')->row_array();
        return $result;

    }
///function to insert mailing types

    public function insert_mailing_types($insert)
    {
        $result = $this->db->insert('igc_admin_mail_setting', $insert);
        return $result;
    }

    //function to delete the mailing types for admin

    public function delete_mailing_types($admin_id)
    {
        $this->db->where('admin_id', $admin_id);
      $result=   $this->db->delete('igc_admin_mail_setting');
        return $result;
    }


    //function to get active mail server

    public function active_mail_server()
    {
        $this->db->where('active_status', '1');
        $this->db->where('delete_status', '0');
        $result = $this->db->get('igc_mail_server_setting')->row_array();
        return $result;

    }

    //function to get admin email

    public function get_admin_mails($type)
    {
        $query = $this->db->query("select am.full_name, am.email from igc_admin_email am join igc_admin_mail_setting ms on
        am.admin_id = ms.admin_id join  igc_mailing_type mt on ms.type_id = mt.type_id where am.active_status='1' and
        am.delete_status = '0' and mt.type_name = '$type'");
        $result = $query->result_array();
        return $result;
    }



}