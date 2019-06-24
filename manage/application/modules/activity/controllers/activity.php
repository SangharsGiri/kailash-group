<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Activity extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('crud_model','crud');
        $this->load->model('activity_model','activity');

    }

    public  $table = "igc_activity";
    public $field_name = "activity_id";
    public  $redirect = "activity";

    public function index()
    {
        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Activity List";
        $this->load->view('header', $data);
        $this->load->view('activity_list');
        $this->load->view('footer');
    }

    public function form($id= 0)
    {
        $this->load->helper('html');
        $this->load->helper('form');

        if($this->input->post())
        {

//            print_r($this->input->post());
//            exit;

            $activity_id = $this->input->post('activity_id');

            $insert['activity_name'] = $this->input->post('activity_name');
            $activity_url = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['activity_name'])) ;
            $insert['description']= $this->input->post('description');
            $insert['tab'] = $this->input->post('tab');
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['meta_description'] = $this->input->post('meta_description');
            $insert['meta_keywords'] = $this->input->post('meta_keywords');
            $insert['meta_title'] = $this->input->post('meta_title');

            //code to check url

            $check_url =  $this->crud->check_url($activity_id, $this->field_name, $activity_url, 'activity_url', $this->table);
            if(!empty($check_url))
            {
                $insert['activity_url']= $activity_url."-".rand(1, 50);
            }
            else
            {
                $insert['activity_url'] = $activity_url;
            }

            $rand = md5(rand());
            $featuredimg=$rand. str_replace(" ","",$_FILES['featured_img']['name']);
            $featuredimgtmp=$_FILES['featured_img']['tmp_name'];


            $bannerimg=$rand. str_replace(" ","",$_FILES['banner_img']['name']);
            $bannerimgtmp=$_FILES['banner_img']['tmp_name'];

            $path = '../uploads/activity/';

            if($activity_id == "")
            {

                if($_FILES['featured_img']['name'] !="")
                {
                    $insert['featured_img']= $featuredimg;
                }
                if($_FILES['banner_img']['name'] !="")
                {
                    $insert['banner_img']= $bannerimg;
                }
                $insert['show_front']="0";
                $insert['delete_status'] = "0";
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert($insert, $this->table);

                if($result)
                {

                    //code for creating log
                    $log['module_title'] = $insert['activity_name'];
                    $log['action_id'] = "1";
                    $this->create_log($log);


                        move_uploaded_file($featuredimgtmp,$path.$featuredimg);
                        move_uploaded_file($bannerimgtmp,$path.$bannerimg);


                    if($result)
                    {
                        $this->session->set_flashdata('success','New Activity is Added Successfully');
                        redirect($this->redirect);
                    }
                    else{
                        $this->session->set_flashdata('error','Unable to Add Activity');
                        redirect($this->redirect);
                    }

                }
            }

            else{

                $featuredimg_new = $_FILES['featured_img']['name'];
                $bannerimg_new = $_FILES['banner_img']['name'];

                if($featuredimg_new !="")
                {
                    $filename = $this->input->post('pre_featuredimg');
                    @unlink($path.$filename);
                    move_uploaded_file($featuredimgtmp,$path.$featuredimg);
                    $insert['featured_img']= $featuredimg;
                }
                if($bannerimg_new !="")
                {

                    $filename1 = $this->input->post('pre_bannerimg');
                    @unlink($path.$filename1);
                    move_uploaded_file($bannerimgtmp,$path.$bannerimg);
                    $insert['banner_img']= $bannerimg;
                }


                $results = $this->crud->update($activity_id, $this->field_name, $insert, $this->table);

                if($results)
                {
                    //code to create package log

                    $log['module_title'] =  $insert['activity_name'];
                    $log['action_id'] = "2";
                    $this->create_log($log);


                    $this->session->set_flashdata('success','Activity is Updated Successfully');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to Update Activity');
                    redirect($this->redirect);
                }

            }

        }


        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title'] = "Add/Edit Activity";
        $this->load->view('header', $data);
        $this->load->view('activity_form');
        $this->load->view('footer');

    }



    public function gallery($activity_id)
    {

        if($this->input->post())
        {
            $id = $this->input->post('activity_id');
            $activity_album = $this->input->post('activity_album');
            $delete = $this->crud->delete($id, $this->field_name, 'igc_activity_album');
            if($delete)
            {
                foreach($activity_album as $pk => $value)
                {
                    $insert['activity_id']= $id;
                    $insert['album_id'] = $value;
                    $result = $this->crud->insert($insert, 'igc_activity_album');
                }
            }

            if($result)
            {
                $this->session->set_flashdata('success','Activity Gallery has been Updated.');
                redirect($this->redirect);
            }
            else
            {
                redirect($this->redirect);
            }





        }
        $data['records'] = $this->crud->get_not_deleted('igc_album');
        $data['activity_id'] = $activity_id;
        $data['title']= "Albums";
        $this->load->view('header', $data);
        $this->load->view('activity_albums');
        $this->load->view('footer');
    }


    //function related packages

    public function related_packages($activity_id)
    {

        if($this->input->post())
        {
//            print_r($this->input->post());
//            exit;

            $packages = $this->input->post('packages');
            $activity_id  = $this->input->post('activity_id');

            $detail =  $this->crud->get_detail($activity_id, $this->field_name, $this->table);
            $remove = $this->crud->delete($activity_id,$this->field_name,'igc_activity_packages');

            if($remove)
            {

                if(!empty($packages)) {
                    foreach ($packages as $pk => $value) {
                        $insert['package_id'] = $value;
                        $insert['activity_id'] = $activity_id;
                        $result = $this->crud->insert($insert, 'igc_activity_packages');
                    }

                    if ($result) {
                        //code to create log
                        $log['module_title'] = $detail['activity_name'];
                        $log['action_id'] = "2";
                        $this->create_activity_package_log($log);

                        $this->session->set_flashdata('success', 'Related Packages has been added.');
                        redirect($this->redirect);
                    } else {
                        $this->session->set_flashdata('error', 'Unable to add related packages.');
                        redirect($this->redirect);
                    }
                }
            }

            else{
                $this->session->set_flashdata('error','Unable to add related packages.');
                redirect($this->redirect);
            }


        }

        $data['packages'] = $this->crud->get_not_deleted('igc_package');


        $data['activity_id'] = $activity_id;

        $data['title']= "Add/Edit Related Packages";
        $this->load->view('header', $data);
        $this->load->view('related_packages');
        $this->load->view('footer');
    }


    //code to soft delete the content

    public function delete($content_id)
    {
        $content_detail = $this->crud->get_detail($content_id, $this->field_name, $this->table);
        $result = $this->crud->soft_delete($content_id, $this->field_name, $this->table);
        if($result)
        {
            $this->crud->delete($content_id,$this->field_name,'igc_activity_packages');
            $this->crud->delete($content_id,$this->field_name,'igc_activity_album');
            //code to create log
            $log['module_title']= $content_detail['activity_name'];
            $log['action_id']= "3";
            $this->create_log($log);

            $path='../uploads/activity/';
            @unlink($path.$content_detail['featured_img']);
            @unlink($path.$content_detail['banner_img']);
            $this->session->set_flashdata('success','Activity has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Activity.');
            redirect($this->redirect);
        }
    }


//show  in front

    public function show_front()
    {
        $active_id =  $this->input->post('active_id');
        $inactive_id =  $this->input->post('inactive_id');

        if($active_id !="")
        {
            $update['show_front']= "1";
            $this->crud->update($active_id, $this->field_name,$update, $this->table);
        }
        elseif($inactive_id !="")
        {
            $update['show_front']= "0";
            $this->crud->update($inactive_id, $this->field_name,$update, $this->table);
        }
        else{

        }



    }



    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Activity";
        $this->db->insert('igc_user_logs', $insert);
    }

    //function to create log

    public function create_activity_package_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Activity Packages";
        $this->db->insert('igc_user_logs', $insert);
    }

}