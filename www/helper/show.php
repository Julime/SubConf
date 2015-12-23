<?php
    include"read.php";
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
            ) { ?>
<!--<div class="hidden-print">-->
<h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?> - <?php include "getprice.php"; echo $price; ?>€</h3>
            <ul class="list-group">
                <?php if(isset($profile["bread"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Brot</span>
                        <p><?php echo $profile["bread"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["size"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Größe</span>
                        <p><?php echo $profile["size"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["meat"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Fleisch</span>
                        <p><?php print(implode( ', ', $profile["meat"]))?>
                            <?php if(isset($profile['doublemeat'])) { ?>
                                <span class="label label-default">Doppelt</span>
                            <?php } ?>
                        </p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["cheese"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Käse</span>
                        <p><?php print(implode( ', ', $profile["cheese"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["salad"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Gemüse</span>
                        <p><?php print(implode( ', ', $profile["salad"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["sauce"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Sauce</span>
                        <p><?php print(implode( ', ', $profile["sauce"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["extras"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Extras</span>
                        <p><?php print(implode( ', ', $profile["extras"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(!empty($profile["coupon"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Gutscheine</span>
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
                        <span class="lead clearfix">Bemerkung</span>
                        <p><?php echo $profile["Bemerkung"]; ?></p>
                    </li>
                <?php } ?>
            </ul>

        <?php } else if(key_exists("onlycoupon",$profile)) { ?>
        <ul class="list-group">  <?php
           if(!empty($profile["coupon"])) { ?>
            <h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?> - <?php include "getprice.php"; echo $price; ?>€</h3>
                    <li class="list-group-item">
                        <span class="lead clearfix">Gutscheine</span>
                        <p><?php print(implode(", ",str_replace("_"," ",$profile["coupon"]))); ?></p>
                    </li>
                <?php } ?>
            <?php if(!empty($profile["Bemerkung"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Bemerkung</span>
                        <p><?php echo $profile["Bemerkung"]; ?></p>
                    </li>
                <?php } ?>
        </ul> <?php
            };
        };
    };
?>
<!--</div>-->
<script>
    window.location.href="#top";
</script>
