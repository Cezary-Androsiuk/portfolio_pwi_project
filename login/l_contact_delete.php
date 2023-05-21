<?php
    session_start();
    if(!isset($_SESSION['logged'])){

        header("Location: ../about_me.php");
        exit();
    }
    
    require_once "../_connect_database.php";

    if(isset($_GET['delete'])){
        
        $delete_query = $database->prepare('DELETE FROM contacts WHERE contact_id = :cid;');
        $delete_query->bindParam(':cid', $_GET['contact_id'], PDO::PARAM_INT);
        $delete_query->execute();

        header("Location: l_contact.php"); // back to article
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
        <br/>
            <table class="l_contactTable">
                <tr>
                    <th>id</th>
                    <th>Sender Email</th>
                    <th>Message ...</th>
                    <th>Date</th>
                    <th>Readed</th>
                    <th>Spam</th>
                    <th>More</th>
                </tr>
                <?php
                    $select_messages_to_delete = $database->prepare('SELECT * FROM contacts WHERE contact_id = :cid;');
                    $select_messages_to_delete->bindParam(':cid', $_GET['contact_id'], PDO::PARAM_INT);
                    $select_messages_to_delete->execute();
                    $messages_to_delete = $select_messages_to_delete->fetchAll();

                    if(isset($messages_to_delete[0])){
                        $single_mes = $messages_to_delete[0];
                        $message = substr($single_mes['message'], 0, 30);

                        $dots = "";
                        if(strcmp($message, $single_mes['message']) != 0)
                            $dots = " ...";

                        echo '
                        <tr>
                            <td>' . $single_mes['contact_id'] . '</td>
                            <td>' . $single_mes['sender_mail'] . '</td>
                            <td>' . $message . $dots . '</td>
                            <td>' . $single_mes['date'] . '</td>
                            <td>' . $single_mes['readed'] . '</td>
                            <td>' . $single_mes['spam'] . '</td>
                            <td> <a class="a_table" href="l_contact_more.php?contact_id=' . $single_mes['contact_id'] . '"> More </a> </td>
                        </tr>
                        ';
                    }
                    else{
                        echo "<h4> 404 - MESSAGE NOT FOUND! </h4>";
                    }
                ?>
            </table>
            <?php
                echo '
                    <h4>Are you sure you want to delete this message?</h4>
                    <a class="button" href="javascript:history.back()">Back</a>
                    <a class="button" href="l_contact_delete.php?contact_id=' . $_GET['contact_id'] . '&delete=1">Delete</a>
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