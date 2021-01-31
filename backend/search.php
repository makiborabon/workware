<?php 
include('session.php');

if(isset($login_session)){

	include('header.php');
	echo  '<center><h5 style="position:relative; top:-120px;" height="200">PRODUCT RECORDS</h5></center>'; 
	$button = $_GET ['submit'];
	$search = $_GET ['search']; 
	  
	if(strlen($search)<=1)
	echo "Search term too short";
	else{
	//echo "You searched for <b>$search</b> <hr size='1'></br>";

		
	$search_exploded = explode (" ", $search);

	foreach($search_exploded as $search_each)
	{
	$x = "";
	$x++;
	$construct = "";  
	if($x==1)

	//(`prod_name` LIKE '%".search_each."%') OR  (`description` LIKE '%".$search_each."%')")
	
	$construct .="(`prod_name` LIKE '%".$search_each."%') OR  (`SKU` LIKE '%".$search_each."%') OR  (`description` LIKE '%".$search_each."%')";
	else
	$construct .="AND description LIKE '%$search_each%'";
		
	}
	  
	$constructs ="SELECT * FROM tbl_product WHERE $construct ORDER BY prod_id DESC";
	$run = mysqli_query($con,$constructs);
		
	$foundnum = mysqli_num_rows($run);

	if ($foundnum==0)
	echo "<center><h4><font color='red'>Sorry,</font></h4> there are no matching result for <font color='#00F0F0F'>$search</font>.</br></br> 
	Try more general words. Please check your spelling</center>";
	else
	{ 
	  

	  
	$per_page = 20;
	$start ="";
	//$start = $_GET['start'];
	$max_pages = ceil($foundnum / $per_page);
	if(!$start)
	$start=0; 


	echo "<center>".$foundnum." results found!</center>";

	//include('header.php');
	//echo  '<center><div><h5>PRODUCT RECORDS</h5></center>'; 
	//echo  '<a href="add-product.php">New Record |<input  class="add" type="image" src="img/addrecord.png" title="add new record" width="40" height="35" /></a> | View Page : '.$paginationCtrls.'<br><br><em style="position:relative;">' . $textline2. ' &nbsp; &nbsp;'.$textline1.'</em></div>';
	$sql = "SELECT * FROM tbl_product WHERE $construct LIMIT $start, $per_page";
	$query = mysqli_query($con, $sql);	

echo '<table class="tbl_records"><tr bgcolor="#D1D1D1" height="40"><th width="50"><small>Update</small></th><th width="50"><small>Delete</small></th><th>Picture</th><th>Product&nbsp;Name</th><th>SKU</th><th>Colours</th><th>Sizes</th><th>Style</th><th>Listed<br>Quantity</th><th>Item Left</th><th>Description</th><th>Date Listed</th></tr>';
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
if(!empty($row)){

		$prod_id 			 = $row["prod_id"];
		$image				 = '../image-list/'.$row["photos"];
		$prod_name			 = $row["prod_name"];
		$sizes 				 = $row["sizes"];
		$colour				 = $row["colour"];
		$style	 			 = $row["designs"];
		$original_quantity	 = $row["quantity"];
		$original_quantity2	 = $row["org_quantity"].'pcs its orginal quantity';
		$listed_quantity 	 = $row["listed_quantity"];
		$quality			 = $row["quality"];
		$SKU			 	 = $row["SKU"];
		$description		 = $row["description"];
		//$links			 	 = $row["links"];
		$date			 	 = $row["datetime"];
		
		$chk_size			= strpos($sizes,',');
		$chk_color			= strpos($colour,',');
		$chk_style 			= strpos($style,',');
		$chk_list 			= strpos($listed_quantity,',');
		
		$remaining			=array_sum(explode(',',$listed_quantity)).' total listed item';
	
		$datetime1 = date_create(date('d - M - Y'));
		$datetime2 = date_create($date);
		$interval = date_diff($datetime1, $datetime2);
		$diff = $interval->format('LISTED %R%a DAY(S) AGO');
		
		
	
		echo '<tr bgcolor="#D1D1D1" class="main-tr">';
		echo '<td><a href="edit-product.php?id='.$prod_id.'"><input type="image" src="image/pencil.png" title="Edit product details." width="40" height="35" /></a></td>';
		echo '<td><a href="delete-product.php?id='.$prod_id.'"><input type="image" src="image/trash.png" title="remove"  width="30" height="25" onclick=\'return confirm("Are you sure");\' /></a></td>';
		echo '<td title="'.$image.'"><img class="img" style=" width:40px; height:40px;" src="'. $image. '"/></td>';
		echo "<td title='$prod_name'>".$prod_name."</td>";
		echo "<td title='$SKU'>".$SKU."</td>";
		
		echo "<td title='$colour'>";

		if($chk_color<>""){
									$temp = explode(',',$colour);
									
									echo "<select>";
									if($chk_color<>""){
										foreach($temp as $color){
										
										echo "<option>".trim($color)."</option>";
										$ctr_colour++;
										}
										echo "</select><br />";
									}else{
										foreach($temp as $color){
										
										echo "<option>".trim($color)."</option>";
										$ctr_colour++;
										}
										echo "</select><br />";
									}
									
								}else if($colour==""){}else{
									echo $colour.'<br>';
								}
				if(empty($colour)){ echo '<font color="red">none</font>';}				
								
		
		"</td>";
		
		echo "<td title='$sizes'>";
		if($chk_size<>""){
									$temp2 = explode(',',$sizes);
									
									echo "<select>";
									if($chk_price<>""){
										foreach($temp2 as $size){
										
										echo "<option>".trim($size)."</option>";
										$ctr_size++;
										}
										echo "</select><br />";
									}else{
										foreach($temp2 as $size){
										
										echo "<option>".trim($size)."</option>";
										$ctr_size++;
										}
										echo "</select><br />";
									}
									
								}else if($sizes==""){}else{
									echo $sizes.'<br>';
								}
				if(empty($sizes)){ echo '<font color="red">none</font>';}			
		"</td>";
		
		echo "<td title='$style'>";
 
		if($chk_style<>""){
									$temp3 = explode(',',$style);
									
									echo "<select>";
									if($chk_price<>""){
										foreach($temp3 as $styles){
										
										echo "<option value=''>".trim($styles)."</option>";
										$ctr_style++;
										}
										echo "</select><br />";
									}else{
										foreach($temp3 as $styles){
										
										echo "<option value=''>".trim($styles)."</option>";
										$ctr_style++;
										}
										echo "</select><br />";
									}
									
								}else if($style==""){}else{
									echo $style.'<br>';
								}
			if(empty($style)){ echo '<font color="red">none</font>';}
		"</td>"; 
		
		echo "<td title='$remaining'>";
		if($chk_list<>""){
									$temp4 = explode(',',$listed_quantity);
									
									echo "<select>";
									if($chk_price<>""){
										foreach($temp4 as $listed){
										
										echo "<option value=''>".trim($listed)."</option>";
										$ctr_list++;
										}
										echo "</select><br />";
									}else{
										foreach($temp4 as $listed){
										
										echo "<option value=''>".trim($listed)."</option>";
										$ctr_list++;
										}
										echo "</select><br />";
									}
									
								}else if($listed_quantity==""){}else{
									echo $listed_quantity.'<br>';
								}
					if($listed_quantity == 0){ echo '<font color="red">0</font>';}			
		"</td>";
		
		echo "<td title='$original_quantity2'>";
			if($original_quantity == 0){ echo '<font color="red">0</font>';}
				else{ echo $original_quantity;}
		echo "</td>";
				
		echo "<td title='$description'>".$description."</td>";
		
		echo "<td title='$diff'>";
			if(!empty($date)){
			echo $date;
				}else {
					echo'<font color="red">Not listed</font>';
				}
		echo "</td>";
		/**echo "<td title='$links'>";
			if($links){
				echo "<a href='".$links."'  target='_blank'>go to <font color='red' size='4'>e</font><font color='0063D1' size='4'>b</font><font color='F4AE01' size='4'>a</font><font color='86B818' size='4'>y</font></a></td>";
				}else{
			echo'<font color="red">Empty links</font>';
			}
		echo"</td>";**/
		echo '</tr>';
		
		}
		
}//while loop


	echo '</table>';

	echo '<center>'; 
	$prev = $start - $per_page;
	$next = $start + $per_page;
						   
	$adjacents = 3;
	$last = $max_pages - 1;
	  
	if($max_pages > 1)
	{   
	//previous button
	if (!($start<=0)) 
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$prev'>Prev</a> ";    
			  
	//pages 
	if ($max_pages < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
	{
	$i = 0;   
	for ($counter = 1; $counter <= $max_pages; $counter++)
	{
	if ($i == $start){
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
	}
	else {
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
	}  
	$i = $i + $per_page;                 
	}
	}
	elseif($max_pages > 5 + ($adjacents * 2))    //enough pages to hide some
	{
	//close to beginning; only hide later pages
	if(($start/$per_page) < 1 + ($adjacents * 2))        
	{
	$i = 0;
	for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
	{
	if ($i == $start){
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
	}
	else {
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
	} 
	$i = $i + $per_page;                                       
	}
							  
	}
	//in middle; hide some front and some back
	elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
	{
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
	 
	$i = $start;                 
	for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
	{
	if ($i == $start){
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
	}
	else {
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";
	}   
	$i = $i + $per_page;                
	}
									  
	}
	//close to end; only hide early pages
	else
	{
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=0'>1</a> ";
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a> .... ";
	 
	$i = $start;                
	for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
	{
	if ($i == $start){
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a> ";
	}
	else {
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a> ";   
	} 
	$i = $i + $per_page;              
	}
	}
	}
			  
	//next button
	if (!($start >=$foundnum-$per_page))
	echo " <a href='search.php?search=$search&submit=Search+source+code&start=$next'>Next</a> ";    
	}   
	echo "</center><br><br>";

	} //page


	} 

}else{echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security of this <br>System.. </font></h2><br><a href="index.php">Go Back</a> </center>';}//isset
?>

<html>
<head>	
	<title>back end | product-record</title>
<style type="text/css">
body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
div#pagination_controls{font-size:16px; height:70px;}
div#pagination_controls > a{ color:#06F; }
div#pagination_controls > a:visited{ color:#06F; }
table
{
table-layout: fixed; 
width:100%;
margin-top:60px;

}
.tbl_records, td
{
overflow: hidden; 
text-overflow: ellipsis;
white-space:nowrap;
text-align:center;
color:blue;
}

.main-tr:hover{background-color:#BECCDA; width:100%;}
.button{
position: absolute;
top: 310px;
left: 20px;
width: 124px;
height: 25px;
padding: 0px;
border-radius: 5px;
}
.print{
position:absolute;
top: 112px;
left: 20px;
width: 124px;
height: 27px;
padding: 0px;
border-radius: 5px;
margin-top: 5px;
}

td:hover img{position:absolute; zoom:450%; }
</style>
</head>
<body>

</body>
</html>