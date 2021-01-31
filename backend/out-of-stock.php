<?php

include('session.php');

if(isset($login_session)){



// This first query is just to get the total count of rows
$sql = "SELECT  COUNT(prod_id) FROM tbl_product ";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_row($query);
// Here we have the total row count
$rows = $row[0];
// This is the number of results we want displayed per page
$page_rows = 30;
// This tells us the page number of our last page
$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
if($last < 1){
	$last = 1;
}
// Establish the $pagenum variable
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
// This is your query again, it is for grabbing just one page worth of rows by applying $limit
$sql = "SELECT * FROM tbl_product ORDER BY prod_id DESC $limit";
$query = mysqli_query($con, $sql);
// This shows the user what page they are on, and the total number of pages
$textline1 = "Total Products : (<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
$paginationCtrls = '';
// If there is more than 1 page worth of results
if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	// Render the target page number, but without it being a link
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
    }
}


$list = '';
include('header.php');
echo  '<center><h5 height="200">OUT OF STOCK</h5></center>'; 
echo  '<div style="position:absolute; top:220px; left:20px;"> <a href="add-product.php">New Record |<input  class="add" type="image" src="image/addrecord.png" title="add new record" width="40" height="35" /></a> | View Page : '.$paginationCtrls.'<br><br><em>' . $textline2. ' &nbsp; &nbsp;'.$textline1.'</em></div>';
	

//include('header.php');
//echo  '<center><div><h5>PRODUCT RECORDS</h5></center>'; 
//echo  '<a href="add-product.php">New Record |<input  class="add" type="image" src="img/addrecord.png" title="add new record" width="40" height="35" /></a> | View Page : '.$paginationCtrls.'<br><br><em style="position:relative;">' . $textline2. ' &nbsp; &nbsp;'.$textline1.'</em></div>';
	

echo '<center><table class="tbl_records"><tr bgcolor="#D1D1D1" height="40"><th width="50"><small>Update</small></th><th width="50"><small>Delete</small></th><th>Picture</th><th>Product&nbsp;Name</th><th>SKU</th><th>Item Left</th><th>Listed<br>Quantity</th><th>Date Listed</th></tr>';
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
if(!empty($row)){

		$prod_id 			 = $row["prod_id"];
		$image				 = '../images/'.$row["photos"];
		$prod_name			 = $row["prod_name"];
		$original_quantity	 = $row["quantity"];
		$original_quantity2	 = $row["org_quantity"].'pcs its orginal quantity';
		$listed_quantity 	 = $row["listed_quantity"];
		$SKU			 	 = $row["SKU"];
		$description		 = $row["description"];
		//$links			 	 = $row["links"];
		$date			 	 = $row["datetime"];
		$remaining			= array_sum(explode(',',$listed_quantity));
		
		

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
		echo "<td title='$original_quantity2'>".$original_quantity."</td>";
		echo "<td title='$remaining total listed item'>";
		if($remaining > 0){
		echo $remaining;
		}else{ echo '<font color="red">0</font>';}//remaining
		
		echo "</td>";
		echo "<td title='$diff'>";
			if(!empty($date)){
			echo $date;
				}else {
					echo'<font color="red">Not listed</font>';
				}
		/**echo "</td>";
		if($links){
		
		echo "<td title='$links'><a href='".$links."'  target='_blank'>go to <font color='red' size='4'>e</font><font color='0063D1' size='4'>b</font><font color='F4AE01' size='4'>a</font><font color='86B818' size='4'>y</font></a></td>";
		}else{
		echo "<td title='$links'><font color='red'>Empty links</font></td>";
		}//links**/

		echo '</tr>';
		
		}
		
}//while loop


echo '</table></center>';
// Close your database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>	
<title>back end | saleable</title>
<style type="text/css">
body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
div#pagination_controls{font-size:16px; height:70px;}
div#pagination_controls > a{ color:#06F; }
div#pagination_controls > a:visited{ color:#06F; }
table
{
table-layout: fixed; 
width:1000px;
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
td:hover img{position:absolute; zoom:450%; }
</style>
</head>
<body>
		<div id="pagination_controls"><center><?php echo $paginationCtrls;}else{ echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security of this <br>System.. </font></h2><br><a href="index.php">Go Back</a> </center>';}?></center></div>

</body>
</html>