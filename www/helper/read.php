<?php

$profiles = glob('profiles/*.{json}', GLOB_BRACE);

/* Use in template like this:

foreach ($profiles as $path)
{
    $string = file_get_contents($path);
    $json_a=json_decode($string,true);

    $json_o=json_decode($string);

    var_dump($json_o);
}

*/

?>