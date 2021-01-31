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
<?php include('header.php'); ?>
	<div class="row">
	
	  <div class="large-12 columns" style="width:100%; margin-top:-150px;">
		<div class="panel">
			<div class="row">
				<div class="row">
				<h5>CONFIRMATION AREA</h5>
					 <div class="large-12 medium-12 columns">
						<center> <p><b><h5>CANCELED ORDER(S)</h5></b> </p></center>
						 <table>
						  <tr style="background:#D1D1D1; position:absolute; top:42px; width:97.1%; left: 14px;"><th width="750">Transactions&nbsp;ID <th>Status</th></tr>
						 </table>
						<div class="callout panel">
						  <table>
						  <?php 
							
							$wellington = "wellington";
							$status ="cancel";
							
							$Query = "SELECT transactions.status, transactions.product_id_array, tbl_product.prod_name, tbl_product.category  FROM transactions
									INNER JOIN tbl_product
									ON transactions.product_id_array=tbl_product.prod_id  AND transactions.status = '$status' ";
							$result = mysqli_query($con, $Query);
							
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
							
							$id 			= $row['product_id_array'];
							$prod_name		= $row['prod_name'];
							$category		= $row['category'];
							
							echo '<table>
									<tr bgcolor="#D1D1D1" >
										
										<td width="720"><a href="order-detail.php?id='.$prod_name.'">'.$prod_name.'</a></td>
				
									
										<td width="120"><form action="delivery-status.php" method="POST"> <input type="hidden" value="'.$id.'" name="id"><select name="status" onchange="this.form.submit()"><option value="" >SELECT</option><option value="complete">Complete</option><option value="pending">Pending</option><option value="cancel">Cancel</option></select></form></td>
									
									</tr>
							
							
							</table>';//end of table
							}
						  ?>
						  
						  </table>
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
</html>