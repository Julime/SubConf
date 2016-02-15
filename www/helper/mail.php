<?php
        $date = strftime("%d.%m.%Y");

        $pw = mt_rand(1000,9999);
        unlink("pw.txt");
        ob_start();
        echo $pw;
        $content = ob_get_contents();

        $file = fopen("pw.txt", "w");
        fwrite($file, $content);
        ob_clean();

        $email = $config["Data"]["Administrator-E-mail"];
        $subject = "Subday am ".$date."?";
        $message = "Ist Heute Subday? <br><a href='http://subconf/helper/Ja.php?pw=".$pw."'>Ja</a> <br> <a href='http://subconf/helper/Nein.php?pw=".$pw."'>Nein</a>";

        require_once("C:\\xampp\htdocs\subconf\www\php\PHPMailer-master\class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->isHTML(true);
        $mail->Host = "mail.google.com";
        $mail->AddAddress($email);
        $mail->From = "subconfulpr@gmail.com";
        $mail->FromName = "Subconf-Server";
        $mail->Subject = $subject;
        $mail->Body = $message;
//      $mail->WordWrap = 50; <-wird vorgegeben macht aber keinen Unterschied
        if(!$mail->Send()) {
//            printf("Message was not sent.");
//            printf("Mailer error: ".$mail->ErrorInfo);
        } else {
//            printf("Message has been sent.\n");
        };
?>
