<?php 
	
	// Getting the required  classes
	require_once ("../classes/init.php");

	if(!empty($_POST['sub_page_id'])){
		$subpage_id 			= $_POST['sub_page_id'];
		$session 			= new Session(); 
		$user_id 			= $session->getSession('user_id');

		/* 
			Index of subpages
			===================================
			1). View all the threads
			2). View all the comments
			3). Total wars won
		*/

		if($subpage_id==1){ ?>
			 <!-- View all threads content here -->
			<div class="col-sm-12">
				<h3 class="black-fg">Your recent threads</h3><hr>
				<?php 
					// Fetch all the user threads
					$ob_post 		= new Posts();
					$user_posts_res	= $ob_post->getAllUserPosts($user_id);
					while($user_posts_arr 	= mysqli_fetch_array($user_posts_res)) {
				?>

					<div class="table-responsive" style="border-radius: 5px;">
						<div class="well btn-success fg-white" style="background-color: #30aa70;">
							<h4 class="fg-white font-bold"><?php echo stripslashes($user_posts_arr['thread_heading']); ?></h4><hr>
							<h6 class="fg-white" style="line-height: 23px;">
								<?php 
									print $trim_content 	= substr(htmlspecialchars_decode(stripslashes($user_posts_arr['thread_content'])), 0, 1000); 
									if(strlen(stripslashes($user_posts_arr['thread_content'])) > 1000){
								?>
										<a href="#" style="font-size: 18px;" class="font-bold fg-white">Read more...</a>
								<?php  } ?>
							</h6>
							<p style="text-align: right;">
							
								<?php 
									$date 		= date("dS M, Y", $user_posts_arr['posted_at']); 
									$time 		= date("H:i", $user_posts_arr['posted_at']);
								?>
								Posted on : <span class="font-bold"><?php echo $date; ?></span> at <span class="font-bold"><?php echo $time; ?></span><br>
								<span style="font-size: 20px;"><i class="fa fa-comments"></i></span><sup style="font-size: 14px;" class="font-bold"> 5</sup>
							</p>
						</div><!-- post -->
					</div><!-- table-responsive -->
	
				<?php } // End of while ?>

			</div><!-- col -->
		<?php } else if($subpage_id==2){ ?>
			 <!-- View all the comment contents here -->
			<div class="col-sm-12">
				Hey these are the comments
			</div><!-- col -->
		<?php } else if($subpage_id==3){ ?>
			 <!-- View the total wars won here -->
			<div class="col-sm-12">
				Hey these are the wars won by you
			</div><!-- col -->
		<?php }

	}
?>