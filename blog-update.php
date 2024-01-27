<?PHP
    require_once('serv_inc.php');
    session_start();
    
    $blogId = $_POST['blogId'];
    $blogLike = $_POST['blogLike'];

    db_conn();

        $sql = "UPDATE blog SET blog_like = ? WHERE blog_ID = ?" ;
        $pdo->prepare($sql)->execute([$blogLike,$blogId]);
    
    $pdo = null;
?>