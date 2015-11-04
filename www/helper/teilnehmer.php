<?php

    $profileid = $_GET["profileid"];
    $profile = file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$profileid.".json");
    $profile=json_decode($profile, true);

    if($profile["signed"]=="true") {
        $profile["signed"]="false";
    } else {
        $profile["signed"]=true;
    };
    $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
    file_put_contents($file, json_encode($profile));
?>
