<?php

         require_once('createDB.php');

        // $userName = trim($_REQUEST['userName']);
        // $userName = strip_tags($_REQUEST['userName']);
        // $userName = htmlspecialchars($_REQUEST['userName']);

        // $password = trim($_REQUEST['password']);
        // $password = strip_tags($_REQUEST['password']);
        // $password = htmlspecialchars($_REQUEST['password']); 

        // $sql = "SELECT Roles.roleName, UserLogin.Password FROM UserLogin, Roles where UserName = ? AND UserLogin.Role = Roles.ID_Role";
        // $result = mysqli_query($link, $sql);
        // $row = mysqli_fetch_array($result);
        
        

        // $hash = $row[1];
        // $found = $row['found'];
        // $counter = mysqli_num_rows($result);
        // $role = $row[0];
        // $roleName = $hash;

        // if (password_verify($password, $hash)) {
        //             echo 'Password is valid!';
        //             $_SESSION['UserName'] = $userName;
        //             $_SESSION['userRole'] = $roleName;
        //             require_once('welcome.php');

        // } else {
        //          echo ("<p> Your Login Name or Password is invalid </p>");
        //          echo($hash);
        //          echo($password);
        //          require_once("login.php");
        // }

         // Test data here, but you would replace with your Login Form data processing
                  // Test data here, but you would replace with your Login Form data processing
  $userName = $_POST['userName'];  // design decision: usernames are case insensitive
  $password = $_POST['password'];

  $query = "SELECT 
              Roles.roleName, UserLogin.Password 
            FROM 
              UserLogin, Roles 
             WHERE
                UserName = ?  AND
                UserLogin.Role = Roles.ID_Role";
  
  if( ($stmt = $link->prepare($query)) === FALSE )
  {
    echo "Error: failed to prepare query: ". $link->error . "<br/>";
    return -2;
  }

  if( ($stmt->bind_param('s', $userName)) === FALSE )
  {
    echo "Error: failed to bind query parameters to query: ". $link->error . "<br/>";
    return -3;
  }

  if( !($stmt->execute() && $stmt->store_result() && $stmt->num_rows === 1) )
  {
    echo "Login attempt failed<br/>";
    echo "Failure: existing user '$userName' not found<br/>";
    echo "-- display login form --<br/>";
    return -4;
  }
  
  if( ($stmt->bind_result($roleName, $PWHash)) === FALSE )
  {
    echo "Error: failed to bind query results to local variables: ". $link->error . "<br/>";
    return -5;
  }

  
  if( ($stmt->fetch()) === FALSE )
  {
    echo "Error: failed to fetch query results: ". $link->error . "<br/>";
    return -6;
  }
  
  if (! password_verify($password, $PWHash)) 
  {
    echo "Login attempt failed<br/>";
    // echo 'Password is valid!';
    echo "-- display login form --<br/>";
    return -7;
  }
  
  // Login successful at this point, do some book keeping ...
  echo "Login successful for user '$userName' as '$roleName'<br/>";
  $_SESSION['UserName'] = $userName;
  $_SESSION['UserRole'] = $roleName;
  require_once('welcome.php');
        
        ?>