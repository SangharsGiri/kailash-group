<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Popup extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        //$this->load->model('hotel_model','hotel');
        $this->load->model('crud_model', 'crud');

    }
   // public $redirect = "hotel";

    public function  index()
    {

        $data['records'] = $this->crud->get_not_deleted('igc_popup');
        // print_r($data['records']);
        // exit;
        $data['title']= "Popup List";
        $this->load->view('header',$data);
        $this->load->view('popup_list');
        $this->load->view('footer');
    }

    public function form($popup_id=0){

        if($this->input->post()){
            // print_r($this->input->post());
            // exit;
            $insert['title'] = $this->input->post('title');
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['link'] = $this->input->post('link');
            $rand = md5(rand());
            $popup_image= $rand. str_replace(" ","",$_FILES['popup_image']['name']);
            $popupimgtmp=$_FILES['popup_image']['tmp_name'];
            $folder_path = '../uploads/popup/';
                if($_FILES['popup_image']['name'] !="")
                {
                    $insert['popup_image']= $popup_image;
                    move_uploaded_file($popupimgtmp, $folder_path.$popup_image);

                }
            $insert['body'] = $this->input->post('body');
            $insert['created'] = date('Y-m-d:H:i:s');
            $insert['updated'] = date('Y-m-d:H:i:s');
            $result = $this->crud->insert($insert, 'igc_popup');
            if($result)
                {
                    
                    $this->session->set_flashdata('success','New Popup has been inserted.');
                    redirect('popup');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new Popup.');
                    redirect('popup');
                }
              
        }

        $data['records'] = $this->crud->get_all('igc_popup');
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add Popup";
        $this->load->view('header',$data);
        $this->load->view('popup_form');
        $this->load->view('footer');
    }

    public function edit($popup_id){

        if($this->input->post()){
            // print_r($this->input->post());
            // exit;
            $insert['title'] = $this->input->post('title');
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['link'] = $this->input->post('link');
            $rand = md5(rand());
            $folder_path = '../uploads/popup/';
            $popup_image= $rand. str_replace(" ","",$_FILES['popup_image']['name']);
            $popupimgtmp=$_FILES['popup_image']['tmp_name'];
                if($_FILES['popup_image']['name'] !="")
                {
                    $insert['popup_image']= $popup_image;

                        move_uploaded_file($popupimgtmp, $folder_path.$popup_image);

                }
            $insert['body'] = $this->input->post('body');
            $insert['updated'] = date('Y-m-d:H:i:s');
            $result = $this->crud->update($popup_id, 'popup_id', $insert, 'igc_popup');
            if($result)
                {
                    
                    $this->session->set_flashdata('success','New Popup has been edited.');
                    redirect('popup');
                }
                else{
                    $this->session->set_flashdata('error','Unable to edit the Popup.');
                    redirect('popup');
                }
              
        }

        $data['records'] = $this->crud->get_detail($popup_id, 'popup_id', 'igc_popup');
        $data['scripts'] =array('themes/js/form-validator/jquery.form-validator');
        $data['title']= "Edit Popup";
        $this->load->view('header',$data);
        $this->load->view('popup_edit');
        $this->load->view('footer');
    }

    //code to delete the the  setting

    public function delete($popup_id)
    {
        $popup= $this->crud->get_detail($popup_id, 'popup_id', 'igc_popup');


        $result = $this->crud->soft_delete($popup_id, 'popup_id', 'igc_popup');

        if($result)
        {
            //code to create log
            $log['module_title']= $popup['title'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Popup Information has been deleted.');
            redirect('popup');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Information.');
            redirect('popup');
        }
    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Popup";
        $this->db->insert('igc_user_logs', $insert);
    }

   

}