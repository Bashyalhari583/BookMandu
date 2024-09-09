<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;


class MailSender{
    public static function send($email,$name,$subject, $body){
        $mail = new PHPMailer();

      
            //        //Enable verbose debug output
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;
      
            //Send using SMTP
            $mail->isSMTP();
      
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
      
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
      
            //SMTP username
            $mail->Username = getenv('MAIL_USERNAME');
      
            //SMTP password
            $mail->Password = getenv('MAIL_PASSWORD');
      
            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      
            //TCP port to connect to, use 465 for PHPMailer::ENCRYPTION_SMTPS above
            $mail->Port = 587;
      
            //Recipients
            $mail->setFrom(getenv('MAIL_USERNAME'));
      
            //Add a recipient
            $mail->addAddress($email, $name);
      
            //Set email format to HTML
            $mail->isHTML(true);
      
            
        
            // $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
      
            $mail->Subject =$subject;
            $mail->Body =$body;
            return $mail->send();

    }//send mail
}