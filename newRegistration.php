<?php
    include('createDB.php');

    if (isset($_REQUEST['submit']) != '') {
        $sqlReg = "INSERT INTO userlogin(Name_First, Name_Last, Email, UserName, Password)
        VALUES ('".$_REQUEST['firstName']."', '".$_REQUEST['lastName']."', '".$_REQUEST['email']."', '".$_REQUEST['userName']."','".$_REQUEST['password']."')";
    $res = mysqli_query($sql);
    $resultReg = $link->query($sqlReg);
    if ($resultReg) {
        echo "New Record Recorded";
        require("login.php");
    }
    }
?>