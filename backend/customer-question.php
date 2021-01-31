<?php 
include('session.php');

if(isset($login_session)){


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>back end | complaint</title>
		<link href ="css/style.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="css/foundation.css" />
		<script src="js/vendor/modernizr.js"></script>
		<style>
table,td,th{
			border:1px solid white; text-align:center; 
			}
.head-select{
			width:19px;
			height:19px;
			cursor:pointer;
			position:relative;
			left: 42px;
			top: 8px;
			}
.case{
			width:84px;
			height:19px;
			cursor:pointer;
			position:relative;
			left:0px;
			}
table {
			position:relative;
			width:1000px;
			top:50px;
			left:20px;
			height:200px;
			border-spacing: 0;
			margin:auto;
			padding:auto;
			
			}

tbody, thead tr{ 
			display: block; 
			}

tbody {
			height: 300%;
			overflow-y: auto;
			overflow-x: hidden;
			}

tbody td, thead th {
			width: 138px;
			}

thead th:last-child {
			width: 156px; /* 140px + 16px scrollbar width */
			}
.action-delivery{
			position:relative; 
			width:20%;  
			left:250px;
			display:inline;
			}
th{
			height:40px;
			}
			
.command{
			position:relative;
			left:-20px;
			}
.main-tr:hover{background-color:#BECCDA; width:10%;} 		
	
		</style>
		
</head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<SCRIPT language="javascript">
$(function(){

	// add multiple select / deselect functionality
	$("#selectall").click(function () {
		  $('.case').attr('checked', this.checked);
	});

	// if all checkbox are selected, check the selectall checkbox
	// and viceversa
	$(".case").click(function(){

		if($(".case").length == $(".case:checked").length) {
			$("#selectall").attr("checked", "checked");
		} else {
			$("#selectall").removeAttr("checked");
		}

	});
});
</SCRIPT>

<body>


<?php include('header.php');?>

<?php

		
			$result = mysqli_query($con,"SELECT A.cus_id, A.complaint, A.datetime, B.firstname, B.lastname, B.email FROM tbl_complaint A LEFT OUTER JOIN tbl_customer B ON A.cus_id = B.cus_id ORDER BY datetime DESC ");		
			
			echo '<div class="large-12 columns" style="margin-left: -20px; margin-top:-100px;">';
			echo '<center><caption><b>QUESTIONS / COMPLAINTS</b></caption><center>';
			echo "<table  class=\"ex1\"border='0' width='0%' height='100%' align='center' cellpadding='0' cellspacing='1'>";
			echo "<thead><tr  bgcolor='#D1D1D1'><th style='width:159px;'> <input class='head-select' type='checkbox' id='selectall'></th><th style='width:470px; text-align:center; '>Firstname email</th><th style='width:529px; text-align:center; '>Customer Complaint</th><th style='width: 127px; text-align:center; '>Datetime</th></tr></thead>";
			echo "<tbody>";
			
			
			while($row = mysqli_fetch_array($result))
		  {
			$complaint			=	$row['complaint'];
			$cus_id	 			= 	$row['cus_id'];
			$datetime			= 	$row['datetime'];
			$firstname_email	= 	$row['firstname'].' '.$row['lastname'].' &nbsp;/&nbsp; '.$row['email'];
			
			echo '<tr  bgcolor="#D1D1D1" class="main-tr">';
			echo "<td><input  class='case' type='checkbox'></td>";
			
			if(isset($_POST['unread'])){
			
				$unread = $_POST['read'];
			
			}
			?>
			
			<form id="myForm" action="for-filtering.php">
			<input type="hidden" name="read" value="<?php echo $account_fname; ?>">
			<input type="submit" id="submit" style="display:none;"/>
			<?php
			echo "<td style='width:500px;'><a name='unread' onclick=\"myFunction()\" href='reponse-to-customer.php?id=".$cus_id."'>$firstname_email</a></td>";
			echo "</form>";
			
			echo "<td style='width:500px;overflow:hidden; text-overflow:ellipsis; '>$complaint</td>";
			echo "<td>".substr("$datetime",0,-8)."</td>";
			
			echo "<tr>";
			  
			  }
			echo "</tbody>";
			echo "</table>";
			echo '</div>';

			

			
//new Orders
		mysqli_close($con);
?>
<div class='row' style="position:relative;top:500px;"><h1></h1>
</div>
<!--------
echo "<tr  ><td><td>$purchase</td><td>$amount</td><td>$shipping</td><td>$notes</td><td>$date</td><td><form action='EmailProcess.php' method='POST'><input type='hidden' name='name' id='name' value=\"<?php echo $name; ?>\" /><select name=\"action\"  onchange=\"this.form.submit()\"> <option><strong>COMMAND</strong></option><option value=\"complete\">Completed</option> <option value=\"cancel\">Cancelled</option></select></form></td><td>please make an action</td></tr>";
			
echo "<div class='action-delivery'><td><form action='' method='POST'><span class='command'></a>Select/Unselect all <br> </span> <input type='hidden' name='name' id='name' value=\"<?php  ?>\" /><select name=\"action\"  onchange=\"this.form.submit()\"> <option><strong>COMMAND</strong></option><option value=\"complete\">Completed</option> <option value=\"cancel\">Cancelled</option></select>   <select name=\"action\"  onchange=\"this.form.submit()\"> <option><strong>COMMAND</strong></option><option value=\"complete\">Completed</option> <option value=\"cancel\">Cancelled</option></select></form></td></div>";
			-------->
</body>
</html> 
<?php }else{echo '<center><h2><font color="red">Sorry you are not allowed <br>to by pass the security of this <br>System.. </font></h2><br><a href="index.php">Go Back</a> </center>';}//isset?> 