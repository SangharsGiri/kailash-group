<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Destinations_model extends CI_Model{

    public function get_content_list()
    {

        $this->db->where('delete_status','0');
        $this->db->where('content_type','Destination');
        $this->db->order_by('created', 'DESC');
        $result = $this->db->get('igc_content')->result_array();
        return $result;
    }

    public function content_insert($insert)
    {
        $this->db->insert('igc_content', $insert);
        $result = $this->db->insert_id();
        if($result !="")
        {
            return $result;
        }
        else{
            return false;
        }

    }

   public function check_name_exist($content_url, $content_id)
   {

       $this->db->where('content_url', $content_url)->where('content_id <>', $content_id)->where('delete_status','0');
       $row = $this->db->get('igc_content')->row_array();

       return $row;
   }

    public function content_update($update, $content_id)
    {
        $this->db->where('content_id', $content_id);
        $result =  $this->db->update('igc_content', $update);
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
        $result =  $this->db->insert('igc_content_tabs', $inserts);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    //function update tab

    public function tab_update($inserts, $content_id)
    {
        $this->db->where('content_id', $content_id);
        $result =  $this->db->update('igc_content_tabs', $inserts);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    //function to get content_detail

    public function get_content_detail($content_id)
    {
        $this->db->where('delete_status', '0');
        $this->db->where('content_id', $content_id);
        $result = $this->db->get('igc_content')->row_array();
        return $result;

    }

    //function get parent_page

    public function get_parent_page()
    {
        $this->db->select('content_id');
        $this->db->select('content_page_title');
        $this->db->where('delete_status', '0');
        $result = $this->db->get('igc_content')->result_array();
        return $result;
    }

    //function get content categories

    public function get_content_categories()
    {
        $this->db->select('category_id');
        $this->db->select('category_name');
        $result = $this->db->get('igc_content_category')->result_array();
        return $result;
    }


    //function to check tab data

    public function tab_detail($content_id)
    {
        $this->db->where('content_id', $content_id);
        $result = $this->db->get('igc_content_tabs')->row_array();
        return $result;
    }

    //function to insert new category

    public function insert_content_category($category)
    {
        $this->db->insert('igc_content_category', $category);
        $result = $this->db->insert_id();
        return $result;
    }


    //function to delete the content

    public function delete_content($content_id)
    {
        $update['delete_status'] = "1";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('content_id', $content_id);
        $result = $this->db->update('igc_content', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }

    }

    public function insert_tags($tags, $content_id)
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
                    $this->db->where('content_id', $content_id);
                    $records = $this->db->get('igc_content_tags')->row_array();
                    if(empty($records))
                    {
                        $data['term_id'] = $result['term_id'];
                        $data['content_id'] = $content_id;
                        $this->db->insert('igc_content_tags', $data);
                    }


                }
                else{

                    $insert['term_name'] = $value;
                    $this->db->insert('igc_taxonomy_terms', $insert);
                    $term_id = $this->db->insert_id();
                    $data['term_id'] = $term_id;
                    $data['content_id'] = $content_id;
                    $this->db->insert('igc_content_tags', $data);
                }
            }

        }
    }


    //function get added tags of content

    public function get_added_tags($content_id)
    {

        $query = $this->db->query("select tt.term_id,tt.term_name from igc_taxonomy_terms tt join igc_content_tags pt on tt.term_id = pt.term_id
         where pt.content_id = '$content_id'");
        $result = $query->result_array();
        return $result;

    }

    //function to get available tags

    public function get_available_tags($content_id)
    {

        $query = $this->db->query("select term_id, term_name from igc_taxonomy_terms where term_id not in(select term_id from igc_content_tags where content_id = '$content_id');");
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