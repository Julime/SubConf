<?php
    $config_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config.json');
    $config = json_decode($config_file, true);
if(!isset($profile)) {
    $profile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$payer.".json");
    $profile=json_decode($profile,true);
}
$gutschein_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/helper/gutscheine.json');
$gutschein = json_decode($gutschein_file, true);

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

    foreach($gutschein as $gutscheine) {
        foreach($gutscheine as $Sub) {
            if (is_array($Sub) and array_key_exists("name",$Sub) and array_key_exists("count",$Sub) and array_key_exists("dates",$Sub) and array_key_exists("datee",$Sub) and array_key_exists("price",$Sub)) {
                if (in_array($Sub["name"], $profile["coupon"])){
                    $price=$price+$Sub["price"];
                }
            }
        }
    }
?>