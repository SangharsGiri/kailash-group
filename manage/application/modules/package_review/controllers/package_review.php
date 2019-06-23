<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package_review extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('package_review_model','review');
        $this->load->model('crud_model','crud');

    }

    public  $table = "igc_review";
    public $field_name = "review_id";
    public  $redirect = "package_review";

    public function index()
    {
        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Package Review List";
        $this->load->view('header', $data);
        $this->load->view('review_list');
        $this->load->view('footer');
    }

    //code to add/edit

    public function form($id=0)
    {
        if($this->input->post())
        {
            $review_id = $this->input->post('review_id');
            $insert['review_title'] = $this->input->post('review_title');
            $insert['review_url'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['review_title'])) ;
            $insert['review_by'] = $this->input->post('review_by');
            $insert['review_text'] = $this->input->post('review_text');
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['delete_status'] = "0";
            if($review_id =="")
            {
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert($insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']= $insert['review_title'];
                    $log['action_id']= "1";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','New Review has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add Review.');
                    redirect($this->redirect);
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:H:i:s');

                $result = $this->crud->update($review_id, $this->field_name, $insert, $this->table);
                if($result)
                {

                   //code to create log
                    $log['module_title']= $insert['review_title'];
                    $log['action_id']= "2";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','Review has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the review.');
                    redirect($this->redirect);
                }

            }


        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit Package Review";
        $this->load->view('header', $data);
        $this->load->view('review_form');
        $this->load->view('footer');
    }


    public function link($review_id)
    {

        if($this->input->post())
        {

            $package_id = $this->input->post('package_id');
            $review_id  = $this->input->post('review_id');

            $remove = $this->crud->delete($review_id,'review_id','igc_package_review');

            if($remove)
            {
                $insert['package_id'] = $package_id;
                $insert['review_id'] = $review_id;

                if(  $insert['package_id'] !="") {


                    $result = $this->crud->insert($insert, 'igc_package_review');

                    if ($result) {

                        $this->session->set_flashdata('success', 'Related Packages has been added.');
                        redirect($this->redirect);
                    } else {
                        $this->session->set_flashdata('error', 'Unable to add related packages.');
                        redirect($this->redirect);
                    }
                }
            }

            else{
                $this->session->set_flashdata('error','Unable to add related packages.');
                redirect($this->redirect);
            }


        }

        $data['records'] = $this->crud->get_not_deleted('igc_package');
        $data['review_id']= $review_id;
        $data['title']= "Add/Edit Package Review";
        $this->load->view('header', $data);
        $this->load->view('review_related');
        $this->load->view('footer');
    }

    //function to delete

    public function delete($review_id)
    {
        $detail = $this->crud->get_detail($review_id,  $this->field_name, $this->table);
        $this->crud->delete($review_id, $this->field_name,'igc_package_review');
        $result = $this->crud->soft_delete($review_id, $this->field_name, $this->table);
        if($result)
        {
            //code to create log
            $log['module_title']= $detail['review_title'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Package Review has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Package Review.');
            redirect($this->redirect);
        }

    }


    //function to create log for package

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Package Review";
        $this->db->insert('igc_user_logs', $insert);
    }

}

