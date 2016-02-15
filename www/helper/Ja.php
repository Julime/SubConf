<html>
    <head>
<!--   wird ausgeführt wenn der empfänger der frage-mail auf ja klickt     -->
    </head>
        <div>
        fals sie nicht weitergeleitet werden klicken sie <a href="/"> Hier</a>
        </div>
        <script>
        <?php
            include "read.php";
            $pw=$_GET["pw"];
            $passwort=file_get_contents("pw.txt");
            if ($pw==$passwort) {
            foreach ($profiles as $path)
            {
                $string = file_get_contents($path);
                $profile=json_decode($string,true);

                $profile["coupon"]="";
                $profile["signed"]="false";
                $file =$_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profile["profileid"].'.json';
                file_put_contents($file, json_encode($profile));
            };

            unlink("subday.txt");
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

            require_once("C:\\xampp\htdocs\subconf\www\php\PHPMailer-master\class.phpmailer.php");
            $mail = new PHPMailer();
            $mail->isHTML(true);
            $mail->Host = "mail.google.com";

            $empfaenger = "";
            include($_SERVER['DOCUMENT_ROOT'].'/helper/read.php');
            foreach($profiles as $path) {
                $string = file_get_contents($path);
                $profile=json_decode($string, true);//get all e-mails
                $empfaenger .= $profile["email"];
                $empfaenger .= ",";
            };
            $adressArray = explode (",", $empfaenger);
            foreach ($adressArray as $adresse) {
                $mail->AddAddress(trim($adresse));
            };

            $mail->From = "subconfulpr@gmail.com";
            $mail->FromName = "Subconf-Server";
            $mail->Subject = $subject;
            $mail->Body = $message;
    //      $mail->WordWrap = 50; <-wird vorgegeben macht aber keinen Unterschied
            if(!$mail->Send()) {
                exit;
                alert("gespeichert");
//                printf("Message was not sent.");
//                printf("Mailer error: ".$mail->ErrorInfo);
            } else {
//                printf("Message has been sent.\n");
            };
            } else {
                echo "</script><br>Fehler: Falsches Passwort. <script>";
            }
        ?>
        setTimeout("location.href='/'",1);
    </script>
</html>
