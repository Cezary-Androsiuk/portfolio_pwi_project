<?php
    session_start();
    // wejście zalogowanym
    if(isset($_SESSION['logged'])){

        header("Location: l_about_me.php");
        exit();
    }
    require_once "../_connect_database.php";

    // wejscie przez wpisanie ścieżki
    if(!isset($_POST['login'])){
        echo "why?";
        exit();
    }

    $account = $database->prepare('SELECT * FROM admin WHERE login = :l;');
    $account->bindParam(":l", $_POST['login'], PDO::PARAM_STR);
    $account->execute();
    $record = $account->fetchAll();

    // sprawdzenie czy istnieje taki login w bazie
    if(isset($record[0])){
        $correct_password = $record[0]['password_hash'];
        $given_password = hash("sha256", $_POST['password']);
        // sprawdz czy do znalezionego loginu pasuje hash podanego przy logowaniu hasla
        if($correct_password == $given_password){
            // unset($_SESSION['login_error']);
            $_SESSION['logged'] = true;
            header("Location: l_about_me.php");
            exit();
        }
    }

    // $_SESSION['login_error'] = "Incorect login or password";
    // back to login page by javascript history (with that "back" on login.php works fine)
    // sleep(2);
    header("Location: javascript:history.back()");
    exit();


?>