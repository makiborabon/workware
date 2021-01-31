<?php
/* include your connection of your database*/
include("connect/connection.php");
/* create a table if not exist */
	

				$sql = "SHOW TABLES FROM $database";
				$result = mysql_query($sql);

				if (!$result) {
					echo "DB Error, could not list tables\n";
					echo 'MySQL Error: ' . mysql_error();
				
				}

				while ($row = mysql_fetch_row($result)) {
					foreach($row as $row){
						if(!file_exists('images/'.$row)){
							@mkdir("images/$row/", 0777);
						}
					}
				}
				
				


/* if server request method the script goes here */
if($_SERVER["REQUEST_METHOD"] == "POST"){
$table = $_POST['table'];
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
				
				/* target is the path where you want to move your images */
				$target = "images/".$table."/". $_FILES['file']['name'];
				$img_name = $_POST['img_name'];
				$price = $_POST['price'];
				$oldprice = $_POST['oldprice'];
				$colors = $_POST['colors'];
				$quantity = $_POST['quantity'];
				$sizes = $_POST['sizes'];
				$details = $_POST['details'];
				$designs = $_POST['designs'];
				$summary = $_POST['summary'];
				$howtouse= $_POST['howtouse'];
				$warning = $_POST['warning'];
				$careinstruction = $_POST['careinstruction'];
				$cat_product = $_POST['cat_product'];
				$category = $_POST['category_for'].'('.$_POST['category_to'].')';
				
				
				/*move uploader file $temname variable is the tempname of the images and move into the $target! */
				move_uploaded_file($tempname , $target);
				echo "success";
				
				/* insert the path of the images in database */
				$sql1="INSERT INTO $table (colors, img_name, image, price, oldprice, quantity, sizes, designs, details, summary, howtouse, warning, careinstruction, category, sub_category)
				VALUE
				('$colors','$target','$img_name','$price','$oldprice','$quantity','$sizes','$designs','$details','$summary','$howtouse','$warning','$careinstruction','$category','$cat_product')";

				if (!mysql_query($sql1))
				{
					echo "HOYyyyy!!! MAY MALI SA SQL MU!!";
					echo 'Error: ' . mysql_error();
				}
				//mysql_close();
				/* End of inserting */
		}/* check if file is exist condition end tag */
		
		/* if the file name exist the script condition goes here */
			else{
				echo "file exist";
			}
				
	}/* if file uploader in html form is not empty End */ 
	
	/* if there is error while uploading this error msg will appear */
	else {
		echo "failed to upload";
	}
}/* if server request method the script goes here End */

?>

<html>

	<head>
	<link rel="stylesheet" href="css/foundation.css" />
		<style>
			.details{
				display:none;
				margin-top:20px;
				border-radius:5px;
				padding:10px;
			}
			h1 {
			font-family:Calibri;
			font-size:24px;
			color: #09F;
			padding-top:20px;
			}
			#fileList img{
			height:120px;
			width:120px;
			}
			
			
		</style>
		
	</head>

	<body>
	<div class="row" >
	<div>
		<img src="img/banner/logo.png" />
	</div>
<!-- this is the form for uploading -->
		<form action='upload.php' method='post' enctype='multipart/form-data' id="pp">
		<div class="large-3 columns">
		<h1>Upload Page :</h1>
		<input type="file" id="fileElem"  accept="image/*" name="file" onchange="handleFiles(this.files)" />
			<a href="#" id="fileSelect">Select some files</a> 
			<div id="fileList"></div>

			<script>
			window.URL = window.URL || window.webkitURL;

			var fileSelect = document.getElementById("fileSelect"),
				fileElem = document.getElementById("fileElem"),
				fileList = document.getElementById("fileList");

			fileSelect.addEventListener("click", function (e) {
			  if (fileElem) {
				fileElem.click();
			  }
			  e.preventDefault(); // prevent navigation to "#"
			}, false);

			function handleFiles(files) {
			  if (!files.length) {
				fileList.innerHTML = "<p>No files selected!</p>";
			  } else {
				for (var i = 0; i < files.length; i++) {
				  var img = document.createElement("img");
				  img.src = window.URL.createObjectURL(files[i]);
				  img.onload = function(e) {
					window.URL.revokeObjectURL(this.src);
				  }

				  var info = document.createElement("span");
				  info.innerHTML = files[i].name + ": " + files[i].size + " bytes";
				}
				fileList.appendChild(img);
				//fileList.appendChild(info);
				
				$('.details').css('display','block');
			  }
			}
		</script>
		</div>
		
		<table id="file_upload" class="details large-9 columns">
		<tr><td>Image Name</td><td><input type="text" name="img_name"  /></td>
		<tr><td>Price</td><td><input type="text" name="price"  /></td>
		<tr><td>Old Price</td><td><input type="text" name="oldprice"  /></td>
		<tr><td>Colours</td><td><input type="text" name="colors"  /></td>
		<tr><td>Quantity</td><td><input type="text" name="quantity" /></td>
		<tr><td>Sizes</td><td><input type="text" name="sizes" /></td>
		
		<tr><td>Product Category :</td><td>
		<select id='cat' name="category_for" onchange="men_cat();" >
		<option value="">-- SELECT MAIN CATEGORY--</option>
		  <option value="men" >Men</option>
		  <option value="women">Women</option>
		  <option value="kids">Kids</option>
		  <option value="home">Home</option>
		  <option value="outdoors">Outdoors</option>
		  <option value="fitness">Fitness</option>
		  <option value="sports">Sports</option>
		  <option value="holiday">Holiday</option>
		  <option value="hi-visibility">Hi-visibility</option>
		  <option value="waterproof">Waterproof</option>
		  <option value="business">Business</option>
		  <option value="vehicles">Vehicles</option>
		</select>
		<div class="categ"></div>
		<div class="sub_catlast"></div>
		</td>
		<tr><td>Designs:</td><td><textarea type="text" name="designs"rows="4" cols="20" /></textarea></td>
		<tr><td>Full Description:</td><td><textarea type="text" name="details"rows="4" cols="20" /></textarea></td>
		<tr><td>Summary Details:</td><td><textarea type="text" name="summary"rows="4" cols="20" /></textarea></td>
		<tr><td>How to Use:</td><td><textarea type="text" name="howtouse"rows="4" cols="20" /></textarea></td>
		<tr><td>Warning:</td><td><textarea type="text" name="warning"rows="4" cols="20" /></textarea></td>
		<tr><td>Care instruction:</td><td><textarea type="text" name="careinstruction"rows="4" cols="20" /></textarea></td>
		

			<tr><td></td><td><input type="submit" class="button right" name="submit" value="Submit" /></td> </tr>
		</table>
		</form>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			
			
			
		});
		function sub_cat() {
			var sub_cat2 = $('#subcat').val();
				if(sub_cat2){
					$(".sub_catlast").html('')
				
				}
				if(sub_cat2 == 'maccessories'){
					$(".sub_catlast").html('<select name="cat_product"><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="others">Others</option></select>');
				}
				if(sub_cat2 == 'mclothes'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option><option value="hi-vis">Hi-Visibility</option></select>');
				}
				if(sub_cat2 == 'mtrousers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option><option value="hi-vis">Hi-Visibility</option></select>');
				}
				if(sub_cat2 == 'mbags'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option></select>');
				}
				if(sub_cat2 == 'mshoes'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option><option value="garden">Garden</option></select>');
				}
				if(sub_cat2 == 'waccessories'){
					$(".sub_catlast").html('<select name="cat_product"><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="others">Others</option></select>');
				}
				if(sub_cat2 == 'wclothes'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option><option value="hi-vis">Hi-Visibility</option></select>');
				}
				if(sub_cat2 == 'wtrousers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option><option value="hi-vis">Hi-Visibility</option></select>');
				}
				if(sub_cat2 == 'wbags'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option></select>');
				}
				if(sub_cat2 == 'wshoes'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option><option value="garden">Garden</option></select>');
				}
				if(sub_cat2 == 'kaccessories'){
					$(".sub_catlast").html('<select name="cat_product"><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="others">Others</option></select>');
				}
				if(sub_cat2 == 'kclothes'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="workwear">Work Wear</option><option value="hi-vis">Hi-Visibility</option></select>');
				}
				if(sub_cat2 == 'ktrousers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="hi-vis">Hi-Visibility</option></select>');
				}
				if(sub_cat2 == 'kbags'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="educationalbag">educational</option><option value="outdoorbag">Outdoor</option></select>');
				}
				if(sub_cat2 == 'ktoys'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="educationalbag">educational</option><option value="outdoorbag">Outdoor</option></select>');
				}
				if(sub_cat2 == 'kshoes'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fashion">Fashion</option><option value="gardenboots">Garden Boots</option></select>');
				}
					if(sub_cat2 == 'decorations'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="decorations">Decoration</option></select>');
				}
				if(sub_cat2 == 'homeware'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="appliance">Appliance</option><option value="kitchen_tools">Kitchen Tools</option><option value="hkitchen_utensils">Kitchen Utensils</option><option value="cleaning">Laundry and Cleaning</option><option value="hand_tools">Hand Tools</option></select>');
				}
				if(sub_cat2 == 'furniture'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="furniture">Furniture</option></select>');
				}
				if(sub_cat2 == 'garden_tools'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="gmaterials">Materials</option><option value="garden_tools">Hand Tools</option></select>');
				}
				if(sub_cat2 == 'garden_boots'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="garden_boots">Garden Boots</option></select>');
				}
				if(sub_cat2 == 'trampoline'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="trampoline">Trampoline</option></select>');
				}
				if(sub_cat2 == 'others'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="others">Others</option></select>');
				}
				if(sub_cat2 == 'activities'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="obeach">Beach</option><option value="diving">Diving</option><option value="fishing">Fishing</option><option value="hiking">Hiking</option></select>');
				}
				if(sub_cat2 == 'obeach'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="obeach">Beach</option><option value="diving">Diving</option><option value="fishing">Fishing</option></select>');
				}
				if(sub_cat2 == 'ofurniture'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="ofurniture">Furniture</option></select>');
				}
				if(sub_cat2 == 'omaterials'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="omaterials">Materials</option></select>');
				}
				if(sub_cat2 == 'faccessories'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="faccessories">Accessories</option></select>');
				}
				if(sub_cat2 == 'fmens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fwomens_wear">Mens Wear</option></select>');
				}
				if(sub_cat2 == 'fwomens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fwomens_wear">WoMens Wear</option></select>');
				}
				if(sub_cat2 == 'fequipments'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fequipments">Equipments</option></select>');
				}
				if(sub_cat2 == 'fothers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="fothers">Others</option></select>');
				}
				if(sub_cat2 == 'saccessories'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="saccessories">Accessories</option></select>');
				}
				if(sub_cat2 == 'smens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="smens_wear">Mens Wear</option></select>');
				}
				if(sub_cat2 == 'swomens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="swomens_wear">WoMens Wear</option></select>');
				}
				if(sub_cat2 == 'skids'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="skids_wear">Kids Wear</option></select>');
				}
				if(sub_cat2 == 'sequipments'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="sequipments">Equipments</option></select>');
				}
				if(sub_cat2 == 'sothers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="sothers">Others</option></select>');
				}
				if(sub_cat2 == 'hdecoration'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="x-mas">Christmas</option><option value="holloween">Holloween</option><option value="valentines">Valentines</option><option value="garden_decor">Garden Decor</option></select>');
				}
				if(sub_cat2 == 'hcostumes'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hcostumes">All Costumes</option></select>');
				}
				if(sub_cat2 == 'hgifts'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hgiths">Gifts</option></select>');
				}
				if(sub_cat2 == 'hbeach'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hswimming">Swimming</option><option value="hdiving">Diving</option><option value="hfishing">Fishing</option></select>');
				}
				if(sub_cat2 == 'hvaccessories'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hvaccessories">Accessories</option></select>');
				}
				if(sub_cat2 == 'hvmens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hvmclothes">Clothes</option><option value="hvmtrousers">Trousers</option></select>');
				}
				if(sub_cat2 == 'hvwomens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hvwclothes">Clothes</option><option value="hvwtrousers">Trousers</option></select>');
				}
				if(sub_cat2 == 'hvkids_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hvkclothes">Clothes</option><option value="hvktrousers">Trousers</option></select>');
				}
				if(sub_cat2 == 'hvequipments'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hvequipments">Equipments</option></select>');
				}
				if(sub_cat2 == 'hvothers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="hvothers">Others</option></select>');
				}
				if(sub_cat2 == 'paccessories'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="paccessories">Accessories</option></select>');
				}
				if(sub_cat2 == 'pmens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="pmclothes">Clothes</option><option value="pmtrousers">Trousers</option></select>');
				}
				if(sub_cat2 == 'pwomens_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="pmclothes">Clothes</option><option value="pmtrousers">Trousers</option></select>');
				}
				if(sub_cat2 == 'pkids_wear'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="pkclothes">Clothes</option><option value="pktrousers">Trousers</option></select>');
				}
				if(sub_cat2 == 'pequipments'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="pequipments">Equipments</option></select>');
				}
				if(sub_cat2 == 'pothers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="pothers">Others</option></select>');
				}
				if(sub_cat2 == 'bmaterials'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="bmaterials">Materials</option></select>');
				}
				if(sub_cat2 == 'bfurniture'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="bfurniture">Furniture</option></select>');
				}
				if(sub_cat2 == 'bequipment'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="bequipment">Equipment</option></select>');
				}
				if(sub_cat2 == 'bbags'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="bbags">Business Bags</option></select>');
				}
				if(sub_cat2 == 'bothers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="bothers">Others</option></select>');
				}
				if(sub_cat2 == 'vaccessories'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="vaccessories">Accessories</option></select>');
				}
				if(sub_cat2 == 'vequipments'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="vequipments">Equipments</option></select>');
				}
				if(sub_cat2 == 'vtools'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="vtools">Tools</option></select>');
				}
				if(sub_cat2 == 'vothers'){
					$(".sub_catlast").html('<select name="cat_product" ><option value="">-- SELECT --</option><option value="vothers">Others</option></select>');
				}
				
				
		}
		
		function men_cat() {
				var category = $('#cat').val();
				if(category==''){
					$(".categ").html('')
				}
				if(category=='men'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="maccessories">Accessories</option><option value="mclothes">Clothes</option><option value="mbags">Bags</option><option value="mtrousers">Trousers</option><option value="mshoes">Wellies</option></select>');
				}
				if(category=='women'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();" ><option value="">-- SELECT --</option><option value="waccessories">Accessories</option><option value="wclothes">Clothes</option><option value="wbags">Bags</option><option value="wtrousers">Trousers</option><option value="wshoes">Wellies</option></select>');
				}
				if(category=='kids'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="kaccessories">Accessories</option><option value="kclothes">Clothes</option><option value="kbags">Bags</option><option value="ktrousers">Trousers</option><option value="ktoys">Toys</option><option value="kshoes">Wellies</option></select>');
				}
				if(category=='home'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="decorations">Decoration</option><option value="homeware">Homeware</option><option value="furniture">Furniture</option><option value="garden_tools">Garden Tools</option><option value="garden_boots">Garden Boots</option><option value="trampoline">Trampoline</option><option value="others">Others</option></select>');
				}
				if(category=='outdoors'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="activities">Activities</option><option value="obeach">Beach</option><option value="ofurniture">Furniture</option><option value="omaterials">Materials</option></select>');
				}
				if(category=='fitness'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="faccessories">Accessories</option><option value="fmens_wear">Mens Wear</option><option value="fwomens_wear">Womens Wear</option><option value="fequipments">Equipments</option><option value="fothers">Others</option></select>');
				}
				if(category=='sports'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="saccessories">Accessories</option><option value="smens_wear">Mens Wear</option><option value="swomens_wear">Womens Wear</option><option value="skids">Kids Wear</option><option value="sequipments">Equipments</option><option value="sothers">Others</option></select>');
				}
				if(category=='holiday'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="hdecoration">Decoration</option><option value="hcostumes">Costumes</option><option value="hgifts">Gifts</option><option value="hbeach">Beach</option><option value="hothers">Others</option></select>');
				}
				if(category=='hi-visibility'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="hvaccessories">Accessories</option><option value="hvmens_wear">Mens Wear</option><option value="hvwomens_wear">Womens Wear</option><option value="hvkids_wear">Kids Wear</option><option value="hvequipments">Equipments</option><option value="hvothers">Others</option></select>');
				}
				if(category=='waterproof'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="paccessories">Accessories</option><option value="pmens_wear">Mens Wear</option><option value="pwomens_wear">Womens Wear</option><option value="pkids_wear">Kids Wear</option><option value="pequipments">Equipments</option><option value="pothers">Others</option></select>');
				}
				if(category=='business'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="bmaterials">Materials</option><option value="bfurniture">Furniture</option><option value="bbags">Business Bags</option><option value="bothers">Others</option></select>');
				}
				if(category=='vehicles'){
					$(".categ").html('<select name="category_to" id="subcat"  onchange="sub_cat();"><option value="">-- SELECT --</option><option value="vaccessories">Accessories</option><option value="vequipments">Equipments</option><option value="vtools">Tools</option><option value="vothers">Others</option></select>');
				}
				
				
				
			};
	</script>
	
	
	</body>

</html>