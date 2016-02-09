        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="../js/jquery-2.1.1-min.js"></script>

        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../css/theme.css" rel="stylesheet">

<body OnLoad="window.print(); document.location.href = '/';">
<table class="table table-striped table-bordered klein">
<tr>
    <th>Name</th>
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
                    !empty($profile["meat"])||
                    isset($profile["onlycoupon"])
                ) { $number=$number+1;?>
    <th><?php echo $number.". ". $profile["vorname"]." ".$profile["nachname"]; ?></th>
    <?php } } }?>
</tr><tr><td>Brot</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!isset($profile["onlycoupon"])) { ?>
                <td><?php echo $profile["bread"]; ?></td><?php
                } else {?>
    <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Größe</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!isset($profile["onlycoupon"])) { ?>
                <td><?php echo $profile["size"]; ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Fleisch</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!isset($profile["onlycoupon"])) { ?>
                <td><?php echo implode(", ",$profile["meat"]); ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Käse</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!isset($profile["onlycoupon"]) && !empty($profile["cheese"])) { ?>
                <td><?php echo implode(", ",$profile["cheese"]); ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Gemüse</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!isset($profile["onlycoupon"]) && !empty($profile["salad"])) { ?>
                <td><?php if(count($profile["salad"])==8) { echo "Alles"; } else if(count($profile["salad"])==0) { echo "Nichts"; } else if(count($profile["salad"])>4) { echo "Alles außer: "; foreach($config["Salad"] as $salad) { if(!in_array($salad["name"],$profile["salad"])) { echo $salad["name"].", "; } } } else { echo "Nur: "; foreach($config["Salad"] as $salad) { if(in_array($salad["name"],$profile["salad"])) { echo $salad["name"].", "; } } } ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Sauce</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true" ){

                if(!isset($profile["onlycoupon"])&& !empty($profile["sauce"])) { ?>
                <td><?php echo implode(", ",$profile["sauce"]); ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Extras</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!isset($profile["onlycoupon"]) && !empty($profile["extras"])) { ?>
                <td><?php echo implode(", ",$profile["extras"]); ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Cookies</td>
    <?php
    foreach ($profiles as $path)
    {
        $empty=true;
        $string = file_get_contents($path);
        $profile=json_decode($string,true);
        if($profile["signed"]=="true"){?>
        <td><?php
                    foreach($config["Cookie"] as $cookie){
                        if(intval($profile["cookies"][$cookie["name"]])>0){
                            $empty=false; echo $cookie["name"].": ". $profile["cookies"][$cookie["name"]].", ";
                        }
                    }
                if($empty==true) {
                        echo"-";
                    }?>
    </td><?php }
    }?>
    </tr>
    <tr><td>Gutscheine</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!empty($profile["coupon"])) { ?>
                <td><?php echo str_replace("_"," ",implode(", ",$profile["coupon"])); ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>
    <tr><td>Bemerkung</td>
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!empty($profile["Bemerkung"])) { ?>
                <td style="word-break:break-all;word-wrap:break-word"><?php echo $profile["Bemerkung"]; ?></td><?php
                } else {?>
                <td>-</td>
                <?php }
            }
    }?>
    </tr>

    </table>
    <div style="page-break-before:always;">
    <?php
    foreach ($profiles as $path)
    {
        $string = file_get_contents($path);
        $profile=json_decode($string,true);

            if($profile["signed"]=="true"){

                if(!empty($profile["coupon"])) {
                    foreach($gutschein as $gutscheine) {
                        foreach($gutscheine as $Sub) {
                            if(isset($Sub["picture"]) && !empty($Sub["picture"]) && in_array($Sub["name"],$profile["coupon"])) {
                                echo "<img src='../img/Gutscheine/".$Sub["picture"]."' class='picture'>";
                            }
                        }
                    }
                }
            }
    }?>
    </div>

</body>
