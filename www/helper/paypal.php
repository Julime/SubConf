<?php
    include "read.php";
    $mail=$config["Data"]["Paypal"];

include "getprice.php";
?>

<head>
<script type="text/javascript">
	$(document).ready(function(){
		$("#paypalModal").modal('show');
	});
</script>
</head>

<form action="https://www.paypal.com/cgi-bin/webscr" methode="post">

<div class="modal fade" id="paypalModal" data-backdrop="static" data-keyboard=false tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="paypalModalLabel"><center>Bestellung für <?php echo $profile["vorname"]; echo " "; echo $profile["nachname"] ?> - <?php include"getprice.php"; echo $price; ?>€</center></h4>

            </div>
            <div class="modal-title">
            <?php
        if
            (
                !empty($profile["bread"])&&
                !empty($profile["size"])&&
                !empty($profile["meat"])&&
                !isset($profile["onlycoupon"])
            ) { ?>

            <ul class="list-group">
                <?php if(isset($profile["bread"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Bread"]; ?></span>
                        <p><?php echo $profile["bread"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["size"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Size"]; ?></span>
                        <p><?php echo $profile["size"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["meat"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Meat"]; ?></span>
                        <p><?php print(implode( ', ', $profile["meat"]))?>
                            <?php if(isset($profile['doublemeat'])) { ?>
                                <span class="label label-default">Doppelt</span>
                            <?php } ?>
                        </p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["cheese"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Cheese"]; ?></span>
                        <p><?php print(implode( ', ', $profile["cheese"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["salad"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Salad"]; ?></span>
                        <p><?php print(implode( ', ', $profile["salad"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["sauce"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Sauce"]; ?></span>
                        <p><?php print(implode( ', ', $profile["sauce"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["extras"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Extras"]; ?></span>
                        <p><?php print(implode( ', ', $profile["extras"])); ?></p>
                    </li>
                <?php } ?>
            <?php if(!empty($profile["coupon"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Coupon"]; ?></span>
                        <?php foreach ($gutschein as $gutscheine) {
                                    foreach ($gutscheine as $Sub) {
                                        if (is_array($Sub) and in_array($Sub["name"],$profile["coupon"]) and strtotime(date("d.m.Y")) >= strtotime($Sub["dates"]) and strtotime(date("d.m.Y")) <= strtotime($Sub["datee"])) {
                                            ?><p><?php print(implode(", ",str_replace("_"," ",$profile["coupon"]))); ?></p> <?php
                                        };
                                    };
                              };?>

                </li>
                <?php } ?>
                <?php if(!empty($profile["Bemerkung"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Comment"]; ?></span>
                        <p style="word-break:break-all;word-wrap:break-word"><?php echo $profile["Bemerkung"]; ?></p>
                    </li>
                <?php } ?>
            </ul>
                <?php } else if(isset($profile["onlycoupon"])) { ?>
                <?php if(!empty($profile["coupon"])) { ?>
                <ul>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Coupons"]; ?></span>
                        <?php foreach ($gutschein as $gutscheine) {
                                    foreach ($gutscheine as $Sub) {
                                        if (is_array($Sub) and in_array($Sub["name"],$profile["coupon"]) and strtotime(date("d.m.Y")) >= strtotime($Sub["dates"]) and strtotime(date("d.m.Y")) <= strtotime($Sub["datee"])) {
                                            ?><p><?php print(implode(", ",str_replace("_"," ",$profile["coupon"]))); ?></p> <?php
                                        };
                                    };
                              };?>

                    </li>
                </ul>
                <?php } } ?>
            </div>
            <div class="modal-body">
                <center>
                    <button type="submit" class="btn btn-primary" id="paypalYes"><?php echo $config["Text"]["Pay-with-paypal"]; ?></button>
                    <a href="#kunde-<?php echo $profile["profileid"]; ?>" type="button" class="btn btn-primary" id="barYes"><?php echo $config["Text"]["Pay-with-money"]; ?></a>
                    <button type="button" class="btn btn-secondary" id="paypalNo"><?php echo $config["Text"]["Close-btn"]; ?></button>
                </center>
            </div>
        </div>
    </div>
</div>
<?php if(!isset($profile["onlycoupon"])) {?>
   <input type="hidden" name="cmd" value="_cart" />
   <input type="hidden" name="upload" value="1" />
   <input type="hidden" name="business"
      value="<?php echo $mail ?>" />
   <input type="hidden" name="item_name_1"
      value="Dein Sub" />
    <input type="hidden" name="amount_1" value="<?php echo $price ?>" />
   <input type="hidden" name="item_name_2"
      value="Brot: <?php echo $profile["bread"]; ?>" />
    <input type="hidden" name="amount_2" value="0.00" />
   <input type="hidden" name="item_name_3"
      value="Groesse: <?php echo $profile["size"]; ?>" />
    <input type="hidden" name="amount_3" value="0.00" />
   <input type="hidden" name="item_name_4"
      value="Fleisch: <?php  echo implode(", ", $profile["meat"]); ?>" />
    <input type="hidden" name="amount_4" value="0.00" />
   <input type="hidden" name="item_name_5"
      value="Kaese : <?php echo implode(", ", $profile["cheese"]); ?>" />
    <input type="hidden" name="amount_5" value="0.00" />
   <input type="hidden" name="item_name_6"
      value="Gemuese: <?php echo implode(", ", $profile["salad"]); ?>" />
    <input type="hidden" name="amount_6" value="0.00" />
   <input type="hidden" name="item_name_7"
      value="Sosse: <?php echo implode(", ", $profile["sauce"]); ?>" />
    <input type="hidden" name="amount_7" value="0.00" />
   <input type="hidden" name="item_name_8"
      value="Extras: <?php echo implode(", ", $profile["extras"]); ?>" />
    <input type="hidden" name="amount_8" value="0.00" />
    <input type="hidden" name="item_name_9"
      value="Gutscheine: <?php echo implode(", ", $profile["coupon"]); ?>" />
    <input type="hidden" name="amount_9" value="0.00" />
   <input type="hidden" name="currency_code" value="EUR">
   <input type="hidden" name="custom" value="<?php echo $profile["profileid"]; ?>" />
   <input type="submit" hidden/>
<?php } else { ?>
   <input type="hidden" name="cmd" value="_cart" />
   <input type="hidden" name="upload" value="1" />
   <input type="hidden" name="business"
      value="<?php echo $mail ?>" />
   <input type="hidden" name="item_name_1"
      value="Dein Gutschein" />
   <input type="hidden" name="amount_1" value="<?php echo $price ?>" />
   <input type="hidden" name="currency_code" value="EUR">
   <input type="hidden" name="custom" value="<?php echo $profile["profileid"]; ?>" />
   <input type="submit" hidden/>
    <?php } ?>
</form>
