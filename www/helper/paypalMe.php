<?php
    //generate the link and the email for the paypal.me option just like in mailbar.php
    include "read.php";
    $profileid=$_GET["profileid"];
    $string = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json');
    $profile=json_decode($string,true);

    $pw = mt_rand(1000,9999);
    $profile["pw"]=$pw;
    $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profile["profileid"].'.json';
    file_put_contents($file, json_encode($profile));

    include 'getprice.php';

    $email = $config["Data"]["Administrator-E-mail"];
    $subject = $profile["vorname"]." ".$profile["nachname"]." moechte mit PaypalMe bezahlen.";
    $message = $profile["vorname"]." ".$profile["nachname"]." moechte mit PaypalMe bezahlen. Sein/Ihr Sub kostet ".$price."EURO. Wenn er/sie bezahlt hat klicke auf diesen <a href='http://subconf/helper/Bar.php?pw=".$pw."&profileid=".$profile['profileid']."'>Link</a>.";

    mail($email,$subject,$message);
    echo "<script language='Javascript'>document.location.href='".$config['Data']['PaypalMe']."/send?amount=".$price."&currencyCode=EUR';</script>";
?>