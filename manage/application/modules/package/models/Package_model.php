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
        $this->db->order_by('package_id','desc');
        $result = $this->db->get('igc_package')->result_array();
        return $result;
    }

    public function get_package_detail($package_id)
    {

      $this->db->where('delete_status','0'); 
        $this->db->where('package_id', $package_id);
        $result =  $this->db->get('igc_package')->row_array();
        return $result;
    }

    public function get_active_package_category()
    {

        $this->db->where('delete_status','0');
        $this->db->where('publish_status',"1");
        $result =  $this->db->get('igc_package_category')->result_array();
        return $result;
    }
     
    public function get_current_categories($id)
    {
        $q     = "SELECT category_id from igc_category_packages where package_id= $id";
        $query = $this->db->query($q);
        return $query->result_array();
    }

    public function check_name_exist($package_url, $package_id)
   {

       $this->db->where('package_url', $package_url)->where('package_id <>', $package_id)->where('delete_status','0');
       $row = $this->db->get('igc_package')->row_array();

       return $row;
   }

    public function get_package_price($package_id)
    {
        $this->db->where('package_id', $package_id);
        $result = $this->db->get('igc_package_price')->result_array();
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


    //function to delete package price

    public function delete_package_price($package_id)
    {
        $this->db->where('package_id', $package_id);
        $result = $this->db->delete('igc_package_price');
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
        $query = $this->db->query("select pb.booking_id, pb.package_id, pb.reference_no, pb.trip_type,pb.arrival_date,pb.created, pb.booking_status,c.email,c.first_name,c.middle_name, c.last_name
         from igc_package_booking pb join igc_package_customer c on pb.customer_id = c.customer_id where pb.delete_status = '0'");
        $result = $query->result_array();
        return $result;
    }



    //function get booking detail

    public function booking_detail($booking_id)
    {
        $query = $this->db->query("select pb.booking_id,pb.booking_status, pb.reference_no,pb.amount,pb.total_amount,p.package_name, c.code, pc.email,pc.first_name, pc.customer_id from igc_package_booking pb join igc_package p on pb.package_id = p.package_id join
         igc_currency_setting c on pb.currency_id = c.currency_id join igc_package_customer pc on pb.customer_id = pc.customer_id where pb.booking_id = '$booking_id' ");
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
        $result = $this->db->update('igc_package_customer', $update);
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
        join igc_accommodation_setting a on pb.accommodation_id =  a.accommodation_id join igc_package_customer pc
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

    //function to check tag and insert

    public function insert_tags($tags, $package_id)
    {
        foreach($tags as $row => $value)
        {
            if($value !="")
            {

                $this->db->where('term_name', $value);
                $result = $this->db->get('igc_taxonomy_terms')->row_array();

                if(!empty($result))
                {
                    $this->db->where('term_id', $result['term_id']);
                    $this->db->where('package_id', $package_id);
                    $records = $this->db->get('igc_package_tags')->row_array();
                    if(empty($records))
                    {
                        $data['term_id'] = $result['term_id'];
                        $data['package_id'] = $package_id;
                        $this->db->insert('igc_package_tags', $data);
                    }


                }
                else{

                    $insert['term_name'] = $value;
                    $this->db->insert('igc_taxonomy_terms', $insert);
                    $term_id = $this->db->insert_id();
                    $data['term_id'] = $term_id;
                    $data['package_id'] = $package_id;
                    $this->db->insert('igc_package_tags', $data);
                }
            }

        }
    }


    //function get added tags of package

    public function get_added_tags($package_id)
    {

        $query = $this->db->query("select tt.term_id,tt.term_name from igc_taxonomy_terms tt join igc_package_tags pt on tt.term_id = pt.term_id
         where pt.package_id = '$package_id'");
        $result = $query->result_array();
        return $result;

    }

    //function to get available tags

    public function get_available_tags($package_id)
    {

        $query = $this->db->query("select term_id, term_name from igc_taxonomy_terms where term_id not in(select term_id from igc_package_tags where package_id = '$package_id');");
        $result = $query->result_array();
        return $result;

    }


    //function to check the album exist

    public function check_album_exist($package_id, $album_id)
    {
        $this->db->where('package_id', $package_id);
        $this->db->where('album_id', $album_id);
        $result = $this->db->get('igc_package_album')->row_array();
        return $result;
    }










}