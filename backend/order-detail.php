<?php 
include('session.php');

if(isset($login_session)){


?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>backend | new order</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<style>
	
		.large-6{background:white;}
		.callout{height:300px; overflow-y: scroll;}
		
	</style>
  
  </head>
  <body>    
<?php  include('header.php'); ?>
	<div class="row">
	
	  <div class="large-12 columns" style="width: 97%; margin-top:-150px;">
		<div class="panel">
			<div class="row" >
				<div class="row">
							  <?php
								if(isset($_GET['id'])){
								
								$orderID = $_GET['id'];
								$status ="";
								 
								
								$Query = "SELECT transactions.status, transactions.product_id_array, tbl_product.prod_id, tbl_product.prod_name, tbl_product.category  FROM transactions
									INNER JOIN tbl_product
									ON transactions.product_id_array=tbl_product.prod_id  AND tbl_product.prod_name = '$orderID' AND transactions.status = '$status' ";
								$result = mysqli_query($con, $Query);
								
								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								$prod_name		= $row['prod_name'];
								$category		= $row['category'];
								$id 			= $row['prod_id'];
								
								echo '<center><h5>ORDER DETAIL</h5></center>';
								echo '<h5> <b>CATEGORY : </b> &nbsp;'.ucfirst($category).'</h5>
								     <div class="large-12 medium-12 columns">
									<div class="callout panel">
								';
							
								echo '<table>
								<tr bgcolor="#D1D1D1"><th>PRODUCT&nbsp;NAME<th>SKU</th><th>COLOUR</th><th>SIZE</th><th>STYLE</th><th>ORDER&nbsp;DATE</th><th>STATUS</th></tr>
										<tr>
											<td width="350">'.$prod_name.'</td>
											<td width="50">ADS-123</td>
											<td width="70">NAVY BLUE</td>
											<td width="70">UK 10</td>
											<td width="70">CAMMO</td>
											<td width="70">NOVEMBER 29, 2014</td>											
											<td width="120"><form action="delivery-status.php" method="POST"> <input type="hidden" value="'.$id.'" name="id"><select name="status" onchange="this.form.submit()"><option value="" >SELECT</option><option value="complete">Complete</option><option value="pending">Pending</option><option value="cancel">Cancel</option></select></form></td>
										</tr>						
								</table>';//end of table
								}
								}//isset
									echo '<a href="print-order.php?id='.$prod_name.'">Go to Print Order</a>';
							  ?>
							 </div>
						  </div>
					  </div>
				   </div>					
				</div>
			</div>
		</div>
	</div>
	<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
<?php }else{echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security.. </font></h2><br><a href="index.php">Go Back</a> </center>';} //isset?>