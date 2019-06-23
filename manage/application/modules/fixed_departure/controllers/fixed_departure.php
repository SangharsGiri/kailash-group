<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fixed_departure extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');
        $this->load->model('departure_model', 'departure');

    }

    public  $table = "igc_package_departure";
    public $field_name = "departure_id";
    public  $redirect = "fixed_departure";



    public function index($package_id)
    {
        $data['records'] = $this->departure->get_departures($package_id);

        $data['title']= "Departure List";
        $data['package_id']= $package_id;
        $this->load->view('header', $data);
        $this->load->view('departure_list');
        $this->load->view('footer');
    }


    public function form($package_id, $id=0)
    {
        if($this->input->post())
        {

//            print_r($this->input->post());
//            exit();

            $departure_id = $this->input->post('departure_id');
            $insert['package_id']= $this->input->post('package_id');
            $insert['departure_date'] =  date("Y-m-d",strtotime($this->input->post('departure_date')));
            $insert['available_no'] = $this->input->post('available_no');
            $insert['accommodation_id'] = $this->input->post('accommodation_id');
            $insert['publish_status'] = $this->input->post('publish_status');
            $currency =   $this->input->post('currency_id');
            $price =   $this->input->post('price');
            $show_front = $this->input->post('show_front');


            if($departure_id =="")
            {
                $insert['delete_status'] = "0";
                $insert['created'] = date('Y-m-d:H:i:s');
                $result = $this->crud->insert_return_id($insert, $this->table);
                if($result)
                {
                    if(! empty($currency))
                    {
                        foreach ($currency as $pk => $value)
                        {
                            $inserts['departure_id'] = $result;
                            $inserts['currency_id'] = $value;
                            if($price[$value] !="")
                            {
                                $inserts['price'] = $price[$value];
                                $inserts['show_front'] = (isset($show_front[$value]))? "Y":"N" ;
                                $this->crud->insert($inserts,'igc_departure_price');

                            }
                        }
                    }
                    //code to create log
                    $log['module_title']=  "Departure Date"." ".$insert['departure_date'];
                    $log['action_id']= "1";
                    $this->create_log($log);


                    $this->session->set_flashdata('success','New Fixed Departure has been added.');
                    redirect($this->redirect.'/'.$package_id);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add New Fixed Departure');
                    redirect($this->redirect.'/'.$package_id);
                }

            }
            else{

                $insert['updated'] = date('Y-m-d:H:i:s');

                $result = $this->crud->update($departure_id, $this->field_name, $insert, $this->table);
                if($result)
                {
                    if(! empty($currency))
                    {
                        $this->crud->delete($departure_id, $this->field_name, 'igc_departure_price');
                        foreach ($currency as $pk => $value)
                        {
                            $inserts['departure_id'] = $departure_id;
                            $inserts['currency_id'] = $value;
                            if($price[$value] !="")
                            {
                                $inserts['price'] = $price[$value];
                                $inserts['show_front'] = (isset($show_front[$value]))? "Y":"N" ;
                                $this->crud->insert($inserts,'igc_departure_price');

                            }
                        }
                    }
                    //code to create log
                    $log['module_title']=  "Departure Date"." ".$insert['departure_date'];
                    $log['action_id']= "2";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','Fixed Departure has been updated.');
                    redirect($this->redirect.'/'.$package_id);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the Fixed Departure.');
                    redirect($this->redirect.'/'.$package_id);
                }

            }


        }

        $data['accommodations'] = $this->departure->get_accommodations();

        $data['detail'] = $this->crud->get_detail($id, $this->field_name, $this->table);
        $data['styles'] = array('themes/css/jquery-ui');
        $data['scripts'] = array('themes/js/jquery-ui','themes/js/form-validator');
        $data['title']= "Add/Edit Departure";
        $data['package_id']= $package_id;
        $this->load->view('header', $data);
        $this->load->view('departure_form');
        $this->load->view('footer');
    }



    //function to delete

    public function delete($package_id, $id)
    {

         $this->crud->delete($id, $this->field_name, 'igc_departure_price');
        $detail = $this->crud->get_detail($id, $this->field_name, $this->table);
        $result = $this->crud->soft_delete($id, $this->field_name, $this->table);
        if($result)
        {

            //code to create log
            $log['module_title']=  "Departure Date"." ".$detail['departure_date'];
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Fixed Departure has been deleted.');
            redirect($this->redirect.'/'.$package_id);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Fixed Departure.');
            redirect($this->redirect.'/'.$package_id);
        }

    }


//function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Fixed Departure";
        $this->db->insert('igc_user_logs', $insert);
    }



}

