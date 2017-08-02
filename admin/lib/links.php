<?php
	$res = $db->fetchAllContent(1,"navbar_links","glyphs", "link_glyph_id", "glyph_id");
?>
<div class="row">
	
	<div class="col-sm-12  table-responsive">
		<table class="table text-center table-hover table-striped info">
			<th></th>
			<th class="text-center">Link Name</th>
			<th class="text-center">Link Href</th>
			<th class="text-center">Link Title</th>
			<th class="text-center">Link Glyph</th>
			<th class="text-center"></th>
			<th class="text-center"></th>

			<?php $i=1; while($row = mysqli_fetch_array($res)) : ?>
				<tr>
					<form method="post" action="">
						<td><input type="hidden" name="link_id" value="<?php echo $row[0]; ?>"></td>
						<td><input type="text" class="link_name light-border sm-textbox-radius sm-textbox-padding" name="link_name" value="<?php echo $row[1]; ?>"></td>
						<td><input type="text" class="link_href light-border sm-textbox-radius sm-textbox-padding" name="link_href" value="<?php echo $row[2]; ?>"></td>
						<td><input type="text" class="link_title light-border sm-textbox-radius sm-textbox-padding" name="link_title" value="<?php echo $row[3]; ?>"></td>
						<td>
							<select name="link_glyph" style="display: none;" class="dropglyph">
								<?php
									$set = $db->fetchAllContent(0,"glyphs");
									while ($rec = mysqli_fetch_array($set)) :
								?>
										<option <?php if($row[6]==$rec[1]) {echo "selected";}  ?> value="<?php echo $rec[1]; ?>"><?php echo $rec[1]; ?></option>
								<?php endwhile; ?>
							</select> <i style="cursor: pointer" name="preview_glyph"></i>
						</td>
						<td><button type="button" class="btn confirmbtn btn-success" value="<?php echo $row[0]; ?>"> <i class="fa fa-check-circle"></i> Confirm</button></td>
						<td><button type="button" class="btn deletebtn btn-danger" value="<?php echo $row[0]; ?>"> <i class="fa fa-remove"></i> Delete</button></td>
						<td><input type="hidden" name="row_id" value="<?php echo $row[0]; ?>"></td>
					</form>
				</tr>
			<?php $i++; endwhile; ?>

			<!-- Add links row -->
			<tr>
				<form method="post" action="">
					<td><input type="hidden" name="link_id" value="<?php echo $row[0]; ?>"></td>
					<td><input type="text" class="link_name light-border sm-textbox-radius sm-textbox-padding" name="link_name"></td>
					<td><input type="text" class="link_href light-border sm-textbox-radius sm-textbox-padding" name="link_href"></td>
					<td><input type="text" class="link_title light-border sm-textbox-radius sm-textbox-padding" name="link_title"></td>
					<td>
						<select name="link_glyph" style="display: none;" class="dropglyph">
							<?php
								$set = $db->fetchAllContent(0,"glyphs");
								while ($rec = mysqli_fetch_array($set)) :
							?>
									<option <?php if($row[6]==$rec[1]) {echo "selected";}  ?> value="<?php echo $rec[1]; ?>"><?php echo $rec[1]; ?></option>
							<?php endwhile; ?>
						</select> <i style="cursor: pointer" class="fa fa-home" name="preview_glyph"></i>
					</td>
					<td><button type="button" id="add_link" class="btn addbtn btn-primary"> <i class="fa fa-plus"></i> Add</button></td>
				</form>
			</tr>
		</table>
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
	</div><!-- col-sm-10 -->

</div><!-- row -->