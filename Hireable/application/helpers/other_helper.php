<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    function dbDate($date){
        list($month, $day, $year) = explode("/",$date);
        return implode( "-" , [ $year,$month,$day ]);
    }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor\autoload.php';

    function sendMail(){
        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host         = 'smtp.mailtrap.io';
        $mail->SMTPAuth     = true;
        $mail->Username     = 'f40a30b882b3a8';
        $mail->Password     = 'f0773c16eca49d';
        $mail->SMTPSecure   = 'tsl';
        $mail->Port         = 587;

        $mail->setFrom('hireable@email.com');

        $mail->addAddress('hudazehra2510@gmail.com');

        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;

        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
 