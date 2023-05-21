<?php
    // when adding comments to article or other comments
    require_once "_connect_database.php";

    $post_id = $_POST['post_id'];
    if(!($_POST['name'] == "" || $_POST['content'] == "")){
        
        if($_POST['comment_id'] == 0){
            $sql1 = $database->prepare('INSERT INTO comments (name, content, post_id) VALUES (:name, :content, :post_id);');
            $sql1->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
            $sql1->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
            $sql1->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
        }
        else{
            $sql1 = $database->prepare('INSERT INTO comments (name, content, post_id, response_id) VALUES (:name, :content, :post_id, :response_id);');
            $sql1->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
            $sql1->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
            $sql1->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
            $sql1->bindParam(':response_id', $_POST['comment_id'], PDO::PARAM_STR);
        }
        $sql1->execute();

        // get current post comments counter
        $get_comments = $database->prepare('SELECT comments FROM posts WHERE post_id = :post_id;');
        $get_comments->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
        $get_comments->execute();
        $comments = $get_comments->fetchAll();

        // increment post comments counter
        if(isset($comments[0])){
            $comments_count = $comments[0]['comments'];
            $comments_count ++;
            $update_content_query = $database->prepare('UPDATE posts SET comments = :c WHERE post_id = :post_id;');
            $update_content_query->bindParam(':c', $comments_count, PDO::PARAM_INT);
            $update_content_query->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
            $update_content_query->execute();
        }
        else{
            // i really don't want to think about options, I just write this comment ...
            echo "unknown error!";
            exit();
        }

    }
    header("Location: single_article.php?post_id=$post_id"); // back to article
                
?>