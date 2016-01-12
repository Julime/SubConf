<?php
    $file = $_SERVER['DOCUMENT_ROOT'].'/helper/gutscheine.json';

    $content=json_encode($_POST);
    $content=str_replace('\"', '', $content);
    $content=str_replace('{"ignore":{"ignore":"ignore"},', '{', $content);
//    $content=str_replace('_', '', $content);



    file_put_contents($file, $content);
    echo json_encode($_POST);
?>
