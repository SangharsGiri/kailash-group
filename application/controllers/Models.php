<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Models extends CI_Controller{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->model('crud_model','crud');
        $this->load->model('site_settings_model', 'settings');
        $this->load->model('news_model','news');
        $this->load->helper('text');
        

    }


    public function index($page=0)
    {
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        $data['partners'] = $this->crud->get_partners_records('global_partner');
        $data['tours'] = $this->crud->get_all_tours('sg_tour');
        $data['tourss'] = $this->crud->get_single_tours('sg_tour');

        $this->load->view('header',$data);
        $this->load->view('tour');
        $this->load->view('footer');
    }

    public function trekking($page=0)
    {
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        $data['partners'] = $this->crud->get_partners_records('global_partner');
        $data['trekkings'] = $this->crud->get_all_trekkings('sg_trekking');
        $data['trekkingss'] = $this->crud->get_single_trekkings('sg_trekking');

        $this->load->view('header',$data);
        $this->load->view('trekking');
        $this->load->view('footer');
    }

    public function activities($page=0)
    {
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        $data['partners'] = $this->crud->get_partners_records('global_partner');
        $data['activities'] = $this->crud->get_all_activities('igc_activity');
        $data['activitiess'] = $this->crud->get_single_activitiess('igc_activity');

        $this->load->view('header',$data);
        $this->load->view('activities');
        $this->load->view('footer');
    }

    public function flight($page=0)
    {
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        $data['partners'] = $this->crud->get_partners_records('global_partner');
        $data['flights'] = $this->crud->get_all_flights('sg_flight');
        $data['flightss'] = $this->crud->get_single_flightss('sg_flight');

        $this->load->view('header',$data);
        $this->load->view('flight');
        $this->load->view('footer');
    }

}