<?php
	require_once ("../../classes/init.php");

	
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
		$db	= new Database();
		$res	= $db->fetchAllContent(0, 'images');
		$num_rec_per_page	= 10;
		$upper_limit		= ($num_rec_per_page * $current_page)-$num_rec_per_page;
		$query			= "SELECT * FROM images ORDER BY  img_id DESC LIMIT {$upper_limit}, {$num_rec_per_page} ";
		$result			= mysqli_query(Database::$mysqli, $query);
		while ($content 	= mysqli_fetch_array($result)) {
			$id 		= $content['img_id'];
			$title		= $content['img_title'];
			$alt 		= $content['img_alt'];
			echo '<img class="img-paginated-edit" title="Click this image to edit or delete" data-toggle="modal" data-target="#myModal" style="cursor:pointer; margin: 10px;" src="data:image/gif;base64, '.base64_encode($content['img_data']).'" height="200" width="200">';
			echo '<input type="text" value="'.$id.'" class="hidden" name="img-id">';
			echo '<input type="text" value="'.$title.'"  class="hidden" name="img-title">';
			echo '<input type="text" value="'.$alt.'"  class="hidden" name="img-alt">';
		}
	?>
</body>
</html>