<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class igcpay_model extends CI_Model{

    public function get_setting_list()
    {
        $this->db->where('delete_status','0');
        $result = $this->db->get('igc_payment_settings')->result_array();
        return $result;
    }


    public function insert_setting($insert)
    {
       $this->db->insert('igc_payment_settings', $insert);
        $result =  $this->db->insert_id();
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }

    public function update_setting($update, $id)
    {
        $this->db->where('delete_status', '0');
        $this->db->where('id', $id);
        $result = $this->db->update('igc_payment_settings', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }


    //function to get  detail

    public function get_detail($id)
    {
        $this->db->where('delete_status','0');
        $this->db->where('id',$id);
        $result = $this->db->get('igc_payment_settings')->row_array();
        return $result;

    }


    //function to change setting status

    public function change_status($id)
    {
        $update['active_status'] ="0";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('id !=', $id);
        $result = $this->db->update('igc_payment_settings', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }



    //delete  setting

    public function delete_setting($id)
    {
        $update['updated'] = date('Y-m-d:H:i:s');
        $update['delete_status']= "1";
        $this->db->where('id', $id);
        $result = $this->db->update('igc_payment_settings', $update);
        return $result;
    }




}