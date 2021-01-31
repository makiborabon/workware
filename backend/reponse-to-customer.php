<?php 

require_once('../mysqli_connect.php');
if(isset($_SESSION['SESS_ID'])){
echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security of this <br>System.. </font></h2><br><a href="index.php">Go Back</a> </center>';
}else{
?>
<html>
	<head>
	<title>back end | complaint-details</title>

<style>
.wrapper{background:#FFFFFFF;}
table{position:relative;}
.csr-msg{float:right; margin:20px;}
.user-msg{float:left; margin:20px;}
.user-msg:after, .user-msg:before
{
    content: ' ';
    position: absolute;
    top: 100%;
    border-style: solid;
    width: 0;
    height: 0;
}

.user-msg:before
{
	border-color: #CFE3FE transparent transparent transparent;
    border-width: 15px 13px 0 7px;
    left: 10px;
}

.user-msg:after
{
	border-color: #CFE3FE transparent transparent transparent;
    border-width: 12px 11px 0 4px;
    left: 14px;
}

.user-msg
{
position: relative;
border: 1px solid #CFE3FE;
background-color: #CFE3FE;
padding: 15px;
text-align: center;
border-radius: 10px;
width:650px;
}				
				
			
.csr-msg:after, .csr-msg:before
{
    content: ' ';
    position: absolute;
    top: 100%;
    border-style: solid;
    width: 0;
    height: 0;
}

.csr-msg:before {
border-color:#CFE3FE transparent transparent transparent;
border-width: 18px 5px 0 16px;
right: 8px;
}

.csr-msg:after {
border-color: #FFF transparent transparent transparent;
border-width: 13px 6px 0 12px;
right: 10px;}

.csr-msg
{
position: relative;
border: 1px solid #CFE3FE;
background-color: #FFFFFF;
padding: 15px;
text-align: center;
border-radius: 10px;
width:650px;
}
.response{position:relative; top:50px; padding-bottom:200px;}
		button, .btn {
			float:right; 
			position:relative; 
			right:200px;
			border: 1px solid #CCC;
			border-radius: 5px;
			cursor: pointer;
			color: #FFF;
			background-image: linear-gradient(to bottom, #BFC3CA 0%, #DAE1EE 100%);
			button, .btn:hover{opacity:0.5;}
</style>
	
	</head>
<body>
<div class="wrapper">
<?php include('header.php');?>
<center>
<div class="center" style=" margin-left:10px;width:980px; height:110%; right:-10px; box-shadow: 0px 1px 1px 0px rgba(40, 37, 41, 1.4);">
<?php


		if(isset($_GET['id'])){
				
			$id = preg_replace('#[^0-9]#i','',$_GET['id']);

			echo "<center><h4>Response</h4></center>";

			$sql = mysqli_query($con,"SELECT * from tbl_complaint  Where cus_id = '$id' ORDER BY datetime ASC");		
			$sql2 = mysqli_fetch_assoc($sql);

			echo"<div class='row' style=' position:relative; top:50px; border:1px solid #CCC; width: 698px;' ><table class='msg-orig' style='width:696px; border:1px solid grey;'> <tr><th>Name</th><th>Message</th><th>Item ID</th><th>Date</th></tr><tr><td>".$sql2['fname']."</td><td>".$sql2['complaint']."</td><td>".$sql2['prod_id']."</td><td>".$sql2['datetime']."</td></tr></table><a  href='##' style=\" color: rgb(188, 189, 196);float:right; right:10px;\">Attached Photos</a></div>";

			$result = mysqli_query($con,"SELECT * from tbl_complaint  Where cus_id = '$id' ORDER BY datetime DESC ");		

			echo "<div class='row' style=' position:relative; top:50px; width:700px; height:200px; border:1px solid #CCC; overflow-y:scroll;'>";

			while($row = mysqli_fetch_array($result))
		  {
						
			$complaint			=	$row['complaint'];
			
			$cus_id				=	$row['cus_id'];
			$datetime			= 	$row['datetime'];
			$csr_msg			=	$row['csr_msg']; 
			$firstname_email	= 	$row['fname'];
			echo "<div>";
			if(empty($csr_msg)) {
				//nothing to show
			}
			else{
			echo"<div><p class='csr-msg' >$csr_msg</p></div><br>";
			
			}//if empty condition									
			echo"<p class='user-msg'>$complaint</p></div><br>";
			}//while
			//}//if result
			echo "</div>";
}
?>
		<div class="row">
				
			<div class="response">
					<form  name="form-response"  method="POST" action="../complaint.php"  onSubmit='return checkForm(this); return false;'>
						<a class='attach-photo' href="#" onclick="document.getElementById('fileID').click(); return false;" />
						<span style=" position:relative; top:30px; left:300px;color:rgb(188, 189, 196);;">Attach Files</span></a><input type="file" name="product-photo" id="fileID" style="visibility: hidden;" />
						<textarea style=" position:relative; left:0px; height: 120px; width: 70%;" id="csr_msg" name="csr-msg" ></textarea>
						<input type="hidden" name="cus-id" value="<?php echo $cus_id; ?>">
						<input type="hidden" name="member" value="<?php echo $_SESSION['SESS_FIRSTNAME']; ?>">
						<button class="btn" name="csr-submit" type="submit" >Response</button>
					</form>
				</table>
			</div>
		</div>

<?php mysqli_close($con); }// END IF ISSET?>		
</div><!--class center--></center>
</div><!--class wrapper-->
</body>
</html>