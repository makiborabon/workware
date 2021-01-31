<?php 
include('session.php');

if(isset($login_session)){


?>

<!doctype html>
<html class="no-js" lang="en">
<title>back end | home</title>
<body>
<?php include('header.php');?>

<center><p>Administrator is providing lectures and documentation for better understanding of this system.<br><br> Try to explore on every page and try to analyze each of them,<br> <br>There are 3 record(dummy) here, used for better understanding.<br>thank you! =)</p></center>




  </body>
</html>
<?php }else{echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security.. </font></h2><br><a href="index.php">Go Back</a> </center>';} //isset?>