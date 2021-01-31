<?php
error_reporting(0);

session_start();
include("mysqli_connect.php");

	echo  '<center><h5 height="200">PRODUCT RECORDS</h5></center>'; 
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
	
	$construct .="(`prod_name` LIKE '%".$search_each."%') ";
	else
	$construct .="AND price LIKE '%$search_each%'";
		
	}
	  
	$constructs ="SELECT * FROM tbl_product WHERE $construct ORDER BY prod_id DESC";
	$run = mysqli_query($con,$constructs);
		
	$foundnum = mysqli_num_rows($run);

	if ($foundnum==0)
	echo "Sorry, there are no matching result for <b>$search</b>.</br></br> 
	Try more general words. Please check your spelling";
	else
	{ 
	  

	  
	$per_page = 20;
	$start ="";
	$start = $_GET['start'];
	$max_pages = ceil($foundnum / $per_page);
	if(!$start)
	$start=0; 


	echo "<center>".$foundnum." results found!</center>";

	//include('header.php');
	//echo  '<center><div><h5>PRODUCT RECORDS</h5></center>'; 
	//echo  '<a href="add-product.php">New Record |<input  class="add" type="image" src="img/addrecord.png" title="add new record" width="40" height="35" /></a> | View Page : '.$paginationCtrls.'<br><br><em style="position:relative;">' . $textline2. ' &nbsp; &nbsp;'.$textline1.'</em></div>';
	$sql = "SELECT * FROM tbl_product WHERE $construct LIMIT $start, $per_page";
	$query = mysqli_query($con, $sql);	


while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){


		$prod_id 			 = $row["prod_id"];
		$image				 = $row["photo"];
		$prod_name			 = $row["prod_name"];
		$sizes 				 = $row["sizes"];
		$colour				 = $row["colour"];
	
}//while loop


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