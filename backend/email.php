<title>back end | send-email</title>
<?php
// read the list of emails from the file.
$email_list = file("elist.txt");

// count how many emails there are.
$total_emails = count($email_list);

// go through the list and trim off the newline character.
for ($counter=0; $counter<$total_emails; $counter++) {
   $email_list[$counter] = trim($email_list[$counter]);
   }

   
   
// implode the list into a single variable, put commas in, apply as $to value.
//$to = implode(",",$email_list);

foreach($email_list as $sendTo)
{



$subject = "Thank you and Welcome";
$messages = "<html>
			<body>
					<center><img src=\"http://monique-designs.com/img/logo.png\"  /></center>
					<center><h2><font color=\"red\">Thank You</font></h2>
					</center>
					<center><div align=\"center\"><p>We are delighted in welcoming you  into our new Website <a href=\"http://wwww.monique-designs.com\">Monique Designs Official Website</a>. ,
						since YOU are a VALUED customer of <a href=\"http://stores.ebay.co.uk/No-1-Monique-designs\">ebay.co.uk/No-1-Monique-designs</a>. 
						We are eager to serve you, and we are grateful that you have chosen us to fill your needs.

						We carry everything you may need to make sure we meet your 100% satisfaction. 
						We have a massive array of products to choose from, all at a competitive and at a<strong> Very Minimum  Price. </strong>
						We will be very happy to see you using the <strong>Same Account</strong> you use in ebay No.1 monique-design and feel free to Log-in in <a href=\"http://wwww.monique-designs.com\">Monique Designs Official Website</a>

						To show our gratitude, we will be giving away coupons that will take 25% off your total receipt with no minimum spend. 
						Hurry down to Monique designs and use coupons to receive extra discounts!
						Enjoy Shopping!</p><div></center><br>
				<center><span> Here is your coupon Code:<h2>1234ABC</h2></span></center>
				<center>: to get  <font size=\"5\" color=\"red\"> 25% discounts</font> on your Total payment in paypal, place this code into a coupon code generator on your CART.</center>
			</body>
			</html>";
			
			
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Hww.co.uk <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: borabonmarkanthonyr@yahoo.com' . "\r\n";			
			
//$headers = "From: Monique-Designs <borabonmarkanthonyr@yahoo.com";
//$headers.= "MIME-version: 1.0\n";
//$headers.= "Content-type: text/html; charset= iso-8859-1\n";

//$count = count($sendTo);
if ( mail($sendTo,$subject,$messages,$headers) ) {
    $message = "sending e-mail to : ";

	echo "<script type='text/javascript'>alert('$message $sendTo');  window.location = 'home.php';</script>";
   } else {
   echo "The email has failed!";
   }
} 
   
?>