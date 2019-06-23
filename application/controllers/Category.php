<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->model('crud_model','crud');
        $this->load->helper('text');
        $this->load->library('pagination');
        $this->load->database();
        $this->load->helper('url');
        $this->per_page = 6;
    }

    public $per_page;
    public  $table = "igc_package_category";
    public $field_name = "category_url";
    //public  $redirect = "product";



public function index(){
    $slug = $this->uri->segment(2);
    $detail = $this->crud->get_active_not_deleted_detail($slug, 'category_url', 'igc_package_category');
$cat_id=$detail['category_id'];
//echo $cat_id;
 $data['news_detail'] = $this->crud->get_news_by_category_id($cat_id);



        $this->load->view('header', $data);
        $this->load->view('category');
        $this->load->view('footer');

}

    public function article($slug, $page=0)
    {
         $data['logo'] = $this->crud->get_logo('igc_logo');
         $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings'); 
         
         
         

         $detail = $this->crud->get_active_not_deleted_detail($slug, 'category_url', 'igc_package_category');
     
        // print_r($data['contact_number']);
        // exit();
    $data = array();
 $name = $this->uri->segment(3);
    $config["base_url"] = "category/article/".$name;
    $config['total_rows'] =   $this->crud->count_news($detail['category_id']);
    //here we will count all the data from the table
    //number of data to be shown on single page
    $config["uri_segment"] = 4;
    $congig['per_page'] = $this->per_page;
    $config['use_page_numbers'] = TRUE; 
    
    $page = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
    // $data["links"] = $this->pagination->create_links();//create the link for pagination
    //  $data['mainpage'] = "category";
     $data['recent_articles']= $this->crud->get_recent_articles('igc_content');
    

//        echo $detail;
//        exit;
//        echo $detail['category_id'];
//        echo "<pre>";
//        print_r($detail);
//        echo"</pre>";
//
//        exit();

        if(empty($detail)) {
            redirect('home');
        }
        if($page < 1) {
            $page = 1;
        }
        $per_page = 6;

        $startpoint = ($page * $per_page) - $per_page;

        // $data['packages'] =  $this->package->get_rel_packagess($detail['category_id'],$startpoint, $per_page);

        $data['articles']= $this->crud->get_article_list($detail['category_id'],$startpoint, $per_page);
// echo "<pre>";
// print_r( $data['packages']);
// echo "</pre>";
// exit();

        $data['package_total'] = $this->crud->total_related_packages($slug);
        $data['category_url'] = $slug;
        $data['per_page'] = $per_page;
//        $data['base_url'] = site_url('brands/rel/'.$slug);
        $data['current_page'] = $page;
        $data['sub_title'] =  $detail['category_name']." ";
        $data['menu']="";
//        $data['meta_title'] =  $detail['meta_title'];
//        $data['meta_description'] =  $detail['meta_description'];
//        $data['meta_keywords'] =  $detail['meta_keywords'];
//        $data['description'] =  $detail['description'];
    //    $data['scripts'] = array('themes/js/form-validator/jquery.form-validator');
        $this->pagination->initialize($config);
        $this->load->view('header', $data);
       
        $this->load->view('news/news_list', $data);
        $this->load->view('footer');
    }


    public function author($slug, $page=0)
    {


        $detail = $this->crud->get_active_not_deleted_author($slug, 'by-line', 'igc_content');
//print_r($detail);
//exit();
//        echo $detail;
//        exit;
//        echo $detail['category_id'];
//        echo "<pre>";
//        print_r($detail);
//        echo"</pre>";
//
//        exit();

        if(empty($detail)) {
            redirect('home');
        }
        if($page < 1) {
            $page = 1;
        }
        $per_page = 15;
        $startpoint = ($page * $per_page) - $per_page;

        //$data['packages'] =  $this->package->get_rel_packagess($detail['category_id'],$startpoint, $per_page);


        $data['articles']= $this->crud->get_article_author($detail['by-line'],$startpoint, $per_page);
// echo "<pre>";
// print_r( $data['packages']);
// echo "</pre>";
// exit();

        $data['package_total'] = $this->package->total_related_packages($slug);
        $data['category_url'] = $slug;
        $data['per_page'] = $per_page;
//        $data['base_url'] = site_url('brands/rel/'.$slug);
        $data['current_page'] = $page;
        $data['sub_title'] =  $detail['by-line']." ";
        $data['menu']="";
//        $data['meta_title'] =  $detail['meta_title'];
//        $data['meta_description'] =  $detail['meta_description'];
//        $data['meta_keywords'] =  $detail['meta_keywords'];
//        $data['description'] =  $detail['description'];
        $data['menu'] = "home";
        $data['scripts'] = array('themes/js/form-validator/jquery.form-validator');
        $this->load->view('header', $data);
        // $this->load->view('list_header');
        $this->load->view('news/author_news_list');
        $this->load->view('footer');
    }










}