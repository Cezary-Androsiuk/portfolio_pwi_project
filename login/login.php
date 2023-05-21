<?php
    session_start();
    if(isset($_SESSION['logged'])){

        header("Location: l_about_me.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home page</title>
        <link href="../style.css" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <h1 class="pageTitle">
                Cezary Androsiuk
            </h1>
            <a class="adminLogin" href="javascript:history.back()">
                back
            </a>
        </header>

        <h3 class="subpageTitle">
            Login Site
        </h3>
        <form method="post" action="_login.php">
            <input class="textarea" type="text" name="login">
            <br>
            <input class="textarea" type="password" name="password">
            <br>
            <button class="button">
                Login
            </button>
        </form>
        <?php
            // if(isset($_SESSION['login_error'])){
            //     echo '<a class="contactError">' . $_SESSION['login_error'] . '</a><br/>';
            //     unset($_SESSION['login_error']);
            // }
        ?>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>