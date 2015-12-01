<?php
    if (!isset($profile["profileid"]))
    {
        include($_SERVER['DOCUMENT_ROOT'].'/helper/read.php');
        $profileid = $_GET['profileid'];

        $path = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
        $string = file_get_contents($path);
        $profile=json_decode($string, true);
    }

?>
<h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?></h3>

<form id="editform">

    <input type="hidden" name="signed" value="<?php echo $profile["signed"]; ?>">
    <input type="hidden" name="vorname" value="<?php echo $profile["vorname"]; ?>">
    <input type="hidden" name="nachname" value="<?php echo $profile["nachname"]; ?>">
    <input type="hidden" name="email" value="<?php echo $profile["email"]; ?>">
    
    <ul class="list-group">
        <span class="lead clearfix">Sub</span>
        <li class="list-group-item">
            <span class="lead clearfix">Brot</span>
            
            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config["Bread"] as $bread)
                {  ?>

                    <label class="btn btn-primary <?php if($profile['bread'] == $bread['name']): echo 'active'; endif; ?>">
                        <input type="radio" name="bread" value="<?php echo $bread['name']; ?>" <?php if($profile['bread'] == $bread['name']): echo 'checked'; endif; ?>> <?php echo $bread['name']; ?>
                    </label>

                <?php } ?>
                
            </div>
            
        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Größe</span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Size'] as $size)
                { ?>
                
                    <label class="btn btn-primary <?php if($profile['size'] == $size['name']): echo 'active'; endif; ?>">
                        <input type="radio" name="size" id="<?php echo $size['name']; ?>" value="<?php echo $size['name']; ?>" <?php if($profile['size'] == $size['name']){ echo 'checked'; }; ?>> <?php echo $size['name'];?> <small> <?php echo $size["price"]; ?> </small>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Fleisch</span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                    foreach ($config['Meat']['sorts'] as $meat) {
                    if($meat["name"]!="Doppelt Fleisch") {
                ?>

                    <label class="btn btn-primary <?php if(in_array($meat['name'], $profile["meat"])): echo 'active'; endif; ?>">
                        <input type="radio" name="meat[]" value="<?php echo $meat['name']; ?>" <?php if(in_array($meat['name'], $profile["meat"])){ echo 'checked'; }; ?>> <?php echo $meat['name'];?> <small> <?php echo $meat["price"]; ?></small>
                    </label>
                
                <?php } else { ?>
                    <label class="btn btn-primary <?php if(in_array($meat['name'], $profile["meat"])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="meat[]" value="<?php echo $meat['name']; ?>" <?php if(in_array($meat['name'], $profile["meat"])){ echo 'checked'; }; ?>> <?php echo $meat['name'];?> <small> <?php echo $meat["price"];?></small>
                    </label>
                <?php }
                }; ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Käse</span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Cheese'] as $cheese)
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($cheese['name'], $profile['cheese'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="cheese[]" value="<?php echo $cheese['name']; ?>" <?php if(in_array($cheese['name'], $profile['cheese'])): echo 'checked'; endif; ?>> <?php echo $cheese['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Gemüse</span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Salad'] as $salad)
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($salad['name'], $profile['salad'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="salad[]" value="<?php echo $salad['name']; ?>" <?php if(in_array($salad['name'], $profile['salad'])): echo 'checked'; endif; ?>> <?php echo $salad['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Soße</span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Sauce'] as $sauce)
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($sauce['name'], $profile['sauce'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="sauce[]" value="<?php echo $sauce['name']; ?>" <?php if(in_array($sauce['name'], $profile['sauce'])): echo 'checked'; endif; ?>> <?php echo $sauce['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Extras</span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Extras'] as $extras)
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($extras['name'], $profile['extras'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="extras[]" value="<?php echo $extras['name']; ?>" <?php if(in_array($extras['name'], $profile['extras'])): echo 'checked'; endif; ?>> <?php echo $extras['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>
        </li>
            <span class="lead clearfix"><br>Gutscheine</span>
        <?php foreach ($gutschein as $gutscheine) { ?>
                <li class="list-group-item">
                    <div class="btn-group" data-toggle="buttons">
                        <span class="lead clearfix"><?php echo $gutscheine["name"]; ?></span><?php
                        foreach ($gutscheine as $Sub) {
                            if (is_array($Sub) and array_key_exists("name",$Sub) and array_key_exists("count",$Sub) and array_key_exists("dates",$Sub) and array_key_exists("datee",$Sub) and array_key_exists("price",$Sub)) {
                ?>

                    <label class="btn btn-primary <?php if(in_array($Sub["name"], $profile["coupon"])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="coupon[]" value="<?php echo $Sub['name']; ?>" <?php if(in_array($Sub['name'],$profile["coupon"])): echo 'checked'; endif; ?>> <?php echo $Sub['name'];?>
                    </label>

                <?php } }?>
                    </div>
                </li>
                <?php }?>
        <input type="hidden" name="signed" value="false">
    </ul>
    <div class="modal-footer">
        <button class="btn btn-default dismiss-btn" type="button">Schließen</button>
        <button type="submit" class="btn btn-primary pull-right clearfix save-btn" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!">Änderungen speichern</button>
    </div>
</form>
