<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package_transaction extends MX_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();

        $this->load->model('transaction_model','pTransaction');
    }

    public function index()
    {
        $data['transaction'] = $this->pTransaction->get_all_transaction();
        // print_r($data['transaction']);
        // exit;
        $data['title']= "Package Transaction";
        $this->load->view('header', $data);
        $this->load->view('transaction_list');
        $this->load->view('footer');
    }

    public function paypal()
    {
        $data['paypal'] = $this->pTransaction->get_all_paypal_transaction();
        // print_r($data['paypal']);
        // exit;
        $data['title']= "Package Transaction";
        $this->load->view('header', $data);
        $this->load->view('paypal_list');
        $this->load->view('footer');
    }

    public function delete($transaction_id)
    {
     $booking = $this->pTransaction->get_booking_id($transaction_id);
     $booking_id = $booking['booking_id'];
    }
}
