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

    foreach($gutschein as $gutscheine) {
        foreach($gutscheine as $Sub) {
            if (in_array($Sub["name"], $profile["coupon"])){
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
                $Subprice=$Subprice+2;
            }else if(($meat["name"]=="Doppelt Fleisch")&&($profile["size"]=="15cm")){
                $Subprice=$Subprice+1;
            } else {
                $Subprice=$Subprice+$meat["price"];
            }
        }
    }

    foreach($config["Cheese"] as $cheese) {
        if(in_array($cheese["name"],$profile["cheese"]) and $cheese["name"]=="Doppelt") {
            if ($profile["size"]=="15cm") {
                $Subprice=$Subprice+0.3;
            } else {
                $Subprice=$Subprice+0.6;
            }
        }
    }



    foreach($config["Cookie"] as $cookie) {
        $cookiecount=$cookiecount+intval($profile["cookie"][$cookie["name"]]);
    }


    foreach($gutschein as $gutscheine) { //Gutscheine
        foreach($gutscheine as $Sub) {
            if (in_array($Sub["name"], $profile["coupon"])){
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
            }
        }
    }
    if ($cookiecount<0) {
        $cookiecount=0;
    }

    $price=$Subprice+$couponprice+floatval($cookiecount*0.7);
?>
