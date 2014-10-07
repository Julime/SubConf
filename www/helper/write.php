<?php
    $file = '../profiles/'.$_POST['email'].'.json';
    file_put_contents($file, json_encode($_REQUEST));
    var_dump($_POST);
?>