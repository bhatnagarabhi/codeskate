<?php 
	session_start();
	error_reporting(0);
	if($_SESSION['admin_id']!='') {
		header("Location:dashboard");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width", initital-scale="1">
	<meta name="description" content="">
	<meta name="author" content="">
</head>
<body>

	<!-- CORE BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<!-- GENERIC CSS -->
	<link rel="stylesheet" type="text/css" href="css/generic.css">

	<!-- FONT-AWESOME -->
	<link rel="stylesheet" type="text/css" href="../css/font-awesome/css/font-awesome.min.css">

	 <!-- JQUERY -->
	<script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>

	<!-- BOOTSTRAP CORE
	==================================== -->
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4" id="login-form">
				<div id="admin-pic" class="text-center">
					<i style="font-size: 50px; color: white; padding:20px 25px; border-radius: 100%" class="fa fa-user bg-theme"></i>
				</div><!-- admin-pic -->
				<div id="form-header" class="text-center">
					<h4>ADMINISTRATOR</h4>
					<p>Sign in to get access.</p>
					<hr>
				</div><!-- form-header -->
				<div id="form-content">	
					<form method="post" id="frm-admin-login">
						<input type="text" id="username" required class="form-control" name="username" placeholder="Username"><br>
						<input type="password" id="password" required class="form-control" name="password" placeholder="Password"><br>
						<center><button class="btn btn-primary btn-lg bg-theme" style="border:0px solid;"><i class="fa fa-sign-in"></i> Sign in </button></center>
					</form>
				</div><!-- form-content -->
			</div><!-- col-sm-4 -->
		</div><!-- row -->
	</div><!-- container-fluid -->
</body>
</html>

<style type="text/css">
	body {
		background-color: #303035;
	}
	#admin-pic {
		margin-top: -78px;
	}
	#login-form {
		background-color: white;
		border-radius: 4px;
		padding-bottom: 25px;
		padding-top: 30px;
		margin-top: 150px;
	}
	input::-webkit-input-placeholder {
	color: #888 !important;
	}
	 
	input:-moz-placeholder { /* Firefox 18- */
	color: #888 !important;  
	}
	 
	input::-moz-placeholder {  /* Firefox 19+ */
	color: #888 !important;  
	}
	 
	input:-ms-input-placeholder {  
	color: #888 !important;  
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('submit', '#frm-admin-login', function(event) {
			event.preventDefault();
			var username 		=  $('#username').val();
			var password 		= $('#password').val();
			$.ajax({
				url: 'inc/login.php',
				type: 'POST',
				dataType: 'json',
				data: {username: username, password: password},
				success:function(response, status, http){
					if(response[0]) {
						alert("Login successful");
						location.reload();
					} else {
						alert("Invalid credentials");
					}
				}
			});			
		});
	});
</script>