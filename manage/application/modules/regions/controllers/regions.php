<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Regions extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        //check_admin();

        $this->load->model('crud_model','crud');
        $this->load->model('region_model','region');

    }

    public function index()
    {
        $table = 'igc_regions';
        $data['regions'] = $this->crud->get_all($table);
        $data['title']= "Regions List";
        $this->load->view('header', $data);
        $this->load->view('region_list');
        $this->load->view('footer');
    }

    //code to add/edit region

    public function form($id=0)
    {
        if($this->input->post())
        {
            $region_id = $this->input->post('region_id');
            $insert['region_name'] = $this->input->post('region_name');
            


            if($region_id =="")
            {
                $insert['created'] = date('Y-m-d:H:i:s');
                $table = 'igc_regions';
                $result = $this->crud->insert($insert,$table);
                if($result)
                {

                    $this->session->set_flashdata('success','New Region has been added.');
                    redirect('regions');
                }
                else{
                    $this->session->set_flashdata('error','Unable to add new region.');
                    redirect('regions');
                }

            }
        else{

            $insert['updated'] = date('Y-m-d:H:i:s');
            $table = 'igc_regions';
            $field_name = "region_id";
            $result = $this->crud->update($region_id, $field_name, $insert, $table);
            if($result)
            {

                $this->session->set_flashdata('success','Region has been updated.');
                redirect('regions');
            }
            else{
                $this->session->set_flashdata('error','Unable to update the Region.');
                redirect('regions');
            }

        }


        }
        $table = 'igc_regions';
        $field_name = "region_id";
        $data['region'] = $this->crud->get_detail($id, $field_name, $table);
        $data['script'] ="form_validator";
        $data['title']= "Add/Edit Regions";
        $this->load->view('header', $data);
        $this->load->view('region_form');
        $this->load->view('footer');
    }



    


    //function to delete category

    public function region_delete($region_id)
    {
        $table = 'igc_regions';
        $field_name = "region_id";
        $result = $this->crud->delete($region_id, $field_name, $table);
        if($result)
        {
            $this->session->set_flashdata('success','Region has been deleted.');
            redirect('regions');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Region.');
            redirect('regions');
        }

    }





}

