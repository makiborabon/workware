
<center>
<?php
						include("mysqli_connect.php");
						
						if(isset($_GET['page'])){
						
						$p_id =  mysqli_real_escape_string($con,$_GET['page']);
						$page_id = substr($p_id,0,strlen($p_id)-3);
						$tbl_code = substr($p_id,strlen($p_id)-3,strlen($p_id));

						$targetpage = "list_product2.php"; 

						$product_id = $page_id;
						
						include("process2.php");
							
						$query = "SELECT * FROM ".$table." WHERE prod_id=$product_id";
						$result = mysqli_query($con, $query);
						
						$row = mysqli_fetch_array($result);
						
						$id = $row["prod_id"];
						$image = "images/".$row["img_name"];
						$name = $row["image"];
						$price = $row["price"];
						$chk_price = strpos($price,',');
						if($chk_price<>""){
							$temp_price = explode(',',$price);
							$price = $temp_price[0];
						};
						$oldprice = $row["oldprice"];
						$details = $row["details"];
						$summary = $row['summary'];
						$sizes= $row['sizes'];
						$colors = $row['colors'];
						$howtouse = $row['howtouse'];
						$no_sub_cat = $row['no_sub_cat'];
						$warning = $row['warning'];
						$care_ins = $row['careinstruction'];
						$quantity = $row['quantity'];
						$discount =  $oldprice - $price;
						
						echo $name;
						
						?>
						<img src="<?php echo $image; ?>" height="400px"; width="400px";  style="display: block;">
						<?php
						}else{
						
						echo 'Process is being Unsset!';
						}
						?>
						
			</center>		