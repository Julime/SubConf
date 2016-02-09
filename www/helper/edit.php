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
    <input type="hidden" name="profileid" value="<?php echo $profile["profileid"]; ?>">
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
                    if(!isset($meat["type"]) || ($meat["type"]!="double" && $meat["type"]!="extra")) {
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
                        <input type="checkbox" name="cheese[]" value="<?php echo $cheese['name']; ?>" <?php if(in_array($cheese['name'], $profile['cheese'])): echo 'checked'; endif; ?>> <?php echo $cheese['name']; ?><small><?php if (key_exists("price",$cheese)){ echo $cheese['price']; } ?></small>
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
        <li class="list-group-item">
            <span class="lead clearfix">Cookies</span>

            <div class="btn-group" data-toggle="buttons">

                <?php
                foreach ($config['Cookie'] as $cookie)
                { ?>

                    <label class="btn-primary <?php if(in_array($cookie['name'], $profile['cookie'])): echo 'active'; endif; ?>">
                         <?php echo $cookie['name']; ?><input style="width:40px; color:black;" type="number" min="0" name="cookie[<?php echo $cookie["name"]; ?>]" value="<?php if(isset($profile["cookie"][$cookie["name"]])){ echo $profile["cookie"][$cookie["name"]]; } else {echo "0";} ?>">
                    </label>

                <?php } ?>

            </div>
        </li>
        <li class="list-group-item">
            <span class ="lead clearfix">Bemerkung</span>
            <textarea rows="4" cols="25" name="Bemerkung"><?php if(isset($profile["Bemerkung"])){echo $profile["Bemerkung"];} ?></textarea>
        </li>
        <span class="lead clearfix"><br>Gutscheine</span>
        <?php foreach ($gutschein as $gutscheine) { ?>
                <li class="list-group-item">
                    <span class="lead clearfix"><?php echo $gutscheine["name"]; ?></span>
                    <div class="btn-group" data-toggle="buttons"><?php
                        foreach ($gutscheine as $Sub) {
                            if (is_array($Sub) and array_key_exists("name",$Sub) and array_key_exists("dates",$Sub) and array_key_exists("datee",$Sub) and array_key_exists("price",$Sub) and strtotime(date("d.m.Y")) >= strtotime($Sub["dates"]) and strtotime(date("d.m.Y")) <= strtotime($Sub["datee"])) {
                ?>

                    <label class="btn btn-primary <?php if(in_array($Sub["name"], $profile["coupon"])): echo 'active'; endif; ?>" data-toggle="popover" data-trigger="hover" title="Deine Bestellung kostet <?php if(!strpos($Sub["type"],"€weniger")){echo "nur "; }?><?php echo $Sub["price"]; echo "€ "; if(strpos($Sub["type"],"€mehr")){echo "mehr";} else if(strpos($Sub["type"],"€weniger")){echo" weniger";} ; ?>. Verfügbar vom <?php echo $Sub["dates"]; ?> bis zum <?php echo $Sub["datee"];?>. Dieser Gutschein bezieht sich <?php if ($Sub["sub"]=="None"){echo "nicht ";}?>auf deinen Sub">
                        <img src="../img/Gutscheine/<?php echo $Sub["picture"]; ?>" class="<?php if(isset($Sub["picture"]) && !empty($Sub["picture"])){ echo "picture"; }  ?>" alt="<?php echo $Sub["picture"]; ?>">
                        <input type="checkbox" name="coupon[]" value="<?php echo $Sub['name']; ?>" <?php if(!empty($profile["coupon"]) and in_array($Sub['name'],$profile["coupon"])): echo 'checked'; endif; ?> > <?php if(!isset($Sub["picture"]) || empty($Sub["picture"])){ echo str_replace("_"," ",$Sub['name']);};?>
                    </label>

                <?php } }?>
                    </div>
                </li>
                <?php }?>
            <input type="hidden" name="signed" value="false">
    </ul>

    <div class="modal-footer">
        <label class="btn btn-secondary <?php if(in_array($salad['name'], $profile['salad'])): echo 'active'; endif; ?>">
        <input type="checkbox" name="onlycoupon" <?php if(key_exists("onlycoupon", $profile)){echo "checked";} ?>> Nur Gutschein<span class="glyphicon glyphicon-info-sign" data-toggle="popover" data-trigger="hover" title="Nur auswählen wenn du nur einen Gutschein haben willst der sich nicht auf deinen Sub bezieht! Das kannst du herausfinden indem du über dem Gutschein Hoverst"></span>
    </label>
        <button class="btn btn-default dismiss-btn" type="button">Schließen</button>
        <button type="button" class="btn btn-primary pull-right" data-loading-text="Wird gespeichert ..." data-toggle="modal" data-target="#passwortmodal">Änderungen speichern</button>
    </div>

<!-- Modal -->
<div class="modal fade" id="passwortmodal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="passwortmodallabel">
  <div class="modal-dialog">
    <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Passwort</h4>
          </div>
          <div class="modal-body">
            <div class="col-lg-12"><input class="form-control" type="password" required name="passwort" placeholder="Passwort" autofocus></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" data-dismiss="modal" class="btn btn-primary clearfix save-btn">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>

</form>
