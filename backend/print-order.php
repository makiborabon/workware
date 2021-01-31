<html>

<head>
<style>
table{ font-family: 'Open Sans', Arial, Helvetica, sans-serif;
line-height:1em; font-size: 70%; height: 0px;}
</style>
</head>

<body>
<?php
	 include('mysqli_connect.php');
	 
								$Query = "SELECT *  FROM tbl_product";
								$result = mysqli_query($con, $Query);
								
								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								$prod_name		= $row['prod_name'];
								$category		= $row['category'];
								$id 			= $row['prod_id'];
								
								echo '<center> <div>';
								echo '<table border="1" style="margin-top: 6.5px;">
								
								<tr>
									<td width="300">
									<b><small>Sold : 12/14/14 </small> </b>
									<br>
									<b>Order # : 0052332</b>  
									<br>
									<b>Name : </b>'.$prod_name.'
									<br>
									<b>SKU : ADS1234xS</b>
									<br>
									<b>Quantity : <font size="3">3</font></b>
							
									
									<br>
									</td>
									<td width="300">
									<b>Buyer : </b> Miguel De Villa 
									<br>
									<b>Address : </b>#123 Sexy Round, London
									<br>
									<b>Carrier : </b> Royal Mail 
									<br>
									<b>P & P : </b> &pound;3 
									<br>
									<b>Price : &pound;20</b>
									<br>
									<b>Total : </b> &pound;60 
									
									</td>										
									
								</tr>						
								</table></div>';//end of table
								}
									echo '<input style="position:relative; top:100px;" cursor:pointer;" type="button" value="&larr; Back" onClick="history.go(-1)"><br><br>';
									echo '<button onclick="window.print();" style="position:relative; top:100px;">Print Order</button></center>';
									echo '<button onclick="window.print();" style="position:relative; top:120px;">Remove</button></center>';
									
?>
							  
</body>
</html>							  