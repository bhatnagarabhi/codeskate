<?php 
	
	// Get the contents using the AJAX call for this page

	require_once("../classes/init.php");
	
	// Object instantiation
	$db 			= new Database();
	$session 		= new Session();
	$user_id 		= $session->getSession('user_id');

	// Notification content here
	$query			=  "SELECT * FROM notifications WHERE user_id={$user_id} ORDER BY notification_id DESC";
	$res 			= $db::executeQuery($query);

	$query			=  "SELECT * FROM notifications WHERE user_id={$user_id} AND is_read=0 ORDER BY notification_id DESC";
	$res1 			= $db::executeQuery($query);
	$num_new 		= mysqli_num_rows($res1);

?>
<div class="jumbotron" style="padding: 30px;">
	<h3 class="black-fg">You have <span class="font-bold" style="font-size: 35px;"><?php echo $num_new; ?></span> unread notifications <button id="btn-mark-read" class="btn pull-right font-bold bg-theme fg-white" style="border-radius: 100px; padding: 10px 15px; margin-top: -10px;"><i class="fa fa-check" style="margin-right: 10px;"></i> Mark all as read</button></h3>
	<hr>
	<div id="unread-notifications-generator">
		
		<?php while($row 	= mysqli_fetch_array($res)) : ?>
			<?php if($row['is_read']==0) { ?>
				<div class="well bg-theme" style="padding: 10px; border-radius: 3px; margin: 5px;"><h5 class="fg-white"><?php echo $row['notification_content']; ?><span class="pull-right arial-font"  style="font-weight: bold; cursor: pointer;"><ul style="list-style-type: none;"><li class="unread-close" value="<?php echo $row['notification_id']; ?>">X</li></ul></span> <span class="pull-right">15th March 2017 @ 12:37</span></h5></div><br>
			<?php }
			 endwhile;
		 ?>
	
	</div><!-- unread-notifications-generator -->

	<h3 class="black-fg">View previous notifications</h3>
	<hr>
	<div id="read-notifications-generator">
		
		<?php 
			// Notification content here
			$query			=  "SELECT * FROM notifications WHERE user_id={$user_id} ORDER BY notification_id DESC LIMIT  30";
			$res 			= $db::executeQuery($query);
			while($row 	= mysqli_fetch_array($res)) : 
				 if($row['is_read']==1) { ?>
					<div class="well bg-theme" style="padding: 10px; border-radius: 3px; margin: 5px; background-color: #555;"><h5 class="fg-white"><?php echo $row['notification_content']; ?><span class="pull-right font-bold">15th March 2017 @ 12:37</span></h5></div>
			  <?php }
			 endwhile;
		 ?>
	
	</div><!-- read-notifications-generator -->

</div><!-- jumbotron -->


<script language="javascripnt">
	// Mark this notification unread
	$('.unread-close').click(function(event) {
		var notification_id = $(this).val();
		$.ajax({
			url: 'inc/update_notifications.php',
			type: 'POST',
			dataType: 'json',
			data: 'clear='+notification_id,
			success:function(response, status, http){
				if(response[0]){
					$.ajax({
						url: 'lib/notification-generator.php',
						type: 'POST',
						dataType: 'html',
						data: "",
						success:function(response, status, http) {
							$("#notification-generator-div").html("");
							$("#notification-generator-div").html(response);
						}
					});
				}
			}
		});
	});

	// Mark all as read
	$('#btn-mark-read').click(function(event) {
		$.ajax({
			url: 'inc/update_notifications.php',
			type: 'POST',
			dataType: 'json',
			data: 'clear=all',
			success:function(response, status, http){
				if(response[0]){
					$.ajax({
						url: 'lib/notification-generator.php',
						type: 'POST',
						dataType: 'html',
						data: "",
						success:function(response, status, http) {
							$("#notification-generator-div").html("");
							$("#notification-generator-div").html(response);
						}
					});
				}
			}
		});					
	});
</script>