<?php

	require_once ("../../classes/init.php");

	if(!empty($_POST)){
		$linkname	= $_POST['linkname'];
		$linkhref	= $_POST['linkhref'];
		$linktitle	= $_POST['linktitle'];
		$linkglyph	= $_POST['linkglyph'];
		if(!empty($linkname) && !empty($linkhref) && !empty($linktitle) && !empty($linkglyph)){
			$db = new Database();
			$pr = $db->fetchContentById(0, "glyph_name", $linkglyph, "glyphs");
			$row = mysqli_fetch_array($pr);
			$glyphid = $row[0];
			$res = $db->addContent(4, 'navbar_links', 'link_name', $linkname, 'link_href', $linkhref, 'link_title', $linktitle, 'link_glyph_id', $glyphid);
			$arr = array();
			if($res){
				array_push($arr, true);
			} else {
				array_push($arr, false);
			}
		}
		echo json_encode($arr);
	}

?>