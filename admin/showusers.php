<?php require_once("../classes/init.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width", initital-scale="1">
	<title>Admin Dashboard</title>

</head>

<body>
	<?php 
		require_once ("lib/header.php");
		 $db 			= new Database();
		 $query 		= "SELECT * FROM users l LEFT JOIN allies r ON l.user_ally_id = r.ally_id ORDER BY l.user_id DESC";
		 $res 			= $db::executeQuery($query);
	?>

	<!-- Content
	================================= -->
	<section id="user-content" style="margin-top: 80px;">
		<div class="container">
			<a href="dashboard"><i class="fa fa-arrow-left"></i> Back to dashboard</a>
			<h2 class=" theme-fg"><i class="fa fa-user"></i> Users</h2><hr>
			<div class="table-responsive">
				<table class="table-striped table-hover" style="font-size: 15px; font-family: arial;" width="100%">
					<th>Id</th>
					<th>Pic</th>
					<th>Username</th>
					<th>Full name</th>
					<th>E-mail</th>
					<th>XPs</th>
					<th>Ally</th>
					<th>Signed up</th>
					<th></th>
					<th></th>
					<th></th>

					<?php while($row 	= mysqli_fetch_array($res)) : ?>
						<tr>
							<td><?php echo $row['user_id']; ?></td>
							<td style="vertical-align: middle; padding: 20px;"><img height="60px" width="60px" style="border-radius: 2px;" src="data:image/png;base64,<?php echo base64_encode($row['user_pic']);?>"></td>
							<td><?php echo $row['user_username']; ?></td>
							<td><?php echo $row['user_name']; ?></td>
							<td><?php echo $row['user_email']; ?></td>
							<td style="font-family: arial;"><?php echo $row['user_xp']; ?></td>
							<td><?php echo $row['ally_name']; ?></td>
							<td>
								<?php 
									$date = date("M d,Y", $row['timestamp']);
									echo $date;
								?>
							</td>
							<td><button  data-toggle="modal" data-target="#mailModal" class="btn btn-warning btn-send-mail" value="<?php echo $row['user_email']; ?>"><i class="fa fa-send"></i> Mail</button><li class="hidden" value="<?php echo $row['user_id']; ?>"></li></td>
							<td><button class="btn btn-danger btn-delete" value="<?php echo $row['user_id']; ?>"><i class="fa fa-remove"></i> Delete</button></td>
						</tr>
					<?php endwhile; ?>
				</table>
			</div><!-- table-responsive -->
			<div id="mailModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Mail to : <span id="show_user_email"></span></h4>
				      </div>
				      <div class="modal-body">
				        	<form>
				        		<input id="mail_subject" type="text" name="mail_header" class="form-control" required placeholder="E-mail subject"><br>
				        		<textarea id="mail_body" class="form-control" style="resize: none; padding: 10px; border:1px solid rgba(0,0,0,0.1); font-size: 12px; min-height: 200px;" name="mail_content">E-mail body</textarea>
				        	</form>
				      </div>
				      <div class="modal-footer">
				        <button id="send_mail" type="button" class="btn btn-success"><i class="fa fa-send"></i> Send</button>
				        <button id="close_mail_modal"  type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
				        <center><i class="fa fa-spin fa-spinner hidden theme-fg" id="processing-spinner" style="font-size: 50px"></i></center>
				      </div>
				    </div>

				  </div>
			</div>
		</div><!-- container -->
	</section><!-- user-content -->
</body>

<style type="text/css">
	input::-webkit-input-placeholder {
		color: #aaa !important;
	}
	 
	input:-moz-placeholder { /* Firefox 18- */
		color: #aaa !important;  
	}
	 
	input::-moz-placeholder {  /* Firefox 19+ */
		color: #aaa !important;  
	}
	 
	input:-ms-input-placeholder {  
		color: #aaa !important;  
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-delete').click(function(event) {
			var status 			= confirm("Do you want to delete ?");
			if(status){
				var user_id 		= $(this).val();
				$.ajax({
					url: 'inc/manage_user.php',
					type: 'POST',
					dataType: 'json',
					data: {user_id: user_id},
					success : function (response, status, http){
						if(response[0]) {
							alert("User deleted succesfully");
							location.reload();
						} else {
							alert('The user could not be deleted');
						}
					}
				});
			}			
		});

		$('.btn-send-mail').click(function(event) {
			var user_email 		= $(this).val();
			$('#show_user_email').html(user_email);
			$('#send_mail').val(user_email);
			// alert($(this).next('li').val());
		});

		$('#send_mail').click(function(event) {
			var mail_subject	= $('#mail_subject').val();
			var mail_body 		= $('#mail_body').val();
			var user_email 		= $(this).val();
			$('#processing-spinner').removeClass('hidden');
			$('#send_mail').addClass('hidden');
			$.ajax({
				url: 'inc/mail_user.php',
				type: 'POST',
				dataType: 'json',
				data: {mail_subject: mail_subject, mail_body: mail_body, user_email: user_email},
				success : function(response, status, http){
					if(response[0]){
						$('#send_mail').removeClass('hidden');
						$('#close_mail_modal').click();
						$('#processing-spinner').addClass('hidden');
						alert("Mail sent");
					} else {
						$('#send_mail').removeClass('hidden');
						$('#processing-spinner').addClass('hidden');
						alert("The mail could not be sent");
					}
				}
			});			
		});

	});
</script>