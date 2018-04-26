<!DOCTYPE html>
<html>
<head>

<body>
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>

       



<table width='350'  border="0" align="center" cellpadding="3" cellspacing="1" class="table table-bordered table-dark">


      <tr>
        <th style="vertical-align:top; border:1px solid black; background: darkblue;">Registered Users IDs</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Username</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Role</th>

      </tr>
      <?php

        require('navbar.php');
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
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
      $result = $conn->query($sql) or die($conn->error);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {

          echo "      <td </td>\n";
          echo "$row[id]";
          echo "      <td </td>\n";
          echo "$row[Name_First]";
          echo " $row[Name_Last]";
          echo "      <td </td>\n";
          echo " $row[UserName]";
          echo "      <td </td>\n";
          echo " $row[Role]";
          echo "      <tr>\n";
          


        }

      }
        
        
      ?>

      <tr>

        <th style="vertical-align:top; border:1px solid black; background: darkblue;">Teams In The League IDs</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Team Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Coach</th>
        


      </tr>


<?php
$sql = "SELECT TeamID, TeamName, TeamCoach FROM leagueteam";
$result = $conn->query($sql) or die($conn->error);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) 
{

  echo "      <td </td>\n";
  echo "$row[TeamID]";
  echo "      <td </td>\n";
  echo "$row[TeamName]";
  echo "      <td </td>\n";
  echo " $row[TeamCoach]";
  echo "      <td </td>\n";
  echo "      <tr>\n";

}
}
?>

<tr>
 <th style="vertical-align:top; border:1px solid black; background: darkblue;">User Logins in the last 48 hours</th> 
 <th style="vertical-align:top; border:1px solid black; background: lightblue;">Username</th>
 <th style="vertical-align:top; border:1px solid black; background: lightblue;">Role</th>
 <th style="vertical-align:top; border:1px solid black; background: lightblue;">Last Logged In</th>
 


 </tr>



<?php
$sql = "SELECT UserName, Role, ts FROM userlogin";
$result = $conn->query($sql) or die($conn->error);






if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) 
{
  $timest = $row['ts'];
  $time = strtotime($timest);
  $curtime = time();
  if(($curtime-$time) < 172800)  //172800 seconds = 48 hours
  {  
  echo "      <td </td>\n";
  echo "      <td </td>\n";
  echo "$row[UserName]";
  echo "      <td </td>\n";
  echo "$row[Role]";
  echo "      <td </td>\n";
  echo " $row[ts]";
  echo "      <tr>\n";
}

}
}


?>
  




</body>
</head>
</html>
