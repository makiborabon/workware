<?php
###### db ##########
include('mysqli_connect.php');
################


//check we have SKU post var
if(isset($_POST["SKU"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	
	//try connect to db
	$connecDB = $con or die('could not connect to database');
	
	//trim and lowercase SKU
	$SKU =  strtolower(trim($_POST["SKU"])); 
	
	//sanitize SKU
	$SKU = filter_var($SKU, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check SKU in db
	$results = mysqli_query($connecDB,"SELECT prod_id FROM tbl_product  WHERE SKU='$SKU'");
	
	//return total count
	$SKU_exist = mysqli_num_rows($results); //total records
	
	//if value is more than 0, SKU is not available
	if($SKU_exist) {
		die('taken <img src="img/not-available.png" />');
	}else{
		die('available <img src="img/available.png" />');
	}
	
	//close db connection
	mysqli_close($connecDB);
}
?>

