<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotel extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('hotel_model','hotel');
        $this->load->model('crud_model', 'crud');

    }
    public $redirect = "hotel";

    public function  index()
    {

        $data['records'] = $this->hotel->get_hotel_list();

        $data['title']= "Hotel List";
        $this->load->view('header',$data);
        $this->load->view('hotel_list');
        $this->load->view('footer');
    }

    public function form($id=0)
    {
        $this->load->helper('html');
        $this->load->helper('form');
        if($this->input->post())
        {

            // print_r($this->input->post());
            // exit;
            //$new_tags = $this->input->post('content_tags');
            $folder_path = '../uploads/hotel/';
           
            $hotel_id = $this->input->post('id');
            $insert['name'] = $this->input->post('name') ;
            $insert['slug'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['name'])) ;
            $insert['code'] = $this->input->post('code');
            $insert['description'] = $this->input->post('description');
            $insert['country_id'] = $this->input->post('country_id');
            $insert['city'] = $this->input->post('city');
            $insert['longitude'] = $this->input->post('longitude');
            $insert['latitude'] = $this->input->post('latitude');
            $insert['category'] = $this->input->post('category');
            $insert['status'] = $this->input->post('status');
            $insert['currency_id'] = $this->input->post('currency_id');
            $insert['startingprice'] = $this->input->post('startingprice');
            $insert['rating'] = $this->input->post('rating');
            $insert['lunch_price'] = $this->input->post('lunch_price');
            $insert['dinner_price'] = $this->input->post('dinner_price');

            $rand = md5(rand());
            $featuredimg= $rand. str_replace(" ","",$_FILES['featuredimg']['name']);
            $featuredimgtmp=$_FILES['featuredimg']['tmp_name'];
            $hotelimg= $rand. str_replace(" ","",$_FILES['hotelimg']['name']);
            $hotelimgtmp=$_FILES['hotelimg']['tmp_name'];

            
                $insert['created'] = date('Y-m-d:H:i:s');
                $insert['updated'] = date('Y-m-d:H:i:s');
                if($_FILES['featuredimg']['name'] !="")
                {
                    $insert['featuredimg']= $featuredimg;

                        move_uploaded_file($featuredimgtmp, $folder_path.$featuredimg);

                }
                if($_FILES['hotelimg']['name'] !="")
                {
                    $insert['hotelimg']= $hotelimg;

                        move_uploaded_file($hotelimgtmp, $folder_path.$hotelimg);

                }
                $insert['tab1'] = $this->input->post('tab1');
                $insert['description1'] = $this->input->post('description1');
                $insert['tab2'] = $this->input->post('tab2');
                $insert['description2'] = $this->input->post('description2');
                $insert['tab3'] = $this->input->post('tab3');
                $insert['description3'] = $this->input->post('description3');
                $insert['tab4'] = $this->input->post('tab4');
                $insert['description4'] = $this->input->post('description4');
                $insert['tab5'] = $this->input->post('tab5');
                $insert['description5'] = $this->input->post('description5');
                $insert['meta_description'] = $this->input->post('meta_description');
                $insert['meta_keywords'] = $this->input->post('meta_keywords');
                $result = $this->hotel->hotel_insert($insert);
              
                if($result)
                {
                    
                    $this->session->set_flashdata('success','New Hotel has been inserted.');
                    redirect('hotel');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new hotel.');
                    redirect('hotel');
                }
              

        }

        $hotel = $this->hotel->get_hotel_list($id);
        $tab = $this->hotel->tab_detail($id);

        $data['content'] = array_merge($hotel, $tab);

        $data['categories'] = $this->hotel->get_hotel_category();
        $data['country'] = $this->hotel->get_country();
        
          $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add Content";
        $this->load->view('header', $data);
        $this->load->view('hotel_form');
        $this->load->view('footer');
    }


    public function edit($id)
    {
        $this->load->helper('html');
        $this->load->helper('form');
        if($this->input->post())
        {

             $folder_path = '../uploads/hotel/';
            
            $hotel_id = $this->input->post('id');
            $insert['name'] = $this->input->post('name') ;
            $insert['slug'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $insert['name'])) ;
            $insert['code'] = $this->input->post('code');
            $insert['description'] = $this->input->post('description');
            $insert['country_id'] = $this->input->post('country_id');
            $insert['city'] = $this->input->post('city');
            $insert['longitude'] = $this->input->post('longitude');
            $insert['latitude'] = $this->input->post('latitude');
            $insert['category'] = $this->input->post('category');
            $insert['status'] = $this->input->post('status');
            $insert['currency_id'] = $this->input->post('currency_id');
            $insert['startingprice'] = $this->input->post('startingprice');
            $insert['rating'] = $this->input->post('rating');
            $insert['lunch_price'] = $this->input->post('lunch_price');
            $insert['dinner_price'] = $this->input->post('dinner_price');

            $rand = md5(rand());
            $featuredimg= $rand. str_replace(" ","",$_FILES['featuredimg']['name']);
            $featuredimgtmp=$_FILES['featuredimg']['tmp_name'];
            $hotelimg= $rand. str_replace(" ","",$_FILES['hotelimg']['name']);
            $hotelimgtmp=$_FILES['hotelimg']['tmp_name'];

            
                $insert['created'] = date('Y-m-d:H:i:s');
                if($_FILES['featuredimg']['name'] !="")
                {
                    $insert['featuredimg']= $featuredimg;

                        move_uploaded_file($featuredimgtmp, $folder_path.$featuredimg);

                }
                if($_FILES['hotelimg']['name'] !="")
                {
                    $insert['hotelimg']= $hotelimg;

                        move_uploaded_file($hotelimgtmp, $folder_path.$hotelimg);

                }

                $insert['tab1'] = $this->input->post('tab1');
                $insert['description1'] = $this->input->post('description1');
                $insert['tab2'] = $this->input->post('tab2');
                $insert['description2'] = $this->input->post('description2');
                $insert['tab3'] = $this->input->post('tab3');
                $insert['description3'] = $this->input->post('description3');
                $insert['tab4'] = $this->input->post('tab4');
                $insert['description4'] = $this->input->post('description4');
                $insert['tab5'] = $this->input->post('tab5');
                $insert['description5'] = $this->input->post('description5');
                $insert['meta_description'] = $this->input->post('meta_description');
                $insert['meta_keywords'] = $this->input->post('meta_keywords');
                $result = $this->crud->update($id, 'id', $insert,'igc_hotel');
               
                if($result)
                {
                    
                    $this->session->set_flashdata('success','Hotel has been edited.');
                    redirect('hotel');
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the hotel.');
                    redirect('hotel');
                }
            

        }


        


        $hotel = $this->crud->get_detail($id, 'id', 'igc_hotel');
        $data['id'] = $id;

        $tab = $this->hotel->tab_detail($id);

        $data['content'] = array_merge($hotel, $tab);

        $data['categories'] = $this->hotel->get_hotel_category();
        $data['country'] = $this->crud->get_all('igc_country');
        
        //$data['parent_pages'] = $this->content->get_parent_page();
        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Edit Content";
        $this->load->view('header', $data);
        $this->load->view('hotel_edit');
        $this->load->view('footer');
    }




    //function to delete package

    public function delete_hotel($id)
    {
        $hotel = $this->hotel->get_hotel_detail($id);
      
        $result = $this->hotel->delete_hotel($id);
        if($result)
        {

            $log['module_title'] =  $hotel['name'];
            $log['action_id'] = "3";
            $this->create_log($log);

            $path = '../uploads/hotel/';
            $recycle_path = '../recycle-bin/hotel/';
            $featuredimg = $hotel['featuredimg'];
            $hotelimg  = $hotel['hotelimg'];
            
            @copy($path.$featuredimg , $recycle_path.$featuredimg);
            @unlink($path.$featuredimg);

            @copy($path.$hotelimg , $recycle_path.$hotelimg);
            @unlink($path.$hotelimg);


            $folder_path = '../uploads/hotel/';


            rmdir($folder_path);


            $this->session->set_flashdata('success','Hotel deleted Successfully');
            redirect('hotel');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete hotel');
            redirect('hotel');
        }

    }


    //function to create log for package

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "hotel";


        $this->db->insert('igc_user_logs', $insert);
    }

    public function gallery($id)
    {
        if($this->input->post())
        {
            $hotel_id = $this->input->post('id');
            $hotel_album = $this->input->post('hotel_album');
        
            $delete = $this->crud->delete($hotel_id, 'hotel_id', 'igc_hotel_album');
            if($delete)
            {
                foreach($hotel_album as $pk => $value)
                {
                    $insert['hotel_id']= $hotel_id;
                    $insert['album_id'] = $value;
                    $result = $this->crud->insert($insert, 'igc_hotel_album');
                    
                }
            }
            if($result)
            {
                $this->session->set_flashdata('success','Hotel Gallery has been Updated.');
                redirect('hotel');
            }
            else
            {
                $this->session->set_flashdata('error','Hotel Gallery has not been Updated.');
                redirect('hotel');
            }
        }
        $data['records'] = $this->crud->get_not_deleted('igc_album');
        $data['id'] = $id;
        $data['title']= "Albums";
        $this->load->view('header', $data);
        $this->load->view('hotel_album');
        $this->load->view('footer');
    }


    public function hotel_related($id){

        if($this->input->post())
        {
             
            $hotel_id = $this->input->post('id');

            $hotel_name = $this->input->post('hotel_related');


            $delete = $this->crud->delete($hotel_id, 'hotel_id', 'related_hotel');

            if($delete)
            {
                foreach($hotel_name as $pk => $value)
                {
                    $insert['hotel_id']= $hotel_id;
                    $insert['related_id'] = $value;
                    $result = $this->crud->insert($insert, 'related_hotel');
                    
                }
            }
            if($result)
            {
                $this->session->set_flashdata('success','Related hotel has been added.');
                redirect('hotel');
            }
            else
            {
                $this->session->set_flashdata('error','Related has not been Updated.');
                redirect('hotel');
            }
        }

        $data['records'] = $this->hotel->get_not_deleted('igc_hotel');
        $data['id'] = $id;

        $data['title']= "Related Hotel";
        $this->load->view('header', $data);
        $this->load->view('hotel_related');
        $this->load->view('footer');

    }


    public function hotel_feature($id){

        if($this->input->post()){
          
            $hotel_id = $this->input->post('id');
           
            $feature_id = $this->input->post('hfid');


            $delete = $this->crud->delete($hotel_id, 'hotel_id', 'hotel_features');

            if($delete)
            {
                foreach($feature_id as $row => $value)
                {
                    
                    $insert['hotel_id']= $hotel_id;
                    $insert['features_id'] = $value;
                    $result = $this->crud->insert($insert, 'hotel_features');
                    
                }

            }
            if($result)
            {
                $this->session->set_flashdata('success','Hotel features has been added.');
                redirect('hotel');
            }
            else
            {
                $this->session->set_flashdata('error','Please try again!!!');
                redirect('hotel');
            } 

        }

        $data['records'] = $this->crud->get_all('igc_features_setting');

        $data['hotel'] = $this->crud->get_all('igc_hotel');

        $data['features_name'] = $this->hotel->get_features_name();
        
        $data['id'] = $id;


        $data['title']= "Hotel Features";
        $this->load->view('header', $data);
        $this->load->view('hotel_feature');
        $this->load->view('footer');

    }

    public function room($hotel_id){

        $data['rooms'] = $this->hotel->get_detail($hotel_id, 'hotel_id', 'igc_hotel_room');
        // print_r($data['rooms']);
        // exit;
        $data['title']= "Room";
        $data['hotel_id'] = $hotel_id;
        $this->load->view('header', $data);
        $this->load->view('room_list');
        $this->load->view('footer');

    }

    public function addroom($hotel_id){
        if($this->input->post())
        {
          
            // print_r($this->input->post());
            // exit;
            $folder_path = '../uploads/room/';
            $inserts['hotel_id'] = $this->input->post('hotel_id');
            $inserts['name'] = $this->input->post('name');
            $inserts['slug'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $inserts['name'])) ;
            $inserts['roomsize'] = $this->input->post('roomsize');
            $inserts['views'] = $this->input->post('views');
            $inserts['room_id'] = $this->input->post('room_id');
            $inserts['beds'] = $this->input->post('beds');
            $inserts['pax'] = $this->input->post('pax');
            $inserts['description'] = $this->input->post('description');
            $inserts['publish_status'] = $this->input->post('publish_status');
            $inserts['currency_id'] = $this->input->post('currency_id');
            $inserts['price'] = $this->input->post('price');
            $inserts['isdiscount'] = $this->input->post('isdiscount');
            $inserts['freecancelfront'] = $this->input->post('freecancelfront');
            $inserts['bookingfront'] = $this->input->post('bookingfront');
            $inserts['limitedroom'] = $this->input->post('limitedroom');
            $inserts['available_room'] = $this->input->post('available_room');
            $inserts['dprice'] = $this->input->post('dprice');
            $inserts['extra_bed_price'] = $this->input->post('extra_bed_price');
            $inserts['infant'] = $this->input->post('infant');
            $inserts['infantdesc'] = $this->input->post('infantdesc');
            $inserts['child'] = $this->input->post('child');
            $inserts['childdesc'] = $this->input->post('childdesc');
            $inserts['extrabeds'] = $this->input->post('extrabeds');
            $inserts['bookingcondition'] = $this->input->post('bookingcondition');
            $inserts['bookingdescription'] = $this->input->post('bookingdescription');
            $inserts['freecancellation'] = $this->input->post('freecancellation');
            $inserts['created'] = date('Y-m-d:H:i:s');
            $inserts['updated'] = date('Y-m-d:H:i:s');
            $rand = md5(rand());
            $room_image= $rand. str_replace(" ","",$_FILES['room_image']['name']);
            $roomimgtmp=$_FILES['room_image']['tmp_name'];
               
                if($_FILES['room_image']['name'] !="")
                {
                    $inserts['room_image']= $room_image;

                        move_uploaded_file($roomimgtmp, $folder_path.$room_image);

                }
            //$hotelroom_id = $this->input->post('hotelroom_id');
           
            $feature_id = $this->input->post('featureid');
           
            
            $result = $this->crud->insert_return_id($inserts, 'igc_hotel_room');

            foreach($feature_id as $row => $values)
            {
                $insertss['hotelroom_id'] = $result;
                $insertss['features_id'] = $values;
                $results = $this->crud->insert($insertss, 'room_features');

            }
            
            $room_album = $this->input->post('room_album');

            foreach($room_album as $pk => $value)
            {
                $insert['hotelroom_id']= $result;
                $insert['album_id'] = $value;
                $results = $this->crud->insert($insert, 'room_album');
            }
           
            if($result)
            {
                $this->session->set_flashdata('success','Hotel room has been added.');
                redirect('hotel/room/'.$hotel_id);
            }
            else
            {
                $this->session->set_flashdata('error','Please try again!!!');
                redirect('hotel/room/'.$hotel_id);
            } 

            
        }
        $data['records'] = $this->crud->get_not_deleted('igc_album');
        $data['room_type'] = $this->crud->get_all('igc_room_setting');
        $data['features'] = $this->hotel->get_room();
        $data['hotel_id'] = $hotel_id;
        
        $data['title']= "Room";
        $data['scripts'] = array('themes/js/form-validator');
        $this->load->view('header', $data);
        $this->load->view('addroom');
        $this->load->view('footer');
    }




public function editroom($hotelroom_id){

        if($this->input->post())
        {
          
            $folder_path = '../uploads/room/';
            $inserts['hotel_id'] = $this->input->post('hotel_id');
            $inserts['name'] = $this->input->post('name');
            $inserts['slug'] = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $inserts['name']));
            $inserts['roomsize'] = $this->input->post('roomsize');
            $inserts['views'] = $this->input->post('views');
            $inserts['room_id'] = $this->input->post('room_id');
            $inserts['beds'] = $this->input->post('beds');
            $inserts['pax'] = $this->input->post('pax');
            $inserts['description'] = $this->input->post('description');
            $inserts['publish_status'] = $this->input->post('publish_status');
            $inserts['currency_id'] = $this->input->post('currency_id');
            $inserts['price'] = $this->input->post('price');
            $inserts['isdiscount'] = $this->input->post('isdiscount');
            $inserts['freecancelfront'] = $this->input->post('freecancelfront');
            $inserts['bookingfront'] = $this->input->post('bookingfront');
            $inserts['limitedroom'] = $this->input->post('limitedroom');
            $inserts['available_room'] = $this->input->post('available_room');
            $inserts['dprice'] = $this->input->post('dprice');
            $inserts['extra_bed_price'] = $this->input->post('extra_bed_price');
            $inserts['infant'] = $this->input->post('infant');
            $inserts['infantdesc'] = $this->input->post('infantdesc');
            $inserts['child'] = $this->input->post('child');
            $inserts['childdesc'] = $this->input->post('childdesc');
            $inserts['extrabeds'] = $this->input->post('extrabeds');
            $inserts['bookingcondition'] = $this->input->post('bookingcondition');
            $inserts['bookingdescription'] = $this->input->post('bookingdescription');
            $inserts['freecancellation'] = $this->input->post('freecancellation');
            $inserts['created'] = date('Y-m-d:H:i:s');
            $rand = md5(rand());
            $room_image= $rand. str_replace(" ","",$_FILES['room_image']['name']);
            $roomimgtmp=$_FILES['room_image']['tmp_name'];
               
                if($_FILES['room_image']['name'] !="")
                {
                    $inserts['room_image']= $room_image;

                        move_uploaded_file($roomimgtmp, $folder_path.$room_image);

                }
            $feature_id = $this->input->post('featureid');
           
            
            $results = $this->crud->update($hotelroom_id, 'hotelroom_id', $inserts, 'igc_hotel_room');
           
            $delete = $this->crud->delete($hotelroom_id, 'hotelroom_id', 'room_features');
            if($delete){
            foreach($feature_id as $row => $values)
            {
                $insertss['hotelroom_id'] = $hotelroom_id;
                $insertss['features_id'] = $values;
                $results = $this->crud->insert($insertss, 'room_features');

            }
        }
            $room_album = $this->input->post('room_album');
            $delete_album = $this->crud->delete($hotelroom_id, 'hotelroom_id', 'room_album');
            if($delete_album){
            foreach($room_album as $pk => $value)
            {
                $insert['hotelroom_id']= $hotelroom_id;
                $insert['album_id'] = $value;
                $results = $this->crud->insert($insert, 'room_album');
            }
        }
            if($results)
            {
                $this->session->set_flashdata('success','Hotel room has been updated.');
                redirect('hotel');
            }
            else
            {
                $this->session->set_flashdata('error','Please try again!!!');
                redirect('hotel');
            } 

            
        }
        $data['hotelroom_id'] = $hotelroom_id;
        $data['hotelroom'] = $this->crud->get_detail($hotelroom_id, 'hotelroom_id', 'igc_hotel_room');
        
        $data['records'] = $this->crud->get_not_deleted('igc_album');
        $data['room_type'] = $this->crud->get_all('igc_room_setting');
        $data['features'] = $this->hotel->get_room();
        $data['title']= "Room";
        $data['scripts'] = array('themes/js/form-validator');
        $this->load->view('header', $data);
        $this->load->view('editroom');
        $this->load->view('footer');
    }

     //code to delete the the  setting

    public function delete_room($hotelroom_id)
    {
        $hotelroom = $this->crud->get_detail($hotelroom_id, 'hotelroom_id', 'igc_hotel_room');
        $hotel_id = $hotelroom['hotel_id'];

        $path = '../uploads/room/';
            $recycle_path = '../recycle-bin/hotel/';
            $room_image = $hotel['room_image'];
            
            @copy($path.$room_image , $recycle_path.$room_image);
            @unlink($path.$room_image);

            $folder_path = '../uploads/room/';


            rmdir($folder_path);



        $result = $this->hotel->delete_room($hotelroom_id);

        if($result)
        {
            //code to create log
            $log['module_title']= $hotelroom['name'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Hotel room Information has been deleted.');
            redirect('hotel/room/'.$hotelroom_id);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Information.');
            redirect('hotel/room/'.$hotelroom_id);
        }
    }

}