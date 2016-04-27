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

        mail($email, $subject, $message);
?>
