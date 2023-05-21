<?php
    require_once "_connect_database.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>About Me</title>
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
            <?php
                $select_content_query = 'SELECT content FROM about_me;';
                
                foreach ($database->query($select_content_query) as $record){
                    echo $record['content'];
                    echo "<br/>";
                }
            ?>
        </main>
        <br/><br/>
        <footer class="footer">
            footer
        </footer>
    </body>
</html>