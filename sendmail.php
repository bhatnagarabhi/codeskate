<?php

error_reporting(0);

require 'PHPMailer/PHPMailerAutoload.php';

require_once ("classes/init.php");

// Some encryption to be applied
// Initialization for the encryption
$method 	= base64_decode('QUVTLTEyOC1DQkM=');
$pass 		= base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
$iv		= openssl_random_pseudo_bytes(16);
$enc 		= new Encrypt($method, $pass, $iv);
$myusername 	= $enc::secureDecrypt("OFEzdHNveXhTWTRURllFVHhsZmEwVHp2bjN1UDhrOWZITDRDelRhVTJjUT0=");
$password 	= $enc::secureDecrypt("RUpIQWJwZUc5bUtkMzJucXZnV1ZxQT09");

$mail = new PHPMailer;

$mail->isSMTP();                                   				// Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    			// Specify main and backup SMTP servers
$mail->SMTPAuth = true ;                            				// Enable SMTP authentication
$mail->Username = $myusername;			          	// SMTP username
$mail->Password = $password; 					// SMTP password
$mail->SMTPSecure = 'tls';                         				// Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);                            				// TCP port to connect to

$mail->setFrom($myusername, 'Codeskate');
$mail->addReplyTo($myusername, 'Codeskate');
$mail->addAddress($email);	   	// Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$baseurl = $_SERVER['SERVER_NAME'];

$bodyContent = '<h1 style="color:#dd5050; font-weight:100;">Codeskate e-mail verification</h1>';
$bodyContent.= '<p style="font-size:15px;">Dear <span style="font-weight:bold;">'.$fname.'</span>,<br>Thank you for signing up with Codeskate<sup>&copy;</sup>, please click the link to verify your e-mail. <a href="http://'.$baseurl.'/codeskate/inc/verify_email.php?com_code=';
$bodyContent.=$com;
$bodyContent.= '">Click here to verify your e-mail.</a></p>';

$mail->Subject = 'Codeskate e-mail verification';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo '<h2>The mail could not be sent, please try again later.</h2>';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $res 		= $db->addContent(7, 'users', 'user_name', $fname, 'user_username', $username, 'user_email', $email , 'user_dob', $dob, 'user_pass', $encpassword, 'user_com_code', $com, 'timestamp', $timestamp);
    if($res){
            echo 'Message has been sent';
            header("Location:../email_status?status=0");
    } else {
            echo 'There seems to be a problem';
    }
}
?>
