<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Activity_model extends CI_Model{

    //function to check the album exist

    public function check_album_exist($activity_id, $album_id)
    {
        $this->db->where('activity_id', $activity_id);
        $this->db->where('album_id', $album_id);
        $result = $this->db->get('igc_activity_album')->row_array();
        return $result;
    }

    public function get_related_packages($activity_id, $package_id)
    {
        $this->db->where('activity_id', $activity_id);
        $this->db->where('package_id', $package_id);
        $result = $this->db->get('igc_activity_packages')->row_array();
        return $result;
    }

}