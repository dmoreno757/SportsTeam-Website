<?php
    require_once('createDB.php');

     
        $firstName = trim($_REQUEST['firstName']);
        $firstName = strip_tags($_REQUEST['firstName']);
        $firstName = htmlspecialchars($_REQUEST['firstName']);

        $lastName = trim($_REQUEST['lastName']);
        $lastName = strip_tags($_REQUEST['lastName']);
        $lastName = htmlspecialchars($_REQUEST['lastName']);

        $email = trim($_REQUEST['email']);
        $email = strip_tags($_REQUEST['email']);
        $email = htmlspecialchars($_REQUEST['email']);

        $userName = trim($_REQUEST['userName']);
        $userName = strip_tags($_REQUEST['userName']);
        $userName = htmlspecialchars($_REQUEST['userName']);

        $password = trim($_REQUEST['password']);
        $password = strip_tags($_REQUEST['password']);
        $password = htmlspecialchars($_REQUEST['password']); 

        $sqlReg = "INSERT INTO userlogin(Name_First, Name_Last, Email, UserName, Password)
        VALUES ('$firstName', '$lastName', '$email', '$userName', '$password')";
        $resultReg = $link->query($sqlReg);
        if ($resultReg === TRUE) {
            echo "New Record Recorded";
            } else {
                echo "error:" .$sqlStatPlayer."</br>".$mysqliStat->error;
        }
         require("login.php");
?>