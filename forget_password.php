<?php

include "db.php";
$db = new Database;


?>
<h3>Request for new password</h3>
<hr>
<p>Enter your Email address</p>
<form action="" method="post">
	<input type="email" name="recovery_email" placeholder="Enter your email" required/><br/><br/>
	<input type="submit" name="lost_password" value="Request new password"/>
</form>
<?php

if (isset($_POST["lost_password"])) {
	$email = mysqli_real_escape_string($db->con,$_POST["recovery_email"]);
	$sql = "SELECT id,note FROM user_info WHERE u_email = '$email' AND activated = '1' LIMIT 1";
	$query = mysqli_query($db->con,$sql);
	if(mysqli_num_rows($query) == 1){
		$row = mysqli_fetch_array($query);
		$uid = $row["id"];
		$note = $row["note"];
		//to make user the given email address is correct or not we will send email him/her to confirm
		if($note != ""){
			echo "Please check your email address we have already sended you a password reset link";
			exit();
		}else{
			//Here we will generate some random number
			$random_note = time().rand(50000,100000);
			$random_note = str_shuffle($random_note);
			$update_note = "UPDATE user_info SET note = '$random_note' WHERE id='$uid' AND u_email = '$email'";
			if(mysqli_query($db->con,$update_note)){
				$to = $email;
				$sub = "Reset Password";
				$msg = "Please click on the given link or copy url to reset your password<br/>";
				$msg .= "http://www.yourdomainname.com/password_reset.php?note=".$random_note."&uid=".$uid."&email=".$email;
				$header = "From : Rk tutorial";
				if(mail($to,$sub,$msg,$header)){
					echo "Please confirm your email to reset your password<br/>";
					echo "Email temporarily Displyed here<br/>".$msg;
					exit();
				}
			}
			
		}
		
	}else{
		echo "Your email address not exits";
	}
}


?>