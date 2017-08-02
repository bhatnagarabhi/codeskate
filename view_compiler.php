<?php
	require_once "classes/init.php";
	 require_once "lib/header.php";
 ?>
<div id="showresponse" style="margin-top:200px;" class="black-fg">
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url: 'check_compiler.php',
				type: 'POST',
				dataType: 'json',
				data: "",
				success: function (response, status, http){
					$.getJSON('check_compiler.php', function (data) {
					    $('#showresponse').html(data['result']['stdout']);
					  });
				}
			});
			
		});
	</script>
</div>