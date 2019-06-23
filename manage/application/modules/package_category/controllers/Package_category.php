<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package_category extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('category_model','category');
        $this->load->model('crud_model','crud');

    }

    public  $redirect = "package_category";

    public function index()
    {

        $data['categories'] = $this->crud->get_all('igc_package_category');
        $data['title']= "Package Category List";
        $this->load->view('header', $data);
        $this->load->view('category_list');
        $this->load->view('footer');
    }

    //code to add/edit category

    public function category($id=0)
    {
        if($this->input->post())
        {


            $folder_path = '../uploads/package_category/';
            $category_id = $this->input->post('category_id');
            $insert['category_name'] = $this->input->post('category_name');
            $insert['description'] = $this->input->post('description');
            // $insert['category_code'] = $this->input->post('category_code');
             
            $insert['meta_keywords'] = $this->input->post('meta_keywords');
            $insert['meta_description'] = $this->input->post('meta_description');
             $insert['meta_title'] = $this->input->post('meta_title');
            $url= strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['category_name'])) ;
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['show_mobile'] = $this->input->post('show_mobile');
            $rand = md5(rand());
            $featuredimg= $rand.str_replace(" ","",$_FILES['featured_img']['name']);
            $featuredimgtmp=$_FILES['featured_img']['tmp_name'];

            $insert['delete_status'] = "0";

            //code to check url

            $check_url =  $this->crud->check_url($category_id, 'category_id', $url, 'category_url','igc_package_category');
            if(!empty($check_url))
            {
                $insert['category_url']= $url."-".rand(1, 50);
            }
            else
            {
                $insert['category_url'] = $url;
            }
		

            if($category_id == "")
            {
                $insert['parent_id']= "0";
                $insert['group_id']= "1";
                $insert['position']= "0";
                $insert['created'] = date('Y-m-d:H:i:s');
                $insert['show_front'] = "0";
                if($_FILES['featured_img']['name'] !="")
                {
                    $insert['featured_img']= $featuredimg;

                    move_uploaded_file($featuredimgtmp,$folder_path.$featuredimg);

                }
                $result = $this->crud->insert($insert, 'igc_package_category');
                if($result)
                {
                    //code to create log
                    $log['module_title']= $insert['category_name'];
                    $log['action_id']= "1";
                    $this->category_create_log($log);

                    $this->session->set_flashdata('success','Package category Information has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add the package category Information.');
                    redirect($this->redirect);
                }

            }
        else{

            $insert['updated'] = date('Y-m-d:H:i:s');
            if($_FILES['featured_img']['name'] !="")
            {
                $pre_featured_img = $this->input->post('pre_featuredimg');

                @unlink($folder_path.$pre_featured_img);

                $insert['featured_img']= $featuredimg;

                move_uploaded_file($featuredimgtmp,$folder_path.$featuredimg);

            }




            $result = $this->crud->update($category_id, 'category_id', $insert, 'igc_package_category');
            if($result)
            {
                //code to create log
                $log['module_title']= $insert['category_name'];
                $log['action_id']= "2";
                $this->category_create_log($log);
                $this->session->set_flashdata('success','Package Category Information has been updated.');
                redirect($this->redirect);
            }
            else{
                $this->session->set_flashdata('error','Unable to update the package category Information.');
                redirect($this->redirect);
            }

        }


        }
        $data['setting'] = $this->crud->get_detail($id,'category_id','igc_package_category');
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit Package Category";
        $this->load->view('header', $data);
        $this->load->view('category_form');
        $this->load->view('footer');
    }




    //function to delete category

    public function delete_category($category_id)
    {
        $detail = $this->crud->get_detail($category_id, 'category_id', 'igc_package_category');
        $this->crud->delete($category_id,'category_id', 'igc_category_packages');
        $result = $this->crud->delete($category_id,'category_id','igc_package_category');
        if($result)
        {
            $folder_path = '../uploads/package_category/';
            unlink($folder_path.$detail['featured_img']);
            //code to create log
            $log['module_title']= $detail['category_name'];
            $log['action_id']= "3";
            $this->category_create_log($log);
            $this->session->set_flashdata('success','Package Category has been deleted.');
            redirect('package_category');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Package Category.');
            redirect('package_category');
        }

    }




    //function related packages

    public function related_packages($category_id)
    {

        if($this->input->post())
        {
//            print_r($this->input->post());
//            exit;

            $packages = $this->input->post('packages');
            $category_id  = $this->input->post('category_id');

            $detail = $this->crud->get_detail($category_id, 'category_id', 'igc_package_category');

            $remove = $this->category->remove_related_packages($category_id);

            if($remove) {
                if (!empty($packages)) {


                foreach ($packages as $pk => $value) {
                    $insert['package_id'] = $value;
                    $insert['category_id'] = $category_id;
                    $result = $this->category->insert_related_packages($insert);
                }

                if ($result) {
                    //code to create log
                    $log['module_title'] = $detail['category_name'];
                    $log['action_id'] = "2";
                    $this->category_create_log($log);

                    $this->session->set_flashdata('success', 'Related Packages has been added.');
                    redirect('package_category');
                } else {
                    $this->session->set_flashdata('error', 'Unable to add related packages.');
                    redirect('package_category');
                }
            }
            }

            else{
                $this->session->set_flashdata('error','Unable to add related packages.');
                redirect('package_category');
            }


        }
        $data['packages'] = $this->category->get_all_packages();


        $data['category_id'] = $category_id;

        $data['title']= "Add/Edit Related Packages";
        $this->load->view('header', $data);
        $this->load->view('related_package');
        $this->load->view('footer');
    }

    //show package category in front

    public function show_front()
    {
        $active_id =  $this->input->post('active_id');
        $inactive_id =  $this->input->post('inactive_id');

        if($active_id !="")
        {
            $update['show_front']= "1";
            $this->crud->update($active_id, "category_id",$update,"igc_package_category");
        }
        elseif($inactive_id !="")
        {
            $update['show_front']= "0";
            $this->crud->update($inactive_id, "category_id",$update,"igc_package_category");
        }
        else{

        }



    }

   
    //function to create log

    public function category_create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Package Category";
        $this->db->insert('igc_user_logs', $insert);
    }



}

