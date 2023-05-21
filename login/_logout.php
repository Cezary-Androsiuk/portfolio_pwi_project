<?php
    session_start();
    if(!isset($_SESSION['logged'])){

        header("Location: ../about_me.php");
        exit();
    }
    

    session_unset();

    header("Location: ../about_me.php");
?>