<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Region_model extends CI_Model
{
    public function get_related_hotel($region_id, $hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('region_id', $region_id);
        $result = $this->db->get('igc_region_hotels')->row_array();
        return $result;

    }
}
?>