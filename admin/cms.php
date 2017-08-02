<!-- To ensure jquery API loads beforehand -->
<?php 
	require_once ("../classes/init.php");
	$db = new Database();
	$res = $db->fetchAllContent(1,"navbar_links","glyphs", "link_glyph_id", "glyph_id");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Content Management</title>
	<!-- META VIEWPORT TAG -->
	<meta name="viewport" content="width=device-width" , initital-scale="1">
</head>
<body>
	
	<?php require_once ("lib/header.php"); ?>

	<!-- ==== TOP NOTIFIER ==== -->
	<section id="topnotifier" style="margin-top: 50px">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 text-center white-fg" id="ajaxstatus" style="background-color: green">
					
				</div><!-- col-sm-12 -->
			</div><!-- row -->
		</div><!-- container-fluid -->
	</section><!-- topnotifier -->


	<!-- QUICK LINKS ======= -->
	<section id="quick-links" style="width: 100%;">
		<?php require_once "lib/cms-quicklinks.php"; ?>
	</section><!-- quick-links -->
	<!-- ======================================== -->


	<!-- ===== LOGO ===== -->
	<section id="logo">
		<?php require_once "lib/logo.php"; ?>
	</section><!-- logo -->


	<!-- ===== LINKS ======= -->
	<section id="manage">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2>Links</h2><hr>
				</div><!-- col-sm-12 -->
			</div><!-- row -->
		</div><!-- container -->

		<div class="container" id="manage_links">
			
			<!-- Contains table for displaying links -->
			<?php require_once("lib/links.php"); ?>

		</div><!-- container -->
	</section><!-- manage -->

	<!-- ==== GLOBALS ====-->
	<section id="globals">
		<!-- A section for changing the website globals (logo, links, site name, etc) -->
		<?php require_once("lib/globals.php"); ?>
	</section><!-- globals -->


	<!-- ==== MANAGE CONTENT ====-->
	<section id="manage-content">
		<?php require_once "lib/cms-manage-content.php"; ?>
	</section>


	<section id="img-modal">
		<?php 
			require_once "lib/cms-img-modal.php";
			require_once "lib/cms-modal.php";
		?>
	</section>


	<!-- ==== IMAGES ==== -->
	<section id="images">
		<?php require_once "lib/cms-manage-image.php"; ?>
	</section>

	<!-- To ensure that initialization works everytime the div refreshes -->
	<script type="text/javascript" src="js/events.js"></script>

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
	</style>
	
	<script type="text/javascript">

	$('.logo-submit').attr('disabled', true);
	// Image preview before upload
	$('#img-selector').change(function(){
		var reader = new FileReader();

		reader.onload = function (e) {
		    // get loaded data and render thumbnail.
		    document.getElementById("img-preview").src = e.target.result;
		    $('.logo-submit').attr('disabled', false);
		};

		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
		
	});

	$('#modal-imgfile').change(function(){
		var reader = new FileReader();

		reader.onload = function (e) {
		    // get loaded data and render thumbnail.
		    document.getElementById("modal-img-preview").src = e.target.result;
		};

		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
		
	});

	$(function() {
	  $('a[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html, body').animate({
	          scrollTop: target.offset().top-80
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
</script>

	<?php 
		require_once ("lib/footer.php");