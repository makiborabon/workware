<html>
	<head>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.lazy.min.js"></script>
	<script>
	jQuery("img.lazy").lazy({
        delay: 2000
		});
	</script>

	<style>
	.container{position:relative; top: -21px; border:1px solid #d8d8d8;  border-top: 1px solid #FFF;}
	.item-container{float: left; height: 400px; color: black; text-align: center; padding: 10px 31px;}
	.item-img{position:relative; width:180px; height:180px; border:1px solid #d8d8d8; }
	.quick-view strong:first-child{}
	
	
	.item-container:hover{-webkit-box-shadow: 0px 0px 5px 5px rgba(204,204,204,1);
	 -moz-box-shadow: 0px 0px 5px 5px rgba(204,204,204,1);
	 box-shadow: 0px 0px 5px 5px rgba(204,204,204,1);
	 }
	</style>
	
	
	
	</head>
<?php
include('head.php');
echo'<div class="container">';

						 include('mysqli_connect.php');
						$p_id =  mysqli_real_escape_string($con,$_GET['page']);
						$page_id = substr($p_id,0,strlen($p_id)-3);
						$tbl_code = substr($p_id,strlen($p_id)-3,strlen($p_id));

						$targetpage = "list_product2.php"; 

						$product_id = $page_id;
						
						include("process4.php");
						
						$limit = 20; 
						
						$sql = "SELECT COUNT(*) as num FROM ".$table.$condition;
						$query = mysqli_query($con, $sql);
						$total_pages = mysqli_fetch_array($query);
						$total_pages = $total_pages['num'];
						
						$stages = 3;
						$page = $page_id;
						if($page){
							$start = ($page - 1) * $limit; 
						}else{
							$start = 0;	
							}	
						
						// Get page data
						$sql2 = "SELECT * FROM ".$table.$condition." LIMIT $start, $limit";
						$result = mysqli_query($con, $sql2);
						
						// Initial page num setup
						if ($page == 0){$page = 1;}
						$prev = $page - 1;	
						$next = $page + 1;							
						$lastpage = ceil($total_pages/$limit);		
						$LastPagem1 = $lastpage - 1;					
						
						
						$paginate = '';
						if($lastpage > 1)
						{	
							$paginate .= "<div class='paginate'>";
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
									$image = 'images/'.$row["img_name"];
									$name = $row["image"];
									$price = $row["price"];
									$chk_price = strpos($price,',');
									if($chk_price<>""){
										$temp_price = explode(',',$price);
										$price = $temp_price[0];
									};
									$oldprice = $row["oldprice"];
									$chk_oldprice = strpos($oldprice,',');
									if($chk_oldprice<>""){
										$temp_oldprice = explode(',',$oldprice);
										$oldprice = $temp_oldprice[0];
									};
									$details = $row["details"];
									$summary = $row['summary'];
									$sizes= $row['sizes'];
									$colors = $row['colors'];
									$category = $row['category'];
									$cut = strpos($category,"(");
									$cat_path = substr($category,0,$cut);
									$quantity = $row['quantity'];
									$discount =  $oldprice - $price;
									$prod_quantity = $row['prod_quantity'];
								
								echo'<div class="item-container">';
								?>
								<a href="view_product.php?page=<?php echo  $id.$tbl_code; ?>">
								<?php
								echo'<img  class="item-img" class="lazy-image" src="'.$image.'" >';
								//echo '<img style = "position:relative; width:180px; height:180px;" src = "'.$image.'"/>';
								//echo'<img  id="columns" class="lazy" style = "position:relative; width:180px; height:180px;" src="img/ajax-loader.gif"; data-src = "'.$image.'"/>';
								echo '<br><p>&pound;16.99<br>was &pound;40.99<br>remaining : 500pcs<br>  </a>'; include("ratings.php"); '</p>';
								//echo '<br><div><small><a href="dialogbox.php">Quick View</a></small></div>';
								?>
								<br>
								<a href="" target="_blank" onclick="openMyModal('view-item-modal.php?page=<?php echo  $id.$tbl_code; ?>'); return false;"><small>Quick View</small></a>
								<?php
								echo'</div>' ;
								
								}//while loop	

					 echo "<div class='page_up'><h6>".$paginate . "</h6></div>";
echo'</div>';	
;			 
?>
<script>
var modalWindow = {
	parent:"body",
	windowId:null,
	content:null,
	width:null,
	height:null,
	close:function()
	{
		$(".modal-window").remove();
		$(".modal-overlay").remove();
	},
	open:function()
	{
		var modal = "";
		modal += "<div class=\"modal-overlay\"></div>";
		modal += "<div id=\"" + this.windowId + "\" class=\"modal-window\" style=\"width:" + this.width + "px; height:" + this.height + "px; margin-top:-" + (this.height / 2) + "px; margin-left:-" + (this.width / 2) + "px;\">";
		modal += this.content;
		modal += "</div>";	

		$(this.parent).append(modal);

		$(".modal-window").append("<a class=\"close-window\"></a>");
		$(".close-window").click(function(){modalWindow.close();});
		$(".modal-overlay").click(function(){modalWindow.close();});
	}
};

</script>

<style>
.modal-overlay
{
	position:fixed;
	top:0;
	right:0;
	bottom:0;
	left:0;
	height:100%;
	width:100%;
	margin:0;
	padding:0;
	background:#fff;
	opacity:.75;
	filter: alpha(opacity=75);
	-moz-opacity: 0.75;
	z-index:101;
}
.modal-window
{
	position:fixed;
	top:50%;
	left:50%;
	margin:0;
	padding:0;
	z-index:102;
}
.close-window
{
	position:absolute;
	width:32px;
	height:32px;
	right:-70px;
	top:8px;
	background:transparent url('img/icon.png') no-repeat scroll right top;
	text-indent:-99999px;
	overflow:hidden;
	cursor:pointer;
	opacity:.5;
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
}
.close-window:hover
{
	opacity:.99;
	filter: alpha(opacity=99);
	-moz-opacity: 0.99;
}


</style>
<script>
var openMyModal = function(source)
{
	modalWindow.windowId = "myModal";
	modalWindow.width = 900;
	modalWindow.height = 405;
	modalWindow.content = "<iframe width='980' height='605' frameborder='0' scrolling='no' allowtransparency='true' src='" + source + "'></iframe>";
	modalWindow.open();
};
</script>

</body>
</html>
