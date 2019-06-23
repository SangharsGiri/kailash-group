<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paypal_setting extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

      
        $this->load->model('crud_model','crud');

    }

    public  $redirect = "paypal_setting";

    public function index()
    {

        $data['paypal'] = $this->crud->get_not_deleted('igc_paypal_setting');
        $data['title']= "Payment List";
        $this->load->view('header', $data);
        $this->load->view('paypal_list');
        $this->load->view('footer');
    }

    public function form($id=0){

        if($this->input->post()){
            // print_r($this->input->post());
            // exit;
            $insert['api_username'] = $this->input->post('api_username');
            $publish_status = $this->input->post('publish_status');
            $insert['api_password'] = $this->input->post('api_password');
            $insert['currency_code'] = $this->input->post('currency_code');
            $insert['api_signature'] = $this->input->post('api_signature');
            $insert['created'] = date('Y-m-d:H:i:s');
            $insert['delete_status'] = "0";
            $insert['paypal_mode'] = $this->input->post('paypal_mode');
            if(!empty($publish_status) && $publish_status == '1'){
                $update['publish_status'] = '0';
                $insert['publish_status'] = $publish_status;
                $this->crud->whole_update($update, 'igc_paypal_setting');
                $result = $this->crud->insert($insert, 'igc_paypal_setting');
            }else{
                $insert['publish_status'] = $publish_status;
                $result = $this->crud->insert($insert, 'igc_paypal_setting');
            }
            if($result)
                {
                    $this->session->set_flashdata('success','New paypal data has been inserted.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new paypal data.');
                    redirect($this->redirect);
                }              
        }

        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add Paypal";
        $this->load->view('header',$data);
        $this->load->view('paypal_form');
        $this->load->view('footer');
          
    }

    public function edit($id){

        if($this->input->post()){
            // print_r($this->input->post());
            // exit;
            $insert['api_username'] = $this->input->post('api_username');
            $publish_status = $this->input->post('publish_status');
            $insert['api_password'] = $this->input->post('api_password');
            $insert['currency_code'] = $this->input->post('currency_code');
            $insert['api_signature'] = $this->input->post('api_signature');
            $insert['created'] = date('Y-m-d:H:i:s');
            $insert['updated'] = date('Y-m-d:H:i:s');
            $insert['delete_status'] = "0";
            $insert['paypal_mode'] = $this->input->post('paypal_mode');

            if(!empty($publish_status) && $publish_status == '1'){
                $update['publish_status'] = '0';
                $insert['publish_status'] = $publish_status;
                $this->crud->whole_update($update, 'igc_paypal_setting');
                $delete = $this->crud->delete($id, 'id', 'igc_paypal_setting');
                if($delete){
                    $result = $this->crud->insert($insert, 'igc_paypal_setting');
                }else{
                    $this->session->set_flashdata('error','Unable to update the atos.');
                    redirect($this->redirect);
                }

            }else{

                $insert['publish_status'] = $publish_status;

                $delete = $this->crud->delete($id, 'id', 'igc_paypal_setting');
                if($delete){
                    $result = $this->crud->insert($insert, 'igc_paypal_setting');
                }else{
                        $this->session->set_flashdata('error','Unable to update the atos.');
                        redirect($this->redirect);
                }
            }
            if($result)
                {
                    $this->session->set_flashdata('success','New paypal data has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the paypal data.');
                    redirect($this->redirect);
                }              
        }

        $data['paypal'] = $this->crud->get_detail($id, 'id', 'igc_paypal_setting');
        // print_r($data['paypal']);
        // exit;
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Edit Paypal";
        $this->load->view('header',$data);
        $this->load->view('paypal_edit');
        $this->load->view('footer');
          
    }


    


    public function delete($id)
    {
        $detail = $this->crud->get_detail($id, 'id', 'igc_paypal_setting');
     
        $result = $this->crud->soft_delete($id, 'id', 'igc_paypal_setting');
        if($result)
        {
            $log['module_title']= $detail['api_username'];
            $log['action_id']= "3";
            $this->create_log($log);
            $this->session->set_flashdata('success','Paypal data has been deleted.');
            redirect('paypal_setting');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the paypal data.');
            redirect('paypal_setting');
        }

    }

    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Paypal Setting";
        $this->db->insert('igc_user_logs', $insert);
    }



}

