<HTML>
<HEAD>
<title> 404 Error Page</title>
</HEAD>
<BODY>
<p align="center">
<h1>Error 404</h1><br>Page Not Found <br> internet connection is too slow to make this action.
<p>
<?php
$ip = getenv ("REMOTE_ADDR");
$requri = getenv ("REQUEST_URI");
$servname = getenv ("SERVER_NAME");
$combine = $ip . " tried to load " . $servname . $requri ;
$httpref = getenv ("HTTP_REFERER");
$httpagent = getenv ("HTTP_USER_AGENT");
$today = date("D M j Y g:i:s a T");
$note = "You are in a wrong page!" ;
$message = "$today \n
<br>
$combine <br> \n
User Agent = $httpagent \n
<h2> $note </h2>\n
<br> $httpref ";
$message2 = "$today \n
$combine \n
User Agent = $httpagent \n
$note \n
$httpref ";
$to = "error@stocks-inventory.url.ph";
$subject = "stocks-inventory.url.ph Error Page";
$from = "From: fake@stocks-inventory.url.ph\r\n";
mail($to, $subject, $message2, $from);
echo $message;
?>
s <a href=" http://stocks-inventory.url.ph/product-record.php">back to product record</a>
</BODY></HTML>