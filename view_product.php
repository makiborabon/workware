<?php  session_start(); error_reporting(E_ALL); ini_set('display_errors','1');  ?>
<html>
	<head>
	<title>View Product</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.lazy.min.js"></script>	
	<script type="text/JavaScript" src="js/zoom.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js//jquery.ui.mouse.js"></script>
	<script src="js/jquery.ui.sortable.js"></script>
	<script src="js/jquery.ui.accordion.js"></script>
	<script src="js/jquery.ui.tabs.js"></script>
	
	<link href ="css/style.css" rel="stylesheet" type="text/css"/>
	<script>
	$(function() {
	$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
	
	var tabs = $( "#tabs" ).tabs();
		tabs.find( ".ui-tabs-nav" ).sortable({
			axis: "x",
			stop: function() {
				tabs.tabs( "refresh" );
			}
	});
	
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
	  
	  $('.tab_hov').click(function(){
		//$('.cont').css('display','block');
		//var pass = $('.description').html();
		
		var path = $(this).children(".tab_cont").html();

		$('.over_view').html('<div class="tab_cont">'+path+'</div>');
		
		
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
	  
	  $('.sm_img').hover(function(){
		var get_src = $(this).attr('src');

		$('#img_zoom').attr('src',get_src);
		$('#zoom1').attr('href',get_src);
		$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
		
	  });
  
	  jQuery("img.lazy").lazy({
        delay: 2000
		});
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

	  
	</script>
		<style>
			body{background: url(img/bg.jpg) repeat top left;}	
			.img-search{position:relative; left:200px; top:48px; height:43px; border:1px solid #CCC; padding-right:250px; border-radius:5px;}
			.input-search{border:none; height:41px; width:250px; position:relative; top:30px; left:-51px;}
			.btn0 {
			position: relative;
			left: -53px;
			top: 30px;
			border: 1px solid #CCC;
			border-radius: 5px;
			padding: 14px 16px;
			cursor: pointer;
			color: #FFF;
			background-image: linear-gradient(to bottom, #2A5F94  0%, #2A5F94 100%);
			
		</style>
	</head>
	<body>
		<!------------ MODAL ------------>
		<div class="cont">
		<div class="modal">
		<div class="head"><img id="close" src="img/fileclose.png"/></div>
		<div class="in_container"></div>
		</div>
		<div class="holder"></div>
		</div>
		<!------------ END MODAL ------------>
		
		<!------------ MODAL ------------>
		<div class="cont1">
		<div class="modal1">
		<div class="head1"><img id="close1" title="CLOSE" src="img/fileclose.png"/></div>
		<div class="in_container1">
		<?php include('cart_modal.php'); ?>
		</div>
		</div>
		<div class="holder1"></div>
		</div>
		<!------------ END MODAL ------------>
		
		<div class="main">
			<div class="top_nav row">
				<div style="position:absolute; left:52%;"> <span><a title="Whole Sale" href="construction.php">Wholesale | </a><a  title="Quick Shipping" href="construction.php">Quick Shipping | </a><a title="Customer Service" href="construction.php">Customer Service | </a> <a title="Payment Method" href="construction.php">Payment Method | </a><a  title="About Us" href="construction.php">About Us |&nbsp;</a></span></div>

				<?php 
				
				if(isset($_SESSION['SESS_EMAIL'])){
				?>
				<a href="know.php?page=1114">HELLO <?php echo $_SESSION['SESS_FIRST_NAME']; ?>! |</a>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay | </a>
				<a class="right cart_cont" href="cart.php">CART </a><?php include('shops.php'); ?>
				<a class="navig-icon navig-icon-prev right" href="http://http://monique-design.co.uk">MONIQUE SITE | </a>
				<a class="right" href="logout.php">LOG OUT |</a>
				
				<?php } else {?>
				<a class="navig-icon navig-icon-prev" href="http://www.ebay.co.uk/usr/monique*designs">Monique @ ebay | </a>
				<a href="login.php">LOG IN</a> | <a href="register.php">REGISTER</a>
				
				<a class="right cart_cont" href="#">CART </a><?php include('shops.php'); ?>
				<a class="navig-icon navig-icon-prev right" href="http://http://monique-design.co.uk">MONIQUE SITE | </a>
				<?php } ?>
			</div>
			
			<header>
			<div class="sub_page">
				<h1>Monique Designs</h1>
				<div class="row"><a href="index.php"><img class='logo' width="272" height="84" src="img/logo1.png" /></a></div>
				<!--<img class='logo1' src="img/banner/bg1.gif" />-->
				<center><div class="search-div"><form><img  class="img-search" src="img/search.png"/><input class="input-search" type="text" col="40" placeholder="Search product here!"/><button class="btn0">Search</button></form></div></center>
			</div>
			</header>
			<div class="nav">
				<div class="row menu" style="position: relative; top: -15px;">
					<ul>
						<li class="inactive"><a href="index.php?"><img class='home' src="img/home.png" style="position:relative; top: 12px;" /></a></li>
						<li class="active" ><a href="#">VIEW PRODUCTS</a></li>
				
					</ul>
				</div>
			</div>
			
			
			<div class="content row">
				<div class="left_wing" style ="position:fixed; width:234px;">
				<div class="categories search">
					<section>SEARCH CATEGORIES</section>
					<input  id="search" type="text" /><button>SEARCH</button>
				</div>
				
				<div class="categories">
					<section>SHOP CATEGORIES</section>
					<?php include('accordion_cat.php');?>
				</div>
				</div>
				<div class="right_wing">
					<div><?php include("banner-condition.php"); DisplayBanner(); ?></div>
					<div></div>
					<?php
						include("mysqli_connect.php");
						
						if(isset($_GET['page'])){
						
						$p_id =  mysqli_real_escape_string($con,$_GET['page']);
						$page_id = substr($p_id,0,strlen($p_id)-3);
						$tbl_code = substr($p_id,strlen($p_id)-3,strlen($p_id));

						$targetpage = "list_product.php"; 

						$product_id = $page_id;
						
						include("process2.php");
						
						$query1 = "SELECT * FROM ".$table." WHERE prod_id=$product_id";
						$result = mysqli_query($con, $query1) or die(mysqli_error());
						$row = mysqli_fetch_array($result);
						$id = $row["prod_id"];
						$image = "images/".$row["photos"];
						$name = $row["prod_name"];
						$price = $row["price"];
						$chk_price = strpos($price,',');
						if($chk_price<>""){
							$temp_price = explode(',',$price);
							$price = $temp_price[0];
						};
						$oldprice = $row["RRP"];
						$details = $row["description"];
						$summary = $row['summary'];
						$sizes= $row['sizes'];
						$colors = $row['colour'];
						$howtouse = $row['howToUse'];
						$no_sub_cat = $row['no_sub_cat'];
						$warning = $row['warning'];
						$care_ins = $row['careInstruction'];
						$quantity = $row['quantity'];
						$discount =  $oldprice - $price;
						}//isset
						?>
						<!--------------------------
						PRODUCT VIEW
						----------------------------->
						<div class="view_cont">
							<div class='order_cont'>
							<div class="zoom_cont" >
							
								<!----<span class='zoom' id='ex1'>
									<img id="big_img"; style = "width:100%; height:100%; position:relative; "src = "<?php echo $image; ?>"  />
								</span>---->
								<div class='zoom'>
								<div id="wrap">
									<a id="zoom1" href="<?php echo $image; ?>" class="cloud-zoom" rel="adjustX: 10, adjustY:-4, softFocus:true" style="position: relative; display: block;">
									<img id="img_zoom" class="lazy" src="img/ajax-loader.gif"; data-src="<?php echo $image; ?>" height="400px"; width="400px";  alt="" align="left" title="<?php echo $name; ?>" style="display: block;">
									</a>
								</div>
								</div>
								
								<div class="small_views">
								<img class="sm_img lazy" width='100px' height='100px' src="img/ajax-loader.gif"; data-src="<?php echo $image; ?>" />
								<?php 
									$pos = strrpos($image , ".");
									$start = substr($image,0,$pos);
									$end = substr($image, $pos);
									$ctr=0;
									
									while(true){
									
									if($ctr==$no_sub_cat){break;}
									$ctr++;
								?>
									<img class="sm_img lazy" width='100px' height='100px' src="img/ajax-loader.gif"; data-src="<?php echo $start.' ('.$ctr.')'.$end; ?>" />
								<?php } ?>
								</div>
							</div>
							
							<div>
							<div class="prod_det">
								<section>PRODUCT DETAILS</section>
								<strong><?php echo $name; ?></strong>
								<p>
								<?php
								$chk_size = strpos($sizes,',');
								$chk_color = strpos($colors,',');
								$chk_price = strpos($price,',');
								$ctr_size=0;
								$ctr_col=0;
								$ctr_quan=0;
						echo '<span>Price : </span><b id="price_val">&#163;'.$price.'</b><br /><br />';
						echo '<span>rrp : &#163;<span style="text-decoration: line-through; " title="old price">' . $oldprice . "</span></b></span></span><br /><span>You save <b style='color:red;'>&#163;".$discount."</b></span>";
						

						echo '<table>';
			
						echo '<form method="post" action="cart.php">';
								if($colors != ''){
										if($chk_color<>""){
										$temp = explode(',',$colors);
										$colors = $colors;
										echo "<tr><td><b>Colour : </b></td><td><select name='colourStatus'>";
										if($chk_color > $colors){
											foreach($temp as $colour){
											echo "<option>".trim($colour)."</option>";
											$ctr_colour++;}	
										}else{echo "<option>".trim($colour)."</option>";}
											  echo "</select></td></tr><br />";
										}else{
											echo "<tr><td><b>Colour : </b></td><td><select name='colourStatus'>";
											echo "<option>".$colors."</option>";	
											echo "</select></td></tr><br />";
										}
									}

								if($sizes != ''){
									if($chk_size<>""){
										$temp = explode(',',$sizes);
										$sizes = $sizes;
										
										echo "<tr><td><b>Size : </b></td><td><select name='sizeStatus'>";
										if($chk_size > $sizes){
											foreach($temp as $size){
											echo "<option>".trim($size)."</option>";
											$ctr_size++;}	
										}else{echo "<option>".trim($size)."</option>";}
											   echo "</select></td></tr><br />";
										}else{
											echo "<tr><td><b>Size : </b></td><td><select name='sizeStatus'>";
											echo "<option>".$sizes."</option>";	
											echo "</select></td></tr><br />";
										}
									}

									echo '<script type="text/javascript">document.quantityChange.submit();</script>';
									//echo '<tr><form name="quantityChange" action="cart.php" method="post">
									echo'<td><b>Quantity :</b></td>';
									echo '<td><input name="price_to_adjust" type="text" value="1" size="1" /></td></tr>';
									echo '</table>';

								
								/**if($chk_price<>""){
									$temp_price = explode(',',$price);
									$price = $temp_price[0];
								};

								if($chk_color<>""){
								$temp = explode(',',$colors); 
										echo "<span>Colors : </span>";
										echo "<select id='colors_clk' name=''quantity_val'>";
										foreach($temp as $c_item){
										
										echo "<option value='".$colors."'>".trim($c_item)."</option>";
										$ctr_col++;
										}
										echo "</select><br />";	
								}else if($colors==""){}else{
								echo "<span>Colors : </span>".$colors."<br />";
								}

								if($chk_size<>""){
									$temp = explode(',',$sizes);
									echo '<span>Sizes : </span>';
									echo "<select id='size_clk' onchange='schange_price()' name='size_val'>";
									if($chk_price<>""){
										foreach($temp as $size){
										
										echo "<option value='".trim($temp_price[$ctr_size])."'>".trim($size)."</option>";
										$ctr_size++;
										}
										echo "</select><br />";
									}else{
										foreach($temp as $size){
										
										echo "<option value='".$price."'>".trim($size)."</option>";
										$ctr_size++;
										}
										echo "</select><br />";
									}
									
								}else if($sizes==""){}else{
									echo '<span>Sizes : </span>'.$sizes.'<br />';
								}
								
								if($quantity<>""){
									echo "<span>Quantity : </span>";
									$chk_quan = strpos($quantity,',');
									if($chk_quan<>""){
										$temp = explode(',',$quantity); 
										echo "<select id='quantity_clk' onchange='qchange_price()' name=''quantity_val'>";
										foreach($temp as $q_item){
										
										echo "<option value='".trim($temp_price[$ctr_quan])."'>".trim($q_item)."</option>";
										$ctr_quan++;
										}
										echo "</select>";
									}else{
										echo $quantity;
									}
								}
								?> <br />
								
								<br /><br /></p>
								<section>SUMMARY</section>
								<p>
								<?php echo $summary; ?>
								</p>**/?>
								<hr />
								<input type="hidden" name="prod_name" id="prod_name" value="<?php echo $name; ?>" />
								<input type="hidden" name="pid" id="pid" value="<?php echo $id.$tbl_code; ?>" />
								<input type="hidden" name="price" id="price" value="<?php echo $price; ?>" />
								<input type="image" src="img/button.png" alt="Submit" width="108" height="48" name="button" id="button" value="" />
								</form>
								
								
								<form id="form1" name="form1" method="post" action="WishInsert.php">
								<input type="hidden" name="pid2" id="pid2" value="<?php echo $pro_id=$id.$tbl_code;?>" />
								<input type="hidden" name="name" id="name" value="<?php echo $name; ?>" />
								<input type="image" src="img/addtowishlist.png" width="108" height="48" />
								</form>
							
							</div>
													
						</div>
						

						
						
						</div>
						
					</div>
					
					<!--------------------------
						END OF PRODUCT VIEW
					----------------------------->
					
					<!--------------------------
						TABULAR VIEW
					----------------------------->
					
					<div class="tab_view">
						<div class="tab_left">
								<div id="tabs">
									<ul>
										<li><a href="#tabs-1">DETAILS</a></li>
										<?php if($howtouse<>""){ ?>
										<li><a href="#tabs-2">HOW TO USE</a></li>
										<?php } ?>
										<?php if($warning<>""){ ?>
										<li><a href="#tabs-3">WARNING</a></li>
										<?php } ?>
										<?php if($care_ins<>""){ ?>
										<li><a href="#tabs-4">INSTRUCTION</a></li>
										<?php } ?>
									</ul>
									<div id="tabs-1">
										<p><?php echo $details; ?></p>
									</div>
										<?php if($howtouse<>""){ ?>
										<div id="tabs-2"><?php echo $howtouse; ?></div>
										<?php } ?>
										<?php if($warning<>""){ ?>
										<div id="tabs-3"><?php echo $warning; ?></div>
										<?php } ?>
										<?php if($care_ins<>""){ ?>
										<div id="tabs-4"><?php echo $care_ins; ?></div>
										<?php } ?>
								</div>
								
						<div class="tabular">
						<ul>
						<?php 
									$pos = strrpos($image , ".");
									$start = substr($image,0, $pos);
									$end = substr($image, $pos);
									$ctr=0;
									
									while(true){
									
									
									if($ctr==$no_sub_cat){break;}
									$ctr++;
								?>
								<li>
									<a class="tab_hov">
										<div class="tab_cont">
											<strong><?php echo $name; ?></strong>
											<img class="sm_img" width='600px' height='600px' src="<?php echo $start.' ('.$ctr.')'.$end; ?>" />
											<div class="big_details">
												<p>
													<span>Colors :</span><?php echo $colors; ?>
													<br />
													<b>Price : </b>&pound;<?php echo $price; ?>
													<section>DETAILS</section>
													<p>
														<?php echo $details; ?>
													</p>
												</p>
											</div>
										</div>
										View <?php echo $ctr; ?>
									</a>
								</li>

								<?php
									
									}
						?>

						</ul>
						
						</div>
						<!-----------TABS ---------------->
						  <div class="overview_con">
								<div class="over_view">
									<div class="tab_cont">
										<strong><?php echo $name; ?></strong>
										<img class="sm_img" width='600px' height='600px' src="<?php echo $image; ?>" />
											<div class="big_details">
												<p> 
													<span><b><font color="#0078a0">Colors :</font></b></span> <?php echo $colors; ?>
													<br />
													<span><b><font color="#0078a0">Sizes :</font></b></span> <?php echo $sizes; ?><br />
													<b><font color="#0078a0">Price : </font></b>&pound; <?php echo $price; ?>
													<p><section><b>DETAILS :</b></section>
														<?php echo $details; ?>
												</p>
											 </p>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<div class="tab_right">
							<div class="more_prod">
							<section>MORE PRODUCTS TO LOVE</section>
							<?php
								$qry = mysqli_query($con,"SELECT * FROM ".$table.$condition." ORDER BY RAND() LIMIT 6");
									while($rand = mysqli_fetch_assoc($qry)){ 
											$id = $rand["prod_id"];
											$image = 'images/'.$rand["photos"];
											$name = $rand["prod_name"];
											$size = $rand["sizes"];
											$colors = $rand["colour"];
											$price = $rand["price"];
									?>
								<span><a href="view_product.php?page=<?php echo  $id.$tbl_code; ?>">
								<img class="lazy" height='100px'; width='100px'; data-src = "<?php echo $image; ?>"; src="img/ajax-loader.gif"; alt="3MS" />
								</a></span>
								<div class="more_details">
									<strong><?php echo $name; ?></strong>
									<p>
										<span>Colors :</span><?php echo $colors ?>
										<br />
										<span>Sizes :</span><?php echo $size; ?><br />
										<span>Price :</span><?php echo $price; ?>
									</p>
								</div>
								<hr />
							<?php
							}
							?>			
						</div>
						</div>
					</div>

					<!--------------------------
						END OF TABULAR VIEW
					----------------------------->
				</div>
			</div>
			</div>
			<!----COMMENT---->
		<style>
				.time{ position: relative; width:50px; height: 60px; left: 191px; top: -35px; border-radius: 5px; padding: 10px; border:1px solid #0078A0;float:right; color:#0078A0; font-size:10px;}
				.message{ position:relative; margin:-70px; left:-125px; width:20em; top:-116px; word-break:keep-all; height:80px; border:1px solid #CCCCCC; border-radius:6px; color:#0078A0; overflow-y:scroll; overflow-x:hidden;}
				.submit-comment{
				position: relative;
				border: 1px solid #CCC;
				border-radius: 5px;
				padding: 11px 17px;
				cursor: pointer;
				color: #FFF;
				background-image: linear-gradient(to bottom, #0078A0  0%, #0078A0 100%);	
		</style>
		<div class="comment-wrapper" align="center">

			<?php
			$sql="SELECT * FROM comment where prod_id = $product_id ORDER BY datetime DESC LIMIT 5";
			$result=mysqli_query($con, $sql);
			while($rows=mysqli_fetch_array($result)){
			?>
			<div align="center" >
				<div style=" position:relative; top:50px; width:10px; border-radius:7px;">
					<div class="time"><img class="man" src="img/head.png" width="23" height="23"> <br> <?php echo'<span align="center">'. $rows['firstname']. '</span> <br>' .$rows['datetime'];?></div>
					<div class="message"><br><em><?php echo $rows['comment'];?></em></div>
				</div>
			</div>
			<br>
			<?php
			}//while
			mysqli_close($con); //close database
			?>
			<div class="row">
			<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" >
			<tr><td style="position:relative;  color:#0078A0;  font-weight:700;">Post Comment</td></tr>
				<tr>
				
					<form id="form1" name="form1" method="post" action="addcomment.php">
						<td>
							<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
								<tr>
									<td valign="top"><em style="color:#0078A0;">Message</em></td>
									<td valign="top">:</td>
									<td><textarea name="comment" cols="40" rows="3" id="comment"></textarea></td>
								</tr>
								<tr>
									<input type="hidden" name="prod_id" value="<?php echo $product_id; ?>">
									<input type="hidden" name="member_email" value="<?php echo $_SESSION['SESS_MEMBER_ID']; ?>">
									<input type="hidden" name="first_name" value="<?php echo $_SESSION['SESS_FIRST_NAME']; ?>">
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td><?php if(isset($_SESSION['SESS_EMAIL'])){ ?><input class="submit-comment" type="submit" name="Submit" value="Submit" /> <input class="submit-comment" type="reset" name="Submit2" value="Reset" /> <?php }else {echo '<input class="submit-comment" type="submit" name="Submit" value="Submit" disabled/> <input class="submit-comment" type="reset" name="Submit2" value="Reset" disabled/>'; }?></td>
								</tr>
							</table>
						</td>
					</form>
				</tr>
			</table>
			</div><!--comments--->
		</div>
		<center>
			<?php include('footer.php');?>
		</center>
	</body>
</html>