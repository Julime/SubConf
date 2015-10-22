<?php

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

    include "selected.php";
}
include "users.php"; ?>
