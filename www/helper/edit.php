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
<form id="editform">
    <input type="hidden" name="vorname" value="<?php echo $profile["vorname"]; ?>">
    <input type="hidden" name="nachname" value="<?php echo $profile["nachname"]; ?>">
    <input type="hidden" name="email" value="<?php echo $profile["email"]; ?>">
    
    <div class="tab-pane" id="<?php echo $profile["profileid"]; ?>">
        <h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?></h3></div>

    <ul class="list-group" id="edit-list">
        <li class="list-group-item">
            <span class="lead clearfix">Brot</span>
            
            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Bread'] as $bread)
                { ?>

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
                        <input type="radio" name="size" value="<?php echo $size['name']; ?>" <?php if($profile['size'] == $size['name']): echo 'checked'; endif; ?>> <?php echo $size['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Fleisch</span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Meat']['sorts'] as $meat)
                { ?>
                
                    <label class="btn btn-primary <?php if($profile['meat'] == $meat['name']): echo 'active'; endif; ?>">
                        <input type="radio" name="meat" value="<?php echo $meat['name']; ?>" <?php if($profile['meat'] == $meat['name']): echo 'checked'; endif; ?>> <?php echo $meat['name']; ?>
                    </label>
                
                <?php } ?>
                
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
    </ul>
    <div class="modal-footer" id="modal-footer-edit">
        <button class="btn btn-default dismiss-btn" type="button">Schließen</button>
        <button type="submit" class="btn btn-primary pull-right clearfix save-btn" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!">Speichern</button>
    </div>
</form>
