<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Trekking extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->library('form_validation');
        $this->load->model('crud_model','crud');
        $this->load->model('trekking_model','trekking');
        $this->load->model('site_settings_model','site_settings');

        $this->load->library('encrypt');

    }

    public function index()
    {
        $data['records'] = $this->trekking->get_trekking_list();

        $data['title']= "trekking List";
        $this->load->view('header', $data);
        $this->load->view('trekking_list');
        $this->load->view('footer');
    }

    public function form($id=0)
    {
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if($this->input->post())
        {

             $this->form_validation->set_rules('tour_title', 'tour_title','required' );
            // $this->form_validation->set_rules('tour_page_title', 'tour_page_title', 'required|callback_check_name_exist['.$this->input->post('tour_id').']');
            $this->form_validation->set_rules('tour_body', 'tour_body');
            $this->form_validation->set_rules('tour_type', 'tour_type');
            $this->form_validation->set_rules('meta_description', 'meta_description');
            $this->form_validation->set_rules('meta_keywords', 'meta_keywords');
            $this->form_validation->set_rules('meta_title', 'meta_title');
            $this->form_validation->set_rules('publish_status', 'publish_status');
            $this->form_validation->set_rules('show_on_menu', 'show_on_menu');
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
            $new_tags = $this->input->post('tour_tags');
            $folder_path = '../uploads/tour/';
            $tour_id = $this->input->post('tour_id');
            $insert['tour_title'] = $this->input->post('tour_title') ;
            $insert['duration'] = $this->input->post('duration') ;
            $insert['tour_page_title'] = $this->input->post('tour_page_title');
            $insert['tour_body'] = $this->input->post('tour_body');
            $insert['meta_description'] = $this->input->post('meta_description');
            $insert['meta_keywords'] = $this->input->post('meta_keywords');
            $insert['meta_title'] = $this->input->post('meta_title');

            $insert['tour_type'] = $this->input->post('tour_type');
            $insert['publish_status'] = $this->input->post('publish_status');
            $insert['show_on_menu'] = $this->input->post('show_on_menu');
            $insert['delete_status'] = "0";
            $insert['tour_url'] = strtolower(str_replace(" ","-",$insert['tour_page_title']));
           // $insert['parent_id'] = $this->input->post('parent_id');
            $rand = md5(rand());
            $featuredimg= $rand. str_replace(" ","",$_FILES['featured_img']['name']);
            $featuredimgtmp=$_FILES['featured_img']['tmp_name'];



            //code to check url

            // $check_url =  $this->crud->check_url($tour_id, 'tour_id', $url, 'tour_url','sg_tour');
            // if(!empty($check_url))
            // {
            //     $insert['tour_url']= $url."-".rand(1, 50);
            // }
            // else
            // {
            //     $insert['tour_url'] = $url;
            // }


            if($tour_id =="")
            {
                $insert['parent_id']= "0";
                $insert['position']= "0";
                $insert['group_id']= "1";
                $insert['created'] = date('Y-m-d:H:i:s');
                if($_FILES['featured_img']['name'] !="")
                {
                    $insert['featured_img']= $featuredimg;

                        move_uploaded_file($featuredimgtmp,$folder_path.$featuredimg);

                }

            if($insert['tour_type'] == "Page")
            {
                $insert['parent_id'] = $this->input->post('parent_id');
                $result = $this->trekking->tour_insert($insert);
                //code to add tags
                $this->add_tags($result, $new_tags);
                $inserts['tab1'] = $this->input->post('tab1');
                $inserts['description1'] = $this->input->post('description1');
                $inserts['tab2'] = $this->input->post('tab2');
                $inserts['description2'] = $this->input->post('description2');
                $inserts['tab3'] = $this->input->post('tab3');
                $inserts['description3'] = $this->input->post('description3');
                $inserts['tab4'] = $this->input->post('tab4');
                $inserts['description4'] = $this->input->post('description4');
                $inserts['tab5'] = $this->input->post('tab5');
                $inserts['description5'] = $this->input->post('description5');

                $inserts['tour_id']= $result;


                $this->trekking->tab_insert($inserts);

                if($result)
                {
                    //code to create log
                    $log['module_title']= $insert['tour_page_title'];
                    $log['action_id']= "1";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','New tour has been inserted.');
                    redirect('tour');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new tour.');
                    redirect('tour');
                }
            }
            else{

                $category = $this->input->post('category_id');

                //code to check if category exist or not
                if($category == "")
                {
                    $cat['category_name'] = "Uncatgeorized";
                    $results = $this->trekking->insert_trekking_category($cat);
                    $insert['category_id'] = $results;

                }
                else{
                    $insert['category_id'] = $category;
                }


                $result = $this->trekking->trekking_insert($insert);
                if($result)
                {
                    //code to create log
                    $log['module_title']= $insert['tour_page_title'];
                    $log['action_id']= "1";
                    $this->create_log($log);
                    //code to add tags
                    $this->add_tags($result, $new_tags);

                    $this->session->set_flashdata('success','New tour has been inserted.');
                    redirect('tour');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new tour.');
                    redirect('tour');
                }

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

                if($insert['tour_type'] == "Page")
                {

//                    print_r($insert);
//                    exit;
                    $result = $this->trekking->tour_update($insert, $tour_id);
                    //code to add tags
                    $this->add_tags($tour_id, $new_tags);
                    $inserts['tab1'] = $this->input->post('tab1');
                    $inserts['description1'] = $this->input->post('description1');
                    $inserts['tab2'] = $this->input->post('tab2');
                    $inserts['description2'] = $this->input->post('description2');
                    $inserts['tab3'] = $this->input->post('tab3');
                    $inserts['description3'] = $this->input->post('description3');
                    $inserts['tab4'] = $this->input->post('tab4');
                    $inserts['description4'] = $this->input->post('description4');
                    $inserts['tab5'] = $this->input->post('tab5');
                    $inserts['description5'] = $this->input->post('description5');

                    $tab_data = $this->tour->tab_detail($tour_id);

                    if(!empty($tab_data))
                    {
                        $this->trekking->tab_update($inserts, $tour_id);
                    }
                    else{
                        $inserts['tour_id'] = $tour_id;
                        $this->tour->tab_insert($inserts);
                    }



                    if($result)
                    {
                        //code to create log
                        $log['module_title']= $insert['tour_page_title'];
                        $log['action_id']= "2";
                        $this->create_log($log);
                        $this->session->set_flashdata('success','tour has been updated.');
                        redirect('tour');
                    }
                    else{
                        $this->session->set_flashdata('error','Unable to update the tour.');
                        redirect('tour');
                    }
                }
                else
                {

                        $category = $this->input->post('category_id');

                    //code to check if category exist or not
                    if($category == "")
                    {
                        $cat['category_name'] = "Uncatgeorized";
                        $results = $this->trekking->insert_trekking_category($cat);
                        $insert['category_id'] = $results;

                    }
                    else{
                        $insert['category_id'] = $category;
                    }

                    $result = $this->trekking->trekking_update($insert, $tour_id);
                    if($result)
                    {
                        //code to create log
                        $log['module_title']= $insert['tour_page_title'];
                        $log['action_id']= "2";
                        $this->create_log($log);

                        //code to add tags
                        $this->add_tags($tour_id, $new_tags);
                        $this->session->set_flashdata('success','tour has been updated.');
                        redirect('tour');
                    }
                    else{
                        $this->session->set_flashdata('error','Unable to update the tour.');
                        redirect('tour');
                    }

                }

            }
        }

        }


        $tour = $this->trekking->get_trekking_detail($id);
        $tab = $this->trekking->tab_detail($id);

       // $data['tour'] = array_merge($tour, $tab);

        $data['categories'] = $this->trekking->get_trekking_categories();
        $data['parent_pages'] = $this->trekking->get_parent_page();


        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add/Edit Tour";
        $this->load->view('header', $data);
        $this->load->view('trekking_form');
        $this->load->view('footer');
    }

    public function check_name_exist($str, $trekking_id)
    {
        $string = str_replace(" ","-",$str);
        $name = $this->trekking->check_name_exist($string, $trekking_id);
        
        if(empty($name))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_name_exist', 'trekking page title already exist.');
            return FALSE;
        }

    }



    public function comment($id)
    {
        $detail= $this->crud->get_detail($id, 'trekking_id', 'sg_trekking');
        if($detail['trekking_type']=="Page")
        {
            redirect('trekking');
        }
        $data['page_title'] = $detail['trekking_page_title'];
        $data['records'] = $this->crud->get_detail_rows($id, 'trekking_id', 'sg_trekking_comments');
        $data['title']= "Publish/UnPublish Comment";
        $this->load->view('header', $data);
        $this->load->view('comment_list');
        $this->load->view('footer');
    }

    public function comment_active()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id');
            $update['approved_status']="1";
            $this->crud->update($id, 'comment_id', $update, 'sg_trekking_comments');
            //code to create log
            $log['module_title']= "trekking Comment Id"."(".$id.")";
            $log['action_id']= "2";
            $this->create_log($log);
            echo "success";
        }
    }

    public function comment_inactive()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id');
            $update['approved_status']="0";
            $this->crud->update($id, 'comment_id', $update, 'sg_trekking_comments');
            //code to create log
            $log['module_title']= "trekking Comment Id"."(".$id.")";
            $log['action_id']= "2";
            $this->create_log($log);
            echo "success";
        }
    }

    //comment delete

    public function comment_delete($id)
    {
        $result = $this->crud->delete($id,'comment_id','sg_trekking_comments');
        if($result)
        {
            //code to create log
            $log['module_title']= "trekking Comment Id"."(".$id.")";
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Comment has been deleted.');
            redirect('trekking');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Comment.');
            redirect('trekking');
        }
    }




    //code to soft delete the trekking

    public function delete($trekking_id)
    {
        $trekking_detail = $this->crud->get_detail($trekking_id, 'trekking_id', 'sg_trekking');
        $result = $this->trekking->delete_trekking($trekking_id);
        if($result)
        {
            //code to create log
            $log['module_title']= $trekking_detail['trekking_page_title'];
            $log['action_id']= "3";
            $this->create_log($log);

            $path='../uploads/trekking/';
            @unlink($path.$trekking_detail['featured_img']);
            $this->session->set_flashdata('success','trekking has been deleted.');
            redirect('trekking');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the trekking.');
            redirect('trekking');
        }
    }



//code to add new tags in trekking

    public function add_tags($trekking_id, $tags)
    {
        if ($tags != '') {
            $tagIn = trim(preg_replace('/\s+/', ',', $tags));
            $tags = explode(',', $tagIn);

            $this->trekking->insert_tags($tags, $trekking_id);
        }

    }

    public function rmv_trekking_tag()
    {
        if($this->input->post())
        {
            $term_id = $this->input->post('term_id');
            $trekking_id = $this->input->post('trekking_id');

            $this->db->where('trekking_id', $trekking_id);
            $this->db->where('term_id', $term_id);
            $this->db->delete('sg_trekking_tags');

            echo "success";


        }
    }


    public function send($trekking_id)
    {
        $trekking_detail = $this->crud->get_detail($trekking_id, 'trekking_id', 'sg_trekking');
        $subscribes = $this->trekking->get_subscribers();
        if(! empty($trekking_detail) && $trekking_detail['trekking_type'] == 'Article' && ! empty($subscribes))
        {
            $site_settings = $this->site_settings->get_site_settings();
            $server_url = $site_settings['site_url'].'/index.php/blog/detail/'.$trekking_detail['trekking_url'];
            $server = $this->server->active_mail_server();

            $password = $this->encrypt->decode($server['password']);



            $this->load->library('mailer');

            $mail  = new PHPMailer();


            $body = '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>'.$site_settings['site_name'].' Article</title>
</head>

<body>
<div style="width:580px;margin:0 auto;font:12px Arial,Helvetica,sans-serif;background:#fff">
    <div style="margin:0 0 10px"> <img alt="SansuiTrek" src="http://sansuitrek.com/templates/gk_music/images/logo.png"> </div>
    <p>Dear Subscribers</p>

    <table width="100%" cellspacing="0" cellpadding="5" border="0">

        <tbody>
        <tr>
           <p> Our new article has been published.
          In order to read the article please click the article Link. '.'<a href="'.$server_url.'">'.$server_url.'</a>'.'</p>
        </tr>


        <tr>
            <td colspan="2" style="background:#EEE; text-align:left;">Thanks and Regards,<br />
                SunsuiTrek<br />
                Tel:<strong>+977-1-4414739 / 4005043/44</strong><br />
                <a href="http://sansuitrek.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.sansuitrek.com</a></td>
        </tr>
        <tr>
            <td colspan="2" style="background:#EEE; text-align:left;"><br />
                IGC Technology<br />
                Tel:<strong>+977-01-4005043/4005044</strong><br />
                <a href="http://igctech.com.np/" target="_blank" style="color:#46216F; text-decoration:underline;">www.igctech.com.np</a></td>
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

            $mail->SMTPAuth   = true;                  // enable SMTP authentication

            $mail->SMTPSecure = $server['server_prefix'];                 // sets the prefix to the servier

            $mail->Host       =  $server['host'];      // sets GMAIL as the SMTP server

            $mail->Port       = $server['port'];                  // set the SMTP port for the GMAIL server

            $mail->Username   = $server['username'];  // GMAIL username

            $mail->Password   = $password;          // GMAIL password

            $mail->SetFrom($server['send_from_email'], $server['send_from_name']);

            $mail->AddReplyTo($server['reply_to_email'],$server['reply_to_name']);

            $mail->Subject    = $site_settings['site_name']." Newsletter";


            $mail->MsgHTML($body);

            foreach($subscribes as $rows)
            {
                $mail->AddAddress($rows['email'], $site_settings['site_name']);
            }



            if(!$mail->Send())
            {
                $this->session->set_flashdata('error', 'Unable to Send the Email.Please Check Your Internet Connection.');
                redirect('trekking');

            }
            else{
                $this->session->set_flashdata('success', 'NewsLetter has been Send.');
                redirect('trekking');
            }

        }
        else{
            $this->session->set_flashdata('error', 'Unable to Send the Newsletter');
            redirect('trekking');
        }

    }

    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "trekking";
        $this->db->insert('igc_user_logs', $insert);
    }


}