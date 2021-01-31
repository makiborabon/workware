<?php
	//Start session
	session_start();	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_EMAIL']);
	unset($_SESSION['SESS_FIRST_NAME']);
?>

<!DOCTYPE html>
<head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style_log.css" />
	
</head>
<body>

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
                <h1>Sign to <span>HWW</span></h1>
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
                            <form class="input1"  name="loginform" action="login_exe.php" method="post" autocomplete="on"> 
                                <h1>Log in</h1>
								<?php
									if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
									echo '<ul class="err">';
									foreach($_SESSION['ERRMSG_ARR'] as $msg) {
										echo '<li>',$msg,'</li>'; 
										}
									echo '</ul>';
									unset($_SESSION['ERRMSG_ARR']);
									}
								?>                                
                                <p> 
                                    <label for="username" data-icon="u" > Your email Address </label>
                                    <input id="username" name="email" required type="text" placeholder="yourmail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required type="password" placeholder="*******" /> 
									
								</p>
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
									<br><br>
									<a href='#'>forgot?</a>
								</p>
                                <p class="login button"> 
                                    <input type="submit" class="click" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href ="register.php" class="to_register">Register Here</a> to get discounts.
								</p>
                            </form>
                        </div>

                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>