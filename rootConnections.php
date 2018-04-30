<?php
$server = 'localhost';
$uname = 'root';
$pass = '';
$db = 'sportsteam';

// define('SERVER', 'localhost');
// define('USERNAME', 'root');
// define('PASSWORD', '');
// define('DB_NAME', 'sportsteam');

$link2 = mysqli_connect($server, $uname, $pass, $db) or die("Error from the root connection ".mysqli_error($link2));
?>