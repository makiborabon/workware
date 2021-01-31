<?php 

include("mysqli_connect.php");

if(isset($_SESSION['SESS_ID'])){
echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security of this <br>System.. </font></h2><br><a href="index.php">Go Back</a> </center>';
}else{

?>
<html>
    <TITLE> Inventory / add product</TITLE>
	<head>
	<link rel="designssheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
	<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
	<script type="text/javascript">window.onload = function(){new JsDatePick({useMode:2,target:"inputField",dateFormat:"%d-%M-%Y"});};</script>
	
		<style>
			#tbl-colour{position:absolute; left:320px; top:960px; } 
			#tbl-size{position:absolute; left:560px; top:960px;}
			#tbl-designs{position:absolute; left:803px; top:960px;}
			#tbl-listed{position:absolute; left:1045px; top:960px;}
		
		</style>
	
	</HEAD>
<BODY>
<?php include('header.php');?>
<?php

 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_product WHERE prod_id = '$id' ";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
	$id 				 = $row["prod_id"];
	//$image			 = $row["photo"];
	$prod_name3			 = $row["prod_name"];
	$sizes3 			 = $row["sizes"];
	$colour3			 = $row["colour"];
	$designs3	 			 = $row["designs"];
	$original_quantity3	 = $row["quantity"];
	$listed_quantity3	 = $row["listed_quantity"];
	$quality3			 = $row["quality"];
	$SKU3			 	 = $row["SKU"];
	$description3		 = $row["description"];
	//$links3			 = $row["links"];
	$date3			 	 = $row["datetime"];
 
 // show form

 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }//end of isset


//INSERTING VALUES TO TABLE SQL

$err = "<font color='red'> failed to upload</font>";
	
if($_SERVER["REQUEST_METHOD"] == "POST"){

				/* the temp name of the file will be upload somewhere in wamp */
				$id 				 = $row["prod_id"];
				$prod_name  		 = $_POST['prod_name'];
				$org_quantity 		 = $_POST['org_quantity'];
				$SKU 				 = $_POST['SKU'];
				$quality 			 = $_POST['quality'];
				$description	 	 = $_POST['description'];
				//$ebay 				 = $_POST['ebay'];
				
				$size 	  			 = $_POST['size'];
				$colour 			 = $_POST['colour'];
				$designs	   			 = $_POST['designs'];
				$listed_quantity 	 = $_POST['listed_quantity'];
				
				$size2 				 = implode(',',$size);
				$colour2 			 = implode(',',$colour);
				$designs2 			 = implode(',',$designs);
				$listed_quantity2  	 = implode(',',$listed_quantity);
				$date 				 = $_POST['datetime'];
				$notes				 = $_POST['notes'];

				/*move uploader file $temname variable is the tempname of the images and move into the $target! */
				
				
				/* insert the path of the images in database */
				
				 $sql = mysqli_query($con,"UPDATE tbl_product SET  prod_name='$prod_name', sizes='$size2', colour='$colour2', designs='$designs2', quantity='$org_quantity', listed_quantity='$listed_quantity2', quality='$quality', SKU='$SKU', description ='$description', datetime ='$date', notes ='$notes' WHERE prod_id='$id'")
				or die('Error: '.$sql . mysqli_error($con));
				

				
				
				echo '<script type="text/javascript"> alert("Successfully Updated."); history.go(-2);</script>';
		

	}/* if file uploader in html form is not empty End */ 
	
	

?>
</HEAD>
<BODY>
	<form method="POST" action="" enctype='multipart/form-data'>

	<center>
		<table width=670px" >
			<input type="submit" class="button" name="submit" value="Submit">
			<!--<tr><td><input class="file"  name='file' id = 'file' type='file' required></td><tr>-->
			 <tr><td><strong>Prod_Name :</strong></td><td><input type="text" name="prod_name" value="<?php echo $prod_name3; ?>" placeholder="Product Name" required/></td></tr>
			 <tr><td><strong>Orig_Quantity :</strong></td><td><input type="text" name="org_quantity" value="<?php echo $original_quantity3; ?>" placeholder="Original Quantity" required/></td></tr>
			 <tr><td><strong>SKU :</strong></td><td><input type="text" name="SKU" value="<?php echo $SKU3; ?>" placeholder="SKU" required/></td></tr>
			 <tr><td><strong>Quality :</strong></td><td><input type="text" name="quality" value="<?php echo $quality3; ?>" placeholder="Quality   / Example: brand new" required/></td></tr>
			 <tr><td><strong>Description :</strong></td><td><input type="text" name="description" value="<?php echo $description3; ?>" placeholder="Description" required/></td></tr>
			 <!--<tr><td><strong><font color='red'>e</font><font color='0063D1'>b</font><font color='F4AE01'>a</font><font color='86B818'>y</font> Links</strong></td><td><input type="text" name="ebay" value="" placeholder="Links"/></td></tr>-->
			 <tr><td><strong>Date :</strong></td><td><input designs="width:110px;" type="text"  value="<?php echo $date3; ?>" name="datetime" id="inputField" placeholder="Date" /></td></tr>
			<tr><td><strong>Notes :</strong></td><td><input type="text" name="notes" placeholder="Add return notes" /></td></tr>
</table>
<?php
		$temp = explode(',',$colour3);
		$temp2 = explode(',',$sizes3);
		$temp3 = explode(',',$designs3);
		$temp4 = explode(',',$listed_quantity3);
				
				echo '<table id="tbl-colour" >';
				echo '<tr><th>Colour &rarr;</th></tr>';
				echo'<td>';
					foreach($temp as $colors){
							echo'<tr><td><input type="text" value = "'.trim($colors).'" name="colour[]" placeholder="colour"></td></tr>';
					}//foreach temp
				echo '</td>';
				echo'</table>';

				echo '<table id="tbl-size">';
				echo '<tr><th>Size &rarr;</th></tr>';
				
				echo'<td>';
					foreach($temp2 as $size){
							echo'<tr><td><input type="text" value = "'.trim($size).'" name="size[]" placeholder="Size"></td></tr>';
					}//foreach temp
				echo '</td>';
				echo'</table>';
				
				
				echo '<table id="tbl-designs">';
				echo '<tr><th>designs &rarr;</th></tr>';
				
				echo'<td>';
					foreach($temp3 as $designss){			
							echo'<tr><td><input type="text" value = "'.trim($designss).'" name="designs[]" placeholder="designs"></td></tr>';
					}//foreach temp
				echo '</td>';
				echo'</table>';
				
				
				echo '<table id="tbl-listed">';
				echo '<tr><th>Listed Quantity</th></tr>';
				
				echo'<td>';
					foreach($temp4 as $listed){
							echo'<tr><td><input type="text" value = "'.trim($listed).'" name="listed_quantity[]" placeholder="Listed Quantity"></td></tr>';
					}//foreach temp
				echo '</td>';
				echo'</table>'; 
?>


	</center>
	<form>
</BODY>
</HTML>

<?php } //isset?>