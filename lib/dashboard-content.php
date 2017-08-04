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

		<div style="background-color: white;" id="widget-wrapper">
			<!-- TOTAL THREADS WIDGET
			================================= --> 
			<div class="col-sm-4 text-center dashboard-widget light-shadow" style="background-color: #30aadd; padding: 20px; border:5px solid #fff;">
				
				<div class="row fg-white">
					<div class="col-sm-2 medium-font fg-white" >
						<i class="fa fa-calculator"></i>
					</div><!-- col-sm-2 -->
					<div class="col-sm-10 text-right" style="padding-top: 12px;">
						<span style="font-size: 32px; "><?php echo $total_user_posts; ?></span> Total threads
					</div><!-- col-sm-8 -->
				</div><!-- row --><hr style="margin: 0px auto 5px auto;">
				<footer class="text-right">
					<ul style="list-style-type: none; padding: 0px;" class="fg-white">
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
						<div class="col-sm-10 text-right" style="padding-top: 12px;">
							<span style="font-size: 32px; "><?php echo $total_com_posts; ?></span> Total comments
						</div><!-- col-sm-8 -->
				</div><!-- row --><hr style="margin: 0px auto 5px auto;">
				<footer class="text-right">
					<ul style="list-style-type: none;  padding: 0px;" class="fg-white">
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

		<?php 
			$user_pic 		= $user_arr['user_pic'];
		?>
		
		<!-- Settings content here -->
		<div class="bg-white" id="search" style="margin-top: -30px; padding:20px;">
			<h3 class="black-fg font-bold">Edit your profile</h3><hr>
			
			<div class="row">
				</div></center>
				<div class="col-sm-5">
					<form name="" id="frm-change-pic" method="post">
						<?php if(!empty($user_pic)) { ?>
							<center><img id="user_pic_preview" height="250" width="250" src="data:image/png;base64,<?php echo base64_encode($user_pic); ?>" class="img-responsive"></center><br> 
						<?php } else { ?>
							<center><img id="user_pic_preview" height="250" width="250" src="images/ben.png" class="img-responsive"></center><br> 
						<?php } ?>
						<center>
							<input type="file" accept="image/*" required="required" name="user_pic" class="form-control font-bold hidden" id="user_pic">
							<button for="user_pic" id="btn_user_pic" type="button" class="btn btn-primary btn-lg font-bold"><i class="fa fa-refresh"></i> Change</button>
							<button class="btn btn-lg font-bold btn-success" type="submit" id="btn-change-pic"><i class="fa fa-check"></i> Confirm</button>
						</center>
					</form>
				</div><!-- col -->
				
			</div><!-- row -->
		</div>

		<script type="text/javascript">
			$(document).ready(function(){

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

	<?php } else if($page_id == 4) { ?>
		<?php
			// Getting all the posts
			$ob_posts 		= new Posts();
			$posts_res 		= $ob_posts->getAllPosts();

			$num_rec_per_page	= 10;
			$num_content	= mysqli_num_rows($posts_res);
			$num_pages 		= ceil($num_content/$num_rec_per_page);

			// Fetching out languages
			$lang_res	 	= $db->fetchAllContent(0, 'dev_glyphs');
		?>
		<!-- Blog content here -->
		<div class="bg-white" id="blog">
			<h2 class="black-fg">Recent threads</h2><hr>
			<div class="col-sm-12">
			
				 <?php for ($i=1; $i <=$num_pages ; $i++) {  ?>
					<button class="btn-pagination btn btn-primary" value="<?php echo $i; ?>"><?php echo $i; ?></button>
				<?php } ?><br><br>

				<div id="showallthreads">
					<?php
						// Load a page (dashboard-subcontent-showallthreads) to show all the threads posted by all the users
						require_once "dashboard-subcontent-showallthreads.php";
					 ?>
				</div><!-- showallthreads -->

				<script type="text/javascript">
					$.ajax({
						url: "lib/dashboard-subcontent-showallthreads.php",
						data: "page=",
						type: "POST",
						dataType: "html",
						success: function(response, status, http){
							$('#showallthreads').html(response);
						}
					});

					$('.btn-pagination').click(function(event) {
						var page 		= $(this).val();
						var language_id	= $('#filter_language').val();
						$.ajax({
							url: "lib/dashboard-subcontent-showallthreads.php",
							data: "page="+page+"&language_id="+language_id,
							type: "POST",
							dataType: "html",
							success: function(response, status, http){
								$('#showallthreads').html(response);
							}
						});
					});

					$('#filter_language').change(function(event) {
						var language_id	= $('#filter_language').val();
						$.ajax({
							url: "lib/dashboard-subcontent-showallthreads.php",
							data: "language_id="+language_id,
							type: "POST",
							dataType: "html",
							success: function(response, status, http){
								$('#showallthreads').html(response);
							}
						});
					});

				</script>

			</div><!-- col-sm-12 -->
		</div><!-- bg-white -->

	<?php } else if($page_id==5) { ?>
		<!-- Start a thread -->
		<?php
			// Fetching out languages
			$user_res 	= $db->fetchAllContent(0, 'dev_glyphs');
		?>
		
		
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
		<!-- <script type="text/javascript">
			tinymce.init({
				selector : "#textarea_thread",
				statusbar: false,
				toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code restoredraft',
				plugins: "image imagetools autosave",
				browser_spellcheck: true,
				contextmenu: false
			});
		</script> -->

		<?php } else {	$next_thread_date 	= date("dS M Y h:i:s", $time_until_last+86400); ?>
				<div class="jumbotron" style="margin-top: -50px">
					<h2 class="black-fg">You can't start a new thread right now. Next thread on : <?php echo $next_thread_date; ?></h2>
				</div>
		<?php	} ?>


	<?php } else if($page_id==6){ ?>
		<!-- WARS 
		 =============================== -->
		 	<div class="col-sm-12 text-center" style="min-height: 300px;">
		 		<center><img src="images/crystal-badge.png" height="120px" width="120px" title="Coder's badge of honor" class="img-responsive"><h2 class="theme-fg">Codeskate<sup>&copy;</sup> wars</h2><hr></center>
		 		<div class="col-sm-12" style="text-align: justify;">
		 			<p style="font-size: 16px" class="arial-font">Codeskate<sup>&copy;</sup> wars are the best way to show your true skills. Outstand your opponents to win the war and get a <span class="theme-fg">XP boost</span>. Upon winning the war, the winner team/participant gets a <span class="theme-fg">coder's badge of honor</span>. You can participate in the wars of your language of choice. You can proceed to the wars by clicking the button below -</p>
		 			<center><a href="wars"><button class="btn btn-danger btn-lg font-bold"><i class="fa fa-sign-in"></i> Proceed to wars</button></a></center>
		 		</div><!-- col-sm-4 -->
		 	</div><!-- col-sm-12 -->


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
					var thread_content			= $('#textarea_thread').val();

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

		});

	</script>