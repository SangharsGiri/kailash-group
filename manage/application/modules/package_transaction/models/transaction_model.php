<?php
class Transaction_model extends  CI_Model
{

    public function get_all_transaction()
    {

        $query = $this->db->query("select pt.id,pt.amount as trans_amount,pt.paymentMeanBrand,pt.paymentMeanType,pt.transactionDateTime,pt.booking_code,c.*,pb.*,cs.code,a.name,p.package_name,p.package_duration from igc_package_atos_transaction pt join igc_package_booking pb
         on pt.booking_code = pb.booking_code join igc_accommodation_setting a on pb.accommodation_id = a.accommodation_id join
         igc_currency_setting cs on pb.currency_id = cs.currency_id join igc_site_users c on pb.customer_id = c.customer_id join igc_package p on pb.package_id = p.package_id order by pt.id desc
         ");
        $result = $query->result_array();
        return $result;

    }

    public function get_all_paypal_transaction()
    {

        $query = $this->db->query("select pp.id,pp.transaction_id,pp.payment_amount,pp.payment_status as pay_status,pp.payer_email,pp.payment_through,pp.booking_code,c.*,pb.*,cs.code,a.name,p.package_name,p.package_duration from igc_package_paypal_transaction pp join igc_package_booking pb
         on pp.booking_code = pb.booking_code join igc_accommodation_setting a on pb.accommodation_id = a.accommodation_id join
         igc_currency_setting cs on pb.currency_id = cs.currency_id join igc_site_users c on pb.customer_id = c.customer_id join igc_package p on pb.package_id = p.package_id order by pp.id desc
         ");
        $result = $query->result_array();
        return $result;

    }

    public function get_booking_id($transaction_id)
    {
        $this->db->select('booking_id');
        $this->db->where('transaction_id', $transaction_id);
        $result = $this->db->get('igc_package_transaction')->row_array();
        return $result;
    }

   //function to change delete status of booking

    public function delete_booking($booking_id)
    {
        $update['delete_status'] = "1";
        $update['updated']= date('Y-m-d:H:i:s');
        $this->db->where('booking_id', $booking_id);
        $result = $this->db->update('igc_package_booking', $booking_id);
        if($result)
        {
            return $result;
        }
        else{
            return false;
        }
    }


    //function to change delete status of transaction

//    public function delete_transaction($trasaction_id)
//    {
//        $update['delete_status'] = "1";
//        $update['updated']= date('Y-m-d:H:i:s');
//        $this->db->where('booking_id', $booking_id);
//        $result = $this->db->update('igc_package_booking', $booking_id);
//        if($result)
//        {
//            return $result;
//        }
//        else{
//            return false;
//        }
//    }
}