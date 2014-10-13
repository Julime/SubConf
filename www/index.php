<?php include 'header.php'; ?>
<?php include 'helper/read.php'; ?>

            <div class="page-header">
                <h1>SubConf</h1>
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-sm-4">
                            <div class="list-group member-list">
                            
                            <?php
                            foreach ($profiles as $path)
                            {
                                $string = file_get_contents($path);
                                $profile=json_decode($string,true);

                                ?>

                                    <div class="input-group">
                                        <span class="input-group-addon"><input type="checkbox"></span>
                                        <a href="#<?php echo $profile["hash"]; ?>" data-toggle="tab" class="list-group-item">
                                            <h4 class="list-group-item-heading"><?php echo $profile["name"]; ?> <span class="badge pull-right">5€</span></h4>
                                            <p class="list-group-item-text">
                                                <small><?php echo $profile["meat"]; ?> - <?php echo $profile["size"]; ?></small>
                                            </p>
                                        </a>
                                    </div>
                            <?php } ?>
		
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-5 col-sm-5 tab-content border-left">
                            
                            <?php
                            foreach ($profiles as $path)
                            {
                                $string = file_get_contents($path);
                                $profile=json_decode($string, true);
                                
                                ?>
                            
                                <div class="tab-pane" id="<?php echo $profile["hash"]; ?>">
                                    <h3>Michael</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Brot</span>
                                            <p><?php echo $profile["bread"]; ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Größe</span>
                                            <p><?php echo $profile["size"]; ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Fleisch</span>
                                            <p><?php echo $profile["meat"]; ?>
                                                <?php if(isset($profile['doublemeat'])) { ?>
                                                    <span class="label label-default">Doppelt</span>
                                                <?php } ?>
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Käse</span>
                                            <p><?php print(implode( ', ', $profile["cheese"])); ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Gemüse</span>
                                            <p><?php print(implode( ', ', $profile["salad"])); ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Sauce</span>
                                            <p><?php print(implode( ', ', $profile["sauce"])); ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Extras</span>
                                            <p><?php print(implode( ', ', $profile["extras"])); ?></p>
                                        </li>
                                    </ul>
                                    <div><p><button type="button" class="btn btn-default pull-right clearfix">Bearbeiten</button></p></div>
                                </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php'; ?>