<?php require_once("../classes/init.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width", initital-scale="1">
	<title>War management</title>
</head>

<body>
	<?php require_once("lib/header.php"); ?>

	<!--DEVICONS -->
	<link rel="stylesheet" type="text/css" href="css/devicons/devicon.min.css">
	<div class="container"> 
		<div class="row">
			<div class="col-sm-12" style="margin-top: 80px;">
				<div><a href="dashboard"><i class="fa fa-arrow-left"></i> Back to dashboard</a></div>
				<div class="col-sm-5">
					<h2>Start a war</h2><hr>
					<form method="post" id="frm-start-war" style="background-color: #f8f8f8; padding:15px;">
						<input type="text" id="war_name" required name="war_name" placeholder="War name" class="form-control"><br>
						<input type="number" name="war_xp" min="1000" required max="20000" placeholder="Win Xp" class="form-control"><br>
						<select id="war_language_id" name="war_language_id"  class="form-control">
							<?php 
								$db 	= new Database();
								$res 	= $db->fetchAllContent(0, 'dev_glyphs');
								while($row 	= mysqli_fetch_array($res) ) :  
								$lang 	=  $row['dev_glyph_name'];
								$lang  	= strtoupper(substr($lang, 0, 1)).substr($lang, 1);
							?>
								<option value="<?php echo $row['dev_glyph_id']; ?>"><?php echo $lang; ?></option>
							<?php endwhile; ?>
						</select><!-- war_language_id --><br>
						<input type="text" id="war_question" name="war_question" required class="form-control" placeholder="Your war question heading goes here"><br>
						<textarea name="war_question_content" required class="form-control" style="min-height: 130px; font-size: 13px;">Details of the war question.</textarea><br>
						<button class="btn btn-success" id="btn-start-war"><i class="fa fa-check"></i> Start</button>
					</form>
				</div>
				<div class="col-sm-6 col-sm-offset-1">
					<h2>Ongoing wars</h2><hr>
					<?php 
						$sql 	= "SELECT * FROM wars l LEFT JOIN dev_glyphs r ON l.war_language_id = r.dev_glyph_id WHERE l.war_winner_entry_id=0 ";
						$res 	= $db::executeQuery($sql);
						while($row 		= mysqli_fetch_array($res)) :
					?>
							<li style="list-style-type: none;">
								<div class="well" style="font-size: 14px;">
									<a href="war_details.php?war_id=<?php echo $row['war_id']; ?>">
										<?php echo $row['war_question_heading']; ?><i style="font-size: 40px; margin-top: -10px;" class="pull-right devicon-<?php echo $row['dev_glyph_name']; ?>-plain"></i>
									</a>
								</div>
							</li>
					<?php endwhile; ?>
				</div>
			</div><!-- col-sm12 -->
		</div><!-- row -->
	</div><!-- container -->
</body>

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
	$(document).ready(function() {
		$(document).on('submit', '#frm-start-war', function(event) {
			event.preventDefault();
			formdata 	= $(this).serialize();
			$.ajax({
				url: 'inc/start_war.php',
				type: 'POST',
				dataType: 'json',
				data: formdata,
				success : function(response, status, http){
					if(response[0]) {
						alert("War started successfully !");
						location.reload();
					} else {
						alert("There seems to be a problem");
					}
				}
			});
		});
	});
</script>