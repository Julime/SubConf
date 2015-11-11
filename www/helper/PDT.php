<?php

    $tx=$_GET["tx"];
    $idt="N65xa1iqpNvLzAPkePfnUFYFC-VGBRmu2pftUkUUfOGZqYxOxyucrhDP-Aa";

    $itemName = $_POST["item_name"];
    $amount = $_POST["payment_gross"];
    $myEmail = $_POST["receiver_email"];
    $userEmailPaypalId = $_POST["payer_email"];
    $paymentStatus = $_POST["payment_status"];
    $paypalTxId = $_POST["txn_id"];
    $currency = $_POST["mc_currency"];

    // Build the required acknowledgement message out of the notification just received
  $req = 'cmd=_notify-validate';               // Add 'cmd=_notify-validate' to beginning of the acknowledgement

  foreach ($_POST as $key => $value) {         // Loop through the notification NV pairs
    $value = urlencode(stripslashes($value));  // Encode these values
    $req  .= "&$key=$value";                   // Add the NV pairs to the acknowledgement
  }

  $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
  $header .= "Host: www.sandbox.paypal.com\r\n";
  $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

  $fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

  if($fp) {
    echo"verbunden";
    fputs($fp, $header . $req);

    while (!feof($fp)) {                     // While not EOF
        $res = fgets($fp, 1024);                // Get the acknowledgement response
        if (strcmp ($res, "VERIFIED") == 0) {  // Response contains VERIFIED - process notification
            echo "<br> IPN: Verified<br>";
        }
        else if (strcmp ($res, "INVALID") == 0) { //Response contains INVALID - reject
            echo "<br> IPN: Invalid";
        }
    }
    fclose($fp);
  } else
  {
    echo $errstr;
    echo $errno;
    echo "verbindung fehlgeschlagen";
  }
?>
