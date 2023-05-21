<?php
    session_start();
    if(!isset($_SESSION['logged'])){

        header("Location: ../about_me.php");
        exit();
    }
    
    require_once "../_connect_database.php";

    if(isset($_POST['save_article'])){
        $post_id = $_POST['post_id'];
        $visible = 0;
        if(isset($_POST['visible']))
            $visible = 1;
        $sql = $database->prepare('UPDATE posts SET title = :t, content = :c, visible = :v WHERE post_id = :p;');
        $sql->bindParam(':t', $_POST['title'], PDO::PARAM_STR);
        $sql->bindParam(':c', $_POST['content'], PDO::PARAM_STR);
        $sql->bindParam(':v', $visible, PDO::PARAM_INT);
        $sql->bindParam(':p', $post_id, PDO::PARAM_INT);
        $sql->execute();

        header("Location: l_single_article_edit.php?post_id=$post_id");
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
            <?php
                $post_id = $_GET['post_id'];

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
                                <div class="commentContent">' . $record['content'] . '<br/><br/></div>
                                ';
                                // <a class="button" href="l_single_article_edit_delete_comment.php?comment_id=' . $record['comment_id'] . '">delete</a><br/>
                        
                        generate_subcomments($database, $post_id, $record['comment_id']);
                        echo '</section><br/>';
                    }
                }

                $article_query = $database->prepare('SELECT title, content, date, comments, visible FROM posts WHERE post_id = :post_id;');
                $article_query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
                $article_query->execute();
                $matching_articles = $article_query->fetchAll();

                if(isset($matching_articles[0])){
                    $sac = $matching_articles[0]; // single article content
                    $visible = "";
                    if($sac['visible'] == 1)
                        $visible = "checked";
                    echo '
                    <form method="post" action="l_single_article_edit.php">
                        <div class="articleTitleDate">' . $sac['date'] . '</div>
                        <input type="hidden" name="save_article">
                        <input type="hidden" name="post_id" value="' . $post_id . '">
                        <br/>
                        <label>Title:</label>
                        <br/>
                        <textarea rows="1" cols="80" value="" name="title" class="textarea">' . $sac['title'] . '</textarea>
                        <br/>
                        
                        <label>Content:</label>
                        <br/>
                        <textarea rows="10" cols="80" value="" name="content" class="textarea">' . $sac['content'] . '</textarea>
                        <br/>
                        <label>
                            <input type="checkbox" name="visible" ' . $visible . '>
                            Visible
                        </label>
                        <br/>
                        <br/>
                        <a class="button" href="l_portfolio.php">Back</a>
                        <button type="submit" value="Send" name="submit" class="button">Save Article</button>
                        <a class="button" href="l_single_article_delete.php?post_id=' . $post_id . '">Delete Article</a>
                        <br/><br/>
                    </form>
                    <div class="article">
                    ';
                    echo '
                        <article class="articleContent">
                            <div class="articleCommentCounter"> Comments: ' . $sac['comments'] . '</div>';
                        
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