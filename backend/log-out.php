<?php

	//Start session
	session_start();	
	//Unset the variables stored in session
	session_destroy(); 
	header('location:index.php');
 
?>