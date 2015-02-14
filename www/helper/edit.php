    <?php 
    
    if (!isset($profile["profileid"]))
    {
        echo '<div class="alert alert-info" role="alert">Profile-ID nachgeladen</div>';
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
    
    <ul class="list-group">
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
                
                    <label class="btn btn-primary <?php if($profile['cheese'] == $cheese['name']): echo 'active'; endif; ?>">
                        <input type="checkbox" name="cheese" value="<?php echo $cheese['name']; ?>" <?php if($profile['cheese'] == $cheese['name']): echo 'checked'; endif; ?>> <?php echo $cheese['name']; ?>
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
                
                    <label class="btn btn-primary <?php if($profile['salad'] == $salad['name']): echo 'active'; endif; ?>">
                        <input type="checkbox" name="salad" value="<?php echo $salad['name']; ?>" <?php if($profile['salad'] == $salad['name']): echo 'checked'; endif; ?>> <?php echo $salad['name']; ?>
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
                
                    <label class="btn btn-primary <?php if($profile['sauce'] == $sauce['name']): echo 'active'; endif; ?>">
                        <input type="checkbox" name="sauce" value="<?php echo $sauce['name']; ?>" <?php if($profile['sauce'] == $sauce['name']): echo 'checked'; endif; ?>> <?php echo $sauce['name']; ?>
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
                
                    <label class="btn btn-primary <?php if($profile['extras'] == $extras['name']): echo 'active'; endif; ?>">
                        <input type="checkbox" name="extras" value="<?php echo $extras['name']; ?>" <?php if($profile['extras'] == $extras['name']): echo 'checked'; endif; ?>> <?php echo $extras['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
    </ul>
<div><p><button type="submit" class="btn btn-default pull-right clearfix save-btn" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!">Speichern</button></p></div>
</form>