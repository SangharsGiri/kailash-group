<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logo_model extends CI_Model{
    //get all related packages

    public function get_related_packages($review_id, $package_id)
    {
        $this->db->where('review_id', $review_id);
        $this->db->where('package_id', $package_id);
        $result = $this->db->get('igc_package_review')->row_array();
      return $result;
    }


}