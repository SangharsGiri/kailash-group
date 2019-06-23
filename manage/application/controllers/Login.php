<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->model('login_model', 'login'); 
        $this->load->helper('security');
    }

    public function index()
    {
        is_logged_in();
        $data = array();
        $data['title'] = "Login";
        $this->load->library('form_validation');
        if ($this->input->post())
        {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
            if ($this->form_validation->run()) {
                $username =  $this->input->post('username');
                $password =  md5($this->input->post('password'));
                $admin = $this->login->check_user($username, $password);
                if(! empty($admin)) {
                    $this->session->set_userdata('username', $username);
                    $this->session->set_userdata('admin_id', $admin['user_id']);
                    $this->session->set_userdata('permission', $admin['permission']);
                    redirect('dashboard');
                }else{
                    $data['error'] = "Invalid Username / Password.";
                }
            }
        }

        $this->load->view('login.php', $data);
    }

    public function logout()
    {
        $user_id= $this->session->userdata('admin_id');
        $date = date("Y-m-d H:i:s");
        $this->login->update_info($date , $user_id);
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('permission');
        redirect();
    }
}