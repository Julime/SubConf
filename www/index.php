<?php include 'header.php'; ?> <!-- all data needed is included here -->

            <div class="page-header">
                <h1><?php echo $config["Text"]["Title"]; ?></h1>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="user-list hidden-print">

                            <div class="col-sm-4">
                                <h3><?php echo $config["Text"]["Accounts"]; ?>
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#AddNewProfile">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" id="Print">
                                            <?php echo $config["Text"]["Print-btn"]; ?>
                                        </button>
                                    </div>
                                </h3>

                            <div class="list-group member-list" id="listgroup">

                            <?php
                            foreach ($profiles as $path) //get every profile and list them down below ($profiles comes from header.php)
                            {
                                $string = file_get_contents($path);
                                $profile=json_decode($string,true);

                                ?>

                                    <div class="input-group"> <!-- creat a new input group for the current profile -->
                                        <span class="input-group-addon"><input type="checkbox" id="cb-<?php echo $profile["profileid"]; ?>"  onClick="$('.tab-content').load('helper/teilnehmer.php?profileid=<?php echo $profile["profileid"]; ?>'); document.getElementById('cb-<?php echo $profile["profileid"] ?>').checked=false;" <?php   //onClick: load the teilnehmer.php(teilnehmer=subscriber)
        if(isset($profile["signed"]) and $profile["signed"]=="true") { //don't allow the user to unsign if he allready payed his sub
            echo "checked ";
            echo "disabled";
        }
?>></span>
                                        <a href="#user-<?php echo $profile["profileid"]; ?>" id="id-<?php echo $profile["profileid"]; ?>" data-toggle="tab" class="list-group-item" onClick="if(!document.getElementById('cb-<?php echo $profile["profileid"] ?>').disabled==true) { if($(this).hasClass('active')) { $('.tab-content').load('helper/show.php'); } else { $('.tab-content').load('helper/edit.php?profileid=<?php echo $profile["profileid"]; ?>') } }"><!-- define the link to provide the information to work with later on in footer.php, onClick: if this is not payed allready {toggle the profile} -->
                                            <h4 class="list-group-item-heading"><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?><?php if(isset($profile["price"])) { ?> <span class="badge pull-right"><?php echo $profile["price"]; ?></span><?php } ?></h4>
                                            <p class="list-group-item-text" id="list-group-item-text-<?php echo $profile["profileid"]; ?>">
                                                <?php
if(isset($profile["meat"])&&isset($profile["size"])) { if(!isset($profile["onlycoupon"])) {?><small><?php print(implode(", ", $profile["meat"])); ?> - <?php echo $profile["size"]; ?> - <?php }include "helper/getprice.php"; echo $price; ?>€</small><?php } ?>
                                            </p><!-- write the name in the field; nachname=lastname vorname=firstname -->
                                        </a>
                                    </div>
                            <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content col-lg-8 col-md-5 col-sm-5 border-left"><!-- a small div that is invisible but will be used later to load some scripts in -->
                    </div>
                </div>
            </div>
        </div>

<?php include 'footer.php'; ?> <!-- in the footer.php is all the script -->
