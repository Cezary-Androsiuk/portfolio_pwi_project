<?php
    // when sending message in contact subpage
    session_start();
    require_once "_connect_database.php";

    if(!isset($_POST['email'])){
        echo "unauthorized connection! <br/>";
        exit();
    }

    $email = $_POST['email'];
    $message = $_POST['message'];

    $all_fine = true;

    if($email == ""){
        $all_fine = false;
        $_SESSION["contact_error_email"] = "FILL THIS AREA!";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $all_fine = false;
        $_SESSION["contact_error_email"] = "THIS MUST BE AN EMAIL!";
    }
    if($message == ""){
        $all_fine = false;
        $_SESSION["contact_error_message"] = "FILL THIS AREA!";
    }

    if($all_fine){
        // check if exist similar message in database
        $spam = 0;
        $select_message = 'SELECT message FROM contacts;';
        foreach ($database->query($select_message) as $record){
            if($message == $record['message']){
                $spam = 1;
            }
        }
    
        $sql2 = $database->prepare('INSERT INTO contacts (sender_mail, message, spam) VALUES (:sm, :m, :spam);');
        $sql2->bindParam(':sm', $email, PDO::PARAM_STR);
        $sql2->bindParam(':m', $message, PDO::PARAM_STR);
        $sql2->bindParam(':spam', $spam, PDO::PARAM_INT);
        $sql2->execute();
        $_SESSION['conntact_sended'] = true;
    }
    else{
        $_SESSION['conntact_previous_value_email'] = $email;
        $_SESSION['conntact_previous_value_message'] = $message;
    }
    
    sleep(2);
    header("Location: contact.php"); // back to article
?>