<?php
    require_once "_connect_database.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portfolio</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <h1 class="pageTitle">
                Cezary Androsiuk
            </h1>
            <a class="adminLogin" href="login/login.php">
                login
            </a>
        </header>
        
        <?php
            require "_menu.php";
        ?>

        <br/>

        <main class="contentPortfolio">
            <?php

                $select_posts = 'SELECT post_id, title, date FROM posts WHERE visible = 1;';
                
                foreach ($database->query($select_posts) as $record){
                    $message = substr($record['title'], 0, 55);

                    $dots = "";
                    if(strcmp($message, $record['title']) != 0)
                        $dots = "...";

                    // echo '
                    //     <article class="singlePortfolioArticle">
                    //         <a class="singleArticleRowLeft" href="single_article.php?post_id=' . $message . $dots . '">' . $record['title'] . '</a>
                    //         <a class="singleArticleRowMiddle" href="single_article.php?post_id=' . $record['post_id'] . '">' . $record['date'] . '</a>
                    //         <a class="singleArticleRowRight" href="single_article.php?post_id=' . $record['post_id'] . '">...</a>
                    //     </article>
                    // ';
                    echo '
                        <article class="singlePortfolioArticle">
                            <a class="singleArticleRowLeft">' . $message . $dots . '</a>
                            <a class="singleArticleRowMiddle">' . $record['date'] . '</a>
                            <a class="singleArticleRowRight" href="single_article.php?post_id=' . $record['post_id'] . '">...</a>
                        </article>
                    ';
                }
            ?>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>