<form id="editform">
    <input type="hidden" name="vorname" value="<?php echo $profile["vorname"]; ?>">
    <input type="hidden" name="nachname" value="<?php echo $profile["nachname"]; ?>">
    <input type="hidden" name="email" value="<?php echo $profile["email"]; ?>">

    <?php 
    
    $profileid = $_GET['profileid'];
    
    $path = '../profiles/'.$profileid.'.json';
    $string = file_get_contents($path);
    $profile=json_decode($string, true);
    
    print_r($profile);
    ?>
    
    <ul class="list-group">
        <li class="list-group-item">
            <span class="lead clearfix">Brot</span>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php if($profile["bread"]=="Honey Oat"): echo "active"; endif; ?>">
                    <input required type="radio" name="bread" <?php // if(isset($profile["bread"])&&$profile["bread"]=="Honey Oat") {} ?> value="Honey Oat"> Honey Oat
                </label>
                <label class="btn btn-primary <?php if($profile["bread"]=="Italian"): echo "active"; endif; ?>">
                    <input required type="radio" name="bread" value="Italian"> Italian
                </label>
                <label class="btn btn-primary <?php if($profile["bread"]=="Vollkorn"): echo "active"; endif; ?>">
                    <input required type="radio" name="bread" value="Vollkorn"> Vollkorn
                </label>
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Größe</span>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php if($profile["size"]=="15cm"): echo "active"; endif; ?>">
                    <input required type="radio" name="size" value="15cm"> 15cm
                </label>
                <label class="btn btn-primary <?php if($profile["size"]=="30cm"): echo "active"; endif; ?>">
                    <input required type="radio" name="size" value="30cm"> 30cm
                </label>
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Fleisch</span>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php if($profile["meat"]=="Chicken Faijta"): echo "active"; endif; ?>">
                    <input required type="radio" name="meat" value="Chicken Faijta"> Chicken Faijta
                </label>
                <label class="btn btn-primary <?php if($profile["meat"]=="Tuna"): echo "active"; endif; ?>">
                    <input required type="radio" name="meat" value="Tuna"> Tuna
                </label>
                <label class="btn btn-primary <?php if($profile["meat"]=="Kein Fleisch"): echo "active"; endif; ?>">
                    <input required type="radio" name="meat" value="Kein Fleisch"> Kein Fleisch
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="doublemeat" value="Doppelt Fleisch"> Doppelt Fleisch
                </label>
            </div>
        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Käse</span>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php if($profile["cheese"]=="Scheibenkäse"): echo "active"; endif; ?>">
                    <input type="checkbox" name="cheese[]" value="Scheibenkäse"> Scheibenkäse
                </label>
                <label class="btn btn-primary <?php if($profile["cheese"]=="Frischkäse"): echo "active"; endif; ?>">
                    <input type="checkbox" name="cheese[]" value="Frischkäse"> Frischkäse
                </label>
                <label class="btn btn-primary <?php if($profile["cheese"]=="Cheddar"): echo "active"; endif; ?>">
                    <input type="checkbox" name="cheese[]" value="Cheddar"> Cheddar
                </label>
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Gemüse</span>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php if(in_array("Salat", $profile["salad"])): echo "active"; endif; ?>">
                    <input type="checkbox" name="salad[]" value="Salat"> Salat
                </label>
                <label class="btn btn-primary <?php if($profile["salad"]=="Gurke"): echo "active"; endif; ?>">
                    <input type="checkbox" name="salad[]" value="Gurke"> Gurke
                </label>
                <label class="btn btn-primary <?php if($profile["salad"]=="Tomate"): echo "active"; endif; ?>">
                    <input type="checkbox" name="salad[]" value="Tomate"> Tomate
                </label>
                <label class="btn btn-primary <?php if($profile["salad"]=="Pepperoni"): echo "active"; endif; ?>">
                    <input type="checkbox" name="salad[]" value="Pepperoni"> Pepperoni
                </label>
                <label class="btn btn-primary <?php if($profile["salad"]=="Oliven"): echo "active"; endif; ?>">
                    <input type="checkbox" name="salad[]" value="Oliven"> Oliven
                </label>
                <label class="btn btn-primary <?php if($profile["salad"]=="Tomate"): echo "active"; endif; ?>">
                    <input type="checkbox" name="salad[]" value="Tomate"> Tomate
                </label>
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Sauce</span>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="checkbox" name="sauce[]" value="Sweet Onion"> Sweet Onion
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="sauce[]" value="Chipotle Southwest"> Chipotle Southwest
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="sauce[]" value="BBQ"> BBQ
                </label>
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix">Extras</span>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="checkbox" name="extras[]" value="Salz"> Salz
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="extras[]" value="Pfeffer"> Pfeffer
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="extras[]" value="Oregano"> Oregano
                </label>
            </div>

        </li>
    </ul>
<div><p><button type="submit" class="btn btn-default pull-right clearfix save-btn" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!">Speichern</button></p></div>
</form>