<?php 
	$db 			= new Database();
	$query 			= "select * from ( cms_index_1 left join images i on cms_index_1.background_id = i.img_id left join glyphs g on cms_index_1.left_icon_1_id = g.glyph_id ) left join glyphs gt on cms_index_1.left_icon_2_id = gt.glyph_id";
	$section_1_set 	= $db::executeQuery($query);
	$sec1_arr		= mysqli_fetch_array($section_1_set);
?>
<!-- TIREDOFCOMPETING 
	=============================================== -->
	<style type="text/css">
		.bg1 {
			background-image: url("data:image/png;base64, <?php echo base64_encode($sec1_arr['img_data']); ?>") !important ; 
			background-size: cover;
			background-position: bottom;
		}
	</style>
	<section id="tiredofcompeting" data-type="background" data-speed="6" <?php if($sec1_arr['background_id']!=0) { echo 'class="bg1"'; } ?> style="color: <?php echo $sec1_arr['foreground']; ?> !important"/>
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-sm-12">
					<h1 class="font-bold text-center"><?php echo $sec1_arr['heading']; ?></h1><hr width="48%">
				</div>
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="font-bold text-center"></h4>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid">
			<div class="row" id="tiredofcompeting_image">
				<div class="col-sm-5">
					<center><h1 class="large-icon"><i class="light-shadow img-circle glyph large-icon bg-theme fa fa-<?php echo $sec1_arr[14]; ?>"></i></h1></center>
				</div><!-- col -->

				<div class="col-sm-7 text-left" id="tiredofcompeting_text">
					<p><h3 class="small-padding light-shadow bg-theme line-height-adjust"><?php echo $sec1_arr['left_icon_1_content']; ?></h3></p>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid">
			<div class="row" id="tiredofcompeting_image">
				<div class="col-sm-5">
					<center><h1 class="large-icon"><i class="light-shadow img-circle glyph large-icon bg-theme fa fa-<?php echo $sec1_arr[16]; ?>"></i></h1></center>
				</div><!-- col -->

				<div class="col-sm-7 text-left" id="tiredofcompeting_text">
					<p><h3 class="small-padding light-shadow bg-theme line-height-adjust"><?php echo $sec1_arr['left_icon_2_content']; ?></h3></p>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container-fluid -->

	</section><!-- tiredofcompeting -->