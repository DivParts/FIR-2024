<?php
    require_once('serv_inc.php');
    session_start();

    db_conn();
?>
<div class="refreschpromo">       
    <?php
        $time_hour = date("H");
        $time_min = date("i");
        $day = date("w");

        $promo = $pdo->prepare('SELECT * FROM promo Where promo_day LIKE ? AND promo_hour LIKE ? AND promo_begtime > ? AND promo_enabled = ? ORDER BY promo_begtime + 0 ASC LIMIT 1 ');
        $promo->execute(["%".$day."%","%".$time_hour."%", $time_min, 1]);
        $count =  $promo -> rowcount();
        if ($count < 1)
        {
            $promo = $pdo->prepare('SELECT * FROM promo Where promo_day LIKE ? AND promo_hour LIKE ? AND promo_begtime > ? AND promo_enabled = ? ORDER BY promo_begtime + 0 ASC LIMIT 1 ');
            $promo->execute(["%".$day."%","%".$time_hour."%", 0, 1]);
        }

        while($row_promo = $promo->fetch(PDO::FETCH_ASSOC))
        {
            echo "<div class='promocont'><img class='promo_image' src='https://rest.freeinternetradio.nl/images/promo/". $row_promo['promo_image']."' >";
            echo "<b>" .$row_promo['promo_name'] ."</b><br/>";
            echo $row_promo['promo_text'].'</div>';
        }
        
        $pdo = null;
    ?>        
</div>

