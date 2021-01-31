<?php

$prod_id = $_REQUEST['prod_id'];


if(preg_match("/[^a-z0-9]/",$prod_id))
{
print "<span style=\"color:red;\">Username contains illegal charaters.</span>";
exit;
}
include("mysqli_connect.php");

$data=mysqli_query($con,"SELECT * FROM tbl_product where  prod_id ='$prod_id'");
if(mysqli_num_rows($data)>0)
{
print "<span style=\"color:green;\">Correct!</span>";
}
else
{
print "<span style=\"color:red;\">Invalid Product ID!</span>";
}
?>