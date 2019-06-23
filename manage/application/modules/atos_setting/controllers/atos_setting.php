<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Atos_setting extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('crud_model','crud');

    }

    public  $redirect = "atos_setting";

    public function index()
    {

        $data['atos'] = $this->crud->get_not_deleted('igc_atos_setting');
        $data['title']= "Atos List";
        $this->load->view('header', $data);
        $this->load->view('atos_list');
        $this->load->view('footer');
    }


    public function form($setting_id=0){

        if($this->input->post()){
            // print_r($this->input->post());
            // exit;
            $insert['merchant_id'] = $this->input->post('merchant_id');
            $active_status = $this->input->post('active_status');
            $insert['request_url'] = $this->input->post('request_url');
            $insert['currency_code'] = $this->input->post('currency_code');
            $insert['secret_key'] = $this->input->post('secret_key');
            $insert['key_version'] = $this->input->post('key_version');
            $insert['setting_type'] = $this->input->post('setting_type');
            $insert['created'] = date('Y-m-d:H:i:s');
            $insert['delete_status'] = "0";
            if(!empty($active_status) && $active_status == '1'){
                $update['active_status'] = '0';
                $insert['active_status'] = $active_status;
                $this->crud->whole_update($update, 'igc_atos_setting');
                $result = $this->crud->insert($insert, 'igc_atos_setting');
            }else{
                $insert['active_status'] = $active_status;
                $result = $this->crud->insert($insert, 'igc_atos_setting');
            }
            if($result)
                {
                    
                    $this->session->set_flashdata('success','New Atos data has been inserted.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new atos data.');
                    redirect($this->redirect);
                }
              
        

              
        }

        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add Atos";
        $this->load->view('header',$data);
        $this->load->view('atos_form');
        $this->load->view('footer');
          
    }

    public function edit($setting_id){

        if($this->input->post()){
            // print_r($this->input->post());
            // exit;
            $insert['merchant_id'] = $this->input->post('merchant_id');
            $active_status = $this->input->post('active_status');
            $insert['request_url'] = $this->input->post('request_url');
            $insert['currency_code'] = $this->input->post('currency_code');
            $insert['secret_key'] = $this->input->post('secret_key');
            $insert['key_version'] = $this->input->post('key_version');
            $insert['setting_type'] = $this->input->post('setting_type');
            $insert['created'] = date('Y-m-d:H:i:s');
            $insert['updated'] = date('Y-m-d:H:i:s');
            $insert['delete_status'] = "0";
            if(!empty($active_status) && $active_status == '1'){
                $update['active_status'] = '0';
                $insert['active_status'] = $active_status;
                $this->crud->whole_update($update, 'igc_atos_setting');
                $delete = $this->crud->delete($setting_id, 'setting_id', 'igc_atos_setting');
                if($delete){
                    $result = $this->crud->insert($insert, 'igc_atos_setting');
                }else{
                    $this->session->set_flashdata('error','Unable to update the atos.');
                    redirect($this->redirect);
                }

            }else{

                $insert['active_status'] = $active_status;

                $delete = $this->crud->delete($setting_id, 'setting_id', 'igc_atos_setting');
                if($delete){
                    $result = $this->crud->insert($insert, 'igc_atos_setting');
                }else{
                        $this->session->set_flashdata('error','Unable to update the atos.');
                        redirect($this->redirect);
                }
            }
            if($result)
                {
                    $this->session->set_flashdata('success','New Atos data has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the new atos data.');
                    redirect($this->redirect);
                }              
        }

        $data['atos'] = $this->crud->get_detail($setting_id, 'setting_id', 'igc_atos_setting');
        // print_r($data['atos']);
        // exit;
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Edit Atos";
        $this->load->view('header',$data);
        $this->load->view('atos_edit');
        $this->load->view('footer');
          
    }


    


    public function delete($setting_id)
    {
        $detail = $this->crud->get_detail($setting_id, 'setting_id', 'igc_atos_setting');
     
        $result = $this->crud->soft_delete($setting_id, 'setting_id', 'igc_atos_setting');
        if($result)
        {
            $log['module_title']= $detail['merchant_id'];
            $log['action_id']= "3";
            $this->create_log($log);
            $this->session->set_flashdata('success','Atos has been deleted.');
            redirect('atos_setting');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Atos.');
            redirect('atos_setting');
        }

    }

    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Atos Setting";
        $this->db->insert('igc_user_logs', $insert);
    }



}

