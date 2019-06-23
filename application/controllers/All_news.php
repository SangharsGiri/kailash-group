<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class All_news extends CI_Controller{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->model('crud_model', 'crud');

    }


    public function index($page=0)
    {
        if($page < 1) {
            $page = 1;
        }
        $per_page = 20;
        $startpoint = ($page * $per_page) - $per_page;

        $data['results'] = $this->crud->get_all_news($startpoint, $per_page);
        $data['product_total'] = $this->crud->record_count();

        $data['per_page'] = $per_page;
        $data['base_url'] = site_url('all_news/');
        $data['current_page'] = $page;

//        if($page < 1) {
//            $page = 1;
//        }
//        $per_page = 10;
//        $startpoint = ($page * $per_page) - $per_page;
//        $data['jobs'] = $this->job->get_job($startpoint, $per_page);
//        $data['total'] = $this->job->count_job();
//        $data['per_page'] = $per_page;
//        $data['base_url'] = site_url('jobs/index/');
//        $data['meta_title'] = $detail['meta_title'];
//        $data['mebta_description'] = $detail['meta_description'];
//        $data['meta_keywords'] = $detail['meta_keywords'];
//
//        $data['current_page'] = $page;
        $data['scripts'] = array('theme/js/form-validator/jquery.form-validator');
        $data['menu'] = 'Products';
        $this->load->view('header', $data);
//        $this->load->view('product_head');
        $this->load->view('all_news');
        $this->load->view('footer');
    }


//     public function best($page=0)
//     {

//         $this->load->library('pagination');

//         $config['base_url'] = 'site_url()/test/page/';
//         $config['total_rows'] = 200;
//         $config['per_page'] = 20;

//         $this->pagination->initialize($config);

//         echo $this->pagination->create_links();



//         $data['results'] = $this->crud->get_best_property();

// //        if($page < 1) {
// //            $page = 1;
// //        }
// //        $per_page = 10;
// //        $startpoint = ($page * $per_page) - $per_page;
// //        $data['jobs'] = $this->job->get_job($startpoint, $per_page);
// //        $data['total'] = $this->job->count_job();
// //        $data['per_page'] = $per_page;
// //        $data['base_url'] = site_url('jobs/index/');
// //        $data['meta_title'] = $detail['meta_title'];
// //        $data['mebta_description'] = $detail['meta_description'];
// //        $data['meta_keywords'] = $detail['meta_keywords'];
// //
// //        $data['current_page'] = $page;
//         $data['menu'] = 'Best Properties';
//         $this->load->view('header', $data);
//         $this->load->view('product_head');
//         $this->load->view('all_property');
//         $this->load->view('footer');
//     }






//     public function detail($slug)
//     {
//         $query = $this->job->getJobDetail();
//         $data['jobs'] = null;
//         if($query){
//             $data['jobs'] =  $query;
//         }

//         $this->load->view('header', $data);
//         $this->load->view('other_header');
//         $this->load->view('job/detail');
//         $this->load->view('footer');
//     }


    public function search()
    {
        // echo $this->input->post('search');exit;
        // // Retrieve the posted search term.
        $search_term = $this->input->post('search');
        // echo $search_term;exit;
        // Use a model to retrieve the results.
        $data['job_result'] = $this->crud->get_job_result($search_term);

        // Pass the results to the view.
         $this->load->view('header');
        $this->load->view('all_news', $data);
         $this->load->view('footer');

    }

    


}