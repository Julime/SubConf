<?php
    $pw=$_GET["pw"];
    $profileid=$_GET["profileid"];

    include "read.php";

    $profile = file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$profileid.".json");
    $profile=json_decode($profile, true);

    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

        if($profile["profileid"]==$profileid and $profile["pw"]==$pw) {
            $profile["signed"]="true";
            $file = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
            file_put_contents($file, json_encode($profile));?>
            <script>
                alert("Erfolg");
            </script>
        <?php
        };
    };
    header("Location: /");
?>
