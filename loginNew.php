<?php
        require_once('createDB.php');
        $userName = trim($_REQUEST['userName']);
        $userName = strip_tags($_REQUEST['userName']);
        $userName = htmlspecialchars($_REQUEST['userName']);

        $password = trim($_REQUEST['password']);
        $password = strip_tags($_REQUEST['password']);
        $password = htmlspecialchars($_REQUEST['password']); 

        $sql = "SELECT ID, Password FROM userLogin where UserName = '$userName'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($result);
        $hash = $row[1];
        $found = $row['found'];
        $counter = mysqli_num_rows($result);

        if (password_verify($password, $hash)) {
                    echo 'Password is valid!';
                    $_SESSION['login_user'] = $userName;
                    $update_query = "UPDATE UserLogin SET ts = CURRENT_TIMESTAMP where UserName = '$userName'";
                    $result2 = mysqli_query($link, $update_query);
                    $row2 = mysqli_fetch_array($result2);
                    header("location: welcome.php");
        } else {
                 echo ("<p> Your Login Name or Password is invalid </p>");
                 echo($hash);
                 echo($password);
                 require("login.php");
        }


        /**
        if($counter == 1) {
            $_SESSION['login_user'] = $userName;
            header("location: welcome.php");
            } else  {
                    echo ("<p> Your Login Name or Password is invalid </p>");
                    require("login.php");
                }  
                */
        ?>