<?php 

session_start(); // Start session first thing in script
// Script Error Reporting

// Connect to the MySQL database  
include("connect/connection.php");
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 (if user attempts to add something to the cart from the product page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $price = $_POST['price'];
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1, "price" => $price));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1, "price" => $price)));
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1, "price" => $price));
		   }
	}
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 (if user chooses to empty their shopping cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 (if user chooses to adjust item quantity)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    // execute some code
	$item_to_adjust = $_POST['item_to_adjust'];
	$price_to_adjust = $_POST['price_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
	if ($quantity >= 100) { $quantity = 99; }
	if ($quantity < 1) { $quantity = 1; }
	if ($quantity == "") { $quantity = 1; }
	$i = 0;
	foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $item_to_adjust) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity, "price" => $price_to_adjust)));
				  } // close if condition
		      } // close while loop
	} // close foreach loop
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 (if user wants to remove an item from cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
	}
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5  (render the cart for the user to view on the page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
	echo '<script>
	$(document).ready(function(){
		$(".tbl").hide();
	});
</script>';
	
} else {
	// Start PayPal Checkout Button
	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="monique.designs@yahoo.com">';
	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
		
		$item_id = $each_item['item_id'];
		$price = $each_item['price'];
		
		$p_id = substr($item_id,0,strlen($item_id)-3);
		$tbl_code = substr($item_id,strlen($item_id)-3,strlen($item_id));
		include("process.php");
		
		$sql = mysql_query("SELECT * FROM ".$table.$condition." AND prod_id='$p_id'") or die(mysql_error());
		
		$row = mysql_fetch_array($sql);
		$product_name = $row["image"];
		$details = $row["summary"];
		$image = 'images/'.$row["img_name"];
		
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		setlocale(LC_MONETARY,"en_US");
        //$pricetotal = money_format("%10.2n", $pricetotal);
		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $product_name . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
		// Create the product array variable
		$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		$cartOutput .= '<td>' . $product_name . '<img src="'.$image.'" alt="' . $product_name. '" class="pix" /></td>';
		$cartOutput .= '<td>' . $details . '</td>';
		$cartOutput .= '<td>&#163;' . $price . '</td>';
		$cartOutput .= '<td><form action="cart.php" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		<input name="price_to_adjust" type="hidden" value="' . $price . '" />
		</form></td>';
		//$cartOutput .= '<td>' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td>&#163;' . $pricetotal . '</td>';
		$cartOutput .= '<td align="center"><form action="cart.php" method="post"><input id="rem" name="deleteBtn' . $item_id . '" type="submit" value="" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	
	setlocale(LC_MONETARY,"en_US");
    //$cartTotal = money_format("%10.2n", $cartTotal);
	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." USD</div>";
    // Finish the Paypal Checkout Btn
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
	<input type="hidden" name="notify_url" value="https://www.monique-design.co.uk/paypal/paypal_ipn.php">
	<input type="hidden" name="return" value="https://www.monique-design.co.uk/paypal/checkout_complete.php">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="https://www.monique-design.co.uk/paypal/paypal_cancel.php">
	<input type="hidden" name="lc" value="GBP">
	<input type="hidden" name="currency_code" value="GBP">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Cart</title>
</head>
<style>
#hide_cart:hover{
cursor:pointer;
}
#show_cart:hover{
cursor:pointer;
}

.content {
background:#FFF;
color:#4169E1;
border:1px solid #CCC;
border-radius:10px;
padding:15px;
}

th{
background:#B0E0E6;
}
td,th{
padding:10px 5px;
color:#4169E1;
}

.hide{
text-align:left;
padding:15px 0;
background:#FFF;
}

.hide b{
padding:15px;
color:#B8860B;
}
table{
border-collapse: collapse;
border:1px solid #CCC;
margin-bottom:20px;
}

button,.btn{
border:1px solid #CCC;
border-radius:5px;
padding:10px 15px;
cursor:pointer;
color:#FFF;
background-image: -o-linear-gradient(bottom, #B0E0E6 0%, #0067D6 100%);
background-image: -moz-linear-gradient(bottom, #B0E0E6 0%, #0067D6 100%);
background-image: -webkit-linear-gradient(bottom, #B0E0E6 0%, #0067D6 100%);
background-image: -ms-linear-gradient(bottom, #B0E0E6 0%, #0067D6 100%);
background-image: linear-gradient(to bottom, #B0E0E6 0%, #0067D6 100%);
}
input[type="image"]{
float:right;
}
.pix{
position:absolute;
height:50px;
width:50px;
margin-left:20px;
border:1px solid #CCC;
border-radius:3px;
margin-top:-16px;
}
.pix:hover{
position:absolute;
height:250px;
width:250px;
border:1px solid #CCC;
border-radius:5px;
margin-top:-100px;
margin-left:20px;
z-index:100;
cursor:pointer;
}

.group_btn{
float:left;
}

#rem{
background:url(img/banner/del.jpg) center center no-repeat;
background-size: 20px 20px;
height:20px;
width:20px;
border:1px solid #CCC;
border-radius:3px;
padding:20px;
}

</style>
<link href ="css/style.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<body>
<div class="main">
	<div class="top_nav row">
				<?php 
				if(isset($_SESSION['SESS_FIRST_NAME'])){
				?>
				<a href="index.php">HELLO <?php echo $_SESSION['SESS_LAST_NAME']; ?>! |</a>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay </a>
				<a class="navig-icon navig-icon-prev right" href="http://http://monique-design.co.uk">MONIQUE SITE | </a>
				<a class="right" href="logout.php">LOG OUT |</a>
				
				<?php } else {?>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay | </a>
				<a href="login.php">LOG IN</a> | <a href="register.php">REGISTER</a>
				
				<a class="navig-icon navig-icon-prev right" href="http://monique-design.co.uk">MONIQUE SITE </a>
				<?php } ?>
			</div>
		<header>
			<div class="sub_page">
				<h1>Monique Designs</h1>
				<div class="row"><img class='logo' src="img/banner/logo.png" /></div>
				<img class='logo1' src="img/banner/bg1.gif" />
			</div>
		</header>
			<div class="nav">
				<div class="row menu">
					<ul>
						<li class="active"><a href="index.php">HOME</a></li>
						<li class="inactive"><a href="about_us.php">ABOUT US</a></li>
						<li class="inactive"><a href="pay_met.php">PAYMENT METHOD</a></li>
						<li class="inactive"><a href="custom_serv.php">CUSTOMER SERVICE</a></li>
					</ul>
				</div>
			</div>
	
  <div class="content row">
    <div>
	
    <br />
    <table class="tbl" width="100%" border="1" cellspacing="0" cellpadding="6">

        <th width="30%" bgcolor="#C5DFFA"><strong>Product</strong></th>
        <th width="30%" bgcolor="#C5DFFA"><strong>Product Description</strong></th>
        <th width="10%" bgcolor="#C5DFFA"><strong>Unit Price</strong></th>
        <th width="7%" bgcolor="#C5DFFA"><strong>Quantity</strong></th>
        <th width="7%" bgcolor="#C5DFFA"><strong>Total</strong></th>
        <th width="7%" bgcolor="#C5DFFA"><strong>Remove</strong></th>

     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
	  <tr>
	  		<td colspan="6" align="right"><a href="cart.php?cmd=emptycart" onclick="return confirm('Are you sure?');"><button class='btn1'>EMPTY YOUR SHOPPING CART</button></a></td>
	  </tr>
    </table>
    <?php echo $cartTotal; ?>
    <br />
	<div class="group_btn">

		<a href="javascript: history.go(-2)"><button class='btn2'>CONTINUE SHOPPING</button></a>
	</div>

	<br />
	<?php echo $pp_checkout_btn; ?>
    <br />
    <br />
    </div>
   <br />
  </div>
  <?php //include_once("template_footer.php");?>
  <?php
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		echo '<script>
		$(document).ready(function(){
			$(".tbl").hide();
		});
		</script>';
	}
  ?>
</div>
<footer>
	<div class="footer">.....</div>
	
	<div class="footer1">
		<div class="row">
			<img class="paypal" src="img/banner/footer.png" />
			</div>
			<div id="footerContainer">
			<p><a href="index.html">Home</a> / <a href="../CategoryPage/AboutUs.php">About Us</a> / <a href="../CategoryPage/payment.php">Payment Methods</a> / <a href="../_WEB_/CategoryPage/emptypage.php">Contact Us</a> / <a href="#">Our Services</a> / <a href="../_WEB_/CategoryPage/emptypage.php">Blog</a> / <a href="#">Privacy Policy</a></p>
			<p>&brvbar;| Copyright © 2013 Monique Designs  | 3MS Web Delevopers&reg; |&brvbar; </p>

		</div>
	</div>
	
</footer>
</body>
</html>