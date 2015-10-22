<?php
unlink("data.html");

if (!isset($profile["profileid"]))
{
    include($_SERVER['DOCUMENT_ROOT'].'/helper/read.php');
    $profileid = $_GET['profileid'];
    $path = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';

    $string = file_get_contents($path);
    $profile=json_decode($string, true);
}
foreach ($profiles as $path)
{
        $string = file_get_contents($path);
        $profile=json_decode($string, true);

        $input=$_GET[$profile["profileid"]];
//        if ($input == "1") {
//            printf($input);
//        printf(isset($_POST[$profile["profileid"]]));
        ob_start();

        include "selected.php";

        $content = ob_get_contents();

        $file = fopen("data.html", "a");
        fwrite($file, $content);
        ob_clean();
//    };
}
include "users.php" ?>
