<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Global_partner extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('crud_model','crud');

    }

    public  $table = "global_partner";
    public $field_name = "id";
    public  $redirect = "Global_partner";

    public function index()
    {
        $data['records'] = $this->crud->get_all($this->table);
        $data['title']= "Global_partner";
        $this->load->view('header', $data);
        $this->load->view('global_list');
        $this->load->view('footer');
    }

    //code to add/edit

    public function form($id=0)
    {
        if($this->input->post())
        {
            $folder_path = '../uploads/partners/';
            $id = $this->input->post('id');
            $insert['title'] = $this->input->post('title');
            $insert['partner_url'] = $this->input->post('partner_url');
            $insert['publish_status'] = $this->input->post('publish_status');

            $rand = md5(rand());
            $featured_img= $rand. str_replace(" ","",$_FILES['featured_img']['name']);
            $featured_imgtmp=$_FILES['featured_img']['tmp_name'];
            if($id =="")
            {
                if($_FILES['featured_img']['name'] !="")
                {
                    $insert['featured_img']= $featured_img;

                    move_uploaded_file($featured_imgtmp,$folder_path.$featured_img);

                }
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert($insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['title'];
                    $log['action_id']= "1";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','New partners has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add partners.');
                    redirect($this->redirect);
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:H:i:s');
                if($_FILES['featured_img']['name'] !="")
                {
                    $pre_featured_img = $this->input->post('pre_featured_img');

                    @unlink($folder_path.$pre_featured_img);

                    $insert['featured_img']= $featured_img;

                    move_uploaded_file($featured_imgtmp,$folder_path.$featured_img);

                }

                $result = $this->crud->update($id, $this->field_name, $insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['title'];
                    $log['action_id']= "2";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','partners has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the partners.');
                    redirect($this->redirect);
                }

            }


        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit partner";
        $this->load->view('header', $data);
        $this->load->view('global');
        $this->load->view('footer');
    }




    //function to delete

    public function delete($id)
    {
        $slider_detail = $this->crud->get_detail($id,  $this->field_name, $this->table);

        $result = $this->crud->delete($id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= $slider_detail['title'];
            $log['action_id']= "3";
            $this->create_log($log);

            $path='../uploads/partners/';
            @unlink($path.$slider_detail['featured_img']);
            $this->session->set_flashdata('success','partners has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the partners.');
            redirect($this->redirect);
        }

    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Global_partner";
        $this->db->insert('igc_user_logs', $insert);
    }

}

