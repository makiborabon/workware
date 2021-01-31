<?php
session_start();
if(isset($_SESSION["id"])){echo '<script> alert("SKU ID Received");</script>';}


include ('mysqli_connect.php');


//If directory doesnot exists create it.

if(isset($_FILES["myfile"]))
{

	 $SKU = $_SESSION["id"];
	
	$ret = array();
	$files = $_FILES["myfile"]['name'];
	
	$count = count($files);
	
	$total = $count+1;
	$sql="UPDATE tbl_product SET photos = '$files', no_sub_cat = '$total' WHERE SKU = '$SKU'";
				
	if (mysqli_query($con, $sql)) {
	echo '<script>alert(\'Sucessfull\'); window.history.back(-2)</script>';
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}
	
	
	
	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
        /** $RandomNum   	= time();
            $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
            $ImageType      = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
         
            $ImageExt		= substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName 	= $ImageName; **/
			$tempname = $_FILES['myfile']['tmp_name'];
			
			$target = '../image-list/'.$_FILES['myfile']['name'];
			$target2 = '../images/'.$_FILES['myfile']['name'];
			
       	 	move_uploaded_file($tempname,$target);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
			copy($target , $target2);			 
       	 	 
	       	 	 $ret[$fileName]= $target;
    	}
    	else
    	{
            $fileCount = count($_FILES["myfile"]['name']);
    		for($i=0; $i < $fileCount; $i++)
    		{
               /** $RandomNum   = time();
            
                $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name'][$i]));
                $ImageType      = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.
             
                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt       = str_replace('.','',$ImageExt);
                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                
                $ret[$NewImageName]= $output_dir.$NewImageName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$NewImageName );
				
				**/
				
    		}
    	}
    }
    echo json_encode($ret);
 
}

?>