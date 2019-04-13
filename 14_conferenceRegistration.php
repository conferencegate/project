<!--TOP NAVIGATION BAR!-->
<html>
<head>
  <title>Registration | Conference Gate</title>
</head>
<head>
	<div class="topnav">
  <a class="active" href="1_mainpage.php">Conference Gate</a>
  <a href="aboutUs.php">About</a>
 
  <?php 
  	// Check if user is logged in.
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

<?php
	session_start();

	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "conferencegate";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$userID = $_SESSION["userID"];
	$conferenceID = $_SESSION["confID"];

	// Check to make sure there isn't a duplicate registration.
	$sql = "SELECT * FROM Registration 
			WHERE userID = ".$userID."
			AND conferenceID = ".$conferenceID;

	$sql2 = "INSERT INTO Registration (userID, conferenceID, registrationDate)
 	VALUES (".$userID.",".$conferenceID.",CURRENT_TIMESTAMP())";

 	$sql3 = "SELECT name, startDate FROM Conference WHERE conferenceID = ".$conferenceID;

 	$sql4 = "
 	UPDATE
  		Conference AS c
  		INNER JOIN (SELECT conferenceID, COUNT(*) AS cnt
    		FROM Registration AS r
    		WHERE conferenceID = ".$conferenceID."
			) AS A
    	ON c.conferenceID = A.conferenceID
	SET c.attendeeCount = A.cnt";

	$sql5 = "SELECT c.attendeeCount, l.capacity FROM Conference c, Location l WHERE c.locationID = l.locationID AND c.conferenceID = ".$conferenceID;
	$result5 = $conn->query($sql5);
	$full = mysqli_fetch_row($result5);
	$is_full = ($full[0] >= $full[1]);

	if($is_full == TRUE) {
		print_r("We're sorry, this conference is full.");
		header( "refresh:4;url=1_mainpage.php" );
		exit();
	}

  	$result = $conn->query($sql);
  	$num = mysqli_num_rows($result);
  	if($num == 0) { 
		$result2 = $conn->query($sql2);
  		$result3 = $conn->query($sql3);
  		$num2 = mysqli_num_rows($result3);
  	}
  	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if ($num2 > 0) {
        $row = mysqli_fetch_row($result3);
        	$cname = $row[0];
        	$cstart = $row[1];
        }

 	// Redirect if already registered.
 	if($num > 0) {
 		print_r("You're already registered for this conference.");
 		unset($_SESSION['confID']);
 		header("refresh:3; url=1_mainpage.php");
    exit();
    }
 	else {
 		print_r("You're now registered for ".$cname.", starting on ".$cstart.". Pack your bags!");
 		$conn->query($sql4);
 		unset($_SESSION['confID']);
 		header("refresh:5; url=8_youraccount.php");
 		exit();
 	}
?>