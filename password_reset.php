<?php

include "db.php";
$db = new Database;

if(isset($_REQUEST["note"]) AND isset($_REQUEST["uid"]) AND isset($_REQUEST["email"])){
	$note = preg_replace("#[^0-9]#", "", $_REQUEST["note"]);
	$uid = preg_replace("#[^0-9]#", "", $_REQUEST["uid"]);
	$email = mysqli_real_escape_string($db->con,$_REQUEST["email"]);

	$sql = "SELECT id FROM user_info WHERE note = '$note' AND u_email = '$email' AND id = '$uid' LIMIT 1";
	$query = mysqli_query($db->con,$sql);
	if($query){
		?>
			<h3>Reset your password</h3>
			<hr>
			<form method="post" action="">
				<input type="hidden" name="id" value="<?php echo $uid; ?>">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
				<input type="password" name="new_password" placeholder="New Password" required/><br/><br/>
				<input type="password" name="confirm_password" placeholder="Confirm Password" required/><br/><br/>
				<input type="submit" name="change_password" value="Reset Password"/>
			</form>
		<?php
	}else{
		echo "Error : Please try again..!";
	}

}

if(isset($_POST["change_password"])){
	$n_pass = $_POST["new_password"];
	$c_pass = $_POST["confirm_password"];
	$id = $_POST["id"];
	$email = $_POST["email"];

	if(strlen($n_pass) < 9){
		echo "Password Length is short";
		exit();
	}else{
		if($n_pass == $c_pass){
			$option = [ "COST" => 12 ];
			$hash_password = password_hash($n_pass,PASSWORD_DEFAULT,$option);
			$change_pass_sql = "UPDATE user_info SET password = '$hash_password',note='' WHERE id='$id' AND u_email = '$email'";
			$query = mysqli_query($db->con,$change_pass_sql) or die(mysqli_error($db->con));
			if($query){
				echo "Your password is reset Now you can login";
			}
		}
	}
}


?>