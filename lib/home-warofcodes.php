<?php 
	$db 			= new Database();
	$query 			= "select * from cms_index_3 left join images i on cms_index_3.background_id = i.img_id left join images g on cms_index_3.image_id = g.img_id ";
	$section_3_set 	= $db::executeQuery($query);
	$sec3_arr		= mysqli_fetch_array($section_3_set);
?>	
	<style type="text/css">
		.bg3 {
			background-image: url("data:image/png;base64, <?php echo base64_encode($sec3_arr[8]); ?>") !important ; 
			background-size: cover;
			background-attachment: fixed;
			background-repeat: no-repeat;
		}
	</style>
<!-- GAIN EXPERIENCE (WAR OF CODES)
	============================================ -->
	<section id="warofcodes" <?php if($sec3_arr['background_id']!=0) { echo 'class="bg3"'; } ?> style="color: <?php echo $sec3_arr['foreground']; ?> !important">
		
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-sm-12">
					<h1 class="font-bold text-center black-fg"><?php echo $sec3_arr['heading']; ?></h1><hr width="48%">
				</div>
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="font-bold text-center"><?php echo $sec3_arr['sub_heading_1']; ?></h4>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="large-icon"><!-- <i class="light-shadow img-circle glyph large-icon bg-theme fa fa-star"></i> --><center><img src="data:image/png;base64, <?php echo base64_encode($sec3_arr[12]); ?>" title="<?php echo $sec3_arr[13]; ?>" alt="<?php echo $sec3_arr[14]; ?>" class="img-responsive"></center></h1>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container-fluid -->

		<div class="container-fluid" id="war_content">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 text-justify">
					<p class="lead">
						<?php echo $sec3_arr['sub_heading_2']; ?>
					</p>
				</div>
			</div><!-- row -->
		</div><!-- container-fluid -->


	</section><!-- warofcodes -->
