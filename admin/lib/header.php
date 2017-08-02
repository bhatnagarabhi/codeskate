<?php 
	session_start();
	if($_SESSION['admin_id']=='') {
		header("Location:./index");
	}
?>

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

<!-- NAVBAR
	================================================== -->
	<div class="navbar-wrapper">
		
		<div class="navbar navbar-inverse navbar-fixed-top"  role="navigation">

			<div class="container">
				
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="index" class="navbar-brand font-bold">Admin @ Codeskate</a>
				</div><!-- navbar-header -->
				<div class="navbar-collapse font-bold collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="dashboard" title="Home" class="white-fg"><i class="fa fa-home"></i></a></li>
						<li><a href="cms" title="Content Management" class="white-fg"><i class="fa fa-edit"></i></a></li>
						<li><a href="manage_war" title="Manage War" class="white-fg"><i class="fa fa-shield"></i></a></li>
						<li><a href="inc/logout" title="Log Out" class="white-fg"><i class="fa fa-power-off"></i></a></li>
					</ul>
				</div><!-- navbar-collapse -->
			</div><!-- container -->

		</div><!-- navbar -->

	</div><!-- navbar-wrapper -->