<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model{



    public function check_category_url($category_id, $category_url){
        $sql= $this->db->query("select category_url from eb_product_category where 'category_id' <> '$category_id'and category_url ='$category_url'");
        $result = $sql->result_array();
        return $result;

    }

    //function to  get category detail

//    public function get_category_detail($id)
//    {
//        $this->db->where('category_id', $id);
//        $result = $this->db->get('igc_package_category')->row_array();
//        return $result;
//    }

//function to insert category

//    public function insert_category($insert)
//    {
//        $result = $this->db->insert('igc_package_category', $insert);
//        if($result)
//        {
//            return $result;
//        }
//        else{
//            return false;
//
//        }
//    }


    //function to insert category

//    public function update_category($update, $id)
//    {
//        $this->db->where('category_id', $id);
//        $result = $this->db->update('igc_package_category', $update);
//        if($result)
//        {
//            return $result;
//        }
//        else{
//            return false;
//
//        }
//    }


   //function to  get category detail
//
//    public function get_subcategory_detail($id)
//    {
//        $this->db->where('sub_category_id', $id);
//        $result = $this->db->get('igc_package_subcategory')->row_array();
//        return $result;
//    }

//function to insert category

    public function insert_subcategory($insert)
    {
        $result = $this->db->insert('igc_package_subcategory', $insert);
        if($result)
        {
            return $result;
        }
        else{
            return false;

        }
    }


    //function to insert category

    public function update_subcategory($update, $id)
    {
        $this->db->where('sub_category_id', $id);
        $result = $this->db->update('igc_package_subcategory', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;

        }
    }


    // function get categories

    public function get_categories()
    {
        $this->db->select('category_id');
        $this->db->select('category_name');
        $result = $this->db->get('igc_package_category')->result_array();
        return $result;
    }


    //function to delete category

 public function category_delete($category_id)
 {
     $this->db->where('category_id', $category_id);
     $result = $this->db->delete('igc_package_category');
     if($result)
     {
         return $result;
     }
     else{
         return false;
     }

 }


    //function to delete category

    public function subcategory_delete($sub_category_id)
    {
        $this->db->where('sub_category_id', $sub_category_id);
        $result = $this->db->delete('igc_package_subcategory');
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

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

    public function get_related_packages($sub_category_id, $package_id)
    {
        $this->db->where('sub_category_id', $sub_category_id);
        $this->db->where('package_id', $package_id);
        $result = $this->db->get('igc_category_packages')->row_array();
      return $result;
    }

    //remove all related packages

    public function remove_related_packages($sub_category_id)
    {
        $this->db->where('sub_category_id', $sub_category_id);
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