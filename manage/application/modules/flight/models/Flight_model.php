<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Flight_model extends CI_Model{

    public function get_flight_list()
    {

        $this->db->where('delete_status','0');
        $this->db->order_by('created', 'DESC');
        $result = $this->db->get('sg_flight')->result_array();
        return $result;
    }

    public function flight_insert($insert)
    {
        $this->db->insert('sg_flight', $insert);
        $result = $this->db->insert_id();
        if($result !="")
        {
            return $result;
        }
        else{
            return false;
        }

    }

   public function check_name_exist($flight_url, $flight_id)
   {

       $this->db->where('flight_url', $flight_url)->where('flight_id <>', $flight_id)->where('delete_status','0');
       $row = $this->db->get('sg_flight')->row_array();

       return $row;
   }

    public function flight_update($update, $flight_id)
    {
        $this->db->where('flight_id', $flight_id);
        $result =  $this->db->update('sg_flight', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }


    public function tab_insert($inserts)
    {
        $result =  $this->db->insert('sg_flight_tabs', $inserts);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    //function update tab

    public function tab_update($inserts, $flight_id)
    {
        $this->db->where('flight_id', $flight_id);
        $result =  $this->db->update('sg_flight_tabs', $inserts);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    //function to get flight_detail

    public function get_flight_detail($flight_id)
    {
        $this->db->where('delete_status', '0');
        $this->db->where('flight_id', $flight_id);
        $result = $this->db->get('sg_flight')->row_array();
        return $result;

    }

    //function get parent_page

    public function get_parent_page()
    {
        $this->db->select('flight_id');
        $this->db->select('flight_page_title');
        $this->db->where('delete_status', '0');
        $result = $this->db->get('sg_flight')->result_array();
        return $result;
    }

    //function get flight categories

    public function get_flight_categories()
    {
        $this->db->select('category_id');
        $this->db->select('category_name');
        $result = $this->db->get('sg_flight_category')->result_array();
        return $result;
    }


    //function to check tab data

    public function tab_detail($flight_id)
    {
        $this->db->where('flight_id', $flight_id);
        $result = $this->db->get('sg_flight_tabs')->row_array();
        return $result;
    }

    //function to insert new category

    public function insert_flight_category($category)
    {
        $this->db->insert('sg_flight_category', $category);
        $result = $this->db->insert_id();
        return $result;
    }


    //function to delete the flight

    public function delete_flight($flight_id)
    {
        $update['delete_status'] = "1";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('flight_id', $flight_id);
        $result = $this->db->update('sg_flight', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    public function insert_tags($tags, $flight_id)
    {
        foreach($tags as $row => $value)
        {
            if($value !="")
            {

                $this->db->where('term_name', $value);
                $result = $this->db->get('igc_taxonomy_terms')->row_array();

                if(!empty($result))
                {
                    $this->db->where('term_id', $result['term_id']);
                    $this->db->where('flight_id', $flight_id);
                    $records = $this->db->get('sg_flight_tags')->row_array();
                    if(empty($records))
                    {
                        $data['term_id'] = $result['term_id'];
                        $data['flight_id'] = $flight_id;
                        $this->db->insert('sg_flight_tags', $data);
                    }


                }
                else{

                    $insert['term_name'] = $value;
                    $this->db->insert('igc_taxonomy_terms', $insert);
                    $term_id = $this->db->insert_id();
                    $data['term_id'] = $term_id;
                    $data['flight_id'] = $flight_id;
                    $this->db->insert('sg_flight_tags', $data);
                }
            }

        }
    }


    //function get added tags of flight

    public function get_added_tags($flight_id)
    {

        $query = $this->db->query("select tt.term_id,tt.term_name from igc_taxonomy_terms tt join sg_flight_tags pt on tt.term_id = pt.term_id
         where pt.flight_id = '$flight_id'");
        $result = $query->result_array();
        return $result;

    }

    //function to get available tags

    public function get_available_tags($flight_id)
    {

        $query = $this->db->query("select term_id, term_name from igc_taxonomy_terms where term_id not in(select term_id from sg_flight_tags where flight_id = '$flight_id');");
        $result = $query->result_array();
        return $result;

    }

    //function to active subscribes

    public function get_subscribers()
    {
        $this->db->where('active_status','1');
        $this->db->where('delete_status','0');
        $result = $this->db->get('igc_subscribe_users')->result_array();
        return $result;
    }

}