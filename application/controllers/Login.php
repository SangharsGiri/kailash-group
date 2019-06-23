<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller{
    public function __Construct()
    {
        parent::__Construct();

        $this->load->model('login_model', 'login');
        $this->load->model('crud_model', 'crud');
        $this->load->library('encrypt');

    }


    public function index()
    {

        $this->load->library('form_validation');
        if($this->input->post())
        {


            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[pass_confirmation]');
            $this->form_validation->set_rules('pass_confirmation', 'Password Confirmation', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_user_exist['.$this->input->post('password').']');

            if ($this->form_validation->run()) {

                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));
                    $customer = $this->login->check_user($email, $password);

                    if ($customer) {
                        $this->session->set_userdata('email', $email);
                        $this->session->set_userdata('customer_id', $customer['customer_id']);
                            redirect('home');
                        } else {

                            $this->session->set_flashdata('error', 'Unable to maintain session .Please try again Later.');
                            redirect('login');
                        }
                    }





        }


        //code to load extra script in header
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['partners'] = $this->crud->get_partners_records('global_partner');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        $data['scripts'] = array('themes/js/form-validator/jquery.form-validator');
        $data['sub_title'] =  "Login"." ";
        $this->load->view('header', $data);
        $this->load->view('user/login');
        $this->load->view('footer');

    }
    
    public function check_user_exist($str, $password)
    {

        $user = $this->login->check_user($str, md5($password));
        if(! empty($user))
        {
           return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_user_exist', 'Invalid Email and Password.');
            return FALSE;
        }
        
    }


    public function register()
    {
        $this->load->library('form_validation');
        if($this->input->post()) {

            $this->form_validation->set_rules('customer_title', 'Title', 'trim|required');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_user_already_exist');

            if ($this->form_validation->run()) {


//            print_r($this->input->post());
//            exit;
                $insert['customer_title'] = $this->input->post('customer_title');
                $insert['first_name'] = $this->input->post('first_name');
                $insert['middle_name'] = $this->input->post('middle_name');
                $insert['last_name'] = $this->input->post('last_name');
                $insert['email'] = $this->input->post('email');
                $insert['country'] = $this->input->post('country');
                $insert['contact_no'] = $this->input->post('contact_number');
                $insert['city'] = $this->input->post('city');
                $insert['activation_code'] = md5(rand());
                $insert['password'] = md5($this->input->post('password'));
                $insert['created'] = date('Y-m-d:H:i:s');
                $insert['customer_type'] = 'register';
                $insert['active_status']='N';

                if($this->send_account_activation_mail( $insert['email'],  $insert['activation_code']) == "TRUE")
                {
                    $result = $this->crud->insert($insert,'igc_site_users');

                    if ($result) {
                        $this->session->set_flashdata('success', "Registration Successful.Please check your mail to activate your account.");
                        redirect('login/register');
                    } else {
                        $this->session->set_flashdata('error', "Internal Server Error.Please try again Later.");
                        redirect('login/register');
                    }
                }
                else{

                    $data['error'] = "Error in sending email .Please try again Later.";


                }



                }

            
        }
        //code to load extra script in header
        $data['site_settings'] = $this->crud->get_site_settings('igc_site_settings');
        $data['partners'] = $this->crud->get_partners_records('global_partner');
        $data['logo'] = $this->crud->get_logo('igc_logo');
        $data['scripts'] = array('themes/js/form-validator/jquery.form-validator');
        $data['sub_title'] =  "Register"." ";
        $this->load->view('header', $data);
        $this->load->view('user/register', $data);
        $this->load->view('footer');
    }

    public function check_user_already_exist($str)
    {

        $user = $this->login->check_email_exist($str);

        if(empty($user))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_user_already_exist', 'You are already register in our system.');
            return FALSE;
        }

    }


    //function to send account activation email

    public function send_account_activation_mail($email, $md5)
    {
        $this->load->library('encrypt');

        $site_settings = $this->crud->get_site_settingss();
        $server = $this->crud->get_mail_info();

        $password = $this->encrypt->decode($server['password']);

        $server_url = base_url().'index.php/login/account_activation/'.$md5;

        $this->load->library('mailer');

        $mail  = new PHPMailer();

        $body = '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>'. $site_settings['site_name']. 'Account Activation</title>
</head>

<body>
<div style="width:580px;margin:0 auto;font:12px Arial,Helvetica,sans-serif;background:#fff">
  <div style="margin:0 0 10px"> <img alt="Incentive Holidays" src="'.base_url().'/themes/images/logos/navbar-logo.png"> </div>


    <table width="100%" cellspacing="0" cellpadding="5" border="0">

        <tbody>

         <tr>
           <p>
          In order to activate your account. please click the  Link. '.'<a href="'.$server_url.'">'.$server_url.'</a>'.'</p>
        </tr>

        <tr>
            <td colspan="2" style="background:#EEE; text-align:left;">Thanks and Regards,<br />
                Incentive Holidays Team<br />
                 Tel:<strong>+977-01-4437892</strong><br />
                <a href="https://www.incentiveholidays.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.incentiveholdiays.com</a></td>
        </tr>
        


        </tbody>
    </table>
</div>
</body>
</html>' ;




        if($server['smtp_connect'] == "true")
        {
            $mail->IsSMTP(); // telling the class to use SMTP
        }
        // $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)

        $mail->SMTPAuth   = true;                  // enable SMTP authentication

        $mail->SMTPSecure = $server['server_prefix'];                 // sets the prefix to the servier

        $mail->Host       =  $server['host'];      // sets GMAIL as the SMTP server

        $mail->Port       = $server['port'];                  // set the SMTP port for the GMAIL server

        $mail->Username   = $server['username'];  // GMAIL username

        $mail->Password   = $password;          // GMAIL password

        $mail->SetFrom($server['send_from_email'], $server['send_from_name']);

        $mail->AddReplyTo($server['reply_to_email'],$server['reply_to_name']);

        $mail->Subject    = $site_settings['site_name']." Account Activation";


        $mail->MsgHTML($body);



        $mail->AddAddress($email, $server['send_from_name']);



      if(! $mail->Send())
       {
           return FALSE;

      }
        else
        {

            return TRUE;

        }

    }


    //function to activate account

    public function account_activation($code)
    {
        $detail =  $this->login->get_activation_detail($code);
        if(!empty($detail))
        {
         $update['active_status'] =  "Y";
            $update['updated']= date('Y-m-d:H:i:s');
           $result =  $this->crud->update($code,'activation_code', $update, 'igc_site_users');
            if($result)
            {
                $this->session->set_flashdata('success','Your account has been activated successfully.');
                redirect('login');
            }
            else{
                $this->session->set_flashdata('error','Unable to activate your account.');
                redirect('login');
            }
        }
        else{
            redirect('home');
        }
    }


//password reset section



    public function password_rest()
    {
        $this->load->library('form_validation');

        if($this->input->post()) {

            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_check_register_user_exist');

            if ($this->form_validation->run()) {

                $email =  $this->input->post('user_email');
                $update['activation_code'] =  md5(rand());
                if($this->send_password_reset_mail($email, $update['activation_code']) == "TRUE")
                {
                    $result =  $this->login->update_activation($email, $update);
                    if($result)
                    {
                        $this->session->set_flashdata('success', "Password Reset link has been send.");
                        redirect('login');
                    }
                    else{
                        $this->session->set_flashdata('success', "Unable to send reset link.Please try again later.");
                        redirect('login');
                    }
                    

                }
                else{
                    $data['error'] = "Error in sending email .Please try again Later.";
                }



            }

        }

        $data['scripts'] = array('themes/js/form-validator/jquery.form-validator');
        $data['sub_title'] =  "Login"." "."-"." ";
        $this->load->view('header', $data);
        $this->load->view('user/login', $data);
        $this->load->view('footer');

    }


    public function check_register_user_exist($str)
    {

        $user = $this->login->check_email_exist($str);

        if(empty($user))
        {
            $this->form_validation->set_message('check_register_user_exist', 'User not exist.');
            return FALSE;

        }
        else
        {
            return TRUE;
        }

    }




    //function to send account activation email

    public function send_password_reset_mail($email, $md5)
    {
        $this->load->library('encrypt');

        $site_settings = $this->site_settings_model->get_site_settings();
        $server = $this->crud->get_mail_info();

        $password = $this->encrypt->decode($server['password']);

        $server_url = base_url().'index.php/login/password_reset_link/'.$md5;

        $this->load->library('mailer');

        $mail  = new PHPMailer();

        $body = '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>'. $site_settings['site_name']. 'Password Reset</title>
</head>

<body>
<div style="width:580px;margin:0 auto;font:12px Arial,Helvetica,sans-serif;background:#fff">
  <div style="margin:0 0 10px"> <img alt="Incentive Holidays" src="'.base_url().'/themes/images/logos/navbar-logo.png"> </div>


    <table width="100%" cellspacing="0" cellpadding="5" border="0">

        <tbody>

         <tr>
           <p>
          In order to reset your password. please click the  Link. '.'<a href="'.$server_url.'">'.$server_url.'</a>'.'</p>
        </tr>

        <tr>
            <td colspan="2" style="background:#EEE; text-align:left;">Thanks and Regards,<br />
                Incentive Holidays Team<br />
                 Tel:<strong>+977-1-4437892</strong><br />
                <a href="https://www.incentiveholidays.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.incentiveholdiays.com</a></td>
        </tr>
        

        </tbody>
    </table>
</div>
</body>
</html>' ;




        if($server['smtp_connect'] == "true")
        {
            $mail->IsSMTP(); // telling the class to use SMTP
        }
        // $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)

        $mail->SMTPAuth   = true;                  // enable SMTP authentication

        $mail->SMTPSecure = $server['server_prefix'];                 // sets the prefix to the servier

        $mail->Host       =  $server['host'];      // sets GMAIL as the SMTP server

        $mail->Port       = $server['port'];                  // set the SMTP port for the GMAIL server

        $mail->Username   = $server['username'];  // GMAIL username

        $mail->Password   = $password;          // GMAIL password

        $mail->SetFrom($server['send_from_email'], $server['send_from_name']);

        $mail->AddReplyTo($server['reply_to_email'],$server['reply_to_name']);

        $mail->Subject    = $site_settings['site_name']." Password Reset";


        $mail->MsgHTML($body);



        $mail->AddAddress($email, $server['send_from_name']);



        if(! $mail->Send())
        {
            return FALSE;

        }
        else
        {

            return TRUE;

        }

    }



    public function password_reset_link($hash)
    {
        $detail = $this->crud->get_detail($hash, 'activation_code', 'igc_site_users');
        if(! empty($detail))
        {

            $this->load->library('form_validation');

            if($this->input->post()) {
                $this->form_validation->set_rules('activation_code', 'Activation Code', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required');

                if ($this->form_validation->run()) {


                    $code = $this->input->post('activation_code');
                    $update['active_status'] = "Y";
                    $update['password'] = md5($this->input->post('password'));

                    $result = $this->crud->update($code, 'activation_code', $update, 'igc_site_users');
                    if ($result) {
                        $updates['activation_code'] = md5(rand());
                        $this->crud->update($code, 'activation_code', $updates, 'igc_site_users');
                        $this->session->set_flashdata('success', "Your Password has been updated.");
                        redirect('login');
                    } else {
                        $this->session->set_flashdata('success', "Unable to update your password.Please try again later.");
                        redirect('login');
                    }



                }
            }

            $data['scripts'] = array('themes/js/form-validator/jquery.form-validator');
            $data['sub_title'] = "Password Reset" . " " . " ";
            $data['activation_code'] = $hash;
            $this->load->view('header', $data);
            $this->load->view('user/password_reset', $data);
            $this->load->view('footer');
        }
        else{
        redirect('home');
        }
    }




 

    public function logout()
    {
        $customer_id =  $this->session->userdata('customer_id');
        $update['last_login'] = date('Y-m-d:H:i:s');
        $this->crud->update($customer_id,'customer_id', $update,'igc_site_users');
        $this->session->sess_destroy();
        redirect('home');
    }
}