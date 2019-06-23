<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transportation extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');

    }

    public  $table = "igc_transportation";
    public $field_name = "transportation_id";
    public  $redirect = "transportation";



    public function index()
    {

        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Transportation";
        $this->load->view('header', $data);
        $this->load->view('transportation_list');
        $this->load->view('footer');
    }


    public function form($id=0)
    {

        $this->load->library('form_validation');
        if($this->input->post())
        {

            $this->form_validation->set_rules('source', 'Source', 'trim|required');
            $this->form_validation->set_rules('destination', 'Destination', 'trim|required');
            $this->form_validation->set_rules('publish_status', 'Publish Status', 'required');
            $this->form_validation->set_rules('currency_id', 'Currency', 'required');
            $this->form_validation->set_rules('rate', 'Rate', 'required');

            if ($this->form_validation->run()) {

                $transportation_id = $this->input->post('transportation_id');
                $insert['source'] = $this->input->post('source');
                $insert['destination'] = $this->input->post('destination');
                $insert['currency_id'] = $this->input->post('currency_id');
                $insert['rate'] = $this->input->post('rate');
                $insert['publish_status'] = $this->input->post('publish_status');
                $insert['delete_status'] = "0";
                if ($transportation_id == "") {

                    $insert['created'] = date('Y-m-d:H:i:s');
                    $result = $this->crud->insert($insert, $this->table);
                    if ($result) {

                        $this->session->set_flashdata('success', 'Transportation has been added.');
                        redirect($this->redirect);
                    } else {
                        $this->session->set_flashdata('error', 'Unable to add Transportation');
                        redirect($this->redirect);
                    }

                } else {

                    $insert['updated'] = date('Y-m-d:H:i:s');

                    $result = $this->crud->update($transportation_id, $this->field_name, $insert, $this->table);
                    if ($result) {
                        //code to create log
                        $log['module_title'] = $insert['source'] . "-" . $insert['destination'];
                        $log['action_id'] = "2";
                        $this->create_log($log);

                        $this->session->set_flashdata('success', 'Transportation has been updated.');
                        redirect($this->redirect);
                    } else {
                        $this->session->set_flashdata('error', 'Unable to update the Transportation.');
                        redirect($this->redirect);
                    }

                }
            }


        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit Transportation";
        $this->load->view('header', $data);
        $this->load->view('transportation_form');
        $this->load->view('footer');
    }



    //function to delete

    public function delete($id)
    {

        $detail = $this->crud->get_detail($id, $this->field_name, $this->table);
        $result = $this->crud->soft_delete($id, $this->field_name, $this->table);
        if($result)
        {

            //code to create log
            $log['module_title']=  $detail['source']."-".$detail['destination'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Transportation has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Transportation.');
            redirect($this->redirect);
        }

    }


//function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Transportation";
        $this->db->insert('igc_user_logs', $insert);
    }



}

