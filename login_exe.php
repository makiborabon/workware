
<?php
	//Start session
	session_start();
 
	//Include database connection details
	require_once('connect/connection.php');
 
	//Array to store validation errors
	$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
 
	//Sanitize the POST values
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
 
	//Input Validations
	if($email == '') {
		$errmsg_arr[] = 'Account is invalid';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
 
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}
 
	//Create query
	$qry="SELECT * FROM tbl_customer WHERE email ='$email' AND password='$password'";
	$result=mysql_query($qry);
 
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID']		= $member['email'];
			$_SESSION['SESS_EMAIL'] 		= $member['cus_id'];
			$_SESSION['SESS_FIRST_NAME'] 	= $member['firstname'];

			session_write_close();
			//echo print_r($_SESSION);
			echo '<script type="text/javascript"> alert("Thank You Enjoy Shopping"); document.location= "know.php?page=1114";</script>';
			exit();
		}else {
			//Login failed
			$errmsg_arr[] = '<h3 style="color:red;">user account and password not found</h3>';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: login.php");
				//echo print_r($_SESSION);
				exit();
			}
		}
	}else {
		die("Query failed");
	}
?>