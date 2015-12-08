        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="../js/jquery-2.1.1-min.js"></script>

        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../css/theme.css" rel="stylesheet">

<!--<li class="list-group-item" ><span class="lead clearfix" id="<?php echo $gutscheine["name"]; ?>-span"><?php echo $gutscheine["name"];?>:  </span><br><?php if(!array_key_exists("count",$gutscheine)) {foreach ($gutscheine as $Sub){if (is_array($Sub) and array_key_exists("count",$Sub)) {?>-<span id="<?php echo $gutscheine["name"]; echo Sub["name"]; ?>-navbar-div"><?php echo $Sub["name"]; ?></span> <br><?php } }; };?>-->



<?php include "read.php"; ?>
        <nav class="test">
            <ul class="list-group" id="navbar-ul">
        <?php
            foreach ($gutschein as $gutscheine) {
        ?>

       <li class="list-group-item" id="<?php echo $gutscheine["name"]; ?>-li-nav">
            <span class="lead clearfix" id="<?php echo $gutscheine["name"]; ?>-span"><?php echo $gutscheine["name"];?> </span><br>

                <?php
                if (!array_key_exists("count",$gutscheine)) {
                foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("count",$Sub)) {
                ?>
                -<span id="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>-navbar-div"><?php echo $Sub["name"]; ?></span> <br>

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

            <li id="<?php echo $gutscheine["name"];?>-li"  class="list-group-item"> <!-- list items for categories -->
            <?php if (!array_key_exists("count",$gutscheine)) { ?>
                <div id="<?php echo $gutscheine["name"]; ?>-input" class="input-group">
                    <input class="form-control name" id="<?php echo $gutscheine["name"] ?>-input-group" type="text" name="<?php echo $gutscheine["name"]; ?>[name]" value="<?php echo $gutscheine["name"]; ?>"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="<?php echo $gutscheine["name"];?>[New]">+</button><button type="button" class="entfernen btn btn-default" value="<?php echo $gutscheine["name"];?>-li">-</button></span>
                </div>
                <ul id="<?php echo $gutscheine["name"]; ?>" class="list-group coupon-li">
                <?php foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("count",$Sub)) { ?>
                        <div id="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>">

                        <li class="list-group-item"> <!-- list items for single coupons -->
                        <button type="button" class="entfernen btn btn-default" value="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>">Delete</button>
                        <br>name:
                        <input class="form-control name" type="text" id="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>-input-coupon" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][name]" id="name-<?php echo $Sub["name"]; ?>-<?php echo $gutscheine["name"];?>" value="<?php echo $Sub["name"]; ?>">
                        <br>count:
                        <input class="form-control" type="number" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][count]" id="count-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["count"]; ?>">
                        <br>date from:
                        <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][dates]" id="dates-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["dates"]; ?>">
                        <br>date to:
                        <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][datee]" id="datee-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["datee"]; ?>">
                        <br>price:
                            <div class="input-group price"><input class="form-control" type="text" step="0.01" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][price]" id="price-<?php echo $gutscheine["name"]; echo"-"; echo $Sub["name"]; ?>" value="<?php echo $Sub["price"]; ?>"><span class="input-group-btn"><Button type="Button" class="btn btn-default einheit" id="price-<?php echo $gutscheine["name"]; echo"-"; echo $Sub["name"]; ?>-button-eu" value="€">€</Button><Button type="Button" class="btn btn-default einheit" id="price-<?php echo $gutscheine["name"]; echo"-"; echo $Sub["name"]; ?>-button-pr" value="%">%</Button></span></div>
                        <br>sub:
                            <select class="form-control" id="sub-<?php echo $Sub["name"]; ?>" name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][sub]">
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

                divnew.innerHTML = '<div id="last-group"><li class="list-group-item"><div class="input-group"><input class="form-control name" type="text" name="group'+groupnumber+'[name]" value="group'+groupnumber+'" id="group'+groupnumber+'-input-group"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="group'+groupnumber+'[New]">+</button><button type="button" class="entfernen btn btn-default" value="'+newid+'">-</button></span></div><ul id="group'+groupnumber+'" class="list-group coupon-li">  <div id="group'+groupnumber+'New'+number+'"><li class="list-group-item"><button type="button" class="entfernen btn btn-default" value="group'+groupnumber+'New'+number+'">Delete</button><br>name:<input class="form-control name" id="group'+groupnumber+'New'+number+'-input-coupon" type="text" required name="'+newid+'[name]" value="New'+number+'"><br>count:<input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<div class="input-group price"><input class="form-control" type="text" required name="'+newid+'[price]" id="price-group'+groupnumber+'-New'+number+'" value="0€"><span class="input-group-btn"><Button type="Button" class="btn btn-default einheit" id="price-group'+groupnumber+'-New'+number+'-button-eu" value="€">€</Button><Button type="Button" class="btn btn-default einheit" id="price-group'+groupnumber+'-New'+number+'-button-pr" value="%">%</Button></span></div><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br></li></div></ul></li></ul></div>';

                objTo.appendChild(divnew);

                var idnew=document.getElementById("navbar-ul");
                idnew.innerHTML=idnew.innerHTML+'<li class="list-group-item" id="group'+groupnumber+'-li-nav"><span class="lead clearfix" id="group'+groupnumber+'-span">group'+groupnumber+':  </span><br>-<span id="group'+groupnumber+'New'+number+'-navbar-div">New'+number+'</span><br>';

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
            divnew.innerHTML = '<div id="'+newid+'"><li class="list-group-item"><button type="button" class="entfernen btn btn-default" value="'+newid+'">Delete</button><br>name:<input class="form-control name" type="text" id="'+id+'New'+number+'-input-coupon" required name="'+newid+'[name]" value="New'+number+'"><br>count:<input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<div class="input-group price"><input class="form-control" type="text" step="0.01" required name="'+newid+'[price]" id="price-'+id+'-New'+number+'" value="0€"><span class="input-group-btn"><Button type="Button" class="btn btn-default einheit" id="price-'+id+'-New'+number+'-button-pr" value="€">€</Button><Button type="Button" class="btn btn-default einheit" id="price-'+id+'-New'+number+'-button-pr" value="%">%</Button></span></div><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br></li></div>';
            objTo.appendChild(divnew);

//                alert(this.value);
                var idnew=document.getElementById(this.value.replace("[New]","-li-nav"));
            idnew.innerHTML=idnew.innerHTML+'-<span id="'+this.value.replace("[New]","")+'New'+number+'-navbar-div">New'+number+'</span><br>';
            }

        });

        $(document).on("click",".entfernen", function(){
           var element = document.getElementById(this.value);
           element.parentNode.removeChild(element);
        });

        $(document).on("click",".einheit",function(){
            var inputid=this.id.replace("-button-pr","").replace("-button-eu","");
            var element=document.getElementById(inputid);
            element.value=element.value.replace("€","").replace("%","")+this.value;
        });

        $(document).on("keydown",".price",function(event){
//            alert(event.keyCode);
            if ((event.keyCode<48 || event.keyCode>57) && (event.keyCode!=8 && event.keyCode!=46 && (event.keyCode<37 || event.keyCode>40))) {
               this.value=this.value;
                return false;

            }
        });
    });

    $(document).on("keyup",".name", function(){
        var id=this.id.replace("-input-group","-span").replace("-input-coupon","-navbar-div");
        var element=document.getElementById(id);
        element.innerHTML=this.value;
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

