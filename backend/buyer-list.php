<?php
include('session.php');

if(isset($login_session)){


// Script and tutorial written by Adam Khoury @ developphp.com
// Line by line explanation : youtube.com/watch?v=T2QFNu_mivw
include("mysqli_connect.php");
// This first query is just to get the total count of rows
$sql = "SELECT  COUNT(date) FROM buyer_list";
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
$sql = "SELECT * FROM buyer_list  ORDER BY date DESC $limit";
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
echo  '<center><h5 height="200">List of Customer </h5></center>'; 
echo  '<div style="position:absolute; top:220px; left:20px;"> View Page : '.$paginationCtrls.'<br><br><em>' . $textline2. ' &nbsp; &nbsp;'.$textline1.'</em>';
echo '<form name = "myform" method = "POST" action="Buyer_ListExcel.php" ><input class="button" type=submit name="submit" value="SEND REPORT" ></form>';

echo '<button class="print" onclick="printp()">Print this page</button>

<script>
function printp() {
    window.print();
}
</script>';	  
	  
echo '</div>';

echo '<table class="tbl_records"><tr bgcolor="#D1D1D1" height="40"><th>Name</th><th>Email</th><th>Address_1</th><th>Address_2</th><th>Postcode</th><th>Town</th><th>State</th><th>Country</th><th>Date</th></tr>';
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
if(!empty($row)){

		$fullname	 = $row["name"];
		$email		 = $row["email"];
		$address_1 	 = $row["address_1"];
		$address_2 	 = $row["address_2"];
		$state 	 = $row["state"];
		$town		 = $row["town"];
		$country	 = $row["country"];
		$postcode		 = $row["postcode"];
		$status 	 = $row["status"];
		$date 	 = $row["date"];

		echo '<tr bgcolor="#D1D1D1" class="main-tr">';
		//echo '<td><a href="edit-product.php?id='.$cus_id .'"><input type="image" src="img/pencil.png" title="Edit product details." width="40" height="35" /></a></td>';
		//echo "<td title='$cus_id'>".$cus_id."</td>";
		echo "<td title='$fullname'>".$fullname."</td>";
		echo "<td title='$email'>".$email."</td>";
		echo "<td title='$address_1'>".$address_1."</td>";
		echo "<td title='$address_2'>".$address_2."</td>";
		echo "<td title='$postcode'>".$postcode."</td>";
		echo "<td title='$town'>".$town."</td>";
		echo "<td title='$state'>".$state."</td>";
		echo "<td title='$country'>".$country."</td>";
		echo "<td title='$date'>".$date."</td>";
		echo '</tr>';
		
		}
		
}//while loop

echo '</table>';
// Close your database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>	
<title>back end | buyer-list</title>
<style type="text/css">
body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
div#pagination_controls{font-size:16px; height:70px;}
div#pagination_controls > a{ color:#06F; }
div#pagination_controls > a:visited{ color:#06F; }
table
{
table-layout: fixed; 
width:100%;
margin-top:0px;
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
width: 124px;
height: 25px;
padding: 0px;
border-radius: 5px;
margin-top: 5px;
}
.print{
position:relative;
top: -62px;
width: 124px;
height: 27px;
padding: 0px;
border-radius: 5px;
left: 130px;
}
</style>
</head>
<body>
		<div id="pagination_controls"><center><?php echo $paginationCtrls;  }else{echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security of this <br>System.. </font></h2><br><a href="index.php">Go Back</a> </center>';}//isset?></center></div>

</body>
</html>