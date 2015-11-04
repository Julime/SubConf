<?php

// get profiles
$profiles = glob($_SERVER['DOCUMENT_ROOT'].'/profiles/*.{json}', GLOB_BRACE);
/* Use in template like this:

foreach ($profiles as $path)
{
    $string = file_get_contents($path);
    $json_a=json_decode($string,true);

    $json_o=json_decode($string);

    var_dump($json_o);
}

*/

// get config
$config_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config.json');
$config = json_decode($config_file, true);//glob('config.json', GLOB_BRACE);
?>
