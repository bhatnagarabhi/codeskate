<?php
	if(!empty($_POST)){
		require_once ("../../classes/init.php");
		//print_r($_POST);
		if(!empty($_POST['section_number'])){
			$db 		= new Database();
			$section 	= $_POST['section_number'];
			$arr  		= array();
			if($section==1){
				$bg 		= $_POST['background-sec-1'];
				if($_POST['check-bg-sec-1']==false){
					$bg  	= 0;
				}
				$fg 		= $_POST['fg-sec-1'];
				$heading	= $_POST['heading-sec-1'];
				$subheading 	= $_POST['sub-heading-sec-1'];
				$glyph1 	= $_POST['link-glyph-1-sec-1'];
				$glyphdesc1 	= $_POST['icon-1-desc-sec-1'];
				$glyph2 	= $_POST['link-glyph-2-sec-1'];
				$glyphdesc2 	= $_POST['icon-2-desc-sec-1'];
				$res_glyph1 	= $db->fetchContentById(0, 'glyph_name', $glyph1, 'glyphs');
				$row_glyph1	= mysqli_fetch_array($res_glyph1);
				$glyph1_id 	= $row_glyph1[0];
				$res_glyph2 	= $db->fetchContentById(0, 'glyph_name', $glyph2, 'glyphs');
				$row_glyph2	= mysqli_fetch_array($res_glyph2);
				$glyph2_id 	= $row_glyph2[0];
				if (!empty($fg)&&!empty($heading)&& !empty($subheading)&& !empty($glyph1) && !empty($glyphdesc1) && !empty($glyph2) && !empty($glyphdesc2)) {
					$res 		= $db->updateContent(8, 'cms_index_1','section_id', 4,  'background_id', $bg, 'foreground', $fg, 'heading', $heading, 'sub_heading', $subheading, 'left_icon_1_id', $glyph1_id, 'left_icon_1_content', $glyphdesc1,'left_icon_2_id', $glyph2_id, 'left_icon_2_content', $glyphdesc2);
				}
				if($res){
					array_push($arr, true);
					echo json_encode($arr);
				} else {
					array_push($arr, false);
					echo json_encode($arr);
				}
			} else if($section==2){
				$bg 		= $_POST['sec-2-img-selector'];
				if($_POST['check-bg-sec-2']==false){
					$bg 	= 0;
				}
				$fg 		= $_POST['fg-sec-2'];
				$heading 	= $_POST['heading-sec-2'];
				$subheading 	= $_POST['sub-heading-sec-2'];
				$glyph 		= $_POST['link_glyph'];
				$description 	= $_POST['description-sec-2'];
				$res_glyph 	= $db->fetchContentById(0, 'glyph_name', $glyph, 'glyphs');
				$row_glyph	= mysqli_fetch_array($res_glyph);
				$glyph_id 	= $row_glyph[0];
				if (!empty($fg)&&!empty($heading)&& !empty($subheading)&& !empty($glyph_id) && !empty($description) ) {
					$res 		= $db->updateContent(6, 'cms_index_2','section_id', 1,  'background_id', $bg, 'foreground', $fg, 'heading', $heading, 'sub_heading', $subheading, 'icon_id', $glyph_id, 'description', $description);
				}
				if($res){
					array_push($arr, true);
					echo json_encode($arr);
				} else {
					array_push($arr, false);
					echo json_encode($arr);
				}
			}else if($section==3){
				$bg 		= $_POST['sec-3-img-selector'];
				if($_POST['check-bg-sec-3']==false){
					$bg 	= 0;
				}
				$fg 		= $_POST['fg-sec-3'];
				$heading 	= $_POST['heading-sec-3'];
				$subheading 	= $_POST['sub-heading-sec-3'];
				$image 	= $_POST['sec-3-icon-img-selector'];
				$subheading1  = $_POST['sub-heading-1-sec-3'];
				if (!empty($fg)&&!empty($heading)&& !empty($subheading)&& !empty($image) && !empty($subheading1) ) {
					$res 		= $db->updateContent(6, 'cms_index_3','section_id', 1,  'background_id', $bg, 'foreground', $fg, 'heading', $heading, 'sub_heading_1', $subheading, 'image_id', $image, 'sub_heading_2', $subheading1);
				}
				if($res){
					array_push($arr, true);
					echo json_encode($arr);
				} else {
					array_push($arr, false);
					echo json_encode($arr);
				}
			}else if($section==4){
				$bg 		= $_POST['sec-4-img-selector'];
				if($_POST['check-bg-sec-4']==false){
					$bg 	= 0;
				}
				$fg 		= $_POST['fg-sec-4'];
				$heading 	= $_POST['heading-sec-4'];
				$subheading 	= $_POST['sub-heading-sec-4'];
				$icon1 		= $_POST['icon-1-sec-4'];
				$icondesc1 	= $_POST['icon-1-description-sec-4'];
				$icon2 		= $_POST['icon-2-sec-4'];
				$icondesc2 	= $_POST['icon-2-description-sec-4'];
				$res_glyph1 	= $db->fetchContentById(0, 'glyph_name', $icon1, 'glyphs');
				$row_glyph1	= mysqli_fetch_array($res_glyph1);
				$glyph1_id 	= $row_glyph1[0];
				$res_glyph2 	= $db->fetchContentById(0, 'glyph_name', $icon2, 'glyphs');
				$row_glyph2	= mysqli_fetch_array($res_glyph2);
				$glyph2_id 	= $row_glyph2[0];
				if (!empty($fg)&&!empty($heading)&& !empty($subheading)&& !empty($icon1) && !empty($subheading)&&!empty($icondesc1)&&!empty($icon2)&&!empty($icondesc2) ) {
					$res 		= $db->updateContent(8, 'cms_index_4','section_id', 1,  'background_id', $bg, 'foreground', $fg, 'heading', $heading, 'sub_heading', $subheading, 'left_icon_1_id', $glyph1_id, 'left_icon_1_content', $icondesc1, 'left_icon_2_content', $icondesc2 , 'left_icon_2_id', $glyph2_id);
				}
				if($res){
					array_push($arr, true);
					echo json_encode($arr);
				} else {
					array_push($arr, false);
					echo json_encode($arr);
				}
			}else if($section==5){
				$bg 		= $_POST['sec-5-img-selector'];
				if($_POST['check-bg-sec-5']==false){
					$bg 	= 0;
				}
				$fg 		= $_POST['fg-sec-5'];
				$heading 	= $_POST['heading-sec-5'];
				$subheading1 	= $_POST['sub-heading-1-sec-5'];
				$content1	= $_POST['content-1-sec-5'];
				$subheading2 	= $_POST['sub-heading-2-sec-5'];
				$content2	= $_POST['content-2-sec-5'];
				$image 	= $_POST['sec-5-icon-img-selector'];
				if (!empty($fg)&&!empty($heading)&& !empty($image) && !empty($subheading1) && !empty($subheading2) && !empty($content1) && !empty($content2) ) {
					$res 		= $db->updateContent(8, 'cms_index_5','section_id', 1,  'background_id', $bg, 'foreground', $fg, 'heading', $heading, 'sub_heading_1', $subheading1, 'image_id', $image, 'sub_heading_2', $subheading2, 'sub_heading_content_1', $content1, 'sub_heading_content_2', $content2);
				}
				if($res){
					array_push($arr, true);
					echo json_encode($arr);
				} else {
					array_push($arr, false);
					echo json_encode($arr);
				}
			}
		}
	}