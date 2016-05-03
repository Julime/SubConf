<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Subconf</title> <!-- set Title -->

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    
        <link href="css/theme.css" rel="stylesheet">

        <!-- support for Media Queries and HTML5-Elemente in Internet Explorer with HTML5 shim and Respond.js -->
        <!-- CAUTION: Respond.js doesn't work if you call the site with file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <?php include 'helper/read.php'; ?> <!-- read.php gets data like the profiles, the config file and the coupons (gutscheine in german)  -->
        <?php include 'helper/add.php'; ?> <!-- to call the modal when needed -->
        
        <div class="container">
