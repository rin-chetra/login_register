<?php


include "login_status.php";
if (!$login_key) {
	header("location:login.php");
}


echo "This page is for ".$_SESSION["name"]." only";
	echo "<br/><a href='logout.php'>Logout</a>";



?>
