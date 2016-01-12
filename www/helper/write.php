<?php
    $profileid =  hash('md5', $_POST['email']);
    $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
    $_POST['profileid'] = $profileid;
    file_put_contents($file, json_encode($_POST));
    echo json_encode($_POST);
?>
