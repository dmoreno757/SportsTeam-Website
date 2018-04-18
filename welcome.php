<!DOCTYPE html>
<html>
<head>

<body>
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>

    
<?php
      require('navbar.php');

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

$sql = "SELECT id, Name_First, Name_Last, UserName, Role, dt FROM userlogin";
$result = $conn->query($sql);

echo  "Registered Users <br><br>";


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) 
  {


      echo "User ID: " . $row["id"]. " ~~~~~~~~ Name: " . $row["Name_First"]. " " . 
      $row["Name_Last"]. " ~~~~~~~~ UserName: " .
       $row["UserName"]. " ~~~~~~~~   Role: " . $row["Role"]. "Date: " . $row["dt"]. "<br>";
  }
} else {
  echo "0 results";
}


echo  "<br><br>Who coached last week’s game? <br><br>";

$sql2 = "SELECT TeamID, TeamName, TeamCoach FROM leagueteam";
$result2 = $conn->query($sql2);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result2->fetch_assoc()) 
  {


      echo "Team " . $row["TeamID"]. " ~~~~~~~~  " . $row["TeamCoach"]. " coached last week's game for the " . 
      $row["TeamName"]. "<br>";
  }
} else {
  echo "0 results";
}


$sql3 = "SELECT UserName, Role, dt FROM userlogin";
$result3 = $conn->query($sql3);


echo  "<br><br> Who has logged in in the past 48 hours?  <br><br>";


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result3->fetch_assoc()) 
  {

      echo "" . $row["UserName"]. ", an " . $row["Role"]. ", has been active in the last 48 hours (" . 
      $row["dt"]. " )" . "<br>";
  }
} else {
  echo "0 results";
}


$conn->close();


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



