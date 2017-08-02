<?php
	if(!empty($_POST)){
		require_once ("../../classes/init.php");
		$db 		= new Database();
		$imgid 		= $_POST['imgid'];
		$images	= $db->fetchContentById(0, 'img_id', $imgid, 'images');
		$image_attr 	= mysqli_fetch_array($images);
		$image 	= $image_attr['img_data'];
	}
?>
<img class="img-responsive" src="data:image/gif;base64,<?php echo base64_encode($image); ?>">