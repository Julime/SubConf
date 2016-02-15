<?php
    $profileid=$_GET["profileid"];
    $string = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json');
    $profile=json_decode($string,true);

    $pw = mt_rand(1000,9999);
    $profile["pw"]=$pw;
    $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profile["profileid"].'.json';
    file_put_contents($file, json_encode($profile));

    include 'getprice.php';

    $email = $config["Data"]["Administrator-E-mail"];
    $subject = $profile["vorname"]." ".$profile["nachname"]." moechte Bar bezahlen.";
    $message = $profile["vorname"]." ".$profile["nachname"]." moechte Bar bezahlen. Sein/Ihr Sub kostet ".$price."EURO. Wenn er/sie bezahlt hat klicke auf diesen <a href='http://subconf/helper/Bar.php?pw=".$pw."&profileid=".$profile['profileid']."'>Link</a>.";

    require_once("C:\\xampp\htdocs\subconf\www\php\PHPMailer-master\class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->isHTML(true);
    $mail->Host = "mail.google.com";
    $mail->AddAddress($email);
    $mail->From = "subconfulpr@gmail.com";
    $mail->FromName = "Subconf-Server";
    $mail->Subject = $subject;
    $mail->Body = $message;
//  $mail->WordWrap = 50; <-wird vorgegeben macht aber keinen Unterschied
    if(!$mail->Send()) {
    //    printf("Message was not sent.");
    //    printf("Mailer error: ".$mail->ErrorInfo);
    } else {
    };
?>
