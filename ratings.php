<center>
<div class="f_star">
<?php
$rate = 3;
$ctr = 0;

while(true){
$ctr++;
if($rate>=$ctr){
echo '<img height="20px" width="20px"; src="img/star1.png" />';

}else{
echo '<img height="20px" width="20px"; src="img/star2.png" />';
}

if($ctr==5){ break; } 

} ?>
</div>
</center>