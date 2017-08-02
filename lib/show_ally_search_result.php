<?php

	require_once ("../classes/init.php");

	// Check if the post data is empty
	if(!empty($_POST)) {
		
		$db 			= new Database();
		
		$searchterm 		= strtoupper($_POST['searchterm']);
		$is_tag 		= $_POST['is_tag'];
		$query 		= "SELECT * FROM allies where ";

		if($is_tag=='true'){
			$query.= " ally_tag='#".$searchterm."' AND ally_id!=0";
		} else {
			$query.= " ally_name LIKE '%".$searchterm."%' AND ally_id!=0";
		}
		$res		= $db::executeQuery($query);		
	}
?>
<div class="table-responsive" style="margin-bottom: 30px;">
	<h3 class="black-fg">Search results</h3><hr>
	<table class="table-hover font-bold table-striped" style="font-size: 17px;" width="100%">
		<th>S.no</th>
		<th>Ally name</th>
		<th></th>
		<?php 
			$i=1; 
			while ($row 	= mysqli_fetch_array($res)) :
		?>
				<tr>
					<td width="15%" style="padding:15px;"><?php echo $i++; ?></td>
					<td width="65%"><?php echo $row['ally_name'] ?></td>
					<td><button class="btn btn-primary btn-req-ally" value="<?php echo$row['ally_leader_id']; ?>"><i class="fa fa-check"></i> Request</button></td>
				</tr>
		<?php endwhile; ?>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-req-ally').click(function(event) {
			var req_id = $(this).val();
			$.ajax({
				url: 'inc/send-ally-request',
				type: 'POST',
				dataType : 'json',
				data: {req_id: req_id},
				success : function(response, status, http){
					if(response[0]) {
						alert('Request sent');
						$(this).addClass('hidden');
					} else {
						alert('Request already pending');
					}
				}
			});
		});
	});
</script>