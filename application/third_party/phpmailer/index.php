<?php 
require_once('class.phpmailer.php');

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

 

//$body             = file_get_contents('contents.html');

$body = "askdhakshdkahsdkhasdkjhsa";

$body             = eregi_replace("[\]",'',$body);

 

$mail->IsSMTP(); // telling the class to use SMTP

$mail->Host       = "mail.yourdomain.com"; // SMTP server

$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)

// 1 = errors and messages

// 2 = messages only

$mail->SMTPAuth   = true;                  // enable SMTP authentication

$mail->SMTPSecure = "tls";                 // sets the prefix to the servier

$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

$mail->Port       = 587;                   // set the SMTP port for the GMAIL server

$mail->Username   = "igctechnepal@gmail.com";  // GMAIL username

$mail->Password   = "Inspire@it1";            // GMAIL password

$mail->SetFrom('igctechnepal@gmail.com', 'IGC');

$mail->AddReplyTo("igctechnepal@gmail.comm","Gmail");

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

 

$mail->MsgHTML($body);

 

$address = "ashokgrg11@gmail.com";

$mail->AddAddress($address, "Ashok Gmail");

 

///$mail->AddAttachment("/images/phpmailer.gif");      // attachment

//$mail->AddAttachment("/images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {

echo "Mailer Error: " . $mail->ErrorInfo;

} else {

echo "Message sent!";

}
?>