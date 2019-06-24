<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model{



    // function get categories

    public function get_categories()
    {
        $this->db->select('category_id');
        $this->db->select('category_name');
        $result = $this->db->get('igc_package_category')->result_array();
        return $result;
    }



    //function to get all package

    public function get_all_packages()
    {
        $this->db->where('delete_status', '0');
        $this->db->where('status', '1');
        $this->db->select('package_id');
        $this->db->select('package_name');
        $this->db->select('package_duration');
        $this->db->order_by('package_name');
        $result = $this->db->get('igc_package')->result_array();
        return $result;
    }

    //get all related packages

    public function get_related_packages($category_id, $package_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->where('package_id', $package_id);
        $result = $this->db->get('igc_category_packages')->row_array();
      return $result;
    }

    //remove all related packages

    public function remove_related_packages($category_id)
    {
        $this->db->where('category_id', $category_id);
        $result = $this->db->delete('igc_category_packages');
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    //code to insert related packages

    public function insert_related_packages($insert)
    {
        $result = $this->db->insert('igc_category_packages', $insert);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }







}