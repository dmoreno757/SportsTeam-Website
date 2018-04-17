<!DOCTYPE html>
<html>
<head>
<?php include('navbar.php'); ?>

<body>
    <h1> PLACEHOLDER</h1>
    <h2> List of Users Registered</h2>
    
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportsteam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, Name_First, Name_Last, UserName, Role FROM userlogin";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) 
  {


      echo "User ID: " . $row["id"]. " ~~~~~~~~ Name: " . $row["Name_First"]. " " . 
      $row["Name_Last"]. " ~~~~~~~~ UserName: " .
       $row["UserName"]. " ~~~~~~~~   Role: " . $row["Role"].  "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();



?> 

    <h1> PLACEHOLDER</h1>
    <h2> Who Coached Last Week's Game</h2>

   <?php
   
   echo "Team's Coach"

   ?> 

    <h1> PLACEHOLDER</h1>
    <h2> User Logins Within 48 Hours</h2>

  <?php
   
   echo "0 Users "

   ?> 


</body>
</head>
</html>

<?php
/*
    ?>

    <table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">UserID</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">First Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Last Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Username</th>
        
      </tr>
      <?php
*/



