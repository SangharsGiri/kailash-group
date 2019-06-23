<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __Construct()
    {
        parent::__Construct();
        $this->load->model('crud_model', 'crud'); 


    }
	public function index()
	{ 
      
        // $blogid = 1; //this is static id of blog but you are not enter static id you enter your dynami c id of blog or post
        // $data['get_avg_rating'] = $this->users->count_total_rating($blogid);
        // $data['rating_data'] = $this->users->get_rating_data($blogid);
        // $this->load->view('user', $data);
        // $data['get_featured_package'] = $this->crud->get_featured_package();
        $data['get_featured_package'] = $this->crud->get_featured_package();
        $data['get_adventure_trips'] = $this->crud->get_adventure_trips();
        $data['sliders'] = $this->crud->get_active_records('igc_slider','4');
        $data['highlights'] = $this->crud->get_letest_highlights('igc_content');
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['partners'] = $this->crud->get_partners_records('global_partner');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        // print_r($data['logo']);
        // exit();
        $data['adventures'] =  $this->crud->get_active_records('igc_activity',8);
		$this->load->view('header',$data);
		$this->load->view('index');
		$this->load->view('footer');
	}
	 // public function user()
	// {
	//     $blogid = 1; //this is static id of blog but you are not enter static id you enter your dynami c id of blog or post
	//     $data['get_avg_rating'] = $this->users->count_total_rating($blogid);
	//     $data['rating_data'] = $this->users->get_rating_data($blogid);
	//     $this->load->view('user', $data);
	// }
}
