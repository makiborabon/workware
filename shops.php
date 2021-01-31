<?php 
// Connect to the MySQL database 
include("mysqli_connect.php");

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
$itemTotal = "";
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
		include("process2.php");
		
		$sql = mysqli_query($con, "SELECT * FROM ".$table.$condition." AND prod_id='$p_id' LIMIT 1") or die(mysqli_error());
		
		while ($row = mysqli_fetch_array($sql)) {
			$product_name = $row["prod_name"];
			$details = $row["summary"];
			$image = 'images/'.$row["photos"];
		}
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		$itemTotal = $each_item['quantity'] + $itemTotal;
		
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
		$cartOutput .= '<td align="left">' . $product_name . '<img src="'.$image.'" alt="' . $product_name. '" class="pix" /></td>';
		$cartOutput .= '<td align="center">&#163;' . $price . '</td>';
		$cartOutput .= '<td align="center">' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td align="center">&#163;' . $pricetotal . '</td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	setlocale(LC_MONETARY,"en_US");
    //$cartTotal = money_format("%10.2n", $cartTotal);
	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." USD</div>";
    // Finish the Paypal Checkout Btn
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style>
.main_cart{
width:400px;
z-index:100;
position:absolute;
height:auto;
margin-left: 840px;

}
#hide_cart:hover{
cursor:pointer;
}
#show_cart:hover{
cursor:pointer;
}

.main_cart .tbl{
	border:1px solid #CCC;
}

.content1 {
background: #FFF;
text-align: center;
color: #0078a0;
overflow: auto;
max-height: 300px;
border: 1px solid #CCC;
margin-top: -9px;
border-radius: 0 0 10px 10px;
padding: 5px;
}

.main_cart th{
background:#B0E0E6;
text-transform:uppercase;
}
.main_cart td,th{
padding:10px 5px;
color:#4169E1;
font-weight:normal;
}

.hide{
margin-top: -25px;
text-align: right;
float: right;
background: #FFF;
height: 25px;
}

.hide b{
color:blue;
}

.hide i{
padding: 0px 5px;
background: rgb(253, 253, 253);
border: solid 1px #0078a0;
border-radius: 50px;
}

.main_cart table{
border-collapse: collapse;
text-transform:lowercase;
}

.main_cart button{
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
.pix{
height:20px;
width:20px;
margin-left:20px;
border:1px solid #CCC;
border-radius:3px;
float:right;
}
.pix:hover{
position:absolute;
height:250px;
width:250px;
border:1px solid #CCC;
border-radius:5px;
margin-top:-120px;
margin-left:-40px;
z-index:100;
cursor:pointer;
}

.main_cart .group_btn{
float:right;
}

.none {
padding:20px;
}


</style>

<div class="main_cart">
<div class="hide">
  <?php

	if(isset($_SESSION['cart_array'])){}else{$itemTotal=0;}
	?>
<b id="hide_cart"><img width="25px"; height="25px"; src="img/bag.png" /><i><?php echo $itemTotal; ?></i></b>
<b id="show_cart"><img width="25px"; height="25px"; src="img/bag.png" /><i><?php echo $itemTotal; ?></i></b>
</div>

  <div class="content1">
  <?php

	if(isset($_SESSION['cart_array'])) {	//if the cart isn't empty
		//show the cart
		$total = 0;
	?>
	
    <div>
    <table class="tbl" border="1" width="100%" cellspacing="0" cellpadding="6">

        <th width="50%" bgcolor="#C5DFFA">Product</th>
        <th width="10%" bgcolor="#C5DFFA">Price</th>
        <th width="3%" bgcolor="#C5DFFA">Qty</th>
        <th width="3%" bgcolor="#C5DFFA">Total</th>

     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
    <?php echo $cartTotal; ?>
		<div class="group_btn">

		<a href="cart.php"><button class='btn2'>BUY NOW | VIEW MORE DETAILS</button></a>
	</div>
    </div>
	  <?php
	}else{
		//otherwise tell the user they have no items in their cart
		echo "<div class='none'><b>You have no items in your shopping cart.</b></div>";
		
	}
	?>
  </div>

<script>
$(document).ready(function(){
	$( "#hide_cart" ).hide();
		$( ".content1" ).hide();
	
	$('html').click(function(){
		$( ".content1" ).slideUp(2000);
		$("#hide_cart").hide();
		$("#show_cart").show();
	});
	
	$('#show_cart').mouseover(function(){
		$( ".content1" ).slideDown(2000);
		$("#hide_cart").show();
		$( "#show_cart" ).hide();
	});

});
</script>
</div>
