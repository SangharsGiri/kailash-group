<?php
class Package_model extends  CI_Model
{
    public function count_total_package()
    {
        $result = $this->db->get('igc_package')->num_rows();
        return $result;
    }

    public function get_package_list()
    {
        $this->db->where('delete_status','0');
        $result = $this->db->get('igc_package')->result_array();
        return $result;
    }

    public function get_package_detail($package_id)
    {

        $query =  $this->db->query("select p.*, c.category_code from igc_package p join igc_package_category c on p.category_id =  c.category_id where p.package_id = '$package_id' and  p.delete_status = '0'");
        $result =  $query->row_array();
        return $result;
    }

    public function get_package_price($package_id)
    {
        $this->db->where('package_id', $package_id);
        $result = $this->db->get('igc_package_price')->result_array();
        return $result;
    }
    public function get_package_itinerary($package_id)
    {
        $this->db->where('package_id', $package_id);
        $result = $this->db->get('igc_itinerary')->result_array();
        return $result;
    }

    public  function get_each_price($package_id,$accommodation_id, $currency_id){

        $query =  $this->db->query("select pprice, is_front from igc_package_price where package_id = '$package_id'
         and accommodation_id = '$accommodation_id' and currency_id = '$currency_id'");

        $result = $query->row_array();
        return $result;
    }


    public  function  get_accommodations()
    {
        $this->db->where('status','1');
        $result = $this->db->get('igc_accommodation_setting')->result_array();
        return $result;
    }

    public  function  get_currencies()
    {
        $this->db->where('status','1');
        $result = $this->db->get('igc_currency_setting')->result_array();
        return $result;
    }

    public function insert_package($insert){
         $this->db->insert('igc_package', $insert);
        $result =  $this->db->insert_id();
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }


    public function update_package($insert, $package_id){
        $this->db->where('package_id', $package_id);
        $result = $this->db->update('igc_package', $insert);

        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }



    public function insert_package_price($insert){
      $result =  $this->db->insert('igc_package_price', $insert);

        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }

    public function insert_package_itinerary($insert){
        $result =  $this->db->insert('igc_itinerary', $insert);

        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }


    public function update_package_itinerary($insert, $package_id , $id){

        $this->db->where('id', $id);
        $this->db->where('package_id', $package_id);
        $result =  $this->db->update('igc_itinerary', $insert);

        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }


    //function to delete all package ininerary


    public function delete_itinerary($package_id)
    {
        $this->db->where('package_id', $package_id);
        $result = $this->db->delete('igc_itinerary');
        return $result;
    }


    //function to delete package price

    public function delete_package_price($package_id)
    {
        $this->db->where('package_id', $package_id);
        $result = $this->db->delete('igc_package_price');
        return $result;
    }


    //function to get all package category


    public function get_all_categories()
    {
        $this->db->select('category_name');
        $this->db->select('category_code');
        $result = $this->db->get('igc_package_category')->result_array();
        return $result;
    }


    //get category id

    public function get_category_id($code)
    {
        $this->db->select('category_id');
        $this->db->where('category_code', $code);
        $result = $this->db->get('igc_package_category')->row_array();
        return $result;
    }

    //function to get all outbound categories

    public function get_outbound_categories()
    {
        $query = $this->db->query("select sc.sub_category_id, sc.sub_category_name from igc_package_subcategory sc join igc_package_category c on
        sc.category_id = c.category_id where c.category_code = 'OB'");
        $result = $query->result_array();
        return $result;
    }


    //function to get all inbound categories

    public function get_inbound_categories()
    {
        $query = $this->db->query("select sc.sub_category_id, sc.sub_category_name from igc_package_subcategory sc join igc_package_category c on
        sc.category_id = c.category_id where c.category_code = 'IB'");
        $result = $query->result_array();
        return $result;
    }



    //function to delete package

    public function delete_package($package_id)
    {
        $update['delete_status'] = "1";
        $update['updated'] = date('Y-m-d:H:i:s');
        $this->db->where('package_id', $package_id);
        $result = $this->db->update('igc_package', $update);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }



   //function get booking list

    public function get_all_package_booking()
    {
        $query = $this->db->query("select pb.booking_id,pb.package_type, pb.package_id, pb.reference_no, pb.trip_type,pb.arrival_date,pb.created, pb.booking_status,c.email,c.first_name,c.middle_name, c.last_name
         from igc_package_booking pb join igc_site_users c on pb.customer_id = c.customer_id where pb.delete_status = '0' order by pb.booking_id desc ");
        $result = $query->result_array();
        return $result;
    }



    //function get booking detail

    public function booking_detail($booking_id)
    {
        $query = $this->db->query("select pb.booking_id,pb.booking_status,pb.package_type, pb.reference_no,pb.amount,pb.total_amount,p.package_name, c.code, pc.email,pc.first_name, pc.customer_id from igc_package_booking pb join igc_package p on pb.package_id = p.package_id join
         igc_currency_setting c on pb.currency_id = c.currency_id join igc_site_users pc on pb.customer_id = pc.customer_id where pb.booking_id = '$booking_id' ");
        $result = $query->row_array();
        return $result;
    }

    //function to update booking


    public function booking_update($booking_id,$customer_id, $update)
    {
        $this->db->where('booking_id', $booking_id);
        $this->db->where('customer_id', $customer_id);
        $result = $this->db->update('igc_package_booking', $update);
        if($result)
        {
            return true;
        }
        else{
            return false;
        }
    }


    //code to update customer info

    public function customer_update($customer_id, $update)
    {
        $this->db->where('customer_id', $customer_id);
        $result = $this->db->update('igc_site_users', $update);
        if($result)
        {
            return true;
        }
        else{
            return false;
        }
    }




    //function to get booking package detail

    public function booking_package_detail($booking_id)
    {
        $query = $this->db->query("select pb.*,pc.*,p.package_id,p.package_name,p.package_duration, a.name,
      c.code from igc_package_booking pb
        join igc_accommodation_setting a on pb.accommodation_id =  a.accommodation_id join igc_site_users pc
         on pb.customer_id = pc.customer_id join igc_package p on pb.package_id = p.package_id join igc_currency_setting c on
         pb.currency_id = c.currency_id where pb.booking_id = '$booking_id'");
        $result = $query->row_array();
        return $result;
    }

    //function to get booking package detail

    public function booking_package_fixed_detail($booking_id)
    {
        $query = $this->db->query("select pb.*,pc.*,p.package_id,p.package_name,p.package_duration,
      c.code from igc_package_booking pb join igc_site_users pc
         on pb.customer_id = pc.customer_id join igc_package p on pb.package_id = p.package_id join igc_currency_setting c on
         pb.currency_id = c.currency_id where pb.booking_id = '$booking_id'");
        $result = $query->row_array();
        return $result;
    }



    //function to check booking status

    public function check_booking_status($booking_id)
    {
        $this->db->select('booking_status');
        $this->db->where('booking_id', $booking_id);
        $result = $this->db->get('igc_package_booking')->row_array();
        return $result;

    }


    //function get package price

    public function get_pprice($package_id, $accommodation_id)
    {
        $query = $this->db->query("select c.code, pp.currency_id, pp.pprice from igc_package_price pp join igc_currency_setting c on
        pp.currency_id = c.currency_id where pp.package_id = '$package_id' and pp.accommodation_id = '$accommodation_id'");
        $result = $query->result_array();
        return $result;
    }

//function get_package accommodation

    public function  get_package_accommodation($package_id)
    {
        $query= $this->db->query("select a.accommodation_id, a.name from igc_accommodation_setting a join igc_package_price pp on
        a.accommodation_id = pp.accommodation_id where pp.package_id = '$package_id' group by pp.accommodation_id");
        $result = $query->result_array();
        return $result;

    }







}