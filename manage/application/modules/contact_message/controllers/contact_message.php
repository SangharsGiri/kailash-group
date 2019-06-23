<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact_message extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');

    
    }

    public  $table = "igc_quick_contact_message";
    public $field_name = "id";
    public  $redirect = "contact_message";



    public function index()
    {

        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Quick Contact Message List";
        $this->load->view('header', $data);
        $this->load->view('message_list');
        $this->load->view('footer');
    }




    //function to delete

    public function delete($id)
    {

        $result = $this->crud->soft_delete($id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= "Message Id" . " "."(". $id.")";
            $log['action_id']= "3";
            $this->create_log($log);
            $this->session->set_flashdata('success','Message has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Message.');
            redirect($this->redirect);
        }

    }

    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Quick Contact";
        $this->db->insert('igc_user_logs', $insert);
    }






}

