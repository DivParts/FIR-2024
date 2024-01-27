<?PHP
    session_start();
    if(!isset($_SESSION['user_session'])){ header("Location: index.php"); }

    require_once('serv_inc.php');

    db_conn();
        //$dbweight = "SELECT weight FROM songs WHERE ID =?";
        //$pdo->prepare($dbweight)->execute([
        //   $_POST['PlayId']]);

        $updown = $pdo->prepare('SELECT * FROM thumbs WHERE ID = ?');
            $updown->execute([1]);  
            $row = $updown->fetch(PDO::FETCH_ASSOC);
        
        if($_POST["PlayLike"] == 1){$down = $row['down'] AND $up = $row['up'] + 1;} else {$down = $row['down'] + 1 AND $up = $row['up'];}

        $count = "UPDATE thumbs SET count = count + 1, up = ?, down = ? WHERE ID = 1";
        $pdo->prepare($count)->execute([$up,$down]);

        $sql = "UPDATE songs SET weight = weight + ? WHERE ID = ?" ;
        $pdo->prepare($sql)->execute([
            $_POST["PlayLike"] , $_POST['PlayId']]);
    
    $pdo = null;
?>