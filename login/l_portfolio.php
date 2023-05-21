<?php
    session_start();
    if(!isset($_SESSION['logged'])){

        header("Location: ../about_me.php");
        exit();
    }
    
    require_once "../_connect_database.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portfolio</title>
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

        <main class="contentPortfolio">
            <?php
                $select_posts = 'SELECT post_id, title, date, visible FROM posts;';
                
                foreach ($database->query($select_posts) as $record){
                    $message = substr($record['title'], 0, 55);

                    $dots = "";
                    if(strcmp($message, $record['title']) != 0)
                        $dots = "...";

                    if($record['visible'] == 1)
                        echo '<article class="singlePortfolioArticle">';
                    else
                        echo '<article class="l_disabledSinglePortfolioArticle">';

                    // echo '
                    //     <a class="singleArticleRowLeft" href="l_single_article_edit.php?post_id=' . $message . $dots . '">' . $record['title'] . '</a>
                    //     <a class="singleArticleRowMiddle" href="l_single_article_edit.php?post_id=' . $record['post_id'] . '">' . $record['date'] . '</a>
                    //     <a class="singleArticleRowRight" href="l_single_article_edit.php?post_id=' . $record['post_id'] . '">...</a>
                    // </article>
                    // ';
                    echo '
                            <a class="singleArticleRowLeft">' . $message . $dots . '</a>
                            <a class="singleArticleRowMiddle">' . $record['date'] . '</a>
                            <a class="singleArticleRowRight" href="l_single_article_edit.php?post_id=' . $record['post_id'] . '">...</a>
                        </article>
                    ';
                }
            ?>
            <br/>
            <article class="singlePortfolioArticle">
                <a class="plusSignToAddAtricle" href="l_single_article_add.php"> + </a>
            </article>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>