<?php 
	$db 			= new Database();
	$query 			= "select * from ( cms_index_4 left join images i on cms_index_4.background_id = i.img_id left join glyphs g on cms_index_4.left_icon_1_id = g.glyph_id ) left join glyphs gt on cms_index_4.left_icon_2_id = gt.glyph_id";
	$section_4_set 	= $db::executeQuery($query);
	$sec4_arr		= mysqli_fetch_array($section_4_set);
?>
	<style type="text/css">
		.bg4 {
			background-image: url("data:image/png;base64, <?php echo base64_encode($sec4_arr['img_data']); ?>") !important ; 
			background-size: cover;
			background-position: bottom;
		}
	</style>
	<!-- FORMALLIES
	======================================= -->
	<section id="formallies" data-type="background" data-speed="4" <?php if($sec4_arr['background_id']!=0) { echo 'class="bg4"'; } ?> style="color: <?php echo $sec4_arr['foreground']; ?> !important">
		
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-sm-12 text-center">
					<h1 class="text-center"><?php echo $sec4_arr['heading']; ?></h1><hr width="72%">
					<h1 class="large-icon"><span class="fa fa-<?php echo $sec4_arr[14]; ?> light-shadow img-circle glyph large-icon bg-theme "></span></h1>
					<p class="lead font-bold"><?php echo $sec4_arr['left_icon_1_content']; ?><br>
					<h1 class="large-icon"><span class="fa fa-<?php echo $sec4_arr[16]; ?> light-shadow img-circle glyph large-icon bg-theme "></span></h1>
					<p class="lead font-bold"><?php echo $sec4_arr['left_icon_2_content']; ?></p>
				</div><!-- col -->

			</div><!-- row -->
		</div><!--container-fluid -->

	</section><!-- formallies -->