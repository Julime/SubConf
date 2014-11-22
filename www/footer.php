        </div>

        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="js/jquery-2.1.1-min.js"></script>
        <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
        <script src="js/bootstrap.min.js"></script>
        
        <script src="js/jQuery.wait/jquery.wait.js"></script>
        
        <script>
        $(function(){
 
            $('.nav-tabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $('.member-list a').click(function() {
            $('.member-list a.active').removeClass('active');
                $(this).addClass('active');
            });
            
            // save-button in edit view
            $('#editform .save-btn').click(function ( event ) {
                    
                    var btn = $(this);
                    btn.button('loading');                
                    $.ajax({
                        type: "POST",
                        url: "helper/write.php",
                        data: $("#editform").serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            alert(data); // show response from the php script.
                            $('#editform .save-btn').wait(800).button('complete').wait(1500).button('reset').removeAttr('disabled').removeClass('disabled');
                        }
                    });

                    return false; // avoid to execute the actual submit of the form.
                
            });
            
            // save-button in "new-profile" view
            $('#addform .save-btn').click(function ( event ) {
                    
                    var btn = $(this);
                    btn.button('loading');                
                    $.ajax({
                        type: "POST",
                        url: "helper/write.php",
                        data: $("#addform").serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            alert(data); // show response from the php script.
                            $('#addform .save-btn').wait(800).button('complete').wait(800).button('reset').removeAttr('disabled').removeClass('disabled');
                        }
                    });

                    return false; // avoid to execute the actual submit of the form.
                    
            });
            
            // edit-button in show view
            var profileid = $(this).attr("data-profileid");
            
            $('#LoadEditForm').click(function() {
                alert ('helper/edit.php?profileid='+profileid);
                //$( ".tab-pane" ).load("helper/edit.php?profileid="+profileid);
            });
            
        });
        </script>

    </body>
</html>