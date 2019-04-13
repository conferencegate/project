<?php
  session_start();
?>

<html>
<head>
  <title>Search Conference | Conference Gate</title>
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

<style>
h1 {text-align:center;}
p {text-align:center;}
</style>

  <body><br>
    Search by one or more: </br>
    <form name="conferenceSearch" action="/12_searchResults.php" method="POST">
      Conference ID: <input type="text" name="cfid"></br>
      Conference Name:<input type="text" name="cfname"></br>
      City:<input type="text" name="cfcity"></br>
      Discipline:<input type="text" name="cfdisc"></br>
      Start Date Between: <input type="date" name="cfstartDate"> and <input type="date" name="cfstartDate2"></br>
      <input type="checkbox" name="cfopenReg" value="openOnly"> Only Show Conferences with Open Registration</br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>