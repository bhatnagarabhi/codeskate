<!-- JQUERY UI CSS -->
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">

<!-- JQUERY UI JS -->
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<section id="register-form" style="padding-top: 120px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 black-fg">
				<form class="form-horizontal font-bold fg-white" style="padding: 30px; background-color: #dd5050; border-radius: 3px;" method="post" id="frm-register" action="inc/register_user">
					<fieldset>
						    <legend class="fg-white">Register with Codeskate <sup>&copy;</sup></legend>
						    <div class="form-group">
							      <label for="fullname" class="col-lg-3 control-label">Full name : </label>
							      <div class="col-lg-9">
							      	<input type="text" placeholder="Full name" id="fullname" name="fullname" required class="form-control fg-white">
							      </div>
						     </div>
						     <div class="form-group">
							      <label for="email" class="col-lg-3 control-label">Email : </label>
							      <div class="col-lg-9">
							      	<input type="email" placeholder="Email" id="email" name="email" required class="form-control fg-white">
							      </div>
						     </div>
						     <div class="form-group">
							      <label for="username" class="col-lg-3 control-label">Username : </label>
							      <div class="col-lg-9">
							      	<input type="text" maxlength="20" minlength="5" required placeholder="Username (A maximum of 20 characters allowed)" id="username" name="username" class="form-control fg-white">
							      </div>
						     </div>
						     <div class="form-group">
							      <label for="password" class="col-lg-3 control-label">Password : </label>
							      <div class="col-lg-9">
							      	<input type="password" maxlength="20" minlength="8" required placeholder="Password (A minimum of 8 characters allowed)" id="password" name="password" class="form-control fg-white">
							      </div>
						     </div>
						     <div class="form-group">
							      <label for="cpassword" class="col-lg-3 control-label">Confirm password : </label>
							      <div class="col-lg-9">
							      	<input type="password" maxlength="20" minlength="8" required placeholder="Confirm password" id="cpassword" name="cpassword" class="form-control fg-white">
							      </div>
						     </div>
						     <div class="form-group">
							      <label for="datepicker" class="col-lg-3 control-label">Date of birth : </label>
							      <div class="col-lg-9">
							      	<input type="text" name="dob" id="datepicker" required placeholder="mm/dd/yyyy" class="form-control fg-white">
							      </div>
						     </div>
						      <div class="form-group">
							      <div class="col-sm-6 col-sm-offset-3 text-center">
							      	<button type="text" name="submit" value="true" id="submit" required class="btn btn-default theme-fg" style="margin-top: 20px;"><i class="fa fa-check-circle"></i> Register</button>
							      </div>
						     </div>
					</fieldset>
				</form>
			</div>
		</div><!-- row -->
	</div><!-- container -->
</section>

<style type="text/css">
	input::-webkit-input-placeholder {
	color: #ddd !important;
	}
	 
	input:-moz-placeholder { /* Firefox 18- */
	color: #ddd !important;  
	}
	 
	input::-moz-placeholder {  /* Firefox 19+ */
	color: #ddd !important;  
	}
	 
	input:-ms-input-placeholder {  
	color: #ddd !important;  
	}
	input[type="checkbox"]:after {
		border: 2px solid #222;
	}
	.ui-datepicker select.ui-datepicker-year{
		background-color: #fff;
		color: #222;
		padding: 3px;
		color: #dd5050;
		font-weight: bold;
	}
</style>

<script type="text/javascript">
	$( function() {
		$( "#datepicker" ).datepicker({ 
			changeYear : true,
			minYear: "-100Y", maxDate: "-12Y" 
		});
	  } );

	$(document).ready(function(){
		var username 			= "";
		var username_verified 		= false;
		var email_verified 		= false;
		$(document).on('blur', '#username', function(event) {
			username 	= $(this).val();
			// Ajax call to check if the username is available or not
			$.ajax({
				url: 'inc/check_available_username.php',
				type: 'POST',
				dataType: 'json',
				data: "username="+username,
				success: function(response, status, http){
					if(response[0]){
						$('#show-username-success-modal').click();
						username_verified = true;
					} else {
						$('#show-username-failure-modal').click();
						username_verified = false;
					}
				}
			});			
		});
		$(document).on('blur', '#email', function(event) {
			email 		= $(this).val();
			// Ajax call to check if the email is available or not
			$.ajax({
				url: 'inc/check_available_email.php',
				type: 'POST',
				dataType: 'json',
				data: "email="+email,
				success: function(response, status, http){
					if(!response[0]){
						$('#show-email-failure-modal').click();
						email_verified = false;
					} else {
						email_verified = true;
					}
				}
			});
		});

		

		$(document).on('submit', '#frm-register', function(event) {
			var password_verified 		= false;
			/* Act on the event */
			var password 			= $('#password').val();
			var cpassword 		= $('#cpassword').val();
			if(password!=cpassword){
				// Passwords do not match
				$('#show-pass-mismatch-modal').click();
				event.preventDefault();	
			} else {
				// Passwords match
				password_verified = true;
			}
			if(username_verified&&password_verified&&email_verified){
				$('#submit').css('opacity','0');
				$("#frm-register").submit();
			} else {
				//$('#show-username-failure-modal').click();
				event.preventDefault();	
			}
		});
	});

</script>