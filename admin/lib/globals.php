<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Globals</h2><hr>
		</div><!-- col-sm-12 -->
	</div><!-- row -->
</div><!-- container -->

<div class="container">
	<div class="row">
		
		<?php
			// Fetching the values of the globals from the database
			$globals = $db->fetchAllContent(0, 'globals');
			$global = mysqli_fetch_array($globals);
		?>

		<div class="col-sm-12">
			<div class="small-padding sm-textbox-radius">
				<table class="table table-striped">
					<form class="form-inline frm-global" method="post">
						<tr class="sm-font">
							<td>Site Name* : </td>
							<td width="50%"><input type="text" name="sitename" style="width: 100%" class="light-border input-sm sm-textbox-radius sm-textbox-padding" placeholder="The name of the website to display" value="<?php echo $global['site_name']; ?>"></td>
							<td>*[The name of the website to display]</td>
						</tr>
					
						<tr class="sm-font">
							<td>Site description* : </td>
							<td><textarea class="light-border input-sm sm-textbox-radius sm-textbox-padding" style="width: 100%"  rows="10" placeholder="A small description of your website" name="sitedesc"><?php echo $global['site_description']; ?></textarea> </td>
							<td>*[A small description of your website]</td>
						</tr>
					

					
						<tr class="sm-font">
							<td>Site Title* : </td>
							<td width="50%"><input type="text" name="sitetitle" style="width: 100%" class="light-border input-sm sm-textbox-radius sm-textbox-padding" placeholder="The text to be displayed on the titlebar" value="<?php echo $global['site_title']; ?>"></td>
							<td>*[The text to be displayed on the titlebar]</td>
						</tr>
					

					
						<tr class="sm-font">
							<td>Footer text* : </td>
							<td width="50%"><input type="text" name="footertext" style="width: 100%" class="light-border input-sm sm-textbox-radius sm-textbox-padding" placeholder="The text to be displayed in the footer" value="<?php echo $global['footer_text']; ?>"></td>
							<td>*[Text to be displayed in the footer]</td>
						</tr>
					</form>

				</table>

				<!-- The button for submitting the globals data -->
				<center><button type="button" class="btn btn-globals btn-lg btn-success" value="submit" name="submit" > <i class="fa fa-check-circle"></i> Confirm Globals</button></center>
				<div class="col-sm-6 col-sm-offset-3 text-center white-fg" style="margin-top: 20px; border-radius: 4px;" id="globals_ajaxstatus">
			</div>
		</div><!-- col-sm-12-->

	</div><!-- row -->
</div><!-- container -->