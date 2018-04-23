<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CPSC 431 Project</title>
  </head>

  <body>
    <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>

    <?php
      require('navbar.php');
      require('Address.php');
      require('PlayerStatistic.php');

      // Connect to database
      require_once( 'Adaptation.php' );
      require('createDB.php');

      // if connection was successful
      if( mysqli_connect_error() == 0 )  // Connection succeeded
      {
////////////////////////////// ---QUERY 2---- ///////////////////////////////////////////////
		  $querytwo = "SELECT * FROM LeagueTeam";
		  if(!$resulttwo = $link->query($querytwo))
		  {
			  die('There was an error running the query part 2 ');
		  }

/////////////////////////////// ---QUERY 3---- ///////////////////////////////////////////////		  

$query3 = "SELECT t1.TeamID_A, t1.GameRound, t1.TeamAPoints,  t2.TeamName
				FROM GP_TeamA AS t1 INNER JOIN LeagueTeam AS t2
				 ON t1.TeamID_A = t2.TeamID
				 ORDER BY GameRound"; 
				
           // Check connection
             if($link === false){
              die("ERROR: Could not connect. " . $link->connect_error);
                              }

							  

/////////////////////////////// ---QUERY 4---- ///////////////////////////////////////////////

$query4 = "SELECT t3.TeamID_B, t3.GameRound, t3.TeamBPoints,  t2.TeamName
				FROM GP_TeamB AS t3 INNER JOIN LeagueTeam AS t2
				 ON t3.TeamID_B = t2.TeamID
				 ORDER BY GameRound"; 
				
           // Check connection
             if($link === false){
              die("ERROR: Could not connect. " . $link->connect_error);
                              }

							  


/////////////////////////////////////////////////////////////////////////////////////////////////


		  
        
		// Build query to retrieve player's name, address, and averaged statistics from the joined Team Roster and Statistics tables
        $query = "SELECT
		

		
                    TeamRoster.ID,
                    TeamRoster.Name_First,
                    TeamRoster.Name_Last,
                    TeamRoster.Street,
                    TeamRoster.City,
                    TeamRoster.State,
                    TeamRoster.Country,
                    TeamRoster.ZipCode,

                    COUNT(Statistics.Player),
                    AVG(Statistics.PlayingTimeMin),
                    AVG(Statistics.PlayingTimeSec),
                    AVG(Statistics.Points),
                    AVG(Statistics.Assists),
                    AVG(Statistics.Rebounds)
                  FROM TeamRoster LEFT JOIN Statistics ON
                    Statistics.Player = TeamRoster.ID
                  GROUP BY
                    TeamRoster.Name_Last,
                    TeamRoster.Name_First
                  ORDER BY
                    TeamRoster.Name_Last,
                    TeamRoster.Name_First";

        // Prepare, execute, store results, and bind results to local variables
        $stmt = $link->prepare($query);
        // no query parameters to bind
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
						   
						   
						   $Name_ID,
                           $Name_First,
                           $Name_Last,
                           $Street,
                           $City,
                           $State,
                           $Country,
                           $ZipCode,

                           $GamesPlayed,
                           $PlayingTimeMin,
                           $PlayingTimeSec,
                           $Points,
                           $Assists,
                           $Rebounds);
      }
    ?>

    <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;">Name and Address</th>
        <th style="width: 60%;">Statistics</th>
      </tr>
      <tr>
        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter Name and Address -->
          <form action="processAddressUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">First Name</td>
                <td><input type="text" name="firstName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Last Name</td>
               <td><input type="text" name="lastName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Street</td>
               <td><input type="text" name="street" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">City</td>
                <td><input type="text" name="city" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">State</td>
                <td><input type="text" name="state" value="" size="35" maxlength="100"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Country</td>
                <td><input type="text" name="country" value="" size="20" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Zip</td>
                <td><input type="text" name="zipCode" value="" size="10" maxlength="10"/></td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add Name and Address" /></td>
              </tr>
            </table>
          </form>
        </td>

        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter game statistics for a particular player -->
          <form action="processStatisticUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
<!--            <td><input type="text" name="name" value="" size="50" maxlength="500"/></td>  -->
                <td><select name="name_ID" required>
                  <option value="" selected disabled hidden>Choose player's name here</option>
                  <?php
                    // for each row of data returned,
                    //   construct an Address object providing first and last name
                    //   emit an option for the pull down list such that
                    //     the displayed name is retrieved from the Address object
                    //     the value submitted is the unique ID for that player
                    // for example:
                    //     <option value="101">Duck, Daisy</option>
                    $stmt->data_seek(0);
                    while( $stmt->fetch() )
                    {
                      $player = new Address([$Name_First, $Name_Last]);
                      echo "<option value=\"$Name_ID\">".$player->name()."</option>\n";
                    }
                  ?>
                </select></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Playing Time (min:sec)</td>
               <td><input type="text" name="time" value="" size="5" maxlength="5"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Points Scored</td>
               <td><input type="text" name="points" value="" size="3" maxlength="3"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Assists</td>
                <td><input type="text" name="assists" value="" size="2" maxlength="2"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Rebounds</td>
                <td><input type="text" name="rebounds" value="" size="2" maxlength="2"/></td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add Statistic" /></td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
    </table>
<h2 style="text-align:center">Team League Chart</h2>
<table class="table table-bordered table-dark">
<thead>
      <tr>
       <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;"></th>
        <th colspan="2" style="vertical-align:top; border:1px solid black; background: lightblue;">Team Names</th>
      </tr>
</thead>
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
        $stmt->data_seek(0);
        $row_number = 0;

        while( $stmt->fetch() )
        {
          // construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns
        //  $player = new Address([$Name_First, $Name_Last], $Street, $City, $State, $Country, $ZipCode);
       //   $stat   = new PlayerStatistic([$Name_First, $Name_Last], [$PlayingTimeMin, $PlayingTimeSec], $Points, $Assists, $Rebounds);
		  
          echo "      </tr>\n";
          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          echo "      <tr>\n";
				while ($row = $resulttwo->fetch_assoc())
			{
				echo "<tr><td  $fmt_style>".++$row_number."</td>";
				echo "<td  $fmt_style>".($row['TeamName'])."</td></tr>";
			
			}
          echo "      </tr>\n";
        }
      ?>
</table>


    <h2 style="text-align:center">TeamA vs. TeamB Game Stats</h2>
    <table class="table table-striped table-dark">
    <thead>
      <tr>
    <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;"> Game Round </th>
		<th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Team Name</th>
		<th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">  Points  </th>
      </tr>
      </thead>
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
	  
		  if(($result3 = $link->query($query3)) && ($result4 = $link->query($query4))  ){
		   if(($result3->num_rows > 0) && ($result4->num_rows > 0) ){
          
				while (($row = $result3->fetch_array()) && ($row2 = $result4->fetch_array()) )
			    {
				echo "      <tr>\n";
			
				echo "<td  $fmt_style>". $row['GameRound'] . "</td>\n";
				echo "<td  $fmt_style>". $row['TeamName'] ."---".$row2['TeamName']. "</td>\n";
				echo "<td  $fmt_style>". $row['TeamAPoints'] ."---".$row2['TeamBPoints']. "</td>\n";
				
				
				echo "      </tr>\n";
				}
			}
		  $result3->free();
		   }
		   else
		   {
        echo "No records matching your query were found.";
          }
	   
	   
	   
    
      ?>
</table>

    <?php
      ////////////////////////////////////////////////////////////////////////////////////////
	  
    ?>
    <h2 style="text-align:center">Player Statistics</h2>

    <?php
      // emit the number of rows (records) in the table
      echo "Number of Records:  ".$stmt->num_rows."<br/>";
    ?>

<table class="table table-bordered table-dark">
  <thead>
      <tr>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;"></th>
        <th colspan="2" style="vertical-align:top; border:1px solid black; background: lightblue;">Player</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;"></th>
        <th colspan="4" style="vertical-align:top; border:1px solid black; background: lightblue;">Statistic Averages</th>
      </tr>
      </thead>
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;"></th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Address</th>

        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Games Played</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Time on Court</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Points Scored</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Number of Assists</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Number of Rebounds</th>
      </tr>
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
        $stmt->data_seek(0);
        $row_number = 0;

        // for each row (record) of data retrieved from the database emit the html to populate a row in the table
        // for example:
        //  <tr>
        //    <td  style="vertical-align:top; border:1px solid black;">1</td>
        //    <td  style="vertical-align:top; border:1px solid black;">Dog, Pluto</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1313 S. Harbor Blvd.<br/>Anaheim, CA 92808-3232<br/>USA</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1</td>
        //    <td  style="vertical-align:top; border:1px solid black;">10:0</td>
        //    <td  style="vertical-align:top; border:1px solid black;">18</td>
        //    <td  style="vertical-align:top; border:1px solid black;">2</td>
        //    <td  style="vertical-align:top; border:1px solid black;">4</td>
        //  </tr>
        // or if there exists no statistical data for the player
        //  <tr>
        //    <td  style="vertical-align:top; border:1px solid black;">2</td>
        //    <td  style="vertical-align:top; border:1px solid black;">Duck, Daisy</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1180 Seven Seas Dr.<br/>Lake Buena Vista, FL 32830<br/>USA</td>
        //    <td  style="vertical-align:top; border:1px solid black;">0</td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //  </tr>
        //
        while( $stmt->fetch() )
        {
          // construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns
          $player = new Address([$Name_First, $Name_Last], $Street, $City, $State, $Country, $ZipCode);
          $stat   = new PlayerStatistic([$Name_First, $Name_Last], [$PlayingTimeMin, $PlayingTimeSec], $Points, $Assists, $Rebounds);

          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          echo "      <tr>\n";
          echo "        <td  $fmt_style>".++$row_number."</td>\n";
          echo "        <td  $fmt_style>".$player->name()."</td>\n";
          echo "        <td  $fmt_style>".$player->street()."<br/>"
                                         .$player->city().', '.$player->state().' '.$player->zip().'<br/>'
                                         .$player->country()."</td>\n";
          echo "        <td  $fmt_style>".$GamesPlayed."</td>\n";
          if($GamesPlayed >0)
          {
            echo "        <td  $fmt_style>".$stat->playingTime()."</td>\n";
            echo "        <td  $fmt_style>".$stat->pointsScored()."</td>\n";
            echo "        <td  $fmt_style>".$stat->assists()."</td>\n";
            echo "        <td  $fmt_style>".$stat->rebounds()."</td>\n";
          }
          else
          {
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
          }
          echo "      </tr>\n";
        }
      ?>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  </body>
</html>
