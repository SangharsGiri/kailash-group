<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Features_setting extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('crud_model','crud');
        $this->load->model('features_model','features');

    }

    public  $redirect = "features_setting";

    public function index()
    {
        if(isset($_POST['submit'])){
            $room = $this->input->post('isroom');
            $name = $this->features->get_name();
            foreach ($name as $key) {
                $parent = $key['parent_id'];
                   
                $update['isroom'] = 'N';
                $sql = $this->crud->update($parent, 'parent_id', $update, 'igc_features_setting');  
            }
            if(!empty($room)){    
                foreach ($room as $val) {
                    $update['isroom'] = 'Y';
                    $sql = $this->crud->update($val, 'id', $update, 'igc_features_setting');         
                }
            }   
        }
           
        $data['features_name'] = $this->features->get_name();

        $data['title']= "Features List";
        $this->load->view('header', $data);
        $this->load->view('features_list');
        $this->load->view('footer');
    }

    public function form($id=0)
    {
        if($this->input->post())
        {
            $id = $this->input->post('id');
            $insert['features_name'] = $this->input->post('features_name');
            $insert['status'] = $this->input->post('status');
            $insert['parent_id'] = "0";
            $name = $this->input->post('cname');
           
            if($id == "")
            {
                $insert['created'] = date('Y-m-d:H:i:s');

                $result = $this->features->insert_features($insert);
                
                if($result)
                {
                    $inserts['parent_id'] = $result;
                    if(!empty($name)) {
                        foreach ($name as $row) {


                            $inserts['features_name'] = $row;
                            $inserts['status'] = $this->input->post('status');

                            $this->features->insert_child($inserts);

                        }
                    }
                    $this->session->set_flashdata('success','New features has been inserted.');
                    redirect('features_setting');
                }
                else{
                    $this->session->set_flashdata('error','Unable to insert the new features.');
                    redirect('features_setting');
                }
            }
        }

       

        $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add Features Settings";
        $this->load->view('header', $data);
        $this->load->view('features_form');
        $this->load->view('footer');
    }

    public function edit($id){

        if($this->input->post()){
            $id = $this->input->post('id');
            $insert['features_name'] = $this->input->post('features_name');
            $insert['status'] = $this->input->post('status');
            $insert['parent_id'] = "0";
            $name = $this->input->post('child_name');
            $child_id = $this->input->post('child_id');
            $more_name = $this->input->post('cname');
           
            if(!empty($id))
            {
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->update($id, 'id', $insert, 'igc_features_setting');
                if($result)
                {
                    $update['parent_id'] = $result;

                
                    foreach($name as $key => $value){
                        $update['features_name'] = $value;
                        $update['status'] = $this->input->post('status');
                        $results = $this->crud->update($key, 'id', $update, 'igc_features_setting');
                    }
                 
                    $inserts['parent_id'] = $result;
                    foreach ($more_name as $row) {
                        $inserts['features_name'] = $row;
                        $inserts['status'] = $this->input->post('status');

                        $query = $this->features->insert_child($inserts);
                    
                    }

                    $this->session->set_flashdata('success','Features has been updated.');
                    redirect('features_setting');
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the features.');
                    redirect('features_setting');
                }
            }
        }
        
        $data['features'] = $this->features->get_detail($id);
        $data['child'] = $this->features->get_child($id);
       
          $data['scripts'] = array('themes/js/form-validator');
        $data['title']= "Add Features Settings";
        $this->load->view('header', $data);
        $this->load->view('features_edit');
        $this->load->view('footer');

    }

    //code to delete the the  setting

    public function delete($id)
    {
        $features= $this->crud->get_detail($id, 'id', 'igc_features_setting');


        $result = $this->features->delete_features($id);

        if($result)
        {
            //code to create log
            $log['module_title']= $features['features_name'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Features Information has been deleted.');
            redirect('features_setting');
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Features Information.');
            redirect('features_setting');
        }
    }


    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Features Setting";
        $this->db->insert('igc_user_logs', $insert);
    }


     public function rmv_features()
    {
        
        if($this->input->post())
        {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->delete('igc_features_setting');

            echo "success";


        }
    }



}