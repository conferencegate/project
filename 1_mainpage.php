<?php
	session_start();
?>

<!--TOP NAVIGATION BAR!-->
<html>
<head>
  <title>Home | Conference Gate</title>
</head>
<head>
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
<!--END OF TOP NAVIGATION BAR!-->

	<style>
h1 {text-align:center;}
p {text-align:center;}
</style>

	<br><br><center> 
	<title>Conference Gate</title></h1>
</center> </br></br>
</head>
<body>
	<!-- Welcome to Conference Gate!<br /> -->
	<h1><font size="20"> Welcome to Conference Gate! </font></h1>

	<p><i><font size="2">A hub to explore and register for conferences across disciplines </font></i></p>




	<br><p><font size="6">What would you like to do?</font></p></br>
	<form>
	<!-- <input type="button" value="Create New Account" onclick="window.location.href='2_userregistration.php'" />
	<input type="button" value="Login" onclick="window.location.href='3_login.php'" /> -->
	<p>
	<input type="button" value="Search Conferences" onclick="window.location.href='4_conferencesearch.php'" />
	</p>


	</form>

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

$sql = "SELECT conferenceID, name, discipline FROM `Conference` WHERE (month(startDate) = month(CURRENT_DATE)) ORDER BY `startDate` ASC LIMIT 5";  

?>
<html>
<head>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;

		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			/*transition: all .1s;*/
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 12px;
			min-width: 450px;

		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 3px 20px;
		}
		.data-table caption {
			margin: 10px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #ccc;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			/*text-transform: uppercase;*/
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: center;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: center;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #508abb;
		}
	</style>
</head>
<body>
	
	<table class="data-table">
		<caption class="title"><font size="2.5">Upcoming Conferences this Month</font></caption>
		<thead>
			<tr>
				<th></th>
				<th>Conference Name</th>
				<th>Discipline</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		echo "<table>";
	
	  	while ($row = mysqli_fetch_assoc($result)){

	    echo "<tr><td>" . 
	    "<tr><td>".
	    "<a href=learnMoreEvents.php?conferenceID=". $row["conferenceID"] . ">Show Events</a></td><td>".
	    "<a href='http://localhost/12_searchResults.php?id=".$row["name"]."'>Details</a>"."<td>".  "</td><td>" . 

	    $row['name'] . 
	    "</td><td>" . 

	    $row['discipline'] . 
	    "</td></tr>";
 	}
    echo "</table>";
} else {
	echo "0 results";
}

		?>
		</tbody>
		<tfoot>
			<tr>
			
			</tr>
		</tfoot>
	</table>
</body>

</html>


