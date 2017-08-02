<?php
	require_once ("classes/init.php");
	require_once ("lib/header.php");
	if($_REQUEST['status']!=""){
		$status 		= $_REQUEST['status'];
	}
?>

<section style="margin-top: 180px;">
	<div class="container">
		<div class="row">
			<?php if($status==0){ ?>
			<div class="col-sm-12 large-icon text-center theme-fg font-bold">
				<i class="fa fa-send img-circle"></i><br>
				<h3 class="black-fg">Verification link has been sent to your e-mail address. Please click on the verification link to verify.</h3>
 			</div>
 			<?php } else if($status==1){  ?>
 			<div class="col-sm-12 large-icon text-center theme-fg font-bold">
				<i class="fa fa-check-circle img-circle"></i><br>
				<h3 class="black-fg">Great! your email has been verified successfully.</h3>
				<h3 class="black-fg">You may proceed to login using the button below.</h3>
				<a href="./"><button class="btn btn-lg btn-danger" name="login"><i class="fa fa-sign-in"></i> Proceed to login</button></a>
 			</div>
 			<?php } ?>
		</div><!-- row -->
	</div><!-- container -->
</section>