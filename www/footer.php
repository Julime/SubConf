        </div>

        <!--<link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />-->
        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="js/jquery-2.1.1-min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        <script>
        $(function(){
        var currentuser=""; // set the currentuser to check wich is selected later
        $(".tab-content").load("helper/show.php");//load the main site in the tab-content div

        $(document).on("click", ".member-list a",function() { //.member-list is the list of all users that have a profile
            var str = this.toString();
            var profileid = str.substring(str.length-32);//get profileid
            if($(this).hasClass("active")) { // if he clicks on the selected user
                $('.member-list a.active').removeClass('active'); //reset the currentuser
                currentuser="";
            } else if (document.getElementById("cb-"+profileid).checked==false){ //check if profile is not checked
                $('.member-list a.active').removeClass('active'); //remove the active class from all profiles, give the clicked profile the active class and assign currentuser
                $(this).addClass('active');
                currentuser=str.substring(this.toString().length-32); // currentuser=profileid
            };
        });

            setInterval(function(){ //refresh the userlist all 2 seconds to get new information about the other users
                $(".member-list").load("index.php .member-list", function(){
                    var activeprofile = "#id-"+currentuser;
                    $(activeprofile).addClass("active");
                });
            },2000);

            <?php //send mail to the administrator to ask if it is subday currently not in use because it would send on every reload of the page changes will be made
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
                var datapw = form.elements["passwort"].value; // open passwort modal (passwort=password)
                var profileid = form.elements["profileid"].value; // get profileid
                $.ajax({
                    type: "POST",
                    url: "helper/hashverify.php",//call the hashverify.php to controll the password
                    data: {pw: datapw, profileId: profileid},
                    success: function(data)
                    {
                        if(data=="true"){ //if the password was rigth
                            $.ajax({
                                type: "POST",
                                url: "helper/write.php",//change the actual data
                                dataType: "JSON",
                                data: $("#editform").serialize(), // serializes the form's elements.
                                success: function(data)
                                {
                                    alert("Änderungen gespeichert"); // Änderungen gespeichert = changes saved.
                                    currentuser=""; //reset the current user
                                    console.log(data.profileid); // show response from the php script.
                                    console.log("Loading show view");
                                    $( "#edit-list" ).remove();
                                    $( "#modal-footer-edit" ).remove();
                                    $( ".tab-pane" ).remove();  //lets the old content disapear immediatly
                                    $( ".tab-content" ).load( "helper/show.php", function () {
                                        $('.member-list a.active').removeClass('active');
                                        $( "#list-group-item-text-"+data.profileid ).load( "index.php #list-group-item-text-"+data.profileid );
                                        window.location.href="#top";
                                        document.getElementById('cb-'+data.profileid).checked=false;
                                        document.getElementById('cb-'+data.profileid).disabled=false;
                                        $("#cb-"+data.profileid).load("index.php #cb-"+data.profileid);
                                        $("#passwortmodal").modal("hide");
                                        //^^ reset the page
                                    });
                                }
                            });
                        } else {
                            alert("Passwort falsch"); // Passwort falsch = wrong Password
                        }
                    }
                })
                 btn.button('loading').button('reset');

                return false; // avoid to execute the actual submit of the form.
                
            });
            
            // dismiss-button in edit view
            $('.container').on('click', '#editform .dismiss-btn', function ( event ) {
                console.log("Loading show view");
                window.location.href="#top"; //go to the top of the site
                currentuser=""; //reset current user
                $( ".tab-content" ).load("helper/show.php");
                $('.member-list a.active').removeClass('active'); // deselect user
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
                        currentuser=data.profileid; //set the currentuser to the just created user
                        var gf ="'"; //to have 3 types of quotation marks in the code below (yes it workes :D (and gf because quotation marks are called Gänse Füßchen in German))
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
                $("#paypalModal").modal("hide").on("hidden.bs.modal", function(e){ //close paypal modal
                    $(".tab-content").load("helper/show.php");
                    $('.member-list a.active').removeClass('active');
                });
            });

            $('.container').on("click","#paypalModal #barYes", function(e) {
                var str = this.toString();
                var profileid = str.substring(str.length-32);//get profileid

                $(".tab-content").load("helper/mailbar.php?profileid="+profileid, function() {//load mailbar.php in tab-content to execute it
                    $(".tab-content").load("helper/show.php", function(){
                        alert("E-mail gesendet, warten sie auf die Bestätigung des Admins"); //show text that the email was send (E-mail gesendet, warten sie auf die Bestätigung des Admins= E-mail send, wait for confirmation from the admin)
                    });
                });
                $("#paypalModal").modal("hide").on("hidden.bs.modal", function(e){ //hide Paypalmodal
                    $(".tab-content").load("helper/show.php"); //show the main page again
                    $('.member-list a.active').removeClass('active'); //set all proiles to unset
                    currentuser = "";
                    alert("E-mail wird gesendet");// E-mail wird versendet = E-mail is getting send
                });
            });
            
            $('.container').on("click","#paypalModal #paypalMe", function(e) {
                var str = this.toString();
                var profileid = str.substring(str.length-32);//get profileid

                $(".tab-content").load("helper/paypalMe.php?profileid="+profileid);
            });
            $("#Print").on("click", function(){
                document.location.href = "helper/Print.php"; // redirect to print.php
            });

            $(document).on("shown.bs.modal",".modal", function(){ 
               $(this).find("[autofocus]").focus();
            });

            $(document).bind("keyup keydown", function(e){ 
                if((e.ctrlKey || e.metaKey) && e.keyCode == 80){ //catch strg+p and cmd+p
                    window.location.href = "/helper/Print.php"; //redirect to print.php 
                    return false; //avoid the normal Print action
                }
            });
            
            //delete profile
            $('.container').on('click', '#editform #<?php echo str_replace(" ","_",$config["Text"]["Delete-btn"]); ?>', function ( event ) { 
                var btn = $(this);
                btn.button('loading');
                var form = document.forms["editform"];
                var datapw = form.elements["passwort"].value; //check password
                var profileid = form.elements["profileid"].value;
                $.ajax({
                    type: "POST",
                    url: "helper/hashverify.php",
                    data: {pw: datapw, profileId: profileid},
                    success: function(data)
                    { 

                        if(data=="true"){ //if password is correct
                            $.ajax({
                                type: "POST",//delete profile
                                url: "helper/delete.php",
                                data: $("#editform").serialize(),
                                success: function(e) {
                                    alert(e);
                                    currentuser="";
                                    $(".tab-content").load("helper/show.php");
                                }
                            })
                        } else {
                            alert("passwort falsch"); //passwort falsch = wrong password
                        }
                    }
                })
            });
        });
        </script>

    </body>
</html>
