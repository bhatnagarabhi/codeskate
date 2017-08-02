<?php
	require_once ("../classes/init.php");
	$db	= new Database();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Manage the content</title>
	<meta name="viewport" content="width=device-width" , initital-scale="1">
</head>
<body>

	<?php require_once ("lib/header.php"); ?>

	<script type="text/javascript" src="js/edit-content-events.js"></script>

	<!-- Success modal -->
	<center><div id="modal-success" class="modal fade" role="dialog" style="margin-top: 65px;">
	      <div class="alert alert-dismissible alert-success" id="alert-success" style="margin-right: -16px !important;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 style="margin-top: 10px;" class="white-fg">Success!</a></h4>
	      </div>
	</div>

	<!-- Failure modal -->
	<div id="modal-failure" class="modal fade" role="dialog" style="margin-top: 65px;">
	      <div class="alert alert-dismissible alert-danger" id="alert-danger" style="margin-right: -16px !important;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 style="margin-top: 10px;" class="white-fg">Bummer! Something went wrong.</h4>
	      </div>
	</div></center>


	<button class="hidden btn btn-success" id="show-success-modal" data-target="#modal-success" data-toggle="modal">Show</button>
	<button class="hidden btn btn-danger" id="show-failure-modal" data-target="#modal-failure" data-toggle="modal">Show</button>
	
	<div class="container-fluid" style="margin-top: 70px;">

		<!-- GLYPH PALLETTE
		========================================= -->
		<div class="glyph-pallette light-shadow" style=" overflow-y: scroll; overflow-x: hidden;">
			<header>
				<i class="fa fa-close close-div"></i>
			</header><hr style="visibility: hidden; margin-bottom: 0px;">
			<div style="font-size: 20px;">
				<?php
					$res = $db->fetchAllContent(0, 'glyphs');
					while($row = mysqli_fetch_array($res)) :
				?>
						<i name="icons" value="<?php echo $row[1]; ?>" class="<?php echo 'fa fa-'.$row[1]; ?> icons small-margin" style="cursor: pointer;"></i>
				<?php endwhile; ?>
			</div>
		</div><!-- glyph-pallette-->

		<div class="row">
			<?php
				$sec1 		= $db->fetchAllContent(0, 'cms_index_1');
				$sec1_arr	= mysqli_fetch_array($sec1);
			?>
			<div class="col-sm-12">
				<div class="widget">
					<form class="form-horizontal" style="background-color: #f5f5f5; padding: 20px;" method="post">
						  <fieldset>
						    <legend>Section 1</legend>
						    <div class="form-group">
						      <label for="bg-sec-1" class="col-lg-3 control-label"><input type="checkbox" <?php if(!empty($sec1_arr['background_id'])) { echo "checked"; } ?>  style="margin-bottom: -5px;" class="" name="check-bg-sec-1"> Background</label>
						      <div class="col-lg-9">
						        <select class="form-control" id="sec-1-img-selector" name="background-sec-1">
						        	<?php
								$res = $db->fetchAllContent(0, 'images');
								while($row = mysqli_fetch_array($res)) :
							?>
									<option <?php if($row['img_id']==$sec1_arr['background_id']) echo 'selected'; ?>  value="<?php echo $row['img_id']; ?>"><?php echo $row['img_title']; ?></option>
							<?php endwhile; ?>
						        </select>
						      </div>
						    </div>
						    <!-- Background Preview -->
						    <center><div class="form-group" id="sec-1-img-preview">
							
						    </div></center>
						    <div class="form-group">
						      <label for="fg-sec-1" class="col-lg-2 control-label">Foreground</label>
						      <div class="col-lg-2">
						        <input type="color" value="<?php echo $sec1_arr['foreground']; ?>" name="fg-sec-1" class="form-control" id="fg-sec-1" >
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="heading-sec-1" class="col-lg-2 control-label">Heading</label>
						      <div class="col-lg-10">
						        <input type="text" value="<?php echo $sec1_arr['heading']; ?>" class="form-control" id="heading-sec-1" name="heading-sec-1" placeholder="Heading">
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="sub-heading-sec-1" class="col-lg-2 control-label">Sub-heading</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" value="<?php echo $sec1_arr['sub_heading']; ?>" id="sub-heading-sec-1" name="sub-heading-sec-1" placeholder="Sub-heading">
						        <span class="help-block">A sub-heading with a smaller text than the heading</span>
						      </div>
						    </div>
						    <div class="form-group">
							      <label for="left-icon-1-sec-1" class="col-lg-2 control-label">Left icon 1</label>
							      <div class="col-lg-10">
							      	<select name="link-glyph-1-sec-1" id="left-icon-1-sec-1" class="form-control">
							               	<?php
									$set = $db->fetchAllContent(0,"glyphs");
									while ($rec = mysqli_fetch_array($set)) :
								?>
										<option <?php if($sec1_arr['left_icon_1_id']==$rec[0]) {echo "selected";}  ?> value="<?php echo $rec[1]; ?>"><?php echo $rec[1]; ?></option>
								<?php endwhile; ?>
								</select> <i style="cursor: pointer; margin-top: 10px" id="preview-left-icon-1-sec-1" name="preview_glyph"></i>
							      </div>
						    </div>
						    <div class="form-group">
						      <label for="icon-1-desc-sec-1" class="col-lg-2 control-label">Description</label>
						      <div class="col-lg-10">
						        <input type="text" value="<?php echo $sec1_arr['left_icon_1_content']; ?>" class="form-control" id="icon-1-desc-sec-1" name="icon-1-desc-sec-1" placeholder="Description">
						      </div>
						    </div>
						    <div class="form-group">
							      <label for="left-icon-2-sec-1" class="col-lg-2 control-label">Left icon 2</label>
							      <div class="col-lg-10">
							      	<select name="link-glyph-2-sec-1" id="left-icon-2-sec-1" class="form-control">
							               	<?php
										$set = $db->fetchAllContent(0,"glyphs");
										while ($rec = mysqli_fetch_array($set)) :
									?>
											<option <?php if($sec1_arr['left_icon_2_id']==$rec[0]) {echo "selected";}  ?> value="<?php echo $rec[1]; ?>"><?php echo $rec[1]; ?></option>
									<?php endwhile; ?>
								</select> <i style="cursor: pointer; margin-top: 10px" id="preview-left-icon-2-sec-1" name="preview_glyph"></i>
							      </div>
						    </div>
						    <div class="form-group">
						      <label for="icon-2-desc-sec-1" class="col-lg-2 control-label">Description</label>
						      <div class="col-lg-10">
						        <input type="text" value="<?php echo $sec1_arr['left_icon_2_content']; ?>" class="form-control" id="icon-2-desc-sec-1" name="icon-2-desc-sec-1" placeholder="Description">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-lg-10 col-lg-offset-2">
						        <button type="reset" class="btn btn-primary"><i class="fa fa-remove"></i> Clear</button>
						        <button type="button" class="btn btn-success confirmbtn" name="section_number" value="1"><i class="fa fa-check"></i> Confirm</button>
						      </div>
						    </div>
						  </fieldset>
						</form>

				</div><!-- well -->


				<!-- Section 2 -->
				<?php
					$sec2		= $db->fetchAllContent(0, 'cms_index_2');
					$sec2_arr	= mysqli_fetch_array($sec2);
				?>
				<div class="widget">
					<form class="form-horizontal" style="background-color: #f5f5f5; padding: 20px;">
						  <fieldset>
						    <legend>Section 2</legend>
						    <div class="form-group">
						      <label for="bg-sec-2" class="col-lg-3 control-label"><input type="checkbox" <?php if(!empty($sec2_arr['background_id'])) { echo "checked"; } ?>  style="margin-bottom: -5px;" class="" name="check-bg-sec-2">Background</label>
						      <div class="col-lg-9">
						        <select class="form-control" name="sec-2-img-selector"  id="sec-2-img-selector">
						        	<?php
								$res = $db->fetchAllContent(0, 'images');
								while($row = mysqli_fetch_array($res)) :
							?>
									<option <?php if($row['img_id']==$sec2_arr['background_id']) { echo "selected"; } ?> value="<?php echo $row['img_id']; ?>"><?php echo $row['img_title']; ?></option>
							<?php endwhile; ?>
						        </select>
						      </div>
						    </div>
						    <!-- Background Preview -->
						    <center><div class="form-group" id="sec-2-img-preview">
							
						    </div></center>
						    <div class="form-group">
						      <label for="fg-sec-2" class="col-lg-2 control-label">Foreground</label>
						      <div class="col-lg-2">
						        <input type="color" value="<?php echo $sec2_arr['foreground']; ?>" name="fg-sec-2" class="form-control" id="fg-sec-2" >
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="heading-sec-2" class="col-lg-2 control-label">Heading</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" value="<?php echo $sec2_arr['heading']; ?>" name="heading-sec-2" id="heading-sec-2" placeholder="Heading">
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="sub-heading-sec-2" class="col-lg-2 control-label">Sub-heading</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" value="<?php echo $sec2_arr['sub_heading']; ?>" name="sub-heading-sec-2" id="sub-heading-sec-2" placeholder="Sub-heading">
						        <span class="help-block">A sub-heading with a smaller text than the heading</span>
						      </div>
						    </div>
						    <div class="form-group">
							      <label for="icon-sec-2" class="col-lg-2 control-label">Icon</label>
							      <div class="col-lg-10">
							      	<select name="link_glyph" name="icon-sec-2" id="icon-sec-2" class="form-control">
								               	<?php
										$set = $db->fetchAllContent(0,"glyphs");
										while ($rec = mysqli_fetch_array($set)) :
									?>
											<option <?php if($sec2_arr['icon_id']==$rec[0]) {echo "selected";}  ?> value="<?php echo $rec[1]; ?>"><?php echo $rec[1]; ?></option>
									<?php endwhile; ?>
								</select> <i style="cursor: pointer; margin-top: 10px" id="preview-icon-sec-2" name="preview_glyph"></i>
							      </div>
						    </div>
						     <div class="form-group">
						      <label for="description-sec-2" class="col-lg-2 control-label">Description</label>
						      <div class="col-lg-10">
						        <input type="text" value="<?php echo $sec2_arr['description']; ?>" class="form-control" name="description-sec-2" id="description-sec-2" placeholder="Description">
						        <span class="help-block">A small description of the section.</span>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-lg-10 col-lg-offset-2">
						        <button type="reset" class="btn btn-primary"><i class="fa fa-remove"></i> Clear</button>
						        <button type="button" class="btn btn-success confirmbtn" value="2"><i class="fa fa-check"></i> Confirm</button>
						      </div>
						    </div>
						  </fieldset>
						</form>

				</div><!-- well -->


				<!-- Section 3 -->
				<?php
					$sec3		= $db->fetchAllContent(0, 'cms_index_3');
					$sec3_arr	= mysqli_fetch_array($sec3);
				?>
				<div class="widget">
					<form class="form-horizontal" style="background-color: #f5f5f5; padding: 20px;">
						  <fieldset>
						    <legend>Section 3</legend>
						    <div class="form-group">
						      <label for="bg-sec-3" class="col-lg-2 control-label"><input type="checkbox" <?php if(!empty($sec3_arr['background_id'])) { echo "checked"; } ?>  style="margin-bottom: -5px;" class="" name="check-bg-sec-3"> Background</label>
						      <div class="col-lg-10">
						        <select class="form-control" name="sec-3-img-selector" id="sec-3-img-selector">
						        	<?php
								$res = $db->fetchAllContent(0, 'images');
								while($row = mysqli_fetch_array($res)) :
							?>
									<option <?php if($row['img_id']==$sec3_arr['background_id']) { echo "selected"; } ?>  value="<?php echo $row['img_id']; ?>"><?php if ($row['img_id']==0) { echo "None"; } else echo $row['img_title']; ?></option>
							<?php endwhile; ?>
						        </select>
						      </div>
						    </div>
						    <!-- Background Preview -->
						    <center><div class="form-group" id="sec-3-img-preview">
							
						    </div></center>
						    <div class="form-group">
						      <label for="fg-sec-3" class="col-lg-2 control-label">Foreground</label>
						      <div class="col-lg-2">
						        <input type="color" class="form-control" value="<?php echo $sec3_arr['foreground']; ?>" name="fg-sec-3" id="fg-sec-3" >
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="heading-sec-3" class="col-lg-2 control-label">Heading</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" value="<?php echo $sec3_arr['heading']; ?>" name="heading-sec-3" id="heading-sec-3" placeholder="Heading">
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="sub-heading-sec-3" class="col-lg-2 control-label">Sub-heading</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" value="<?php echo $sec3_arr['sub_heading_1']; ?>" name="sub-heading-sec-3" id="sub-heading-sec-3" placeholder="Sub-heading">
						        <span class="help-block">A sub-heading with a smaller text than the heading</span>
						      </div>
						    </div>
						    <div class="form-group">
							      <label for="img-sec-2" class="col-lg-2 control-label">Image</label>
							      <div class="col-lg-10">
							      	<select class="form-control" name="sec-3-icon-img-selector" id="sec-3-icon-img-selector">
								        	<?php
										$res = $db->fetchAllContent(0, 'images');
										while($row = mysqli_fetch_array($res)) :
									?>
											<option <?php if($row['img_id']==$sec3_arr['image_id']) { echo "selected"; } ?> value="<?php echo $row['img_id']; ?>"><?php if($row['img_id']==0) { echo "None Selected"; } else echo $row['img_title']; ?></option>
									<?php endwhile; ?>
								        </select>
							      </div>
						    </div>
						     <!-- Background Preview -->
						    <center><div class="form-group" id="sec-3-icon-img-preview">
							
						    </div></center>
						  <div class="form-group">
						      <label for="description-sec-3" class="col-lg-2 control-label">Sub-heading</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" value="<?php echo $sec3_arr['sub_heading_2']; ?>" name="sub-heading-1-sec-3" id="description-sec-3" placeholder="Description">
						        <span class="help-block">A description of the section.</span>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-lg-10 col-lg-offset-2">
						        <button type="reset" class="btn btn-primary"><i class="fa fa-remove"></i> Clear</button>
						        <button type="button" class="btn btn-success confirmbtn" value="3"><i class="fa fa-check"></i> Confirm</button>
						      </div>
						    </div>
						  </fieldset>
						</form>

				</div><!-- well -->


				<!-- Section 4 -->
				<?php
					$sec4		= $db->fetchAllContent(0, 'cms_index_4');
					$sec4_arr	= mysqli_fetch_array($sec4);
				?>
				<div class="widget">
					<form class="form-horizontal" style="background-color: #f5f5f5; padding: 20px;">
						  <fieldset>
						    <legend>Section 4</legend>
						    <div class="form-group">
						      <label for="bg-sec-4" class="col-lg-2 control-label"><input type="checkbox" <?php if(!empty($sec4_arr['background_id'])) { echo "checked"; } ?>  style="margin-bottom: -5px;" class="" name="check-bg-sec-4"> Background</label>
						      <div class="col-lg-10">
						        <select class="form-control" name="sec-4-img-selector" id="sec-4-img-selector">
						        	<?php
								$res = $db->fetchAllContent(0, 'images');
								while($row = mysqli_fetch_array($res)) :
							?>
									<option <?php if($row['img_id']==$sec4_arr['background_id']) { echo "selected"; } ?> value="<?php echo $row['img_id']; ?>"><?php echo $row['img_title']; ?></option>
							<?php endwhile; ?>
						        </select>
						      </div>
						    </div>
						    <!-- Background Preview -->
						    <center><div class="form-group" id="sec-4-img-preview">
							
						    </div></center>
						    <div class="form-group">
						      <label for="fg-sec-4" class="col-lg-2 control-label">Foreground</label>
						      <div class="col-lg-2">
						        <input type="color" value="<?php echo $sec4_arr['foreground']; ?>" class="form-control" name="fg-sec-4" id="fg-sec-4" >
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="heading-sec-4" class="col-lg-2 control-label">Heading</label>
						      <div class="col-lg-10">
						        <input type="text" value="<?php echo $sec4_arr['heading']; ?>"class="form-control" name="heading-sec-4" id="heading-sec-4" placeholder="Heading">
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="sub-heading-sec-4" class="col-lg-2 control-label">Sub-heading</label>
						      <div class="col-lg-10">
						        <input type="text" value="<?php echo $sec4_arr['sub_heading']; ?>" class="form-control" name="sub-heading-sec-4" id="sub-heading-sec-4" placeholder="Sub-heading">
						        <span class="help-block">A sub-heading with a smaller text than the heading.</span>
						      </div>
						    </div>
						    <div class="form-group">
							      <label for="icon-1-sec-4" class="col-lg-2 control-label">Icon 1</label>
							      <div class="col-lg-10">
							      	<select  name="icon-1-sec-4" id="icon-1-sec-4" class="form-control">
							               	<?php
										$set = $db->fetchAllContent(0,"glyphs");
										while ($rec = mysqli_fetch_array($set)) :
									?>
											<option <?php if($sec4_arr['left_icon_1_id']==$rec[0]) {echo "selected";}  ?> value="<?php echo $rec[1]; ?>"><?php echo $rec[1]; ?></option>
									<?php endwhile; ?>
								</select> <i style="cursor: pointer; margin-top: 10px" id="preview-icon-1-sec-4" name="preview_glyph"></i>
							      </div>
						    </div>
						    <div class="form-group">
						      <label for="icon-1-description-sec-4" class="col-lg-2 control-label">Icon description</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" value="<?php echo $sec4_arr['left_icon_1_content']; ?>" name="icon-1-description-sec-4" id="icon-1-description-sec-4" placeholder="Icon Description">
						      </div>
						    </div>
						    <div class="form-group">
							      <label for="icon-2-sec-4" class="col-lg-2 control-label">Icon 2</label>
							      <div class="col-lg-10">
							      	<select name="icon-2-sec-4" id="icon-2-sec-4" class="form-control">
							               	<?php
										$set = $db->fetchAllContent(0,"glyphs");
										while ($rec = mysqli_fetch_array($set)) :
									?>
											<option <?php if($sec4_arr['left_icon_2_id']==$rec[0]) {echo "selected";}  ?> value="<?php echo $rec[1]; ?>"><?php echo $rec[1]; ?></option>
									<?php endwhile; ?>
								</select> <i style="cursor: pointer; margin-top: 10px" id="preview-icon-2-sec-4" name="preview_glyph"></i>
							      </div>
						    </div>
						    <div class="form-group">
						      <label for="icon-2-description-sec-4" class="col-lg-2 control-label">Icon description</label>
						      <div class="col-lg-10">
						        <input type="text" value="<?php echo $sec4_arr['left_icon_2_content']; ?>" class="form-control" name="icon-2-description-sec-4" id="icon-2-description-sec-4" placeholder="Icon description">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-lg-10 col-lg-offset-2">
						        <button type="reset" class="btn btn-primary"><i class="fa fa-remove"></i> Clear</button>
						        <button type="button" class="btn btn-success confirmbtn" value="4"><i class="fa fa-check"></i> Confirm</button>
						      </div>
						    </div>
						  </fieldset>
						</form>

				</div><!-- well -->


				<!-- Section 5 -->
				<?php
					$sec5		= $db->fetchAllContent(0, 'cms_index_5');
					$sec5_arr	= mysqli_fetch_array($sec5);
				?>
				<div class="widget">
					<form class="form-horizontal" style="background-color: #f5f5f5; padding: 20px;">
						  <fieldset>
						    <legend>Section 5</legend>
						    <div class="form-group">
						      <label for="bg-sec-5" class="col-lg-2 control-label"><input type="checkbox" <?php if(!empty($sec5_arr['background_id'])) { echo "checked"; } ?>  style="margin-bottom: -5px;" class="" name="check-bg-sec-5"> Background</label>
						      <div class="col-lg-10">
						        <select name="sec-5-img-selector" class="form-control" id="sec-5-img-selector">
						        	<?php
								$res = $db->fetchAllContent(0, 'images');
								while($row = mysqli_fetch_array($res)) :
							?>
									<option  <?php if($row['img_id']==$sec5_arr['background_id']) { echo "selected"; } ?>  value="<?php echo $row['img_id']; ?>"><?php echo $row['img_title']; ?></option>
							<?php endwhile; ?>
						        </select>
						      </div>
						    </div>
						     <!-- Background Preview -->
						    <center><div class="form-group" id="sec-5-img-preview">
							
						    </div></center>
						    <div class="form-group">
						      <label for="fg-sec-5" class="col-lg-2 control-label">Foreground</label>
						      <div class="col-lg-2">
						        <input type="color" class="form-control" id="fg-sec-5"  name="fg-sec-5" value="<?php echo $sec5_arr['foreground']; ?>">
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="heading-sec-5" class="col-lg-2 control-label">Heading</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" id="heading-sec-5" placeholder="Heading" name="heading-sec-5" value="<?php echo $sec5_arr['heading']; ?>">
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="sub-heading-1-sec-5" class="col-lg-2 control-label">Sub-heading 1</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" id="sub-heading-1-sec-5" name="sub-heading-1-sec-5" placeholder="Sub-heading" value="<?php echo $sec5_arr['sub_heading_1']; ?>">
						        <span class="help-block">A sub-heading with a smaller text than the heading.</span>
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="content-1-sec-5" class="col-lg-2 control-label">Content 1</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" id="content-1-sec-5" placeholder="Content 1" name="content-1-sec-5" value="<?php echo $sec5_arr['sub_heading_content_1']; ?>">
						        <span class="help-block">Content for the sub-heading.</span>
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="sub-heading-2-sec-5" class="col-lg-2 control-label">Sub-heading 2</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" id="sub-heading-2-sec-5" placeholder="Sub-heading" name="sub-heading-2-sec-5" value="<?php echo $sec5_arr['sub_heading_2']; ?>">
						        <span class="help-block">A sub-heading with a smaller text than the heading.</span>
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="content-2-sec-5" class="col-lg-2 control-label">Content 2</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" id="content-2-sec-5" placeholder="Content 2" name="content-2-sec-5" value="<?php echo $sec5_arr['sub_heading_content_2']; ?>">
						        <span class="help-block">Content for the sub-heading.</span>
						      </div>
						    </div>
						    <div class="form-group">
							      <label for="img-sec-5" class="col-lg-2 control-label">Image</label>
							      <div class="col-lg-10">
							      	<select class="form-control" name="sec-5-icon-img-selector" id="sec-5-icon-img-selector">
								        	<?php
										$res = $db->fetchAllContent(0, 'images');
										while($row = mysqli_fetch_array($res)) :
									?>
											<option <?php if($row['img_id']==$sec5_arr['image_id']) { echo "selected"; } ?> value="<?php echo $row['img_id']; ?>"><?php if($row['img_id']==0) { echo "None Selected"; } else echo $row['img_title']; ?></option>
									<?php endwhile; ?>
								        </select>
							      </div>
						    </div>
						     <!-- Background Preview -->
						    <center><div class="form-group" id="sec-5-icon-img-preview">
							
						    </div></center>
						    <div class="form-group">
						      <div class="col-lg-10 col-lg-offset-2">
						        <button type="reset" class="btn btn-primary"><i class="fa fa-remove"></i> Clear</button>
						        <button type="button" class="btn btn-success confirmbtn" value="5"><i class="fa fa-check"></i> Confirm</button>	
						      </div>
						    </div>
						  </fieldset>
						</form>

				</div><!-- well -->

			</div>

			<!-- <div class="col-sm-6">  -->
				<!-- Preview Frame
				============================== -->
				<!-- <iframe src="../index.php" id="previewframe" style="overflow-x: scroll; position: fixed; width: 50%"></iframe> -->
			<!-- </div> -->
			
		</div><!-- row -->

	</div><!-- container-fluid -->


	<?php require_once ("lib/footer.php"); ?>

	<script type="text/javascript" src="js/script.js"></script>

	<style type="text/css">
		input::-webkit-input-placeholder {
		color: #999 !important;
		}
		 
		input:-moz-placeholder { /* Firefox 18- */
		color: #999 !important;  
		}
		 
		input::-moz-placeholder {  /* Firefox 19+ */
		color: #999 !important;  
		}
		 
		input:-ms-input-placeholder {  
		color: #999 !important;  
		}
		input[type="checkbox"]:after {
			border: 2px solid #222;
		}
	</style>

</body>
</html>