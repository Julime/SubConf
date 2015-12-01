        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="../js/jquery-2.1.1-min.js"></script>
        <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
        <script src="../js/bootstrap.min.js"></script>

<?php include "read.php"; ?>


<ul class="list-group">
        <div class="btn-group" data-toggle="hidden">
        <?php
            foreach ($gutschein as $gutscheine) {
        ?>

       <li class="list-group-item">
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

        </li><br>

        <?php
            }?>
        </div>
</ul>
Inhalt:
<button type="button" class="hinzufügen" value="Newgroup" >+</button>
<form id="formgutschein">
    <div id="allcoupons">
    <input type="hidden" name="ignore[ignore]" value="ignore" > <!-- ignore this. This exists to help creat the rigth array, without this the first point will be his own array, it will be removed in writeGutschein.php -->
        <?php foreach ($gutschein as $gutscheine) {?>
        <div id='<?php echo $gutscheine["name"];?>-group'>
            <?php if (!array_key_exists("count",$gutscheine)) { ?>
                <div id="<?php echo $gutscheine["name"]; ?>">
                <br><br><br><input type="Text" name="<?php echo $gutscheine["name"]; ?>[name]" value="<?php echo $gutscheine["name"]; ?>"><button type="button" class="hinzufügen" value="<?php echo $gutscheine["name"];?>[New]">+</button><button type="button" class="entfernen" value="<?php echo $gutscheine["name"];?>">-</button><br>

                <?php foreach ($gutscheine as $Sub)
                {
                    if (is_array($Sub) and array_key_exists("count",$Sub)) { ?>
                        <div id="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>">
                        <br>name:
                        <input class="form-control" type="text" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][name]" id="name-<?php echo $Sub["name"]; ?>-<?php echo $gutscheine["name"];?>" value="<?php echo $Sub["name"]; ?>"><button type="button" class="entfernen" value="<?php echo $gutscheine["name"]; echo $Sub["name"]; ?>">-</button>
                        <br>count:
                        <input class="form-control" type="number" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][count]" id="count-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["count"]; ?>">
                        <br>date from:
                        <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][dates]" id="dates-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["dates"]; ?>">
                        <br>date to:
                        <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][datee]" id="datee-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["datee"]; ?>">
                        <br>price:
                        <input class="form-control" type="number" step="0.01" required name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][price]" id="price-<?php echo $Sub["name"]; ?>" value="<?php echo $Sub["price"]; ?>">
                        <br>sub requiered:
                        <input class="form-control" type="checkbox" name="<?php echo $gutscheine["name"]; ?>[<?php echo $Sub["name"]; ?>][sub]" id="sub-<?php echo $Sub["name"]; ?>" <?php if(isset($Sub["sub"]) and $Sub["sub"]=="on") { echo "checked"; } ?>>
                        <br>
                        </div><?php
                    }
                }?>
                </div> <?php
            } else {?>
                <br><br><br><br>
                Ohne:<br>
                <button type="button" class="hinzufügen" value="<?php echo $gutscheine["name"]; ?>">Hinzufügen</button> <br>
                name:
                <input class="form-control" type="text" required name="<?php echo $gutscheine["name"]; ?>[name]" id="name-<?php echo $gutscheine["name"]; ?>-<?php echo $gutscheine["name"];?>" value="<?php echo $gutscheine["name"]; ?>"><button type="button" class="entfernen" value="<?php echo $gutscheine["name"]; ?>">-</button>
                <br>count:
                <input class="form-control" type="number" required name="<?php echo $gutscheine["name"]; ?>[count]" id="count-<?php echo $gutscheine["name"]; ?>" value="<?php echo $gutscheine["count"]; ?>">
                <br>date from:
                <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[dates]" id="dates-<?php echo $gutscheine["name"]; ?>" value="<?php echo $gutscheine["dates"]; ?>">
                <br>date to:
                <input class="form-control" type="date" required name="<?php echo $gutscheine["name"]; ?>[datee]" id="datee-<?php echo $gutscheine["name"]; ?>" value="<?php echo $gutscheine["datee"]; ?>">
                <br>price:
                <input class="form-control" type="number" step="0.01" required name="<?php echo $gutscheine["name"]; ?>[price]" id="price-<?php echo $gutscheine["name"]; ?>" value="<?php echo $gutscheine["price"]; ?>">
                <br>sub requiered:
                <input class="form-control" type="checkbox" name="<?php echo $gutscheine["name"]; ?>[sub]" id="sub-<?php echo $gutscheine["name"]; ?>" <?php if($gutscheine["sub"]=="on") { echo "checked"; } ?>>
                <br><?php
            }?>
        </div><?php
        }?>
    </div>
        <br><br>
        <button type="button" class="btn btn-primary save-btn" id="savebtngutschein" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!">Speichern</button>
</form>

<script>
    $(function(){
        var number = 0;
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
                newid = "group"+number+"[New"+number+"]";
                var objTo = document.getElementById("allcoupons");
                var divnew = document.createElement("div");
                divnew.id = newid;

                divnew.innerHTML = '<div id="group'+number+'"><br><br><br><input type="text" name="group'+number+'[name]" value="group'+number+'"><button type="button" class="hinzufügen" value="group'+number+'[New]">+</button><button type="button" class="entfernen" value="group'+number+'">-</button><br>name: <input class="form-control" type="text" required name="'+newid+'[name]" value="New'+number+'"><br>count: <input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from: <input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to: <input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date("Y-m-d"); ?>"><br>price: <input class="form-control" type="number" step="0.01" required name="'+newid+'[price]" value="0"><br>sub requiered: <input class="form-control" type="checkbox" name="'+newid+'[sub]" value="off"><br></div>';

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

            divnew.innerHTML = '<div id="'+newid+'"><br>name: <input class="form-control" type="text" required name="'+newid+'[name]" value="New'+number+'"><button type="button" class="entfernen" value="'+newid+'">-</button><br>count: <input class="form-control" type="number" required name="'+newid+'[count]" value="1"><br>date from: <input class="form-control" type="date" required name="'+newid+'[dates]" value="<?php echo date('Y-m-d'); ?>"><br>date to: <input class="form-control" type="date" required name="'+newid+'[datee]" value="<?php echo date("Y-m-d"); ?>"><br>price: <input class="form-control" type="number" step="0.01" required name="'+newid+'[price]" value="0"><br>sub requiered: <input class="form-control" type="checkbox" name="'+newid+'[sub]" value="off"><br></div>';
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
a coupon example in a group

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

a coupon without a group

{
    "without":
    {
        "name":"without",
        "count":"1",
        "dates":"2015-12-01",
        "datee":"2015-12-03",
        "price":"0.00",
        "sub":"on"
    }
}
-->
