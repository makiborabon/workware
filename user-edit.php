<!doctype html>
<?php error_reporting(E_ALL); session_start(); include('mysqli_connect.php');?>
<html class="no-js" lang="en">
  <head>

		<!----FOUNDATION ZURB----->
		<meta name="description" content="Wellington,Rainwear,Fancy Dress,Travel and Tours ">
		<meta name="keywords" content="Wellington,Rainwear,Fancy Dress,Travel and Tours">
		<meta name="author" content="markii borabon">
		<meta charset="UTF-8">
		
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>HWW | Welcome</title>
		<link rel="stylesheet" href="css/foundation.css" />
		<script src="js/vendor/modernizr.js"></script>
		<!----FOUNDATION ZURB----->
	
		<!----CATEGORY MENUS----->
        <link rel="stylesheet" href="css/style2.css" type="text/css" media="screen"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/Aller.font.js" type="text/javascript"></script>
		<script src="js/jquery.catslider.js"></script>
		<script type="text/javascript">
			Cufon.replace('ul.oe_menu div a',{hover: true});
			Cufon.replace('h1,h2,.oe_heading');
		</script>

		<script>
			$(function() {

				$( '#mi-slider' ).catslider();

			});
		</script>
        <script type="text/javascript">
            $(function() {
				var $oe_menu		= $('#oe_menu');
				var $oe_menu_items	= $oe_menu.children('li');
				var $oe_overlay		= $('#oe_overlay');

                $oe_menu_items.bind('mouseenter',function(){
					var $this = $(this);
					$this.addClass('slided selected');
					$this.children('div').css('z-index','9999').stop(true,true).slideDown(200,function(){
						$oe_menu_items.not('.slided').children('div').hide();
						$this.removeClass('slided');
					});
				}).bind('mouseleave',function(){
					var $this = $(this);
					$this.removeClass('selected').children('div').css('z-index','1');
				});

				$oe_menu.bind('mouseenter',function(){
					var $this = $(this);
					$oe_overlay.stop(true,true).fadeTo(200, 0.6);
					$this.addClass('hovered');
				}).bind('mouseleave',function(){
					var $this = $(this);
					$this.removeClass('hovered');
					$oe_overlay.stop(true,true).fadeTo(200, 0);
					$oe_menu_items.children('div').hide();
				})
            });
        </script>
		
		
		<!----END CATEGORY MENUS----->
	


<script>

//Alert message once script- By JavaScript Kit
//Credit notice must stay intact for use
//Visit http://javascriptkit.com for this script

//specify message to alert
var alertmessage="WELCOME TO MONIQUE DESIGN OFFICIAL WEBSITE!"

///No editing required beyond here/////

//Alert only once per browser session (0=no, 1=yes)
var once_per_session=1

function get_cookie(Name) {
  var search = Name + "="
  var returnvalue = "";
  if (document.cookie.length > 0) {
    offset = document.cookie.indexOf(search)
    if (offset != -1) { // if cookie exists
      offset += search.length
      // set index of beginning of value
      end = document.cookie.indexOf(";", offset);
      // set index of end of cookie value
      if (end == -1)
         end = document.cookie.length;
      returnvalue=unescape(document.cookie.substring(offset, end))
      }
   }
  return returnvalue;
}

function alertornot(){
if (get_cookie('alerted')==''){
loadalert()
document.cookie="alerted=yes"
}
}

function loadalert(){
alert(alertmessage)
}

if (once_per_session==0)
loadalert()
else
alertornot()

</script>		


	<style>
			a {color:#5A7F8B;}
			a:hover {opacity:0.5;}
			body{background: url(img/bg.jpg) repeat top left;}
			.img-search{position: relative; top: -2px; height: 43px; border: 1px solid #CCC; padding-right: 250px; border-radius: 5px;}
			form{position:relative; top:20px; height:42px; border-radius:5px; border: 1px solid #CCC; padding-top: 1px}
			input.search-field{border:none; height:41px; width:250px;  position:relative; top:-44px; left:37px;}
			.btn0 {
			position: relative;
			top: -103px;
			left: 264px;
			border: 1px solid #CCC;
			border-radius: 5px;
			padding: 13px 16px;
			cursor: pointer;
			color: #FFF;
			background-image: linear-gradient(to bottom, #2A5F94  0%, #2A5F94 100%);
			.panel{position: relative;top:5px;}
	</style>
</head>
<body onload="myFunction()">
 
    <div class="row">
	<!---<span class="row" style="background:#C0CEE4; width:125%; height:15px; position:absolute; top:-10px; left:-20%;">.</span>   -->
      <div class="large-12 columns">
      	
		<div class="panel">
			
			<div class="row">
			
			<span style="position:relative; left:12px; top: -33px; font-weight:700; font-size:10px;"><a title="Whole Sale" href="list_product.php?page=1982">Wholesale | </a><a  title="Quick Shipping" href="list_product.php?page=1981">New Arrivals | </a><a title="Customer Service" href="construction.php">Customer Service | </a> <a title="Payment Method" href="construction.php">Payment Method | </a><a  title="About Us" href="know.php?page=1111">About Us |&nbsp;</a><font color="515568"> Hello! </font><?php if(isset($_SESSION['SESS_EMAIL'])){ ?><?php echo '<span style="color:#0078A0; font-size:8pt;">'. $_SESSION['SESS_FIRST_NAME'] . ' </span> || <a href="logout.php">Log-out</a>'; }else{ ?> <a href="login.php"><span style="color:#0078A0; font-weight:bold;"><font color="#515568">Sign-in</font></span></a> <font color="#515568">|| Gain Discount! </font><a href="register.php"> <span style="color:#0078A0; font-weight:bold;">Register!</span></a><?php }?> </span>
				<div class="large-4 medium-4 columns">
	        		<img class="logo" src="img/logo.png"/>
				</div>
	        	<div class="large-4 medium-4 columns">
					<form><img class="img-search" src="img/search.png"/><input class="search-field" type="text" col="40" placeholder="Search product here!"/><button class="btn0">Search</button></form>
				</div>
	        	
	        	<div class="large-4 medium-4 columns">
	        		<div class="wish-account-cart" style="position:relative; left:100px; top:27px;"><a href="know.php?page=1114"><img  title="My Wishlist" src="img/wishlist.png" width="60" height="30" /></a>&nbsp; <a href="know.php?page=1114"> &nbsp; <img title="My Account" class ="man" src="img/head.png" width="30" height="30" /></a><a href="cart.php"> &nbsp; &nbsp; <img title="My Cart" src="img/bag.png" width="30" height="30" /></a></div>
				</div>        
			</div>
			
			<div class="row">
				<div class="bg">	
					<a class ="home" href="index.php"><img src="img/home.png" width="30" height="35" /></a>
					<div class="oe_wrapper">
								<div id="oe_overlay" class="oe_overlay"></div>
								<ul id="oe_menu" class="oe_menu">
									<li><a href="list_product.php?page=1998">Wellington</a>
										<div style="left:1px;">
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1992">Designer Wellies</a></li>										
											</ul>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1995">Lady's Wellies</a></li>
											</ul>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1993">Kid's Wellies</a></li>
											</ul>
											<br><br><br>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1991">Men's Wellies</a></li>
											</ul>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1994">Camouflage Wellies</a></li>
											</ul>
											
										</div>
									</li>
									<li><a href="list_product.php?page=1996">Waterproof</a>
										<div style="left:-78px;">
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1986">Men</a></li>
											</ul>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1985">Ladies</a></li>
											</ul>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1984">Kids</a></li>
											</ul>
											
										</div>
									</li>
								<li><a href="list_product.php?page=1975">Workware</a>
										<div style="left:-157px;">
											
											
										</div>
									</li>
									<li><a href="list_product.php?page=1997">Hi-vis</a>
										<div style="left:-236px;">
											
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1989">Men</a></li>
											</ul>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1988">Ladies</a></li>
											</ul>
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1987">Kids</a></li>
											</ul>
										</div>
									</li>
									<li><a href="list_product.php?page=1990">Tool&nbsp;Bags</a>
										<div style="left:-236px;">
											
											<ul>
												<li class="oe_heading"><a href="list_product.php?page=1990">Bags</a></li>
											</ul>
										</div>
									</li>
									<li><a href="list_product.php?page=1999">ALL</a>
										<div style="left:-236px;">
											
											<ul>
												<!--<li class="oe_heading"><a href="list_product.php?page=1919">Wedding & Parties</a></li>-->
											</ul>
										</div>
									</li>

									
								</ul>	
					</div><!-- category wrapper -->
					</div><!-- category bg -->
			</div><!---- END OF CATEGORY---->
			
<?php
if(isset($_SESSION['SESS_EMAIL'])){


			//$account = $_SESSION['SESS_EMAIL'];
			//$account_fname = $_SESSION['SESS_FIRST_NAME'];
			

 if (isset($_GET['cus_id']) && is_numeric($_GET['cus_id']) && $_GET['cus_id'] > 0)
 {
 // query db
$cus_id = $_GET['cus_id'];
$sql = "SELECT * FROM tbl_customer WHERE cus_id = '$cus_id' ";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
	$cus_id				 = $row["cus_id"];
	$image				 = $row["photo"];
	$fname				 = $row["firstname"];
	$lname				 = $row["lastname"];
	//$password			 = $row["password"];
	$postcode			 = $row["PostCode"];
	$address			 = $row["address"];
	$state				 = $row["state"];
	$country			 = $row["countries"];
	




//INSERTING VALUES TO TABLE SQL

//$err = "<font color='red'> failed to upload</font>";


echo '				
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <div class="row">
	        	<div class="large-4 medium-4 columns">
	    		<p></p>
	    	</div>
	        	<div class="large-4 medium-4 columns">
					<table style="position: relative; left: -90px;">
						<form method="POST" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data">	
								<input type="hidden" name="cus_id" value="'.$cus_id.'">
							<tr>
								<caption><font  color="red">Edit Profile</font></caption>
							</tr>
							<tr>
								<td><div><img  src = "'.$image.'" width="100" height="100"/></td>
								<td>
										<a class="attach-photo" href="#" onclick="document.getElementById(\'fileID\').click(); return false;" />
										<span><b>UPLOAD PHOTO</b></span></a><input type="file" name="file" id="fileID" style="visibility: hidden;" />
									<?php
						</td>
							</tr>
							<tr>
								<td>First&nbsp;Name</td>
								<td><input type="text" name="fname" value="'.$fname.'"></td>
							</tr>
							<tr>
								<td>Last&nbsp;Name</td>
								<td><input type="text" name="lname" value="'.$lname.'"></td>
							</tr>
							<tr> 
								<td>Type&nbsp;Current&nbsp;Password</td>
								<td><input type="password" maxlength="10" name="password" id="password" /><span id="status"></td>
							</tr>
							<tr>
								<td>New&nbsp;Password</td>
								<td><input type="text"></td>
							</tr>
							<tr>
								<td>Postcode</td>
								<td><input type="text" name="postcode" value="'.$postcode.'"></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><input type="text" name="address" value="'.$address.'"></td>
							</tr>
							<tr>
								<td>state</td>
								<td><input type="text" name="state" value="'.$state.'"></td>
							</tr>
							<tr>
								<td>Country</td>
								<td><input type="text" name="country" value="'.$country.'"></td>
							</tr>
							<tr>
								<td></td>
								<td><button value="submit">Update</button></td>
							</tr>
						</form>
					</table>
	        	</div>
	        	<div class="large-4 medium-4 columns">
	        		<p></p>
	        	</div>        
					</div>
      	</div>
      </div>
    </div>
';//END OF ECHO

 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }//end of isset

 				
		
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
				$sql1=mysqli_query($con,"UPDATE tbl_customer SET photo = '$target' WHERE cus_id = '$account'");

				$sql1="UPDATE tbl_customer (photo)
				VALUE
				('$target')";
				
	}/* if file uploader in html form is not empty End */
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
		
				$id 		= $_SESSION['SESS_EMAIL'];
				$fname2 	= $_POST["fname"];
				$lname2 	= $_POST["lname"];
				$postcode2 	= $_POST["postcode"];
				$address2	= $_POST['address'];
				$state2 	= $_POST["state"];
				$country2 	= $_POST["country"];
				
				$result = mysqli_query($con,"UPDATE tbl_customer SET photo = '$target', firstname='$fname2', lastname='$lname2', address='$address2', PostCode='$postcode2', state='$state2', countries='$country2'  WHERE cus_id = '$id' ")
				or die('Error: ' . mysqli_error($con));
				
				
				if($result){
				
				echo '<script type="text/javascript"> alert("Successfully Updated."); history.go(-2);</script>';
				}else{
				echo '<script type="text/javascript"> alert("Failed!"); history.go(-1);</script>';
				
				}
		

	
	/* if thereis error while uploading this error msg will appear */

}/* if server request method the script goes here End */			



}else{
echo '<center><h3><font color="red">Sorry you are not allowed <br>to do this action <br> please </font></h3><br><a href="login.php">Log in</a> </center>';
}
?>
	
	
	</div><!--MAin PANeL--->
		  <style> .row .large-4 medium-4 columns{margin:200px;} p strong {color:#3775B7;} .row{position: relative; top: 20px;}</style>
	   <div class="row" id="semi-footer">
	        	<div class="large-4 medium-4 columns">
	    		<p><strong>Other Services</strong><br><a href="list_product.php?page=1983">New Arrivals</a><br><a href="list_product.php?page=1982">Wholesale</a> <br><a href="construction.php">Postage</a> <br> <a href="list_product.php?page=1981">Quick Shipping</a> <br> <a href="list_product.php?page=1980">With Defect yet Cheap</a><br><br>
				<p><strong>Policies</strong><br><a href="construction.php">Privacy Policy</a><br><a href="construction.php">Cookie Policy</a> <br><a href="know.php?page=1113">Term and Conditions</a> <br> <a href="know.php?page=1113">Website Terms and Conditions</a></p>
				</div>
	        	
				<div class="large-4 medium-4 columns">
	        		<p><strong>Website Information</strong><br><a href="construction.php">F.A.Q</a> <br><a href="index.php">Home</a> <br> <a href="know.php?page=1111">About Us</a> <br> <a href="construction.php">Payment Methods</a> <br> <a href="know.php?page=1112">Contact Us</a></p>
	        	</div>
	        	<div class="large-4 medium-4 columns">
	        		<p><strong>Other Monique's Websites SOON</strong> <br> <a href="construction.php">Monique-Designs.com</a> <br> <a href="construction.php">Wellington.co.uk</a> </p>
				
				<p><br><strong>Get to know us more @ :</strong><br><br>
				<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-href="https://monique-designs.com" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
				<br> <br><a href="https://twitter.com/twitter" class="twitter-follow-button" data-show-count="false">Follow @twitter</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</p>
				</div>  
								
		</div>
		<footer>
			<center>
				<div class="row"  style="position:relative; border-bottom: 15px solid #333; background:#999999; left: -30%; top:20px; width: 164%; padding-top:20px; padding-bottom: 6%;">
				<small style="position:relative; left:-20px;">POWERED BY :</small><br>
				<img class="paypal" src="img/footer.png" />
				<p style="position:relative;  top:113px; color:#66665B;">&brvbar;| copyright 2014 hww.co.uk&copy;   | 3MS  Web  Delevopers&reg; || <a href="https://www.facebook.com/markii.borabon" target="_blank">Makii</a> |&brvbar;</p>
				</div>
			</center>
		</footer><!---FOOTER --->
	    

    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>