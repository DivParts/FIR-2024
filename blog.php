<?php
    require_once('serv_inc.php');
    session_start();

    db_conn();
?>
<div class="refreschblog">       
    <?php
        $time_hour = date("H");
        $time_min = date("i");
        $day = date("w");

        $blog = $pdo->prepare('SELECT * FROM blog ORDER BY blog_ID DESC LIMIT 1 ');
            $blog->execute();

        while($row = $blog->fetch(PDO::FETCH_ASSOC))
        {
            $datumstamp = $row['blog_timestamp'];
            $datumstamp = date("j F Y - H:i", strtotime($datumstamp));

            echo "<div class='promocont'><img class='promo_image' src='https://rest.freeinternetradio.nl/images/blog/". $row['blog_image']."'>";
            echo "<b>" .$row['blog_name'] ."</b> schreef op: ". $datumstamp."<br/>";
            echo"<HR/>";
            echo $row['blog_text'].'</div>';
            echo"<span class='re bi-chat-square-text' id='btn-ShowModalBlog' value='null'>&nbspmeer &nbsp</span>";
        }    
        $pdo = null;
    ?>        
</div>