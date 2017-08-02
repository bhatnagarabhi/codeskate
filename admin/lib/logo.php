<?php
	$res = $db->fetchAllContent(0, 'globals');
	$row = mysqli_fetch_array($res);
	$logo = base64_encode($row['logo']);
?>
<div class="container" style="margin-top: 30px;">
	<center><h1>Manage Logo<br><br></h1></center>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 light-border sm-textbox-radius small-padding">
			<h4>Main Logo</h4><hr>
			<form method="post" enctype="multipart/form-data" id="frm-logo" action="inc/update_logo.php">
				<input type="file" class="form-control" id="img-selector" name="logo" accept="image/*" required="required">
				<label for="img-selector" style="margin-top: 20px; margin-bottom: 20px;"><img style="cursor: pointer;"  id="img-preview" class="img-responsive" style="margin-top:20px;" src="data:image/jpeg; base64, <?php echo $logo;  ?>">
					<div class="img-popover font-bold" style="margin-bottom: 39px; "><center><i class="fa fa-refresh"></i> Change</center></div>
				</label>
				<center><button type="button" class="btn btn-lg btn-success logo-submit" name="logo-submit" value="submit">Confirm</button></center>
			</form>
		</div><!-- col-sm-4 -->
	</div><!-- row -->
</div><!-- container -->

