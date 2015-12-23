<?php include 'header.php'; ?>

            <div class="page-header">
                <h1>SubConf</h1>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="user-list hidden-print">

                            <div class="col-sm-4">
                                <h3>Besteller
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#AddNewProfile">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" id="Print">
                                            Print
                                        </button>
                                    </div>
                                </h3>

                            <div class="list-group member-list">

                            <?php
                            foreach ($profiles as $path)
                            {
                                $string = file_get_contents($path);
                                $profile=json_decode($string,true);

                                ?>

                                    <div class="input-group">
                                        <span class="input-group-addon"><input type="checkbox" id="cb-<?php echo $profile["profileid"]; ?>"  onClick="$('.tab-content').load('helper/teilnehmer.php?profileid=<?php echo $profile["profileid"]; ?>'); document.getElementById('cb-<?php echo $profile["profileid"] ?>').checked=false;" <?php
        if(isset($profile["signed"]) and $profile["signed"]=="true") {
            echo "checked ";
            echo "disabled";
        }
?>></span>
                                        <a href="#user-<?php echo $profile["profileid"]; ?>" data-toggle="tab" class="list-group-item" onClick="if(!document.getElementById('cb-<?php echo $profile["profileid"] ?>').disabled==true) { if($(this).hasClass('active')) { $('.tab-content').load('helper/show.php'); } else { $('.tab-content').load('helper/edit.php?profileid=<?php echo $profile["profileid"]; ?>') } }">
                                            <h4 class="list-group-item-heading"><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?><?php if(isset($profile["price"])) { ?> <span class="badge pull-right"><?php echo $profile["price"]; ?></span><?php } ?></h4>
                                            <p class="list-group-item-text" id="list-group-item-text-<?php echo $profile["profileid"]; ?>">
                                                <?php
if(isset($profile["meat"])&&isset($profile["size"])) { ?><small><?php print(implode(", ", $profile["meat"])); ?> - <?php echo $profile["size"]; ?> - <?php include "helper/getprice.php"; echo $price; ?>€</small><?php } ?>
                                            </p>
                                        </a>
                                    </div>
                            <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-5 col-sm-5 tab-content border-left">
                    </div>
                </div>
            </div>
        </div>

<?php include 'footer.php'; ?>
