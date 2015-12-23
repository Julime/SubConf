<body OnLoad="window.print(); document.location.href = '../../';">

<?php
    include"read.php";
    $number=0;
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

            if
                (
                    !empty($profile["bread"])&&
                    !empty($profile["size"])&&
                    !empty($profile["meat"])&&
                    !key_exists("onlycoupon",$profile)
                ) {
                $number=$number+1;
                echo $number.". ". $profile["vorname"]." ".$profile["nachname"]." - "; include "getprice.php"; echo $price."€ | Brot:  ".$profile["bread"]." | Größe:  ".$profile["size"]." | Fleisch:  ".implode(", ",$profile["meat"]); if(!empty($profile["cheese"])) { echo " | Käse:  ".implode(", ", $profile["cheese"]);}; if(!empty($profile["salad"])) { echo " | Gemüse:  ".implode(", ", $profile["salad"]);};  if(!empty($profile["sauce"])) { echo " | Sauce:  ".implode(", ", $profile["sauce"]);};  if(!empty($profile["extras"])) { echo " | Extras:  ".implode(", ", $profile["extras"]);}; if(!empty($profile["Bemerkung"])) { echo " | Bemerkung:  ".$profile["Bemerkung"];};  if(!empty($profile["coupon"])) { echo " | Gutscheine:  ".implode(", ", str_replace("_"," ", $profile["coupon"]));};?><br><br><?php
            } else if (key_exists("onlycoupon",$profile)) {

                $number=$number+1;
                echo $number.". ". $profile["vorname"]." ".$profile["nachname"]." - "; include "getprice.php"; echo $price."€ "; if(!empty($profile["coupon"])) { echo " | Gutscheine:  ".implode(", ", str_replace("_"," ", $profile["coupon"]));}; if(!empty($profile["Bemerkung"])) { echo " | Bemerkung:  ".$profile["Bemerkung"];};?><br><br><?php
            }
            }
    }?>
</body>
