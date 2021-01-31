<?php 
require_once('mysqli_connect.php');

$email=$_POST['email'];
$email=mysqli_real_escape_string($con, $email);
$status = "OK";
$msg="";
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
// You can supress the error message by un commenting the above line
if (!stristr($email,"@") OR !stristr($email,".")) {
$msg="Your email address is not correct<BR>"; 
$status= "NOTOK";}

echo "<br><br>";
if($status=="OK"){  // validation passed now we will check the tables
$query="SELECT email, cus_id, password FROM tbl_customer WHERE email = '$email'";
$st=mysqli_query($con, $query);
$recs=mysqli_num_rows($st);
$row=mysqli_fetch_object($st);
$em=$row->email;// email is stored to a variable
 if ($recs == 0) { // No records returned, so no email address in our table
// let us show the error message
 echo "<center><font face='Verdana' size='2' color=red><b>No Password</b><br>
 Sorry Your address is not there in our database . You can signup and login to use our site. 
<BR><BR><a href='signup.php'> Sign UP </a> </center>"; 
exit;}

// formating the mail posting
// headers here 
$headers4="borabonmark@gmail.com";  // Change this address within quotes to your address
$headers.="Reply-to: $headers4\n";
$headers .= "From: $headers4\n"; 
$headers .= "Errors-to: $headers4\n"; 
//$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;// for html mail 

// mail funciton will return true if it is successful
 if(mail("$em","Your Request for login details","This is in response to your request for login detailst at
 site_name \n \nLogin ID: $row->cus_id \n 
Password: $row->password \n\n Thank You \n \n siteadmin","$headers"))
{echo "<center><b>THANK YOU</b> <br>Your password is posted to your emil address . 
Please check your mail after some time. </center>";}

else{// there is a system problem in sending mail
 echo " <center>There is some system problem in sending login details to your address. 
Please contact site-admin. <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center>";}
	} 

	else {// Validation failed so show the error message
echo "<center>$msg 
<br><br><input type='button' value='Retry' onClick='history.go(-1)'></center>";}
?>