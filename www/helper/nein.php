<html>
    <head>
    </head>
        <div>
        <?php echo $config["Text"]["redirect"]; ?> <a href="/"> <?php echo $config["Text"]["here"]; ?></a>
        </div>
        <script>
        <?php
            $pw=$_GET["pw"];
            $passwort=file_get_contents("pw.txt");
            if ($pw==$passwort) {
            unlink("subday.txt");
            ob_start();
            echo " ";
            $content = ob_get_contents();

            $file = fopen("subday.txt", "a");
            fwrite($file, $content);
            ob_clean();
            alert("gespeichert");
            } else {
                echo "</script>Fehler: Falsches Passwort.<script>";
            }
        ?>

        setTimeout("location.href='/'",1);
    </script>
</html>
