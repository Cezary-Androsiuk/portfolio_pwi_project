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
            <table class="l_contactTable">
                <tr>
                    <th>id</th>
                    <th>Sender Email</th>
                    <th>Message ...</th>
                    <th>Date</th>
                    <th>Readed</th>
                    <th>Spam</th>
                    <th>Read More</th>
                    <th>Delete</th>
                </tr>
                <?php
                    $select_messages = $database->prepare('SELECT * FROM contacts;');
                    $select_messages->execute();

                    foreach($select_messages->fetchAll() as $record){
                        $message = substr($record['message'], 0, 30);

                        $dots = "";
                        if(strcmp($message, $record['message']) != 0)
                            $dots = " ...";

                        echo '
                        <tr>
                            <td>' . $record['contact_id'] . '</td>
                            <td>' . $record['sender_mail'] . '</td>
                            <td>' . $message . $dots . '</td>
                            <td>' . $record['date'] . '</td>
                            <td>' . $record['readed'] . '</td>
                            <td>' . $record['spam'] . '</td>
                            <td> <a class="a_table" href="l_contact_more.php?contact_id=' . $record['contact_id'] . '"> Read More </a> </td>
                            <td> <a class="a_table" href="l_contact_delete.php?contact_id=' . $record['contact_id'] . '"> Delete </a> </td>
                        </tr>
                        ';
                    }
                ?>
            </table>
        <br/><br/>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>