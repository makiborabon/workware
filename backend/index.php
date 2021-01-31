<?php
include('login-exe.php'); // Includes Login Script
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form in PHP with Session</title>
<link href="log-css.css" rel="stylesheet" type="text/css">
<style>body{background:url('image/bg.jpg');}</style>
</head>
<body>
<div id="main">
<h1>Content Management System</h1>

<div id="login" style="background:white;">
<h2>Login</h2>
<form action="" method="post">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password"><br><br>
<input name="submit" type="submit" value=" Login ">
<center><span><?php echo $error; ?></span></center>
</form>
</div>
</div>
</body>
</html>