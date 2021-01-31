<?php
//remove Data

 // connect to the database
 include('mysqli_connect.php');
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $prod_id = $_GET['id'];


 // delete the entry
 $result = mysqli_query($con,"DELETE FROM tbl_product WHERE prod_id = $prod_id") or die("Notice: file deleting  ERRROR."); 
 
 // redirect back to the view page
 header("Location: product-record.php");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: product-record.php");
 }
 
?>
