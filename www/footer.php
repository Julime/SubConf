        </div>

        <!--<link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />-->
        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="js/jquery-2.1.1-min.js"></script>
        <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
        <script src="js/bootstrap.min.js"></script>

        <!--<script src="js/jquery.cssemoticons.js" type="text/javascript"></script>-->

<!-- folgendes sorgt für Fehler -->
<!--        <script src="js/jQuery.wait/jquery.wait.js"></script> -->
        
        <script>
        $(function(){
        var currentuser="";
        $(".tab-content").load("helper/show.php");

        $(document).on("click", ".member-list a",function() {
            var str = this.toString();
            var profileid = str.substring(str.length-32);//get profileid
            if($(this).hasClass("active")) {
                $('.member-list a.active').removeClass('active');
                currentuser="";
            } else if (document.getElementById("cb-"+profileid).checked==false){ // check if profile is not checked
                $('.member-list a.active').removeClass('active');
                $(this).addClass('active');
                currentuser=str.substring(this.toString().length-32);
            };
        });

            setInterval(function(){
                $(".member-list").load("index.php .member-list", function(){
                    var activeprofile = "#id-"+currentuser;
                    $(activeprofile).addClass("active");
                });
            },2000);

            <?php
//            $subday = file_get_contents("helper/subday.txt");
//           if(date("D")=="Tue" && $subday == " ") { ?>
//            $(".user-list").load("helper/mail.php", function(){
//                $( ".user-list").load("index.php .user-list", function(){
//                    $(".tab-content").load("helper/show.php");
//                });
//            });
            <?php //} ?>
            <?php
//            if(date("D")=="Tue") {
//                unlink("helper/subday.txt");
//                ob_start();
//                echo " ";
//                $content = ob_get_contents();
//
//                $file = fopen("helper/subday.txt", "w");
//                fwrite($file, $content);
//                ob_clean();
//           } ?>


            // save-button in edit view
            $('.container').on('click', '#editform #<?php echo str_replace(" ","_",$config["Text"]["Save-changes-btn"]); ?>', function ( event ) {
                var btn = $(this);
                btn.button('loading');
                var form = document.forms["editform"];
                var datapw = form.elements["passwort"].value;
                var profileid = form.elements["profileid"].value;
                $.ajax({
                    type: "POST",
                    url: "helper/hashverify.php",
                    data: {pw: datapw, profileId: profileid},
                    success: function(data)
                    {
                        if(data=="true"){
                            $.ajax({
                                type: "POST",
                                url: "helper/write.php",
                                dataType: "JSON",
                                data: $("#editform").serialize(), // serializes the form's elements.
                                success: function(data)
                                {
                                    alert("Änderungen gespeichert");
                                    currentuser="";
                                    console.log(data.profileid); // show response from the php script.
                                    console.log("Loading show view");
                                    $( "#edit-list" ).remove();
                                    $( "#modal-footer-edit" ).remove();
                                    $( ".tab-pane" ).remove();  //sorgt dafür das die alten Inhalte sofort verschwinden
                                    $( ".tab-content" ).load( "helper/show.php", function () {
                                        $('.member-list a.active').removeClass('active');
                                        $( "#list-group-item-text-"+data.profileid ).load( "index.php #list-group-item-text-"+data.profileid );
                                        window.location.href="#top";
                                        document.getElementById('cb-'+data.profileid).checked=false;
                                        document.getElementById('cb-'+data.profileid).disabled=false;
                                        $("#cb-"+data.profileid).load("index.php #cb-"+data.profileid);
                                        $("#passwortmodal").modal("hide");
                                    });

                                    //load show view (überflüssig? weil doppelt)
            //                        console.log("Loading show view");
            //                        $( ".tab-pane" ).load("helper/show.php");
                                    }
                            });
                        } else {
                            alert("Passwort falsch");
                        }
                    }
                })
                 btn.button('loading').button('reset');

                return false; // avoid to execute the actual submit of the form.
                
            });
            
            // dismiss-button in edit view
            $('.container').on('click', '#editform .dismiss-btn', function ( event ) {
                console.log("Loading show view");
                window.location.href="#top";
                currentuser="";
                $( ".tab-content" ).load("helper/show.php");
                $('.member-list a.active').removeClass('active');
            });

            // cookie buttons
            $('html').on('click', '.spinner .btn:first-of-type', function() {
              var btn = $(this);
              var input = btn.closest('.spinner').find('input');
              if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {
                input.val(parseInt(input.val(), 10) + 1);
              } else {
                btn.next("disabled", true);
              }
            });
            $('html').on('click', '.spinner .btn:last-of-type', function() {
              var btn = $(this);
              var input = btn.closest('.spinner').find('input');
              if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {
                input.val(parseInt(input.val(), 10) - 1);
              } else {
                btn.prev("disabled", true);
              }
            });

            // save-button in "new-profile" view
            $('html').on('click', '#addform .save-btn', function ( event ) {
                var btn = $(this);
                btn.button('loading');
                $.ajax({
                    type: "POST",
                    url: "helper/write.php",
                    dataType: "JSON",
                    data: $("#addform").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        console.log(data); // show response from the php script.
//                        $( ".user-list" ).load("index.php .user-list",function(){
//                            $( ".tab-content" ).load("helper/edit.php?profileid="+data.profileid);
//                            $('.member-list a.active').removeClass('active', function() {
//                                $(".user-list #user-"+data.profileid).addClass('active');
//                            });
//                        });
                        currentuser=data.profileid;
                        var gf ="'";
                        var newprofile = document.createElement("div");
                        newprofile.className="input-group";
                        newprofile.innerHTML = '<span class="input-group-addon"><input type="checkbox" id="cb-'+data.profileid+'"  onClick='+gf+'$(".tab-content").load("helper/teilnehmer.php?profileid='+data.profileid+'"); document.getElementById("cb-'+data.profileid+'").checked=false;'+gf+'></span> <a href="#user-'+data.profileid+'" data-toggle="tab" class="list-group-item active" onClick='+gf+'if(!document.getElementById("cb-'+data.profileid+'").disabled==true){ if($(this).hasClass("active")){ $(".tab-content").load("helper/show.php"); } else { $(".tab-content").load("helper/edit.php?profileid='+data.profileid+'") } }'+gf+'> <h4 class="list-group-item-heading">'+data.vorname+' '+data.nachname+'</h4> <p class="list-group-item-text" id="list-group-item-text-'+data.profileid+'"></p></a>';
                        document.getElementById("listgroup").appendChild(newprofile);
                        $( ".tab-content" ).load("helper/edit.php?profileid="+data.profileid);
                    }
                });
                $(".form-control").val('');
                btn.button('loading').button('reset');
                return false; // avoid to execute the actual submit of the form.
            });
            
            // edit-button in show view
            $('.container').on('click', '#LoadEditForm', function ( event ) {
                console.log("Loading Edit Form");
                
                $('.member-list a').addClass('disabled');

                var profileid = $(this).data("profileid");
                $( ".tab-content" ).load("helper/edit.php?profileid="+profileid);
            });

            // dismiss-button in paypal.php
            $('.container').on("click","#paypalModal #paypalNo" ,function (e)
            {
                $("#paypalModal").modal("hide").on("hidden.bs.modal", function(e){
                    $(".tab-content").load("helper/show.php");
                    $('.member-list a.active').removeClass('active');
                });
            });

            $('.container').on("click","#paypalModal #barYes", function(e) {
                var str = this.toString();
                var profileid = str.substring(str.length-32);//get profileid

                $(".tab-content").load("helper/mailbar.php?profileid="+profileid, function() {
                    $(".tab-content").load("helper/show.php", function(){
                        alert("E-mail gesendet, warten sie auf die Bestätigung des Admins");
                    });
                });
                $("#paypalModal").modal("hide").on("hidden.bs.modal", function(e){
                    $(".tab-content").load("helper/show.php");
                    $('.member-list a.active').removeClass('active');
                    alert("E-mail wird gesendet");
                });
            });

            $("#Print").on("click", function(){
                document.location.href = "helper/Print.php";
            });

            $(document).on("shown.bs.modal",".modal", function(){
               $(this).find("[autofocus]").focus();
            });

            $(document).bind("keyup keydown", function(e){
                if((e.ctrlKey || e.keyCode == 224 || e.keyCode == 91  || e.keyCode == 93) && e.keyCode == 80){
                    window.location.href = "/helper/Print.php";
                    return false;
                }
            });

            $('.container').on('click', '#editform #<?php echo str_replace(" ","_",$config["Text"]["Delete-btn"]); ?>', function ( event ) {
                var btn = $(this);
                btn.button('loading');
                var form = document.forms["editform"];
                var datapw = form.elements["passwort"].value;
                var profileid = form.elements["profileid"].value;
                $.ajax({
                    type: "POST",
                    url: "helper/hashverify.php",
                    data: {pw: datapw, profileId: profileid},
                    success: function(data)
                    {

                        if(data=="true"){
                            $.ajax({
                                type: "POST",
                                url: "helper/delete.php",
                                data: $("#editform").serialize(),
                                success: function(e) {
                                    alert(e);
                                    currentuser="";
                                    $(".tab-content").load("helper/show.php");
                                }
                            })
                        } else {
                            alert("passwort falsch");
                        }
                    }
                })
            });

            /*window.onload = function(){
                $(".comment").emoticonize();
            };*/

        });
        </script>

    </body>
</html>
