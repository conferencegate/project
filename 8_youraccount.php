<?php
  session_start();
?>

<!--TOP NAV AREA !-->
<html>
<head>
    <div class="topnav">
  <a class="active" href="1_mainpage.php">Conference Gate</a>
  <a href="aboutUs.php">About</a>
  <a href="16_logout.php">Logout</a>

</div>


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


<div class="main">
  <h1>My Account Information</h1>

</div>

<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "conferencegate";

ini_set('max_execution_time',300);

// Create Connection 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT firstName, lastName, discipline, organization, email FROM Attendee WHERE userID = ".$_SESSION['userID'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table>";
  
    while ($row = mysqli_fetch_assoc($result)){

      echo
      "<tr><td>". 

      "First Name: " .
      $row['firstName'] . 
      "</tr><td>" . 

      "Last Name: " .
      $row['lastName'] . 
      "</tr><td>" . 

      "Discipline: " .
      $row['discipline'] . 
      "</tr><td>" . 

      "Organization: " .
      $row['organization'] . 
      "</tr><td>" .

      "Email: " .
      $row['email'] . 
      "</td></tr>";
   
  }
    echo "</table>";
}

$sql2 = "SELECT c.conferenceID, c.name as cname, c.startDate, c.endDate FROM Conference c, Registration r WHERE c.conferenceID = r.conferenceID AND r.userID = ".$_SESSION['userID'];
$result2 = $conn->query($sql2);

?>
  <br>
  <table border="1">
    <caption><b>Conferences You Are Registered For</b></caption>
    <tr>

      <th>Learn More</th>
      <th>Name</th>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>

      <?php
      if ($result2) {
        while($row2 = $result2->fetch_assoc()) {
        echo "<tr>
        <td><a href=learnMoreEvents.php?conferenceID=". $row2["conferenceID"] . ">Show Events</a></td>
        <td>" . stripslashes($row2["cname"]) . "</td>
        <td>" . $row2["startDate"] . "</td>
        <td>" . $row2["endDate"] . "</td>
        </tr>";
        }
      }

      ?>

  </table>
</head>
</html>