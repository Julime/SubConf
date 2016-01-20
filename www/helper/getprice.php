<?php
    $config_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config.json');
    $config = json_decode($config_file, true);
if(!isset($profile)) {
    $profile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$payer.".json");
    $profile=json_decode($profile,true);
}
$gutschein_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/helper/gutscheine.json');
$gutschein = json_decode($gutschein_file, true);

$Subprice=0;
$cookiecount=0;
$couponprice=0;
$bacon=0;
$extrakaese=0;
$doppeltfleisch=0;

    foreach($gutschein as $gutscheine) {
        foreach($gutscheine as $Sub) {
            if ((isset($Sub["name"])&& key_exists("coupon",$profile) && is_array($profile["coupon"])) && in_array($Sub["name"], $profile["coupon"])){
                if (strpos($Sub["type"],"FL")!==false) {
                    $profile["size"]="30cm";
                } else if (strpos($Sub["type"],"15")!==false) {
                    $profile["size"]="15cm";
                }
            }
        }
    }

    foreach($config["Size"] as $size) { //Subprice
        if($size["name"]==$profile["size"]) {
            $Subprice=$Subprice+$size["price"];
        }
    }
    foreach($config["Meat"]["sorts"] as $meat) {
        if(in_array($meat["name"], $profile["meat"])) {
            if(($meat["name"]=="Doppelt Fleisch") && ($profile["size"]=="30cm")) {
                $doppeltfleisch=$doppeltfleisch+2;
            }else if(($meat["name"]=="Doppelt Fleisch")&&($profile["size"]=="15cm")){
                $doppeltfleisch=$doppeltfleisch+1;
            } else if($meat["name"]=="Bacon") {
                $bacon=$bacon+0.6;
                if($profile["size"]=="30cm") {
                    $bacon=$bacon+0.6;
                }
            } else {
                $Subprice=$Subprice+$meat["price"];
            }
        }
    }

    foreach($config["Cheese"] as $cheese) {
        if((key_exists("cheese",$profile)) && in_array($cheese["name"],$profile["cheese"]) and $cheese["name"]=="Doppelt") {
            if ($profile["size"]=="15cm") {
                $extrakaese=$extrakaese+0.3;
            } else {
                $extrakaese=$extrakaese+0.6;
            }
        }
    }



    foreach($config["Cookie"] as $cookie) {
        $cookiecount=$cookiecount+intval($profile["cookie"][$cookie["name"]]);
    }


    foreach($gutschein as $gutscheine) { //Gutscheine
        foreach($gutscheine as $Sub) {
            if ((isset($Sub["name"])&& key_exists("coupon",$profile) && is_array($profile["coupon"])) &&in_array($Sub["name"], $profile["coupon"])){
                if (strpos($Sub["type"],"€mehr")!==false) {
                    $Subprice=$Subprice+$Sub["price"];
                } else if (strpos($Sub["type"],"€weniger")!==false) {
                    $Subprice=$Subprice-$Sub["price"];
                } else if (strpos($Sub["type"],"%weniger")!==false) {
                    $Subprice=$Subprice-(($Subprice/100)*$Sub["price"]);
                } else if (strpos($Sub["type"],"k=p")!==false) {
                    $Subprice=$Sub["price"];
                } else if (strpos($Sub["type"],"T-C")!==false) {
                    $cookiecount=$cookiecount-intval(str_replace("T-C","",$Sub["type"]));
                    $couponprice=$couponprice+$Sub["price"];
                }
                if (strpos($Sub["type1"],"ex")!==false) {
                    if (str_replace("ex","",$Sub["type1"])=="1") {
                        $bacon=0;
                    } else if (str_replace("ex","",$Sub["type1"])=="2") {
                        $extrakaese=0;
                    } else if (str_replace("ex","",$Sub["type1"])=="3") {
                        $doppeltfleisch=0;
                    }
                }
            }
        }
    }
    if ($cookiecount<0) {
        $cookiecount=0;
    }
    $price=$Subprice+$couponprice+floatval($cookiecount*0.7)+$bacon+$extrakaese+$doppeltfleisch;
?>
