<?php
    $profileid =  hash('md5', $_POST['email']);
    $file = '../profiles/'.$profileid.'.json';
    $_POST['profileid'] = $profileid;
    file_put_contents($file, json_encode($_POST));
    var_dump($_POST);
?>