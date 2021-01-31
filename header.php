

<html>
	<head>
	<title>Monique Designs | Home</title>
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
	<style>body{background: url(img/bg.jpg) repeat top left;}</style>
	</head>
	<body>
		<!------------ MODAL ------------>
		<div class="cont">
		<div class="modal">
		<div class="head"><img id="close" src="img/list_img/fileclose.png"/></div>
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
		<div class="head1"><img id="close1" title="CLOSE" src="img/list_img/fileclose.png"/></div>
		<div class="in_container1">
		<?php include('cart_modal.php'); ?>
		</div>
		</div>
		<div class="holder1"></div>
		</div>
		<!------------ END MODAL ------------>
		
		<div class="main">
			<div class="top_nav row">
				<?php 
				
				if(isset($_SESSION['SESS_EMAIL'])){
				?>
				<a href="#">HELLO <?php echo $_SESSION['SESS_FIRST_NAME']; ?>! |</a>
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
				<div class="row"><img class='logo' src="img/logo.png" /></div>

			</div>
			</header>
			<div class="nav">
				<div class="row menu" style="position: relative; top: -15px;">
					<ul>
						<li class="inactive"><a href="index.php"><img class='home' src="img/home.png" style="position:relative; top: 12px;" /></a></li>
						<li class="active" ><a href="#">MY ACCOUNT</a></li>					
					</ul>
				</div>
			</div>