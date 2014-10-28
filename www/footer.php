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
            
            $('#editform .save-btn').click(function ( event ) {
                    
                    var btn = $(this);
                    btn.button('loading');                
                    $.ajax({
                        type: "POST",
                        url: "helper/write.php",
                        data: $("#editform").serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            $('#editform .save-btn').wait(800).button('complete').wait(1500).button('reset').removeAttr('disabled').removeClass('disabled');
                        }
                    });

                    return false; // avoid to execute the actual submit of the form.
                
            });
            
            $('#addform .save-btn').click(function ( event ) {
                    
                    var btn = $(this);
                    btn.button('loading');                
                    $.ajax({
                        type: "POST",
                        url: "helper/write.php",
                        data: $("#addform").serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            $('#addform .save-btn').wait(800).button('complete').wait(800).button('reset').removeAttr('disabled').removeClass('disabled');
                        }
                    });

                    return false; // avoid to execute the actual submit of the form.
                    
            });
            
        });
        </script>

    </body>
</html>