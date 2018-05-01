<?php

  require_once('createDB.php');

  $userName = $_POST['userName'];  // design decision: usernames are case insensitive
  $password = $_POST['password'];

  $query = "SELECT Roles.roleName, UserLogin.Password FROM UserLogin, Roles WHERE UserName = ?  AND UserLogin.Role = Roles.ID_Role";
  
  if( ($stmt = $link->prepare($query)) === FALSE )
  {
    echo "Error: failed to prepare query: ". $link->error . "<br/>";
  }

  if( ($stmt->bind_param('s', $userName)) === FALSE )
  {
    echo "Error: failed to bind query parameters to query: ". $link->error . "<br/>";
  }

  if( !($stmt->execute() && $stmt->store_result() && $stmt->num_rows === 1) )
  {
    echo "Login attempt failed<br/>";
    echo "Failure: existing user '$userName' not found<br/>";
  }
  
  if( ($stmt->bind_result($roleName, $PWHash)) === FALSE )
  {
    echo "Error: failed to bind query results to local variables: ". $link->error . "<br/>";
  }

  
  if( ($stmt->fetch()) === FALSE )
  {
    echo "Error: failed to fetch query results: ". $link->error . "<br/>";
  }
  
  if (! password_verify($password, $PWHash)) 
  {
    echo "Login attempt failed<br/>";
    // echo 'Password is valid!';
  }
      // require_once('login.php');


  // Login successful at this point, do some book keeping ...
  echo "Login successful for user '$userName' as '$roleName'<br/>";
  $_SESSION['UserName'] = $userName;
  $_SESSION['UserRole'] = $roleName;
  require_once('welcome.php');
        
        ?>