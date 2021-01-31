<?php session_start(); error_reporting(E_ALL); ini_set('display_errors','1'); include('mysqli_connect.php'); include('header.php'); ?>
<html>
	<head>
		<link rel="stylesheet" href="css/user-account.css" type="text/css" media="screen"/>
		<script language='javascript'>
			function checkForm(f)
				{
					var a = 10;
					if (f.elements['complaint'].value <= a)
					{
						alert("You are not able to send this message without anything to submit. please write your question on the text field.");
						return false;
					}
					else
					{
						
						f.submit();
						return false;
					}
				}
				
		</script>
		
		<script>
		 function loadThisfunction(){
		  document.formupload.submit();
		 }
		</script>
	</head>	
			
<?php				
					
	$err="";
	$target ="";
	$errtarget = $err;

				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{

				if (empty($_POST["file"]))
					{$errtarget = "Image name is required";}
				}

/* if server request method the script goes here */
if($_SERVER["REQUEST_METHOD"] == "POST"){

/* if file uploader in html form is not empty */
	if(isset($_FILES['file'])) {
	
			/* file name of your image */
			$filename = $_FILES['file']['name'];
			
			/* check if the filename is already exist in folder */
			$exist = file_exists($filename);
			/* check if the filename is already exist in folder */
		
				/* the temp name of the file will be upload somewhere in wamp */
				$tempname = $_FILES['file']['tmp_name'];
				
				/* target is the path where you want to move your images */
				$target = 'photos/'.$_FILES['file']['name'];
				$account = $_SESSION['SESS_EMAIL'];

				/*move uploader file $temname variable is the tempname of the images and move into the $target! */
				move_uploaded_file($tempname , $target);
				echo '<script type="text/javascript"> alert("Successfully change your Profile picture."); document.location= "MyAccount.php";</script>';
				
				/* insert the path of the images in database */
				$sql1=mysqli_query($con,"UPDATE tbl_customer SET photo = '$target' WHERE cus_id = '$account'");

				$sql1="UPDATE tbl_customer (photo)
				VALUE
				('$target')";
			
				/*if (!mysqli_query($con,$sql1))
				{
					echo "HOYyyyy!!! MAY MALI SA SQL MU!!";
					die('Error: ' . mysqli_error($con));
				}*/
				//mysqli_close($con);
				/* End of inserting */
				
	}/* if file uploader in html form is not empty End */ 
	
	/* if thereis error while uploading this error msg will appear */
	else {
		echo "failed to upload";
	}
}/* if server request method the script goes here End */

					
if(isset($_SESSION['SESS_EMAIL'])){					
?>
<div class="content row">
				
<div class="left_wing"  style ="position:fixed; width:234px; margin:auto; border-radius: 5px; height:auto; width:310px; border:2px solid grey;">
				
<?php				
									$account = $_SESSION['SESS_EMAIL'];
									$sql= mysqli_query($con,"SELECT * FROM tbl_customer where cus_id = '$account' LIMIT 1");
									 
									echo "<table class='user-profile'>";
									
									while($row = mysqli_fetch_array( $sql )) {
									
									$image = $row["photo"];		
									$fullname = $row['firstname'].'&nbsp;'.$row['lastname'];
									$email = $row['email'];
									$contact = $row['contactno'];
									$postcode = $row['PostCode'];
									$address = $row['address'];
									$address2 = $row['address2'];
									$state = $row['state'];
									$country = $row['countries'];
									
									echo "<div class='profile-picture'>";
									?>
									<img class="user-img-profile"   src = "<?php echo $image; ?>";   />
									</div>
									<form   name="formupload"  action="<?php echo  $_SERVER['PHP_SELF']; ?>" method="POST" enctype='multipart/form-data'><input class="file" name='file' id = 'file' type='file'   onchange="loadThisfunction()" ></form><br><br>			
<?php
									echo '<td><a href="MyAccountEdit.php?cus_id=' . $row['cus_id'] . '"><span class="edit-profile-img"><input type="image" src="img/pencil-edit.png" title="edit profile" width="25" height="30" /></a></span></td>';
									echo"<div id='div-editable' style='width:310px;border-top: 5px solid rgba(129, 121, 121, 1);'>";
										echo"<tr><td class='profile-editable'>$fullname</td></tr>";
										echo"<tr><td class='edit-profile'>Email<td><span class='span'>:</span><em>$email</em></td></td></tr>";
										echo"<tr><td class='edit-profile'>Contact<td><span class='span'>:</span>$contact</td></td></tr>";
										echo"<tr><td class='edit-profile'>Post-Code<td><span class='span'>:</span>$postcode</td></td></tr>";
										echo"<tr><td class='edit-profile'>Address 1<td><span class='span'>:</span>$address</td></td></tr>";
										echo"<tr><td class='edit-profile'>Address 2<td><span class='span'>:</span>$address2</td></td></tr>";
										echo"<tr><td class='edit-profile'>State<td><span  class='span'>:</span>$state</td></td></tr>";
										echo"<tr><td class='edit-profile'>Country<td><span class='span'>:</span>$country</td></td></tr>";
									echo"</div>";
									} 
									echo "</table>";
echo '</div>';
echo '<div class="right_wing">';		

									$account = $_SESSION['SESS_EMAIL'];
									$account_fname = $_SESSION['SESS_FIRST_NAME'];
									$query = mysqli_query($con,"SELECT * FROM tbl_complaint where cus_id = $account ORDER BY datetime DESC");

										echo "<table class='tbl-comment'>";
										echo "<tr><caption>Feel Free to ASK</caption></tr>";
										echo "<tr><th>Chat Box</th><th>Message US</th></tr>";
										echo"<tr>";
										echo "<td><div style='width:300px; height:300px; overflow-y:scroll;'>";
											
											while($row = mysqli_fetch_array($query)){
											$question 	=	$row['complaint'];
											$csr_msg	=	$row['csr_msg']; 

											echo "<div>";
											if(empty($csr_msg)) {
												//nothing to show
											}
											else{
											echo"<p class='user-msg'>$csr_msg</p></div><br>";
											}//if empty condition									
											echo"<div><p class='csr-msg' >$question</p></div><br>";
											}//While loop
									   echo"</div>
											</td>";
										echo '<td>
														<form  name="form-complaint" method="POST" action="complaint.php"  onSubmit="return checkForm(this);  this.reset(); return false;"> 
															<textarea class="comment-area" id="complaint" name="complaint" onSubmit="reset(this);"></textarea><br>
															<input type="text" name="prod_id" size="25"  placeholder=" Place your product #ID here! ">
															<a href="#" onclick="document.getElementById("fileID").click(); return false;" /> &nbsp; &nbsp;<strong>Attach Photo</strong></a><br><input type="file" name="product-photo" id="fileID" style="visibility: hidden;" />
													</td>
												</tr>
												<tr>
													<td>
															Monique-Design will Send-back  within 24 hours.
													</td>
													<td>
														  <input type="hidden" name="cus_id" value="'.$account.'">
														  <input type="hidden" name="fname" value="'.$account_fname.'">
														  <input name="submit-complaint" class="submit-complaint" type="submit">
														</form>
													</td>
												</tr>
											</table>
										</div>
									</div>';

					}else{echo '<center><br><br><h1><font color="red">Please <a href="login.php">Log-in</a> to view your Account.. </font></h1></center>';}//session mail

					echo '</div>';
			?>
</body>

</html>