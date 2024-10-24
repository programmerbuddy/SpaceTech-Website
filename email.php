<?php
include('../admin/adminconfig.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require '../vendor/autoload.php';

function sendemail_verify($fname,$lname,$email,$verify_token)
{
    $mail = new PHPMailer(true);
                         //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
                      //Set the SMTP server to send through
    $mail->SMTPAuth   = true;     
    $mail->Host       = 'smtp-mail.outlook.com';                                 //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = "STARTTLS";            //Enable implicit TLS encryption
    $mail->Port       = 587;    
    
    $mail->setFrom('shubham210915@mccmulund.ac.in', $fname);
    $mail->addAddress($email);//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Jai Hind Welcome TO NSS UNIT OF Mulund College Of Commerce(Autonomous) ';
    $email_template = "
    <h2> You Have Register with NSS Unit Of Mulund College Of Commerce</h2>
    <h5>verify Your Registerd email Address to login with the below given link</h5>
    <br/<br/>

    ";
    $mail->Body=$email_template;
    $mail->send();
    echo 'Message has been sent';



}
sendemail_verify("$fname","$lname","$email","$verify_token");