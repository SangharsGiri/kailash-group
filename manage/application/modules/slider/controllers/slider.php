<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slider extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('crud_model','crud');

    }

    public  $table = "igc_slider";
    public $field_name = "slider_id";
    public  $redirect = "slider";

    public function index()
    {
        $data['records'] = $this->crud->get_all($this->table);
        $data['title']= "Slider";
        $this->load->view('header', $data);
        $this->load->view('slider_list');
        $this->load->view('footer');
    }

    //code to add/edit

    public function form($id=0)
    {
        if($this->input->post())
        {
            $folder_path = '../uploads/slider/';
            $slider_id = $this->input->post('slider_id');
            $insert['slider_title'] = $this->input->post('slider_title');
            $insert['publish_status'] = $this->input->post('publish_status');

            $rand = md5(rand());
            $slider_image= $rand. str_replace(" ","",$_FILES['slider_image']['name']);
            $slider_imagetmp=$_FILES['slider_image']['tmp_name'];
            if($slider_id =="")
            {
                if($_FILES['slider_image']['name'] !="")
                {
                    $insert['slider_image']= $slider_image;

                    move_uploaded_file($slider_imagetmp,$folder_path.$slider_image);

                }
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert($insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['slider_title'];
                    $log['action_id']= "1";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','New Slider has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add Slider.');
                    redirect($this->redirect);
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:H:i:s');
                if($_FILES['slider_image']['name'] !="")
                {
                    $pre_slider_image = $this->input->post('pre_slider_image');

                    @unlink($folder_path.$pre_slider_image);

                    $insert['slider_image']= $slider_image;

                    move_uploaded_file($slider_imagetmp,$folder_path.$slider_image);

                }

                $result = $this->crud->update($slider_id, $this->field_name, $insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['slider_title'];
                    $log['action_id']= "2";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','Slider has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the Slider.');
                    redirect($this->redirect);
                }

            }


        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit Slider";
        $this->load->view('header', $data);
        $this->load->view('slider_form');
        $this->load->view('footer');
    }




    //function to delete

    public function delete($slider_id)
    {
        $slider_detail = $this->crud->get_detail($slider_id,  $this->field_name, $this->table);

        $result = $this->crud->delete($slider_id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= $slider_detail['slider_title'];
            $log['action_id']= "3";
            $this->create_log($log);

            $path='../uploads/slider/';
            @unlink($path.$slider_detail['slider_image']);
            $this->session->set_flashdata('success','Slider has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Slider.');
            redirect($this->redirect);
        }

    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Slider";
        $this->db->insert('igc_user_logs', $insert);
    }

}

