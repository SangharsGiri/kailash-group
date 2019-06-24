<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model','crud');
        $permission = $this->session->userdata('permission');

        if($permission == "1")
        {
            redirect('dashboard');
        }
    }

    var $table="igc_users";
    var $title="Users";
    var $field_name = "user_id";
    var $redirect="user";


    public function index()
    {

        $data['User'] = $this->crud->get_not_deleted($this->table);
        $data['title']= $this->title;
        $this->load->view('header', $data);
        $this->load->view('user_list');
        $this->load->view('footer');
    }

    //code to add/edit user

    public function form($id=0)
    {
        if($this->input->post())
        {


            $user_id = $this->input->post('user_id');
             $insert['username']=$this->input->post('username');
             $insert['email']=$this->input->post('email');
             $insert['permission']=$this->input->post('permission');
             $insert['status']=$this->input->post('status');
             $insert['delete_status']="0";
                     


            if($user_id =="")
            {
                $insert['password']=md5($this->input->post('password'));
                $insert['last_login'] = date('Y-m-d:H:i:s');
                $insert['date_created'] = date('Y-m-d:H:i:s');
                $table = $this->table;
                $result = $this->crud->insert($insert,$table);
                if($result)
                {

                    $this->session->set_flashdata('success','New User has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add new User.');
                    redirect($this->redirect);
                }

            }
        else{


            $table = $this->table;
            $field_name =$this->field_name;

            //print_r($insert);


            $result = $this->crud->update($user_id, $field_name, $insert, $table);
            if($result)
            {

                $this->session->set_flashdata('success','User has been updated.');
                redirect($this->redirect);
            }
            else{
                $this->session->set_flashdata('error','Unable to update the User.');
                redirect($this->redirect);
            }

        }


        }
        $table = $this->table;
        $field_name = $this->field_name;
        $data['User'] = $this->crud->get_detail($id, $field_name, $table);

        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit".$this->title;
        $this->load->view('header', $data);
        $this->load->view('user_form');
        $this->load->view('footer');
    }


    //function to delete user

    public function delete($id)
    {
        $table = $this->table;
        $field_name = $this->field_name;
        $result = $this->crud->soft_delete($id, $field_name, $table);
        if($result)
        {
            $this->session->set_flashdata('success','User has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the user.');
            redirect($this->redirect);
        }

    }





}

