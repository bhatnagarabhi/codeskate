<?php 
	// Initialization for the encryption
	$method = base64_decode('QUVTLTEyOC1DQkM=');
	$pass = base64_decode('MTQoKWo1NzBhYm02bmMyM2RnaGkkJV4mKms4OWxvcHFyZUBmc3R1LV8rPS8qdnd4eXohIw==');
	$iv = openssl_random_pseudo_bytes(16);
	$enc 		= new Encrypt($method, $pass, $iv);
	// error_reporting(0);
?>
<!-- CHOOSELOGIN
	==================================== -->
	<section id="chooselogin">
		
		<div class="container">
			<div class="row">

				<div class="col-sm-6">
					
					<div class="img-responsive text-center">
						<h1 class="large-icon"><span class="fa fa-code light-shadow img-circle glyph large-icon bg-theme "></span> <span class="medium-font font-bold" id="caption"></span><span id="cursor">|</span></h1>
					</div><!-- banner-background -->
					<br>
					<div class="text-center">
						<p class="font-bold lead" style="line-height: 40px;"><?php echo $site_desc; ?></p>
					<center><button type="button" data-toggle="modal" data-target="#myModal" id="signmeup" class="btn btn-danger btn-lg"><i class="fa fa-shield"></i> Join the battle</button></center>
					</div>
				</div><!-- col -->
				
				<div class="col-sm-4 col-sm-offset-2 font-bold">
				 	<div class="text-center" id="loginbox">
				 	<h2 class="font-bold">Login</h2><br>
				 	<form method="post" id="frm-login" class="form">
				 		
				 		<div class="form-group">
				 			<input type="text" name="username" id="username" placeholder="Username" class="form-control ghost-textbox input-lg" maxlength="40" minlength="1" required>
				 		</div><!-- form-group -->

				 		<div class="form-group">
				 			<input type="password" name="password" id="password" placeholder="Password" class="form-control ghost-textbox input-lg" required minlength="8" maxlength="40">
				 		</div><!-- form-group -->

				 		<div class="form-group text-left">
				 			<input type="checkbox" name="rememberme" id="rememberme" style="margin-bottom: -3px; color: white;">
				 			<label for="rememberme" class="font-bold"> <h5 class="fg-white"> Remember me</h5></label>
				 		</div><!-- form-group -->

				 		<button id="btn-login" name="login-submit" value="submit" class="btn-lg ghost-btn">
				 			<span class="fa fa-sign-in"></span> Login
				 		</button><br><!-- <hr style="border-color: rgba(255,255,255,0.3)"> -->
				 		<!-- <p class="font-bold">Or, login using</p> -->

				 		<!-- <button type="button" class="ghost-btn social-btn facebook"><i class="fa fa-facebook" style="border-right: 1px solid #fff; padding-right: 5px;"></i>  Login</button>

				 		<button type="button" class="ghost-btn social-btn gplus"><i class="fa fa-google-plus" style="border-right: 1px solid #fff; padding-right: 5px;"></i>  Login</button>

				 		<button type="button" class="ghost-btn social-btn twitter"><i class="fa fa-twitter" style="border-right: 1px solid #fff; padding-right: 5px;"></i>  Login</button> -->

				 	</form>

					</div><!-- loginselect -->
				</div><!-- col -->

			</div><!-- row -->
		</div><!-- container-fluid -->

	</section><!-- chooselogin -->

	<script type="text/javascript">
		$(document).ready(function() {
			
			$(document).on('submit', '#frm-login', function(event) {
				event.preventDefault();
				/* Act on the event */
			});

			$('#btn-login').click(function(event) {
				var formdata 	= $('#frm-login').serialize();
				$.ajax({
					url: 'inc/login',
					type: 'POST',
					dataType: 'json',
					data: formdata,
					success: function(response, status, http){
						if(response[0]==0){
							var  delay = 2000;
							$('#show-success-modal').click();
							setTimeout(function () { window.location = "home.php"; }, delay);
						} else if(response[0]==1){
							$('#show-modal-not-verified').click();
						} else if(response[0]==2){
							$('#show-modal-pass-mismatch').click();
						}
					}
				});
			});
		});
	</script>