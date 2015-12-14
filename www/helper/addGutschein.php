        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="../js/jquery-2.1.1-min.js"></script>

        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../css/theme.css" rel="stylesheet">



<?php include "read.php"; ?>
        <nav class="test">
            <ul class="list-group" id="navbar-ul">
        <?php
            foreach ($gutschein as $gutscheine) {
        ?>

       <li class="list-group-item group-li" id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>-li-nav">
            <span class="lead clearfix" id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>-span"><?php echo str_replace(" ","_",$gutscheine["name"]);?> </span><br>
                <?php
                if (!array_key_exists("count",$gutscheine)) {
                foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("count",$Sub)) {
                ?>
                <span id="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>-navbar-span" class="coupon-nav-li">-<?php echo str_replace(" ","_",$Sub["name"]); ?></span>

                <?php }
                };
                };?>

        </li>

        <?php
            }?>

            </ul>
            <button type="button" class="hinzufügen btn btn-default" value="Newgroup" >+</button>
        <button type="button" class="btn btn-primary save-btn " id="savebtngutschein" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!">Speichern</button>

</nav>

<div class="col-xs-2">
<h3>
<form id="formgutschein">
    <div id="allcoupons">
    <input type="hidden" name="ignore[ignore]" value="ignore" > <!-- ignore this. This exists to help creat the rigth array, without this the first point will be his own array, it will be removed in writeGutschein.php -->
        <ul class="group-list coupon-li" >
        <?php foreach ($gutschein as $gutscheine) {?>
        <div id='last-group'>

            <li id="<?php echo str_replace(" ","_",$gutscheine["name"]);?>-li"  class="list-group-item"> <!-- list items for categories -->
            <?php if (!array_key_exists("count",$gutscheine)) { ?>
                <div id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>-input" class="input-group groupname">
                    <input class="form-control name" id="<?php echo str_replace(" ","_",$gutscheine["name"]) ?>-input-group" type="text" name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[name]" value="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="<?php echo str_replace(" ","_",$gutscheine["name"]);?>[New]">+</button><button type="button" class="entfernen btn btn-default" value="<?php echo str_replace(" ","_",$gutscheine["name"]);?>-li">-</button></span>
                </div>
                <ul id="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>" class="list-group coupon-li">
                <?php foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("count",$Sub)) { ?>
                        <div id="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>" class="coupons">

                        <li class="list-group-item"> <!-- list items for single coupons -->
                        <button type="button" class="entfernen btn btn-default" value="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>">Delete</button>
                        <br>name:
                        <input class="form-control name" type="text" id="<?php echo str_replace(" ","_",$gutscheine["name"]); echo str_replace(" ","_",$Sub["name"]); ?>-input-coupon" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][name]" id="name-<?php echo str_replace(" ","_",$Sub["name"]); ?>-<?php echo str_replace(" ","_",$gutscheine["name"]);?>" value="<?php echo str_replace(" ","_",$Sub["name"]); ?>">
                        <br>count:
                        <input class="form-control" type="number" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][count]" id="count-<?php echo str_replace(" ","_",$Sub["name"]); ?>" value="<?php echo $Sub["count"]; ?>">
                        <br>date from:
                        <input class="form-control" type="date" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][dates]" id="dates-<?php echo str_replace(" ","_",$Sub["name"]); ?>" value="<?php echo $Sub["dates"]; ?>">
                        <br>date to:
                        <input class="form-control" type="date" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][datee]" id="datee-<?php echo str_replace(" ","_",$Sub["name"]); ?>" value="<?php echo $Sub["datee"]; ?>">
                        <br>price:
                            <div class="input-group price"><input class="form-control" type="text" step="0.01" required name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][price]" id="price-<?php echo str_replace(" ","_",$gutscheine["name"]); echo"-"; echo str_replace(" ","_",$Sub["name"]); ?>" value="<?php echo $Sub["price"]; ?>"><span class="input-group-btn"><Button type="Button" class="btn btn-default einheit" id="price-<?php echo str_replace(" ","_",$gutscheine["name"]); echo"-"; echo str_replace(" ","_",$Sub["name"]); ?>-button-eu" value="€">€</Button><Button type="Button" class="btn btn-default einheit" id="price-<?php echo str_replace(" ","_",$gutscheine["name"]); echo"-"; echo str_replace(" ","_",$Sub["name"]); ?>-button-pr" value="%">%</Button></span></div>
                        <br>sub:
                            <select class="form-control" id="sub-<?php echo str_replace(" ","_",$Sub["name"]); ?>" name="<?php echo str_replace(" ","_",$gutscheine["name"]); ?>[<?php echo str_replace(" ","_",$Sub["name"]); ?>][sub]">
                                <option <?php if((!isset($Sub["sub"])) or ($Sub["sub"]=="None")){echo "selected";}; ?>>None</option>
                                <option <?php if($Sub["sub"]=="coustom"){echo "selected";}; ?>>coustom</option>
                            </select>
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
        var number = 0;
        var groupnumber=0;
        $("#savebtngutschein").on("click", function(){
            var serialized = $("#formgutschein").serialize();
            $.ajax({
                    type: "POST",
                    url: "writegutschein.php",
                    dataType: "JSON",
                    data: JSON.stringify(serialized),
                    success: function(data)
                    {
                        alert("Änderungen gespeichert");
                        console.log(data);
                        return false;
                    }
            });

        });

        $(document).on("click",".hinzufügen",function(){
            number = number+1; //creat new number so that the new coupons not overwrite themself

            var newid = this.value;

            if (newid=="Newgroup") { //new group
                groupnumber = groupnumber+1;
                newid = "group"+groupnumber+"[New"+number+"]";
                var objTo = document.getElementById("last-group");
                var divnew = document.createElement("div");
                divnew.id = newid;

                divnew.innerHTML = '<div id="last-group"><li class="list-group-item" id="group'+groupnumber+'-li"><div class="input-group"><input class="form-control name" type="text" name="group'+groupnumber+'[name]" value="group'+groupnumber+'" id="group'+groupnumber+'-input-group"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="group'+groupnumber+'[New]">+</button><button type="button" class="entfernen btn btn-default" value="group'+groupnumber+'-li">-</button></span></div><ul id="group'+groupnumber+'" class="list-group coupon-li">  <div id="group'+groupnumber+'New'+number+'"><li class="list-group-item coupons"><button type="button" class="entfernen btn btn-default" value="group'+groupnumber+'New'+number+'">Delete</button><br>name:<input class="form-control name" id="group'+groupnumber+'New'+number+'-input-coupon" type="text" required name="'+newid+'[name]" value="New'+number+'"><br>count:<input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<div class="input-group price"><input class="form-control" type="text" required name="'+newid+'[price]" id="price-group'+groupnumber+'-New'+number+'" value="0€"><span class="input-group-btn"><Button type="Button" class="btn btn-default einheit" id="price-group'+groupnumber+'-New'+number+'-button-eu" value="€">€</Button><Button type="Button" class="btn btn-default einheit" id="price-group'+groupnumber+'-New'+number+'-button-pr" value="%">%</Button></span></div><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br></li></div></ul></li></ul></div>';

                objTo.appendChild(divnew);

                var idnew=document.getElementById("navbar-ul");
                newli=document.createElement("li");
                newli.setAttribute("id","group"+groupnumber+"-li-nav");
                newli.className="list-group-item group-li";
                newli.innerHTML='<span class="lead clearfix" id="group'+groupnumber+'-span">group'+groupnumber+'  </span><br><span id="group'+groupnumber+'New'+number+'-navbar-span">-New'+number+' </span>';
                idnew.appendChild(newli);

                window.scrollTo(0,document.body.scrollHeight);

            } else { //new coupon
            var id = newid.replace("[New]","");

            var objTo = document.getElementById(id);
            var divnew = document.createElement('div');
            divnew.id = newid+"New"+number;
            if (!newid.search("[New]")) {
                newid = "New"+number;
            };
            newid = newid.replace("[New]","[New"+number+"]");
            divnew.innerHTML = '<div id="'+id+'New'+number+'"><li class="list-group-item coupons" id=group'+groupnumber+'-li><button type="button" class="entfernen btn btn-default" value="'+id+'New'+number+'">Delete</button><br>name:<input class="form-control name" type="text" id="'+id+'New'+number+'-input-coupon" required name="'+newid+'[name]" value="New'+number+'"><br>count:<input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<div class="input-group price"><input class="form-control" type="text" step="0.01" required name="'+newid+'[price]" id="price-'+id+'-New'+number+'" value="0€"><span class="input-group-btn"><Button type="Button" class="btn btn-default einheit" id="price-'+id+'-New'+number+'-button-pr" value="€">€</Button><Button type="Button" class="btn btn-default einheit" id="price-'+id+'-New'+number+'-button-pr" value="%">%</Button></span></div><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br></li></div>';
            objTo.appendChild(divnew);

            var idnew=document.getElementById(this.value.replace("[New]","-li-nav"));
            idnew.innerHTML=idnew.innerHTML+'<span id="'+this.value.replace("[New]","")+'New'+number+'-navbar-span" class="coupon-nav-li">-New'+number+' </span>';
            }

        });

        $(document).on("click",".entfernen", function(){
           var element = document.getElementById(this.value);
           element.parentNode.removeChild(element);
           if(this.value.match("-li")==null) {
               element = document.getElementById(this.value+"-navbar-span");
               element.parentNode.removeChild(element);
           } else {
               element = document.getElementById(this.value+"-nav");
               element.parentNode.removeChild(element);
           }
        });

        $(document).on("click",".einheit",function(){
            var inputid=this.id.replace("-button-pr","").replace("-button-eu","");
            var element=document.getElementById(inputid);
            element.value=element.value.replace("€","").replace("%","")+this.value;
        });

        $(document).on("keydown",".price",function(event){
//            alert(event.keyCode);
            if ((event.keyCode<48 || event.keyCode>57) && (event.keyCode!=8 && event.keyCode!=190 && event.keyCode!=46 && (event.keyCode<37 || event.keyCode>40))) {
               this.value=this.value;
                return false;

            }
        });
    });

    $(document).on("keyup",".name", function(){
        var id=this.id.replace("-input-group","-span").replace("-input-coupon","-navbar-span");
        var element=document.getElementById(id);
        if (element.innerHTML.charAt(0)=="-") {
            element.innerHTML="-"+this.value;
        } else {
            element.innerHTML=this.value;
        }
    })

        $(document).on("click",".coupon-nav-li",function(){
         $('html, body').animate({
            scrollLeft: $("#"+this.id.replace("-navbar-span","")).offset().left+100
         }, 800);
    })

    $(document).on("click",".group-li",function(){
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
        "in":
        {
            "name":"in",
            "count":"1",
            "dates":"2015-12-01",
            "datee":"2015-12-03",
            "price":"0.00",
            "sub":"on"
        }
    }
}

