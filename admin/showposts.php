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
		 $query 		= "SELECT * FROM threads l LEFT JOIN dev_glyphs r ON l.thread_language_id = r.dev_glyph_id ORDER BY thread_id DESC";
		 $res 			= $db::executeQuery($query);
	?>

	<!-- Content
	================================= -->
	<section id="user-content" style="margin-top: 80px;">
		<div class="container-fluid">
			<a href="dashboard"><i class="fa fa-arrow-left"></i> Back to dashboard</a>
			<h2 class=" theme-fg"><i class="fa fa-user"></i> Threads</h2><hr>
			<div class="table-responsive">
				<table class="table-striped table-hover" style="font-size: 13px; font-family: arial;" width="100%" cellspacing="10">
					<th width="3%" style="padding: 20px;">Id</th>
					<th width="15%" style="padding: 20px;">Heading</th>
					<th width="5%"  style="padding: 20px;">Language</th>
					<th width="50%" style="padding: 20px;">Content</th>
					<th width="12%" style="padding: 20px;">Posted at</th>
					<th width="1%" style="padding: 5px;">Views</th>
					<th></th>

					<?php while($row 	= mysqli_fetch_array($res)) : ?>
						<tr>
							<td style="padding: 20px;"><?php echo $row['thread_id']; ?></td>
							<td><?php echo $row['thread_heading']; ?></td>
							<td><?php echo $row['dev_glyph_name']; ?></td>
							<td style="background-color: #eee; padding: 20px;"><?php echo $row['thread_content']; ?></td>
							<td style="padding: 15px;" >
								<?php 
									$date = date("M d,Y", $row['posted_at']);
									echo $date;
								?>
							</td>
							<td style="padding: 15px;"><?php echo $row['thread_views']; ?></td>
							<td style="font-family: arial;"><?php echo $row['user_xp']; ?></td>
							<td><?php echo $row['ally_name']; ?></td>
							<td><button class="btn btn-danger btn-delete-post" value="<?php echo $row['thread_id']; ?>"><i class="fa fa-remove"></i> Delete</button></td>
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
		$('.btn-delete-post').click(function(event) {
			var status 			= confirm("Do you want to delete ?");
			if(status){
				var thread_id 		= $(this).val();
				$.ajax({
					url: 'inc/manage_post.php',
					type: 'POST',
					dataType: 'json',
					data: {thread_id: thread_id},
					success : function (response, status, http){
						if(response[0]) {
							alert("Thread deleted succesfully");
							location.reload();
						} else {
							alert('The thread could not be deleted');
						}
					}
				});
			}			
		});

	});
</script>