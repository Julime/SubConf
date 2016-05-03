<?php
    $profileid=$_POST["profileid"]; //get the profile
    $filename=$_SERVER["DOCUMENT_ROOT"]."/profiles/".$profileid.".json"; //get the file path for the profile
    if(unlink($filename)) { //delete file
        echo $config["Text"]["profileDeleted"];//give success
    } else {
        echo $config["Text"]["error"]; //give error
    }
?>
