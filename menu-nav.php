			<div class="top_nav row">
				<?php 
				
				if(isset($_SESSION['SESS_EMAIL'])){
				?>
				<a href="MyAccount.php">HELLO <?php echo $_SESSION['SESS_FIRST_NAME']; ?>! |</a>
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
				<div class="row"><img class='logo' width="272" height="84" src="img/logo.png" /></div>
				<img class='logo1' src="img/banner/bg1.gif" />

			</div>
			</header>
