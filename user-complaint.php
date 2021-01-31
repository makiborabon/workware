<?php
			include('connect/connection.php');

	
			
			$member		=	$_POST['member'];
			$csr_msg	=	$_POST['csr-msg'];
			$complaint 	=	$_POST['complaint'];
			$prod_id 	=	$_POST['prod_id'];
			$cus_id 	=	$_POST['cus_id'];
			$fname		=	$_POST['fname'];
			$datetime	=	date("y-m-d h:i:s"); //date time

			$sql="INSERT INTO tbl_complaint(complaint, cus_id, prod_id, fname, member, csr_msg, datetime)VALUES('$complaint', '$cus_id', '$prod_id', '$fname', '$member', '$csr_msg','$datetime')";
			$result=mysql_query($sql);	
			
			
			//check if query successful 
			if($result){
				echo '<script type="text/javascript">alert("Your Message is being sent"); </script>';
				echo'<script type="text/javascript">history.go(-1);</script>';
				}

				else {
				echo '<script type="text/javascript"> alert("Your message cannot be posted right now, please try again later.");</script>';
				echo'<script type="text/javascript">location.replace("MyAccount.php");</script>';
				}

				
				
			mysql_close();
?>