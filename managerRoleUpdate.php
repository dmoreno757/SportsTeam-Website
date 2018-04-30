<?php
      require_once('navbar.php');
      include_once('createDB.php');


       if ($_REQUEST['role'] == 'Observer') {
            $role = 1;
        }
        else if ($_REQUEST['role'] == 'Users') {
            $role = 2;
        } else {
            $role = 3;
        }

        $Name_First = $_REQUEST['firstName'];
        $Name_Last = $_REQUEST['lastName'];


        $sql = "UPDATE UserLogin SET Role ='$role' WHERE Name_First = '$Name_First' AND Name_Last = '$Name_Last'";
        $query = mysqli_query($link, $sql);
             if (!$query) {
	              die ('SQL Error: ' . mysqli_error($link));
              }

              include_once('users.php')
    
?>
