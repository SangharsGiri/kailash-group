<?php
class Hotel_model extends  CI_Model
{
	public function get_hotel_list()
    {
        $this->db->where('delete_status','0');
        $this->db->order_by('id','desc');
        $result = $this->db->get('igc_hotel')->result_array();
        return $result;
    }

    public function get_hotel_detail($id)
    {
      	$this->db->where('status','1');
        $this->db->where('id', $id);
        $result =  $this->db->get('igc_hotel')->row_array();
       
        return $result;
    }

    public function get_category_list($category_id){

    	$this->db->where('id', $category_id);
    	$result = $this->db->get('igc_hotel_setting')->row_array();
    	return $result;
    }
    public function get_hotel_category()
    {
        $this->db->order_by('created', 'ASC');
        $this->db->where('status','1');
        $result = $this->db->get('igc_hotel_setting')->result_array();
        return $result;
    }

    //function to get hotel_detail

    public function get_content_detail($id)
    {
        
        $this->db->where('id', $id);
        $result = $this->db->get('igc_hotel')->row_array();
        return $result;

    }

    //get country according to the status
    public function get_country(){

        $this->db->where('publish_status','1');
        $result = $this->db->get('igc_country')->result_array();
        return $result;
    }

    //to get the active currency
    public function get_currency(){
    	
    	$result = $this->db->get('igc_currency_setting')->result_array();
    	return $result;
    }

    public function tab_detail($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('igc_hotel_tab')->row_array();
        return $result;
    }

    public function hotel_insert($insert)
    {
        $this->db->insert('igc_hotel', $insert);
        $result = $this->db->insert_id();
        if($result !="")
        {
            return $result;
        }
        else{
            return false;
        }
    }

    //function to get the feature name of the isroom y
    public function get_room(){
        $this->db->where('isroom', 'Y');
        $this->db->where('delete_status', '0');
        $result = $this->db->get('igc_features_setting')->result_array();
        return $result;
    }


     //function to delete hotel

    public function delete_hotel($id)
    {
        $update['delete_status'] = "1";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('id', $id);
        $result = $this->db->update('igc_hotel', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }

     //function to delete room

    public function delete_room($hotelroom_id)
    {
        $update['delete_status'] = "1";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('hotelroom_id', $hotelroom_id);
        $result = $this->db->update('igc_hotel_room', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }
    
    //function to check the room album exist
    public function check_room_album($hotelroom_id, $album_id)
    {
        $this->db->where('hotelroom_id', $hotelroom_id);
        $this->db->where('album_id', $album_id);
        $result = $this->db->get('room_album')->row_array();
        return $result;
    }

    //function to check the album exist

    public function check_album_exist($hotel_id, $album_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('album_id', $album_id);
        $result = $this->db->get('igc_hotel_album')->row_array();
        return $result;
    }

    public function check_related_exist($hotel_id, $related_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('related_id', $related_id);
        $result = $this->db->get('related_hotel')->row_array();
        return $result;
    }

     public function get_not_deleted($table)
    {
        $this->db->where('status', "1");
        $result = $this->db->get($table)->result_array();
        return $result;
    }


    public function get_features_name(){

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

    //getting the records of the hotel feature table of same id
    public function get_hotel_feature($hotel_id, $features_id){
        
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('features_id', $features_id);
        $result= $this->db->get('hotel_features')->row_array();
    
        return $result;
    }

    //getting the records of the room feature table of same id
    public function get_room_feature($hotelroom_id, $features_id){
        
        $this->db->where('hotelroom_id', $hotelroom_id);
        $this->db->where('features_id', $features_id);
        $result= $this->db->get('room_features')->row_array();
    
        return $result;
    }


    //function to  get  detail

    public function get_detail($id, $field_name, $table)
    {
        $this->db->where($field_name, $id);
        $this->db->where('delete_status', '0');
        $result = $this->db->get($table)->result_array();
        return $result;
    }

}