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
	
	<style>
			a {color:#5A7F8B;}
			a:hover {opacity:0.5;}
			body{background: url(img/bg.jpg) repeat top left;}
			.img-search{position: relative; top: -2px; height: 43px; border: 1px solid #CCC; padding-right: 250px; border-radius: 5px;}
			form{position:relative; top:20px; height:42px; border-radius:5px; border: 1px solid #CCC; padding-top: 1px}
			input[type="text"]{border:none; height:41px; width:250px;  position:relative; top:-44px; left:37px;}
			button, .btn0 {
			position: relative;
			top: -103px;
			left: 264px;
			border: 1px solid #CCC;
			border-radius: 5px;
			padding: 13px 16px;
			cursor: pointer;
			color: #FFF;
			background-image: linear-gradient(to bottom, #2A5F94  0%, #2A5F94 100%);
	</style>
	
	
	
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
		
</head>
<body onload="myFunction()">
 
    <div class="row">
	<span class="row" style="background:#C0CEE4; width:125%; height:15px; position:absolute; top:-10px; left:-20%;">.</span>   
      <div class="large-12 columns">
      	<div class="panel">
			
			<div class="row">
			
			<span style="position:relative; left:12px; top: -10px; font-weight:700; font-size:10px; color:#2A5F94;"><a title="Whole Sale" href="Contruction.php">Wholesale | </a><a  title="Quick Shipping" href="Contruction.php">Quick Shipping | </a><a title="Customer Service" href="../custom_serv.php">Customer Service | </a> <a title="Payment Method" href="../pay_met.php">Payment Method | </a><a  title="About Us" href="../about_us.php">About Us |&nbsp;</a> Hello! <?php if(isset($_SESSION['SESS_EMAIL'])){ ?><?php echo '<span style="color:#0078A0; font-size:8pt;">'. $_SESSION['SESS_FIRST_NAME'] . ' </span> || <a href="../logout.php">Log-out</a>'; }else{ ?> <a href="../login.php"><span style="color:#0078A0; font-weight:bold;">Sign-in</span></a> || Gain Discount! <a href="../register.php"> <span style="color:#0078A0; font-weight:bold;">Register!</span></a><?php }?> </span>

				<div class="large-4 medium-4 columns">
	        		<img class="logo" src="img/logo.png"/>
				</div>
	        	<div class="large-4 medium-4 columns">
					<form><img class="img-search" src="img/search.png"/><input type="text" col="40" placeholder="Search product here!"/><button class="btn0">Search</button></form>
				</div>
	        	
	        	<div class="large-4 medium-4 columns">
	        		<div class="wish-account-cart" style="position:relative; left:100px; top:27px;"><a href="../MyAccount.php"><img  title="My Wishlist" src="img/wishlist.png" width="60" height="30" /></a>&nbsp; <a href="../MyAccount.php"> &nbsp; <img title="My Account" class ="man" src="img/head.png" width="30" height="30" /></a><a href="../cart.php"> &nbsp; &nbsp; <img title="My Cart" src="img/bag.png" width="30" height="30" /></a></div>
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
	
			<div> <?php 
			
 
 
 function DisplayBanner(){
	$p_id =  $_GET['page'];
	$page_id = substr($p_id,0,strlen($p_id)-3);
	$tbl_code = substr($p_id,strlen($p_id)-3,strlen($p_id));

	/*****************ALL***************************/
	 if($tbl_code==111){ include('about.php');}
	/*************WELLINGTOON***********************/

	else if($tbl_code==112){include('contact.php');}

	else{ echo'mali';}

}
DisplayBanner();
?>

			
			
			</div>
			
			
			
			
</div><!-- MAIN ROW---->
	  <style> .row .large-4 medium-4 columns{margin:200px;} p strong {color:#3775B7;}</style>
	   <div class="row">
	        	<div class="large-4 medium-4 columns">
	    		<p><strong>Other Services</strong><br><a href="list_product.php?page=1983">New Arrivals</a><br><a href="list_product.php?page=1982">Wholesale</a> <br><a href="construction.php">Postage</a> <br> <a href="list_product.php?page=1981">Quick Shipping</a> <br> <a href="list_product.php?page=1980">With Defect yet Cheap</a><br><br><br>
				<p><strong>Policies</strong><br><a href="construction.php">Privacy Policy</a><br><a href="construction.php">Cookie Policy</a> <br><a href="terms-condition.php">Term and Conditions</a> <br> <a href="construction.php">Website Terms and Conditions</a></p>
				</div>
	        	
				<div class="large-4 medium-4 columns">
	        		<p><strong>Website Information</strong><br><a href="construction.php">F.A.Q</a> <br><a href="index.php">Home</a> <br> <a href="head.php?page=1111">About Us</a> <br> <a href="construction.php">Payment Methods</a> <br> <a href="head.php?page=1112">Contact Us</a></p>
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
	
	
  </body>
</html>
