<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    public function get_active_records($table,$limit)
    {
        $this->db->where('publish_status', "1");
        $this->db->order_by('created','DESC')->limit($limit);
        $result = $this->db->get($table)->result_array();
        return $result;
    }

    public function get_partners_records($table)
    {
        $this->db->where('publish_status', "1");
        $this->db->order_by('created','DESC')->limit(20);
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_letest_highlights($table)
    {
        $this->db->where('publish_status', "1");
        $this->db->order_by('created','DESC')->limit(6);
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_site_settings($table)
    {
        $this->db->select('*');
        $result = $this->db->get($table)->row_array();
        return $result;
    }
    public function get_site_settingss()
    {
        $result = $this->db->get('igc_site_settings')->row_array();
        return $result;
    }
    public function get_mail_info()
    {
        $this->db->where('delete_status', '0');
        $this->db->where('active_status', '1');
        $result = $this->db->get('igc_mail_server_setting')->row_array();
        return $result;


    }
    public function get_parent_category_menu()
    {
        $this->db->select('category_id');
        $this->db->select('category_url');
        $this->db->select('category_name');
        $this->db->where('delete_status','0')->where('publish_status','1')->where('group_id','1')->where('parent_id','0')->where('show_mobile','Y');
        $this->db->order_by('position','ASC');
        $result =  $this->db->get('igc_package_category')->result_array();
        return $result;

    }

    public function get_recent($single_id, $table){

    $this->db->select('*');
    $this->db->from('igc_content');
    $this->db->join('multi_cat', 'multi_cat.content_id = igc_content.content_id');
    $this->db->where('igc_content.publish_status', "1");
    $this->db->where('igc_content.delete_status', "0");
    $this->db->where('multi_cat.category_id', $single_id);
    $this->db->order_by('igc_content.created','DESC')->limit(5);
    $result = $this->db->get()->result_array();
    return $result;



   }

   public function selectShortUrl($url){

      $cx=$this->db->select('*')
                   ->where('content_id',$url)
                   ->get('igc_content')->row_array();
           // if ($cx->num_rows() == 1) {
           //     foreach ($cx->result() as $row) {
           //          $url_address = $row->fullurl;
           // }
                   // print_r($cx);
                   // exit(); 
       

  $cx1=$this->db->set('shorturl',($cx['shorturl']+1),FALSE)
                   ->where('content_id',$url)
                   ->update('igc_content');
        return $cx1;

        //    $this->updateShortUrl($cx);


        //    redirect (prep_url($url_address));
        //  }
        // else{
        //     redirect(base_url());
        // } 

}

   public function get_recent_new($table)
    {
        $this->db->select('*');
    $this->db->from('igc_content');
    $this->db->join('multi_cat', 'multi_cat.content_id = igc_content.content_id');
    $this->db->where('igc_content.publish_status', "1");
    $this->db->where('igc_content.delete_status', "0");
    
        $this->db->order_by('igc_content.content_id','DESC')->limit(9,3);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_parent_category_sub_menu($parent_id)
    {
        $this->db->select('category_id');
        $this->db->select('category_name');
        $this->db->select('category_url');
        $this->db->where('delete_status','0')->where('publish_status','1')->where('group_id','1')->where('parent_id',$parent_id)->where('category_code','HM');
        $this->db->order_by('position','ASC');
        $result =  $this->db->get('igc_package_category')->result_array();
        return $result;

    }
    public function count_news($id)
    {
        $sql = "SELECT * FROM igc_package INNER JOIN igc_category_packages ON igc_category_packages.package_id = igc_package.package_id where category_id = $id AND status = '1' AND delete_status = '0' ORDER BY created DESC";
        $query = $this->db->query($sql);
        return count($query->result_array());

    }
    public function get_featured_package()
    {
        $sql = "SELECT * FROM igc_package INNER JOIN igc_category_packages ON igc_category_packages.package_id = igc_package.package_id where category_id = '74' AND status = '1' AND delete_status = '0' ORDER BY created DESC limit 6";
        $query = $this->db->query($sql);
        return $query->result_array();

    }
     public function get_adventure_trips()
    {
        $sql = "SELECT * FROM igc_package INNER JOIN igc_category_packages ON igc_category_packages.package_id = igc_package.package_id where category_id = '75' AND status = '1' AND delete_status = '0' ORDER BY created DESC limit 6";
        $query = $this->db->query($sql);
        return $query->result_array();

    }
    public function get_active_not_deleted_detai(l$id, $field_name, $table)
    {
        $this->db->where('publish_status', '1');
        $this->db->where('delete_status', '0');
        $this->db->where($field_name, $id);
        $result = $this->db->get($table)->row_array();
        return $result;
    }
    public function get_recent_articles($table)
    {
        $this->db->where('publish_status', "1");
        $this->db->where('delete_status', "0");
        $this->db->order_by('created','Desc')->limit(5);

        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_active_not_deleted_detail($id, $field_name, $table)
    {
        $this->db->where('publish_status', '1');
        $this->db->where('delete_status', '0');
        $this->db->where($field_name, $id);
        $result = $this->db->get($table)->row_array();
        return $result;
    }
     public function get_article_list($id, $start_point = 0, $per_page = 0){
        /*$detail = $this->crud->get_active_not_deleted_detail($slug, 'category_url', 'igc_package_category');
        $cat_id = $detail['category_id']*/

//        $query1 = $this->db->query("SELECT * FROM `igc_category_packages` WHERE `category_id` = $id");
//        $result1 = $query1->result_array();
//        $string="";
//        foreach ($result1  as $row) {
//            $string.=$row['package_id'].",";
//        }
//        $string = rtrim($string,",");

        $query="
                SELECT * FROM `igc_content` a
                JOIN `multi_cat` b ON a.content_id=b.content_id
                WHERE b.`category_id` = $id AND a.`publish_status` = '1' AND a.`delete_status` ='0' ORDER by a.content_id DESC limit
                    {$start_point},{$per_page}
                ";
        $query2 = $this->db->query($query);
        $result2 = $query2->result_array();

        return $result2;


    }

     public function get_contact($table)
    {
       $this->db->where('id', '1');
        $result = $this->db->get($table)->row_array();
        return $result;
    }

    public function total_related_packages($slug)
    {

        $query = $this->db->query("select * from
        igc_package_category ps join igc_category_packages cp on ps.category_id = cp.category_id join igc_package p on cp.package_id = p.package_id where  p.status='1' and p.delete_status = '0' and
        ps.category_url = '$slug' and ps.delete_status = '0' and ps.publish_status = '1'");
        $result = $query->num_rows();

        return $result;
    }

    public function get_all_news($start_point = 0, $per_page = 0)
    {

        $query = $this->db->query("select * FROM igc_package WHERE status = '1' AND delete_status = '0'  order by created desc limit
        {$start_point},{$per_page}");
        $result = $query->result_array();
        return $result;
    }

    public function record_count() {
        return $this->db->count_all("igc_package");
    }

    public function get_job_result($search_term='default')
    {
        // Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->from('igc_content');
        $this->db->like('content_title',$search_term);

        // Execute the query.
        $query = $this->db->get();

        // Return the results.
        return $query->result_array();
    }

    public function get_detail($id, $field_name, $table)
    {
        $this->db->where($field_name, $id);
        $result = $this->db->get($table)->row_array();
        return $result;
    }

    public function get_term_list($content_id)
    {
        $query = $this->db->query("select t.*, ct.* from igc_content_tags ct join igc_taxonomy_terms t on ct.term_id =
       t.term_id where ct.content_id = '$content_id' and t.term_name = 'top-destination'");
        $result = $query->row_array();
        return $result;
    }

    public function get_destination_list($start_point=0, $per_page=0)
    {
        $query = $this->db->query("select t.term_name, c.* from igc_content c join igc_content_tags ct on c.content_id = ct.content_id join igc_taxonomy_terms t on ct.term_id =
       t.term_id where c.publish_status= '1' and c.delete_status= '0' and t.term_name='top-destination' order by created desc limit
    {$start_point},{$per_page}");
        $result = $query->result_array();
        return $result;
    }

     public function get_where($table,$array){
        if(count($array) > 0){
            foreach($array as $key => $value){
                $this->db->where("$key","$value");
            }
        }
        $result = $this->db->get($table)->result_array();
        return $result;
    }

    public function get_active_recordss($table)
    {
        $this->db->where('publish_status', "1");
        $result = $this->db->get($table)->result_array();
        return $result;
    }

    public function get_logo($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','DESC');
        $result = $this->db->get($table)->row_array();
        return $result;
    }
    public function get_all_tours($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','DESC');
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_single_tours($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','Desc')->limit(1);
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_all_trekkings($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','DESC');
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_single_trekkings($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','Desc')->limit(1);
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_all_activities($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','DESC');
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_single_activitiess($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','Desc')->limit(1);
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_all_flights($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','DESC');
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    public function get_single_flightss($table)
    {
        $this->db->select('*');
        $this->db->order_by('created','Desc')->limit(1);
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    // public function count_total_rating($where) 
    // {
    //     $this->db->select('AVG(rating) as average');
    //     $this->db->where('blog_id', $where);
    //     $this->db->from('rating');
    //     return $query = $this->db->get()->result_array();
    // }
    // public function get_rating_data($blogid)
    // {
    //     $this->db->select('*');
    //     $this->db->from('users u');
    //     $this->db->join('rating r', 'r.user_id = u.user_id');
    //     $this->db->where('blog_id', $blogid);
    //     return $query = $this->db->get()->result();
    // }

}
