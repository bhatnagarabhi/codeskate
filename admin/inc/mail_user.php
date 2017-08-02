<?php
  $arr    = array();
if($_POST['user_email']!='') {
                                // error_reporting(0);

                                require '../../PHPMailer/PHPMailerAutoload.php';

                                require_once ("../../classes/init.php");

                                // Some encryption to be applied
                                // Initialization for the encryption
                                $method     = base64_decode('QUVTLTEyOC1DQkM=');
                                $pass       = base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
                                $iv     = openssl_random_pseudo_bytes(16);
                                $enc        = new Encrypt($method, $pass, $iv);
                                $myusername     = $enc::secureDecrypt("OFEzdHNveXhTWTRURllFVHhsZmEwVHp2bjN1UDhrOWZITDRDelRhVTJjUT0=");
                                $password   = $enc::secureDecrypt("RUpIQWJwZUc5bUtkMzJucXZnV1ZxQT09");

                                $mail = new PHPMailer;

                                $mail->isSMTP();                                                // Set mailer to use SMTP
                                $mail->Host = 'smtp.gmail.com';                             // Specify main and backup SMTP servers
                                $mail->SMTPAuth = true ;                                            // Enable SMTP authentication
                                $mail->Username = $myusername;                      // SMTP username
                                $mail->Password = $password;                    // SMTP password
                                $mail->SMTPSecure = 'tls';                                      // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 587;
                                $mail->SMTPOptions = array(
                                    'ssl' => array(
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                        'allow_self_signed' => true
                                    )
                                );                                          // TCP port to connect to
                                $email = "abhi.bhatnagar123321@gmail.com";
                                $mail->setFrom($myusername, 'Codeskate');
                                $mail->addReplyTo($myusername, 'Codeskate');
                                $mail->addAddress($_POST['user_email']);      // Add a recipient
                                //$mail->addCC('cc@example.com');
                                //$mail->addBCC('bcc@example.com');

                                $mail->isHTML(true);  // Set email format to HTML

                                $bodyContent =  $_POST['mail_body'];
                                $bodyContent.= '<br><p>A message from the Codeskate admin</p>';

                                $mail->Subject = $_POST['mail_subject'];
                                $mail->Body    = $bodyContent;

                                if(!$mail->send()) {
                                    array_push($arr, false);
                                    //echo 'Mailer Error: ' . $mail->ErrorInfo;
                                } else {
                                    // $res         = $db->addContent(7, 'users', 'user_name', $fname, 'user_username', $username, 'user_email', $email , 'user_dob', $dob, 'user_pass', $encpassword, 'user_com_code', $com, 'timestamp', $timestamp);
                                    // if($res){
                                            array_push($arr, true);
                                            //header("Location:../email_status?status=0");
                                    // } else {
                                    //         echo 'There seems to be a problem';
                                    // }
                                }    
        } else {
            array_push($arr, false);
        }
        echo json_encode($arr);
?>
