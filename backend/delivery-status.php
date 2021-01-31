<?php 

	if(isset($_POST['status'])){
	
		$stat = $_POST['status'];
		$id   = $_POST['id'];
		
		if(!empty($stat)){

		include('mysqli_connect.php');
		
		$sql = "UPDATE transactions SET status = '$stat' WHERE product_id_array = '$id' ";

		if (mysqli_query($con, $sql)) {
			echo '<script>alert(\'Sucessfull\'); window.history.back(-2)</script>';
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}

		mysqli_close($con);
		}else{
			 echo '<script>window.history.back(-2)</script>';
		}
	}
?>