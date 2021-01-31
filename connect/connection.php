<?php
	//database parameters
	$hostname = 'localhost';
	$username = 'root';
	$password = 'password';
	$database = 'backup';
	
	//host connection
	$connect = mysql_connect($hostname, $username, $password) or die(mysql_error().'<span style = "color:red; font-weight:bold;font-size:36px;">'."  check your username or password of your database make sure its correct!!!!").'</span>';
	
	//database connection
	mysql_select_db($database) or die ('<span style = "color:red; font-weight:bold;font-size:36px;">'."Unable to Connect to the Database CREATE A DATABASE NAMED.....".'</span>'.'<br />'.'<span style = "color:orange; font-weight:bold;font-size:36px;">'.$database.'</span>');
?>