<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Album extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');

    }

    public  $table = "igc_album";
    public $field_name = "album_id";
    public  $redirect = "album";



    public function index()
    {

        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Albums";
        $this->load->view('header', $data);
        $this->load->view('album_list');
        $this->load->view('footer');
    }

    public function form($id=0)
    {
        if($this->input->post())
        {
            $album_id = $this->input->post('album_id');
            $insert['name'] = $this->input->post('name');
            $url = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['name'])) ;
            $insert['description'] = $this->input->post('description');
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['delete_status'] = "0";
            //code to check url

            $check_url =  $this->crud->check_url($album_id, $this->field_name, $url, 'album_url',$this->table);
            if(!empty($check_url))
            {
                $insert['album_url']= $url."-".rand(1, 50);
            }
            else
            {
                $insert['album_url'] = $url;
            }

            if($album_id =="")
            {
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert_return_id($insert, $this->table);
                if($result)
                {
                    //code to create log
                    $log['module_title']= $insert['name'];
                    $log['action_id']= "1";
                    $this->create_log($log);
                    $folder_path = '../uploads/album/';
                    mkdir($folder_path . $result, 0777, true);
                    $this->session->set_flashdata('success','New Album has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add Album.');
                    redirect($this->redirect);
                }

            }



        }

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add Album";
        $this->load->view('header', $data);
        $this->load->view('album_form');
        $this->load->view('footer');
    }

    public function detail($id)
    {
        if($this->input->post())
        {

//            print_r($this->input->post());
//            exit;
            $album_id= $this->input->post('album_id');
            $insert['name']= $this->input->post('name');
            $url = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['name'])) ;
            $insert['description']= $this->input->post('description');
            $insert['publish_status']= $this->input->post('publish_status');
            $insert['image_id'] = $this->input->post('album_cover');
            $check_url =  $this->crud->check_url($album_id, $this->field_name, $url, 'album_url',$this->table);
            if(!empty($check_url))
            {
                $insert['album_url']= $url."-".rand(1, 50);
            }
            else
            {
                $insert['album_url'] = $url;
            }

            $result= $this->crud->update($album_id, $this->field_name, $insert, $this->table);


            $images = $this->input->post('images');
            $caption = $this->input->post('image_caption');

            $publish = $this->input->post('image_publish');

            if(! empty($images))
            {
                foreach($images as $pk => $value)
                {
                    $image_id = $value;
                    $image_update['caption']= $caption[$value];

                    $image_update['publish_status'] = (isset($publish[$value]) && $publish[$value] !="") ? $publish[$value]:"0";

                    $result = $this->crud->update($image_id, 'image_id', $image_update ,'igc_image');
                }
            }

            if($result)
            {
                //code to create log
                $log['module_title']= $insert['name'];
                $log['action_id']= "2";
                $this->create_log($log);

                $this->session->set_flashdata('success','Album has been Updated.');
                redirect($this->redirect);
            }
            else{
                $this->session->set_flashdata('error','Unable to Update the album.');
                redirect($this->redirect);
            }


        }
        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['records'] = $this->crud->get_detail_records($id, $this->field_name, 'igc_image');
        $data['title']= "Edit Album";
        $this->load->view('header', $data);
        $this->load->view('album_gallery');
        $this->load->view('footer');
    }

    public function add($id)
    {
        if($this->input->post())
        {

            $album_id = $this->input->post('album_id');
            $album_detail = $this->crud->get_detail($album_id, $this->field_name, $this->table);
            $album_name = $album_detail['name'];
            $path = '../uploads/album/'.$album_id."/";

            $date= date('Y-m-d:H:i:s');
            $rand = md5(rand());
            $image1=$rand. str_replace(" ","",$_FILES['image1']['name']);
            $image1tmp=$_FILES['image1']['tmp_name'];
            $image2=$rand. str_replace(" ","",$_FILES['image2']['name']);
            $image2tmp=$_FILES['image2']['tmp_name'];
            $image3=$rand. str_replace(" ","",$_FILES['image3']['name']);
            $image3tmp=$_FILES['image3']['tmp_name'];
            $image4=$rand. str_replace(" ","",$_FILES['image4']['name']);
            $image4tmp=$_FILES['image4']['tmp_name'];
            $image5=$rand. str_replace(" ","",$_FILES['image5']['name']);
            $image5tmp=$_FILES['image5']['tmp_name'];
            $image6=$rand. str_replace(" ","",$_FILES['image6']['name']);
            $image6tmp=$_FILES['image6']['tmp_name'];

            if($_FILES['image1']['name'] !="")
            {

                $insert1['name']= $image1;
                $insert1['caption'] = $this->input->post('caption1');
                $insert1['album_id'] = $album_id;
                $insert1['publish_status'] = '1';
                $insert1['delete_status'] = '0';
                $insert1['created'] = $date;
                $result1 = $this->crud->insert($insert1, 'igc_image');
                if($result1)
                {
                    //code to create log
                    $log['module_title']= $album_name . " "."(". $insert1['name'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);

                    move_uploaded_file($image1tmp,$path.$image1);
                }
            }
            if($_FILES['image2']['name'] !="")
            {
                $insert2['name']= $image2;
                $insert2['caption'] = $this->input->post('caption2');
                $insert2['album_id'] = $album_id;
                $insert2['publish_status'] = '1';
                $insert2['delete_status'] = '0';
                $insert2['created'] = $date;
                $result2 = $this->crud->insert($insert2, 'igc_image');
                if($result2)
                {
                    //code to create log
                    $log['module_title']= $album_name . " "."(". $insert2['name'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);
                    move_uploaded_file($image2tmp,$path.$image2);
                }
            }
            if($_FILES['image3']['name'] !="")
            {
                $insert3['name']= $image3;
                $insert3['caption'] = $this->input->post('caption3');
                $insert3['album_id'] = $album_id;
                $insert3['publish_status'] = '1';
                $insert3['delete_status'] = '0';
                $insert3['created'] = $date;
                $result3 = $this->crud->insert($insert3, 'igc_image');
                if($result3)
                {
                    //code to create log
                    $log['module_title']= $album_name . " "."(". $insert3['name'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);
                    move_uploaded_file($image3tmp,$path.$image3);
                }
            }
            if($_FILES['image4']['name'] !="")
            {
                $insert4['name']= $image4;
                $insert4['caption'] = $this->input->post('caption4');
                $insert4['album_id'] = $album_id;
                $insert4['publish_status'] = '1';
                $insert4['delete_status'] = '0';
                $insert4['created'] = $date;
                $result4 = $this->crud->insert($insert4, 'igc_image');
                if($result4)
                {
                    //code to create log
                    $log['module_title']= $album_name . " "."(". $insert4['name'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);
                    move_uploaded_file($image4tmp,$path.$image4);
                }
            }
            if($_FILES['image5']['name'] !="")
            {
                $insert5['name']= $image5;
                $insert5['caption'] = $this->input->post('caption5');
                $insert5['album_id'] = $album_id;
                $insert5['publish_status'] = '1';
                $insert5['delete_status'] = '0';
                $insert5['created'] = $date;
                $result5 = $this->crud->insert($insert5, 'igc_image');
                if($result5)
                {
                    //code to create log
                    $log['module_title']= $album_name . " "."(". $insert5['name'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);
                    move_uploaded_file($image5tmp,$path.$image5);
                }
            }
            if($_FILES['image6']['name'] !="")
            {
                $insert6['name']= $image6;
                $insert6['caption'] = $this->input->post('caption6');
                $insert6['album_id'] = $album_id;
                $insert6['publish_status'] = '1';
                $insert6['delete_status'] = '0';
                $insert6['created'] = $date;
                $result6 = $this->crud->insert($insert6, 'igc_image');
                if($result6)
                {
                    //code to create log
                    $log['module_title']= $album_name . " "."(". $insert6['name'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);
                    move_uploaded_file($image6tmp,$path.$image6);
                }
            }



            redirect($this->redirect);




        }
        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['title']= "Add Image";
        $this->load->view('header', $data);
        $this->load->view('image_form');
        $this->load->view('footer');
    }


    public function image_delete()
    {
        if($this->input->post())
        {
            $album_id = $this->input->post('album_id');
            $album_detail = $this->crud->get_detail($album_id, $this->field_name, $this->table);
            $album_name = $album_detail['name'];
            $id = $this->input->post('id');
            $detail = $this->crud->get_detail($id, 'image_id', 'igc_image');
            $unlink_file = $detail['name'];
            $path = '../uploads/album/'.$album_id."/";
            $update['delete_status']="1";
            $result = $this->crud->update($id, 'image_id', $update, 'igc_image');
            if($result)
            {
                //code to create log
                $log['module_title']= $album_name . " "."(". $unlink_file.")";
                $log['action_id']= "3";
                $this->create_log($log);

                if(file_exists($path.$unlink_file))
                {
                    unlink($path.$unlink_file);
                }
                echo "success";
            }

        }
    }



    //function to album delete

    public function album_delete($id)
    {
        $album_detail = $this->crud->get_detail($id, $this->field_name, $this->table);
        $gallery = $this->crud->get_detail_records($id, 'album_id', 'igc_image');

        if(empty($gallery))
        {
            $this->session->set_flashdata('error','Unable to delete the Album.');
            redirect($this->redirect);
        }
        else{

            $result = $this->crud->soft_delete($id, $this->field_name, $this->table);
            if($result)
            {
                //code to create log
                $log['module_title']= $album_detail['name'];
                $log['action_id']= "3";
                $this->create_log($log);
                $this->session->set_flashdata('success','Album has been deleted.');
                redirect($this->redirect);
            }
            else{
                $this->session->set_flashdata('error','Unable to delete the Album.');
                redirect($this->redirect);
            }

        }


    }


    //function to create log for album

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] ="Album";
        $this->db->insert('igc_user_logs', $insert);
    }





}

