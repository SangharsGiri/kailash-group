<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content extends CI_Controller{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->model('crud_model','crud');

    }

    public  $table = "igc_content";
    public  $redirect = "content";
    public  $field_name = "content_url";




}