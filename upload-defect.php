<?php
include('connect/connection.php');



if(isset($_POST['submit-complaint'])){			


			
				$complaint 	=	$_POST['complaint'];
				$prod_id 	=	$_POST['prod_id'];
				$cus_id 	=	$_POST['cus_id'];
				$fname		=	$_POST['fname'];
				$datetime	=	date("y-m-d h:i:s"); //date time

			$sql="INSERT INTO tbl_complaint(complaint, cus_id, prod_id, fname, datetime)VALUES('$complaint', '$cus_id', '$prod_id', '$fname', '$datetime')";
			$result=mysql_query($sql);	
				
	if(isset($_FILES['file'])) {
			
			/* file name of your image */
			$filename = $_FILES['file']['name'];
			
			/* check if the filename is already exist in folder */
			$exist = file_exists($filename);
			/* check if the filename is already exist in folder */
			if(!$exist){
		
			/* the temp name of the file will be upload somewhere in wamp */
			$tempname = $_FILES['file']['tmp_name'];
			
			/* target is the path where you want to move your images */
			$target = $_FILES['file']['name'];
			/*move uploader file $temname variable is the tempname of the images and move into the $target! */
			move_uploaded_file($tempname , $target);

			/* insert the path of the images in database */
		
			$sql1=mysql_query("UPDATE tbl_customer SET photo = '$target' WHERE cus_id = '$account'");

				$sql1="UPDATE tbl_customer (photo)
				VALUE
				('$target')";
		
		}else{
			echo "file exist";
		}			
		}

			//check if query successful 
			if($result){
			echo '<script type="text/javascript">alert("Your Message is being sent"); </script>';
			echo'<script type="text/javascript">history.go(-1);</script>';
			}else{
			echo '<script type="text/javascript"> alert("Your message cannot be posted right now, please try again later.");</script>';
			echo'<script type="text/javascript">location.replace("MyAccount.php");</script>';
			}
				
				/* End of inserting */

		
		/* if the file name exist the script condition goes here */
		
		}else{

			$member			=	$_POST['member'];
			$cus_id_csr		=	$_POST['cus-id'];
			$csr_msg		=	$_POST['csr-msg'];
			$response_date		=	date("y-m-d h:i:s"); //date time

			$sql = mysql_query("UPDATE tbl_complaint SET member = '$member', csr_msg = '$csr_msg', response_date='$response_date' WHERE cus_id = '$cus_id_csr' ORDER BY datetime DESC LIMIT 1");

			$result = mysql_query($sql);	

			if($result){
			echo '<script type="text/javascript">alert("Your Message is being sent"); </script>';
			echo'<script type="text/javascript">history.go(-1);</script>';
			}else {
			echo '<script type="text/javascript"> alert("Your message cannot be posted right now, please try again later.");</script>';
			echo'<script type="text/javascript">history.go(-1);</script>';
			}

}//else not set		

	/* if thereis error while uploading this error msg will appear */			
			mysql_close();
?>