<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forex extends MX_Controller{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $this->load->model('crud_model', 'crud');


    }

    public  $table = "igc_forex_index";
    public $field_name = "forex_id";
    public  $redirect = "forex";



    public function index()
    {

        $data['records'] = $this->crud->get_not_deleted($this->table);
        $data['title']= "Forex List";
        $this->load->view('header', $data);
        $this->load->view('forex_list');
        $this->load->view('footer');
    }


    public function form($id="")
    {
        if($this->input->post())
        {
            // print_r($this->input->post());
            // exit;
            $forex_id =  $this->input->post('forex_id');

            $currency = $this->input->post('currency');
            // print_r($currency);
       
            $currency_code = $this->input->post('currency_code');
            $unit = $this->input->post('unit');
            $buying_rate = $this->input->post('buying_rate');
            $selling_rate = $this->input->post('selling_rate');
            $publish_status = $this->input->post('publish_status');
           

            if($forex_id =="")
            {
                $insert['forex_date']=  date("Y-m-d",strtotime($this->input->post('forex_date')));
                $insert['delete_status'] = "0";
                $insert['created']= date('Y-m-d:H:i:s');

                $result = $this->crud->insert_return_id($insert, $this->table);
                // print_r($result);
                // exit;
                if($result)
                {
                    //code to insert forex detail

                    foreach($currency as $pk=> $value)
                    {
                        
                        $inserts['forex_id']= $result;
                        $inserts['currency'] = $value;
                        $inserts['currency_code']= $currency_code[$pk];
                        $inserts['unit']= (isset($unit[$pk]) && $unit[$pk] !="")?$unit[$pk]:"0";
                        $inserts['buying_rate']= (isset($buying_rate[$pk]) && $buying_rate[$pk] !="")?$buying_rate[$pk]:"0";
                        $inserts['selling_rate']= (isset($selling_rate[$pk]) && $selling_rate[$pk] !="")?$selling_rate[$pk]:"0";
                        $inserts['publish_status'] = (isset($publish_status[$pk]) && $publish_status[$pk] !="")?$publish_status[$pk]:"0" ;

                        // print_r($inserts['publish_status']);
                        // print_r($inserts['forex_id']);
                        // print_r($inserts['currency']);
                        // print_r($inserts['currency_code']);
                        // print_r($inserts['unit']);
                        // print_r($inserts['buying_rate']);
                        // print_r($inserts['selling_rate']);
                        // echo " ";
                         $this->crud->insert($inserts, 'igc_forex_detail');

                    }
                    //exit;
                    

                    //code to create log
                    $log['module_title']= "Forex" ."(". $insert['forex_date'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);


                    $this->session->set_flashdata('success','Forex has been added.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to add Forex');
                    redirect($this->redirect);
                }

            }


        }


        $data['records'] =  $this->crud->get_detail_rows($id, 'forex_id', 'igc_forex_detail');

        $last_id_detail = $this->crud-> get_row_last_id('id', 'igc_forex_detail');

        if(empty($last_id_detail))
        {
         $data['last_id']= "0";
        }
        else
        {
          $data['last_id'] =  $last_id_detail['id'];
        }


        $data['styles'] = array('themes/css/jquery-ui');
        $data['scripts'] = array('themes/js/jquery-ui','themes/js/form-validator');

        $data['title']= "Add/Edit Forex";
        $data['forex_id'] =  $id;
        $this->load->view('header', $data);
        $this->load->view('forex_form');
        $this->load->view('footer');
    }

    public function edit($id='')
    {
        if($this->input->post())
        {
            $forex_id =  $this->input->post('forex_id');

            $currency = $this->input->post('currency');
            $currency_code = $this->input->post('currency_code');
            $unit = $this->input->post('unit');
            $buying_rate = $this->input->post('buying_rate');
            $selling_rate = $this->input->post('selling_rate');
            $publish_status = $this->input->post('publish_status');


            if($forex_id =="")
            {
               
                $forex_inserts['updated'] = date('Y-m-d:H:i:s');
                $result = $this->crud->update($forex_id, $this->field_name, $forex_inserts, $this->table);

                if($result)
                {
                    $delete = $this->crud->delete($forex_id, $this->field_name, 'igc_forex_detail');
                    if($delete)
                    {
                        foreach($currency as $pk=> $value)
                        {
                            $inserts['forex_id']= $result;
                            $inserts['currency'] = $value;
                            $inserts['currency_code']= $currency_code[$pk];
                            $inserts['unit']= (isset($unit[$pk]) && $unit[$pk] !="")?$unit[$pk]:"0";
                            $inserts['buying_rate']= (isset($buying_rate[$pk]) && $buying_rate[$pk] !="")?$buying_rate[$pk]:"0";
                            $inserts['selling_rate']= (isset($selling_rate[$pk]) && $selling_rate[$pk] !="")?$selling_rate[$pk]:"0";
                            $inserts['publish_status'] = (isset($publish_status[$pk]))?$publish_status[$pk]:"0" ;


                           $this->crud->insert($inserts, 'igc_forex_detail');

                        }
                    }
                    else{
                        $this->session->set_flashdata('error','Unable to update the Forex.');
                        redirect($this->redirect);
                    }

                    //code to create log
                    $log['module_title']= "Forex" ."(". $insert['forex_date'].")";
                    $log['action_id']= "1";
                    $this->create_log($log);


                    $this->session->set_flashdata('success','Forex has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update Forex');
                    redirect($this->redirect);
                }

            }
            else{


                $forex_inserts['updated'] = date('Y-m-d:H:i:s');

                $result = $this->crud->update($forex_id, $this->field_name, $forex_inserts, $this->table);
                if($result)
                {



                    $delete = $this->crud->delete($forex_id, $this->field_name, 'igc_forex_detail');

                    if($delete)
                    {
                        foreach($currency as $pk=> $value)
                        {
                            $inserts['forex_id']=  $forex_id;
                            $inserts['currency'] = $value;
                            $inserts['currency_code']= $currency_code[$pk];
                            $inserts['unit']= (isset($unit[$pk]) && $unit[$pk] !="")?$unit[$pk]:"0";
                            $inserts['buying_rate']= (isset($buying_rate[$pk]) && $buying_rate[$pk] !="")?$buying_rate[$pk]:"0";
                            $inserts['selling_rate']= (isset($selling_rate[$pk]) && $selling_rate[$pk] !="")?$selling_rate[$pk]:"0";
                            $inserts['publish_status'] = (isset($publish_status[$pk]))? $publish_status[$pk]:"0";

                            $this->crud->insert($inserts, 'igc_forex_detail');

                        }
                    }
                    else{
                        $this->session->set_flashdata('error','Unable to update the Forex.');
                        redirect($this->redirect);
                    }

                    $forex_detail =  $this->crud->get_detail($forex_id, $this->field_name, $this->table);
                    //code to create log
                    $log['module_title']= "Forex" ."(". $forex_detail['forex_date'].")";
                    $log['action_id']= "2";
                    $this->create_log($log);

                    $this->session->set_flashdata('success','Forex has been updated.');
                    redirect($this->redirect);
                }
                else{
                    $this->session->set_flashdata('error','Unable to update the Forex.');
                    redirect($this->redirect);
                }

            }


        }


        $data['records'] =  $this->crud->get_detail_rows($id, 'forex_id', 'igc_forex_detail');

        $last_id_detail = $this->crud-> get_row_last_id('id', 'igc_forex_detail');

        if(empty($last_id_detail))
        {
         $data['last_id']= "0";
        }
        else
        {
          $data['last_id'] =  $last_id_detail['id'];
        }


        $data['styles'] = array('themes/css/jquery-ui');
        $data['scripts'] = array('themes/js/jquery-ui','themes/js/form-validator');

        $data['title']= "Add/Edit Forex";
        $data['forex_id'] =  $id;
        $this->load->view('header', $data);
        $this->load->view('forex_edit');
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
            $log['module_title']=  "Forex"."(".$detail['forex_date'].")";
            $log['action_id']= "3";
            $this->create_log($log);

            $this->session->set_flashdata('success','Forex has been deleted.');
            redirect($this->redirect);
        }
        else{
            $this->session->set_flashdata('error','Unable to delete the Forex.');
            redirect($this->redirect);
        }

    }


//function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Forex";
        $this->db->insert('igc_user_logs', $insert);
    }



}

