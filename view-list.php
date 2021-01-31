<?php 

	
	
	class ChangeStatus
	{
		
		public $size;
	
		public function SizeStatus(){
		
		$con = new mysqli("localhost","root","kawnacge","updated_db");
		$result = $con->query("SELECT * FROM tbl_product");
		
			while(true){
			
			$row = $result->fetch_assoc();

			return $this->size = htmlentities($row['price']);;
			}
		}
		
	
	}
$displayStatus = new ChangeStatus();
echo $displayStatus->SizeStatus();
?>