<?php include('session.php');

if(isset($login_session)){

echo $_SESSION['id'] = $_GET['id'];

?>
<!DOCTYPE html>
<html>

 <head>
	 <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
    <link href="css/uploadfilemulti.css" rel="stylesheet">
	<script src="js/jquery-1.9.0.min.js"></script>
	<script src="js/jquery.fileuploadmulti.min.js"></script>
	
 
	
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/design.css" />
    <script src="js/vendor/modernizr.js"></script>
	<style>body{background:url('image/bg.jpg');}</style>
  </head>

<body>
  <header>
	<div><a href="../index.php">Store</a></div>
		<div class="sub_page">
			<div class="row"><img class='logo' src="image/logo.png" /></div>
			<span style="position:absolute; top:1px; left:80%;"><?php if(isset($_SESSION['SESS_ROLE'])){ echo '<font color="#CCC" size="1">'.$_SESSION['SESS_ROLE']. ' : <em>'.$_SESSION['SESS_FIRSTNAME']; ?></em> <a href="log-out.php">Log-out</a></font> <?php } ?><br>
						<input  style="position:absolute; top:70px; left:60px; cursor:pointer;" type="button" value="&larr; Previous" onClick="history.go(-1)">
						<input  style="position:absolute; top:70px; left:150px; cursor:pointer;" type="button" value="Reload Page" onClick="history.go(0)">
			</span>
		</div>
	</header>

    <div class="row">
      <div style="margin-top: -20px; position: relative; z-index: 1;" class="large-12 columns">
      	<div class="panel">
		<div class="row">
			<div class="nav-div">
				<ul id="menu">
					<li><a href="home.php">Home</a></li>
					<li><a href="buyer-list.php">Buyer List</a></li>
					<li><a href="#">Orders</a>
						<ul class="sub-menu">
							<li><a href="print-order.php">Ready For Delivery</a></li>
							<li><a href="new-order.php">New Orders</a></li>
							<li><a href="##">Recent Orders</a></li>
							<li><a href="##">Pending Orders</a></li>
							<li><a href="cancel-order.php">Cancelled Orders</a></li>
							<li><a href="##">Track Orders</a></li>
						</ul>
					</li>
					<li><a href="#">Products</a>
						<ul class="sub-menu">
							<li><a href="add-product.php2">Add Record</a></li>
							<li><a href="product-record.php">View Products Records</a></li>
							<!--<li><a href="product-inventory.php">Products Inventory</a></li>-->
							<li><a href="saleable-product.php">Salelable</a></li>
							<li><a href="least-saleable.php">Least Saleable</a></li>
							<li><a href="out-of-stock.php">Out of Stock</a></li>
							<!--<li><a href="upload.php">Upload Products</a></li>-->	
							<li><a href="return-product.php">Returns</a></li>
							<li><a href="posted-extra.php">Posted Extra</a></li>
							
						</ul>
					</li>
				<li><a href="##">Services</a>
						<ul class="sub-menu">
							<li><a href="customer-question.php">Complaints</a></li>
							<li><a href="comment-reviews.php">Comment Reviews</a></li>
							<li><a href="email.php">Send Email</a></li>
						</ul>
					
					</li>
				</ul>
			</div>
		</div>
		<center><form action='search.php' method='GET'><span  style="position:relative; top:-84px;"><input  style="width:200px;" type='text' name='search' placeholder="Search products.."><input style="position: relative; left: 155px; top: -53px; height: 37px; width:100px;" type='submit' name='submit' value='Search' ></span></form></center>
      	</div><!--ROW PANEL--->
      </div>
    </div>

	<center>    
		<div id="mulitplefileuploader">Upload</div>
		<div id="status"></div>
		<a href="add-product2.php">ADD NEW</a>
	</center>

	<script>

		$(document).ready(function()
		{

		var settings = {
			url: 'upload.php',
			method: "POST",
			allowedTypes:"jpg,png,gif,doc,pdf,zip",
			fileName: "myfile",
			multiple: true,
			onSuccess:function(files,data,xhr)
			{
				$("#status").html("<font color='green'>Upload is success</font>");
				
			},
			afterUploadAll:function()
			{
				alert("all images uploaded!!");
			},
			onError: function(files,status,errMsg)
			{		
				$("#status").html("<font color='red'>Upload is Failed</font>");
			}
		}
		$("#mulitplefileuploader").uploadFile(settings);

		});
	</script>

 
</body>
</html>
<?php }else{echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security.. </font></h2><br><a href="index.php">Go Back</a> </center>';} //isset?>