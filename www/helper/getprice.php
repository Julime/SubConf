<?php
    //get the profile id
    $config_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config.json');
    $config = json_decode($config_file, true);
if(!isset($profile)) {
    $profile=file_get_contents($_SERVER['DOCUMENT_ROOT']."/profiles/".$payer.".json");
    $profile=json_decode($profile,true);
}
$gutschein_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/helper/gutscheine.json');
$gutschein = json_decode($gutschein_file, true);

//set default variables
$Subprice=0;
$cookiecount=0;
$couponprice=0;
$bacon=0;
$extrakaese=0;
$doppeltfleisch=0;

//set the size to the size in the coupon (if selected)
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
//set the price for the size
    foreach($config["Size"] as $size) { //Subprice
        if($size["name"]==$profile["size"]) {
            $Subprice=$Subprice+$size["price"];
        }
    }
    //add the price for the meat, Bacon and doubleMeat
    foreach($config["Meat"]["sorts"] as $meat) {
        if(in_array($meat["name"], $profile["meat"])) {
            if(($meat["name"]==$config["Text"]["doubleMeat"]) && ($profile["size"]=="30cm")) { //make sure the meat name for double meat is the sam as in doubleMeat under text
                $doppeltfleisch=$doppeltfleisch+2;
            }else if(($meat["name"]==$config["Text"]["doubleMeat"])&&($profile["size"]=="15cm")){ //make sure the meat name for double meat is the sam as in doubleMeat under text
                $doppeltfleisch=$doppeltfleisch+1;
            } else if($meat["name"]==$config["Text"]["Bacon"]) { //make sure the meat name for double meat is the sam as in Bacon under text
                $bacon=$bacon+0.6;
                if($profile["size"]=="30cm") {
                    $bacon=$bacon+0.6;
                }
            } else if($meat["name"]==$config["Data"]["Subofday".date("N")]) { //check for sub of the day
                $Subprice=$Subprice+2.69;//set the price to the subofday price
            } else {
                $Subprice=$Subprice+$meat["price"]; //set the normal price
            }
        }
    }

    //add price for cheese
    foreach($config["Cheese"] as $cheese) { 
        if((key_exists("cheese",$profile)) && in_array($cheese["name"],$profile["cheese"]) and $cheese["name"]=="Doppelt") {
            if ($profile["size"]=="15cm") {
                $extrakaese=$extrakaese+0.3;
            } else {
                $extrakaese=$extrakaese+0.6;
            }
        }
    }


    //count the selected cookies
    foreach($config["Cookie"] as $cookie) {
        $cookiecount=$cookiecount+intval($profile["cookie"][$cookie["name"]]);
    }

    //check for coupon interactions
    foreach($gutschein as $gutscheine) {
        foreach($gutscheine as $Sub) {
            if ((isset($Sub["name"])&& key_exists("coupon",$profile) && is_array($profile["coupon"])) &&in_array($Sub["name"], $profile["coupon"])){ //verify the coupon
                if (strpos($Sub["type"],"€mehr")!==false) { //check if to add the price
                    $Subprice=$Subprice+$Sub["price"];
                } else if (strpos($Sub["type"],"€weniger")!==false) { //check if to substract the price
                    $Subprice=$Subprice-$Sub["price"];
                } else if (strpos($Sub["type"],"%weniger")!==false) { //check if to substrect the %price
                    $Subprice=$Subprice-(($Subprice/100)*$Sub["price"]);
                } else if (strpos($Sub["type"],"k=p")!==false) { //chek if to set the price
                    $Subprice=$Sub["price"];
                } else if (strpos($Sub["type"],"T-C")!==false) { //check for free cookies
                    $cookiecount=$cookiecount-intval(str_replace("T-C","",$Sub["type"]));
                    $couponprice=$couponprice+$Sub["price"];
                }
                //check free extras
                if (strpos($Sub["type1"],"ex")!==false) {
                    if (str_replace("ex","",$Sub["type1"])=="1") { //check for free bacon
                        $bacon=0;
                    } else if (str_replace("ex","",$Sub["type1"])=="2") { //check for free double cheese
                        $extrakaese=0;
                    } else if (str_replace("ex","",$Sub["type1"])=="3") { //check for free double bacon
                        $doppeltfleisch=0;
                    }
                }
            }
        }
    }
    //check if you selected less cokies than the coupon gives for free
    if ($cookiecount<0) { 
        $cookiecount=0;
    }
    $price=$Subprice+$couponprice+floatval($cookiecount*0.7)+$bacon+$extrakaese+$doppeltfleisch; //add all prices to one final price
?>
