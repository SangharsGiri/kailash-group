<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Trip_quote extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');

    
    }

    public  $table = "igc_trip_quote";
    public $field_name = "quote_id";
    public  $redirect = "trip_quote";



    public function index()
    {

        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Trip Quote List";
        $this->load->view('header', $data);
        $this->load->view('trip_quote_list');
        $this->load->view('footer');
    }




    //function to delete

    public function delete($id)
    {

        $result = $this->crud->soft_delete($id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= "Quote Id"." "."(".$id.")";
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Trip Quote has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Trip Quote.');
            redirect($this->redirect);
        }

    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] = "Trip Quote";
        $this->db->insert('igc_user_logs', $insert);
    }






}

