<?php
	$db = new Database();

	// Fetching the link variables
	$res = $db->fetchAllContent(1,"navbar_links", "glyphs", "link_glyph_id", "glyph_id");

	// Fetching the global variables
	$globals_rs = $db->fetchAllContent(0,"globals");
	$globals = mysqli_fetch_array($globals_rs);
	$site_name = $globals['site_name'];
	$site_title = $globals['site_title'];
	$site_desc = $globals['site_description'];
	$footer_text = $globals['footer_text'];
	$logo = base64_encode($globals['logo']);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width", initital-scale="1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title><?php echo $site_title; ?></title>

</head>

<body onload="testTypingEffect()">

	<input type="text" readonly class="hidden" value="<?php echo $site_name; ?>" id="typing-caption"></div>

	<!-- CORE BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<!-- GENERIC CSS -->
	<link rel="stylesheet" type="text/css" href="css/generic.css">

	<!-- FONT-AWESOME -->
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">

	<!--DEVICONS -->
	<link rel="stylesheet" type="text/css" href="css/devicons/devicon.min.css">

	 <!-- JQUERY -->
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

	<!-- BOOTSTRAP JS -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<!-- TOP NAVBAR
	======================================== -->
	<!-- NAVBAR
		================================================== -->
		<div class="navbar-wrapper">
			
			<div class="navbar navbar-inverse navbar-fixed-top"  role="navigation">

				<div class="container">
					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="index.php" class="navbar-brand"><img class="img img-responsive" style="max-height: 40px; margin-top: -10px;" src="data:image/jpeg; base64, <?php echo $logo; ?>" alt="<?php $site_name; ?>"></a>
					</div><!-- navbar-header -->
					<div class="navbar-collapse font-bold collapse">
						<ul class="nav navbar-nav navbar-right">
							<?php	while($row = mysqli_fetch_array($res)) : ?>
								<li><a class="fg-white" title="<?php echo $row['link_title']; ?>" href="<?php echo $row['link_href']; ?>" > <i class="<?php echo "fa fa-".$row['glyph_name']; ?>"></i> <?php echo $row['link_name']; ?></a></li>
							<?php endwhile; ?>
						</ul>
					</div><!-- navbar-collapse -->
				</div><!-- container -->

			</div><!-- navbar -->

		</div><!-- navbar-wrapper -->
