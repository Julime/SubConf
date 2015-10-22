<?php
        $date = strftime("%d.%m.%Y");
        $subject = "Subconf-Bestellung vom ".$date;
        $message = "Subconf-Bestellung vom ".$date;

        require_once("C:\\xampp\htdocs\subconf\www\php\PHPMailer-master\class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->Host = "mail.google.com";
        $mail->AddAddress("Littellittel@gmx.de");
        $mail->From = "marcelbaumann16@gmail.com";
        $mail->FromName = "Subconf-User";
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAttachment("data.html");
//      $mail->WordWrap = 50; <-wird vorgegeben macht aber keinen Unterschied
        if(!$mail->Send()) {
//            printf("Message was not sent.");
//            printf("Mailer error: ".$mail->ErrorInfo);
        } else {
//            printf("Message has been sent.\n");
        };
?>
