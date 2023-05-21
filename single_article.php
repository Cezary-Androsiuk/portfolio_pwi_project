<?php
    require_once "_connect_database.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Article</title>
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

        <main class="content">
            <div class="article">
            <?php
                $post_id = $_GET['post_id'];

                
                function add_comment_form($post_id, $comment_id){
                    echo '  
                        <form method="post" action="single_article_add_comment.php">
                            <input type="hidden" value="' . $post_id . '" name="post_id">
                            <input type="hidden" value="' . $comment_id . '" name="comment_id">
                            <input type="text" value="" name="name" class="textarea"><br/>
                            <input type="text" value="" name="content" class="textarea"><br/>
                            <input type="submit" value="Add comment" name="submit" class="button">
                        </form>
                        ';
                }

                function generate_subcomments($database, $post_id, $parrent_comment){
                    if($parrent_comment == 0)
                        $comment = "SELECT comment_id, name, date, content FROM comments WHERE post_id = $post_id AND response_id is NULL;";
                    else
                        $comment = "SELECT comment_id, name, date, content FROM comments WHERE post_id = $post_id AND response_id = $parrent_comment;";
    
                    foreach($database->query($comment) as $record){
                        
                        echo '
                            <section class="comment">
                                <div class="commentTitle">
                                    <div class="commentTitleName">' . $record['name'] . '</div>
                                    <div class="commentTitleDate">' . $record['date'] . '</div>
                                </div>
                                <div class="commentContent">' . $record['content'] . '<br/><br/>';
                                add_comment_form($post_id, $record['comment_id']);
                        echo '  </div><br/>';
                        generate_subcomments($database, $post_id, $record['comment_id']);
                        echo '</section><br/>';
                    }
                }

                $article_query = $database->prepare('SELECT title, content, date, comments FROM posts WHERE post_id = :post_id AND visible = 1;');
                $article_query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
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
                            <div class="articleCommentCounter"> Comments: ' . $sac['comments'] . '</div>';
                        
                    add_comment_form($post_id, 0);
                    echo '</article>';
                    generate_subcomments($database, $post_id, 0);
                }
                else{
                    echo "<h4> 404 - POST NOT FOUND! </h4>";
                }

            ?>
            </div>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>