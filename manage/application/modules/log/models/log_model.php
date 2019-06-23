<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Log_model extends CI_Model{

    public function get_logs($from, $to)
    {
        $query = $this->db->query("select * from igc_user_logs where date between '$from' and '$to' order by date desc");
        $result = $query->result_array();
        return $result;
    }

    public function get_today_logs($date)
    {

        $query = $this->db->query("select * from igc_user_logs where date like '%$date%' order by date desc;");
        $result = $query->result_array();
        return $result;
    }

}