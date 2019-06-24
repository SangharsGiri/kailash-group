<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    public function get_active_records($table,$limit)
    {
        $this->db->where('publish_status', "1");
        $this->db->order_by('created','DESC')->limit($limit);
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_featured_package()
    {
        $sql = "SELECT * FROM igc_package INNER JOIN igc_category_packages ON igc_category_packages.package_id = igc_package.package_id where category_id = '74' AND status = '1' AND delete_status = '0' ORDER BY created DESC limit 6";
        $query = $this->db->query($sql);
        return $query->result_array();

    }


}
