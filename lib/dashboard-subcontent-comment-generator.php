<?php
	session_start();

	// Requiring the classes
	require_once("../classes/init.php");

	if(!empty($_POST['thread_id'])) {
		$thread_id 		= $_POST['thread_id'];
		$db 			= new Database();
		$query 		= "SELECT * FROM answers a LEFT JOIN users u on a.user_id = u.user_id WHERE thread_id=$thread_id";
		$res 			= $db::executeQuery($query);
?>
		<h3 class="black-fg"><?php echo mysqli_num_rows($res); ?> comments</h3>
		<hr>
<?php
		while($row 		= mysqli_fetch_array($res)) :
			$timestamp 	= $row['answered_at'];
			$date		= date("M d,Y", $timestamp); 
			$time		= date("H:i", $timestamp);
			$user_pic 	= $row['user_pic'];
?>
			<!-- comment -->
			<div id="comment" class="arial-font" style="margin: 30px auto; ">
				<div class="row">
					<div class="col-sm-1 text-center">
						<?php if(!empty($user_pic)) { ?>
							<img style="display: inline" class="img-circle" height="60" width="60" src="data:image/png;base64,<?php echo base64_encode($user_pic); ?>">
						<?php } else { ?>
							<img style="display: inline" class="img-circle" height="60" width="60" src="images/ben.png">
						<?php } ?>
					</div>
					<div class="col-sm-11" style="border-bottom:1px solid rgba(0,0,0,0.2)">
						<span class="theme-fg"><a href="#" style="color: #dd6060; text-decoration: underline;"><?php echo $row['user_username']; ?></a></span> On <span><?php echo $date; ?> @ <?php echo $time; ?></span><br><br>
						<div class="well"><?php echo $row['answer_content']; ?></div><!-- well -->
					</div>
				</div><!-- row -->
			</div><!-- comment -->
<?php
		endwhile;
	}
?>