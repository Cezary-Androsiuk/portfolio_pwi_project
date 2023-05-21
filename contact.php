<?php
    session_start();
    require_once "_connect_database.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact</title>
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

        <?php
            // default params in textboxes
            $email = "";
            $message = "";
            
            // check if this is another try of sending message
            if(isset($_SESSION['conntact_previous_value_email'])){
                $email = $_SESSION['conntact_previous_value_email'];
                unset($_SESSION['conntact_previous_value_email']);
            }

            if(isset($_SESSION['conntact_previous_value_message'])){
                $message = $_SESSION['conntact_previous_value_message'];
                unset($_SESSION['conntact_previous_value_message']);
            }
        ?>

        <main class="content">
            <form method="post" action="contact_send.php">
                <label>Your Email:</label>
                <br/>
                <?php
                    // display warning about email value in textarea
                    if(isset($_SESSION['contact_error_email'])){
                        echo '<span class="contactError">';
                        echo $_SESSION['contact_error_email'];
                        echo '</span><br/>';
                        unset($_SESSION['contact_error_email']);
                    }
                    echo '
                    <textarea rows="1" cols="50" value="" name="email" class="textarea">' . $email . '</textarea>
                    <br/>
                    ';
                ?>
                
                <label>Message:</label>
                <br/>
                <?php
                    // display warning about message value in textarea
                    if(isset($_SESSION['contact_error_message'])){
                        echo '<span class="contactError">';
                        echo $_SESSION['contact_error_message'];
                        echo '</span><br/>';
                        unset($_SESSION['contact_error_message']);
                    }
                    echo '
                    <textarea rows="6" cols="70" value="" name="message" class="textarea">' . $message . '</textarea>
                    <br/>
                    ';
                ?>
                <button type="submit" value="Send" name="submit" class="button">
                    Send
                </button>
                <br/><br/>
            </form>
            <?php
                // shows when message was sended correctly
                if(isset($_SESSION['conntact_sended'])){
                    unset($_SESSION['conntact_sended']);
                    echo "SENDED!";
                }
            ?>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>