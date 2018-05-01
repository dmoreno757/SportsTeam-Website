<?php
session_start();
require_once('phpNamesofRoles.php');

     // If user has already been authenticated
  function userAccess()
  {
    global $DBPasswords;
    return  isset($_SESSION['UserName']) && !empty($_SESSION['UserName'])   &&
            isset($_SESSION['UserRole']) && !empty($_SESSION['UserRole'])   &&  
            isset($DBPasswords[$_SESSION['UserRole']]);
  }
  
  
  
  if(userAccess()) {  
    $DBName = $_SESSION['UserRole'];
  } else {
     $DBName = NO_ROLE;
  }                      
  
  $DBPassword  = $DBPasswords[$DBName];

  
  printf("Connecting to DB as '%s'/'%s'<br/>", $DBName, $DBPassword);
  $link = mysqli_connect(DATA_BASE_HOST, $DBName, $DBPassword, DATA_BASE_NAME);
  
  if( $link->connect_errno != 0)  // if connection not successful
  {
    echo "Error: failed to make a MySQL connection:  " . $link->connect_error . "<br/>";
    require_once('login.php');
  }

?>