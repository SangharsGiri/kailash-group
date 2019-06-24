<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');

    }

    public  $table = "igc_news";
    public $field_name = "news_id";
    public  $redirect = "news";



    public function index()
    {

        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "News";
        $this->load->view('header', $data);
        $this->load->view('news_list');
        $this->load->view('footer');
    }


    public function form($id=0)
    {
        if($this->input->post())
        {
            $news_id = $this->input->post('news_id');
            $insert['news_title'] = $this->input->post('news_title');
            $insert['news_content'] = $this->input->post('news_content');
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['meta_description'] = $this->input->post('meta_description');
            $insert['meta_keywords'] = $this->input->post('meta_keywords');
            $insert['meta_title'] = $this->input->post('meta_title');
            $insert['news_url'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['news_title'])) ;
            $rand = md5(rand());
            $featuredimg=$rand. str_replace(" ","",$_FILES['featured_img']['name']);
            $featuredimgtmp=$_FILES['featured_img']['tmp_name'];
            $path = '../uploads/news/';
            $insert['delete_status'] = "0";
            if($news_id =="")
            {
                $insert['featured_img']= $featuredimg;
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert($insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['news_title'];
                    $log['action_id']= "1";
                    $this->create_log($log);

                    //code to copy image
                    move_uploaded_file($featuredimgtmp,$path.$featuredimg);
                    $this->session->set_flashdata('success','News has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add News');
                    redirect($this->redirect);
                }

            }
            else{
                $featuredimg_new = $_FILES['featured_img']['name'];

                if($featuredimg_new !="")
                {
                    $pre_featuredimg = $this->input->post('pre_featured_img');
                    @unlink($path.$pre_featuredimg);
                    move_uploaded_file($featuredimgtmp,$path,$featuredimg);
                    $insert['featured_img'] = $featuredimg;

                }

                $insert['updated'] = date('Y-m-d:H:i:s');

                $result = $this->crud->update($news_id, $this->field_name, $insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']=  $insert['news_title'];
                    $log['action_id']= "2";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','News has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the News.');
                    redirect($this->redirect);
                }

            }


        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit News";
        $this->load->view('header', $data);
        $this->load->view('news_form');
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
            $log['module_title']=  $detail['news_title'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','News has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the News.');
            redirect($this->redirect);
        }

    }


//function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "News";
        $this->db->insert('igc_user_logs', $insert);
    }



}

