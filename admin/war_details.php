<?php require_once("../classes/init.php"); ?>
<?php 
	$war_id = 0;
	if($_REQUEST['war_id']=='') {
		header("Location: ./dashboard.php");
	} else {
		$war_id = $_REQUEST['war_id'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width", initital-scale="1">
	<title>Admin Dashboard</title>

</head>

<body>
	<?php 
		require_once ("lib/header.php");
	?>
	<div class="container" style="margin-top: 80px;">
		<a href="dashboard"><i class="fa fa-arrow-left"></i> Back to dashboard</a>

		<div class="row">
			<div class="col-sm-6">
				<h2 class="black-fg">Submissions</h2><hr>
				<div class="col-sm-12 black-fg">
					<div>
						<?php 
							$db 		= new Database();
							$sql 		= "SELECT * FROM war_entries l LEFT JOIN wars r on l.war_id = r.war_id LEFT JOIN users u ON l.war_entry_user_id = u.user_id LEFT JOIN allies a ON u.user_ally_id = a.ally_id WHERE l.war_id={$war_id}";
							$res 		= $db::executeQuery($sql);
						?>
						<table class="table-striped" width="100%">
							<tr>
								<th width="20%" style="text-align: center;">User pic</th>
								<th width="20%">Ally name</th>
								<th width="35%">Username</th>
								<th width="20%">Check Entry</th>
								<th>Declare</th>
							</tr>
							<?php while($row = mysqli_fetch_array($res)) :  ?>
									<tr>
										<td style="vertical-align: middle; padding: 20px; text-align: left;"><img align="left" height="60px" width="60px" style="border-radius: 2px;" src="data:image/png;base64,<?php echo base64_encode($row['user_pic']);?>"></td>
										<td><?php echo $row['ally_name']; ?></td>
										<td><?php echo $row['user_username']; ?></td>
										<td><button class="btn btn-primary btn-evaluate" value='<?php echo stripslashes($row['war_entry_content']); ?>'><i class="fa fa-play"></i> Evaluate</button></td>
										<td>
											<form method="post" action="inc/declare-war-winner.php">
												<input type="hidden" name="entry_id" value="<?php echo $row['war_entry_id']; ?>">
												<input type="hidden" name="war_id" value="<?php echo $row['war_id']; ?>">
												<button class="btn btn-success btn-declare" ><i class="fa fa-check"></i> Declare</button>
											</form>
										</td>
									</tr>
							<?php endwhile; ?>
						</table>
					</div>
				</div>
			</div><!-- col-sm-6 -->

			<div class="col-sm-6" style="color: black !important; height: 200px;">
				<?php require_once("admin-code-editor.php"); ?>
			</div><!-- col-sm-6 -->

		</div><!-- row -->

	</div><!-- container -->
</body>



<script type="text/javascript">
	$(document).ready(function($) {
		$('.btn-evaluate').click(function(event) {
			editor.getSession().setValue($(this).val());
		});
	});
</script>

















