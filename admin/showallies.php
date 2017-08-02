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
		 $query 		= "SELECT * FROM allies l LEFT JOIN users r ON l.ally_leader_id = r.user_id ORDER BY ally_id DESC";
		 $res 			= $db::executeQuery($query);
	?>

	<!-- Content
	================================= -->
	<section id="user-content" style="margin-top: 80px;">
		<div class="container">
			<a href="dashboard"><i class="fa fa-arrow-left"></i> Back to dashboard</a>
			<h2 class=" theme-fg"><i class="fa fa-user"></i> Allies</h2><hr>
			<div class="table-responsive">
				<table class="table-striped table-hover" style="font-size: 13px; font-family: arial;" width="100%" cellspacing="10">
					<th width="3%" style="padding: 20px;">Id</th>
					<th width="10%" style="padding: 20px;">Tag</th>
					<th width="20%"  style="padding: 20px;">Name</th>
					<th width="15%" style="padding: 20px;">Leader</th>
					<th width="45%" style="padding: 20px;">Description</th>
					<th></th>

					<?php 
						while($row 	= mysqli_fetch_array($res)) : 
							if($row['ally_id']!=0){
					?>
							<tr>
								<td style="padding: 20px;"><?php echo $row['ally_id']; ?></td>
								<td><?php echo $row['ally_tag']; ?></td>
								<td style="background-color: #eee; padding:20px;"><?php echo $row['ally_name']; ?></td>
								<td style=" padding: 20px;"><?php echo $row['user_username']; ?></td>
								<td style="padding: 15px;"><?php echo $row['ally_description']; ?></td>
								<td><button class="btn btn-danger btn-delete-ally" value="<?php echo $row['ally_id']; ?>"><i class="fa fa-remove"></i> Delete</button></td>
							</tr>

					<?php } endwhile; ?>
				</table>
			</div><!-- table-responsive -->
		</div><!-- container -->
	</section><!-- user-content -->
</body>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-delete-ally').click(function(event) {
			var status 			= confirm("Do you want to delete ?");
			if(status){
				var ally_id 		= $(this).val();
				$.ajax({
					url: 'inc/manage_ally.php',
					type: 'POST',
					dataType: 'json',
					data: {ally_id: ally_id},
					success : function (response, status, http){
						if(response[0]) {
							alert("Ally deleted succesfully");
							location.reload();
						} else {
							alert('The ally could not be deleted');
						}
					}
				});
			}			
		});

	});
</script>