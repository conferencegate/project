<?php
  session_start();
?>
<html>
  <head>
    <title>
      Search for a Conference
    </title>
  </head>
  <body>
    Search by one or more:
    <form name="conferenceSearch" action= "12_searchResults.php" method="POST">
      Conference ID: <input type="text" name="cfid"></br>
      Conference Name:<input type="text" name="cfname"></br>
      City:<input type="text" name="cfcity"></br>
      Start Date Between: <input type="date" name="cfstartDate"> and <input type="date" name="cfstartDate2"></br>
      <input type="checkbox" name="cfopenReg" value="openOnly"> Only Show Conferences with Open Registration<br>
      </select> 
      </br>
      <input type="submit" value="submit">
    </form>
  </body>
</html>