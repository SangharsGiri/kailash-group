<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->library('form_validation');
        $this->load->model('package_model','package');
        $this->load->model('crud_model', 'crud');

    }

    public function  index()
    {
        $data['records'] = $this->package->get_package_list();
        $data['title']= "Package List";
        $this->load->view('header', $data);
        $this->load->view('package_list');
        $this->load->view('footer');
    }

    public function form($id= 0)
    {
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->library('form_validation');

        if($this->input->post())
        {

//            print_r($this->input->post());
//            exit;
            $this->form_validation->set_rules('tourcode', 'tourcode','required' );
            $this->form_validation->set_rules('package_name', 'package_name', 'required');
            $this->form_validation->set_rules('package_duration', 'package_duration');
            $this->form_validation->set_rules('rating', 'rating');
            $this->form_validation->set_rules('description', 'description');
            $this->form_validation->set_rules('summary', 'summary');
            $this->form_validation->set_rules('pprice', 'pprice');
            $this->form_validation->set_rules('meta_description', 'meta_description');
            $this->form_validation->set_rules('meta_keywords', 'meta_keywords');
            $this->form_validation->set_rules('meta_title', 'meta_title');
            $this->form_validation->set_rules('publish_status', 'publish_status');
            $this->form_validation->set_rules('show_front', 'show_front');
            $this->form_validation->set_rules('show_mobile', 'show_mobile');
            $this->form_validation->set_rules('tab1', 'tab1');
            $this->form_validation->set_rules('description1', 'description1');
            $this->form_validation->set_rules('tab2', 'tab2');
            $this->form_validation->set_rules('description2', 'description2');
            $this->form_validation->set_rules('tab3', 'tab3');
            $this->form_validation->set_rules('description3', 'description');
            $this->form_validation->set_rules('tab4', 'tab');
            $this->form_validation->set_rules('description4', 'description4');
            $this->form_validation->set_rules('tab5', 'tab5');
            $this->form_validation->set_rules('description5', 'description5');

            if ($this->form_validation->run()) {

            $new_tags = $this->input->post('package_tags');
            $package_id = $this->input->post('package_id');
            $insert['tourcode']=  strtoupper($this->input->post('tourcode'));
            $insert['package_name'] = $this->input->post('package_name');
            $insert['package_url'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['package_name'])) ;
            $insert['package_duration'] = $this->input->post('package_duration');
            $insert['rating']= $this->input->post('rating');
            $insert['price']= $this->input->post('price');
            $insert['discount_price']= $this->input->post('discount_price');
            $insert['summary'] = $this->input->post('summary');
            $insert['description']= $this->input->post('description');
            $insert['tab1'] = $this->input->post('tab1');
            $insert['description1']= $this->input->post('description1');
            $insert['tab2'] = $this->input->post('tab2');
            $insert['description2']= $this->input->post('description2');
            $insert['tab3'] = $this->input->post('tab3');
            $insert['description3']= $this->input->post('description3');
            $insert['tab4'] = $this->input->post('tab4');
            $insert['description4']= $this->input->post('description4');
            $insert['tab5'] = $this->input->post('tab5');
            $insert['description5']= $this->input->post('description5');
            $insert['status'] = $this->input->post('is_active');
            $insert['show_mobile'] = $this->input->post('show_mobile');
            $insert['meta_description'] = $this->input->post('meta_description');
            $insert['meta_keywords'] = $this->input->post('meta_keywords');
            $insert['meta_title'] = $this->input->post('meta_title');
            $is_front = $this->input->post('is_front');
            $pprice = $this->input->post('pprice');
            $accommodation_id = $this->input->post('accommodation_id');
            $currency_id = $this->input->post('currency_id');

            //code to check url

            // $check_url =  $this->crud->check_url($package_id, 'package_id', $url, 'package_url','igc_package');
            // if(!empty($check_url))
            // {
            //     $insert['package_url']= $url."-".rand(1, 50);
            // }
            // else
            // {
            //     $insert['package_url'] = $url;
            // }


            $rand = md5(rand());
            $pdfup=$rand. str_replace(" ","",$_FILES['pdfup']['name']);
            $pdfuptmp=$_FILES['pdfup']['tmp_name'];


            $featuredimg=$rand. str_replace(" ","",$_FILES['featuredimg']['name']);
            $featuredimgtmp=$_FILES['featuredimg']['tmp_name'];


            $packageimg=$rand. str_replace(" ","",$_FILES['packageimg']['name']);
            $packageimgtmp=$_FILES['packageimg']['tmp_name'];



            if($package_id == "0")
            {



                if($_FILES['featuredimg']['name'] !="")
                {
                    $insert['featuredimg']= $featuredimg;
                }
                if($_FILES['packageimg']['name'] !="")
                {
                    $insert['packageimg']= $packageimg;
                }
                if($_FILES['pdfup']['name'] !="")
                {
                    $insert['pdfup']= $pdfup;
                }


                $insert['delete_status'] = "0";
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->package->insert_package($insert);
                $package_id = $this->db->insert_id();

                if($result)
                {
                    //code to add tags
                    $this->add_tags($result, $new_tags);

                    //code for creating log
                    $log['module_title'] = $insert['package_name'];
                    $log['action_id'] = "1";
                    $this->create_package_log($log);

                    //code to upload package files
                    $folder_path = '../uploads/package/';
                    $DIR = mkdir($folder_path . $result, 0777, true);

                    if(isset($DIR))
                    {
                        $new_path = $folder_path.$result."/";

                        move_uploaded_file($pdfuptmp,$new_path.$pdfup);
                        move_uploaded_file($featuredimgtmp,$new_path.$featuredimg);
                        move_uploaded_file($packageimgtmp,$new_path.$packageimg);
                    }

                    else{
                        $new_path = $folder_path.$result."/";

                        move_uploaded_file($pdfuptmp,$new_path.$pdfup);
                        move_uploaded_file($featuredimgtmp,$new_path.$featuredimg);
                        move_uploaded_file($packageimgtmp,$new_path.$packageimg);
                    }


                    if(!empty($pprice))
                    {

                    foreach($pprice as $row =>$value) {
                        $inserts['package_id'] = $result;
                        $inserts['accommodation_id'] = $accommodation_id[$row];
                        $inserts['currency_id'] = $currency_id[$row];
                        $inserts['pprice'] = $value;
                        $inserts['is_front'] = ($is_front == $row) ? 'Y' : 'N';

                        if($inserts['pprice'] !="" || $inserts['pprice'] !="0")
                        {
                            $this->package->insert_package_price($inserts);
                        }



                    }
                    }

                    
                    // print_r($package_id);
                    // exit();
                    if (!empty($_POST['category_id'])) {
                        foreach ($_POST['category_id'] as $key => $cat_id) {
                            $category_package = array(
                                
                                'category_id' => $cat_id,
                                'package_id'     => $package_id,
                            );
                            $this->db->insert('igc_category_packages', $category_package);
                        }
                    }
                    if($result)
                    {
                        $this->session->set_flashdata('success','New Package is Added Successfully');
                        redirect('package');
                    }
                    else{
                        $this->session->set_flashdata('error','Unable to Add Package');
                        redirect('package');
                    }

                }
            }

            else{

                $featuredimg_new = $_FILES['featuredimg']['name'];
                $packageimg_new = $_FILES['packageimg']['name'];
                $pdfup_new = $_FILES['pdfup']['name'];

                $detail = $this->package->get_package_detail($package_id);
                $folder_path = '../uploads/package/'.$package_id;

                if(! is_dir($folder_path))
                {
                    mkdir($folder_path, 0777, true);
                }
                $new_path = $folder_path."/";


                if($featuredimg_new !="")
                {


                    $filename = $detail['featuredimg'];
                    @unlink($new_path.$filename);
                    move_uploaded_file($featuredimgtmp,$new_path.$featuredimg);
                    $insert['featuredimg']= $featuredimg;
                }
                if($packageimg_new !="")
                {

                    $filename1 = $detail['packageimg'];
                    @unlink($new_path.$filename1);
                    move_uploaded_file($packageimgtmp,$new_path.$packageimg);
                    $insert['packageimg']= $packageimg;
                }
                if($pdfup_new !="")
                {

                    $filename2 = $detail['pdfup'];
                    @unlink($new_path.$filename2);
                    move_uploaded_file($pdfuptmp,$new_path.$pdfup);

                    $insert['pdfup']= $pdfup;
                }

                $results = $this->package->update_package($insert, $package_id);

                    if (!empty($_POST['category_id'])) {
                        $this->db->where('package_id', $package_id);
                        $this->db->where_not_in('category_id', $_POST['category_id']);
                        $this->db->delete('igc_category_packages');
                        foreach ($_POST['category_id'] as $key => $cat_id) {
                            if ($this->db->where(array('package_id' => $package_id, 'category_id' => $cat_id))->get('igc_category_packages', 1)->num_rows() < 1) {
                                $category_package = array(
                                    'package_id'     => $package_id,
                                    'category_id' => $cat_id,
                                );
                                $this->db->insert('igc_category_packages', $category_package);
                            }
                        }
                    }

                if($results)
                {
                    //code to create package log

                    $log['module_title'] =  $insert['package_name'];
                    $log['action_id'] = "2";
                    $this->create_package_log($log);

                    //code to add tags
                    $this->add_tags($package_id, $new_tags);

                    $deletes = $this->package->delete_package_price($package_id);
                    if($deletes)
                    {
                        if(!empty($pprice)) {

                            foreach ($pprice as $row => $value) {
                                $inserts['package_id'] = $package_id;
                                $inserts['accommodation_id'] = $accommodation_id[$row];
                                $inserts['currency_id'] = $currency_id[$row];
                                $inserts['pprice'] = $value;
                                $inserts['is_front'] = ($is_front == $row) ? 'Y' : 'N';
                                if($inserts['pprice'] !="")
                                {
                                    $this->package->insert_package_price($inserts);
                                }

                            }
                        }
                    }



                    $this->session->set_flashdata('success','Package is Updated Successfully');
                    redirect('package');
                }
                else{
                    $this->session->set_flashdata('error','Unable to Update Package');
                    redirect('package');
                }

            }

        }
    }


        $data['package'] = $this->package->get_package_detail($id);

        $data['package_categories'] = $this->package->get_active_package_category();
        
        $data['current_categories'] = $this->package->get_current_categories($id);

        $data['package_price'] = $this->package->get_package_price($id);

        ///print_r($data['package_price']);
        //exit;


       $data['package_id'] = $id;


        $data['scripts'] = array('themes/js/form-validator');

        $data['title'] = "Add/Edit Package";
        $this->load->view('header', $data);

            $this->load->view('package_form');


        $this->load->view('footer');

    }

    public function check_name_exist($str, $package_id)
    {
        $string = str_replace(" ","-",$str);
        $name = $this->package->check_name_exist($string, $package_id);
       
        if(empty($name))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_name_exist', 'Package name already exist.');
            return FALSE;
        }

    }

    //function to delete package

    public function delete_package($package_id)
    {
        $package = $this->package->get_package_detail($package_id);

        $result = $this->package->delete_package($package_id);
        if($result)
        {
            $log['module_title'] =  $package['package_name'];
            $log['action_id'] = "3";
            $this->create_package_log($log);

            $path = '../uploads/package/'.$package_id.'/';
            $recycle_path = '../recycle-bin/package/';
            $featuredimg = $package['featuredimg'];
            $packageimg  = $package['packageimg'];
            $pdfup = $package['pdfup'];
            @copy($path.$featuredimg , $recycle_path.$featuredimg);
            @unlink($path.$featuredimg);

            @copy($path.$packageimg , $recycle_path.$packageimg);
            @unlink($path.$packageimg);

            @copy($path.$pdfup , $recycle_path.$pdfup);
            @unlink($path.$pdfup);



            $folder_path = '../uploads/package/'.$package_id;


            rmdir($folder_path);


            $this->session->set_flashdata('success','Package deleted Successfully');
            redirect('package');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete Package');
            redirect('package');
        }

    }



    //show package in front

    public function show_front()
    {
        $active_id =  $this->input->post('active_id');
        $inactive_id =  $this->input->post('inactive_id');

        if($active_id !="")
        {
            $update['show_front']= "1";
            $this->crud->update($active_id, "package_id",$update,"igc_package");
        }
        elseif($inactive_id !="")
        {
            $update['show_front']= "0";
            $this->crud->update($inactive_id, "package_id",$update,"igc_package");
        }
        else{

        }



    }


    //function to create log for package

    public function create_package_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Package";


        $this->db->insert('igc_user_logs', $insert);
    }


    //code to add new tags in package

    public function add_tags($package_id, $tags)
    {
        if ($tags != '') {
            $tagIn = trim(preg_replace('/\s+/', ',', $tags));
            $tags = explode(',', $tagIn);

            $this->package->insert_tags($tags, $package_id);
        }

    }

    public function rmv_package_tag()
    {
        if($this->input->post())
        {
            $term_id = $this->input->post('term_id');
            $package_id = $this->input->post('package_id');

            $this->db->where('package_id', $package_id);
            $this->db->where('term_id', $term_id);
            $this->db->delete('igc_package_tags');


            echo "success";


        }
    }

    public function check_tour_code()
    {
        if($this->input->post())
        {
            $code = $this->input->post('code');
            $package_id = $this->input->post('package_id');

            $query = $this->db->query("select * from igc_package where tourcode = '$code' and delete_status = '0' and package_id <> '$package_id'");

            $result = $query->result_array();

            if(! empty($result))
            {
                echo "error";
            }
            else{
                echo "success";
            }

        }
    }



    public function gallery($package_id)
    {

        if($this->input->post())
        {
            $id = $this->input->post('package_id');
            $package_album = $this->input->post('package_album');
            $delete = $this->crud->delete($id, 'package_id', 'igc_package_album');
            if($delete)
            {
                foreach($package_album as $pk => $value)
                {
                    $insert['package_id']= $id;
                    $insert['album_id'] = $value;
                    $result = $this->crud->insert($insert, 'igc_package_album');
                }
            }

            if($result)
            {
                $this->session->set_flashdata('success','Package Gallery has been Updated.');
                redirect('package');
            }
            else
            {
                redirect('package');
            }





        }
        $data['records'] = $this->crud->get_not_deleted('igc_album');
        $data['package_id'] = $package_id;
        $data['title']= "Albums";
        $this->load->view('header', $data);
        $this->load->view('package_albums');
        $this->load->view('footer');
    }

    //function for list the destination and link destinations

    public function destination($package_id)
    {

        if($this->input->post())
        {
            $id = $this->input->post('package_id');
            $destinations = $this->input->post('destinations');
            $regions = $this->input->post('regions');
            $deletes =  $this->crud->delete($id, 'package_id', 'igc_package_regions');
            $delete = $this->crud->delete($id, 'package_id', 'igc_package_destination');
            if($deletes)
            {
                if(!empty($regions)) {
                    foreach ($regions as $fk => $values) {
                        $insert['package_id'] = $id;
                        $insert['region_id'] = $values;
                        $result = $this->crud->insert($insert, 'igc_package_regions');
                    }
                }
            }

            if($delete)
            {
                if(!empty($destinations)) {
                    foreach ($destinations as $pk => $value) {
                        $inserts['package_id'] = $id;
                        $inserts['destination_id'] = $value;
                        $result = $this->crud->insert($inserts, 'igc_package_destination');
                    }
                }
            }

            if($result)
            {
                $this->session->set_flashdata('success','Package Destination has been Updated.');
                redirect('package');
            }
            else
            {
                redirect('package');
            }





        }
        

        $data['detail'] =  $this->crud->get_Detail($package_id,'package_id','igc_package');

        $data['records'] = $this->crud->get_all('igc_destination');
        $data['regions'] =  $this->crud->get_all('igc_regions');
        $data['package_id'] = $package_id;
        $data['title']= "Destinations";
        $this->load->view('header', $data);
        $this->load->view('package_destinations');
        $this->load->view('footer');
    }




}