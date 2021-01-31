<?php 
include('session.php');

if(isset($login_session)){


?>
<!doctype html>
<html lang="en">
    <TITLE> backend / add product</TITLE>
	<head>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'></script>
	<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
	<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
	<script type="text/javascript">window.onload = function(){new JsDatePick({useMode:2,target:"inputField",dateFormat:"%d-%M-%Y"});};</script>
    <script language="javascript">
        function addRow(tableID) {
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;

                }
            }
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }
 
    </script>
	
	<script>
	$(document).ready(function(){
		$("#more").hide();

	  $("#show").click(function(){
		$("#more").slideDown();
	  });
	});
	</script>
	
	
	
	</head>
<BODY>
<?php include('header.php');?>
<?php


	$err = "<font color='red'> failed to upload</font>";
	
if($_SERVER["REQUEST_METHOD"] == "POST"){

/* if file uploader in html form is not empty */
	if(isset($_FILES['file'])) {
	
			/* file name of your image */
			$filename = $_FILES['file']['name'];
			
			/* check if the filename is already exist in folder */
			$exist = file_exists($filename);
			
			echo $exist;
		/* check if the filename is already exist in folder */
		if(!$exist){
				/* the temp name of the file will be upload somewhere in wamp */
				$tempname = $_FILES['file']['tmp_name'];
				
				$target = '../photos/'.$_FILES['file']['name'];
				
				$prod_name  		 = $_POST['prod_name'];
				$quantity 			 = $_POST['quantity'];
				$org_quantity 		 = $_POST['org_quantity'];
				//if($quantity != $org_quantity){echo '<script> alert(\' Quantity are Not Match!\'); window.history.back(-1); return false;</script>';}
				
				$quality 			 = $_POST['quality'];
				$SKU 				 = $_POST['SKU'];
				$description	 	 = $_POST['description'];
				$category 			 = $_POST['category'];
				$sub_category 		 = $_POST['sub_category'];
				
				$howToUse			 = $_POST['howToUse'];
				$careInstruct 		 = $_POST['careInstruct'];
				$warning			 = $_POST['warning'];
				
				$size 	  			 = $_POST['size'];
				$colour 			 = $_POST['colour'];
				$style	   			 = $_POST['style'];
				$price	   			 = $_POST['price'];
				$listed_quantity 	 = $_POST['listed_quantity'];
				
				$size2 				 = implode(',',$size);
				$colour2 			 = implode(',',$colour);
				$style2 			 = implode(',',$style);
				$price2 			 = implode(',',$price);
				$listed_quantity2  	 = implode(',',$listed_quantity);
				$date 				 = $_POST['date'];

				/*move uploader file $temname variable is the tempname of the images and move into the $target! */
				move_uploaded_file($tempname , $target);
				echo '<script type="text/javascript"> alert("Successfully Uploaded."); </script>';
				
				/* insert the path of the images in database */
				
				$sql="INSERT INTO tbl_product (photos, prod_name, quantity, org_quantity, quality, SKU, description, category, sub_category, howToUse, careInstruction, warning, sizes, colour, designs, price, listed_quantity, datetime)
				VALUE
				('$target', '$prod_name', '$quantity', '$org_quantity', '$quality', '$SKU', '$description', '$category', '$sub_category', '$howToUse', '$careInstruct', '$warning', '$size2', '$colour2', '$style2', '$price2', '$listed_quantity2', '$date')";
				$query = mysqli_query($con, $sql);
				
				if (!$query)
				{
					//echo "There is error on your sql";
					die('Error: '.$sql . mysqli_error($con));
				}
				mysqli_close($con);
				/* End of inserting */
				}/* check if file is exist condition end tag */
		
		/* if the file name exist the script condition goes here */
			else{
				echo "file exist";
			}
	}/* if file uploader in html form is not empty End */ 
	
	/* if thereis error while uploading this error msg will appear */
	else {
		echo "failed to upload";
	}
}/* if server request method the script goes here End */
		

?>

<script type="text/javascript">
$(document).ready(function() {
	$("#SKU").keyup(function (e) {
	
		//removes spaces from SKU
		$(this).val($(this).val().replace(/\s/g, ''));
		
		var SKU = $(this).val();
		if(SKU.length < 4){$("#user-result").html('');return false;}
		
		if(SKU.length >= 4){
			$("#user-result").html('<img src="img/ajax-loader.gif" />');
			$.post('SKU-ajax.php', {'SKU':SKU}, function(data) {
			  $("#user-result").html(data);
			  return false;
			});
		}
	});	
});
</script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>
$( "#shower" ).change(function() {

	var hider = $('#hider').val();
	var shower = $('#shower').val();
	if(shower != hider ){
	
  $( "#out" ).show("slow");
	return false;
	}else{
	$( "#out" ).hide(2000);
	}
});
</script>




</HEAD>
<BODY>
	<form method="POST" action="" enctype='multipart/form-data'>

	<center>
		<table width=670px" >
			<tr><td><input class="file" name='file' id = 'file' type='file' required></td><tr>
			<tr><td><input  required type="text" name="prod_name" placeholder="Product Name"/></td></tr>
			<tr><td><input id="hider" width="100"required type="text" name="quantity"  pattern="[0-9.]+" placeholder="Original Quantity"><input id="shower" width="100" required type="text" name="org_quantity"  pattern="[0-9.]+" placeholder="Confirm Original Quantity"><span  id="out" style="display:none;">  Please make sure to confirm quantity values</span></td></tr>
			<tr><td><div><input required type="text" id="SKU" name="SKU" maxlength="15" placeholder="SKU"/><span id="user-result" style="float:right; position:relative; top:-43px; left:-10px;"></span></div></td></tr>
			<tr><td><input required type="text" name="quality" placeholder="Quality   / Example: brand new"/></td></tr>
			<tr><td><textarea required rows="4" cols="37" type="text" name="description" placeholder="Description"/></textarea></td></tr>	
			<tr><td><input type="text" name="category" placeholder="Category"/></td></tr>
			<tr><td><input type="text" name="sub_category" placeholder="Sub-Category"/></td></tr>
			
			<tr><td><strong>Click Show For More Details</strong><small> (optional)<small><td><tr>
			<tr><td>
				<div id="more">
					<input type="text" name="howToUse" placeholder="How to Use" >
					<input type="text" name="careInstruct" placeholder="Care Instructions">
					<input type="text" name="warning" placeholder="Warning">
				</div>
			</td></tr>
			<tr><td><p id="show"><font color="#008CBA" style="cursor:pointer; font-weight:bold;">Show</font></p></td></tr>
						

		</table>
   
			   <table id="dataTable" width="670px" >
					<button type="button" onclick="addRow('dataTable')" />Add Row</button>
					<button type="button" onclick="deleteRow('dataTable')" />Delete Row</button>
					<tr>
						<td><input type="checkbox" name="chk"/></td>
						<td><input type="text" name="size[]" placeholder="Size"></td>
						<td><input type="text" name="colour[]" placeholder="Colour"/></td>
						<td><input type="text" name="style[]" placeholder="Style"/> </td>
						<td><input type="text" name="price[]" placeholder="Price"/> </td>
						<td><input type="text" name="listed_quantity[]" placeholder="Listed Quantity"></td>
					</tr>
				</table>
				<input style="width:110px;" type="text" name="date" id="inputField" placeholder="Date" />
				<input style="margin-bottom:170px;"type="submit" class="button" name="submit" value="Submit">

	</center>
	<form>
</BODY>
</HTML>

<?php }else{echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security.. </font></h2><br><a href="index.php">Go Back</a> </center>';} //isset?>