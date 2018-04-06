<?php


define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'sportsteam');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(SERVER, USERNAME, PASSWORD, DB_NAME);
 
// Check connection
if (mysqli_connect_errno($link)) {
     echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
    } else { 
        echo 'Successfully connected to your database'; 
    }

?>