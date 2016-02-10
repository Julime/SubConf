<?php
    $profileid=$_POST["profileid"];
    $filename=$_SERVER["DOCUMENT_ROOT"]."/profiles/".$profileid.".json";
    if(unlink($filename)) {
        echo "Profile erfolgreich gelöscht";
    } else {
        echo "Beim Löschen ihres profile ist ein fehler aufgetreten";
    }
?>
