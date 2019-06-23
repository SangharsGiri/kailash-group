<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SPG extends MX_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model','crud');

    }

    public  $table = "igc_2c2p_setting";
    public $field_name = "id";
    public  $redirect = "SPG";

    public function index()
    {
        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "2c2p Setting";
        $this->load->view('header', $data);
        $this->load->view('2c2p_list');
        $this->load->view('footer');
    }

    //code to add/edit

    public function form($id=0)
    {

        $this->load->library('form_validation');
        if($this->input->post()) {
            $this->form_validation->set_rules('version', 'Version', 'required');
            $this->form_validation->set_rules('merchant_id', 'Merchant Id','required');
            $this->form_validation->set_rules('payment_description', 'Payment Description','required');
            $this->form_validation->set_rules('pay_category_id', 'pay_category_id');
            $this->form_validation->set_rules('promotion', 'promotion');
            $this->form_validation->set_rules('client_url', 'client_url', 'required');
            $this->form_validation->set_rules('merchant_url', 'merchant_url', 'required');
            $this->form_validation->set_rules('request_3ds', 'request_3ds', 'required');
            $this->form_validation->set_rules('secret_key', 'secret key' , 'required');
            $this->form_validation->set_rules('environment', 'environment', 'required');
            $this->form_validation->set_rules('publish_status', 'Status', 'required');

            if ($this->form_validation->run()) {


                $id = $this->input->post('id');
                $insert['version'] = $this->input->post('version');
                $insert['merchant_id'] =  $this->input->post('merchant_id');
                $insert['payment_description'] = $this->input->post('payment_description');
                $insert['pay_category_id'] = $this->input->post('pay_category_id');
                $insert['promotion'] = $this->input->post('promotion');
                $insert['client_url'] = $this->input->post('client_url');
                $insert['merchant_url'] = $this->input->post('merchant_url');
                $insert['request_3ds'] = $this->input->post('request_3ds');
                $insert['secret_key'] = $this->input->post('secret_key');
                $insert['environment'] = $this->input->post('environment');
                $insert['publish_status'] = $this->input->post('publish_status');
                $insert['delete_status'] = "0";

                if($insert['publish_status'] == "1")
                {
                    $this->update_all();
                }

                if ($id == "") {

                    $insert['created'] = date('Y-m-d:H:i:s');

                    $insert['created'] = date('Y-m-d:H:i:s');
                    $result = $this->crud->insert($insert, $this->table);
                    if ($result) {
                        //code to create log
                        $log['module_title'] = $insert['merchant_id'];
                        $log['action_id'] = "1";
                        $this->create_log($log);

                        $this->session->set_flashdata('success', 'New 2c2p Gateway setting has been added.');
                        redirect($this->redirect);
                    } else {
                        $this->session->set_flashdata('error', 'Unable to add 2c2p Setting.');
                        redirect($this->redirect);
                    }

                } else {


                    $insert['updated'] = date('Y-m-d:H:i:s');

                    $result = $this->crud->update($id, $this->field_name, $insert, $this->table);
                    if ($result) {

                        //code to create log
                        $log['module_title'] = $insert['merchant_id'];
                        $log['action_id'] = "2";
                        $this->create_log($log);

                        $this->session->set_flashdata('success', '2c2p Gateway setting has been updated.');
                        redirect($this->redirect);
                    } else {
                        $this->session->set_flashdata('error', 'Unable to update the 2c2p Gateway setting.');
                        redirect($this->redirect);
                    }

                }


            }
        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit 2c2p Gateway";
        $this->load->view('header', $data);
        $this->load->view('2c2p_form');
        $this->load->view('footer');
    }



    //function to delete

    public function delete($id)
    {
        $detail = $this->crud->get_detail($id,  $this->field_name, $this->table);
        $result = $this->crud->soft_delete($id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= $detail['merchant_id'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','2c2p Gateway setting has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the 2c2p Gateway setting.');
            redirect($this->redirect);
        }

    }


    //function to inactive all the settings in bulk


    public function update_all()
    {

        $update['publish_status'] = "0";
        $this->crud->update('0','delete_status', $update, 'igc_2c2p_setting');
    }

    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "2c2p Setting";
        $this->db->insert('igc_user_logs', $insert);
    }

}

