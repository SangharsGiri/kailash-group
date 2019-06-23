<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Igcpay extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('igcpay_model','setting');

    }

    public function index()
    {
        $data['setting'] = $this->setting->get_setting_list();
        $data['title']= "IGCPay Setting List";
        $this->load->view('header', $data);
        $this->load->view('igcpay_list');
        $this->load->view('footer');
    }

    public function form($id=0)
    {
        if($this->input->post())
        {
//            print_r($this->input->post());
//            exit;

            $id = $this->input->post('id');
            $insert['merchant_key'] = $this->input->post('merchant_key');
            $insert['connection_url'] = $this->input->post('connection_url');
            $insert['checkout_url'] = $this->input->post('checkout_url');
            $insert['response_url'] = $this->input->post('response_url');
            $insert['site_api_url'] = $this->input->post('site_api_url');
            $insert['site_response_url'] = $this->input->post('site_response_url');
            $insert['active_status'] = $this->input->post('active_status');
            $insert['delete_status'] = "0";


            if($id == "")
            {
                $insert['created'] = date('Y-m-d:H:i:s');

                $result = $this->setting->insert_setting($insert);
                if($result)
                {
                    //code to create log
                    $log['module_title']= "Setting Id" . " "."(". $result.")";
                    $log['action_id']= "1";
                    $this->create_log($log);

                    if($insert['active_status'] == "1")
                    {
                        $this->setting->change_status($result);
                    }
                    $this->session->set_flashdata('success','New IGC PAY Information has been inserted.');
                    redirect('igcpay');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new  IGC PAY Information.');
                    redirect('igcpay');
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:H:i:s');



                $result = $this->setting->update_setting($insert, $id);
                if($result)
                {

                    //code to create log
                    $log['module_title']= "Setting Id" . " "."(". $id.")";
                    $log['action_id']= "2";
                    $this->create_log($log);

                    if($insert['active_status'] == "1")
                    {
                        $this->setting->change_status($id);
                    }
                    $this->session->set_flashdata('success','IGC PAY Information has been updated.');
                    redirect('igcpay');
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the IGC PAY Information.');
                    redirect('igcpay');
                }

            }



        }

       $data['setting'] = $this->setting->get_detail($id);

        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit Mail IGC PAY Settings";
        $this->load->view('header', $data);
        $this->load->view('igcpay_form');
        $this->load->view('footer');
    }


    //code to delete the the  setting

    public function delete($id)
    {
        $result = $this->setting->delete_setting($id);
        if($result)
        {
            //code to create log
            $log['module_title']= "Setting Id" . " "."(". $id.")";
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','IGC PAY Information has been deleted.');
            redirect('igcpay');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the IGC PAY Information.');
            redirect('igcpay');
        }
    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "IGCPay Settings";
        $this->db->insert('igc_user_logs', $insert);
    }






}