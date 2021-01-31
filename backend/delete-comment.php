<?php 

require_once('../mysqli_connect.php');
if(isset($_SESSION['SESS_ID'])){
echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security of this <br>System.. </font></h2><br><a href="index.php">Go Back</a> </center>';
}else{


 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];


 // delete the entry
 $result = mysqli_query($con,"DELETE FROM comment WHERE id=$id")
 or die(mysqli_error()); 
 
 // redirect back to the view page
 header("Location: comment-reviews.php");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: comment-reviews.php");
 }
 }// END ISSET 
?>
