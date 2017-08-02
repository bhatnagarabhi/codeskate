<?php
	$db 			= new Database();
	$tbl 			= "ques_".$language;

	// Get a random question from the respective language table
	$ques_res 		= $db->getRandom($tbl);

	$ques_arr 		= mysqli_fetch_array($ques_res);

?>
<style type="text/css">
	.ace_editor {
		min-height: 300px;
	}
</style>
<section id="quiz-panel">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="theme-fg">The <span id="select_lang"><?php echo $language;  ?></span> starters challenge.</h1><hr>
				<form method="post" style="min-height: 210px;" action="inc/check_reg_ans.php" id="frm-starter-ques">
					<?php $ans = htmlspecialchars($ques_join_ans_arr['ans']); ?>
					<h3 class="black-fg"><?php echo $ques_arr['ques']; ?></h3>
					<div name="starter_ques" id="editor" style="max-height: 350px;"><?php echo htmlspecialchars($ques_arr['ques_content']); ?></div><br>
					<input type="hidden" name="ques_id" value="<?php echo $ques_arr['ques_id']; ?>">
					<input type="hidden" name="language" value="<?php echo $language; ?>">
					<button id="check-code" type="button" class="btn btn-danger"><i class="fa fa-check"></i> Submit</button>
				</form>
				<form method="post" action="register" id="complete_the_evaluation" class="hidden">
					<input type="hidden" name="isevaluated" value="false" id="isevaluated">	
				</form>
			</div>
		</div>
	</div>
</section>


<!-- Success modal -->
<center><div id="modal-success" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-success" id="alert-success" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">Great! You're now ready to signup</a></h4>
      </div>
</div>

<!-- Failure modal -->
<div id="modal-failure" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-danger" id="alert-danger" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">Oops! There seems to be a problem with your code.</h4>
      </div>
</div></center>


<button class="hidden btn btn-success" id="show-success-modal" data-target="#modal-success" data-toggle="modal">Show</button>
<button class="hidden btn btn-danger" id="show-failure-modal" data-target="#modal-failure" data-toggle="modal">Show</button>

	<script src="code editor/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="js/code-editor-config.js"></script>
	<script type="text/javascript">
		var editor = ace.edit("editor");
		var lang = "<?php echo $language; ?>";
		editor.getSession().setMode("ace/mode/<?php echo $language; ?>");
		editor.getSession().setUseWorker(false);
		document.getElementById('editor').style.fontSize = "14px";
		document.getElementById('editor').style.fontWeight = "";


		$(document).ready(function() {
			$('#check-code').click(function(event) {
				var user_ans 	= editor.getSession().getValue();
				var formdata 	= $('#frm-starter-ques').serialize();
				$.ajax({
					url: "inc/check_reg_ans.php",
					data: formdata+"&user_ans="+user_ans,
					type: "POST",
					dataType: "json",
					success: function(response, status, http){
						if(response[0]){
							$('#show-success-modal').click();
							var isevaluated 	= true;
							$('#isevaluated').val(isevaluated);
							$('#complete_the_evaluation').submit();
						} else {
							$('#show-failure-modal').click();
						}
					}
				});
			});
		});


	</script>
