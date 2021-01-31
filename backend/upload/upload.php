<?php
include ('../mysqli_connect.php');

//If directory doesnot exists create it.
$output_dir = "../products/";

if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
            $RandomNum   = time();
            
			$files = $_FILES["myfile"]['name'];
			
			
            $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
            $ImageType      = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
         
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
			
			
			$ImageName;
       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $NewImageName);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
			 
			 $sql="INSERT INTO tbl_product2 (photos)
				VALUE
				(' $files')";
				$query = mysqli_query($con, $sql);
				
				if (!$query)
				{
					//echo "There is error on your sql";
					die('Error: '.$sql . mysqli_error($con));
				}
			 
			 
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$NewImageName;
    	}
    	else
    	{
            $fileCount = count($_FILES["myfile"]['name']);
    		for($i=0; $i < $fileCount; $i++)
    		{
                $RandomNum   = time();
				$files = $_FILES["myfile"]['name'];
                $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name'][$i]));
                $ImageType      = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.
             
                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt       = str_replace('.','',$ImageExt);
                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                
                $ret[$NewImageName]= $output_dir.$NewImageName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$NewImageName );
				
				$sql="INSERT INTO tbl_product2 (photos)
				VALUE
				('$files')";
				$query = mysqli_query($con, $sql);
				
				if (!$query)
				{
					//echo "There is error on your sql";
					die('Error: '.$sql . mysqli_error($con));
				}
				
				
				
				
    		}
    	}
    }
    echo json_encode($ret);
 
}

?>