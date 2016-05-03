<?php
    //set the path for coupons
    $file = $_SERVER['DOCUMENT_ROOT'].'/helper/gutscheine.json';

    $content=json_encode($_POST);
    $content=str_replace('\"', '', $content);
    $content=str_replace('"ignore":{"ignore":"ignore"},', '', $content); //remove the ignore coupon

    file_put_contents($file, $content); //write the coupons
    echo json_encode($_POST); //give debug data
?>
