<?php
include('connect/connection.php');

$comment 		 =	$_POST['comment'];
$prod_id 		 =	$_POST['prod_id'];
$member_email 	 =	$_POST['member_email'];
$firstname		 =	$_POST['first_name'];
$datetime=date("y-m-d h:i:s"); //date time

$sql="INSERT INTO comment(comment, firstname, member_email, prod_id, datetime)VALUES('$comment', '$firstname', '$member_email', '$prod_id ', '$datetime')";
$result=mysql_query($sql);

//check if query successful 
if($result){


// link to view guestbook page
echo'<script type="text/javascript">history.go(-1);</script>';
}

else {
echo'<script type="text/javascript">alert("Sorry you are not able to send feedback."); history.go(-1);</script>';
}
mysql_close();
?>