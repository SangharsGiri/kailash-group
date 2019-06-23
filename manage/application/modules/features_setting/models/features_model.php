<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Features_model extends CI_Model{

    public function get_features_list()
    {
        $this->db->where('delete_status','0');
        $result = $this->db->get('igc_features_setting')->result_array();
        return $result;
    }

    public function get_name(){

    	$this->db->where('delete_status', '0');
    	$this->db->where('parent_id', '0');
    	$result = $this->db->get('igc_features_setting')->result_array();
    	return $result;

    }

     //getting information of child
    public function get_child($id){

    	$this->db->where('delete_status', '0');
    	$this->db->where('parent_id', $id);
    	$result = $this->db->get('igc_features_setting')->result_array();
    	return $result;
    	   	
    }

    public function insert_features($insert){
         $this->db->insert('igc_features_setting', $insert);
        $result =  $this->db->insert_id();
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
        $result = $this->db->get('igc_features_setting')->row_array();
        return $result;

    }


    public function insert_child($inserts){

    	$this->db->insert('igc_features_setting', $inserts);
    	$result = $this->db->insert_id();
    	if($result){
    		return $result;
    	}else{
    		return false;
    	}
    }



    //delete features

    public function delete_features($id)
    {
        $update['updated'] = date('Y-m-d:H:i:s');
        $update['delete_status']= "1";
        $this->db->where('id', $id);
        $result = $this->db->update('igc_features_setting', $update);
        return $result;
    }

}