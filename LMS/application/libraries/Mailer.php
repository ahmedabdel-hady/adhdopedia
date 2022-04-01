<?php 

class Mailer
{
    public function __construct()
    {
        log_message('[EduAppGT PRO]','Failed to load Library');
    }

    public function load()
    {
        require_once(APPPATH."third_party/class.phpmailer.php");
        $object = new PHPMailer();
        return $object;
    }
}