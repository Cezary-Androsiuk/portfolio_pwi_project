<?php
    session_start();
    if(!isset($_SESSION['logged'])){

        header("Location: ../about_me.php");
        exit();
    }
    
    require_once "../_connect_database.php";

    if(isset($_POST['add_article'])){
        $visible = 0;
        if(isset($_POST['visible']))
            $visible = 1;
        $sql = $database->prepare('INSERT INTO posts (title, content, visible) VALUES (:t, :c, :v);');
        $sql->bindParam(':t', $_POST['title'], PDO::PARAM_STR);
        $sql->bindParam(':c', $_POST['content'], PDO::PARAM_STR);
        $sql->bindParam(':v', $visible, PDO::PARAM_INT);
        $sql->execute();

        header("Location: l_portfolio.php"); 
        exit();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Article</title>
        <link href="../style.css" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <h1 class="pageTitle">
                Cezary Androsiuk
            </h1>
            <a class="adminLogin" href="_logout.php">
                login
            </a>
        </header>
        
        <?php
            require "_l_menu.php";
        ?>

        <br/>

        <main class="content">
            <form method="post" action="l_single_article_add.php">
                <input type="hidden" name="add_article">
                <br/>
                <label>Title:</label>
                <br/>
                <textarea rows="1" cols="80" value="" name="title" class="textarea"></textarea>
                <br/>
                
                <label>Content:</label>
                <br/>
                <textarea rows="10" cols="80" value="" name="content" class="textarea"></textarea>
                <br/>
                <label>
                    <input type="checkbox" name="visible" checked>
                    Visible
                </label>
                <br/>
                <br/>
                <a class="button" href="l_portfolio.php">Back</a>
                <button type="submit" value="Send" name="submit" class="button">Add Article</button>
                <br/><br/>
            </form>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>