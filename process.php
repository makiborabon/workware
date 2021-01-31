 <?php

$table = "tbl_product";

/*************ALL***************/
 if($tbl_code==999){$condition = " WHERE category='women(wshoes)' AND sub_category='fashion' OR category='men(mshoes)' AND sub_category='workwear' ";}
else if($tbl_code==998){$condition = " WHERE category='women(wshoes)' AND sub_category='fashion' OR category='men(mshoes)' AND sub_category='workwear' ";}
else if($tbl_code==997){$condition = " WHERE category='women(wbags)' OR category='women(wshoes)' OR category='men(mclothes)'  OR category='men(mtrousers)'";}
else if($tbl_code==996){$condition = " WHERE category='kids(kaccessories)' OR category='kids(kbags)' OR category='kids(kclothes)' OR category='kids(kshoes)' OR category='kids(ktoys)' OR category='kids(ktrousers)'";}
else if($tbl_code==995){$condition = " WHERE category='home(decorations)' OR category='home(decorations)' OR category='home(trampoline)' OR category='home(furniture)'";}
else if($tbl_code==994){$condition = " WHERE category='outdoors(ofurniture)' OR category='outdoors(obeach)'";}
else if($tbl_code==993){$condition = " WHERE category='fitness(fequipments)' OR category='fitness(faccessories)'";}
else if($tbl_code==992){$condition = " WHERE category='sports(saccessories)' OR category='sports(sequipments)'";}
else if($tbl_code==991){$condition = " WHERE category='holiday(hbeach)' OR category='holiday(hbeach)' OR category='holiday(hgifts)' OR category='holiday(hcostumes)'";}
else if($tbl_code==989){$condition = " WHERE category='hi-visibility(hvwomens_wear)' OR category='men(mclothes)' AND sub_category='hi-vis' OR category='men(mtrousers)' AND sub_category='hi-vis'";}
else if($tbl_code==988){$condition = " WHERE category='waterproof(paccessories)' OR category='waterproof(pmens_wear)'";}
else if($tbl_code==987){$condition = " WHERE category='business(bbags)' OR category='business(bmaterials)'";}
else if($tbl_code==986){$condition = " WHERE category='vehicles(vaccessories)' OR category='vehicles(vequipments)' OR category='vehicles(vtools)'";}

 

 
/***********MEN**************/		
else if($tbl_code==941){$condition = " WHERE category='men(maccessories)' AND sub_category='fashion'";}
else if($tbl_code==942){$condition = " WHERE category='men(mbags)' AND sub_category='workwear'";}
else if($tbl_code==943){$condition = " WHERE category='men(mclothes)' AND sub_category='hi-vis'";}
else if($tbl_code==956){$condition = " WHERE category='men(mclothes)' AND sub_category='workwear'";}
else if($tbl_code==944){$condition = " WHERE category='men(mtrousers)' AND sub_category='hi-vis'";}
else if($tbl_code==957){$condition = " WHERE category='men(mtrousers)' AND sub_category='workwear'";}
else if($tbl_code==974){$condition = "	WHERE category='men(mshoes)' AND sub_category='workwear'";}
/***********WOMEN**************/
else if($tbl_code==949){$condition = "	WHERE category='women(wbags)' AND sub_category='fashion'";}
else if($tbl_code==950){$condition = "	WHERE category='women(wshoes)' AND sub_category='fashion'";}
else if($tbl_code==951){$condition = "	WHERE category='women(wshoes)' AND sub_category='garden'";}
else if($tbl_code==952){$condition = "	WHERE category='women(wshoes)'";}
/***********KIDS**************/
else if($tbl_code==932){$condition = " WHERE category='kids(kaccessories)' AND sub_category='fashion'";}
else if($tbl_code==933){$condition = " WHERE category='kids(kbags)' AND sub_category='educationalbag'";}
else if($tbl_code==934){$condition = " WHERE category='kids(kclothes)'";}
else if($tbl_code==936){$condition = " WHERE category='kids(kclothes)' AND sub_category='workwear'";}
else if($tbl_code==937){$condition = " WHERE category='kids(kshoes)'";}
else if($tbl_code==935){$condition = " WHERE category='kids(kshoes)' AND sub_category='gardenboots'";}
else if($tbl_code==938){$condition = " WHERE category='kids(ktoys)' AND sub_category='educational'";}
else if($tbl_code==939){$condition = " WHERE category='kids(ktoys)'";}
else if($tbl_code==940){$condition = " WHERE category='kids(ktrousers)'";}
/***********HOME**************/
else if($tbl_code==927){$condition = " WHERE category='home(decorations)' AND sub_category='decorations'"; }
else if($tbl_code==929){$condition = " WHERE category='home(homeware)' AND sub_category='cleaning'"; }
else if($tbl_code==930){$condition = " WHERE category='home(homeware)' AND sub_category='kitchen_tools'"; }
else if($tbl_code==931){$condition = " WHERE category='home(homeware)' AND sub_category='appliance'"; }
else if($tbl_code==959){$condition = " WHERE category='home(homeware)' AND sub_category='hand_tools'"; }
else if($tbl_code==958){$condition = " WHERE category='home(trampoline)' AND sub_category='trampoline'"; }
else if($tbl_code==928){$condition = " WHERE category='home(furniture)' AND sub_category='furniture'"; }
/***********OUTDOOR**************/
else if($tbl_code==946){$condition = "	WHERE category='outdoors(ofurniture)' AND sub_category='ofurniture'";}
else if($tbl_code==947){$condition = "	WHERE category='outdoors(obeach)' AND sub_category='obeach'";}
/***********FITNESS**************/
else if($tbl_code==926){$condition = " WHERE category='fitness'"; }
else if($tbl_code==960){$condition = " WHERE category='sports'"; }
/***********SPORTS**************/
else if($tbl_code==948){$condition = "	WHERE category='sports(saccessories)' AND sub_category='saccessories'";}
else if($tbl_code==961){$condition = "	WHERE category='sports(sequipments)' AND sub_category='sequipments'";}
/***********HOLIDAY**************/
else if($tbl_code==962){$condition = "	WHERE category='holiday(hbeach)' AND sub_category='hswimming'";}
else if($tbl_code==963){$condition = "	WHERE category='holiday(hdecoration)' AND sub_category='x-mas'";}
else if($tbl_code==964){$condition = "	WHERE category='holiday(hgifts)' AND sub_category='hgifts'";}
else if($tbl_code==965){$condition = "	WHERE category='holiday(hcostumes)' AND sub_category='hcostumes'";}
/***********HIVIS**************/
else if($tbl_code==966){$condition = "	WHERE category='hi-visibility(hvwomens_wear)' AND sub_category='hvwclothes'";}
/***********WATERPROOF**************/
else if($tbl_code==967){$condition = "	WHERE category='waterproof(paccessories)' AND sub_category='paccessories'";}
else if($tbl_code==968){$condition = "	WHERE category='waterproof(pmens_wear)' AND sub_category='pmclothes'";}
/***********BUSINESS**************/
else if($tbl_code==969){$condition = "	WHERE category='business(bbags)' AND sub_category='bbags'";}
else if($tbl_code==970){$condition = "	WHERE category='business(bmaterials)' AND sub_category='bmaterials'";}
/***********VEHICLES**************/
else if($tbl_code==971){$condition = "	WHERE category='vehicles(vaccessories)' AND sub_category='vaccessories'";}
else if($tbl_code==972){$condition = "	WHERE category='vehicles(vequipments)' AND sub_category='vequipments'";}
else if($tbl_code==973){$condition = "	WHERE category='vehicles(vtools)' AND sub_category='vtools'";}
else if($tbl_code==925){$condition = "	WHERE category='fancy(dress)' AND sub_category='dress'";}
else if($tbl_code==924){$condition = "	WHERE category='toolsandfixing' AND sub_category='tools'";}
else if($tbl_code==923){$condition = "  WHERE category='men(mclothes)'";}
else if($tbl_code==922){$condition = "  WHERE category='men(mtrousers)'";}
else if($tbl_code==921){$condition = "  WHERE category='men(mbags)'";}
else if($tbl_code==920){$condition = "	WHERE category='men(mshoes)'";}
else if($tbl_code==919){$condition = "	WHERE category='wedding&parties'";}
else if($tbl_code==918){$condition = "  WHERE category='men(mshoes)' OR category='men(mtrousers)' OR category='men(mclothes)'";}
else if($tbl_code==917){$condition = "  WHERE category='kids(kclothes)' OR category='kids(ktrousers)' OR category='kids(ktoys)' OR  category='kids(kaccessories)' OR category='kids(kshoes)'";}
else if($tbl_code==916){$condition = "	WHERE category='men(mclothes)' AND sub_category='hi-vis' OR category='men(mtrousers)' AND sub_category='hi-vis'";}  
else if($tbl_code==915){$condition = "	WHERE category='sports' OR category='fitness' ";}
else if($tbl_code==914){$condition = "	WHERE category='vehicles(vaccessories)' OR category='vehicles(vequipments)' OR category='vehicles(vtools)' ";}
else if($tbl_code==913){$condition = "	WHERE category='springtime'";}
else if($tbl_code==912){$condition = "	WHERE category='dealofweek'";}
else if($tbl_code==911){$condition = "	WHERE category='stockclearance'";}

else{ echo'<script>location.replace("404.php");</script>';}
?>


