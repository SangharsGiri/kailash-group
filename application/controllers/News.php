<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->model('site_settings_model', 'settings');
        $this->load->model('news_model','news');
        $this->load->model('crud_model','crud');

    }


    public function index($page=0)
    {
        if($page < 1) {
            $page = 1;
        }
        $per_page = 2;
        $startpoint = ($page * $per_page) - $per_page;
        $data['news']= $this->news->get_news($startpoint, $per_page);             
        // print_r($data['news']);
        // exit();
        $data['total'] = $this->news->count_news();
        $data['per_page'] = $per_page;
        $data['base_url'] = site_url('news/index/'); 
        $data['meta_title'] = $detail['category_id'];
        $data['meta_description'] = $detail['meta_description'];
        $data['meta_keywords'] = $detail['meta_keywords'];
        $data['current_page'] = $page;
        $data['menu'] = '';
        $this->load->view('header', $data);
        $this->load->view('news/news_list');
        $this->load->view('footer');
    }

    public function detail($slug)
    {

        $data['scripts']= array('form_validator');
        $detail= $this->crud->get_detail($slug, 'content_id', 'igc_content'); 
        $data['contact_number'] = $this->crud->get_contact('igc_site_settings');
        $data['detail']= $detail;
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        $data['partners'] = $this->crud->get_partners_records('global_partner');

        $this->db->select('*');
        $this->db->from('multi_cat');
        $this->db->where('content_id', $slug);
        $result = $this->db->get()->row_array();

        $single_id = $result['category_id'];
        $data['recents'] = $this->crud->get_recent($single_id,'multi_cat');
      

        $data['recents_new']= $this->crud->get_recent_new('igc_content');
        $data['menu'] = '';

        $data['sub_title'] = $detail['content_title']." "."-"." ";
        $data['meta_title'] = $detail['meta_title'];
        $data['meta_description'] = $detail['meta_description'];
        $data['meta_keywords'] = $detail['meta_keywords'];
        //setting for fb share
        $data['og_url']= 'news/detail/'.$detail['content_url'];
        $data['og_title']= $detail['content_title'];
        $data['og_description']= substr($detail['content_body'],0,200);
        $data['og_image']= 'uploads/news/'.$detail['featured_img'];
        $url_code = $this->uri->segment(3);
            // redirect the short url 
            
            $this->load->helper('cookie');
       $check_visitor = $this->input->cookie("detail-".$slug, FALSE);
       $ip = $this->input->ip_address();
       if ($check_visitor == false)
       {
           $cookie = array(
               "name"   => "detail-".$slug,
               "value"  => "$ip",
               "expire" => 7200,
               "secure" => false
           );
          // echo $cookie['expire'];
           $this->input->set_cookie($cookie);
           $query = $this->crud->selectShortUrl($slug);
       }
            // update clicks for short url
        $this->load->view('header', $data);
        $this->load->view('news/news_detail');
        $this->load->view('footer');
        
    }



}