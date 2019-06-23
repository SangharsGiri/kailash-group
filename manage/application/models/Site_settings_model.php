<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_settings_model extends CI_Model {

    public function insert_site_settings($insert)
    {
        $result = $this->db->insert('igc_site_settings', $insert);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }

    public function update_site_settings($update, $id)
    {
        $this->db->where('id', $id);
       $result = $this->db->update('igc_site_settings', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }


    }

    public function get_site_settings()
    {
        $result = $this->db->get('igc_site_settings')->row_array();
        return $result;
    }





}