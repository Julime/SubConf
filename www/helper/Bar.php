<?php
    $pw=$_GET["pw"];//get the password to controll if the profile really payed
    $profileid=$_GET["profileid"];//get the profileid

    include "read.php";

    $profile = file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$profileid.".json");
    $profile=json_decode($profile, true);

    foreach ($profiles as $path) //go throught all profiles
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

        if($profile["profileid"]==$profileid and $profile["pw"]==$pw) { //check if the password matches the profile pw
            $profile["signed"]="true"; //signe the profile
            $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json'; //save the changes
            file_put_contents($file, json_encode($profile)); //write the changes?> 
            <script>
                alert("Erfolg");
            </script>
        <?php
        };
    };
    header("Location: /");
?>
