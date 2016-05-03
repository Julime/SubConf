<?php
    if (!isset($profile["profileid"])) //if no profile given
    { //get profile from the last set profileid
        include($_SERVER['DOCUMENT_ROOT'].'/helper/read.php');
        $profileid = $_GET['profileid'];

        $path = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
        $string = file_get_contents($path);
        $profile=json_decode($string, true);
    }

?>
<?php include "read.php"; ?>
<h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; //echo first and last name of the profile?></h3> 

<form id="editform"> <!-- creat form for the sub -->

    <!-- creat hidden inputs for data that should not be editet -->
    <input type="hidden" name="signed" value="<?php echo $profile["signed"]; ?>"> 
    <input type="hidden" name="profileid" value="<?php echo $profile["profileid"]; ?>">
    <input type="hidden" name="vorname" value="<?php echo $profile["vorname"]; ?>">
    <input type="hidden" name="nachname" value="<?php echo $profile["nachname"]; ?>">
    <input type="hidden" name="email" value="<?php echo $profile["email"]; ?>">
    
    <ul class="list-group">
        <span class="lead clearfix"><?php echo $config["Text"]["Sub"]; ?></span>
        <li class="list-group-item">
            <span class="lead clearfix"><?php echo $config["Text"]["Bread"]; ?></span>
            
            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config["Bread"] as $bread) //get all bread sorts
                {  ?>

                    <label class="btn btn-primary <?php if($profile['bread'] == $bread['name']): echo 'active'; endif; ?>">
                        <input type="radio" name="bread" value="<?php echo $bread['name']; ?>" <?php if($profile['bread'] == $bread['name']): echo 'checked'; endif; ?>> <?php echo $bread['name']; //show the bread sorts and mark the choosen as selected?>
                    </label>

                <?php } ?>
                
            </div>
            
        </li>
        <li class="list-group-item">
            <span class="lead clearfix"><?php echo $config["Text"]["Size"]; ?></span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Size'] as $size) //get all size options
                { ?>
                
                    <label class="btn btn-primary <?php if($profile['size'] == $size['name']): echo 'active'; endif; ?>">
                        <input type="radio" name="size" id="<?php echo $size['name']; ?>" value="<?php echo $size['name']; ?>" <?php if($profile['size'] == $size['name']){ echo 'checked'; }; ?>> <?php echo $size['name'];?> <small> <?php echo $size["price"]; ?> </small>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item"><span class="lead clearfix"><?php echo $config["Text"]["Meat"]; ?> <small>(Sub des Tages: <?php echo $config["Data"]["Subofday".date("N")]; ?>)</small> </span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                    foreach ($config['Meat']['sorts'] as $meat) { //get all meat sorts
                    if(!isset($meat["type"]) || ($meat["type"]!="double" && $meat["type"]!="extra")) { //look if it is a normal sort or an extra (double meat,bacon)
                ?>

                    <label class="btn btn-primary <?php if(in_array($meat['name'], $profile["meat"])): echo 'active'; endif; ?>">
                        <input type="radio" name="meat[]" value="<?php echo $meat['name']; ?>" <?php if(in_array($meat['name'], $profile["meat"])){ echo 'checked'; }; ?>> <?php echo $meat['name'];?> <small> <?php if($meat["name"]==$config["Data"]["Subofday".date("N")]) { echo "2.69€";} else { echo $meat["price"]; } ?></small>
                    </label>
                
                <?php } else { //if it is an extra ?>
                    <label class="btn btn-primary <?php if(in_array($meat['name'], $profile["meat"])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="meat[]" value="<?php echo $meat['name']; ?>" <?php if(in_array($meat['name'], $profile["meat"])){ echo 'checked'; }; ?>> <?php echo $meat['name'];?> <small> <?php echo $meat["price"];?></small>
                    </label>
                <?php }
                }; ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix"><?php echo $config["Text"]["Cheese"]; ?></span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Cheese'] as $cheese) //get all chesse sorts
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($cheese['name'], $profile['cheese'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="cheese[]" value="<?php echo $cheese['name']; ?>" <?php if(in_array($cheese['name'], $profile['cheese'])): echo 'checked'; endif; ?>> <?php echo $cheese['name']; ?><small><?php if (key_exists("price",$cheese)){ echo $cheese['price']; } ?></small>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix"><?php echo $config["Text"]["Salad"]; ?></span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Salad'] as $salad) //get all salad sorts
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($salad['name'], $profile['salad'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="salad[]" value="<?php echo $salad['name']; ?>" <?php if(in_array($salad['name'], $profile['salad'])): echo 'checked'; endif; ?>> <?php echo $salad['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix"><?php echo $config["Text"]["Sauce"]; ?></span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Sauce'] as $sauce) //get all sauces
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($sauce['name'], $profile['sauce'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="sauce[]" value="<?php echo $sauce['name']; ?>" <?php if(in_array($sauce['name'], $profile['sauce'])): echo 'checked'; endif; ?>> <?php echo $sauce['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>

        </li>
        <li class="list-group-item">
            <span class="lead clearfix"><?php echo $config["Text"]["Extras"]; ?></span>

            <div class="btn-group" data-toggle="buttons">
            
                <?php
                foreach ($config['Extras'] as $extras) //get all extras
                { ?>
                
                    <label class="btn btn-primary <?php if(in_array($extras['name'], $profile['extras'])): echo 'active'; endif; ?>">
                        <input type="checkbox" name="extras[]" value="<?php echo $extras['name']; ?>" <?php if(in_array($extras['name'], $profile['extras'])): echo 'checked'; endif; ?>> <?php echo $extras['name']; ?>
                    </label>
                
                <?php } ?>
                
            </div>
        </li>
        <li class="list-group-item">
            <span class="lead clearfix"><?php echo $config["Text"]["Cookies"]; ?></span>

            <div class="btn-group" data-toggle="buttons">

                <?php
                foreach ($config['Cookie'] as $cookie) //get all cookies
                { ?>
                    <div class="input-group spinner"> <!-- cookiefield design (by Julime) -->
                        <span class="input-group-addon"><?php echo $cookie['name']; ?></span>
                        <input type="text" class="form-control" name="cookie[<?php echo $cookie["name"]; ?>]" value="<?php if(isset($profile["cookie"][$cookie["name"]])){ echo $profile["cookie"][$cookie["name"]]; } else {echo "0";} ?>" min="0" max="5">
                        <div class="input-group-btn-vertical">
                            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-menu-up"></i></button>
                            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-menu-down"></i></button>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </li>
        <li class="list-group-item">
            <span class ="lead clearfix"><?php echo $config["Text"]["Comment"]; ?></span>
            <textarea rows="4" cols="25" name="Bemerkung"><?php if(isset($profile["Bemerkung"])){echo $profile["Bemerkung"];} ?></textarea><!-- creat a textarea and put the current commend from the profile in it -->
        </li>
        <span class="lead clearfix"><br><?php echo $config["Text"]["Coupons"]; ?></span>
        <?php foreach ($gutschein as $gutscheine) { //get all coupons?> 
                <li class="list-group-item">
                    <span class="lead clearfix"><?php echo $gutscheine["name"]; ?></span>
                    <div class="btn-group" data-toggle="buttons"><?php
                        foreach ($gutscheine as $Sub) {
                            //verify the coupon
                            if (is_array($Sub) and array_key_exists("name",$Sub) and array_key_exists("dates",$Sub) and array_key_exists("datee",$Sub) and array_key_exists("price",$Sub) and strtotime(date("d.m.Y")) >= strtotime($Sub["dates"]) and strtotime(date("d.m.Y")) <= strtotime($Sub["datee"]))
                            {
                ?>

                <!-- creat the tooltip with all important information about the coupon -->
                    <label class="btn btn-primary <?php if(in_array($Sub["name"], $profile["coupon"])): echo 'active'; endif; ?>" data-toggle="popover" data-trigger="hover" title="Deine Bestellung kostet <?php if(!strpos($Sub["type"],"€weniger")){echo "nur "; }?><?php echo $Sub["price"]; echo "€ "; if(strpos($Sub["type"],"€mehr")){echo "mehr";} else if(strpos($Sub["type"],"€weniger")){echo" weniger";} ; ?>. Verfügbar vom <?php echo $Sub["dates"]; ?> bis zum <?php echo $Sub["datee"];?>. Dieser Gutschein bezieht sich <?php if ($Sub["sub"]=="None"){echo "nicht ";}?>auf deinen Sub">
                    <!-- show the image of the coupon -->
                        <img src="../img/Gutscheine/<?php echo $Sub["picture"]; ?>" class="<?php if(isset($Sub["picture"]) && !empty($Sub["picture"])){ echo "picture"; }  ?>" alt="<?php echo $Sub["picture"]; ?>">
                        <input type="checkbox" name="coupon[]" value="<?php echo $Sub['name']; ?>" <?php if(!empty($profile["coupon"]) and in_array($Sub['name'],$profile["coupon"])): echo 'checked'; endif; ?> > <?php if(!isset($Sub["picture"]) || empty($Sub["picture"])){ echo str_replace("_"," ",$Sub['name']);};?> 
                    </label>

                <?php } }?>
                    </div>
                </li>
                <?php }?>
            <input type="hidden" name="signed" value="false"> <!-- creat the hidden value signed -->
    </ul>

    <div class="modal-footer">
        <label class="btn btn-secondary <?php if(in_array($salad['name'], $profile['salad'])): echo 'active'; endif; ?>">
        <input type="checkbox" name="onlycoupon" <?php if(key_exists("onlycoupon", $profile)){echo "checked";} ?>> <?php echo $config["Text"]["Only-coupon-btn"]; ?><span class="glyphicon glyphicon-info-sign" data-toggle="popover" data-trigger="hover" title="Nur auswählen wenn du nur einen Gutschein haben willst der sich nicht auf deinen Sub bezieht! Das kannst du herausfinden indem du über dem Gutschein Hoverst"></span>
    </label>
        <button class="btn btn-default dismiss-btn" type="button"><?php echo $config["Text"]["Close-btn"]; ?></button>
        <button type="button" id="<?php echo $config["Text"]["Save-changes-btn"]; ?>-btn" class="btn btn-primary pull-right" data-loading-text="Wird gespeichert ..." data-toggle="modal" data-target="#passwortmodal"><?php echo $config["Text"]["Save-changes-btn"]; ?></button>
        <button type="button" id="<?php echo $config["Text"]["Delete-btn"]; ?>-btn" class="btn btn-primary" data-toggle="modal" data-target="#passwortmodal"><?php echo $config["Text"]["Delete-btn"]; ?></button>
    </div>

<!-- Modal -->
<div class="modal fade" id="passwortmodal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="passwortmodallabel">
  <div class="modal-dialog">
    <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $config["Text"]["Password"]; ?></h4>
          </div>
          <div class="modal-body">
            <div class="col-lg-12"><input class="form-control" type="password" required name="passwort" placeholder="Passwort" autofocus></div>
          </div>
          <div class="modal-footer" id="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $config["Text"]["Close-btn"]; ?></button>
            <button type="submit" class="btn btn-primary" data-dismiss="modal">I will be changed</button></div>
        </form>
    </div>
  </div>
</div>

</form>

<script>
$(function(){


    $('#passwortmodal').on("show.bs.modal", function(e) { //function to change the modal depending on the button pressed(save or delete)
        var esseyId = e.relatedTarget.id;//get the id
        document.getElementById("modal-footer").lastChild.innerHTML=esseyId.replace("-btn","");
        document.getElementById("modal-footer").lastChild.id=esseyId.replace("-btn","").replace(" ","_"); //replace the button id to do different thinks on Click
    });

})

</script>
