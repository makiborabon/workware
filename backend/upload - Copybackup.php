<?php
session_start();
if(isset($_SESSION["id"])){echo '<script> alert("SKU ID Received");</script>';}


include ('../mysqli_connect.php');


//If directory doesnot exists create it.
$output_dir = "../image-list/";

if(isset($_FILES["myfile"]))
{

	 $SKU = $_SESSION["id"];
	
	$ret = array();
	$files = $_FILES["myfile"]['name'];
	
	
	$sql="UPDATE tbl_product SET photos = '$files' WHERE SKU = '$SKU'";
				
	if (mysqli_query($con, $sql)) {
	echo '<script>alert(\'Sucessfull\'); window.history.back(-2)</script>';
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}
	
	
	
	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
            $RandomNum   	= time();
            $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
            $ImageType      = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
         
            $ImageExt		= substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName 	= $ImageName;
			
			
			$ImageName;
       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $NewImageName);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
			 
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$NewImageName;
    	}
    	else
    	{
            $fileCount = count($_FILES["myfile"]['name']);
    		for($i=0; $i < $fileCount; $i++)
    		{
                $RandomNum   = time();
            
                $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name'][$i]));
                $ImageType      = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.
             
                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt       = str_replace('.','',$ImageExt);
                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                
                $ret[$NewImageName]= $output_dir.$NewImageName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$NewImageName );
				
				
				
    		}
    	}
    }
    echo json_encode($ret);
 
}

?>