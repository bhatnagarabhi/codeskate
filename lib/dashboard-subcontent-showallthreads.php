<?php
	require_once ("../classes/init.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		if($_POST['page']!=''){
			$current_page		= $_POST['page'];
		} else {
			$current_page		= 1;
		}

		if($_POST['language_id']!=''){
			$language_id 			= $_POST['language_id'];
		} else {
			$language_id 			= 0;
		}

		$db			= new Database();
		$num_rec_per_page	= 10;
		$upper_limit		= ($num_rec_per_page * $current_page)-$num_rec_per_page;
		if($language_id==0)
			$query			= "SELECT * FROM threads t LEFT JOIN users u ON t.user_id = u.user_id ORDER BY  thread_id DESC LIMIT {$upper_limit}, {$num_rec_per_page} ";
		else 
			$query			= "SELECT * FROM threads t LEFT JOIN users u ON t.user_id = u.user_id ORDER BY   thread_id DESC LIMIT {$upper_limit}, {$num_rec_per_page} ";
		$result			= mysqli_query(Database::$mysqli, $query);
		while ($user_posts_arr	= mysqli_fetch_array($result)) :
	?>
			<div class="table-responsive btn-success post" style="background-color: #509090; box-shadow: 0px 0px 10px 2px rgba(0,0,0, 0.2); border-radius: 3px; margin-bottom: 10px; padding: 20px; padding-bottom: 15px;">
				<div class="col-sm-3 text-center">
					<?php
						// Get all the comments related to a particular thread 	
						$ob_posts 		= new Posts();
						$comm_res 		= $ob_posts->getAllThreadComments($user_posts_arr['thread_id']);
					?>	
					<div class="col-sm-6"><span  style="font-size: 42px; line-height: 20px;"><i class="fa fa-comments" title="Answers"></i></span><br><?php print_r(mysqli_num_rows($comm_res)); ?></div>
					<div class="col-sm-6	"><span  style="font-size: 42px; line-height: 20px;"><i class="fa fa-eye" title="Views"></i></span><br><?php echo $user_posts_arr['thread_views']; ?></div>
				</div><!-- col-sm-4 -->

				<div class="col-sm-7 fg-black" style="color: #fff; background-color: #509090; padding-bottom: 0px;">
					<p><li value="<?php echo $user_posts_arr['thread_id']; ?>" style="list-style-type: none; margin-top: -10px; font-size: 18px; cursor: pointer;" class="post_heading"><?php echo stripslashes($user_posts_arr['thread_heading']); ?></li></p>
					<p>
						<?php 
							$date 			= date("dS M, Y", $user_posts_arr['posted_at']); 
							$time 			= date("H:i", $user_posts_arr['posted_at']);
							$language_id 		= $user_posts_arr['thread_language_id'];
							$lang_res 		= $db->fetchContentById(0, 'dev_glyph_id', $language_id, 'dev_glyphs');
							$lang_arr 		= mysqli_fetch_array($lang_res);
							$devglyph 		= 'devicon-'.$lang_arr['dev_glyph_name'].'-plain';
						?>
						Posted by :  <a href="#" class="fg-white" data-toggle="tooltip" title="<?php echo $user_posts_arr['user_xp']; ?> XPs"><span class="font-bold arial-font"><?php echo $user_posts_arr['user_username']; ?></span></a> <span style="font-size: 20px;">|</span> <span class="font-bold arial-font"><?php echo $date; ?></span> <span style="font-size: 20px;">|</span> <span class="font-bold arial-font"><?php echo $time; ?></span><br>
					</p>
				</div>

				<div class="col-sm-2 text-center">
					<i class="<?php echo $devglyph; ?>" style="font-size: 80px"></i>
				</div>

			</div><!-- table-responsive -->
	<?php	endwhile; ?>
</body>
<script type="text/javascript">
	$(document).ready(function (){
		$('[data-toggle="tooltip"]').tooltip();

		$('.post_heading').click(function(){
			var thread_id 	= $(this).val();
			$.ajax({
				url: 'lib/dashboard-subcontent-showthreadcontent.php',
				type: 'POST',
				dataType: 'html',
				data: "thread_id="+thread_id,
				success:function(response, status, http){
					$('#content').html(response);
				}
			});
		});

	});
</script>
</html>