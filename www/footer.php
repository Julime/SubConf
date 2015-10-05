        </div>

        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="js/jquery-2.1.1-min.js"></script>
        <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
        <script src="js/bootstrap.min.js"></script>
        
        <script src="js/jQuery.wait/jquery.wait.js"></script>
        
        <script>
        $(function(){

            $('.member-list a').click(function() {
                $('.member-list a.active').removeClass('active');
                $(this).addClass('active');
            });
            
            // save-button in edit view
            $('.container').on('click', '#editform .save-btn', function ( event ) {
                console.log("Loading show view");
                $( ".tab-pane" ).load("helper/show.php");//load show view

                var btn = $(this);
                btn.button('loading');
                $.ajax({
                    type: "POST",
                    url: "helper/write.php",
                    dataType: "JSON",
                    data: $("#editform").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        console.log(data); // show response from the php script.
                        $('#editform .save-btn').wait(800).button('complete').wait(1500).button('reset').removeAttr('disabled').removeClass('disabled');
                        
                        //load show view
                        console.log("Loading show view");
                        $( ".tab-pane" ).load("helper/show.php");
                    }
                });

                return false; // avoid to execute the actual submit of the form.
                
            });
            
            // dismiss-button in edit view
            $('.container').on('click', '#editform .dismiss-btn', function ( event ) {
                console.log("Loading show view");
                $( ".tab-content" ).load("helper/show.php");
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
                        console.log(data.profileid); // show response from the php script.
                        $( ".user-list" ).load("index.php .user-list", function() {
                        $( ".tab-content" ).load("helper/edit.php?profileid="+data.profileid);
                        });
                        $('#addform .save-btn').wait(800).button('complete').wait(800).button('reset').removeAttr('disabled').removeClass('disabled');
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
                $( ".tab-pane" ).load("helper/edit.php?profileid="+profileid);
            });
            
        });
        </script>

    </body>
</html>
