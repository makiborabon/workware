<?php
include('connect/connection.php');


			$questions 	=	$_POST['questions'];
			$cus_id 	=	$_POST['cus_id'];
			$datetime	=	date("y-m-d h:i:s"); //date time

			$sql="INSERT INTO tbl_questions(questions, cus_id, datetime)VALUES('$questions', '$cus_id', '$datetime')";
			$result=mysql_query($sql);
			
			//check if query successful 
			if($result){
			echo '<script type="text/javascript"> alert("Your Message is being sent");</script>';
			echo'<script type="text/javascript">history.go(-1);</script>';
			}

			else {
			echo '<script type="text/javascript"> alert("Your message cannot be posted right now, please try again later.");</script>';
			echo'<script type="text/javascript">location.replace("MyAccount.php");</script>';
			}
			
			mysql_close();
			
?>