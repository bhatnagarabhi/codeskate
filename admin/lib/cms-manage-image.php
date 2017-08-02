<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Images</h2>
			<hr>
			<h3 class="theme-fg">Click an image to edit or delete</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 text-center" id="img-gallery" style="min-height: 449px; background-color: #f0f0f0;"></div>

		<center><div class="col-sm-12" style="margin-top:20px;">
			<?php 
				$res	= $db->fetchAllContent(0, 'images');
				$num_rec_per_page	= 10;
				$num_content		= mysqli_num_rows($res);
				$num_pages 		= ceil($num_content/$num_rec_per_page);
				for ($i=1; $i<=$num_pages ; $i++) {  ?>
					<button class="btn-pagination btn btn-primary" value="<?php echo $i; ?>"><?php echo $i; ?></button>
			<?php } ?>
		</div></center>
	</div>

	<!-- Adding images -->
	<div class="row">
		<h3>Add image</h3>
		<div class="col-sm-12 table-responsive">
			<table width="100%" class="table-responsive table">
				<form method="post" class="form-add-img" enctype="multipart/form-data">
					<tr>
						<td><input type="file" name="addimg-file"></td>
						<td><input type="text" name="addimg-title" placeholder="Image Title"></td>
						<td><input type="text" name="addimg-alt" placeholder="Image Alt"></td>
						<td width="20%"><button class="btn btn-success" type="button" name="img-submit" value="1"><i class="fa fa-plus"></i> Add</button></td>
					</tr>
				</form>
			</table>
		</div><!-- col -->
	</div><!-- row -->
</div>