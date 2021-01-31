<?php
//This application is developed by www.webinfoipedia.com. || Copyright 2011.
//For more examples related PHP visit www.webinfoipedia.com and enjoy demo and free download..


//connect the database
include("mysqli_connect.php");

//Enter the headings of the excel columns
$contents="PRODUCT NAME, SKU, COLOUR, SIZES, STYLE, LISTED, ORIGINAL QUANTITY, ITEM LEFT,  DESCRIPTION, QUALITY, DATE LISTED, EBAY LINKS\n";

//Mysql query to get records from datanbase
//You can customize the query to filter from particular date and month etc...Which will depends your database structure.
$sql= "SELECT  prod_name, sizes, colour, style, original_quantity, original_quantity2, listed_quantity, quality, SKU, description,  links, date  FROM tbl_inventory";
$query = mysqli_query($con, $sql);
//While loop to fetch the records
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){

$contents.=$row['prod_name'].",";
$contents.=$row['SKU'].",";
$contents.=$row['colour'].",";
$contents.=$row['sizes'].",";
$contents.=$row['style'].",";
$contents.=$row['listed_quantity'].",";
$contents.=$row['original_quantity2'].",";
$contents.=$row['original_quantity'].",";
$contents.=$row['description'].",";
$contents.=$row['quality'].",";
$contents.=$row['date'].",";
$contents.=$row['links'].",";
$contents.=$row['SKU']."\n";

}

// remove html and php tags etc.
$contents = strip_tags($contents); 

//header to make force download the file
header("Content-Disposition: attachment; filename=Record ".date('d-m-Y').".csv");
print $contents;

//For more examples related PHP visit www.webinfoipedia.com and enjoy demo and free download..
?>