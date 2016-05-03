        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <!DOCTYPE html>
        <script src="../js/jquery-2.1.1-min.js"></script>

        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../css/theme.css" rel="stylesheet">

<!-- .php file to creat a new coupon and change allready existing once -->

<?php include "read.php"; ?>
        <nav class="navbar-left"> <!-- navbar on the left of the side, it shows the groups and the coupons -->
            <ul class="list-group" id="navbar-ul">
        <?php
            foreach ($gutschein as $gutscheine) { //new item for every coupon
        ?>

       <li class="list-group-item group-li" id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>-li-nav">
            <span class="lead clearfix" id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>-span"><?php echo str_replace(" ","_",$gutscheine["name"]);?> </span><br>
                <?php
                foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("dates",$Sub)) {
                ?>
                <span id="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>-navbar-span" class="coupon-nav-li">-<?php echo str_replace(" ","_",$Sub["name"]); ?></span>

                <?php }
                };?>

        </li>

        <?php
            }?>

            </ul>
            <button type="button" class="hinzufügen btn btn-default" value="Newgroup" >+</button><!--add group button -->
        <button type="button" class="btn btn-primary save-btn " id="savebtngutschein" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!"><?php echo $config["Text"]["Save-btn"]; ?></button><!-- save changes -->

</nav>

<div class="col-xs-2">
<h3>
<form id="formgutschein" enctype="multipart/form-data" method="post" action="upload.php"> <!-- form to submit (I submit every coupon even existing once and just write them all over all of the other that is the easyest way to do it but it can get slow with a few hundred coupons) -->
    <div id="allcoupons">
    <input type="hidden" name="ignore[ignore]" value="ignore" >  <!-- ignore this. This exists to help creat the rigth array, without this the first point will be his own array, it will be removed in writeGutschein.php -->
        <ul class="group-list coupon-li" > <!-- an ul for the groups -->
        <?php foreach ($gutschein as $gutscheine) {?>
        <div id='last-group'>

            <li id="<?php echo str_replace(" ","_",$gutscheine["name"]);?>-li"  class="list-group-item"> <!-- list items for categories -->
            <?php if (!array_key_exists("count",$gutscheine)) { ?>
                <div id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>-input" class="input-group groupname">
                    <input class="form-control name" id="<?php echo str_replace(" ","_",$gutscheine["name"]) ?>-input-group" type="text" name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[name]" value="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="<?php echo str_replace(" ","_",$gutscheine["name"]);?>[New]">+</button><button type="button" class="entfernen btn btn-default" value="<?php echo str_replace(" ","_",$gutscheine["name"]);?>-li">-</button></span><!-- groupname -->
                </div>
                <ul id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>" class="list-group coupon-li"><!-- ul for the coupons in one group -->
                <?php foreach ($gutscheine as $Sub) //foreach coupon in this group
                {
                    if (is_array($Sub) and array_key_exists("dates",$Sub)) { //check if the coupon has all important criterias and is not corrupted 
                ?>
                        <div id="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>" class="coupons">

                        <li class="list-group-item"> <!-- list items for single coupons -->
                        <button type="button" class="entfernen btn btn-default" value="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>"><?php echo $config["Text"]["Delete-btn"]; ?></button><!-- delete button for the coupon -->
                        <br>name:
                        <input class="form-control name" type="text" id="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>-input-coupon" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][name]" id="name-<?php echo str_replace(" ","_",$Sub["name"]); ?>-<?php echo str_replace(" ","_",$gutscheine["name"]);?>" value="<?php echo str_replace(" ","_",$Sub["name"]); ?>"><!-- the name attribute -->
                        <br>date from:
                        <input class="form-control" type="date" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][dates]" id="dates-<?php echo str_replace(" ","_",$Sub["name"]); ?>" value="<?php echo $Sub["dates"]; ?>"><!-- the  start date -->
                        <br>date to:
                        <input class="form-control" type="date" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][datee]" id="datee-<?php echo str_replace(" ","_",$Sub["name"]); ?>" value="<?php echo $Sub["datee"]; ?>"><!-- the ned date -->
                        <br>price:
                            <div class="input-group price"><input class="form-control price" type="number" step="0.01" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][price]" id="price-<?php echo str_replace(" ","_",$gutscheine["name"]); echo"-"; echo str_replace(" ","_",$Sub["name"]); ?>" value="<?php echo $Sub["price"]; ?>"><!-- the cost of the coupon -->
                        <select name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][type]"> <!-- set the attribute to tell the price calkulator the way the price of the coupon should be put in count -->
                            <optgroup label="Subs">
                                <optgroup label=" Footlong"> <!-- for 30cm subs -->
                                    <option value="FL€mehr" <?php if($Sub["type"]=="FL€mehr") { echo "selected"; } ?> >[preis]€ mehr</option> <!-- if you select this coupon it costst {price in Euro} more -->
                                    <option value="FL€weniger" <?php if($Sub["type"]=="FL€weniger") { echo "selected"; } ?> >[preis]€ weniger</option> <!-- if you select this coupon it costst {price in Euro} less -->
                                    <option value="FL%weniger" <?php if($Sub["type"]=="FL%weniger") { echo "selected"; } ?> >[preis]% weniger</option> <!-- if you select this coupon it costst {price in %} less (so if your sub costs 10€ and you select a coupon with a price of 50 and this attribute your sub will cost ,50½ less, 5€) -->
                                    <option value="FLk=p" <?php if($Sub["type"]=="FLk=p") { echo "selected"; } ?> >Kosten=[preis]</option><!-- if you select this coupon it costst {price in Euro} -->
                                </optgroup>
                                <optgroup label=" 15cm"> <!-- for 15cm subs -->
                                    <option value="15€mehr" <?php if($Sub["type"]=="15€mehr") { echo "selected"; } ?> >[preis]€ mehr</option> <!-- if you select this coupon it costst {price in Euro} more -->
                                    <option value="15€weniger" <?php if($Sub["type"]=="15€weniger") { echo "selected"; } ?> >[preis]€ weniger</option> <!-- if you select this coupon it costst {price in Euro} less -->
                                    <option value="15%weniger" <?php if($Sub["type"]=="15%weniger") { echo "selected"; } ?> >[preis]% weniger</option> <!-- if you select this coupon it costst {price in %} less (so if your sub costs 10€ and you select a coupon with a price of 50 and this attribute your sub will cost ,50½ less, 5€) -->
                                    <option value="15k=p" <?php if($Sub["type"]=="15k=p") { echo "selected"; } ?> >Kosten=[preis]</option> <!-- if you select this coupon it costst {price in Euro} -->
                                </optgroup>
                            </optgroup>
                            <optgroup label="Cookies"> <!-- here you can select X free cookies for your coupon -->
                                <optgroup label="X Cookies X=">
                                    <option value="T-C1" <?php if($Sub["type"]=="T-C1") { echo "selected"; } ?>>1</option> <!-- this will allow upt to 1 free cookie -->
                                    <option value="T-C2" <?php if($Sub["type"]=="T-C2") { echo "selected"; } ?>>2</option> <!-- this will allow upt to 2 free cookie -->
                                    <option value="T-C3" <?php if($Sub["type"]=="T-C3") { echo "selected"; } ?>>3</option>
                                    <option value="T-C4" <?php if($Sub["type"]=="T-C4") { echo "selected"; } ?>>4</option>
                                    <option value="T-C5" <?php if($Sub["type"]=="T-C5") { echo "selected"; } ?>>5</option>
                                    <option value="T-C6" <?php if($Sub["type"]=="T-C6") { echo "selected"; } ?>>6</option>
                                    <option value="T-C7" <?php if($Sub["type"]=="T-C7") { echo "selected"; } ?>>7</option>
                                    <option value="T-C8" <?php if($Sub["type"]=="T-C8") { echo "selected"; } ?>>8</option>
                                    <option value="T-C9" <?php if($Sub["type"]=="T-C9") { echo "selected"; } ?>>9</option>
                                    <option value="T-C10" <?php if($Sub["type"]=="T-C10") { echo "selected"; } ?>>10</option>
                                    <option value="T-C11" <?php if($Sub["type"]=="T-C11") { echo "selected"; } ?>>11</option>
                                    <option value="T-C12" <?php if($Sub["type"]=="T-C12") { echo "selected"; } ?>>12</option>
                                </optgroup>
                            </optgroup>
                        </select>
                            </div>
                        <select name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][type1]"> <!-- here you can select a free extra like Bacon or double cheese -->
                            <optgroup label="Free extras">
                                <option value="ex0" <?php if($Sub["type1"]=="ex1") {echo "selected";} ?>><?php echo $config["Text"]["Nothing"]; ?></option> <!-- no free extras -->
                                <option value="ex1" <?php if($Sub["type1"]=="ex1") {echo "selected";} ?>><?php echo $config["Text"]["Bacon"]; ?></option> <!-- free Bacon -->
                                <option value="ex2" <?php if($Sub["type1"]=="ex2") {echo "selected";} ?>><?php echo $config["Text"]["doubleCheese"]; ?></option> <!-- free double Cheese -->
                                <option value="ex3" <?php if($Sub["type1"]=="ex3") {echo "selected";} ?>><?php echo $config["Text"]["doubleMeat"]; ?></option> <!-- free double meat -->
                            </optgroup>
                        </select>
                        <br><br>sub:
                            <select class="form-control" id="sub-<?php echo str_replace(" ","_",$Sub["name"]); ?>" name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][sub]"> <!-- use this to determen if a sub is requiert -->
                                <option <?php if((!isset($Sub["sub"])) or ($Sub["sub"]=="None")){echo "selected";}; ?>>None</option> <!-- no sub needed -->
                                <option <?php if($Sub["sub"]=="coustom"){echo "selected";}; ?>>coustom</option> <!-- coustom sub needed -->
                            </select>
                                <br>picture:
                                <input type="file" name="userfile[]" class="upload" id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][upload]"> <!-- upload a picture of the coupon (not needed but it looks better) -->

                                <input name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][picture]" type="hidden" id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][picture]" value="<?php if(isset($Sub["picture"])) {echo $Sub["picture"];} ?>">

                    	        <button type="button" class="btn btn-primary form-control uploadbtn" id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][uploadbtn]">Upload</button>
                                <br>current picture: <!-- show the current picture of the coupon -->
                                <div id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][showpicture]" class="form-control showpicture picturediv"><?php if(isset($Sub["picture"]) && !empty($Sub["picture"])) { echo "<img src='../img/Gutscheine/".$Sub["picture"]."' alt='Picture of coupon' class='picture'>"; } else { echo "NONE";} ?></div>

                        <br>
                        </li>
                    </div><?php
                    }
                } ?>
            </ul>
            <?php } ?>
            </li>
         <?php } ?>
         </ul>
    </div>
</form>
    </h3>
</div>


<script>
    $(function(){
        var number = 0; //use this to creat a new coupon with a different name
        var groupnumber=0; //use this to creat a new coupongroup with a different name
        $("#savebtngutschein").on("click", function(){ //cal the php file to save coupons
            var serialized = $("#formgutschein").serialize();
            $.ajax({
                    type: "POST",
                    url: "writegutschein.php",
                    dataType: "JSON",
                    data: JSON.stringify(serialized), //get the data from the form in a json format
                    success: function(data)
                    {
                        alert("<?php echo $config["Text"]["changesSaved"] ?>");
                        console.log(data);
                        return false;
                    }
            });

        });

        $(document).on("click",".uploadbtn", function(){ //call the php file to upload pictures for the coupons
            var element = document.getElementById(this.id.replace("[uploadbtn]","[upload]")); //get the right coupon for the image
                var formData = new FormData(); //get the form data
                    var file = element.files[0]; //get the first filename
                    formData.append('userfile[]',file,file.name); //append the pictures with their names
                var xhr = new XMLHttpRequest(); //start an xhtml request to upload pictures
                xhr.open("POST", "upload.php", true); //open the xhtml request
                xhr.onload = function() { 
                    if (xhr.status === 200) { //if uploaded
                        alert("<?php echo $config["Text"]["uploadfinished"]; ?>");
                    } else { //if not
                        alert("<?php echo $config["Text"]["error"] ?>");
                    }
                }
                xhr.send(formData);//send the form data

            element = document.getElementById(this.id.replace("[uploadbtn]","[upload]"));// get the upload from the uploadbtn
            document.getElementById(element.id.replace("[upload]","[picture]")).value=element.value.replace("C:\\fakepath\\","");//get the picture field with the uploadbtn

            element = document.getElementById(this.id.replace("[uploadbtn]","[showpicture]"));// get the showpicture div

                var newelement = document.createElement("img"); //creat the image of the coupon to put it in to the preview
                var filename = document.getElementById(element.id.replace("[showpicture]","")+"[picture]").value; //get the filename
                newelement.src = "../img/Gutscheine/"+filename; //get the picture
                newelement.alt = "Picture from coupon"; //set text for the picture
                newelement.className = "picture"; //set class
                if(filename.length > 0) { //check if the filename is not empty
                    element.innerHTML="";
                    element.appendChild(newelement); //append the image
                } else {
                    element.innerHTML="NONE"; //show that no Picture is available
                }
        })

        $(document).on("click",".hinzufügen",function(){ //creat a new coupon or group
            number = number+1; //creat new number so that the new coupons not overwrite themself

            var newid = this.value;

            if (newid=="Newgroup") { //creat a new group
                groupnumber = groupnumber+1;
                newid = "group"+groupnumber+"[New"+number+"]"; //set newid variable to shorten the following code
                var objTo = document.getElementById("last-group"); //get the Element to add the group to (the last group of the page (all groups have this id but only the last one counts))
                var divnew = document.createElement("div"); //creat a new div for the group
                divnew.id = newid; //set the id

                //creat the new group (it is the exact same code as above just with other/standart values)
                divnew.innerHTML = '<div id="last-group"><li class="list-group-item" id="group'+groupnumber+'-li"><div class="input-group groupname"><input class="form-control name" type="text" name="group'+groupnumber+'[name]" value="group'+groupnumber+'" id="group'+groupnumber+'-input-group"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="group'+groupnumber+'[New]">+</button><button type="button" class="entfernen btn btn-default" value="group'+groupnumber+'-li">-</button></span></div><ul id="group'+groupnumber+'" class="list-group coupon-li">  <div id="group'+groupnumber+'New'+number+'"><li class="list-group-item coupons"><button type="button" class="entfernen btn btn-default" value="group'+groupnumber+'New'+number+'"><?php echo $config["Text"]["Delete-btn"]; ?></button><br>name:<input class="form-control name" id="group'+groupnumber+'New'+number+'-input-coupon" type="text" required name="'+newid+'[name]" value="New'+number+'"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<div class="input-group price"><input class="form-control" type="number" required name="'+newid+'[price]" id="price-group'+groupnumber+'-New'+number+'" value="0"><select name="'+newid+'[type]"> <optgroup label="Subs"><optgroup label=" Footlong"><option value="FL€mehr" selected>[preis]€ mehr</option><option value="FL€weniger">[preis]€ weniger</option><option value="FL%weniger">[preis]% weniger</option><option value="FLk=p">Kosten=[preis]</option></optgroup><optgroup label=" 15cm"><option value="15€mehr">[preis]€ mehr</option><option value="15€weniger">[preis]€ weniger</option><option value="15%weniger">[preis]% weniger</option><option value="15k=p">Kosten=[preis]</option></optgroup></optgroup><optgroup label="Cookies"><optgroup label="X Cookies X="><option value="T-C1">1</option><option value="T-C2">2</option><option value="T-C3">3</option><option value="T-C4">4</option><option value="T-C5">5</option><option value="T-C6">6</option><option value="T-C7">7</option><option value="T-C8">8</option><option value="T-C9">9</option><option value="T-C10">10</option><option value="T-C11">11</option><option value="T-C12">12</option></optgroup></optgroup></select><select name="'+newid+'[type1]"><optgroup label="Free extras"><option value="ex0"><?php echo $config["Text"]["Nothing"]; ?></option><option value="ex1"><?php echo $config["Text"]["Bacon"] ?></option><option value="ex2"><?php echo $config["Text"]["doubleCheese"]; ?></option><option value="ex3"><?php echo $config["Text"]["doubleMeat"]; ?>  </option></optgroup></select></div><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br>picture:<input type="file" name="userfile[]" class="upload" id="'+newid+'[upload]"><input name="'+newid+'[picture]" type="hidden" id="'+newid+'[picture]"><button type="button" class="btn btn-primary form-control uploadbtn" id="'+newid+'[uploadbtn]">Upload</button><br>current picture:<div id="'+newid+'[showpicture]" class="form-control showpicture picturediv">NONE</div><br></li></div></ul></li></ul></div>';

                objTo.appendChild(divnew); // addthe new group

                //update the navbar
                var idnew=document.getElementById("navbar-ul");
                newli=document.createElement("li");
                newli.setAttribute("id","group"+groupnumber+"-li-nav");
                newli.className="list-group-item group-li";
                newli.innerHTML='<span class="lead clearfix" id="group'+groupnumber+'-span">group'+groupnumber+'  </span><br><span id="group'+groupnumber+'New'+number+'-navbar-span">-New'+number+' </span>';
                idnew.appendChild(newli); //add the navbar item

                window.scrollTo(0,document.body.scrollHeight); //set the scrolllink to the coupon

            } else { //new coupon (just a coupon in a group not a hole group as above)
            var id = newid.replace("[New]","");

            var objTo = document.getElementById(id);
            var divnew = document.createElement('div');
            divnew.id = newid+"New"+number;
            if (!newid.search("[New]")) {
                newid = "New"+number;
            };
            newid = newid.replace("[New]","[New"+number+"]");
            //creat the coupon (same code as above (without the group ul etc.))
            divnew.innerHTML = '<div id="'+id+'New'+number+'"><li class="list-group-item coupons" id=group'+groupnumber+'-li><button type="button" class="entfernen btn btn-default" value="'+id+'New'+number+'"><?php echo $config["Text"]["Delete-btn"]; ?></button><br>name:<input class="form-control name" type="text" id="'+id+'New'+number+'-input-coupon" required name="'+newid+'[name]" value="New'+number+'"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<div class="input-group price"><input class="form-control" type="number" step="0.01" required name="'+newid+'[price]" id="price-'+id+'-New'+number+'" value="0"><select name="'+newid+'[type]"> <optgroup label="Subs"><optgroup label=" Footlong"><option value="FL€mehr" selected>[preis]€ mehr</option><option value="FL€weniger">[preis]€ weniger</option><option value="FL%weniger">[preis]% weniger</option><option value="FLk=p">Kosten=[preis]</option></optgroup><optgroup label=" 15cm"><option value="15€mehr">[preis]€ mehr</option><option value="15€weniger">[preis]€ weniger</option><option value="15%weniger">[preis]% weniger</option><option value="15k=p">Kosten=[preis]</option></optgroup></optgroup><optgroup label="Cookies"><optgroup label="X Cookies X="><option value="T-C1">1</option><option value="T-C2">2</option><option value="T-C3">3</option><option value="T-C4">4</option><option value="T-C5">5</option><option value="T-C6">6</option><option value="T-C7">7</option><option value="T-C8">8</option><option value="T-C9">9</option><option value="T-C10">10</option><option value="T-C11">11</option><option value="T-C12">12</option></optgroup></optgroup></select><select name="'+newid+'[type1]"><optgroup label="Free extras"><option value="ex0"><?php echo $config["Text"]["Nothing"]; ?></option><option value="ex1"><?php echo $config["Text"]["Bacon"] ?></option><option value="ex2"><?php echo $config["Text"]["doubleCheese"]; ?></option><option value="ex3"><?php echo $config["Text"]["doubleMeat"]; ?>  </option></optgroup></select></div><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br>picture:<input type="file" name="userfile[]" class="upload" id="'+newid+'[upload]"><input name="'+newid+'[picture]" type="hidden" id="'+newid+'[picture]"><button type="button" class="btn btn-primary form-control uploadbtn" id="'+newid+'[uploadbtn]">Upload</button><br>current picture:<div id="'+newid+'[showpicture]" class="form-control showpicture picturediv">NONE</div><br></li></div>';
            objTo.appendChild(divnew);

            var idnew=document.getElementById(this.value.replace("[New]","-li-nav")); //get the navbar group relative to the group the coupon is in
            idnew.innerHTML=idnew.innerHTML+'<span id="'+this.value.replace("[New]","")+'New'+number+'-navbar-span" class="coupon-nav-li">-New'+number+' </span>';
            }

        });

        $(document).on("click",".entfernen", function(){ //entfernen=delete
           var element = document.getElementById(this.value); //get the element that should be removed
           element.parentNode.removeChild(element);
           if(this.value.match("-li")==null) { //if it is a group
               element = document.getElementById(this.value+"-navbar-span"); //get the item
               element.parentNode.removeChild(element); //remove the item
           } else { //if not it is a coupon
               element = document.getElementById(this.value+"-nav");
               element.parentNode.removeChild(element);
           }
        });

        $(document).on("keydown",".price",function(event){ //only allow numbers in the price inputfield
            if ((event.keyCode<48 || event.keyCode>57) && (event.keyCode!=8 && event.keyCode!=190 && event.keyCode!=189 && event.keyCode!=46 && (event.keyCode<37 || event.keyCode>40))) { //if not a number or del or remove
               return false; //prevent the execution of the keydown
            }
        });
    });

    $(document).on("keyup",".name", function(){ //update the navbar if the name was changed
        var id=this.id.replace("-input-group","-span").replace("-input-coupon","-navbar-span");//get the id of the navbar element
        var element=document.getElementById(id); //get the navbar element
        if (element.innerHTML.charAt(0)=="-") { //if this is a coupon and not a group
            element.innerHTML="-"+this.value;//add a - befor the name
        } else {
            element.innerHTML=this.value;
        }
    })

        $(document).on("click",".coupon-nav-li",function(){ //scroll to coupon on click
         $('html, body').animate({
            scrollLeft: $("#"+this.id.replace("-navbar-span","")).offset().left-200 //calkulate the navbar
         }, 800);
    })

    $(document).on("click",".group-li",function(){ //scroll to group on click
         $('html, body').animate({
            scrollTop: $("#"+this.id.replace("-nav","")).offset().top
         }, 800);
    })
</script>


<!--
a coupon example

{
    "group1":
    {
        "name":"group1",
        "sub1":
        {
            "name":"sub1",
            "dates":"2015-12-01",
            "datee":"2015-12-03",
            "price":"0.00",
            "sub":"on"
        }
    }
} 
-->