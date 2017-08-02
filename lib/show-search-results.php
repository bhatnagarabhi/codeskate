<?php

	require_once ("../classes/init.php");

	// Check if the post data is empty
	if(!empty($_POST)) {
		
		$db 			= new Database();
		$lang_id 		= $db::sanitize(addslashes($_POST['filter_language']));
		$search_flag 	= $db::sanitize(addslashes($_POST['searchtext']));
		$query 			= "SELECT * FROM threads WHERE ( thread_content LIKE '%{$search_flag}%' OR thread_content LIKE '{$search_flag}%' OR thread_content LIKE '%{$search_flag}' OR thread_content LIKE '{$search_flag}' OR thread_heading LIKE '%{$search_flag}%' OR  thread_heading LIKE '{$search_flag}%' OR thread_heading LIKE '%{$search_flag}' OR thread_heading LIKE '{$search_flag}' ) ";

		if(!empty($_POST['filter_is_answered'])) {
			// Only answered posts allowed
			$query.=" AND thread_accepted_ans_id=1";
		}

		if($lang_id!=0) {
			$query.=" AND thread_language_id={$lang_id}";
		}

		$res			= $db::executeQuery($query);
		$num_rows		= mysqli_num_rows($res);

	?>

	<h2 class="black-fg">Search returned <?php echo $num_rows; ?> results</h2><hr>

	<?php
		while($row	= mysqli_fetch_array($res)) :
	?>
	
			<!-- Thread Results -->
			<div class="table-responsive btn-success post" style="background-color: #509090; box-shadow: 0px 0px 10px 2px rgba(0,0,0, 0.2); border-radius: 3px; margin-bottom: 10px; padding: 20px; padding-bottom: 15px;">
				<div class="col-sm-3 text-center">	
					<div class="col-sm-6"><span  style="font-size: 42px; line-height: 20px;"><i class="fa fa-comments" title="Answers"></i></span><br>2</div>
					<div class="col-sm-6"><span  style="font-size: 42px; line-height: 20px;"><i class="fa fa-eye" title="Views"></i></span><br><?php echo $row['thread_views']; ?></div>
				</div><!-- col-sm-4 -->

				<?php 
					$thread_id 		= $row['thread_id'];
					$date 			= date("dS M, Y", $row['posted_at']); 
					$time 			= date("H:i", $row['posted_at']);
					$language_id 	= $row['thread_language_id'];
					$lang_res 		= $db->fetchContentById(0, 'dev_glyph_id', $language_id, 'dev_glyphs');
					$lang_arr 		= mysqli_fetch_array($lang_res);
					$devglyph 		= 'devicon-'.$lang_arr['dev_glyph_name'].'-plain';

					$user_res		= $db->fetchContentById(0, 'user_id', $row['user_id'], 'users');
					$user 			= mysqli_fetch_array($user_res);
		
				?>

				<div class="col-sm-7 fg-black" style="color: #fff; background-color: #509090; padding-bottom: 0px;">
					<p><li value="<?php echo $row['thread_id']; ?>" style="list-style-type: none; margin-top: -10px; font-size: 18px; cursor: pointer;" class="post_heading"><?php echo $row['thread_heading']; ?></li></p>
					<p>
						Posted by :  <a href="#" class="fg-white" data-toggle="tooltip" title="<?php echo $user['user_xp']; ?> XPs"><span class="font-bold arial-font"> <?php echo $user['user_username']; ?> </span></a> <span style="font-size: 20px;">|</span> <span class="font-bold arial-font"><?php echo $date; ?></span> <span style="font-size: 20px;">|</span> <span class="font-bold arial-font"> <?php echo $time; ?></span><br>
					</p>
				</div><!-- col-sm-7 -->

				<div class="col-sm-2 text-center">
					<i class="<?php echo $devglyph; ?>" style="font-size: 80px"></i>
				</div><!-- col-sm-2 -->
			</div><!-- table-responsive -->

	<?php 
		endwhile;
	} 
	?>