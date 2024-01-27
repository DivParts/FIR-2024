<?php
    require_once('serv_inc.php');

    $djTrack = isset($_GET['index'])? (int)$_GET['index'] : 0;

    db_conn();

    $voorstel = $pdo->prepare('SELECT * FROM dj Where DJ_ID = ?');
    $voorstel->execute([$djTrack]);
  
    while ($rownu = $voorstel->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="close"><i class="li bi-chat-square-text" id="btn-ShowModalBlog" value="'. $rownu["DJ_name"].'"></i><i class="re bi bi-x-lg" id="btn-close"></i></div>';
        echo '</br><hr>';
        echo $rownu['DJ_story'];
    }   
    $pdo = null;
            
?>