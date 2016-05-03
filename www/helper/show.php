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
<h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?> - <?php include "getprice.php"; echo $price; ?>€</h3>
            <ul class="list-group">
                <?php if(isset($profile["bread"])) { //show all bread sorts and the selected?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Bread"]; ?></span>
                        <p><?php echo $profile["bread"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["size"])) { //show all sizes and the selected?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Size"]; ?></span>
                        <p><?php echo $profile["size"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["meat"])) { //show all meat sorts and the selected one?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Meat"]; ?></span>
                        <p><?php print(implode( ', ', $profile["meat"]))?>
                            <?php if(isset($profile['doublemeat'])) { ?>
                                <span class="label label-default">Doppelt</span>
                            <?php } ?>
                        </p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["cheese"])) { //show all cheese sorts and the selected one ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Cheese"]; ?></span>
                        <p><?php print(implode( ', ', $profile["cheese"])); ?></p>
                    </li>
                <?php } ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Salad"]; //show all salads and the selected one?></span>
                        <p><?php if(count($profile["salad"])==8) { echo "Alles"; } else if(count($profile["salad"])==0) { echo "Nichts"; } else if(count($profile["salad"])>4) { echo "Alles außer: "; foreach($config["Salad"] as $salad) { if(!in_array($salad["name"],$profile["salad"])) { echo $salad["name"].", "; } } } else { echo "Nur: "; foreach($config["Salad"] as $salad) { if(in_array($salad["name"],$profile["salad"])) { echo $salad["name"].", "; } } } ?></p>
                    </li>
                <?php if(isset($profile["sauce"])) { //show all sauces and the selected one ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Sauce"]; ?></span>
                        <p><?php print(implode( ', ', $profile["sauce"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["extras"])) { //show all extras and the selected one ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Extras"]; ?></span>
                        <p><?php print(implode( ', ', $profile["extras"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(!empty($profile["coupon"])) { //show all available coupons and the selected one ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Coupons"]; ?></span>
                        <p><?php print(implode(", ",str_replace("_"," ",$profile["coupon"]))); ?></p>
                    </li>
                <?php } ?>
                <?php if(!empty($profile["Bemerkung"])) { //show the comment ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Comment"]; ?></span>
                        <p  class="comment"><?php echo $profile["Bemerkung"]; ?></p>
                    </li>
                <?php } ?>
            </ul>

        <?php } else if(key_exists("onlycoupon",$profile)) { //check if only coupon is checked if yes don't show the sub?>
        <ul class="list-group">  <?php
           if(!empty($profile["coupon"])) { ?>
            <h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?> - <?php include "getprice.php"; echo $price; ?>€</h3>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Coupon"]; ?></span>
                        <p><?php print(implode(", ",str_replace("_"," ",$profile["coupon"]))); ?></p>
                    </li>
                <?php } ?>
            <?php if(!empty($profile["Bemerkung"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix"><?php echo $config["Text"]["Comment"]; ?></span>
                        <p style="word-break:break-all;word-wrap:break-word"><?php echo $profile["Bemerkung"]; ?></p>
                    </li>
                <?php } ?>
        </ul> <?php
            };
        };
    };
?>
<script>
    window.location.href="#top"; //allways be at the top of the page
</script>
