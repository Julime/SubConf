    </div>
    <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
    <script src="js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
 
        $('.nav-tabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
        $('.toggle-popover').popover();
        
    });
        
    $('.save-button').click(function () {
        var btn = $(this)
        btn.button('loading')
        $.ajax(...).always(function () {
            btn.button('reset')
        });
    });
    </script>

</body>
</html>