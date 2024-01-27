<?php
    require_once('serv_inc.php');
    session_start();

    db_conn();

    $blogName = isset($_GET['index'])? $_GET['index'] :0;
    
    echo '<div class="close"><i class="li bi-list"></i><i class="re bi bi-x-lg" id="btn-close"></i><br/></div>';

    if($blogName == 'null'){
        $blog = $pdo->prepare('SELECT * FROM blog ORDER BY blog_ID DESC');
    }else{
        $blog = $pdo->prepare('SELECT * FROM blog WHERE blog_name = ? ORDER BY blog_ID DESC');
    }
    
    $blog->execute([$blogName]);

    while($row = $blog->fetch(PDO::FETCH_ASSOC))
    {
        echo "<div class='blog_item'>";
            $datumstamp = $row['blog_timestamp'];
            $datumstamp = date("j F Y - H:i", strtotime($datumstamp));
            echo "<p class='blog_content_image'><img class='DJ_image' src='https://freeinternetradio.nl/images/dj/".$row['blog_name'].".jpg'></p>";
            echo "<p class='blog_content'><br/><b>".$row['blog_name']."</b><br/>".$datumstamp."</p>";
            echo "<div class='promocont'><img class='blog_image' src='https://rest.freeinternetradio.nl/images/blog/". $row['blog_image']."'>";
            echo "<p>".$row['blog_text']."</p>";
            echo "<HR style='border-width: 1px 1px 0; border-style: dashed;'>";
    //        echo "<input>"
            echo "<i class='bi bi-emoji-smile'>&nbsp</i><span id='blog_like". $row["blog_ID"]."'>" . $row['blog_like']  ."</span><i class='re bi bi-hand-thumbs-up' id='btn-like' value1='". $row["blog_ID"]."'  value2='" . $row["blog_like"] . "'></i>";
            echo "<HR/>";
        echo "</div>";
    }    
    $pdo = null;
?>        