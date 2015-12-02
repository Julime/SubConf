        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="../js/jquery-2.1.1-min.js"></script>

        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../css/theme.css" rel="stylesheet">


<?php include "read.php"; ?>

        <nav class="test">
            <ul class="list-group">
        <?php
            foreach ($gutschein as $gutscheine) {
        ?>

       <li class="list-group-item" >
            <span class="lead clearfix"><?php if (!array_key_exists("count",$gutscheine)) {echo $gutscheine["name"];} else { echo "ohne"; } ?>:  </span><br>

                <?php
                if (!array_key_exists("count",$gutscheine)) {
                foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("count",$Sub)) {
                ?>
                - <?php echo $Sub["name"]; ?> <br>

                <?php }
                };
                } else {
                ?>
                    - <?php echo $gutscheine["name"]; ?> <br>
                <?php }; ?>

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
                    <input class="form-control" type="text" name="<?php echo $gutscheine["name"]; ?>[name]" value="<?php echo $gutscheine["name"]; ?>"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="<?php echo $gutscheine["name"];?>[New]">+</button><button type="button" class="entfernen btn btn-default" value="<?php echo $gutscheine["name"];?>-li">-</button></span>
                </div>
                <ul id="<?php echo $gutscheine["name"]; ?>" class="list-group coupon-li">
                <?php foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("count",$Sub)) { ?>
                        <div id="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>" class="coupons">

                        <li class="list-group-item"> <!-- list items for single coupons -->
                        <button type="button" class="entfernen btn btn-default" value="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>">Delete</button>
                        <br>name:
                        <input class="form-control" type="text" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][name]" id="name-<?php echo $Sub["name"]; ?>-<?php echo $gutscheine["name"];?>" value="<?php echo $Sub["name"]; ?>">
                        <br>count:
                        <input class="form-control" type="number" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][count]" id="count-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["count"]; ?>">
                        <br>date from:
                        <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][dates]" id="dates-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["dates"]; ?>">
                        <br>date to:
                        <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][datee]" id="datee-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["datee"]; ?>">
                        <br>price:
                        <input class="form-control" type="number" step="0.01" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][price]" id="price-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["price"]; ?>">
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

                divnew.innerHTML = '<div id="last-group"><li class="list-group-item"><div class="input-group"><input class="form-control" type="text" name="group'+number+'[name]" value="group'+groupnumber+'"><span class="input-group-btn"><button type="button" class="hinzufügen btn btn-default" value="group'+number+'[New]">+</button><button type="button" class="entfernen btn btn-default" value="'+newid+'">-</button></span></div><ul id="group'+groupnumber+'" class="list-group coupon-li">  <div id="group'+number+'New'+number+'"><li class="list-group-item"><button type="button" class="entfernen btn btn-default" value="group'+groupnumber+'New'+number+'">Delete</button><br>name:<input class="form-control" type="text" required name="'+newid+'[name]" value="New'+number+'"><br>count:<input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<input class="form-control" type="number" step="0.01" required name="'+newid+'[price]" value="0"><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br></li></div></ul></li></ul></div>';

                objTo.appendChild(divnew);
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

            divnew.innerHTML = '<div id="'+newid+'"><li class="list-group-item"><button type="button" class="entfernen btn btn-default" value="'+newid+'">Delete</button><br>name:<input class="form-control" type="text" required name="'+newid+'[name]" value="New'+number+'"><br>count:<input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from:<input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to:<input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date('Y-m-d'); ?>"><br>price:<input class="form-control" type="number" step="0.01" required name="'+newid+'[price]" value="0"><br>sub:<select class="form-control" type="checkbox" name="'+newid+'[sub]"><option selected>None</option><option>coustom</option></select><br></li></div>';
            objTo.appendChild(divnew);
            }

        });

        $(document).on("click",".entfernen", function(){
           var element = document.getElementById(this.value);
           element.parentNode.removeChild(element);
        });
    });
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

