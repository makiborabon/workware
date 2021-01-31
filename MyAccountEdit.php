<?php session_start(); ?>
<html>
	<head>
	<title>Monique Designs | My Account</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.lazy.min.js"></script>
	<script type="text/JavaScript" src="js/zoom.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.mouse.js"></script>
	<script src="js/jquery.ui.sortable.js"></script>
	<script src="js/jquery.ui.accordion.js"></script>	
	<link href ="css/style.css" rel="stylesheet" type="text/css"/>

	
	<style>
			body{background: url(img/bg.jpg) repeat top left;}
			table{background:#FFFFFF; padding:20px; border-radius:25px;}
			h1{color:white;}
			input[type="submit"]{background-image: linear-gradient(to bottom, #9B7B15 0%, #CBE955 100%);
			cursor: pointer;
			border: 1px solid #CCC;
			border-radius: 5px;
			padding: 10.2px 16px;}
			table td{padding-left:20px;}
			table,td,th{ border-collapse:collapse;}
			table{position:relative; left:-5%; width:50%;}th{height:50px; }
			.new{position:relative; left:-42%;}
			.account{position:relative; left:-43%;}
			.edit{position:relative; left:30px;}
	</style>
	</head>
	<body>
		
		<div class="main">
			<div class="top_nav row">
				<?php 
				
				if(isset($_SESSION['SESS_password'])){
				?>
				<a href="index.php">HELLO <?php echo $_SESSION['SESS_FIRST_NAME']; ?>! |</a>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay | </a>
				<a class="navig-icon navig-icon-prev right" href="http://http://monique-design.co.uk">MONIQUE SITE | </a>
				<a class="right" href="logout.php">LOG OUT |</a>
				
				<?php } else {?>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay | </a>
				<a href="login.php">LOG IN</a> | <a href="register.php">REGISTER</a>
				
				<a class="navig-icon navig-icon-prev right" href="http://http://monique-design.co.uk">MONIQUE SITE | </a>
				<?php } ?>
			</div>
			
			<header>
			<div class="sub_page">
				<h1>Monique Designs</h1>
				<div class="row"><img class='logo' src="img/logo.png" /></div>

			</div>
			</header>
			<div class="nav">
				<div class="row menu">
					<ul class="ul-menu">
						<li class="inactive"><a href="index.php">Shop Now!</a></li>
						<li class="active" ><a href="MyAccount.php">MY ACCOUNT</a>
						</li>					
					</ul>
				</div>
			</div>
			
			<div class="content row">


<?php


 // Edit Entire record from specific ID..
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($cus_id, $firstname, $lastname, $password, $contactno, $PostCode, $address, $state, $countries, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 <br>
 <div class="edit">
 <form class="input" action="" method="post">
  <center>
 <table>
 <tr><caption><h3><font color="#5A7F8B">EDIT YOUR PROFILE<font></h3></caption></tr><br>
 <input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>"/>
 <tr><td>...</td></tr>
 <tr><td><strong>First Name:</strong></td><td><input type="text" name="firstname" size="40" value="<?php echo $firstname; ?>"/></td></tr>
 <tr><td><strong>Last Name:</strong></td><td><input type="text" name="lastname" size="40" value="<?php echo $lastname; ?>"/></td></tr>
 <tr><td><strong>Old-Password:</strong></td><td><input type="text"  size="40" value="<?php echo $password; ?>"/></td>
 <tr><td><strong>New-Password:</strong></td><td><input type="text" name="password"  size="40"/></td></tr>
 <tr><td><strong>Contact:</strong></td><td><input type="text" name="contactno" size="40" value="<?php echo $contactno; ?>"/></td></tr>
 <tr><td><strong>Post Code:</strong></td><td><input type="text" name="PostCode" size="40" value="<?php echo $PostCode; ?>"/></td></tr>
 <tr><td><strong>Address:</strong></td><td><textarea rows="8" cols="37" type="text" name="address" /><?php echo $address; ?></textarea></td></tr>
 <tr><td><strong>State:</strong></td><td><input type="text" name="state" size="40" value="<?php echo $state; ?>"/></td></tr>
 <tr><td><strong>Country:</strong></td><td><input type="text" name="countries" size="40" value="<?php echo $countries; ?>"/></td></tr>

 <tr><td>&nbsp;</td>&nbsp;<td><input type="submit" class="button"name="submit" value="Submit"></td></tr>

 </table></center>
 </form>
</div> 
 </body>
 </html> 
 <?php
 }



 // connect to the database
include('mysqli_connect.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['cus_id']))
 {
 // get form data, making sure it is valid
	 $cus_id = $_POST['cus_id'];
	 $firstname = mysqli_real_escape_string($con,$_POST['firstname']);
	 $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
	 $password = mysqli_real_escape_string($con,$_POST['password']);
	 $contactno = mysqli_real_escape_string($con,$_POST['contactno']);
	 $PostCode = mysqli_real_escape_string($con,$_POST['PostCode']);
	 $address = mysqli_real_escape_string($con,$_POST['address']);
	 $state = mysqli_real_escape_string($con,$_POST['state']);
	 $countries = mysqli_real_escape_string($con,$_POST['countries']);
 // check that firstname/lastname fields are both filled in
 if ($firstname == '' || $lastname == '' || $password == '' || $contactno == '' || $address == '' || $state == '' || $PostCode== '' || $countries== '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($cus_id, $firstname, $lastname, $password, $contactno,  $PostCode, $address, $state, $countries, $error);
 }
 else
 {
 // save the data to the database
 mysqli_query($con,"UPDATE tbl_customer SET firstname='$firstname', lastname='$lastname', password='$password', contactno='$contactno', address='$address', state='$state' , countries='$countries', PostCode='$PostCode' WHERE cus_id ='$cus_id'")
 or die(mysqli_error()); 

 // once saved, redirect back to the view page
 
echo '<script type="text/javascript"> alert("You have successfully updated your profile info.");</script>';
echo'<script type="text/javascript"> history.go(-2);</script>';
 //header("Location: MyAccount.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['cus_id']) && is_numeric($_GET['cus_id']) && $_GET['cus_id'] > 0)
 {
 // query db
 $cus_id = $_GET['cus_id'];
 $result = mysqli_query($con,"SELECT * FROM tbl_customer WHERE cus_id = $cus_id")
 or die(mysqli_error()); 
 $row = mysqli_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db 
 $cus_id = $row['cus_id'];
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 $password = $row['password'];
 $contactno = $row['contactno'];
 $PostCode = $row['PostCode'];
 $address = $row['address'];
 $state = $row['state'];
 $countries = $row['countries'];
 
 // show form
 renderForm($cus_id, $firstname, $lastname, $password, $contactno, $PostCode, $address, $state, $countries, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>
</body>
</html> 