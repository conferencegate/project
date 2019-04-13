<?php
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "mysql";
  $dbname = "conferencegate";

// Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 

  // Get variables from form
  $cfnameraw = $_POST["cfname"];
  $cfcityraw = $_POST["cfcity"];
  $cfdiscraw = $_POST["cfdisc"];
  $cfid = $_POST["cfid"];
  $cfopen = $_POST["cfopenReg"];
  $cfname = strtolower($cfnameraw);
  $cfcity = strtolower($cfcityraw);
  $cfdisc = strtolower($cfdiscraw);
  $cfstartDate = $_POST["cfstartDate"];
  $cfstartDate2 = $_POST["cfstartDate2"];

  // Make clauses to construct SQL
  if($cfid){$cfid_clause = " AND c.conferenceID = ".$cfid." ";}
  if($cfname){$cfname_clause = "AND LOWER(c.name) LIKE '%".$cfname."%' ";}
  if($cfcity){$cfcity_clause = "AND LOWER(l.city) LIKE '%".$cfcity."%' ";}
  if($cfdisc){$cfdisc_clause = "AND LOWER(c.discipline) LIKE '%".$cfdisc."%' ";}
  if($cfstartDate && $cfstartDate2){$cfdate_clause = "AND LOWER(l.city) LIKE '%".$cfcity."%' ";}

  // Run an sql
  $sql = "SELECT c.conferenceID, c.name as cname, l.name, l.address, l.city, c.discipline, c.startDate, c.endDate
    FROM Conference c, Location l
    WHERE c.locationID = l.locationID ".$cfid_clause.$cfname_clause.$cfcity_clause.$cfdisc_clause.$cfdate_clause;
  $result = $conn->query($sql);
?>

<html>
<head>
  <title>Search Results | Conference Gate</title>
</head>
  <div class="topnav">
  <a class="active" href="1_mainpage.php">Conference Gate</a>
  <a href="aboutUs.php">About</a>
  <?php   
  // Check if user is logged in and assign logout buttons accordingly
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "<a href='16_logout.php'>Logout</a>";
  echo "<div class='login-container'>
    <form action='/8_youraccount.php'>  
    <button type='submit'>My Account</button>
    </form>
    </div>";
  }
  
  if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
    echo"<div class='login-container'>
        <form action='/2_userregistration.php'>  
          <button type='submit'>Create New Account</button>
        </form>
      </div>

      <div class='login-container'>
        <form action='/3_login.php'>     
          <button type='submit'>Login</button>
        </form>
      </div>";
    }
  ?>
  </div>
</head>

<style type="text/css">
    /* Add a black background color to the top navigation */
.topnav {
  background-color: #318ce7;
  overflow: hidden;
}

/* Style the input container */
.topnav .login-container {
  float: right;
}

/* Style the button inside the input container */
.topnav .login-container button {
  float: right;
  padding: 6px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 14px;
  border: none;
  cursor: pointer;
}

/* Style when you hover on each tab */
.topnav .login-container button:hover {
  background: #ccc;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #ccc;
  color: white;
}
</style>

<html>

<body>
  <table border="1">
    <tr>
     
      <th>Name</th>
      <th>Location</th>
      <th>Address</th>
      <th>City</th>
      <th>Discipline</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Register Now!</th>
    </tr>

      <?php
      if ($result) {
        while($row = $result->fetch_assoc()) {
        echo "<tr>
        
        <td><a href=learnMoreEvents.php?conferenceID=". $row["conferenceID"] . ">Learn More</a></td>
        <td>" . stripslashes($row["cname"]) . "</td>
        <td>" . $row["name"] . "  </td>
        <td>" . $row["address"] . "</td>
        <td>" . $row["city"] . "</td>
        <td>" . $row["discipline"] . "</td>
        <td>" . $row["startDate"] . "</td>
        <td>" . $row["endDate"] . "</td>
        <td><a href=checkOut.php?conferenceID=". $row["conferenceID"] . ">Register</a></td>
        </tr>";
          }
        }

      else {
        echo "0 results.";
      }
      ?>

  </table>

  <?php
  // Close connection
  mysqli_close($conn);
  ?>
</body>
</html>