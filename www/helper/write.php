<?php
    $hash =  hash('md5', $_POST['email']);
    $file = '../profiles/'.$hash.'.json';
    $_POST['hash'] = $hash;
    file_put_contents($file, json_encode($_POST));
    var_dump($_POST);
?>