<?php

include 'login_status.php';

if ($login_key) {
	header("location:profile.php");
}
	


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Register & Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" href="" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>
<style type="text/css">
body{
	margin: 0;
	padding: 0;
	background: #333;
}
.form{
	width: 500px;
	padding: 20px;
	background: #eee;
	border-radius: 5px;
	box-shadow: 1px 1px 1px gray;
	margin: 25px auto;
	color: #333;
	font-family: sans-serif,Arial;
}
label{
	font-weight: bold;
}
.input{
	width: 100%;
	height: 50px;
}
.input>div{
	float: left;
	min-width: 200px;
}
input[type="text"],
input[type="password"],
input[type="email"],
.input-opt{
	width: 200px;
	height: 30px;
	border-radius: 5px;
	color: gray;
	font-size: 16px;
	font-family: sans-serif,Arial;
	outline: none;
	margin-top: 5px;
	border: 2px solid #ddd;
}
.error{
	color: red;
	font-family: sans-serif,Arial;
	font-size: 14px;
	margin: 12px;
}
.correct{
	color: darkgreen;
	font-size: 16px;
	font-family: sans-serif,Arial;
}
.wrong{
	color:green;
}
.log_reg>a{
	color: #fff;
	font-size: 16px;
	font-family: sans-serif,Arial;
	text-decoration: none;
	padding: 20px;
}
</style>

</head>

<body>
	<div class="log_reg">
		<a href="index.php">Register</a> | <a href="login.php">Login</a>
	</div>
<div class="form">
	<h2>Login</h2>
	<hr>
	<p id="msg"></p>
	<!--Form start here-->
	<form onsubmit="return false" method="post" id="login_form">
	<label>Email</label>
	<div class="input">
		<div>
			<input type="email" placeholder="Email" name="log_email" id="log_email">
		</div>
		<div class="error e_error"></div>
	</div>	
	<label>Password</label>
	<div class="input">
		<div>
			<input type="password" placeholder="Password" name="log_password" id="log_password">
		</div>
		<div class="error u_error"></div>
	</div>
	<div class="input">
		<div>
			<input type="submit" name="login" id="login" value="Login">
		</div>
	</div>
	</form>
	<div>
		<a href="forget_password.php">Have you lost your password ?</a>
	</div>
</div>

</body>
</html>