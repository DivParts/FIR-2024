<?php
require_once('serv_inc.php');

    if (isset($_POST['BerichtNR'])) {

        $con = mysqli_connect($host, $user, $pass, $dbname);

        if ($con === false) {
          die ('kon niet verbinden met: '. mysqli_error ());
        }
        echo 'OK, er is een verbinding <br>';

          $berichtNR = mysqli_real_escape_string($con,$_POST["BerichtNR"]);
          $name = mysqli_real_escape_string($con,$_POST["Name"]);
          $email =  mysqli_real_escape_string($con,$_POST["Email"]); 
          $message = mysqli_real_escape_string($con,$_POST["Message"]);
          $email_to = mysqli_real_escape_string($con,$_POST["Emailto"]);
          $now = mysqli_real_escape_string($con,$_POST["Datum"]);
          $vink = mysqli_real_escape_string($con,$_POST["keuzeBericht"]);

        clearstatcache(); 
     
        //$storedate = date("Y-m-d"); 

        $sql = "UPDATE bericht (Name, Email, Message, Emailto, Datum, Vink) 
                SET ( '$name', '$email', '$message', '$email_to', '$now', '$vink' )
                WHERE BerichtNR = '$berichtNR'";

        if(mysqli_query($con, $sql)){
            echo "Records added successfully.";
            mysqli_close($con);
               
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    } else {
        echo "niet gelukt.";
    }
?>