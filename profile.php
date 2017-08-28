<?php

include 'login_status.php';

if (!$login_key) {
	header("location:login.php");
}
	



if(!isset($_SESSION["id"])){
	header("location:index.php");
}

echo "Hi Mr.".$_SESSION["name"]." your id is ".$_SESSION["id"];
echo "<br/>";
echo "Cookies"."<br/>";
echo $_COOKIE["id"]."<br/>";
echo $_COOKIE["name"]."<br/>";
echo $_COOKIE["email"]."<br/>";
echo $_COOKIE["p"]."<br/>";

?>
<br/>
<a href="logout.php">Logout</a>