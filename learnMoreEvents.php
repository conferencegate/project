<?php
  session_start();
?>

<html>
<head>
  <title> Learn More | Conference Gate</title>
</head>
<head>
  <div class="topnav">
  <a class="active" href="1_mainpage.php">Conference Gate</a>
  <a href="aboutUs.html">About</a>

<div class="login-container">
    <form action="/2_userregistration.php">  
      <button type="submit">Create New Account</button>
    </form>
  </div>

  <div class="login-container">
    <form action="/3_login.php">     
      <button type="submit">Login</button>
    </form>
  </div>
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

<?php
  session_start();
?>
<html>

<body>
  <?php
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

    $confID = $_GET["conferenceID"];

    // Run an sql
    $sql = "SELECT c.name as cname, e.title, e.room, e.eventTime, l.name, l.address, l.city
      FROM Conference c, Location l, Event e
      WHERE c.locationID = l.locationID AND c.conferenceID = e.conferenceID AND c.conferenceID =".$confID;
    $result = $conn->query($sql);
  ?>

  <table border="1">
    <tr>
     
      <th>Name of Event(s)</th>
      <th>Room</th>
      <th>Time</th>
      <th>Location</th>
      <th>Address</th>
      <th>City</th>
  
    </tr>

      <?php
      if ($result) {
        while($row = $result->fetch_assoc()) {
        echo 

        "Event(s) at " . $row['cname'] ."
        <tr>
       
        <td>" . stripslashes($row["title"]) . "</td>
        <td>" . $row["room"] . "</td>
        <td>" . $row["eventTime"] . "</td>
        <td>" . $row["address"] . "</td>
        <td>" . $row["city"] . "</td>
        
       
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