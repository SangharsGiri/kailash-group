<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail_setting extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('mail_setting_model','setting');

    }

    public function index()
    {
        $data['server_setting'] = $this->setting->get_mail_setting_list();
        $data['admin_mail'] = $this->setting->get_mail_list();
        $data['title']= "Mail Setting List";
        $this->load->view('header', $data);
        $this->load->view('mail_setting_list');
        $this->load->view('footer');
    }

    public function server_form($id=0)
    {
        if($this->input->post())
        {
//            print_r($this->input->post());
//            exit;
            $this->load->library('encrypt');

            $id = $this->input->post('id');
            $insert['server_prefix'] = $this->input->post('server_prefix');
            $insert['host'] = $this->input->post('host');
            $insert['port'] = $this->input->post('port');
            $insert['username'] = $this->input->post('username');
            $insert['send_from_name'] = $this->input->post('send_from_name');
            $insert['send_from_email'] = $this->input->post('send_from_email');
            $insert['reply_to_name'] = $this->input->post('reply_to_name');
            $insert['reply_to_email'] = $this->input->post('reply_to_email');
            $insert['smtp_connect'] = $this->input->post('smtp_connect');
            $insert['active_status'] = $this->input->post('active_status');
            $insert['delete_status'] = "0";


            if($id == "")
            {
                $insert['created'] = date('Y-m-d:H:i:s');
                $insert['password'] = $this->encrypt->encode($this->input->post('password'));
                $result = $this->setting->insert_server_setting($insert);
                if($result)
                {

                    //code to create log
                    $log['module_title']= "Mail Server";
                    $log['action_id']= "1";
                    $this->create_log($log);

                    if($insert['active_status'] == "1")
                    {
                        $this->setting->change_server_status($result);
                    }
                    $this->session->set_flashdata('success','New Server Information has been inserted.');
                    redirect('mail_setting');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new Server Information.');
                    redirect('mail_setting');
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:H:i:s');

                $password = $this->input->post('password');

                $check_password = $this->setting->check_password($password, $id);

                if(empty($check_password))
                {
                    $insert['password'] =  $this->encrypt->encode($this->input->post('password'));
                }

                $result = $this->setting->update_server_setting($insert, $id);
                if($result)
                {
                    //code to create log
                    $log['module_title']= "Mail Server";
                    $log['action_id']= "2";
                    $this->create_log($log);

                    if($insert['active_status'] == "1")
                    {
                        $this->setting->change_server_status($id);
                    }
                    $this->session->set_flashdata('success','Server Information has been updated.');
                    redirect('mail_setting');
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the Server Information.');
                    redirect('mail_setting');
                }

            }



        }

       $data['setting'] = $this->setting->get_server_detail($id);


        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit Mail Server Settings";
        $this->load->view('header', $data);
        $this->load->view('mail_server_form');
        $this->load->view('footer');
    }


    //code to delete the the server setting

    public function delete_mail_server($id)
    {
        $result = $this->setting->delete_server_setting($id);
        if($result)
        {
            //code to create log
            $log['module_title']= "Mail Server";
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Server Information has been deleted.');
            redirect('mail_setting');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Server Information.');
            redirect('mail_setting');
        }
    }



    //code to add/edit admin emails

    public function admin_email_form($admin_id=0)
    {

        if($this->input->post())
        {

//            print_r($this->input->post());
//            exit;

            $mailing_type = $this->input->post('mailing_type');
            $mtype = $this->input->post('mtype');
            $admin = $this->input->post('admin');


//            print_r($mailing_type) ;
//
//            echo "<br/>";
//            print_r($mtype) ;
//
//            echo "<br/>";
//            print_r($admin) ;
//
//            echo "<br/>";
//           exit;


            $admin_id = $this->input->post('admin_id');
            $insert['full_name'] = $this->input->post('full_name');
            $insert['email'] = $this->input->post('email');
            $insert['active_status']= $this->input->post('active_status');
            $insert['delete_status'] = "0";

            if($admin_id =="")
            {
              $insert['created'] = date('Y-m-d:h:i:s');
              $result = $this->setting->insert_admin_mail($insert);
                if($result)
                {

                    //code to create log
                    $log['module_title']= "Admin Email";
                    $log['action_id']= "1";
                    $this->create_log($log);

                    //code to insert the mailing types

                    foreach($mailing_type as $pk => $value)
                    {
                        $inserts['type_id'] = $mtype[$value];
                        $inserts['admin_id'] = $result;
                        //$admin_id = $admin[$value];

                        $this->setting->insert_mailing_types($inserts);


                    }

                    $this->session->set_flashdata('success','New Admin Email Information has been inserted.');
                    redirect('mail_setting');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new admin email Information.');
                    redirect('mail_setting');
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:h:i:s');
                $result = $this->setting->update_admin_mail($insert, $admin_id);
                if($result)
                {
                    //code to create log
                    $log['module_title']= "Admin Email";
                    $log['action_id']= "2";
                    $this->create_log($log);

                    //code to insert the mailing types
                    $this->setting->delete_mailing_types($admin_id);

                    foreach($mailing_type as $pk => $value)
                    {
                        $inserts['type_id'] = $mtype[$value];
                        $inserts['admin_id'] = $admin[$value];
                        $this->setting->insert_mailing_types($inserts);

                    }

                    $this->session->set_flashdata('success','Admin Email Information has been updated.');
                    redirect('mail_setting');
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the Admin Email Information.');
                    redirect('mail_setting');
                }

            }
        }
        $data['setting'] = $this->setting->get_admin_email_detail($admin_id);

        $data['scripts'] = array('form-validator');
        $data['title']= "Add/Edit Admin Mailing Settings";
        $this->load->view('header', $data);
        $this->load->view('admin_email_form');
        $this->load->view('footer');
    }



    //code to delete admin email

    public function delete_admin_mail($admin_id)
    {
        $result = $this->setting->delete_admin_mail($admin_id);
        if($result)
        {
            //code to create log
            $log['module_title']= "Admin Email";
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Admin Mailing Information has been deleted.');
            redirect('mail_setting');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Admin Mailing  Information.');
            redirect('mail_setting');
        }
    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Email Settings";
        $this->db->insert('igc_user_logs', $insert);
    }



}