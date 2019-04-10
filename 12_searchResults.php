<?php
  session_start();
?>
<html>
<head>
  <title>Search Results</title>
</head>
<body>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "ConferenceGate";

  // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Get variables from form
    $cfnameraw = $_POST["cfname"];
    $cfcityraw = $_POST["cfcity"];
    $cfid = $_POST["cfid"];
    $cfopen = $_POST["cfopenReg"];
    $cfname = strtolower($cfnameraw);
    $cfcity = strtolower($cfcityraw);
    $cfstartDate = $_POST["cfstartDate"];
    $cfstartDate2 = $_POST["cfstartDate2"];

    // Make clauses to construct SQL
    if($cfid){$cfid_clause = " AND c.conferenceID = ".$cfid." ";}
    if($cfname){$cfname_clause = "AND LOWER(c.name) LIKE '%".$cfname."%' ";}
    if($cfcity){$cfcity_clause = "AND LOWER(l.city) LIKE '%".$cfcity."%' ";}
    if($cfstartDate && $cfstartDate2){$cfdate_clause = "AND LOWER(l.city) LIKE '%".$cfcity."%' ";}

    // Run an sql
    $sql = "SELECT c.conferenceID, c.name as cname, l.name, l.address, l.city, c.discipline, c.startDate, c.endDate
      FROM Conference c, Location l
      WHERE c.locationID = l.locationID ".$cfid_clause.$cfname_clause.$cfcity_clause.$cfdate_clause;
    $result = $conn->query($sql);
  ?>

  <table border="1">
    <tr>
      <th>Conference ID</th>
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
        <td>" . $row["conferenceID"] . "</td>
        <td>" . stripslashes($row["cname"]) . "</td>
        <td>" . $row["name"] . "  </td>
        <td>" . $row["address"] . "</td>
        <td>" . $row["city"] . "</td>
        <td>" . $row["discipline"] . "</td>
        <td>" . $row["startDate"] . "</td>
        <td>" . $row["endDate"] . "</td>
        <td><a href=13_conferenceregistration.php?conferenceID=". $row["conferenceID"] . ">Register</a></td>
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