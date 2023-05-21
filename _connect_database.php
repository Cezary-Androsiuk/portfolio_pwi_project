<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $dsn = 'mysql:dbname=pwi;host=127.0.0.1';
    $user = 'root';
    $pass = '';

    try{
        $database = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        echo "Can not connect to Database! Sorry!\n";
        // echo $e->getMessage();
        exit();
    }
?>