<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_settings extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

         $this->load->model('site_settings_model','setting');
    }

    public function index()
    {

        $data['setting'] = $this->setting->get_site_settings();

        $data['title']= "Site Settings";
        $this->load->view('header', $data);
        $this->load->view('site_settings');
        $this->load->view('footer');
    }


    public function site_form()
    {

        $id= $this->input->post('id');
        //$insert['site_name'] = $this->input->post('site_name');
       
        //$insert['site_url'] = $this->input->post('site_url');
        $insert['contact_number'] = $this->input->post('contact_number');
        $insert['feedback_email'] = $this->input->post('feedback_email');
        $insert['skype'] = $this->input->post('skype');
        //$insert['time_hour'] = $this->input->post('time_hour');
        $insert['contact_address'] = $this->input->post('contact_address');
        $insert['facebook_link'] = $this->input->post('facebook_link');
        $insert['twiter_link'] = $this->input->post('twiter_link');
        $insert['youtube_link'] = $this->input->post('youtube_link');
        $insert['google_plus_link'] = $this->input->post('google_plus_link');
        $insert['linked_in'] = $this->input->post('linked_in');
        $insert['instagram'] = $this->input->post('instagram');
        //$insert['location_map'] = $this->input->post('location_map');
        $insert['slogan'] = $this->input->post('slogan');
        $insert['meta_title'] = $this->input->post('meta_title');
        $insert['meta_description'] = $this->input->post('meta_description');
        $insert['meta_keywords'] = $this->input->post('meta_keywords');
        //$insert['home_title'] = $this->input->post('home_title');
        //$insert['home_description'] = $this->input->post('home_description');

        //$insert['copyright'] = $this->input->post('copyright');
       // $insert['powered_by'] = $this->input->post('powered_by');

        // $insert['service_title_one'] = $this->input->post('service_title_one');
        // $insert['service_description_one'] = $this->input->post('service_description_one');
        // $insert['service_title_two'] = $this->input->post('service_title_two');
        // $insert['service_description_two'] = $this->input->post('service_description_two');
        // $insert['service_title_three'] = $this->input->post('service_title_three');
        // $insert['service_description_three'] = $this->input->post('service_description_three');
        // $insert['service_title_five'] = $this->input->post('service_title_five');
        // $insert['service_description_five'] = $this->input->post('service_description_five');

        // $insert['login_title'] = $this->input->post('login_title');
        // $insert['login_message'] = $this->input->post('login_message');
        // $insert['registration_title'] = $this->input->post('registration_title');
        // $insert['registration_message'] = $this->input->post('registration_message');

        // $insert['subscription_title'] = $this->input->post('subscription_title');
        // $insert['subscription'] = $this->input->post('subscription');
        
        // $insert['counter_one'] = $this->input->post('counter_one');
        // $insert['counter_one_description'] = $this->input->post('counter_one_description');
        // $insert['counter_two'] = $this->input->post('counter_two');
        // $insert['counter_two_description'] = $this->input->post('counter_two_description');
        // $insert['counter_three'] = $this->input->post('counter_three');
        // $insert['counter_three_description'] = $this->input->post('counter_three_description');
        // $insert['counter_four'] = $this->input->post('counter_four');
        // $insert['counter_four_description'] = $this->input->post('counter_four_description');

        if($id !="")
        {
          $result = $this->setting->update_site_settings($insert, $id);
          if($result)
          {
              $this->session->set_flashdata('success', 'Site Information has been Updated.');
              redirect('site_settings');
          }
            else{
                $this->session->set_flashdata('error', 'Unable to Update Site Information.');
                redirect('site_settings');
            }

        }
        else{
            $result = $this->setting->insert_site_settings($insert);
            if($result)
            {
                $this->session->set_flashdata('success', 'Site Information has been inserted.');
                redirect('site_settings');
            }
            else{
                $this->session->set_flashdata('error', 'Unable to insert Site Information.');
                redirect('site_settings');
            }

        }

    }



}
?>