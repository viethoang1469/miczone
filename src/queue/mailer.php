<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
class mailer extends PHPMailer
{
    public function __construct()
    {
        $this->isSMTP();                                            // Send using SMTP
        $this->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $this->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->Username   = 'jshviethoang18@gmail.com';             // SMTP username
        $this->Password   = 'xvrlnowfjyojmhwq';                     // SMTP password
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $this->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $this->CharSet = 'UTF-8';
    }
    public function setReceiver ($mail)
    {
        $this->setFrom($mail, 'Miczone');
        $this->addAddress($mail);
    }
    public function setContent ($subject, $content){
        $this->isHTML(true);
        $this->Subject = $subject;
        $this->Body = $content;
    }
    public function sendMail ()
    {
        $this->send();
    }
}