<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subscribers extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');

    }

    public  $table = "igc_subscribe_users";
    public $field_name = "id";
    public  $redirect = "subscribers";



    public function index()
    {

        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Subscribers Users";
        $this->load->view('header', $data);
        $this->load->view('subscribers_list');
        $this->load->view('footer');
    }


    public function active()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id');
            $update['active_status']="1";
            $this->crud->update($id, 'id', $update, $this->table);
            //code to create log
            $log['module_title']= "Subscribers Id" . " "."(". $id.")";
            $log['action_id']= "2";
            $this->create_log($log);
            echo "success";
        }
    }

    public function inactive()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id');
            $update['active_status']="0";
            $this->crud->update($id, 'id', $update, $this->table);
            //code to create log
            $log['module_title']= "Subscribers Id" . " "."(". $id.")";
            $log['action_id']= "2";
            $this->create_log($log);
            echo "success";
        }
    }


    //function to delete

    public function delete($id)
    {

        $result = $this->crud->soft_delete($id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= "Subscribers Id" . " "."(". $id.")";
            $log['action_id']= "3";
            $this->create_log($log);
            $this->session->set_flashdata('success','Subscribe Account has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Subscribe Account.');
            redirect($this->redirect);
        }

    }

    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Subscribers";
        $this->db->insert('igc_user_logs', $insert);
    }





}

