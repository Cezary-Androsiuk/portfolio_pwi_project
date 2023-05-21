<?php
    session_start();
    if(!isset($_SESSION['logged'])){

        header("Location: ../about_me.php");
        exit();
    }
    
    require_once "../_connect_database.php";

    if(isset($_GET['delete'])){
        // to remove error while deleting records
        $disable_constraint_checks = $database->prepare('SET FOREIGN_KEY_CHECKS=0;');
        $disable_constraint_checks->execute();

        // remove post
        $delete_post = $database->prepare('DELETE FROM posts WHERE post_id = :pid;');
        $delete_post->bindParam(':pid', $_GET['post_id'], PDO::PARAM_INT);
        $delete_post->execute();

        // remove all coments that has this post_id
        $delete_comments = $database->prepare('DELETE FROM comments WHERE post_id = :pid;');
        $delete_comments->bindParam(':pid', $_GET['post_id'], PDO::PARAM_INT);
        $delete_comments->execute();

        // to remove error while deleting records
        $enable_constraint_checks = $database->prepare('SET FOREIGN_KEY_CHECKS=1;');
        $enable_constraint_checks->execute();

        header("Location: l_portfolio.php"); 
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact</title>
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
            <div class="article">
                <?php
                    $article_query = $database->prepare('SELECT title, content, date, comments FROM posts WHERE post_id = :post_id;');
                    $article_query->bindParam(':post_id', $_GET['post_id'], PDO::PARAM_INT);
                    $article_query->execute();
                    $matching_articles = $article_query->fetchAll();

                    if(isset($matching_articles[0])){
                        $sac = $matching_articles[0]; // single article content
                        echo '
                            <div class="articleTitle">
                                <div class="articleTitleName">' . $sac['title'] . '</div>
                                <div class="articleTitleDate">' . $sac['date'] . '</div>
                            </div>
                            <article class="articleContent">
                                <div>' . $sac['content'] . '</div>
                                <br/><br/>
                                <div class="articleCommentCounter"> Comments: ' . $sac['comments'] . '</div>
                            </article>';
                    }
                    else{
                        echo "<h4> 404 - POST NOT FOUND! </h4>";
                    }
                ?>
            </div>
            <?php
                echo '
                    <h4>Are you sure you want to delete this post with all comments?</h4>
                    <a class="button" href="l_single_article_edit.php?post_id=' . $_GET['post_id'] . '">Back</a>
                    <a class="button" href="l_single_article_delete.php?post_id=' . $_GET['post_id'] . '&delete=1">Delete</a>
                    <br/><br/>
                ';
            ?>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>