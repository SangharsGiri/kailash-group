<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package_booking extends MX_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        is_already_logged_in();
        $permission = $this->session->userdata('permission');

        if($permission == "1")
        {
            redirect('dashboard');
        }
           $this->load->model('crud_model','crud');
          $this->load->model('package_model','package');
          $this->load->model('site_settings_model','site_settings');
          $this->load->model('mail_setting/mail_setting_model','server');

          $this->load->library('encrypt');
    }

    public function index()
    {
        $data['booking'] = $this->package->get_all_package_booking();
        $data['title']= "Booked Packaged";
        $this->load->view('header', $data);
        $this->load->view('booking_list');
        $this->load->view('footer');
    }


    public function accept($booking_id)
    {

        $booking_data = $this->package->booking_detail($booking_id);

        $status = $booking_data['booking_status'];

        if($status == "pending")
        {
            $rand =  date('Y-m-d').rand().date('H:i:s');

            $md5 = md5($rand);

            $this->send_accept_mail($booking_data, $md5);


        }
        else{
            $this->session->set_flashdata('error','Unable to change the Booking Status');
            redirect('package_booking');

        }




    }

    //code to cancel the booking

    public function cancel($booking_id)
    {

        $booking_data = $this->package->booking_detail($booking_id);

        $status = $booking_data['booking_status'];

        if($status == "pending")
        {
           $this->send_cancel_mail($booking_data);
        }
        else{
            $this->session->set_flashdata('error','Unable to change the Booking Status');
            redirect('package_booking');

        }

    }

    //code to delete the booking

    public function delete($booking_id)
    {

        $booking_data = $this->package->booking_detail($booking_id);

        $status = $booking_data['booking_status'];

        if($status == "rejected" || $status =="cancelled")
        {
            $update['delete_status'] = '1';
            $update['updated'] = date('Y-m-d:H:i:s');
            $customer_id = $booking_data['customer_id'];
            $result =  $this->package->booking_update($booking_id,$customer_id, $update);

            if($result)
            {
                //code to create log
                $log['module_title']= "Reference No" . " "."(". $booking_data['reference_no'].")";
                $log['action_id']= "3";
                $this->create_log($log);

                $this->session->set_flashdata('success','Booking has been deleted');
                redirect('package_booking');

            }
            else{
                $this->session->set_flashdata('error','Unable to delete the Booking');
                redirect('package_booking');

            }
        }
        else{
            $this->session->set_flashdata('error','Unable to change the Booking Status');
            redirect('package_booking');

        }

    }


    //code to edit booking

    public function edit($booking_id)
    {
        $booking_data = $this->package->booking_detail($booking_id);

        $status = $booking_data['booking_status'];

        if($status == "pending")
        {
        if($this->input->post())
        {

            $insert['updated'] = date('Y-m-d:H:i:s');
            $insert['calculation_type'] = $this->input->post('calculation_type');
            $insert['edited_amount'] = $this->input->post('edited_amount');
            $insert['total_amount'] = $this->input->post('total_amount');
            $booking_id = $this->input->post('booking_id');
            $customer_id = $this->input->post('customer_id');
            $result = $this->package->booking_update($booking_id,$customer_id, $insert);

            if($result)
            {
              $this->booking_edited_mail($booking_id);
            }
            else{
                $this->session->set_flashdata('error', 'Unable to update booking changes.');
                redirect('packing_booking');
            }




        }


            $package_type = $this->crud->get_detail($booking_id, 'booking_id','igc_package_booking');

            if($package_type['package_type']=="Normal")
            {
                $data['booking'] = $this->package->booking_package_detail($booking_id);

            }
            else {
                $data['booking'] = $this->package->booking_package_fixed_detail($booking_id);

            }

        $data['title']= "Booking Edit";
        $this->load->view('header', $data);
        $this->load->view('booking_edit');
        $this->load->view('footer');
        }
        else{
            $this->session->set_flashdata('error','You cannot change the booking information ');
            redirect('package_booking');
        }
    }




    //function to send booking accepted email

    public function send_accept_mail($booking_data, $md5)
    {

       $site_settings = $this->site_settings->get_site_settings();


        $environment =  ENVIRONMENT;
        if($environment == "development")
        {
            $server_url = $site_settings['site_url'].'/index.php/payment/index/'.$md5;
        }
        else{
            $server_url =  $site_settings['site_url'].'/payment/index/'.$md5;
        }

        $server = $this->server->active_mail_server();



        $password = $this->encrypt->decode($server['password']);


        $email = $booking_data['email'];

        $this->load->library('mailer');

        $mail  = new PHPMailer();

        //$body = file_get_contents('https://www.rupakottravels.com/photo-contest.html');


        $body = '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>'.$site_settings['site_name'].' Booking Accepted</title>
</head>

<body>
<div style="width:580px;margin:0 auto;font:12px Arial,Helvetica,sans-serif;background:#fff">

     <div style="margin:0 0 10px"> <img alt="Rupakot Tours and Travels Pvt. Ltd." src="'.$site_settings['site_url'].'themes/images/logos/navbar-logo.png"> </div>
    <p>Dear '.$booking_data['first_name'].'</p>

    <table width="100%" cellspacing="0" cellpadding="5" border="0">

        <tbody>
         <tr>
            <td style="border-bottom:1px solid #800000">Reference Number:</td>
            <td style="border-bottom:1px solid #800000"> '.$booking_data['reference_no'].'</td>
        </tr>
        <tr>
           <p> Your booking ('.$booking_data['package_name'].') has been accepted.
          In order to confirm your booking please click the payment Link. '.'<a href="'.$server_url.'">'.$server_url.'</a>'.'</p>
        </tr>


        <tr>
            <td colspan="2" style="background:#800000; text-align:left;">Thanks and Regards,<br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="www.rupakottravels.com" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
        </tr>
        <tr>
            <td colspan="2" style="background:#800000; text-align:left;"><br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="http://rupakottravels.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
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

        $mail->Subject    = $site_settings['site_name']." Booking Accepted";


        $mail->MsgHTML($body);

        $address = $email;

        $mail->AddAddress($address, $site_settings['site_name']);

        if(!$mail->Send())
        {
            $this->session->set_flashdata('error', 'Unable to Send Booking Accepted Email.Please Check Your Internet Connection.');
            redirect('package_booking');

        }

        else{

            //code to send booking accept mail for admins

            $data['type'] ="Booking Accept";
            $data['title'] = " Booking Accept";
            $data['reference_no']= $booking_data['reference_no'];
            $data['message'] ="A booking of package (".$booking_data['package_name']. ") has been accepted";

            $this->admin_info_mail($data);

            $update['hash_code'] = $md5;
            $update['booking_status'] = 'accepted';
            $update['updated'] = date('Y-m-d:H:i:s');
            $booking_id = $booking_data['booking_id'];
            $customer_id = $booking_data['customer_id'];
            $result = $this->package->booking_update($booking_id,$customer_id,$update);

            if($result)
            {
                //code to create log
                $log['module_title']= "Reference No" . " "."(". $data['reference_no'].")";
                $log['action_id']= "2";
                $this->create_log($log);

                $this->session->set_flashdata('success', 'Booking has been accepted.');
                redirect('package_booking');
            }
            else{
                $this->session->set_flashdata('error', 'Unable to accept Booking');
                redirect('package_booking');
            }
        }


    }



//code to send booking cancel email


    public function send_cancel_mail($booking_data)
    {

        $email = $booking_data['email'];

        $this->load->library('mailer');

        $mail  = new PHPMailer();

        //$body = file_get_contents('https://www.rupakottravels.com/photo-contest.html');

        $site_settings = $this->site_settings->get_site_settings();

        $server = $this->server->active_mail_server();

        $password = $this->encrypt->decode($server['password']);

        $body = '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>'.$site_settings['site_name'].' Booking Cancelled</title>
</head>

<body>
<div style="width:580px;margin:0 auto;font:12px Arial,Helvetica,sans-serif;background:#fff">
   <div style="margin:0 0 10px"> <img alt="Rupakot Tours and Travels Pvt. Ltd." src="'.$site_settings['site_url'].'themes/images/logos/navbar-logo.png"> </div>
    <p>Dear '.$booking_data['first_name'].'</p>

    <table width="100%" cellspacing="0" cellpadding="5" border="0">

        <tbody>
         <tr>
            <td style="border-bottom:1px solid #800000">Reference Number:</td>
            <td style="border-bottom:1px solid #800000"> '.$booking_data['reference_no'].'</td>
        </tr>
        <tr>
           <p>A booking of ('.$booking_data['package_name'].') has been cancelled.
      </p>
        </tr>


            <tr>
            <td colspan="2" style="background:#800000; text-align:left;">Thanks and Regards,<br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="www.rupakottravels.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
        </tr>
        <tr>
            <td colspan="2" style="background:#800000; text-align:left;"><br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="http://rupakottravels.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
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

        $mail->Subject    = $site_settings['site_name']." Booking Cancel";


        $mail->MsgHTML($body);

        $address = $email;

        $mail->AddAddress($address, $server['send_from_name']);


        if(!$mail->Send())
        {
            $this->session->set_flashdata('error', 'Unable to Send Booking Cancel Email.Please Check Your Internet Connection.');
            redirect('package_booking');

        }

        else{

            //code to send info mail for admin
            $data['type'] ="Booking Cancel";
            $data['title'] = " Booking Cancel";
            $data['reference_no']= $booking_data['reference_no'];
            $data['message'] ="A booking of package (".$booking_data['package_name']. ") has been Cancelled";
            $this->admin_info_mail($data);

            $update['booking_status'] = 'rejected';
            $update['updated'] = date('Y-m-d:H:i:s');
            $booking_id = $booking_data['booking_id'];
            $customer_id = $booking_data['customer_id'];
            $result = $this->package->booking_update($booking_id,$customer_id,$update);

            if($result)
            {
                //code to create log
                $log['module_title']= "Reference No" . " "."(". $data['reference_no'].")";
                $log['action_id']= "2";
                $this->create_log($log);

                $this->session->set_flashdata('success', 'Booking has been Cancelled.');
                redirect('package_booking');
            }
            else{
                $this->session->set_flashdata('error', 'Unable to cancel this Booking');
                redirect('package_booking');
            }
        }


    }


    //function to send booking email

    public function booking_edited_mail($booking_id)
    {

        $this->load->library('mailer');

        $mail  = new PHPMailer();

        //$body = file_get_contents('https://www.rupakottravels.com/photo-contest.html');

        $type = "Booking";

        $site_settings = $this->site_settings->get_site_settings();

        $server = $this->server->active_mail_server();

        $password = $this->encrypt->decode($server['password']);

        $admin_mails = $this->server->get_admin_mails($type);

        $package_type = $this->crud->get_detail($booking_id, 'booking_id','igc_package_booking');

        if($package_type['package_type']=="Normal")
        {
            $session = $this->package->booking_package_detail($booking_id);
            $accommodation = $session['name'];
        }
        else
        {
            $session = $this->package->booking_package_fixed_detail($booking_id);
            $accommodation = "N/A";
        }

        $calculation_type = $session['calculation_type'];

        if($calculation_type == "+")
        {
            $type_heading = "Extra Charge";
        }
        else{
            $type_heading = "Discount Amount";
        }

        $body = '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>'.$site_settings['site_name'].' Booking Confirmation</title>
</head>

<body>
<div style="width:580px;margin:0 auto;font:12px Arial,Helvetica,sans-serif;background:#fff">
      <div style="margin:0 0 10px"><img alt="Rupakot Tours and Travels Pvt. Ltd." src="'.$site_settings['site_url'].'themes/images/logos/navbar-logo.png"> </div>
    <p align="center">Booking has been edited.</p>
    <h3 align="center">Booking Details</h3>
    <table width="100%" cellspacing="0" cellpadding="5" border="0">
        <tr>
            <td style="border-bottom:1px solid #800000">Reference Number</td>
            <td style="border-bottom:1px solid #800000"> '.$session['reference_no'].'</td>
        </tr>
        <tbody>
        <tr>
            <th style="background:#800000" colspan="2">Passenger Details</th>
        </tr>
        <tr>
            <td width="28%" style="border-bottom:1px solid #800000">Full Name</td>
            <td width="72%" style="border-bottom:1px solid #800000"> '.$session['first_name']." ".$session['middle_name'] ." ". $session['last_name'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Email</td>
            <td style="border-bottom:1px solid #800000">'.$session['email'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Phone No.</td>
            <td style="border-bottom:1px solid #800000">'.$session['contact_no'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Country</td>
            <td style="border-bottom:1px solid #800000">'.$session['country'] .'</td>
        </tr>
         <tr>
            <td style="border-bottom:1px solid #800000">City</td>
            <td style="border-bottom:1px solid #800000">'.$session['city'] .'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Passport No.</td>
            <td style="border-bottom:1px solid #800000">'.$session['passport_no'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Trip Type.</td>
            <td style="border-bottom:1px solid #800000">'.$session['trip_type'] .'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Additional Info.</td>
            <td style="border-bottom:1px solid #800000">'.$session['additional_info'] .'</td>
        </tr>
        <tr>
            <th style="background:#800000" colspan="2">Package Details</th>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Package Name</td>
            <td style="border-bottom:1px solid #800000">'. $session['package_name'] .'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Package Type</td>
            <td style="border-bottom:1px solid #800000">'. $session['package_type'] .'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Package Duration</td>
            <td style="border-bottom:1px solid #800000">'. $session['package_duration'] .'</td>
        </tr>
        <tr>

            <td style="border-bottom:1px solid #800000">Accommodation</td>
            <td style="border-bottom:1px solid #800000">'.$accommodation.'</td>
        </tr>


        <tr>
            <td style="border-bottom:1px solid #800000">Arrival Date : </td>
            <td style="border-bottom:1px solid #800000">'.$session['arrival_date'].'</td>
        </tr>


        <tr>
            <td style="border-bottom:1px solid #800000">Passenger</td>
            <td style="border-bottom:1px solid #800000">'.$session['no_of_person'] .'</td>
        </tr>
         <tr>
            <td style="border-bottom:1px solid #800000">Adult</td>
            <td style="border-bottom:1px solid #800000">'.$session['adult'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Children</td>
            <td style="border-bottom:1px solid #800000">'.$session['child'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Infant</td>
            <td style="border-bottom:1px solid #800000">'.$session['infant'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Extra Facility(that you request)</td>
            <td style="border-bottom:1px solid #800000">'.$session['extra_facility'].'</td>
        </tr>
            <tr>
            <td style="border-bottom:1px solid #800000">Additional Info</td>
            <td style="border-bottom:1px solid #800000">'.$session['additional_info'].'</td>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Referred By</td>
            <td style="border-bottom:1px solid #800000">'.$session['referedby'].'</td>
        </tr>
        <tr>
            <th style="background:#800000" colspan="2">Payment Details</th>
        </tr>
        <tr>
            <td style="border-bottom:1px solid #800000">Package Amount</td>
            <td style="border-bottom:1px solid #800000"> '.$session['amount']." ". $session['code'].'</td>
            </tr>
             <tr>
            <td style="border-bottom:1px solid #800000">'.$type_heading.'</td>
            <td style="border-bottom:1px solid #800000"> '.$session['edited_amount']." ". $session['code'].'</td>
            </tr>
            <tr>
             <td style="border-bottom:1px solid #800000">Total Amount</td>
            <td style="border-bottom:1px solid #800000"> '.$session['total_amount']." ". $session['code'].'</td>
        </tr>
        <tr>
            <th style="background:#800000" colspan="2">Note</th>
        </tr>
         <tr>
            <td colspan = "4" style="border-bottom:1px solid #800000">Your Booking information has been changed. If you have any queries Please contact us. </td>
        </tr>

         <tr>
            <td colspan="2" style="background:#800000; text-align:left;">Thanks and Regards,<br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="www.rupakottravels.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
        </tr>
        <tr>
            <td colspan="2" style="background:#800000; text-align:left;"><br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="http://rupakottravels.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
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

        $mail->Subject    = $site_settings['site_name']." Booking Edited";


        $mail->MsgHTML($body);

        $address = $session['email'];

        $mail->AddAddress($address, $server['send_from_name']);

        foreach($admin_mails  as $bcc)
        {
            $mail->AddBCC($bcc['email'], $bcc['full_name']);

        }

        if(!$mail->Send())
        {
            $this->session->set_flashdata('error', 'Unable to Send Booking Edited Email.Please Check Your Internet Connection.');
            redirect('package_booking');

        }
        else{
            //code to create log
            $log['module_title']= "Reference No" . " "."(". $session['reference_no'].")";
            $log['action_id']= "2";
            $this->create_log($log);

            $this->session->set_flashdata('success', 'Booking Edited Email has been send.');
            redirect('package_booking');
        }
    }


    // code to send admin info mail

    public function admin_info_mail($data)
    {



        $type = $data['type'];

        $site_settings = $this->site_settings->get_site_settings();

        $server = $this->server->active_mail_server();

        $password = $this->encrypt->decode($server['password']);

        $admin_mails = $this->server->get_admin_mails($type);



        $this->load->library('mailer');

        $mail  = new PHPMailer();

        //$body = file_get_contents('https://www.rupakottravels.com/photo-contest.html');


        $body = '<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>'.$site_settings['site_name']." ".$data['title'].'</title>
</head>

<body>
<div style="width:580px;margin:0 auto;font:12px Arial,Helvetica,sans-serif;background:#fff">
   <div style="margin:0 0 10px"> <img alt="Rupakot Tours and Travels Pvt. Ltd." src="'.$site_settings['site_url'].'themes/images/logos/navbar-logo.png"> </div>
    <p>Dear Admin</p>

    <table width="100%" cellspacing="0" cellpadding="5" border="0">

        <tbody>
          <tr>
            <td style="border-bottom:1px solid #800000">Reference Number:</td>
            <td style="border-bottom:1px solid #800000"> '.$data['reference_no'].'</td>
        </tr>
        <tr>
           <p>'.$data['message'].'</p>
        </tr>


         <tr>
            <td colspan="2" style="background:#800000; text-align:left;">Thanks and Regards,<br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="www.rupakottravels.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
        </tr>
        <tr>
            <td colspan="2" style="background:#800000; text-align:left;"><br />
                Rupakot Tours and Travels Pvt. Ltd.<br />
                Contact Number:<strong>+977 -1-4440671, 4440672</strong><br />
                <a href="http://rupakottravels.com/" target="_blank" style="color:#46216F; text-decoration:underline;">www.rupakottravels.com</a></td>
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

        $mail->Subject    = $site_settings['site_name']." ".$data['title'];


        $mail->MsgHTML($body);


        foreach($admin_mails as $address)
        {
            $mail->AddAddress($address['email'], $server['send_from_name']);
        }
        $mail->Send();




    }



    //function to create log

    public function create_log($insert)
    {

        $insert['ip_address'] = get_ip();
        $insert['user_id'] = $this->session->userdata('admin_id');
        $insert['date'] = date('Y-m-d:H:i:s');
        $insert['module_name'] =  "Package Booking";
        $this->db->insert('igc_user_logs', $insert);
    }



}
?>
