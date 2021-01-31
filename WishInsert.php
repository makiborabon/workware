<?php
include('connect/connection.php');
if(isset($_POST['pid2']))
{

	$pid = $_POST['pid2'];
	$name = $_POST['name'];


	if(mysql_query("INSERT INTO tbl_wishlist(prod_id, name)
		(select prod_id, image from tbl_product where prod_id ='$pid' AND image ='$name')")){
			echo 'bawi';
		}else{ echo 'failed to insert';}

}else{ echo 'mali';}
mysql_close();

?>
<script type="text/javascript">
					alert("Successfully Added to Your WishList!");
					document.location= "MyAccount.php";
</script>
