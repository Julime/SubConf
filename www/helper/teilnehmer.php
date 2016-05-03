<?php
    //manage the assignmend of new profiles
    $profileid = $_GET["profileid"];
    $profile = file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$profileid.".json");
    $profile=json_decode($profile, true);

    if($profile["signed"]=="true") { //check if it is allready signed
        $profile["signed"]="false";
    } else if ( //check if all important is set and that a subday is happening
                !empty($profile["bread"])&&
                !empty($profile["size"])&&
                !empty($profile["meat"])&&
                file_get_contents("subday.txt")=="yes"
            ) {
        include"paypal.php";
    } else if(file_get_contents("subday.txt")=="yes") { ?>
    <script>
        alert("Stellen sie sicher das Brot, Größe und Fleisch festgelegt sind!");
        $(".tab-content").load("helper/show.php");
    </script>
    <?php } else { ?>
    <script> 
        alert("Heute ist kein Subday");
        $(".tab-content").load("helper/show.php"); //show the main page again
    </script> <?php
    }
    $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json'; //save changes
    file_put_contents($file, json_encode($profile)); //write changes
?>
