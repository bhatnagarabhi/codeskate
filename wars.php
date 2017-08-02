<?php 

	session_start();
	
	if($_SESSION['user_id']=='')
		header("Location:./");

	require_once("classes/init.php");

	require_once ("lib/header.php");

	// Check if the session is set or not
	$session 	= new Session();
	if($session->getSession('user_id')!=''){
		$user_id 	= $session->getSession('user_id');
		$user_obj	= new Users();
		$user_arr 	= mysqli_fetch_array($user_obj->getUserDetails($user_id));
		$query 	= "SELECT * FROM notifications WHERE user_id=$user_id AND is_read=0";
		$db 		= new Database();
		$notif_res	= $db::executeQuery($query);
		$num_notif 	= mysqli_num_rows($notif_res);
	}

	if($_REQUEST['msg']!='') {
		$msg 		= $_REQUEST['msg'];
		switch ($msg) {
			case '1':
	?>
				<script type="text/javascript">alert("You have successfully added a war entry");</script>
	<?php
			break;

			case '2' :
	?>
				<script type="text/javascript">alert("Oops! something went wrong");</script>
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
<section id="sidebar" style="margin:0px auto; margin-top:43px; z-index: 99">
	<div class="container-fluid">
		<div class="row">
			<i id="togglesidebar" class="fa fa-list pull-right fg-white" style="position:fixed; background-color: rgba(0,0,0,0.2); padding:10px; border-radius: 100%; z-index: 100; top: 70px; font-size: 22px; cursor: pointer; left: 12.5%"></i>
			<div id="nav-sidebar" class="col-sm-2 black-fg" style="padding: 0px; position: fixed; margin-top: 50px; overflow-x: hidden;">
				<ul id="sidebar-ul" style="list-style-type: none; text-overflow: none;">
					<li value="1" class="content-link" id="dashboard-link"><i class="fa fa-dashboard"></i> Dashboard</li>
					<li value="2" class="content-link" id="notifs"><i class="fa fa-info-circle"></i> Notifications 
						<?php if($num_notif>0) { ?>
							<span class="pull-right theme-fg" id="num_notif" style="margin-right: 10px; margin-top: -2px; border-radius: 20px; padding: 1px 20px; background-color: white;"><?php echo $num_notif; ?></span>
						<?php } ?>
					</li>
					<li value="3" class="content-link"><i class="fa fa-group"></i> Ally</li>
					<li value="4" class="content-link"><i class="fa fa-shield"></i> Ongoing wars</li>
					<li value="6" class="content-link"><i class="fa fa-code"></i> Codespace</li>
					<a href="home" style="text-decoration: none;"><li value="7" class="content-link"><i class="fa fa-sign-out"></i> Exit war</li></a>
					<li value="8" class="content-link"><i class="fa fa-power-off"></i> Log Out</li>
					<li style="cursor: default;">{ Codeskate <sup>&copy;</sup> closed beta }</li>
				</ul>
			</div><!-- nav-sidebar -->
			<!-- <i class="fa fa-align-justify" style="position: fixed; margin-top: 40px; font-size: 20px; margin-left: 14%;"></i> -->
			<div id="nav-rightbar" class="col-sm-10 col-sm-offset-2 black-fg" style="padding: 20px; background-color: white;">

				<!-- User XP
				=========================== -->
				<?php require_once ('lib/dashboard-userxp.php'); ?>
				
				<div id="content">
					<!-- Content
					=========================== -->
					<?php  require_once ("lib/wars-content.php"); ?>
				</div>

				<div id="modal">
					<?php require_once("lib/dashboard-modal.php"); ?>
				</div><!-- modal -->

			</div><!-- nav-rightbar -->
		</div><!-- row -->
	</div><!-- container-fluid -->
</section><!-- sidebar -->

<style type="text/css">

	#sidebar-ul {
		padding: 20px 0px;
		padding-right: 0px;
	}
	#sidebar-ul li {
		display: table-cell;
		color: #fff;
		font-size: 15px;
		display: block;
		vertical-align: middle;
		cursor: pointer;
		width: 100%;
		font-weight: bold;
		height: 50px;
		transition-duration: 0.5s;
		padding-top: 12px;
		padding-left: 20px;
	}
	#sidebar-ul li:hover {
		background-color: #ff6060;
		transition-duration: 0.5s;
		color: white;
	}
	#sidebar-ul li i {
		margin-right: 10px;
	}
	body {
		background-color: #31373f;
		overflow-x: hidden;
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
	var div_id=0;
	$('.content-link').click(function(event) {
		div_id 		= $(this).val();
		if(div_id==8) {
			window.location = "inc/logout.php";
		}
		$.ajax({
			url: 'lib/wars-content.php',
			type: 'POST',
			dataType: 'html',
			data: 'url_id='+div_id,
			success: function(response, status, http){
				$('#content').hide().html(response).fadeIn('ease-in');
			}
		});
	});
	$('#togglesidebar').click(function(event) {
		if($('#nav-rightbar').hasClass('col-sm-10')){
			$('#nav-sidebar').animate({width:"toggle"},400);
			$('#nav-rightbar').removeClass('col-sm-10');
			$('#nav-rightbar').addClass('col-sm-12');
			$('#nav-rightbar').animate({margin: "0px"}, 400);
			$(this).removeClass('fg-white');
			$(this).addClass('theme-fg');
			$(this).animate({left:"2%"}, 400);
		} else {
			$('#nav-sidebar').animate({width:"toggle"},400);
			$('#nav-rightbar').animate({marginLeft: "16.66666667%"}, 400, function (){
				$('#nav-rightbar').removeClass('col-sm-12');
				$('#nav-rightbar').addClass('col-sm-10');
			});
			$(this).addClass('fg-white');
			$(this).removeClass('theme-fg');
			$(this).animate({left:"12.5%"}, 400);
		}
	});

	$('#notifs').click(function(event) {
		$('#num_notif').hide('slow');
	});

</script>