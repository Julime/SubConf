<?php
    $hash =  hash('md5', $_POST['email']);
    $file = '../profiles/'.$hash.'.json';
    file_put_contents($file, json_encode($_POST));
    var_dump($_POST);
?>