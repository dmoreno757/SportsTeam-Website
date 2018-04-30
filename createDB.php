<?php
session_start();
require_once('phpNamesofRoles.php');


/** 


function authenticatedUser()
  {
    global $DBPasswords;
    return  isset($_SESSION['UserName']) && !empty($_SESSION['UserName'])   &&
            isset($_SESSION['UserRole']) && !empty($_SESSION['UserRole'])   &&  
            isset($DBPasswords[$_SESSION['UserRole']]);
  }

  if( authenticatedUser() )  $DBName = $_SESSION['UserRole'];
  else                       $DBName = NO_ROLE;

    $dbPasswordLink = $dbPassword[$dbName];

    printf("Connecting to DB as '%s'/'%s'<br/>", $dbName, $dbPasswordLink);
    $link = mysqli_connect(DATA_BASE_HOST, $dbName, $dbPasswordLink, DATA_BASE_NAME);



 
if (mysqli_connect_errno($link)) {
     echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
     echo("<br>");
     echo("role: ". $role."<br>");
     echo("username: ". $username."<br>");
     echo("password: ". $password."<br>");
     require_once('login.php');
    }
    */

     // If user has already been authenticated
  function authenticatedUser()
  {
    global $DBPasswords;
    return  isset($_SESSION['UserName']) && !empty($_SESSION['UserName'])   &&
            isset($_SESSION['UserRole']) && !empty($_SESSION['UserRole'])   &&  
            isset($DBPasswords[$_SESSION['UserRole']]);
  }
  
  
  
  if( authenticatedUser() )  $DBName = $_SESSION['UserRole'];
  else                       $DBName = NO_ROLE;
  
  $DBPassword  = $DBPasswords[$DBName];

  
  printf("Connecting to DB as '%s'/'%s'<br/>", $DBName, $DBPassword);
  $link = mysqli_connect(DATA_BASE_HOST, $DBName, $DBPassword, DATA_BASE_NAME);
  
  if( $link->connect_errno != 0)  // if connection not successful
  {
    echo "Error: failed to make a MySQL connection:  " . $link->connect_error . "<br/>";
    return -1;
  }

?>