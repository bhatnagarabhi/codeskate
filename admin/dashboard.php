<?php 
	require_once("../classes/init.php"); 

	session_start();

	if($_SESSION['admin_id']=='') {
		header("Location: ./");
	}

	if($_REQUEST['msg'] != ''){
		$msg 	= $_REQUEST['msg'];
		switch ($msg) {
			case '1':
	?>
		<script type="text/javascript">alert("Winner declared successfully");</script>
	<?php		break;

			case '2' :

	?>	<script type="text/javascript">alert("There seems to be a problem");</script>
	<?php
			break;
	
			default:
	?>
		<script type="text/javascript">alert("Invalid token");</script>
	<?php
			break;
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width", initital-scale="1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Admin Dashboard</title>

</head>

<body>

	<?php 
		require_once ("lib/header.php");
		 $db 	= new Database();
	?>

	<!-- Content
	================================= -->
	<section id="content">
		
		<div class="container">
			<div class="row white-fg font-bold">
				<?php 
					// Fetch number of users
					$res 			= $db->fetchAllContent(0, 'users');
					$num_users		= mysqli_num_rows($res);	
				?>
				<!-- USERS REGISTERED WIDGET
				================================= --> 
				<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #30aadd">
					
					<div class="row">
						<div class="col-sm-2 medium-font" >
							<i class="fa fa-user"></i>
						</div><!-- col-sm-2 -->
						<div class="col-sm-10 text-left" style="padding-top: 12px;">
							<span style="font-size: 32px;  font-family: arial; "><?php echo $num_users; ?></span> Users registered
						</div><!-- col-sm-8 -->
					</div><!-- row --><hr style="margin: 0px auto 5px auto;">
					<footer class="text-right">
						<a href="showusers">View all the users &raquo;</a>
					</footer>
					
				</div><!-- col-sm-4 -->


				<!-- ADMIN VIEWS LOGINS
				================================= --> 
				<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #30aa70">
					<?php 
						// Fetch number of users
						$res 			= $db->fetchContentById(0, 'admin_id', $_SESSION['admin_id'], 'admin');
						$admin_arr		= mysqli_fetch_array($res);	
					?>
					<div class="row">
							<div class="col-sm-2 medium-font" >
								<i class="fa fa-sign-in"></i>
							</div><!-- col-sm-2 -->
							<div class="col-sm-10 text-left" style="padding-top: 12px;">
								<span style="font-size: 32px;  font-family: arial;"><?php echo $admin_arr['admin_total_logins']; ?></span> Admin Logins
							</div><!-- col-sm-8 -->
					</div><!-- row --><hr style="margin: 0px auto 5px auto;">
					<footer class="text-right">
						<a href="#">
							Last login at 
							<?php 
								$date = date("M d,Y", $admin_arr['admin_last_login']);
								$time = date("H:i", $admin_arr['admin_last_login']);
								echo $date;
							?> @ <?php echo $time; ?>
						</a>
					</footer>

				</div><!-- col-sm-4 -->


				<!-- TOTAL POSTS WIDGET
				================================= -->
				<?php 
					// Fetch number of posts
					$res 			= $db->fetchAllContent(0, 'threads');
					$num_threads		= mysqli_num_rows($res);
				?>
				<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #dd4040">
					
					<div class="row">
							<div class="col-sm-2 medium-font" >
								<i class="fa fa-pencil"></i>
							</div><!-- col-sm-2 -->
							<div class="col-sm-10 text-left" style="padding-top: 12px;">
								<span style="font-size: 32px;  font-family: arial;"><?php echo $num_threads; ?></span> Total Threads
							</div><!-- col-sm-8 -->
					</div><!-- row --><hr style="margin: 0px auto 5px auto;">
					<footer class="text-right">
						<a href="showposts">See all the posts &raquo;</a>
					</footer>

				</div><!-- col-sm-4 -->
				
			</div><!-- row -->




			<div class="row white-fg  font-bold" style=" margin-top: 20px;">
				<?php 
					// Fetch number of comments
					$res 			= $db->fetchAllContent(0, 'answers');
					$num_answers	= mysqli_num_rows($res);
				?>
				<!-- TOTAL COMMENTS WIDGET
				================================= --> 
				<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #ff6020">
					
					<div class="row">
						<div class="col-sm-2 medium-font" >
							<i class="fa fa-comments"></i>
						</div><!-- col-sm-2 -->
						<div class="col-sm-10 text-left" style="padding-top: 12px;">
							<span style="font-size: 32px; font-family: arial;"><?php echo $num_answers; ?></span> Total Comments
						</div><!-- col-sm-8 -->
					</div><!-- row --><hr style="margin: 0px auto 5px auto;">
					<footer class="text-right">
						<a href="showcomments.php">View all the comments &raquo;</a>
					</footer>
					
				</div><!-- col-sm-4 -->


				<!--  TOTAL WARS WIDGET
				================================= --> 
				<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #bb3090">
					<?php 
						// Fetch number of allies
						$res 			= $db->fetchAllContent(0, 'wars');
						$num_wars		= mysqli_num_rows($res);
					?>
					<div class="row">
							<div class="col-sm-2 medium-font" >
								<i class="fa fa-shield"></i>
							</div><!-- col-sm-2 -->
							<div class="col-sm-10 text-left" style="padding-top: 12px;">
								<span style="font-size: 32px;  font-family: arial;"><?php echo $num_wars ?></span> Total Wars
							</div><!-- col-sm-8 -->
					</div><!-- row --><hr style="margin: 0px auto 5px auto;">
					<footer class="text-right">
						<a href="manage_war">View all the wars &raquo;</a>
					</footer>

				</div><!-- col-sm-4 -->

				<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #aaaa00;">
					<?php 
						// Fetch number of allies
						$res 			= $db->fetchAllContent(0, 'allies');
						$num_allies		= mysqli_num_rows($res);
					?>
					<div class="row">
							<div class="col-sm-2 medium-font" >
								<i class="fa fa-group"></i>
							</div><!-- col-sm-2 -->
							<div class="col-sm-10 text-left" style="padding-top: 12px;">
								<span style="font-size: 32px;  font-family: arial;"><?php echo $num_allies-1; ?></span> Total Allies
							</div><!-- col-sm-8 -->
					</div><!-- row --><hr style="margin: 0px auto 5px auto;">
					<footer class="text-right">
						<a href="showallies">See all the allies &raquo;</a>
					</footer>

				</div><!-- col-sm-4 -->
				
			</div><!-- row -->

			<div class="col-sm-4 col-sm-offset-4" style="margin-top: 50px;">
				<center><a href="manage_war"><button class="btn btn-lg btn-default"><i class="fa fa-shield"></i> Manage war</button></a></center>
			</div>
			
		</div><!-- container -->

	</section><!-- content -->	

</body>
</html>