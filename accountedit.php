<?php session_start(); ?>
<html>
	<head>
	<title>Monique Designs | My Account</title>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.lazy.min.js"></script>
	<script type="text/JavaScript" src="../js/zoom.js"></script>
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.mouse.js"></script>
	<script src="../js/jquery.ui.sortable.js"></script>
	<script src="../js/jquery.ui.accordion.js"></script>	
	<link href ="../css/style.css" rel="stylesheet" type="text/css"/>

	<script>
	$(function() {
	$( "#accordion" )
	  .accordion({
		header: "> div > h3"
	  })
	  .sortable({
		axis: "y",
		handle: "h3",
		stop: function( event, ui ) {
		  // IE doesn't register the blur when sorting
		  // so trigger focusout handlers to remove .ui-state-focus
		  ui.item.children( "h3" ).triggerHandler( "focusout" );
		}
	  });
	  
	  $('.option').click(function(){
		
		$('.cont').css('display','block');
		var pass = $(this).children('.description').html();
		var path = $(this).children("#path").text();
		var name = $(this).children("#img_name").val();
		
		$('.in_container>.details').html(pass);
		$('#img_zoom').attr('src',path);
		$('#img_zoom').attr('title',name);
		$('#zoom1').attr('href',path);
		$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
		
	  });
	  
	  $('.cart_cont').click(function(){
		$('.cont1').css('display','block');
	  });
	  
	  $('#close').click(function(){
		$('.cont').css('display','none');
	  });
	  
	  $('#close1,.close2').click(function(){
		$('.cont1').css('display','none');
	  });
	  
	    jQuery("img.lazy").lazy({
        delay: 2000
		});
		
		function qchange_price(){
		var new_price = $('#quantity_clk').val();
		$('#price_val').text(""+new_price);
		$('#price').val(new_price);
		}
		function schange_price(){
		var new_price = $('#size_clk').val();
		$('#price_val').text(""+new_price);
		$('#price').val(new_price);
		}
	});
	
	
	</script>
	<style>
			table td{padding-left:20px;}
			table,td,th{border:1px solid white; border-collapse:collapse;}
			table{position:relative; left:-5%; width:50%;}th{height:50px; }
			table td{padding-right:25px; }
			.new{position:relative; left:-42%;}
			.account{position:relative; left:-43%;}
			.edit{position:relative; left:30px;}
	</style>
	</head>
	<body>
		
		<div class="main">
			<div class="top_nav row">
				<?php 
				
				if(isset($_SESSION['SESS_EMAIL'])){
				?>
				<a href="index.php">HELLO <?php echo $_SESSION['SESS_FIRST_NAME']; ?>! |</a>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay | </a>
				<a class="navig-icon navig-icon-prev right" href="http://http://monique-design.co.uk">MONIQUE SITE | </a>
				<a class="right" href="../logout.php">LOG OUT |</a>
				
				<?php } else {?>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay | </a>
				<a href="../login.php">LOG IN</a> | <a href="../register.php">REGISTER</a>
				
				<a class="navig-icon navig-icon-prev right" href="http://http://monique-design.co.uk">MONIQUE SITE | </a>
				<?php } ?>
			</div>
			
			<header>
			<div class="sub_page">
				<h1>Monique Designs</h1>
				<div class="row"><img class='logo' src="../img/banner/logo.png" /></div>
				<img class='logo1' src="../img/banner/bg1.gif" />
			</div>
			</header>
			<div class="nav">
				<div class="row menu">
					<ul>
						<li class="inactive"><a href="../index.php">HOME</a></li>
						<li class="inactive"><a href="../about_us.php">ABOUT US</a></li>
						<li class="inactive"><a href="../pay_met.php">PAYMENT METHOD</a></li>
						<li class="inactive"><a href="../custom_serv.php">CUSTOMER SERVICE</a></li>
						<li class="inactive" ><a href="../list_product.php?page=1999">VIEW ALL PRODUCTS </a></li>
						<li class="active" ><a href="../MyAccount.php">MY ACCOUNTS </a></li>						
					</ul>
				</div>
			</div>
			
			<div class="content row">
				<div class="left_wing">
				<div class="categories search">
					<section>SEARCH CATEGORIES</section>
					<input  id="search" type="text" /><button>SEARCH</button>
				</div>
				
				</div>
				
				<div class="right_wing">
					<div><img class='logo r_cont' width="100%" src="../img/banner/discount.png" /></div>
					<div></div>

<?php


 // Edit Entire record from specific ID..
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($cus_id, $firstname, $lastname, $email, $contactno, $PostCode, $address, $state, $countries, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 <br>
 <div class="edit">
 <form class="input" action="" method="post">
 EDIT YOUR PROFILE<br><br>
 <table>
 <input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>"/>
 <tr><td><strong>First Name:</strong></td><td><input type="text" name="firstname" size="40" value="<?php echo $firstname; ?>"/></td></tr>
 <tr><td><strong>Last Name:</strong></td><td><input type="text" name="lastname" size="40" value="<?php echo $lastname; ?>"/></td></tr>
 <tr><td><strong>Email:</strong></td><td><input type="text" name="email"  size="40" value="<?php echo $email; ?>"/></td></tr>
 <tr><td><strong>Contact:</strong></td><td><input type="text" name="contactno" size="40" value="<?php echo $contactno; ?>"/></td></tr>
 <tr><td><strong>Post Code:</strong></td><td><input type="text" name="PostCode" size="40" value="<?php echo $PostCode; ?>"/></td></tr>
 <tr><td><strong>Address:</strong></td><td><textarea rows="8" cols="37" type="text" name="address" /><?php echo $address; ?></textarea></td></tr>
 <tr><td><strong>State:</strong></td><td><input type="text" name="state" size="40" value="<?php echo $state; ?>"/></td></tr>
 <tr><td><strong>Country:</strong></td><td><input type="text" name="countries" size="40" value="<?php echo $countries; ?>"/></td></tr>

 <tr><td></td><td><input type="submit" class="button"name="submit" value="Submit"></td></tr>

 </table>
 </form>
</div> 
 </body>
 </html> 
 <?php
 }



 // connect to the database
include('../connect/connection.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['cus_id']))
 {
 // get form data, making sure it is valid
	 $cus_id = $_POST['cus_id'];
	 $firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
	 $lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));
	 $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	 $contactno = mysql_real_escape_string(htmlspecialchars($_POST['contactno']));
	 $PostCode = mysql_real_escape_string(htmlspecialchars($_POST['PostCode']));
	 $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
	 $state = mysql_real_escape_string(htmlspecialchars($_POST['state']));
	 $countries = mysql_real_escape_string(htmlspecialchars($_POST['countries']));
 // check that firstname/lastname fields are both filled in
 if ($firstname == '' || $lastname == '' || $email == '' || $contactno == '' || $address == '' || $state == '' || $PostCode== '' || $countries== '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($cus_id, $firstname, $lastname, $email, $contactno,  $PostCode, $address, $state, $countries, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE tbl_customer SET firstname='$firstname', lastname='$lastname', email='$email', contactno='$contactno', address='$address', state='$state' , countries='$countries', PostCode='$PostCode' WHERE cus_id ='$cus_id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: MyAccount.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['cus_id']) && is_numeric($_GET['cus_id']) && $_GET['cus_id'] > 0)
 {
 // query db
 $cus_id = $_GET['cus_id'];
 $result = mysql_query("SELECT * FROM tbl_customer WHERE cus_id = $cus_id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db 
 $cus_id = $row['cus_id'];
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 $email = $row['email'];
 $contactno = $row['contactno'];
 $PostCode = $row['PostCode'];
 $address = $row['address'];
 $state = $row['state'];
 $countries = $row['countries'];
 
 // show form
 renderForm($cus_id, $firstname, $lastname, $email, $contactno, $PostCode, $address, $state, $countries, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>
</body>
</html> 