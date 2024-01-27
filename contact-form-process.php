<?php
require_once('serv_inc.php');

    if (isset($_POST['Email'])) {

        $con = mysqli_connect($host, $user, $pass, $dbname);

        if ($con === false) {
          die ('kon niet verbinden met: '. mysqli_error ());
        }
        echo 'OK, er is een verbinding <br>';

        //$ID = mysqli_real_escape_string($con,$_POST["ID"]);
        $name = mysqli_real_escape_string($con,$_POST["Name"]);
        $email =  mysqli_real_escape_string($con,$_POST["Email"]);
        $bericht_date = mysqli_real_escape_string($con,$_POST["keuzeBericht"]);
       
        if ($bericht_date == "keuze1"){
            $message = mysqli_real_escape_string($con,$_POST['Message']);
            $title = mysqli_real_escape_string($con,$_POST["Title"]);
        }else{
            $message = mysqli_real_escape_string($con,$_POST["Message1"]);
        }

        $email_to = mysqli_real_escape_string($con,$_POST["Emailto"]);
    

        clearstatcache(); 
     
        //$storedate = date("Y-m-d"); 

        $sql = "INSERT bericht (Name, Email, Message, Title, Emailto, BerichtDate ) 
                VALUES ( '$name', '$email', '$message', '$title', '$email_to', '$bericht_date')";

        if(mysqli_query($con, $sql)){
            echo "Records added successfully.";
            mysqli_close($con);
            //header('Location: http://www.freeinternetradio.nl/player.php');   
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    } else {
        echo "niet gelukt.";
    }
?>