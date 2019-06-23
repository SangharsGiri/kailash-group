<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model','crud');
    }
    public function index()
    {
        $data['title']= "Dashboard";
        $this->load->view('header', $data);
        $this->load->view('dashboard');
        $this->load->view('footer');
    }

}
?>