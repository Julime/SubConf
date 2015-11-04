<?php
    $config_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config.json');
    $config = json_decode($config_file, true);

    foreach($config["Size"] as $size) {
        if($size["name"]==$profile["size"]) {
            $price=$size["price"];
        };
    };
    foreach($config["Meat"]["sorts"] as $meat) {
        if(in_array($meat["name"], $profile["meat"])) {
            if(($meat["name"]=="Doppelt Fleisch") && ($profile["size"]=="30cm")) {
                $price=$price+2;
            }else if(($meat["name"]=="Doppelt Fleisch")&&($profile["size"]=="15cm")){
                $price=$price+1;
            } else {
                $price=$price+$meat["price"];
            };
        };
    };
    $price.="€";
    echo $price;
?>
