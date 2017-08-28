$(document).ready(function(){
	function verify_email(email){
		$(".e_error").hide();
		if(email == ""){
			$(".e_error").show();
			$(".e_error").html("Please enter email address");
		}else{
			$.ajax({
				url : "action.php",
				method  : "POST",
				data : {check_email:1,email:email},
				success : function(data){
					$(".e_error").show();
					if(data == "already_exists"){
						$(".e_error").html("Email Already Exists");
					}else if(data == "invalid_email"){
						$(".e_error").html("Invalid Email Address");
					}else if(data == "ok"){
						$(".e_error").html("ok");
					}
				}
			})
		}
			
		
	}
	$("#u_email").focusout(function(){
		var email = $("#u_email").val();
		verify_email(email);
	})
	//Register user
	$("#register_form").on("submit",function(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : $("#register_form").serialize(),
			success : function(data){
				alert(data);
				if(data == "empty_fields"){
					alert("Please fill all fields");
				}
				if(data == "email_send_success"){
					window.location.href = "verify_email.php";
				}
			}
		})
	})
	$("#login_form").on("submit",function(){
		var log_email = $("#log_email").val();
		var log_password = $("#log_password").val();
		if(log_email == "" || log_password == ""){
			alert("Please enter email or password");
		}else{
			$("#login").html("Exexcuting...");
			$.ajax({
				url : "action.php",
				method : "POST",
				data : $("#login_form").serialize(),
				success : function(data){
					alert(data);
					if(data == "login_success"){
						window.location.href = "profile.php";
					}
				}
			})
		}
	})
	
})











