
		<div class="col-sm-12" id="thread_full">
			<?php require_once "dashboard-subcontent-refreshthread.php"; ?>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {

				var thread_id 		= <?php echo $thread_id; ?>;
				var comments 	= $('#comment-generator').html();

				// Inititalizing the comment generator
				$.ajax({
					url: 'lib/dashboard-subcontent-comment-generator.php',
					type: 'POST',
					dataType: 'html',
					data: 'thread_id='+thread_id,
					success:function(htmlresponse, status, http){
						$('#comment-generator').html();
						$('#comment-generator').html(comments+htmlresponse);
					}
				});


				$(document).unbind().on('submit', '#frm-addcomment', function(evt) {
					evt.preventDefault();
					var ans_content 	= $('#textarea_comment').val();
				
					if(ans_content!=''){
						$.ajax({
							url: 'inc/update_comments.php',
							type: 'POST',
							data: 'ans_content='+ans_content+'&thread_id='+thread_id+'&mode=1',
							success:function(response, status, http){
								if(response[0]){
									$('#success-notification-panel').html("100 XP awarded for responding to a thread");
									$('#success-notification-panel').show(600);
									$('#btn-add-comment').hide(400);
									$('#success-notification-panel').delay(5000).hide(1000);
									var comments 	= $('#comment-generator').html();
									setTimeout(function() {
										$.ajax({
											url: 'lib/dashboard-subcontent-comment-generator.php',
											type: 'POST',
											dataType: 'html',
											data: 'thread_id='+thread_id,
											success:function(htmlresponse, status, http){
												$('#comment-generator').html(htmlresponse);
											}
										});
									},2000);
								} else {

								}
							}
						});
					} else {
						alert("The answer field cannot be empty !");
					}				
				});
			});
		</script>