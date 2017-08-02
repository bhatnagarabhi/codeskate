<div class="container" style="margin-top: 30px;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Manage Content</h2><hr>
		</div><!-- col-sm-12 -->
	</div><!-- row -->
</div>

<!-- CONTENT -->
<section id="content" style="margin: 20px auto;">
	<div class="container">

		<div class="col-sm-12 table-responsive" id="tbl-manage-contianer">
			<table class="table " id="tbl-manage">
				
				<th width="20%">Page name</th>
				<th width="20%">File name</th>
				<th width="20%">File size (bytes)</th>
				<th width="15%" class="text-center">File status</th>
				<th width=""></th>
				<th></th>
				<th></th>

				<?php 
					$res_pages = $db->fetchAllContent(0, "cms_pages");
					while ($row = mysqli_fetch_array($res_pages)) :
						$path = "../".$row['page_href'];
				?>
				<form method="post" action="edit_content.php">
					<tr>
						<td class="hidden"><input type="text" value="<?php echo $row['page_id']; ?>" class="hidden" name="pageid"></td>
						<td><input type="text" value="<?php echo $row['page_name']; ?>" class="light-border sm-textbox-radius sm-textbox-padding" name="pagename_edit"></td>
						<td><input type="text"  class="light-border sm-textbox-radius sm-textbox-padding" value="<?php echo $row['page_href']; ?>" name="filename_edit"></td>
						<td><?php echo filesize($path); ?></td>
						<td class="text-center">
							<?php if(filesize($path)) { ?>
								<i class="fa fa-check btn-success" title="File exists and is readable" style="padding: 3px; border-radius: 100%"></i>
							<?php } else { ?>
								<i class="fa fa-remove btn-danger" title="File does not exists or is not readable" style="padding: 4px 6px; border-radius: 100%"></i>
							<?php } ?>
						</td>
						<td><button type="button" class="btn btn-primary btn-edit-content" value="2"><i class="fa fa-edit"></i> Edit</button></td>
						<td><button class="btn btn-warning" type="submit" value="<?php echo $row['page_name']; ?>"><i class="fa fa-cogs"></i> Manage</button></td>
						<td><button type="button" class="btn-danger btn btn-remove-content" value="3" ><i class="fa fa-remove"></i> Delete</button></td>
					</tr>
				</form>

				<?php endwhile; ?>

				<!-- Form to add new pages -->
				<form name="add">
					<tr>
						<td><input type="text" class="light-border sm-textbox-radius sm-textbox-padding" placeholder="Page name" name="pagename" required /></td>
						<td colspan="3"><input type="text" class="light-border sm-textbox-radius sm-textbox-padding" placeholder="File name" name="filename" required /></td>
						<td><button type="button" class="btn btn-success submit-page" name="btn-page-mode" value="1"><i class="fa fa-plus"></i> Add</button></td>
					</tr>
				</form>
				
			</table>
		</div><!-- col-sm-8 -->

	</div><!-- container -->
</section><!-- content -->