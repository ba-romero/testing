<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit'])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through

        $mail->Username   = 'baromero.thingstories@gmail.com';      //SMTP username
        $mail->Password   = 'jblocwnqkxcfwxic';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('baromero.thingstories@gmail.com');       //Add a recipient

        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "
                <h3>Contact Form</h3>
                <p><strong>Name: </strong>$name</p>
                <p><strong>Email: </strong>$email</p>
                <p><strong>Subject: </strong>$subject</p>
                <p><strong>Message: </strong>$message</p>
        ";

        if($mail->send()) {
            $msg .= "One or more fields have an error. Please check and try again."
            $msg .= "<span id='id_name'>Message sent! Please read the information bellow.</span>"; 
        } else {
            $msg .= "Message sent! Please read the information bellow.</span>"; 
        }

}

    

?>