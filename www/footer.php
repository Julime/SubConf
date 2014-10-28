        </div>

        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="js/jquery-2.1.1-min.js"></script>
        <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
        <script src="js/bootstrap.min.js"></script>

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
            
            $('#editform .save-btn').removeClass('disabled');
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
                        }
                    });

                    return false; // avoid to execute the actual submit of the form.
                    $(this).preventDefault()
                    
                
            });
            
            $('#addform .save-btn').removeClass('disabled');
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
                        }
                    });

                    return false; // avoid to execute the actual submit of the form.
                    $(this).preventDefault()
                    
                
            });
            
        });
        </script>

    </body>
</html>