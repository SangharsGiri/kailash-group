<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forex_model extends CI_Model{

    public function insert_forex($insert)
    {
        $this->db->insert($insert, 'igc_forex_index');
        $result = $this->db->insert_id();
        return $result;
    }


}
