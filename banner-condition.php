 <head>
	<style>
		.banner{border:1px; border-radius: 5px 5px 5px 5px;}
	</style>
 </head>
 
 <?php

 
 
 function DisplayBanner(){
	$p_id =  $_GET['page'];
	$page_id = substr($p_id,0,strlen($p_id)-3);
	$tbl_code = substr($p_id,strlen($p_id)-3,strlen($p_id));

	/*****************ALL***************************/
	 if($tbl_code==999){echo'<img class="banner" width="100%" src="img/discount.png" />';}
	/*************WELLINGTOON***********************/
	else if($tbl_code==998){echo'<img class="banner" width="100%" src="img/wellington.png" />';}
	else if($tbl_code==997){echo'<img class="banner" width="100%" src="img/high-designer.png" />';}
	else if($tbl_code==996){echo'<img class="banner" width="100%" src="img/water-designer.png" />';}

	else if($tbl_code==995){echo'<img class="banner" width="100%" src="img/ladies-designer.png" />';}
	else if($tbl_code==994){echo'<img class="banner" width="100%" src="img/cammo-designer.png" />';}
	else if($tbl_code==993){echo'<img class="banner" width="100%" src="img/kids-designer.png" />';}
	else if($tbl_code==992){echo'<img class="banner" width="100%" src="img/designer.png" />';}
	else if($tbl_code==991){echo'<img class="banner" width="100%" src="img/mens-designer.png" />';}
	else if($tbl_code==990){echo'<img class="banner" width="100%" src="img/tool-designer.png" />';}
	else if($tbl_code==989){echo'<img class="banner" width="100%" src="img/high-designer.png" />';}
	else if($tbl_code==988){echo'<img class="banner" width="100%" src="img/high-designer.png" />';}
	else if($tbl_code==987){echo'<img class="banner" width="100%" src="img/high-designer.png" />';}
	else if($tbl_code==986){echo'<img class="banner" width="100%" src="img/men-water-designer.png" />';}
	else if($tbl_code==985){echo'<img class="banner" width="100%" src="img/women-water-designer.png" />';}
	else if($tbl_code==984){echo'<img class="banner" width="100%" src="img/kid-water-designer.png" />';}
	
	
	
	else if($tbl_code==983){echo'<img class="banner" width="100%" src="img/new-arrivals-designer.png" />';}//new arrivals
	else if($tbl_code==982){echo'<img class="banner" width="100%" src="img/wholesale-designer.png" />';}//whole sale
	else if($tbl_code==981){echo'<img class="banner" width="100%" src="img/new-arrivals-designer.png" />';}//quickshipping
	else if($tbl_code==980){echo'<img class="banner" width="100%" src="img/new-arrivals-designer.png" />';}//with defect
	else if($tbl_code==979){echo'<img class="banner" width="100%" src="img/springtime.png" />';}//spring deals
	else if($tbl_code==978){echo'<img class="banner" width="100%" src="img/dealoftheweek.png" />';}//deal of the week
	else if($tbl_code==977){echo'<img class="banner" width="100%" src="img/stockclearance.png" />';}//stock clearance
	else if($tbl_code==976){echo'<img class="banner" width="100%" src="img/ebayAuction.png" />';}//ebay auction
	
	else if($tbl_code==975){echo'<img class="banner" width="100%" src="img/workware-designer.png" />';}//ebay auction
	
	else if($tbl_code==974){echo'<img class="banner" width="100%" src="img/men-cammo-designer.png" />';}//ebay auction

	
	
	
	else{ echo'<script>location.reload();</script>';}

}
?>

 

