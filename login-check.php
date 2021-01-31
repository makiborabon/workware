
<?php
	session_start();
	require_once('mysqli_connect.php');

// Define $email and $password 
$email=$_POST['email']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysqli_real_escape_string($con,$email);
$password = mysqli_real_escape_string($con,$email);
$sql="SELECT * FROM tbl_customer WHERE email='$email' and password='$password'";
$result=mysqli_query($con,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $email and $password, table row must be 1 row
if($count==1){

// Register $email, $password and redirect to file "login_success.php"
session_register("email");
session_register("password"); 
echo '<script type="text/javascript"> alert("Thank You Enjoy Shopping"); document.location= "know.php?page=1114";</script>';
exit();
}
else {
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
ob_end_flush();
?>