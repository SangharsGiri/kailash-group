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
        
        $data['get_featured_package'] = $this->crud->get_featured_package();
        // print_r($data['get_featured_package']);
        // exit();
        $data['sliders'] = $this->crud->get_active_records('igc_slider','3');
        $data['adventures'] =  $this->crud->get_active_records('igc_activity',8);
		$this->load->view('header',$data);
		$this->load->view('index');
		$this->load->view('footer');
	}
}
