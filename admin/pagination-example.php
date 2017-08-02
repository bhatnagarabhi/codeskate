<?php
	require_once "../classes/init.php";
	$db	= new Database();
	$res	= $db->fetchAllContent(0, 'images');
	$num_rec_per_page	= 10;
	$num_content		= mysqli_num_rows($res);
	$num_pages 		= ceil($num_content/$num_rec_per_page);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url: "lib/showpaginated-img.php",
				data: "page=",
				type: "POST",
				dataType: "html",
				success: function(response, status, http){
					$('#img-gallery').html(response);
				}
			});

			$('.btn-pagination').click(function(event) {
				var page 	= $(this).val();
				$.ajax({
					url: "lib/showpaginated-img.php",
					data: "page="+page,
					type: "POST",
					dataType: "html",
					success: function(response, status, http){
						$('#img-gallery').html(response);
					}
				});
			});

		});
	</script>
</head>
<body>
	<?php require_once ("lib/header.php"); ?>
	<div class="container" style="margin-top: 60px">
		<div class="row">
			<div class="col-sm-12">
				<center><div id="img-gallery" style="min-height: 450px;">
					
				</div></center>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<?php for ($i=1; $i <=$num_pages ; $i++) {  ?>
					<button class="btn-pagination btn btn-primary" value="<?php echo $i; ?>"><?php echo $i; ?></button>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>