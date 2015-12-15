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

    foreach($config["Cheese"] as $cheese) {
        if(in_array($cheese["name"],$profile["cheese"]) and $cheese["name"]=="Doppelt") {
            if ($profile["size"]=="15cm") {
                $price=$price+0.3;
            } else {
                $price=$price+0.6;
            }
        };
    };

foreach($gutschein as $gutscheine) {
        foreach($gutscheine as $Sub) {
            if (is_array($Sub) and array_key_exists("name",$Sub) and array_key_exists("count",$Sub) and array_key_exists("dates",$Sub) and array_key_exists("datee",$Sub) and array_key_exists("price",$Sub) and isset($profile["coupon"]) and is_array($profile["coupon"])) {
        if (strpos($Sub["price"],"%")!==false){
                        $subprice=str_replace("%","",$Sub["price"]);
                        $subprice=intval($subprice);
                        $price=round(($price/100)*$subprice,2);
                     }
                }
            }
        }

    foreach($gutschein as $gutscheine) {
        foreach($gutscheine as $Sub) {
            if (is_array($Sub) and array_key_exists("name",$Sub) and array_key_exists("count",$Sub) and array_key_exists("dates",$Sub) and array_key_exists("datee",$Sub) and array_key_exists("price",$Sub) and isset($profile["coupon"]) and is_array($profile["coupon"])) {
                if (in_array($Sub["name"], $profile["coupon"])){
                    if (strpos($Sub["price"],"€")!==false) {
                        $subprice=str_replace("€","",$Sub["price"]);
                        $subprice=floatval($subprice);
                        $price=$price+$subprice;
                    }
                }
            }
        }
    }

?>
