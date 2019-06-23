<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Emagazine extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        //check_admin();

        $this->load->model('crud_model','crud');
        

    }
    public $table ="igc_emagazine";
     public  $redirect = "emagazine";
     public $field_name = "emagazine_id";

    public function index()
    {
        $table = 'igc_emagazine';
        $data['magazine'] = $this->crud->get_all($table);
        $data['title']= "Emagazine Image List";
        $this->load->view('header', $data);
        $this->load->view('emagazine_list');
        $this->load->view('footer');
    }

    //code to add/edit region

    public function form($id=0)
    {
        if($this->input->post())
        {
            $folder_path = '../uploads/emagazine/';
            $emagazine_id = $this->input->post('emagazine_id');
            $insert['publish_status'] = $this->input->post('publish_status');

            $rand = md5(rand());
            $featuredimg=$rand. str_replace(" ","",$_FILES['featured_img']['name']);
            $featuredimgtmp=$_FILES['featured_img']['tmp_name'];
            $path = '../uploads/emagazine/';
            $insert['delete_status'] = "0";
            if($emagazine_id =="")
            {
                $insert['featured_img']= $featuredimg;
             
                $result = $this->crud->insert($insert, $this->table);
                if($result)
                {
                    move_uploaded_file($featuredimgtmp,$path.$featuredimg);
                    $this->session->set_flashdata('success','image has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add information');
                    redirect($this->redirect);
                }

            }
            else{
                $featuredimg_new = $_FILES['featured_img']['name'];

                if($featuredimg_new !="")
                {
                    $pre_featuredimg = $this->input->post('pre_featuredimg');
                    @unlink($path.$pre_featuredimg);
                    move_uploaded_file($featuredimgtmp,$path.$featuredimg);
                    $insert['featured_img'] = $featuredimg;

                }
            $result = $this->crud->update($emagazine_id, $this->field_name, $insert, $this->table);
                if($result)
                {
                    $this->session->set_flashdata('success','Image has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update.');
                    redirect($this->redirect);
                }

            }


        }

        $table = 'igc_emagazine';
        $field_name = "emagazine_id";
        $data['emagazine'] = $this->crud->get_detail($id, $field_name, $table);
        $data['script'] ="form_validator";
        $data['title']= "Add/Edit Emagazine";
        $this->load->view('header', $data);
        $this->load->view('emagazine_form');
        $this->load->view('footer');
    }



    


    public function delete($emagazine_id)
    {
        $detail = $this->crud->get_detail($emagazine_id,  $this->field_name, $this->table);

        $result = $this->crud->delete($emagazine_id, $this->field_name, $this->table);
        if($result)
        {
         
            $path='../uploads/emagazine/';
            @unlink($path.$detail['featured_img']);
            $this->session->set_flashdata('success','Image has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete.');
            redirect($this->redirect);
        }

    }




}

