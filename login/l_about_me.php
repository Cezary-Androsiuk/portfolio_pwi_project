<?php
    session_start();
    if(!isset($_SESSION['logged'])){

        header("Location: ../about_me.php");
        exit();
    }
    
    
    // check if you logged
    
    require_once "../_connect_database.php";
    
    if(isset($_POST['content'])){
        $update_content_query = $database->prepare('UPDATE about_me SET content = :c WHERE data_id = 1;');
        $update_content_query->bindParam(':c', $_POST['content'], PDO::PARAM_STR);
        $update_content_query->execute();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>About Me</title>
        <link href="../style.css" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <h1 class="pageTitle">
                Cezary Androsiuk
            </h1>
            <a class="adminLogin" href="_logout.php">
                logout
            </a>
        </header>
        
        <?php
            require "_l_menu.php";
        ?>
        
        <br/>

        <main class="content">
            <?php
                $select_content_query =$database->prepare('SELECT content FROM about_me;');
                $select_content_query->execute();
                $single_record = $select_content_query->fetchAll();

                $content = "";
                if(isset($single_record[0])){
                    $content = $single_record[0]['content'];
                }

                echo '
                <br/>
                <form method="post" action="l_about_me.php">
                    <textarea rows="10" cols="80" value="" name="content" class="textarea">' . $content . '</textarea>
                    <br/>
                    <input class="button" type="submit" value="update">
                </form>
                <br/>
                ';
                if(isset($_POST['content'])){
                    unset($_POST['content']);
                    echo 'UPDATED!';
                }
            ?>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>