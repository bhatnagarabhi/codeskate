<div id="thread_subcontent">
<?php 
				require_once ("../classes/init.php");

				session_start();

				if(!empty($_POST['thread_id'])) {
					$db			= new Database();
					$thread_res		= $db->fetchContentById(1, 'thread_id', $_POST['thread_id'], 'threads', 'users', 'user_id', 'user_id');
					$thread_arr 		= mysqli_fetch_array($thread_res);
					$thread_id 		= $_POST['thread_id'];

					// Thread details
					$posted_at 		= $thread_arr['posted_at'];
					$heading 		= $thread_arr['thread_heading'];
					$content 		= $thread_arr['thread_content'];

					// User details
					$username 		= $thread_arr['user_username'];
					$user_xp 		= $thread_arr['user_xp'];
					$user_pic 		= $thread_arr['user_pic'];
					
					$date 			= date("M d,Y", $posted_at); 
					$time			= date("H:i", $posted_at);

					if($thread_arr['user_id']!=$_SESSION['user_id']){
						$post_ob 		= new Posts();
						$post_ob->increaseViews($thread_id);
					}

				?>

			<div class="col-sm-1 text-center">
				<?php if(!empty($user_pic)) { ?>
					<img style="display: inline" class="img-circle" height="60" width="60" src="data:image/png;base64,<?php echo base64_encode($user_pic); ?>">
					<!-- <img src="images/aj.png" class="img-responsive" height="130px" width="130px" style="display: inline;"> -->
				<?php } else { ?>
					<img style="display: inline" class="img-circle" height="60" width="60" src="images/ben.png">
				<?php } ?>
			</div><!-- col-sm-3 -->
			<div class="col-sm-11" id="comment-wrapper">
				<p style="font-size: 13px;" class="arial-font"><?php echo $date; ?></p>
				<h2 style="font-weight: 500" class="black-fg arial-font"><?php echo $heading; ?></h2>
				<p style="font-size: 13px;" class="arial-font">By:<span class="theme-fg"><a href="#" style="color: #dd6060"><?php echo $username; ?></a></span></p>
				<div class="well arial-font"><?php print $content; ?></div>

				<div id="comment-generator">
					
				</div><!-- comment-generator -->
				<!-- ================ -->

				<div id="comment-form" style="padding-top: 0px; position: relative;" >
					<h2 class="black-fg">Leave a comment</h2>
					<!-- A form to add a comment -->
					<form action="" id="frm-addcomment" name="frm-addcomment">
						<textarea name="textarea_comment" id="textarea_comment" style="min-height: 250px; width: 100%; border:1px solid rgba(0,0,0,0.1);"></textarea><br>
						<button class="btn btn-success" id="btn-add-comment" type="submit"><i class="fa fa-check"></i> Comment</button>
					</form>
				</div><!-- comment-form -->

			</div><!-- col-sm-9 -->
		</div><!-- col-sm-12 -->

		<script type="text/javascript" src="vendor/tinymce/tinymce.min.js"></script>
		<!-- <script type="text/javascript">
			tinymce.init({
				selector : "#textarea_comment",
				statusbar: false,
				toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code restoredraft',
				plugins: "image imagetools autosave	",
				browser_spellcheck: true,
				contextmenu: false
			});

			
		</script> -->
		<div id="success-notification-panel"></div><!-- success-notification-panel -->
<?php
	} else {
		
	}
?>
</div><!-- thread_subcontent -->