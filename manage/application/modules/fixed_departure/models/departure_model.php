<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Departure_model extends CI_Model
{
  public function get_departures($package_id)
  {
      $query =  $this->db->query("select d.*, p.package_name from igc_package_departure d join igc_package p ON 
d.package_id = p.package_id  where d.package_id = '$package_id' and 
d.delete_status = '0'  order by d.departure_id desc");
      $result =  $query->result_array();
      return $result;
  }

    //function to get depature price

    public function get_departure_price_detail($departure_id, $currency_id)
    {
        $this->db->where('departure_id', $departure_id);
        $this->db->where('currency_id', $currency_id);
        $result = $this->db->get('igc_departure_price')->row_array();
        return $result;
    }

    public function get_accommodations()
    {
        $this->db->where('status', '1');
        $result = $this->db->get('igc_accommodation_setting')->result_array();
        return $result;
    }
}
?>