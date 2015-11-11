<?php

    $profileid = $_GET["profileid"];
    $profile = file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$profileid.".json");
    $profile=json_decode($profile, true);

    if($profile["signed"]=="true") {
        $profile["signed"]="false";
    } else if (
                !empty($profile["bread"])&&
                !empty($profile["size"])&&
                !empty($profile["meat"])
            ) {
        include"paypal.php";
    } else { ?>
    <script>
        alert("Stellen sie sicher das Brot, Größe und Fleisch festgelegt sind!");
    </script>
    <?php };
    $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
    file_put_contents($file, json_encode($profile));
?>
