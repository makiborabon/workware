<?php session_start(); error_reporting(E_ALL);ini_set('display_errors','1');?>

<html>
	<head>
	<title>Item List</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.lazy.min.js"></script>
	<script type="text/JavaScript" src="js/zoom.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js//jquery.ui.mouse.js"></script>
	<script src="js/jquery.ui.sortable.js"></script>
	<script src="js/jquery.ui.accordion.js"></script>	
	<link href ="css/style.css" rel="stylesheet" type="text/css"/>

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
		<div class="in_container">
		<div id="wrap">
			<a id="zoom1" href="<?php echo 'images/1.jpg' ?>" class="cloud-zoom" rel="adjustX: 10, adjustY:-4, softFocus:true" style="position: relative; display: block;">
			<img id="img_zoom" src="<?php echo 'images/1.jpg' ?>" height="300px"; width="300px";  alt="" align="left" title="" style="display: block;">
			</a>
		</div>
		<div class='details'></div>
		</div>
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
				<a class="navig-icon navig-icon-prev" href="http://localhost/monique-designs/MyAccount.php">Monique @ ebay | </a>
				<a class="right cart_cont" href="#">CART </a><?php include('shops.php'); ?>
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
				<center><div class="search-div"><div style="position:absolute; left:35%; top: 30px; font-size: 18px; font-weight:bold; color:#0078a0;" ><img src="img/phone3.png"/><small>0091-231-4214</small></div><form><img  class="img-search" src="img/search.png"/><input class="input-search" type="text" col="40" placeholder="Search product here!"/><button class="btn0">Search</button></form></div></center>
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
				<div class="categories search" >
					<section>SEARCH CATEGORIES</section>
					<input  id="search" type="text" /><button>SEARCH</button>
				</div>
				
				<div class="categories" >
					<section>SHOP CATEGORIES</section>
					<?php include('accordion_cat.php');?>
				</div>
				</div>
				
				<div class="right_wing" style="border:1px solid #CCC; padding: 0px 0px 100px 0px;">
					<div><?php include("banner-condition.php"); DisplayBanner(); ?></div>
					<div></div>

<div class="list_cont" >
						<?php
						include("mysqli_connect.php");
						
						$p_id =  mysqli_real_escape_string($con, $_GET['page']);
						$page_id = substr($p_id,0,strlen($p_id)-3);
						$tbl_code = substr($p_id,strlen($p_id)-3,strlen($p_id));

						$targetpage = "list_product.php"; 

						$product_id = $page_id;

						include("process2.php");
						
						$limit = 20; 
						
						$query = "SELECT COUNT(*) as num FROM ".$table.$condition;
						$total_pages = mysqli_fetch_array(mysqli_query($con,$query));
						$total_pages = $total_pages['num'];
						
						$stages = 3;
						$page = $page_id;
						if($page){
							$start = ($page - 1) * $limit; 
						}else{
							$start = 0;	
							}	
						
						// Get page data
						$query1 = "SELECT * FROM ".$table.$condition." LIMIT $start, $limit";

						$result = mysqli_query($con, $query1);
						
						// Initial page num setup
						if ($page == 0){$page = 1;}
						$prev = $page - 1;	
						$next = $page + 1;							
						$lastpage = ceil($total_pages/$limit);		
						$LastPagem1 = $lastpage - 1;					

						$paginate = '';
						if($lastpage > 1)
						{	
							$paginate .= "<div class='paginate' >";
							// Previous
							if ($page > 1){
								$paginate.= "<a href='$targetpage?page=$prev$tbl_code'>previous</a>";
							}else{
								$paginate.= "<span class='disabled'>previous</span>";	}

							// Pages	
							if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
							{	
								for ($counter = 1; $counter <= $lastpage; $counter++)
								{
									if ($counter == $page){
										$paginate.= "<span class='current'>$counter</span>";
									}else{
										$paginate.= "<a href='$targetpage?page=$counter$tbl_code'>$counter</a>";}					
								}
							}
							elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
							{
								// Beginning only hide later pages
								if($page < 1 + ($stages * 2))		
								{
									for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
									{
										if ($counter == $page){
											$paginate.= "<span class='current'>$counter</span>";
										}else{
											$paginate.= "<a href='$targetpage?page=$counter$tbl_code'>$counter</a>";}					
									}
									$paginate.= "...";
									$paginate.= "<a href='$targetpage?page=$LastPagem1$tbl_code'>$LastPagem1</a>";
									$paginate.= "<a href='$targetpage?page=$lastpage$tbl_code'>$lastpage</a>";		
								}
								// Middle hide some front and some back
								elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
								{
									$paginate.= "<a href='$targetpage?page=1'>1</a>";
									$paginate.= "<a href='$targetpage?page=2'>2</a>";
									$paginate.= "...";
									for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
									{
										if ($counter == $page){
											$paginate.= "<span class='current'>$counter</span>";
										}else{
											$paginate.= "<a href='$targetpage?page=$counter$tbl_code'>$counter</a>";}					
									}
									$paginate.= "...";
									$paginate.= "<a href='$targetpage?page=$LastPagem1$tbl_code'>$LastPagem1</a>";
									$paginate.= "<a href='$targetpage?page=$lastpage$tbl_code'>$lastpage</a>";		
								}
								// End only hide early pages
								else
								{
									$paginate.= "<a href='$targetpage?page=1'>1</a>";
									$paginate.= "<a href='$targetpage?page=2'>2</a>";
									$paginate.= "...";
									for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
									{
										if ($counter == $page){
											$paginate.= "<span class='current'>$counter</span>";
										}else{
											$paginate.= "<a href='$targetpage?page=$counter$tbl_code'>$counter</a>";}					
									}
								}
							}		
									// Next
							if ($page < $counter - 1){ 
								$paginate.= "<a href='$targetpage?page=$next$tbl_code'>next</a>";
							}else{
								$paginate.= "<span class='disabled'>next</span>";
								}
								
							$paginate.= "</div>";		
						
						}
						while($row = mysqli_fetch_array($result)){
									$id = $row["prod_id"];
									$image = 'image-list/'.$row["photos"];
									$image2 = 'images/'.$row["photos"];
									$name = $row["prod_name"];
									$price = $row["price"];
									$chk_price = strpos($price,',');
									if($chk_price<>""){
										$temp_price = explode(',',$price);
										$price = $temp_price[0];
									};
									$oldprice = $row["RRP"];
									$chk_oldprice = strpos($oldprice,',');
									if($chk_oldprice<>""){
										$temp_oldprice = explode(',',$oldprice);
										$oldprice = $temp_oldprice[0];
									};
									$details = $row["description"];
									$summary = $row['summary'];
									$sizes= $row['sizes'];
									$colors = $row['colour'];
									$category = $row['category'];
									$cut = strpos($category,"(");
									$cat_path = substr($category,0,$cut);
									$quantity = $row['quantity'];
									$discount =  $oldprice - $price;
									$prod_quantity = $row['org_quantity'];
					?>
							<div class="large-4 medium-6 columns" >
							<span><small style="position:absolute;"><?php echo  $id ?></small>
							<a href="view_product.php?page=<?php echo  $id.$tbl_code; ?>">

							<img  id="columns" class="items lazy" style = "position:relative; width:180px; height:180px;" title=" <?php echo $name ?>"; src="img/ajax-loader.gif"; data-src = "<?php echo $image ?> "/></center>
					<?php
								echo "<br><p style=\"text-align: center; margin-top:-2px;\">" . "<span>$name" . '<br />rrp : &#163;<span style="text-decoration: line-through; " title="old price">' . $oldprice .' </span> &nbsp; price : <span style="color:orange;" title="new price"><b>&#163;'  .  $price . "</b></span></span><br />you save <b>&#163;".$discount."</b><br> Remaining : " .$prod_quantity. "</p>";
									?><?php include('ratings.php'); ?><input type="image" src="img/view.png" alt="Submit" width="128" align="right" height="42"></a></span>
								<div id ="more">
									 <ul class="option"><b id="path"><?php echo $image2; ?></b><input type="hidden" id="img_name" value="<?php echo $name; ?>" /><h6 style="cursor:pointer;" ><strong title="Instant View">Quick View: </strong></h6>
											
<li class="description">								
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
								
								if($chk_price<>""){
									$temp_price = explode(',',$price);
									$price = $temp_price[0];
								};
								echo '<span>Price : </span><b id="price_val">&#163; '.$price.'</b><br />';
								echo '<span>rrp : &#163;<span style="text-decoration: line-through; " title="old price">' . $oldprice . "</span></b></span></span><br /><span>You save <b style='color:red;'>&#163;".$discount."</b></span><br />";
								
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
									echo "<span>Quantity : </span>";
									echo $quantity;
								?>
								
								<br /><br /><br />
								</p>
								<section>SUMMARY</section>
											<p style=" height:50px; overflow-y:scroll; cursor:pointer;">
											<?php echo $summary; ?>
											</p>
											<hr />
											<form id="form1" name="form1" method="post" action="cart.php">
											<input type="hidden" name="pid" id="pid" value="<?php echo $pro_id=$id.$tbl_code; ?>" />
											<input type="hidden" name="price" id="price" value="<?php echo $price; ?>" />
											<input type="image" src="img/button.png" alt="Submit" width="108" height="48" name="button" id="button" value="" />
											</form>
											<form id="form1" name="form1" method="post" action="MyAccount.php">
											<input type="hidden" name="pid2" id="pid2" value="<?php echo $pro_id=$id.$tbl_code;?>" />
											<input type="hidden" name="name" id="name" value="<?php echo $name; ?>" />
											<input type="image" src="img/addtowishlist.png" width="108" height="48" />
											</form>

											<!--<span><a href="MyAccount.php?page=<?php //echo  $id.$tbl_code; ?>">
												<input type="image" src="img/addtowishlist.png" width="108" height="48" />
											</a></span>-->
		
											</div>

											</li>
										</ul>
								</div>
								<?php	echo "</h5></div>";
								}		
					 echo "<div class='page_up'><h6>".$paginate . "</h6></div>";
					?>
					</div>
				</div>
			</div>
			<footer>
				<div class="footer">
					<div class="page_down row"><?php  echo "<h6>".$paginate . "</h6>"; ?></div>
				</div>
			<center>
			<?php include('footer.php');?>
			</center>			
			</footer>
		</div>
	</body>
</html>