<?php
    //verify the hash from the password
    $pw=$_POST['pw']; //get the pw
    $profileid=$_POST['profileId']; //get the profileid

    $path=$_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
    $string = file_get_contents($path);
    $profile=json_decode($string,true);

    $hash=$profile["passwort"];

    if(password_verify($pw,$hash)){ //call the php password verify funktion and echo the result
        echo "true";
    } else {
        echo "false";
    }
?>
