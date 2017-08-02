<?php

	require_once ("../../classes/init.php");

	if(!empty($_POST)){
		$linkid 		= $_POST['linkid'];
		$linkname	= $_POST['linkname'];
		$linkhref	= $_POST['linkhref'];
		$linktitle	= $_POST['linktitle'];
		$linkglyph	= $_POST['linkglyph'];
		$db = new Database();
		$pr = $db->fetchContentById(0, "glyph_name", $linkglyph, "glyphs");
		$row = mysqli_fetch_array($pr);
		$glyphid = $row[0];
		$res = $db->updateContent(4, "navbar_links", "link_id", $linkid, "link_name", $linkname , "link_href", $linkhref , "link_title", $linktitle  ,"link_glyph_id", $glyphid);
		$arr = array();
		if($res){
			array_push($arr, true);
		} else {
			array_push($arr, false);
		}
		echo json_encode($arr);
	}

?>