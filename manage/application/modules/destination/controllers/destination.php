<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Destination extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        //check_admin();

        $this->load->model('crud_model','crud');
        

    }

    public function index()
    {
        $table = 'igc_destination';
        $data['destination'] = $this->crud->get_all($table);
        $data['title']= "Destination List";
        $this->load->view('header', $data);
        $this->load->view('destination_list');
        $this->load->view('footer');
    }

    //code to add/edit region

    public function form($id=0)
    {
        if($this->input->post())
        {
            $destination_id = $this->input->post('destination_id');
            $insert['destination'] = $this->input->post('destination');
            $insert['destination_detail'] = $this->input->post('destination_detail');
             $folder_path = '../uploads/destinations/';
            $rand = md5(rand());
            $featuredimg= $rand. str_replace(" ","",$_FILES['featured_img']['name']);
            $featuredimgtmp=$_FILES['featured_img']['tmp_name'];


            if($destination_id =="")
            {
                $insert['created'] = date('Y-m-d:H:i:s');
                $table = 'igc_destination';
                if($_FILES['featured_img']['name'] !="")
                {
                    $insert['featured_img']= $featuredimg;

                        move_uploaded_file($featuredimgtmp,$folder_path.$featuredimg);

                }
                $result = $this->crud->insert($insert,$table);
                if($result)
                {

                    $this->session->set_flashdata('success','New destination has been added.');
                    redirect('destination');
                }
                else{
                    $this->session->set_flashdata('error','Unable to add new destination.');
                    redirect('destination');
                }

            }
        else{

            $insert['updated'] = date('Y-m-d:H:i:s');
            if($_FILES['featured_img']['name'] !="")
                {
                    $pre_featured_img = $this->input->post('pre_featuredimg');

                    @unlink($folder_path.$pre_featured_img);

                    $insert['featured_img']= $featuredimg;

                    move_uploaded_file($featuredimgtmp,$folder_path.$featuredimg);

                }
            $table = 'igc_destination';
            $field_name = "destination_id";
            $result = $this->crud->update($destination_id, $field_name, $insert, $table);
            if($result)
            {

                $this->session->set_flashdata('success','Destination has been updated.');
                redirect('destination');
            }
            else{
                $this->session->set_flashdata('error','Unable to update the destination.');
                redirect('destination');
            }

        }


        }
        $table = 'igc_destination';
        $field_name = "destination_id";
        $data['destination'] = $this->crud->get_detail($id, $field_name, $table);
        $data['script'] ="form_validator";
        $data['title']= "Add/Edit Destination";
        $this->load->view('header', $data);
        $this->load->view('destination_form');
        $this->load->view('footer');
    }



    


    //function to delete category

    public function destination_delete($destination_id)
    {
        $table = 'igc_destination';
        $field_name = "destination_id";
        $result = $this->crud->delete($destination_id, $field_name, $table);
        if($result)
        {
            $this->session->set_flashdata('success','Destination has been deleted.');
            redirect('destination');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the destination.');
            redirect('destination');
        }

    }





}

