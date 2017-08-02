<?php 
	$db 			= new Database();
	$query 			= "select * from cms_index_5 left join images i on cms_index_5.background_id = i.img_id left join images g on cms_index_5.image_id = g.img_id";
	$section_5_set 	= $db::executeQuery($query);
	$sec5_arr		= mysqli_fetch_array($section_5_set);
?>
	<style type="text/css">
		.bg5 {
			background-image: url("data:image/png;base64, <?php echo base64_encode($sec5_arr[10]); ?>") !important ; 
			background-size: cover;
			background-position: bottom;
		}
	</style>
<!-- EDITOR FEATURES
	 ======================================= -->
	 <section id="editor_features" <?php if($sec5_arr['background_id']!=0) { echo 'class="bg5"'; } ?> style="color: <?php echo $sec5_arr['foreground']; ?> !important">

	 	<div class="container">
	 		<div class="row">
	 			<div class="col-sm-12">
	 				<h1 class="text-center" style="color: <?php echo $sec5_arr['foreground']; ?> !important"><?php echo $sec5_arr['heading']; ?></h1><hr width="50%">
	 			</div>	<!-- col -->
	 		</div><!-- row -->
	 	</div><!-- container -->
	 	
	 	<div class="container">
	 		<div class="row" style="margin-top: 20px;">
	 			
	 			<div class="col-sm-6">
	 				<p class="lead font-bold"><?php echo $sec5_arr['sub_heading_1']; ?></p><hr>
	 				<p><?php echo $sec5_arr['sub_heading_content_1']; ?></p><br>

	 				<p class="lead font-bold"><?php echo $sec5_arr['sub_heading_2']; ?></p><hr>
	 				<p><?php echo $sec5_arr['sub_heading_content_2']; ?></p><br>

	 			</div><!-- col-sm -->

	 			<div class="col-sm-6">
	 				<img src="data:image/png;base64, <?php echo base64_encode($sec5_arr[14]); ?>" title="<?php echo $sec5_arr[15]; ?>" alt="<?php echo $sec5_arr[16]; ?>" class="img-responsive">
	 			</div><!-- col-sm -->

	 		</div><!-- row -->
	 	</div><!-- container-fluid -->

	 </section><!-- editor_features -->

