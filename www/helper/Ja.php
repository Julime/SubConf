<html>
    <head>
<!--   script to execute if the admin confirms that it is subday     -->
    </head>
        <div>
        <?php echo $config["Text"]["redirect"]; ?> <a href="/"> <?php echo $config["Text"]["here"]; ?></a>
        </div>
        <script>
        <?php
            include "read.php";
            //check if the password that is contained in the link is right
            $pw=$_GET["pw"];
            $passwort=file_get_contents("pw.txt");
            if ($pw==$passwort) {
            foreach ($profiles as $path)
            {
                $string = file_get_contents($path);
                $profile=json_decode($string,true);

                $profile["coupon"]=""; //reset all coupons
                $profile["signed"]="false"; //set all profiles to unsigned
                $file =$_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profile["profileid"].'.json';
                file_put_contents($file, json_encode($profile));
            };

            unlink("subday.txt"); //reset the subday "memory"
            //rewrite it
            ob_start();
            echo "yes";
            $content = ob_get_contents();

            $file = fopen("subday.txt", "w");
            fwrite($file, $content);
            ob_clean();

            $date = strftime("%d.%m.%Y");
            $subject = "Heute der ".$date." ist Subday!";
            $message = "Heute ist Subday fals du etwas Bestellen moechtest klicke auf diesen ";
            $message .= '<a href="http://subconf">Link</a>';
            $message .= "\n und stelle deinen Sub zusammen. <br> Vergesse nicht einen Hacken bei deinem Namen zu setzen.";

            $empfaenger = "";
            include($_SERVER['DOCUMENT_ROOT'].'/helper/read.php');
            foreach($profiles as $path) {
                $string = file_get_contents($path);
                $profile=json_decode($string, true);//get all e-mails
                $empfaenger .= $profile["email"];
                $empfaenger .= ",";
            };
            $adressArray = explode (",", $empfaenger); //put a comma between every reciver
            foreach ($adressArray as $adresse) {
                $mail->AddAddress(trim($adresse));
            };
            mail($empfaenger, $subject, $message); //send mail to all profiles that it is infact subday
        ?>
        setTimeout("location.href='/'",1);
    </script>
</html>
