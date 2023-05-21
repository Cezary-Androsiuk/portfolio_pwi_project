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
        <br/>
            <?php
                $change_readed_state = $database->prepare('UPDATE contacts SET readed = 1 WHERE contact_id = :cid;');
                $change_readed_state->bindParam(':cid', $_GET['contact_id'], PDO::PARAM_INT);
                $change_readed_state->execute();

                $select_messages = $database->prepare('SELECT * FROM contacts WHERE contact_id = :cid;');
                $select_messages->bindParam(':cid', $_GET['contact_id'], PDO::PARAM_INT);
                $select_messages->execute();
                $contacts = $select_messages->fetchAll();

                if(isset($contacts[0])){
                    $record = $contacts[0];
                    echo '
                        <a class="button" href="l_contact.php">Back</a>
                        <a class="button" href="l_contact_delete.php?contact_id=' . $record['contact_id'] . '"> Delete </a> 

                        <div class="contact_more_title">id: </div>
                        <div class="contact_more_value">' . $record['contact_id'] . '</div><br/>
                        <div class="contact_more_title">Sender Email: </div>
                        <div class="contact_more_value">' . $record['sender_mail'] . '</div><br/>
                        <div class="contact_more_title">Message: </div>
                        <div class="contact_more_value">' . $record['message'] . '</div><br/>
                        <div class="contact_more_title">Date: </div>
                        <div class="contact_more_value">' . $record['date'] . '</div><br/>
                        <div class="contact_more_title">Spam:</div>
                        <div class="contact_more_value">' . $record['spam'] . '</div>
                        
                    ';
                }
                else{
                    echo "<h4> 404 - POST NOT FOUND! </h4>";
                }
            ?>
            <br/><br/>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>