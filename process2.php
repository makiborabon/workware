 <?php
 error_reporting(E_ALL);ini_set('display_errors','1');
$table = "tbl_product";

/******************MULTIPLE QUERIES*******************/
 if($tbl_code==999){$condition = " WHERE (category = 'wellington') OR (category = 'hivis') OR (category = 'tools') OR (category = 'waterproof') ";}

else if($tbl_code==998){$condition = "	WHERE category = 'wellington' ";}
else if($tbl_code==997){$condition = "	WHERE category = 'hivis' ";}
else if($tbl_code==996){$condition = "	WHERE category = 'waterproof' ";}

else if($tbl_code==995){$condition = "	WHERE category = 'wellington' AND sub_category = 'women' ";}
else if($tbl_code==994){$condition = "	WHERE category = 'wellington' AND sub_category = 'cammo' ";}
else if($tbl_code==993){$condition = "	WHERE category = 'wellington' AND (sub_category = 'boy' OR sub_category = 'girl') ";}
else if($tbl_code==992){$condition = "	WHERE category = 'wellington' AND (sub_category = 'brandedmen' OR sub_category = 'brandedwomen') ";}
else if($tbl_code==991){$condition = "	WHERE category = 'wellington' AND sub_category = 'mens' ";}
else if($tbl_code==990){$condition = "	WHERE category = 'tools' AND sub_category = 'bags' ";}
else if($tbl_code==989){$condition = "	WHERE category = 'hivis' AND sub_category = 'men' ";}
else if($tbl_code==988){$condition = "	WHERE category = 'hivis' AND sub_category = 'women' ";}
else if($tbl_code==987){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}
else if($tbl_code==986){$condition = "	WHERE category = 'waterproof' AND sub_category = 'men' ";}
else if($tbl_code==985){$condition = "	WHERE category = 'waterproof' AND sub_category = 'women' ";}
else if($tbl_code==984){$condition = "	WHERE category = 'waterproof' AND sub_category = 'kids' ";}

else if($tbl_code==983){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}//new arrivals
else if($tbl_code==982){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}//wholesale
else if($tbl_code==981){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}//quickshipping
else if($tbl_code==980){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}//with defect

else if($tbl_code==979){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}
else if($tbl_code==978){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}
else if($tbl_code==977){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}
else if($tbl_code==976){$condition = "	WHERE category = 'hivis' AND sub_category = 'kids' ";}

else if($tbl_code==975){$condition = "	WHERE category = 'hivis' ";}
else if($tbl_code==974){$condition = "	WHERE category = 'wellington' AND (sub_category = 'cammo' OR sub_category = 'mens') ";}

else{ echo'<script>location.reload();</script>';}

?>


