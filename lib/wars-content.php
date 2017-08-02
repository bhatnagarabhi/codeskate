<?php

	// Show this content according to the side links clicked
	$page_id 		= 1;
	if(!empty($_POST)){
		require_once("../classes/init.php");
		$page_id 	= $_POST['url_id'];
		$db 		= new Database();
		$session 	= new Session(); 
		$user_id 	= $session->getSession('user_id');
		$user_arr 	= mysqli_fetch_array($db->fetchContentById(0,'user_id', $user_id, 'users'));
	}

	/* 
		- INDEX ====================
		1 -> Dashboard,
		2 -> Notifications,
		3 -> Settings,
		4 -> Blog,
		5 -> Query,
		6 -> Wars,
		7 -> Search,
		8 -> Log Out
	*/

	if($page_id==1){ ?>
		<!-- Dashboard content here -->
	
		<?php 
			// Get all the posts by the user
			$ob_post 		= new Posts();
			$user_post_res 	= $ob_post->getAllUserPosts($user_id);
			$total_user_posts 	= mysqli_num_rows($user_post_res);
		?>

		<div style="min-height:305px;background-color: white;" id="widget-wrapper">
			<!-- TOTAL THREADS WIDGET
			================================= --> 
			<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #30aadd; padding: 20px; border:5px solid #fff;">
				
				<div class="row fg-white">
					<div class="col-sm-2 medium-font fg-white" >
						<i class="fa fa-calculator"></i>
					</div><!-- col-sm-2 -->
					<div class="col-sm-10 text-left" style="padding-top: 12px;">
						<span style="font-size: 32px; "><?php echo $total_user_posts; ?></span> Total threads
					</div><!-- col-sm-8 -->
				</div><!-- row --><hr style="margin: 0px auto 5px auto;">
				<footer class="text-right">
					<ul style="list-style-type: none;" class="fg-white">
						<li class="sub-content-link" style="cursor: pointer;" value="1">View all the threads &raquo;</li>
					</ul>
				</footer>
				
			</div><!-- col-sm-4 -->


			<!-- TOTAL COMMENTS WIDGET
			================================= --> 
			<?php 
				// Get all the posts by the user
				$ob_post 		= new Posts();
				$user_com_res 	= $ob_post->getAllUserComments($user_id);
				$total_com_posts 	= mysqli_num_rows($user_com_res);
			?>
			<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #30aa70; padding: 20px; border:5px solid #fff;">
				
				<div class="row fg-white">
						<div class="col-sm-2 medium-font" >
							<i class="fa fa-comments"></i>
						</div><!-- col-sm-2 -->
						<div class="col-sm-10 text-left" style="padding-top: 12px;">
							<span style="font-size: 32px; "><?php echo $total_com_posts; ?></span> Total comments
						</div><!-- col-sm-8 -->
				</div><!-- row --><hr style="margin: 0px auto 5px auto;">
				<footer class="text-right">
					<ul style="list-style-type: none;" class="fg-white">
						<li style="cursor: pointer;" class="sub-content-link" value="2">View all the comments &raquo;</li>
					</ul>
				</footer>

			</div><!-- col-sm-4 -->


			
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				$('.sub-content-link').click(function(){
					var subpage_id 	= $(this).val();
					$.ajax({
						url: 'lib/dashboard-subcontent',
						type: 'POST',
						dataType: 'html',
						data: "sub_page_id="+subpage_id,
						success:function(response, status, http){
							$('#content').html(response);
						}
					});
				});
			});
		</script>


	<?php } else if($page_id ==2 ) { ?> 
		
		<div id="notification-generator-div">
			<?php
				// Requiring the notification generator
				require_once("notification-generator.php");
			?>
		</div><!-- notification-generator -->

	<?php } else if ($page_id == 3) { ?>
		<style type="text/css">
			input[type="checkbox"]:after {
				border:2px solid #444;
			}
		</style>
		<!-- Ally content here -->
		<div class="bg-white col-sm-12" style="margin-top: -30px; padding:20px;">
			<?php if($user_arr['user_ally_id'] == 0)
				  { 	// User is not a part of any ally 
			?>
					<h3 class="arial-font black-fg">You're currently not a part of any ally, you can either <span class="theme-fg">join an existing ally</span> or <span class="theme-fg">create your own</span></h3><hr>
					
					<!-- Search -->
					<div class="col-sm-8 col-sm-offset-2 jumbotron">
						<h3 class="black-fg">Search for an ally</h3>
						<form id="frm-search-ally" method="post">
							<div class="form-group">
								<input type="text" name="txt_searchterm" id="txt_searchterm" class="form-control" placeholder="Search here..."><br>
								<input type="checkbox" style="color: black; margin: 0px;" id="is_tag" name="is_tag"> <label class="font-bold" style="padding-top: 0px; margin-top: -10px;">Search by ally tag</label><br>
								<button type="button" class="btn btn-success" id="search-btn-submit"><i class="fa fa-search"></i> Search</button>
							</div><!-- form-group -->
						</form>
					</div><!-- jumbotron -->

					<script type="text/javascript">
						$(document).ready(function() {
							$(window).keydown(function(event){
							    if(event.keyCode == 13) {
							      event.preventDefault();
							      return false;
							    }
							  });
							$('#search-btn-submit').click(function(event) {
								var searchterm 	= $('#txt_searchterm').val();
								var ischecked 		= $('#is_tag').is(':checked');
								$.ajax({
									url: 'lib/show_ally_search_result',
									type: 'POST',
									data: {searchterm: searchterm, is_tag : ischecked},
									success: function(response, status, http){
										$('#search_result').html(response);
									}
								});
							});
						});
					</script>

					<div class="col-sm-12" id="search_result">
						
					</div><!-- col-sm-12 -->

					<!-- Create ally -->
					<div class="col-sm-8 col-sm-offset-2 jumbotron">
						<header><h2 class="black-fg">Create your own ally</h2></header><hr>
						<form class="font-bold" id="frm-add-ally">
							<div class="form-group">
								<input type="text" class="form-control txtbox-fix" placeholder="Ally name" maxlength="50" minlength="5" required name="ally_name">
							</div>

							<div class="form-group">
								Select war frequency : <span id="war_freq_range"></span>
								<input type="range" value="1" max="3" min="1" required name="ally_war_participation_frequency" id="ally_war_participation_frequency">
							</div>

							<div class="form-group">
								<textarea required minlength="30" maxlength="1000" name="ally_description" class="textarea-fix form-control">Ally Description (upto 1000 characters)</textarea>
							</div>

							<button name="submit" id="btn-add-ally" value="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
							<button name="reset" value="reset" type="reset" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>

						</form>
					</div>
			<?php } else { // User is already a part of an ally?>
					
					
					<?php
						$ally_res 	= $db->fetchContentById(1, 'user_id', $user_id, 'users', 'allies', 'user_ally_id', 'ally_id');
						$ally_arr 	= mysqli_fetch_array($ally_res);
						$ally_name 	= $ally_arr['ally_name'];
						$ally_tag 	= $ally_arr['ally_tag'];
						$ally_freq 	= $ally_arr['ally_war_participation_frequency'];
						$ally_desc 	= $ally_arr['ally_description'];
						$ally_leader 	= $ally_arr['ally_leader_id'];
						$ally_id 	= $ally_arr['ally_id'];
					?>

					
					<div class="col-sm-12">
						<h2 class="black-fg">War participation status </h2><hr>
						<div class="jumbotron">
							<div id="war_status_notifier" class="col-sm-2">

								<?php if($user_arr['user_war_status']==0) { ?>
								
									<li  value="1" id="btnout" class="war_status_btn" style="list-style-type: none"><div class="button-wrapper-red" style="width: 130px;">
										<div class="reflect"></div>
										<div class="content font-bold arial-font">
											<i style="font-size: 20px; margin-right: 5px;" class="fa fa-remove"></i> I'm out
										</div> 
									</div></li><!-- button-wrapper-red -->

									<li  value="0" id="btnin" class="war_status_btn hidden" style="list-style-type: none;"><div  class="button-wrapper-green" style="width: 130px;">
										<div class="reflect"></div>
										<div class="content font-bold arial-font"> 
											<span><i style="font-size: 20px; margin-right: 5px;" class="fa fa-shield"></i> I'm in</span>
										</div>
									</div></li><!-- button-wrapper-green -->

								<?php } else { ?>

									<li  value="1" id="btnout" class="war_status_btn hidden" style="list-style-type: none"><div class="button-wrapper-red" style="width: 130px;">
										<div class="reflect"></div>
										<div class="content font-bold arial-font">
											<i style="font-size: 20px; margin-right: 5px;" class="fa fa-remove"></i> I'm out
										</div> 
									</div></li><!-- button-wrapper-red -->
							
									<li  value="0" id="btnin" class="war_status_btn" style="list-style-type: none;"><div  class="button-wrapper-green" style="width: 130px;">
										<div class="reflect"></div>
										<div class="content font-bold arial-font"> 
											<span><i style="font-size: 20px; margin-right: 5px;" class="fa fa-shield"></i> I'm in</span>
										</div>
									</div></li><!-- button-wrapper-green -->

								<?php } ?>
						
							</div><!-- war-status-notifier -->
						</div><!-- jumbotron -->

						<script type="text/javascript">
							$(document).ready(function() {
								$('.war_status_btn').click(function(event) {
									var war_status = $(this).val();
									$(this).addClass('hidden');
									$.ajax({
										url: 'inc/update_user_details.php',
										type: 'POST',
										dataType: 'json',
										data: {war_status: war_status},
										success: function(response, status, http){
											if(war_status==0){
												$('#btnout').removeClass('hidden');
											} else {
												$('#btnin').removeClass('hidden');
											}
										}
									});
								});

								

							});
						</script>

					<?php if ($ally_leader == $user_id) { ?>

							<h2 class="black-fg">Requests</h2><hr>
							<div  id="req_generator">
								<?php 
									$query 	= "SELECT * FROM requests l LEFT JOIN users r ON l.request_requester_id = r.user_id WHERE l.request_requestee_id={$user_id} AND request_is_approved=0 AND r.user_ally_id=0";
									$res 		= $db::executeQuery($query);
									while ($row 	= mysqli_fetch_array($res) ) : // Fetch all the current ally requests
								?>
										<div class="bg-theme well fg-white">
											<h4 class="fg-white arial-font">"<span class=" font-bold"><?php echo $row['user_username']; ?></span>" ( <?php echo $row['user_xp']; ?> XPs ) wants to join your ally. <span class="pull-right" style="margin-top: -10px;"><button value="<?php echo $row['user_id']; ?>" class="btn btn-success approve-request"><i class="fa fa-check"></i> Accept</button> <button class="btn btn-danger deny-request" value="<?php echo $row['user_id'] ?>"><i class="fa fa-remove"></i> Deny</button></span></h4>
										</div><!-- bg-theme -->
								<?php	endwhile; ?>
							</div><!-- req_generator -->
				
							<div class="col-sm-12">
								<h2 class="black-fg">Ally details</h2><hr>
								<div class="col-sm-8 col-sm-offset-2 jumbotron" id="aboutally">
									<form id="frm-edit-ally" class="font-bold">
										<label>Ally tag : </label> <label class="theme-fg arial-font"><?php echo $ally_tag; ?></label><br><br>
										<label>Ally name : </label> <input class="form-control font-bold" placeholder="Ally name" value="<?php echo $ally_name; ?>" type="text" maxlength="100" name="txt_ally_name"><br>
										<label>War participation frequency : <span class="theme-fg" id="preview_freq"><?php if($ally_freq==1) { echo "Monthly"; } else if($ally_freq==2) { echo "Weekly"; } else { echo "Actively"; } ?></span></label> <input type="range" id="war_participation_frequency" required min="1" max="3" value="<?php echo $ally_freq; ?>" name="war_participation_frequency">
										<label>Ally description : </label> <textarea name="ally_description" class="form-control" style="border:1px solid rgba(0,0,0,0.2); font-size: 12px; padding: 10px; min-height: 140px;" id="ally_description"><?php echo $ally_desc; ?></textarea><br>
										<button class="btn btn-success"><i class="fa fa-check-circle"></i> Confirm</button>
										<button type="reset" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
									</form><!-- #frm-edit-ally -->
								</div><!-- aboutally -->
							</div><!-- col-sm-12 -->

							<script type="text/javascript">
								$('.approve-request').click(function(event) {
									var join_user_id = $(this).val();
									$(this).parent().parent().parent().fadeOut(300);
									$.ajax({
										url: 'inc/manage_ally_join_request',
										type: 'POST',
										dataType: 'json',
										data: {mode: 1, requester_id: join_user_id, ally_id:<?php echo $ally_id; ?>},
										success: function(response, status, http){
											if(response[0]){
												alert("User request approved.");
											} else {
												alert("Something went wrong. This could be because the user has already joined an ally.");
											}
										}
									});
								});

								$('.deny-request').click(function(event) {
									var join_user_id = $(this).val();
									$(this).parent().parent().parent().fadeOut(300);
									$.ajax({
										url: 'inc/manage_ally_join_request',
										type: 'POST',
										dataType: 'json',
										data: {mode: 2, requester_id: join_user_id, ally_id:<?php echo $ally_id; ?>},
										success: function(response, status, http){
											if(response[0]){
												alert("User request denied.");
											} else {
												alert("Something went wrong. This could be because the user has already joined an ally.");
											}
										}
									});
								});


							</script>
					<?php } else { 
							$leader_res 		= $db->fetchContentById(0, 'user_id', $ally_leader, 'users');
							$leader_arr 		= mysqli_fetch_array($leader_res);
					?>
					
								<h2 class="black-fg">Ally details</h2><hr>
								<div class="col-sm-12 jumbotron" id="aboutally">
									<h2 class="black-fg"><img src="images/aj.png" height="100px" width="100px"> <?php echo $ally_name; ?><button class="btn pull-right btn-danger" style="margin-top: 35px;"><i class="fa fa-sign-out"></i> Leave this ally</button></h2><hr>
									<p class="font-bold" style="font-size: 14px;">
										<label>Tag : <span class="theme-fg arial-font"><?php echo $ally_tag; ?></span> </label><br>
										<label>Leader : <span class="theme-fg"><?php echo $leader_arr['user_username']; ?></span></label><br>
										<label>War participation frequency : <span class="theme-fg"><?php if($ally_freq==1) { echo "Monthly"; } else if($ally_freq==2) { echo "Weekly"; } else { echo "Actively"; } ?></span></label><br>
										<label>Description : <br><div class="bg-theme fg-white" style="padding: 10px; margin-top: -15px;"><?php echo $ally_desc; ?></div></label>
									</p>
								</div><!-- aboutally -->
								
							</div><!-- col-sm-12 -->

					<?php } ?>

					<h2 class="black-fg">Members</h2><hr>
					<div class="table-responsive">
						<table width="100%" class="table arial-font table-hover table-striped">
							<tr>
								<th width="5%">S.No</th>
								<th width="15%">User pic</th>
								<th width="50%">Username</th>
								<th width="15%" class="text-center">User Xps</th>
								<th class="text-center">War status</th>
							</tr>
							<?php
								// Fetching all the users that belong to the same ally
								$i=1;
								$members_res 		= $db->fetchContentById(0, 'user_ally_id', $ally_id, 'users');
								while($members_arr 		= mysqli_fetch_array($members_res)) :
							?>
									<tr>
										<td style="vertical-align: middle;"><?php echo $i++; ?></td>
										<td style="vertical-align: middle;"><img height="60px" width="60px" style="border-radius: 2px;" src="data:image/png;base64,<?php echo base64_encode($members_arr['user_pic']);?>"></td>
										<td style="vertical-align: middle; font-size: 14px;"><?php echo $members_arr['user_username']; ?></td>
										<td style="vertical-align: middle;" class="text-center"><span style="font-size: 20px;" class="theme-fg"><?php echo $members_arr['user_xp']; ?></span></td>
										<td style="vertical-align: middle; font-size: 16px;" class="text-center"><?php if($members_arr['user_war_status'] == 1) { ?><span class="font-bold btn-success fg-white img-circle" style="padding: 8px 10px;">In</span> <?php } else { ?><span class="font-bold btn-danger fg-white img-circle" style="padding: 12px 10px;">Out</span><?php } ?></td>
									</tr>
							<?php endwhile;	?>
						</table>
					</div><!-- table-responsive -->

			<?php } ?>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){

				$('#war_freq_range').html("Monthly");

				$('#btn-change-pic').attr('disabled', 'true');

				$('#user_pic').change(function() {
					var reader = new FileReader();

					reader.onload = function (e) {
					    // get loaded data and render thumbnail.
					    document.getElementById("user_pic_preview").src = e.target.result;
					};
					// read the image file as a data URL.
					reader.readAsDataURL(this.files[0]);
					$('#btn-change-pic').removeAttr('disabled');
				});

				

			});
		</script>
	
		<style type="text/css">
			.txtbox-fix{
				border-bottom: 1px solid rgba(0,0,0,0.3) !important;
				padding-left: 5px;
			}
			.textarea-fix{
				border: 1px solid rgba(0,0,0,0.3) !important;
				padding:10px !important;
				font-size: 12px !important;
				min-height: 200px;
			}
			.button-wrapper-red {
				border-radius: 12px;
				border: 2px solid rgba(0,0,0,0.4);
				background-color: rgba(219, 84, 17, 1);
				color: white;
				font-size: 15px;
				padding: 8px 4px;
				cursor: pointer;
				margin-top: -20px;
			}
			.button-wrapper-green {
				border-radius: 12px;
				border: 2px solid rgba(0,0,0,0.3);
				background-color: rgba(30, 170, 35, 1);
				color: white;
				font-size: 15px;
				padding: 8px 4px;
				cursor: pointer;
				margin-top: -20px;
			}
			.reflect {
				background-color: rgba(255,255,255,0.3);
				border-radius: 6px;
				height: 22px;
				margin-top: -4px;
			}
			.content {
				position: relative;
				font-size: 16px;
				font-weight: bold;
				margin-top: -15px;
				text-align: center;
				text-shadow: 2px 1px 1px rgba(0,0,0,0.8);
			}
		</style>

	<?php } else if($page_id == 4) { ?>
		<?php
			// Getting all the war posts
			$db  			= new Database();
			$query 		= "SELECT * FROM wars l LEFT JOIN dev_glyphs r ON l.war_language_id = r.dev_glyph_id";
			$res 			= $db::executeQuery($query);

			$num_rec_per_page	= 10;
			$num_content	= mysqli_num_rows($res);
			$num_pages 		= ceil($num_content/$num_rec_per_page);

		?>
		<!-- Blog content here -->
		<div class="bg-white" id="blog">
			<div class="col-sm-12">
			
				<div id="showallwars">
					<h2 class="black-fg">Ongoing wars</h2><hr>

					<?php
						$sql	 	= "SELECT * FROM users WHERE user_id={$user_id}";
						$res 		= $db::executeQuery($sql);
						$row 		= mysqli_fetch_array($res) ;
						if($row['user_ally_id']==0) {
					?>
							<center><h2 class="theme-fg">You must join an ally if you want to add a war entry.</h2></center>
					
					<?php
						} else {
							$sql=  "SELECT * FROM wars l LEFT JOIN dev_glyphs r ON l.war_language_id = r.dev_glyph_id WHERE l.war_winner_entry_id=0 ";
							$res 	= $db::executeQuery($sql);
							while($row 		= mysqli_fetch_array($res)) :
						?>
								<li style="list-style-type: none;">
									<div class="well" style="font-size: 14px;">
										<a href="add-war-entry.php?war_id=<?php echo $row['war_id']; ?>" class="link_submit" >
											<?php echo $row['war_question_heading']; ?><i style="font-size: 40px; margin-top: -10px;" class="pull-right devicon-<?php echo $row['dev_glyph_name']; ?>-plain"></i>
										</a>
									</div>
								</li>
								
						<?php endwhile; } ?>

				</div><!-- showallwars -->

			</div><!-- col-sm-12 -->
		</div><!-- bg-white -->


	<?php } else if($page_id==5) { ?>
		<!-- Start a thread -->
		<?php
			// Fetching out languages
			$user_res 	= $db->fetchAllContent(0, 'dev_glyphs');
		?>
		<script type="text/javascript" src="vendor/tinymce/tinymce.min.js"></script>
		
		<?php 
			$ob_post 		= new Posts();
			$post_res 		= $ob_post->getRecentUserPost($user_id);
			$post_arr 		= mysqli_fetch_array($post_res);
			$time_until_last 	= $post_arr['posted_at'];
			if((time()-$time_until_last)>=86400){
		?>

		<div class="bg-white" style="margin-top: -30px; padding:20px;">
			<h3 class="black-fg font-bold">Start a thread</h3>
			<form method="post" id="frm-start-thread">
				<input type="text" required name="thread_heading" id="thread_heading" class="form-control font-bold arial-font" style="font-size:13px; border: 1px solid rgba(0,0,0,0.2); padding-left: 12px;" placeholder="Thread heading"><br>
				<select name="language_tag" id="language_tag" required class="form-control font-bold" style="border:1px solid rgba(0,0,0,0.2); padding-left: 15px; font-size: 13px;">
					<?php while($row 	= mysqli_fetch_array($user_res) ) :  
						$lang 	=  $row['dev_glyph_name'];
						$lang  	= strtoupper(substr($lang, 0, 1)).substr($lang, 1);
					?>
						<option value="<?php echo $row['dev_glyph_id']; ?>"><?php echo $lang; ?></option>
					<?php endwhile; ?>
				</select><br>
				<textarea id="textarea_thread"  name="thread_content" rows="10" class="form-control arial-font" style="border: 1px solid rgba(0,0,0,0.2); font-size: 14px; padding: 12px; padding-top: 5px; font-weight: bold"></textarea><br>
				<button type="submit" class="btn btn-success" id="btn-submit-add-thread"><i class="fa fa-check"></i> Submit</button>
				<button type="reset" class="btn btn-primary" id="btn-reset-add-thread"><i class="fa fa-refresh"></i> Reset</button>	
			</form>
		</div>
		<script type="text/javascript">
			tinymce.init({
				selector : "#textarea_thread",
				statusbar: false,
				toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code restoredraft',
				plugins: "image imagetools autosave",
				browser_spellcheck: true,
				contextmenu: false
			});
		</script>

		<?php } else {	$next_thread_date 	= date("dS M Y h:i:s", $time_until_last+86400); ?>
				<div class="jumbotron" style="margin-top: -50px">
					<h2 class="black-fg">You can't start a new thread right now. Next thread on : <?php echo $next_thread_date; ?></h2>
				</div>
		<?php	} ?>


	<?php } else if($page_id==6){ ?>
		
		 	<!-- <div class="col-sm-12 text-center" style="min-height: 300px;"> -->
		 		<?php require_once("../code-editor.php"); ?>
		 	<!-- </div>col-sm-12 -->


	<?php	} else if($page_id==7) { ?>
		
		<style type="text/css">
			input[type="checkbox"]:after {
				border:2px solid #444;
			}
		</style>

		<?php
			// Get results for dropdowns
			$lang_res 	= $db->fetchAllContent(0, 'dev_glyphs');
		?>

		<!-- Search -->
		<div class="bg-white" id="search" style="margin-top: -30px; padding:20px; min-height: 335px;">
			<h3 class="black-fg font-bold">Search</h3><hr>
			<div class="col-sm-12">
				<button class="btn btn-danger hidden" id="backtosearch" style="border-radius: 100%; padding-top: 10px; padding-bottom: 10px; margin-bottom: 20px;"><i class="fa fa-arrow-left"></i></button>
			</div><!-- col-sm-12 -->
			<form method="post" class="form" id="frmsearch">
				<input type="text" class="form-control font-bold" required placeholder="Enter keywords here..." name="searchtext" style="border:1px solid rgba(0,0,0,0.1); padding-left: 15px; border-radius: 3px;"><br>
				<button type="button" class="btn btn-primary font-bold" id="btn-show-filters"><i class="fa fa-filter"></i> Filter</button>
				<button type="submit" class="btn btn-success font-bold"><i class="fa fa-search"></i> Search</button><br><br>
				<div id="showfilters">
					<div class="col-sm-8 col-sm-offset-2 font-bold"  style="background-color: #efefef; padding:15px; border-radius: 3px;">
						Language :
						<select name="filter_language" id="filter_language" class="form-control" style="border-bottom:1px solid rgba(0,0,0,0.5); padding-left: 15px;">
							<option selected value="0">Any</option>
							<?php while($row 	= mysqli_fetch_array($lang_res)) : ?>
								<option value="<?php echo $row['dev_glyph_id']; ?>"><?php echo $row['dev_glyph_name']; ?></option>
							<?php endwhile; ?>
						</select><br>
						
						<input type="checkbox" id="filter_is_answered" name="filter_is_answered" style="margin-bottom: -3px; color: black;"> Show only answered posts
					</div><!-- col-sm-4 -->
				</div><!-- showfilters -->
			</form>

			<div class="row">
				<div class="col-sm-12" id="showsearchresults">
					
				</div><!-- showsearchresults -->
			</div>

		</div>
	<?php } ?>

	<div id="success-notification-panel"></div><!-- success-notification-panel -->

	<script type="text/javascript">
		

		$(document).ready(function($) {
			
			$('#btn_user_pic').click(function(event) {
				$('#user_pic').click();
			});

			$('#showfilters').toggle('fast');

			$('#btn-show-filters').click(function(event) {
				$('#showfilters').toggle('slow');
			});

			$('#backtosearch').click(function(event) {
				$('#sidebar-ul #li-search').click();
				// alert("Hi");
			});

			// To ensure that an event runs only once, use the unbind method
				$(document).unbind().on('submit', '#frm-start-thread', function(evt){
					// evt.preventDefault();
					var thread_heading 			= $('#thread_heading').val();
					var language_tag 			= $('#language_tag').val();
					var thread_content			= tinyMCE.get('textarea_thread').getContent();

					if(thread_content!='' && language_tag!=''){
						evt.preventDefault();
						$.ajax({
							url: 'inc/insert_thread',
							type: 'POST',
							data: "thread_heading="+thread_heading+"&language_tag="+language_tag+"&thread_content="+thread_content,
							success:function(response, status, http){
								if(response[0]){
									$('#show-success-modal').click();
									$('#btn-submit-add-thread').hide(500);
									$('#success-notification-panel').html("250 XP awarded for starting a thread");
									$('#success-notification-panel').show(1000);
									$('#success-notification-panel').delay(5000).hide(1000);
									$('#btn-reset-add-thread').click();
									setTimeout(function(){ location.reload(); },2000);
								} else {
									$('#show-failure-modal').click();
								}
							}
						});
					} else {
						alert("The thread content must not be empty!");
						evt.preventDefault();
					}
					evt.preventDefault();
				});

			$(document).on('submit', '#frm-change-pic', function(event) {
					event.preventDefault();
					/* Act on the event */
					var formdata 		= new FormData(document.querySelector("form"));
					formdata.append('user_id',  <?php echo ''+$user_id; ?>);
					formdata.append('user_pic',  $('#user_pic').val());
					$.ajax({
						url:"inc/update_user_pic.php",
						data: formdata,
						dataType: "json",
						type:"POST",
						contentType: false,
						processData: false,
						success: function(response, status, http){
							$.each(response, function(index, item){
								if(response[0]){
									$('#h1-success-modal').html("User pic successfully updated");
									$('#show-success-modal').click();
									setTimeout(function(){ location.reload(); },2000);
								} else {
									$('#h1-failure-modal').html("Could not update user pic");
									$('#show-failure-modal').click();
								}
							});
						}
					});
				});

			$(document).on('submit', '#frmsearch', function(event) {
				event.preventDefault();
				var formdata 		= $(this).serialize();
				$.ajax({
					url: 'lib/show-search-results.php',
					type: 'POST',
					dataType: 'html',
					data: formdata,
					success: function(response, status, http){
						$('#backtosearch').removeClass('hidden');
						$('#showsearchresults').html(response);
						$('#frmsearch').hide('slow', function(){
							$('#frmsearch').html("");
						});
					}
				});
			});

			$(document).on('click', '.post_heading', function(event) {
				var thread_id 		= $(this).val();
				$.ajax({
					url: 'lib/dashboard-subcontent-showthreadcontent.php',
					type: 'POST',
					data: "thread_id="+thread_id,
					success: function(response, status, http){
						$('#showsearchresults').html(response);
					}
				});
			});

			$(document).on('input', '#ally_war_participation_frequency', function(event) {
				// event.preventDefault();
				$freq 		= $(this).val();
				$html 		= "";
				if($freq==1) {
					$html 	= "Monthly";
				} else if ($freq==2) {
					$html 	= "Weekly";
				} else {
					$html 	= "Actively";
				}
				$('#war_freq_range').html($html);
			});

			$(document).on('submit', '#frm-add-ally', function(event) {
				event.preventDefault();
				var formdata 		= $(this).serialize();
				$.ajax({
					url: 'inc/update_ally.php',
					type: 'POST',
					data: formdata+"&mode=1",
					success:function(response, status, http){
						if(response[0]){
							$('#show-success-modal').click();
							$('#btn-submit-add-thread').hide(500);
							$('#success-notification-panel').html("750 XP awarded for forming an ally");
							$('#success-notification-panel').show(1000);
							$('#success-notification-panel').delay(5000).hide(1000);
							$('#btn-reset-add-thread').click();
							$('#btn-add-ally').remove();
						} else {
							$('#show-failure-modal').click();
						}
					}
				});			
			});

			$(document).on('input', '#war_participation_frequency', function(event) {
				// event.preventDefault();
				$freq 		= $(this).val();
				$html 		= "";
				if($freq==1) {
					$html 	= "Monthly";
				} else if ($freq==2) {
					$html 	= "Weekly";
				} else {
					$html 	= "Actively";
				}
				$('#preview_freq').html($html);
			});


		});

	</script>