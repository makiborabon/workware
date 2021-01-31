<?php  error_reporting(E_ALL); ini_set('display_errors','1'); include('mysqli_connect.php'); //include('header.php'); ?>

		<!--<link rel="stylesheet" href="css/user-account.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="css/user-account.css" type="text/css" media="screen"/>-->
		<script>
			function loadThisfunction(){
			document.formupload.submit();
			}
		
			$.fn.scrollBottom = function() { 
			  return $(document).height() - this.scrollTop() - this.height(); 
			};

			$(window).unbind('scroll');
			$(window).scroll(function() {
				nav = $("#scroll-fixed");
				if((nav.position().top+nav.height()) >= $('#semi-footer').position().top) {  
					realFooterHeight = $('#semi-footer').height()+$('#footer').height();

					nav.css("top","auto");
					nav.css("bottom",realFooterHeight-$(this).scrollBottom());
				}
				else {
					nav.css("bottom",'auto');
				   nav.css("top",Math.max(-186,274-$(this).scrollTop()));
				}
			});
		
		</script>
<style>
#panel{border-color: #2A5F94;}
table{ border:2px solid #2A5F94;}
.edit-profile-img{display:none;}
table:hover .edit-profile-img{display:block; float:right; position:absolute; left:120px; top:120px;}

.tbl-comment{position:relative; left:-130px; }
.tbl-comment caption{border:2px solid #2A5F94; color: #2A5F94; border-radius:5px 5px 0px 0px; background:#FFF;} 
.tbl-comment td{ height:100px; padding:10px;border:1px solid #817979;  border-radius:5px;}
.submit-complaint{background-image: linear-gradient(to bottom, #9B7B15 0%, #CBE955 100%);
cursor: pointer;
border: 1px solid #CCC;
border-radius: 5px;
padding: 27.2px 134px;}
.comment-area{-webkit-box-shadow: inset 0 0px 3px #2A5F94; border: 1px; height:200px; width:310px; position:relative; top: -130px;}
.prod_id{}
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
border-color: #CFE3FE transparent transparent transparent;
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
}
</style>
		

<?php				
if(isset($_SESSION['SESS_EMAIL'])){
					
			$account = $_SESSION['SESS_EMAIL'];
			$account_fname = $_SESSION['SESS_FIRST_NAME'];
			
			
			$sql= mysqli_query($con,"SELECT * FROM tbl_customer where cus_id = '$account' LIMIT 1");

			while($row = mysqli_fetch_array( $sql )) {
			
				$image = $row["photo"];		
				$fullname = $row['firstname'].'&nbsp;'.$row['lastname'];
				$email = $row['email'];
				$contact = $row['contactno'];
				$postcode = $row['PostCode'];
				$address = $row['addries'].'&nbsp; <br>'. $row['state'].'&nbsp; <br>'. $row['countries'];


echo '<div class="row">
      <div class="large-12 columns">
      	<div class="panel" id="panel">
	        <div class="row">
	        	<div class="large-6 medium-6 columns">

						<table id="scroll-fixed" style="width: 300px; float:left; position:fixed;" >
							<tr>
								<td><div><img  src = "'.$image.'" width="100" height="100"/></div></td>
								<td><b>'.$fullname.'</b></td>
							</tr>
							
							<tr><td><a href="user-edit.php?cus_id=' . $row['cus_id'] . '"><span class="edit-profile-img"><input type="image" src="img/pencil-edit.png" title="edit profile" /></a></span></td>
							</tr>
							<tr>
								<td>email :</td><td>'.$email.'</td>
							</tr>
							<tr>
								<td>contact :</td><td>'.$contact.'</td>
							</tr>
							<tr>
								<td>post code :</td><td>'.$postcode.'</td>
							</tr>
							<tr>
								<td>address :</td><td>'.$address.'</td>
							</tr>
							
						</table>
					
					
				</div>';
				}//WHILE

				$query = mysqli_query($con,"SELECT * FROM tbl_complaint where cus_id = $account ORDER BY datetime DESC");
				
				
				echo '<div class="large-6 medium-6 columns">
						 <table class="tbl-comment">
							<tr><caption><h4>Feel Free to ASK</caption></h4></tr>
							<tr><th>Chat Box</th><th>Message US</th>
							<tr>
								<td>
									<div style="width:300px; height:300px; overflow-y:scroll;">';

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
									  
							echo'</div>
							 </td>
							 <td>
									<form  name="form-complaint" method="POST" action="complaint.php"  onSubmit="return checkForm(this);  this.reset(); return false;"> 
										<textarea class="comment-area" id="complaint" name="complaint" onSubmit="reset(this);"></textarea><br>';
								?>	

									<input type="text" maxlength="10" name="prod_id" id="prod_id" placeholder=" Place your product #ID here! " style=" position: relative; top: -155px; left: 37px;"/><span id="status"  style=" position: absolute; top: 90px; left: 160px;"></span>
									<script type="text/javascript">
										document.getElementById("prod_id").onblur = function() {
										var xmlhttp;
										var prod_id=document.getElementById("prod_id");
										if (prod_id.value != "")
										{
										if (window.XMLHttpRequest)
										{
										xmlhttp=new XMLHttpRequest();
										}
										else
										{
										xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
										}
										xmlhttp.onreadystatechange=function()
										{
										if (xmlhttp.readyState==4 && xmlhttp.status==200)
										{
										document.getElementById("status").innerHTML=xmlhttp.responseText;
										}
										};
										xmlhttp.open("GET","ifexistname.php?prod_id="+encodeURIComponent(prod_id.value),true);
										xmlhttp.send();
										}
										};
										</script>
										
								<?php		
								echo '<a class="attach-photo" href="#" onclick="document.getElementById(\'fileID\').click(); return false;" />
	
								<span style=" position:relative; top: -150px; left: 230px; color:rgb(188, 189, 196);">Attach Files</span></a><input type="file" name="file" id="fileID" style="visibility: hidden;" />
							</td>
						 </tr>
						 <tr>
							<td>
									We will Send-back  within 24 hours.
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
			</div>
        </div>
       </div>
    </div>

	<div  id="semi-footer">
	</div>
	<div  id="footer">
	</div>';
	}else{echo '<center><br><br><h1><font color="red">Please <a href="login.php">Log-in</a> to view your Account.. </font></h1></center>';}//session mail
?>

	