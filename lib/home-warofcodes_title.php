<?php 
	$db 			= new Database();
	$query 			= "select * from cms_index_2 left join images i on cms_index_2.background_id = i.img_id left join glyphs g on cms_index_2.icon_id = g.glyph_id ";
	$section_2_set 	= $db::executeQuery($query);
	$sec2_arr		= mysqli_fetch_array($section_2_set);
?>	
	<style type="text/css">
		.bg2 {
			background-image: url("data:image/png;base64, <?php echo base64_encode($sec2_arr['img_data']); ?>") !important ; 
			background-size: cover;
			background-attachment: fixed;
			background-repeat: no-repeat;
		}
	</style>
	<!-- War Of Codes
	========================================== -->
	<section id="warofcodes_title" data-type="background" data-speed="6"<?php if($sec2_arr['background_id']!=0) { echo 'class="bg2"'; } ?> style="color: <?php echo $sec2_arr['foreground']; ?> !important">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-sm-12">
					<h1 class="font-bold text-center"><?php echo $sec2_arr['heading']; ?></h1><hr width="48%">
				</div>
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="font-bold text-center fg-white"><?php echo $sec2_arr['sub_heading']; ?></h4>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="large-icon"><i class="light-shadow bg-theme img-circle glyph large-icon fa fa-<?php echo $sec2_arr['glyph_name']; ?>"></i></h1>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid" id="war_content">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 text-justify">
					<p class="lead">
						<?php echo $sec2_arr['description']; ?>
					</p>
				</div>
			</div><!-- row -->
		</div><!-- container-fluid -->

	</section>