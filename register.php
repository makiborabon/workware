<?php session_start(); include("mysqli_connect.php"); ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <title>Registration Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style_log.css" />
	<?php
	//$defaultgender = array("Male","Female");
	$fname = "";$lname = "";
	$email = "";		
	//$gender = "Male";
	$contact = "";
	$address = "";$address2 = "";
	$state = "";$countries= "";
	$err = "";

	if(isset($_POST['cmdRegister']))
	{
		

		$result = mysqli_query($con,"SELECT * FROM tbl_customer");
		$recId = mysqli_fetch_array($result);
		$_SESSION['id'] = $recId['cus_id'] + 1;
			
		$fname = $_POST['txtFname'];
		$lname = $_POST['txtLname'];
		$PostCode = $_POST['PostCode'];		
		$email = $_POST['txtEmail'];		
		$pass = $_POST['txtPass'];
		$conpass = $_POST['txtConPass'];
		//$gender = $_POST['cboGender'];
		$contact = $_POST['txtContact'];
		$address = $_POST['txtAddress'];
		$address2 = $_POST['txtAddress2'];
		$state = $_POST['state'];
		$countries = $_POST['countries'];
		$datetime=date("y-m-d h:i:s"); //date time
		
		if($fname == ""){$err = "<i>&nbsp; First name is required!<br>";}
		if($lname == ""){$err = $err . "&nbsp; Last name is required!<br>";}
		if($PostCode == ""){$err = $err . "&nbsp; Post code is required!<br>";}
		if($address == ""){$err = $err . "&nbsp; Address 1 is required!<br>";}
		if($address2 == ""){$err = $err . "&nbsp; Address 2 is required!<br>";}
		if($state== ""){$err = $err . "&nbsp; Please select State!<br>";}
		if($countries == ""){$err = $err . "&nbsp; Please select Country! <br>";}
		if($email == ""){$err = $err . "&nbsp; Email add is required!<br>";}
		else
		{
			$rsEmail = mysqli_query($con, "SELECT * FROM tbl_customer WHERE email = '$email'");
			if(mysqli_num_rows($rsEmail) >= 1){$err = $err . "&nbsp;Email add is already Taken";}
			else{			
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$err = $err . "&nbsp;Email add is Invalid!<br>";}
			}
			
		}
		
		if($pass == ""){$err = $err . "&nbsp;Password is required!<br>";}
		else{
			if($pass <> $conpass){ $err = $err . "&nbsp;Password did not match!<br>";}

		}
		
		if($contact == ""){$err = $err . "&nbsp;Contact number is required!&nbsp;<br></i>";}
		else
		{
			if(!is_numeric($contact)){$err = $err . "&nbsp;Contact number must be a number!<br>";}
			if(strlen($contact) != 14){$err = $err . "&nbsp;Contact number must be 14 characters in length!<br>";}
		}
		
		if($err == "")
		{
			mysqli_query($con,"INSERT INTO tbl_customer(firstname, lastname, PostCode, address, address2, state, countries, contactno, email, password, datetime) 
			VALUES('$fname','$lname','$PostCode','$address','$address2','$state','$countries','$contact','$email','$pass','$datetime')");
			?>
            
            	<script type="text/javascript">
				
					alert("Account Successfully Created!");
					document.location= "login.php";
				</script>
            
            <?php
		}
	}
	
?>
		<link href ="administrator/administrator/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>


    <div class="link">
			<!-- Top Navigation Menu -->
			<div class="navig-top clearfix">
				<a class="navig-icon navig-icon-prev" href="http://ebay.co.uk/"><span>EBAY SITE</span></a>
				<span class="right"><a class="navig-icon navig-icon-drop" href="http://monique-design.co.uk"><span>MONIQUE SITE</span></a></span>
			</div>
            
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>Register to <span>HWW</span></h1>
				<nav class="codrops-demos">
					<a href="index.php">Back to HOME</a>
				</nav>
            </header>
            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">  
                                <h1>Register</h1>
		  <?php
		  	if($err <> "")
		  		echo '<div style= " width:200px; background: -webkit-radial-gradient(center, ellipse cover,  #fcffff 0%,#e1ffff 0%,#fdffff 0%,#daecf6 0%,#daecf6 77%,#b5def4 91%,#7bcaf2 100%);
						font-size:1.3em;
						position:fixed;
						left:3%;
						top:200px;
						box-shadow:0px 0px 5px black;
						class="padding-left">
					<span><b><br><center> Please fill out this field(s)<font color="#FF0000">*</font>:</center></b></span><br>' . $err . '<br></div>'; 
		  ?>
                        <form method="post" action="register.php" enctype="multipart/form-data">
                                <p> 
                                    <td valign="top"  class="padding-right" align="right"><span class="content1">First Name<font color="#FF0000"> *</font></span> </td>
                                    <td valign="top"><input type="text" name="txtFname" size="70" value="<?php echo $fname; ?>"/></td>
                                </p>
                                <p> 
                                    <td valign="top" class="padding-right" align="right"><span class="content1">Last Name<font color="#FF0000"> *</font></span></td>
            	  					<td valign="top"><input type="text" name="txtLname" size="70" value="<?php echo $lname; ?>"/></td>
                                </p>
                               
                                <p> 
            	  <td valign="top" class="padding-right" align="right"><span class="content1">Address 1<font color="#FF0000"> *</font></span></td>
            	  <td valign="top"><input type="text" name="txtAddress" placeholder="House No / Street / Town" value="<?php echo $address; ?>"/></td>
            	  <td valign="top" class="padding-right" align="right"><span class="content1">Address 2<font color="#FF0000"> *</font></span></td>
            	  <td valign="top"><input type="text" name="txtAddress2" placeholder="House No / Street / Town" value="<?php echo $address2; ?>"/></td>
                                                
							  </p>
                                
                                <p>
                  <label for="txtState">City</label>
                    <select name=state>
					<option value="<?php echo $state; ?>"></option>
					<option value="Aberdeen City">Aberdeen City</option>
					<option value="Aberdeenshire">Aberdeenshire</option>
					<option value="Angus">Angus</option>
					<option value="Argyll & Bute">Argyll & Bute</option>
					<option value="Bath & North East Somerset">Bath & North East Somerset</option>
					<option value="Bedfordshire">Bedfordshire</option>
					<option value="Berkshire">Berkshire</option>
					<option value="Blaenau Gwent">Blaenau Gwent</option>
					<option value="Bridgend">Bridgend</option>
					<option value="Bristol">Bristol</option>
					<option value="Buckinghamshire">Buckinghamshire</option>
					<option value="Caerphilly">Caerphilly</option>
					<option value="Cambridgeshire">Cambridgeshire</option>
					<option value="Cardiff">Cardiff</option>
					<option value="Carmarthenshire">Carmarthenshire</option>
					<option value="Ceredidgion">Ceredidgion</option>
					<option value="Cheshire">Cheshire</option>
					<option value="ClackMannanshire">ClackMannanshire</option>
					<option value="Conwy">Conwy</option>
					<option value="Cornwall">Cornwall</option>
					<option value="Cumbria">Cumbria</option>
					<option value="Denbighshire">Denbighshire</option>
					<option value="Derbyshire">Derbyshire</option>
					<option value="Devon">Devon</option>
					<option value="Dorset">Dorset</option>
					<option value="Dumfries & Galloway">Dumfries & Galloway</option>
					<option value="Dundee City">Dundee City</option>
					<option value="Durham">Durham</option>
					<option value="East Ayrshire">East Ayrshire</option>
					<option value="East Dunbartonshire">East Dunbartonshire</option>
					<option value="East Lothian">East Lothian</option>
					<option value="East Renfrewshire">East Renfrewshire</option>
					<option value="East Riding of Yorkshire">East Riding of Yorkshire</option>
					<option value="East Sussex">East Sussex</option>
					<option value="Edinburgh">Edinburgh</option>
					<option value="Essex">Essex</option>
					<option value="Falkirk">Falkirk</option>
					<option value="Fife">Fife</option>
					<option value="Flintshire">Flintshire</option>
					<option value="Glasgow">Glasgow</option>
					<option value="Gloucestershire">Gloucestershire</option>
					<option value="Greater Manchester">Greater Manchester</option>
					<option value="Gwynedd">Gwynedd</option>
					<option value="Hampshire">Hampshire</option>
					<option value="Herefordshire">Herefordshire</option>
					<option value="Highlands">Highlands</option>
					<option value="Inverclyde">Inverclyde</option>
					<option value="Isle of Anglesey">Isle of Anglesey</option>
					<option value="Kent">Kent</option>
					<option value="Lancashire">Lancashire</option>
					<option value="Leicestershire">Leicestershire</option>
					<option value="Lincolnshire">Lincolnshire</option>
					<option value="London">London</option>
					<option value="Merseyside">Merseyside</option>
					<option value="Merthyr Tydfil">Merthyr Tydfil</option>
					<option value="Midlothian">Midlothian</option>
					<option value="Monmouthshire">Monmouthshire</option>
					<option value="Moray">Moray</option>
					<option value="Neath Port Talbot">Neath Port Talbot</option>
					<option value="Newport">Newport</option>
					<option value="Norfolk">Norfolk</option>
					<option value="North Ayrshire">North Ayrshire</option>
					<option value="North Lanarkshire">North Lanarkshire</option>
					<option value="North Somerset">North Somerset</option>
					<option value="North Somerset">North Somerset</option>
					<option value="Northamptonshire">Northamptonshire</option>
					<option value="Northumberland">Northumberland</option>
					<option value="Nottinghamshire">Nottinghamshire</option>
					<option value="Orkney">Orkney</option>
					<option value="Oxfordshire">Oxfordshire</option>
					<option value="Pembrokeshire">Pembrokeshire</option>
					<option value="Perth & Kinross">Perth & Kinross</option>
					<option value="Powys">Powys</option>
					<option value="Renfrewshire">Renfrewshire</option>
					<option value="Rhondda Cynon Taff">Rhondda Cynon Taff</option>
					<option value="Rutland">Rutland</option>
					<option value="Scottish Borders">Scottish Borders</option>
					<option value="Shetland">Shetland</option>
					<option value="Shropshire">Shropshire</option>
					<option value="Somerset">Somerset</option>
					<option value="South Lanarkshire">South Lanarkshire</option>
					<option value="South Yorkshire">South Yorkshire</option>
					<option value="Staffordshire">Staffordshire</option>
					<option value="Stirling">Stirling</option>
					<option value="Suffolk">Suffolk</option>
					<option value="Surrey">Surrey</option>
					<option value="Swansea">Swansea</option>
					<option value="Teesside">Teesside</option>
					<option value="Torfaen">Torfaen</option>
					<option value="Tyne & Wear">Tyne & Wear</option>
					<option value="Vale of Glamorgan">Vale of Glamorgan</option>
					<option value="Warwickshire">Warwickshire</option>
					<option value="West Dunbartonshire">West Dunbartonshire</option>
					<option value="West Lothian">West Lothian</option>
					<option value="West Midlands">West Midlands</option>
					<option value="West Sussex">West Sussex</option>
					<option value="West Yorkshire">West Yorkshire</option>
					<option value="Western Isles">Western Isles</option>
					<option value="Wiltshire">Wiltshire</option>
					<option value="Worcestershire">Worcestershire</option>
					<option value="Wrexham">Wrexham</option>
					</select>
                    </p>
                                
                    <p>
                    <label for="txtCountry">Country</label>
                        <select  name="countries">
						<option value="<?php echo $countries; ?>"></option>
						<option value="Afghanistan"></option>
						<option value="Afghanistan">United Kingdom</option>
						<option value="Afghanistan">Afghanistan</option>
						<option value="Åland Islands">Åland Islands</option>
						<option value="Albania">Albania</option>
						<option value="Algeria">Algeria</option>
						<option value="American Samoa">American Samoa</option>
						<option value="Andorra">Andorra</option>
						<option value="Angola">Angola</option>
						<option value="Anguilla">Anguilla</option>
						<option value="Antarctica">Antarctica</option>
						<option value="Antigua and Barbuda">Antigua and Barbuda</option>
						<option value="Argentina">Argentina</option>
						<option value="Armenia">Armenia</option>
						<option value="Aruba">Aruba</option>
						<option value="Australia">Australia</option>
						<option value="Austria">Austria</option>
						<option value="Azerbaijan">Azerbaijan</option>
						<option value="Bahamas">Bahamas</option>
						<option value="Bahrain">Bahrain</option>
						<option value="Bangladesh">Bangladesh</option>
						<option value="Barbados">Barbados</option>
						<option value="Belarus">Belarus</option>
						<option value="Belgium">Belgium</option>
						<option value="Belize">Belize</option>
						<option value="Benin">Benin</option>
						<option value="Bermuda">Bermuda</option>
						<option value="Bhutan">Bhutan</option>
						<option value="Bolivia">Bolivia</option>
						<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
						<option value="Botswana">Botswana</option>
						<option value="Bouvet Island">Bouvet Island</option>
						<option value="Brazil">Brazil</option>
						<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
						<option value="Brunei Darussalam">Brunei Darussalam</option>
						<option value="Bulgaria">Bulgaria</option>
						<option value="Burkina Faso">Burkina Faso</option>
						<option value="Burundi">Burundi</option>
						<option value="Cambodia">Cambodia</option>
						<option value="Cameroon">Cameroon</option>
						<option value="Canada">Canada</option>
						<option value="Cape Verde">Cape Verde</option>
						<option value="Cayman Islands">Cayman Islands</option>
						<option value="Central African Republic">Central African Republic</option>
						<option value="Chad">Chad</option>
						<option value="Chile">Chile</option>
						<option value="China">China</option>
						<option value="Christmas Island">Christmas Island</option>
						<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
						<option value="Colombia">Colombia</option>
						<option value="Comoros">Comoros</option>
						<option value="Congo">Congo</option>
						<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
						<option value="Cook Islands">Cook Islands</option>
						<option value="Costa Rica">Costa Rica</option>
						<option value="Cote D'ivoire">Cote D'ivoire</option>
						<option value="Croatia">Croatia</option>
						<option value="Cuba">Cuba</option>
						<option value="Cyprus">Cyprus</option>
						<option value="Czech Republic">Czech Republic</option>
						<option value="Denmark">Denmark</option>
						<option value="Djibouti">Djibouti</option>
						<option value="Dominica">Dominica</option>
						<option value="Dominican Republic">Dominican Republic</option>
						<option value="Ecuador">Ecuador</option>
						<option value="Egypt">Egypt</option>
						<option value="El Salvador">El Salvador</option>
						<option value="Equatorial Guinea">Equatorial Guinea</option>
						<option value="Eritrea">Eritrea</option>
						<option value="Estonia">Estonia</option>
						<option value="Ethiopia">Ethiopia</option>
						<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
						<option value="Faroe Islands">Faroe Islands</option>
						<option value="Fiji">Fiji</option>
						<option value="Finland">Finland</option>
						<option value="France">France</option>
						<option value="French Guiana">French Guiana</option>
						<option value="French Polynesia">French Polynesia</option>
						<option value="French Southern Territories">French Southern Territories</option>
						<option value="Gabon">Gabon</option>
						<option value="Gambia">Gambia</option>
						<option value="Georgia">Georgia</option>
						<option value="Germany">Germany</option>
						<option value="Ghana">Ghana</option>
						<option value="Gibraltar">Gibraltar</option>
						<option value="Greece">Greece</option>
						<option value="Greenland">Greenland</option>
						<option value="Grenada">Grenada</option>
						<option value="Guadeloupe">Guadeloupe</option>
						<option value="Guam">Guam</option>
						<option value="Guatemala">Guatemala</option>
						<option value="Guernsey">Guernsey</option>
						<option value="Guinea">Guinea</option>
						<option value="Guinea-bissau">Guinea-bissau</option>
						<option value="Guyana">Guyana</option>
						<option value="Haiti">Haiti</option>
						<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
						<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
						<option value="Honduras">Honduras</option>
						<option value="Hong Kong">Hong Kong</option>
						<option value="Hungary">Hungary</option>
						<option value="Iceland">Iceland</option>
						<option value="India">India</option>
						<option value="Indonesia">Indonesia</option>
						<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
						<option value="Iraq">Iraq</option>
						<option value="Ireland">Ireland</option>
						<option value="Isle of Man">Isle of Man</option>
						<option value="Israel">Israel</option>
						<option value="Italy">Italy</option>
						<option value="Jamaica">Jamaica</option>
						<option value="Japan">Japan</option>
						<option value="Jersey">Jersey</option>
						<option value="Jordan">Jordan</option>
						<option value="Kazakhstan">Kazakhstan</option>
						<option value="Kenya">Kenya</option>
						<option value="Kiribati">Kiribati</option>
						<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
						<option value="Korea, Republic of">Korea, Republic of</option>
						<option value="Kuwait">Kuwait</option>
						<option value="Kyrgyzstan">Kyrgyzstan</option>
						<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
						<option value="Latvia">Latvia</option>
						<option value="Lebanon">Lebanon</option>
						<option value="Lesotho">Lesotho</option>
						<option value="Liberia">Liberia</option>
						<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
						<option value="Liechtenstein">Liechtenstein</option>
						<option value="Lithuania">Lithuania</option>
						<option value="Luxembourg">Luxembourg</option>
						<option value="Macao">Macao</option>
						<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
						<option value="Madagascar">Madagascar</option>
						<option value="Malawi">Malawi</option>
						<option value="Malaysia">Malaysia</option>
						<option value="Maldives">Maldives</option>
						<option value="Mali">Mali</option>
						<option value="Malta">Malta</option>
						<option value="Marshall Islands">Marshall Islands</option>
						<option value="Martinique">Martinique</option>
						<option value="Mauritania">Mauritania</option>
						<option value="Mauritius">Mauritius</option>
						<option value="Mayotte">Mayotte</option>
						<option value="Mexico">Mexico</option>
						<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
						<option value="Moldova, Republic of">Moldova, Republic of</option>
						<option value="Monaco">Monaco</option>
						<option value="Mongolia">Mongolia</option>
						<option value="Montenegro">Montenegro</option>
						<option value="Montserrat">Montserrat</option>
						<option value="Morocco">Morocco</option>
						<option value="Mozambique">Mozambique</option>
						<option value="Myanmar">Myanmar</option>
						<option value="Namibia">Namibia</option>
						<option value="Nauru">Nauru</option>
						<option value="Nepal">Nepal</option>
						<option value="Netherlands">Netherlands</option>
						<option value="Netherlands Antilles">Netherlands Antilles</option>
						<option value="New Caledonia">New Caledonia</option>
						<option value="New Zealand">New Zealand</option>
						<option value="Nicaragua">Nicaragua</option>
						<option value="Niger">Niger</option>
						<option value="Nigeria">Nigeria</option>
						<option value="Niue">Niue</option>
						<option value="Norfolk Island">Norfolk Island</option>
						<option value="Northern Mariana Islands">Northern Mariana Islands</option>
						<option value="Norway">Norway</option>
						<option value="Oman">Oman</option>
						<option value="Pakistan">Pakistan</option>
						<option value="Palau">Palau</option>
						<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
						<option value="Panama">Panama</option>
						<option value="Papua New Guinea">Papua New Guinea</option>
						<option value="Paraguay">Paraguay</option>
						<option value="Peru">Peru</option>
						<option value="Philippines">Philippines</option>
						<option value="Pitcairn">Pitcairn</option>
						<option value="Poland">Poland</option>
						<option value="Portugal">Portugal</option>
						<option value="Puerto Rico">Puerto Rico</option>
						<option value="Qatar">Qatar</option>
						<option value="Reunion">Reunion</option>
						<option value="Romania">Romania</option>
						<option value="Russian Federation">Russian Federation</option>
						<option value="Rwanda">Rwanda</option>
						<option value="Saint Helena">Saint Helena</option>
						<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
						<option value="Saint Lucia">Saint Lucia</option>
						<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
						<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
						<option value="Samoa">Samoa</option>
						<option value="San Marino">San Marino</option>
						<option value="Sao Tome and Principe">Sao Tome and Principe</option>
						<option value="Saudi Arabia">Saudi Arabia</option>
						<option value="Senegal">Senegal</option>
						<option value="Serbia">Serbia</option>
						<option value="Seychelles">Seychelles</option>
						<option value="Sierra Leone">Sierra Leone</option>
						<option value="Singapore">Singapore</option>
						<option value="Slovakia">Slovakia</option>
						<option value="Slovenia">Slovenia</option>
						<option value="Solomon Islands">Solomon Islands</option>
						<option value="Somalia">Somalia</option>
						<option value="South Africa">South Africa</option>
						<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
						<option value="Spain">Spain</option>
						<option value="Sri Lanka">Sri Lanka</option>
						<option value="Sudan">Sudan</option>
						<option value="Suriname">Suriname</option>
						<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
						<option value="Swaziland">Swaziland</option>
						<option value="Sweden">Sweden</option>
						<option value="Switzerland">Switzerland</option>
						<option value="Syrian Arab Republic">Syrian Arab Republic</option>
						<option value="Taiwan, Province of China">Taiwan, Province of China</option>
						<option value="Tajikistan">Tajikistan</option>
						<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
						<option value="Thailand">Thailand</option>
						<option value="Timor-leste">Timor-leste</option>
						<option value="Togo">Togo</option>
						<option value="Tokelau">Tokelau</option>
						<option value="Tonga">Tonga</option>
						<option value="Trinidad and Tobago">Trinidad and Tobago</option>
						<option value="Tunisia">Tunisia</option>
						<option value="Turkey">Turkey</option>
						<option value="Turkmenistan">Turkmenistan</option>
						<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
						<option value="Tuvalu">Tuvalu</option>
						<option value="Uganda">Uganda</option>
						<option value="Ukraine">Ukraine</option>
						<option value="United Arab Emirates">United Arab Emirates</option>
						<option value="United Kingdom">United Kingdom</option>
						<option value="United States">United States</option>
						<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
						<option value="Uruguay">Uruguay</option>
						<option value="Uzbekistan">Uzbekistan</option>
						<option value="Vanuatu">Vanuatu</option>
						<option value="Venezuela">Venezuela</option>
						<option value="Viet Nam">Viet Nam</option>
						<option value="Virgin Islands, British">Virgin Islands, British</option>
						<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
						<option value="Wallis and Futuna">Wallis and Futuna</option>
						<option value="Western Sahara">Western Sahara</option>
						<option value="Yemen">Yemen</option>
						<option value="Zambia">Zambia</option>
						<option value="Zimbabwe">Zimbabwe</option>
						</select>
								</p>
                                
                                <p>
				 
				  
				  <td valign="top" class="padding-right" align="right"><span class="content1">Post Code<font color="#FF0000"> *</font></span></td>
				  <td valign="top"><input type="text" name="PostCode" style="width:47%;" /></td>
                                </p>
                                
                                <p>
            	  <td valign="top" class="padding-right" align="right"><span class="content1">Email Address<font color="#FF0000"> *</font></span></td>
            	  <td valign="top"><input type="text" name="txtEmail"/></td>
                                </p>
                                
                                <p>
            	  <td valign="top" class="padding-right" align="right"><span class="content1">Password<font color="#FF0000"> *</font></span></td>
            	  <td valign="top"><input type="password" name="txtPass"/></td>
                                </p>
                                
                                <p>
            	  <td valign="top" class="padding-right" align="right"><span class="content1">Confirm Password<font color="#FF0000"> *</font></span></td>
            	  <td valign="top"><input type="password" name="txtConPass" size="70" /></td>
                                </p>
                                
                                <p> 
                                    <label for="txtContact"> Contact Number<font color="#FF0000"> *</font></label>
                                    <input id="txtContact" name="txtContact" type="text" value="<?php echo $contact; ?>"/>
                                </p>
                                
								
								
								
								<SCRIPT language=JavaScript>

							//Accept terms & conditions script (by InsightEye www.insighteye.com)
							//Visit JavaScript Kit (http://javascriptkit.com) for this script & more.

							function checkbox{
							if (agree.checked == false )
							{
							confirm('Please check the box to continue.');
							return false;
							}else
							return true;
							}
							//-->
							</SCRIPT>

							<!--Enter your form contents here-->
							<b>Notes:</b><br />
							By Signing up in this registration form means that you are accepting our<br><i>User <a href="home/Contruction.php">Terms</a> and <a href="home/Contruction.php">Agreements</a></i>.<br />
							<br><input type="checkbox" onclick="checkbox()" value="0" name="agree"> I accept: 

                                <p class="login button"> 
                                    <input type="submit" name="cmdRegister" class="click" value="Register" /> 
								</p>
                            </form>
                             <b>required:</b><br />
								All Fields marked with asterisk (<font color="#FF0000">*</font>) are required.<br />
								</div>

                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>