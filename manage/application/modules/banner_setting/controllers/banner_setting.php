<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banner_setting extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('crud_model','crud');

    }

    public $table = "igc_banner_setting";
    public $field_name = "setting_id";


    public function index()
    {
        $data['records'] = $this->crud->get_all($this->table);
        $data['title']= "Banner Setting";
        $this->load->view('header', $data);
        $this->load->view('banner_setting_list');
        $this->load->view('footer');
    }


    //show package category in front

    public function active()
    {

        if($this->input->post())
        {

            $id =  $this->input->post('id');


                $updates['active_status']= "N";
                $this->crud->whole_update($updates,$this->table);
                $update['active_status']= "Y";
               $this->crud->update($id, $this->field_name,$update,$this->table);


        }

    }
    public function in_active()
    {

        if($this->input->post())
        {
            $id =  $this->input->post('id');
            $updates['active_status']= "Y";
            $this->crud->whole_update($updates,$this->table);
          $update['active_status']= "N";
            $this->crud->update($id, $this->field_name,$update,$this->table);


        }

    }




   



}