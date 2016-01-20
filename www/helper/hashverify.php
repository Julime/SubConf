<?php
    $pw=$_POST['pw'];
    $profileid=$_POST['profileId'];

    $path=$_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
    $string = file_get_contents($path);
    $profile=json_decode($string,true);

    $hash=$profile["passwort"];

    if(password_verify($pw,$hash)){
        echo "true";
    } else {
        echo "false";
    }
?>
