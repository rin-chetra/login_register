<?php

session_start();

/*
Process will contain methods like
1 - Check validation and existence of email in our database
2 - Insertion of Record
3 - Send Action link to user email Address
4 - Selection of Record 
*/

//Add databse page
include "db.php";
class Process extends Database
{
	public function verify_email($table,$email){
		//rizwankhan.august16@gmail.com
		$regexp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		if(!preg_match($regexp,$email)){
			return "invalid_email";
		}
		//Check email already exists or not
		$sql = "SELECT id FROM ".$table." WHERE u_email = '$email' LIMIT 1";
		$query = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows($query);
		if($count == 1){
			return "already_exists";
		}else{
			return "ok";
		}
	}
	public function insert_record($table,$input){
		$sql = "";
		$sql .= "INSERT INTO ".$table." ";
		$sql .= "(".implode(",",array_keys($input)).") VALUES ";
		$sql .= "('".implode("','", array_values($input))."')";
		$query = mysqli_query($this->con,$sql);
		$last_id = mysqli_insert_id($this->con);
		if($query){
			return $last_id;
		}
	}
	public function send_activation_code($email,$act_code,$uid){
			$to = $email;
			$subject = 'Activation Link from Webscript.info';
			$from = 'rizwankhan@webscript.info';//Its not valid email Address
			 
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers .= 'From: '.$from."\r\n".
			    'Reply-To: '.$from."\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			 
			// Compose a simple HTML email message
			$message = '<html><body>';
			$message .= '<h1 style="color:#f40;">Hi '.$email.'</h1>';
			$message .= '<p style="color:#333;font-size:14px;font-family:san-serif,Arial;">Please Click on given link to activate your account</p>';
			$message .= "<a href='http://www.webscript.info/register_login/activation_code.php?ACTIVATION_CODE=".$act_code."&uid=".$uid."&ue=".$email."'>Click here</a>";
			$message .= '</body></html>';
			 
			// Sending email
			if(mail($to, $subject, $message, $headers)){
			   return true;
			} else{
			    return false;
			}
	}
	public function select_record($table,$where_condition){
		$sql = "";
		$condition = "";
		$array = array();
		foreach ($where_condition as $key => $value) {
			$condition .= $key . "='".$value."' AND ";
		}
		$condition = substr($condition, 0,-5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_array($query)) {
			$array = $row;
		}
		return $array;
	}
}
$obj = new Process;

if(isset($_POST["check_email"])){
	$email = $_POST["email"];
	echo $data = $obj->verify_email("user_info",$email);
	exit();
}

if(isset($_POST["u_email"])){
	if (empty($_POST["gender"]) || empty($_POST["lang"])) {
		echo "empty_fields";
		exit();
	}
	$name = preg_replace("#[^A-Za-z ]#i", "", $_POST["name"]);
	$data = $obj->verify_email("user_info",$_POST["u_email"]);
	if($data == "already_exists"){
		echo "Email Already Exists";
		exit();
	}else{
		$email = $_POST["u_email"];
	}
	$gender = preg_replace("#[^a-z]#i", "", $_POST["gender"]);
	$country = preg_replace("#[^A-Za-z ]#i", "", $_POST["u_country"]);
	$lang = $_POST["lang"];
	$count = COUNT($lang);
	$languages = "";
	for($i=0;$i<$count;$i++){
		$languages .= $lang[$i].",";
	}
	$languages = substr($languages, 0, -1);
	$languages = preg_replace("#[^A-Za-z,]#i", "", $languages);
	$password = $_POST["password"];
	$repassword = $_POST["repassword"];
	//Start Validation from here
	if(empty($name) || empty($password) || empty($languages) || empty($country)){
		echo "empty_fields";
		exit();
	}
	if(strlen($password) < 9){
		echo "password_short";
		exit();
	}
	if($password != $repassword){
		echo "not_same";
		exit();
	}else{
		//Hash Password
		$options = ["COST" => 12];
		$hash_password = password_hash($password,PASSWORD_DEFAULT,$options);
	}
	$signup_date = date("Y-m-d H:i:s");
	$act_code = time().md5($email).rand(50000,1000000);
	$act_code = str_shuffle($act_code);
	$user = array("u_name"=>$name,"u_email"=>$email,"gender"=>$gender,"languages"=>$languages,"country"=>$country,"password"=>$hash_password,"signup_date"=>$signup_date,"last_login"=>$signup_date,"act_code"=>$act_code,"activated"=>"0");
	$id = $obj->insert_record("user_info",$user);
	if($id){
		//rizwan@gmail.com
		$username = explode("@", $email);
		$userdir = $username[0];
		if(!file_exists("user/$userdir".$id)){
			mkdir("user/$userdir".$id,0755);
		}
		if ($obj->send_activation_code($email,$act_code,$id)) {
			echo "email_send_success";
			exit();
		}
		
	}
}


//User Login Process
if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
	$data = $obj->verify_email("user_info",$_POST["log_email"]);
	if($data == "ok"){
		echo "not_exists";
		exit();
	}else if($data == "invalid_email"){
		echo "invalid_email";
		exit();
	}else if($data == "already_exists"){
		$email = array("u_email"=>$_POST["log_email"]);
		$row = $obj->select_record("user_info",$email);
		$activated = $row["activated"];
		if($activated == '1'){
			if(password_verify($_POST["log_password"],$row["password"])){
				//Session Variables
				$_SESSION["name"] = $row["u_name"];
				$_SESSION["id"] = $row["id"];
				$_SESSION["email"] = $row["u_email"];
				$_SESSION["password"] = $row["password"];
				//Cookies
				setcookie("id",$row["id"],strtotime("+1 day"),"/","","",TRUE);
				setcookie("name",$row["u_name"],strtotime("+1 day"),"/","","",TRUE);
				setcookie("email",$row["u_email"],strtotime("+1 day"),"/","","",TRUE);
				setcookie("p",$row["password"],strtotime("+1 day"),"/","","",TRUE);
				echo "login_success";
				exit();
			}
		}else if ($activated == '0'){
			echo "Please verify your email Address";
			exit();
		}
	}
}

?>