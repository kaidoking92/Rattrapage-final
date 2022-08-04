<?php

namespace App\core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Core\Context;
use App\Core\ConcreteStrategyUser;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';


class Mailsender
{

    private $mail;
  

    public function __construct(){

            $this->mail = new PHPMailer(true);
            $this->mail->IsSMTP();
            $this->mail->Mailer = "smtp";

            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port = 587;
 
            $this->mail->SMTPAuth   = TRUE;

            $this->mail->Host = HOSTMAIL;
            $this->mail->Username = MAILUSERNAME;
            $this->mail->Password = MAILPWD;
            $this->mail->setFrom(SETMAIL);
            
            
    }

    public function includeMailTemplate($template, $variables):void
    {
        if(!file_exists("View/Template/Mail/".$template.".mail.php")){
            die("Le partial ".$template." n'existe pas");
        }
        include "View/Template/Mail/".$template.".mail.php";
    }


    public function sendMail($template, $email, $name, $url = null, $data = null) 
    {
        $this->mail->IsHTML(true);
        $this->mail->AddAddress($email, $name);
        $this->mail->SetFrom("a.bouzalmad.cms@gmail.com", "ABouzalmad CMS");
        $this->mail->Subject = "Confirmation Inscription";
        $content = "<b> Cliquez sur le lien suivant pour activer votre compte : " . $url . " </b>";

        $this->mail->MsgHTML($content); 
        if(!$this->mail->Send()) {
            echo "Error while sending Email.";
        } else {
            echo "Email sent successfully";
        }

    }
  
    public function sendsimple($email,$content)
    {
        $this->mail->addAddress($email);      
        $this->mail->isHTML(true);
        $this->mail->Body = $content;
        $this->mail->send();
    }


}