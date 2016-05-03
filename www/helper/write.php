<?php
if (!file_exists("../profiles")) { //check if path exists
    mkdir("../profiles"); //creat path
}

    $profileid =  hash('md5', $_POST['email']); //get profile id
    //get and write the new data
    $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
    $_POST['profileid'] = $profileid;
    $_POST['passwort'] = password_hash($_POST["passwort"], PASSWORD_BCRYPT);
    file_put_contents($file, json_encode($_POST));
    echo json_encode($_POST);
?>
