<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'C:\PHPMailer\src\Exception.php';

/* The main PHPMailer class. */
require 'C:\PHPMailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'C:\PHPMailer\src\SMTP.php';
function sendVerification($email, $username,$token)
{

    $mail = new PHPMailer();
    $mail->CharSet = "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "forburgerlovers@gmail.com";
    $mail->Password = "Burgers961";
    $mail->SMTPSecure = "tls";
    $mail->SMTPAutoTLS = false;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "587";

    $mail->setFrom('forburgerlovers@gmail.com', 'Burger Place');
    $mail->AddAddress($email,$username);

    $mail->Subject = 'Email address verification';
    $mail->IsHTML(true);
    $mail->Body = 'Hello burger lover : '.$username.' ,
                        <br />
                            Click on the link below to validate your email
                        <br />
                        http://localhost/BurgerShop/PL/PHP/activate.php?email='.$email.'&hash='.$token.'
                            ';

    if ($mail->Send()) {
        //echo "Message was Successfully Send :)";
        return true;
    } else {
        //echo "Mail Error - >".$mail->ErrorInfo;
        return false;
    }
}

function sendReset($email, $username,$token)
{

    $mail = new PHPMailer();
    $mail->CharSet = "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "forburgerlovers@gmail.com";
    $mail->Password = "Burgers961";
    $mail->SMTPSecure = "tls";
    $mail->SMTPAutoTLS = false;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "587";

    $mail->setFrom('forburgerlovers@gmail.com', 'Burger Place');
    $mail->AddAddress($email,$username);

    $mail->Subject = 'Email address verification';
    $mail->IsHTML(true);
    $mail->Body = 'Hello burger lover : '.$username.' ,
                        <br />
                            Click on the link below to reset your password
                        <br />
                        http://localhost/BurgerShop/PL/Views/resetPass.php?email='.$email.'&hash='.$token.'
                            ';

    if ($mail->Send()) {
        //echo "Message was Successfully Send :)";
        return true;
    } else {
        //echo "Mail Error - >".$mail->ErrorInfo;
        return false;
    }
}

?>
