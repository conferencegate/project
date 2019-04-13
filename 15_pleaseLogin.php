<?php
	session_start();
	print_r("Please log in or make an account to register for a conference.\n\nRedirecting...");
	header( "refresh:4;url=1_mainpage.php" );
?>