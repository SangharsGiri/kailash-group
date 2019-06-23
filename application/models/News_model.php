<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends CI_Model{
    public function get_news($start_point=0, $per_page=0)
    {
        $query = $this->db->query("select * from igc_content
    where publish_status='1' and delete_status='0' order by created desc limit
		{$start_point},{$per_page}");
        $result = $query->result_array();
        return $result;
    }
    public function count_news()
    {
        $this->db->where('publish_status','1');
        $this->db->where('delete_status','0');
        $result = $this->db->get('igc_content')->num_rows();
        return $result;
    }


}