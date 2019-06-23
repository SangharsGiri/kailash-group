<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logo extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('crud_model','crud');

    }

    public  $table = "igc_logo";
    public $field_name = "logo_id";
    public  $redirect = "logo";

    public function index()
    {
        $data['records'] = $this->crud->get_all($this->table);
        $data['title']= "logo";
        $this->load->view('header', $data);
        $this->load->view('logo_list');
        $this->load->view('footer');
    }

    //code to add/edit

    public function form($id=0)
    {
        if($this->input->post())
        {
            $folder_path = '../uploads/logo/';
            $logo_id = $this->input->post('logo_id');
            $insert['logo_title'] = $this->input->post('logo_title');
            $insert['publish_status'] = $this->input->post('publish_status');

            $rand = md5(rand());
            $logo_image= $rand. str_replace(" ","",$_FILES['logo_image']['name']);
            $logo_imagetmp=$_FILES['logo_image']['tmp_name'];
            if($logo_id =="")
            {
                if($_FILES['logo_image']['name'] !="")
                {
                    $insert['logo_image']= $logo_image;

                    move_uploaded_file($logo_imagetmp,$folder_path.$logo_image);

                }
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert($insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['logo_title'];
                    $log['action_id']= "1";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','New logo has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add logo.');
                    redirect($this->redirect);
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:H:i:s');
                if($_FILES['logo_image']['name'] !="")
                {
                    $pre_logo_image = $this->input->post('pre_logo_image');

                    @unlink($folder_path.$pre_logo_image);

                    $insert['logo_image']= $logo_image;

                    move_uploaded_file($logo_imagetmp,$folder_path.$logo_image);

                }

                $result = $this->crud->update($logo_id, $this->field_name, $insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['logo_title'];
                    $log['action_id']= "2";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','logo has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the logo.');
                    redirect($this->redirect);
                }

            }


        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit logo";
        $this->load->view('header', $data);
        $this->load->view('logo_form');
        $this->load->view('footer');
    }




    //function to delete

    public function delete($logo_id)
    {
        $logo_detail = $this->crud->get_detail($logo_id,  $this->field_name, $this->table);

        $result = $this->crud->delete($logo_id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= $logo_detail['logo_title'];
            $log['action_id']= "3";
            $this->create_log($log);

            $path='../uploads/logo/';
            @unlink($path.$logo_detail['logo_image']);
            $this->session->set_flashdata('success','logo has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the logo.');
            redirect($this->redirect);
        }

    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "logo";
        $this->db->insert('igc_user_logs', $insert);
    }

}

