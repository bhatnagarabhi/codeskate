$(document).ready(function (){
	
	refreshElements();

	$('#sec-1-img-selector').change();
	$('#sec-2-img-selector').change();
	$('#sec-3-img-selector').change();
	$('#sec-3-icon-img-selector').change();
	$('#sec-4-img-selector').change();
	$('#sec-5-img-selector').change();
	$('#sec-5-icon-img-selector').change();
	$('#icon-1-sec-4').change();
	$('#icon-2-sec-4').change();

	var clickedelement, scroll, bgid;

	function refreshElements(){
		// Preview image before change
		$('#sec-1-img-selector').change(function(){
			bgid 	= $(this).val();
			$.ajax({
				url: 'inc/preview_image.php',
				type: 'POST',
				dataType: 'html',
				data: 'imgid='+bgid,
				success:function(response, status, http){
					$('#sec-1-img-preview').html(response);
				}
			})		
		});

		$('#sec-2-img-selector').change(function(){
			bgid 	= $(this).val();
			$.ajax({
				url: 'inc/preview_image.php',
				type: 'POST',
				dataType: 'html',
				data: 'imgid='+bgid,
				success:function(response, status, http){
					$('#sec-2-img-preview').html(response);
				}
			})		
		});

		$('#sec-3-img-selector').change(function(){
			bgid 	= $(this).val();
			$.ajax({
				url: 'inc/preview_image.php',
				type: 'POST',
				dataType: 'html',
				data: 'imgid='+bgid,
				success:function(response, status, http){
					$('#sec-3-img-preview').html(response);
				}
			})		
		});

		$('#sec-3-icon-img-selector').change(function(){
			bgid 	= $(this).val();
			$.ajax({
				url: 'inc/preview_image.php',
				type: 'POST',
				dataType: 'html',
				data: 'imgid='+bgid,
				success:function(response, status, http){
					$('#sec-3-icon-img-preview').html(response);
				}
			})		
		});

		$('#sec-4-img-selector').change(function(){
			bgid 	= $(this).val();
			$.ajax({
				url: 'inc/preview_image.php',
				type: 'POST',
				dataType: 'html',
				data: 'imgid='+bgid,
				success:function(response, status, http){
					$('#sec-4-img-preview').html(response);
				}
			})		
		});

		$('#sec-5-img-selector').change(function(){
			bgid 	= $(this).val();
			$.ajax({
				url: 'inc/preview_image.php',
				type: 'POST',
				dataType: 'html',
				data: 'imgid='+bgid,
				success:function(response, status, http){
					$('#sec-5-img-preview').html(response);
				}
			})		
		});

		$('#sec-5-icon-img-selector').change(function(){
			bgid 	= $(this).val();
			$.ajax({
				url: 'inc/preview_image.php',
				type: 'POST',
				dataType: 'html',
				data: 'imgid='+bgid,
				success:function(response, status, http){
					$('#sec-5-icon-img-preview').html(response);
				}
			})		
		});

		
			// Icon 1 - section 1
			var lefticonsec1	= $('#left-icon-1-sec-1').val();
			var preview1 		= "fa fa-"+lefticonsec1;
			$('#preview-left-icon-1-sec-1').addClass(preview1);

			// Icon 2 - section 1
			var lefticonsec1	= $('#left-icon-2-sec-1').val();
			var preview2 		= "fa fa-"+lefticonsec1;
			$('#preview-left-icon-2-sec-1').addClass(preview2);

			// Icon - section 2
			var iconsec2		= $('#icon-sec-2').val();
			var preview2 		= "fa fa-"+iconsec2;
			$('#preview-icon-sec-2').addClass(preview2);

			// Icon 1 - section 4
			var lefticonsec4	= $('#icon-1-sec-4').val();
			var preview1 		= "fa fa-"+lefticonsec4;
			$('#preview-icon-1-sec-4').addClass(preview1);

			// Icon 2 - section 4
			var lefticonsec4	= $('#icon-2-sec-4').val();
			var preview1		= "fa fa-"+lefticonsec4;
			$('#preview-icon-2-sec-4').addClass(preview1);

	}

	$('.preview').click(function(event) {
		scroll 	= $('#previewframe').contents().scrollTop();
		var src 		= $('#previewframe').attr('src');
		$('#previewframe').attr('src', src);
	});

	$('#previewframe').load(function() {
		$(this).contents().scrollTop(scroll);
	});
	
	$('#left-icon-1-sec-1').change(function (){
		$(this).next('i').removeClass();
		var cls = "fa fa-"+$(this).val();
		$(this).next('i').addClass(cls+"");
	});

	$('#left-icon-2-sec-1').change(function (){
		$(this).next('i').removeClass();
		var cls = "fa fa-"+$(this).val();
		$(this).next('i').addClass(cls+"");
	});

	$('#icon-sec-2').change(function (){
		$(this).next('i').removeClass();
		var cls = "fa fa-"+$(this).val();
		$(this).next('i').addClass(cls+"");
	});

	$('#icon-1-sec-4').change(function (){
		$(this).next('i').removeClass();
		var cls = "fa fa-"+$(this).val();
		$(this).next('i').addClass(cls+"");
	});

	$('#icon-2-sec-4').change(function (){
		$(this).next('i').removeClass();
		var cls = "fa fa-"+$(this).val();
		$(this).next('i').addClass(cls+"");
	});

	$('.confirmbtn').click(function(event) {
		var sec 		= $(this).val();
		$.ajax({
			url: 'inc/cms_update_index.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).parents('form').serialize()+"&section_number="+sec,
			success: function(response, status, http){
				if (response[0]) {
					$('#show-success-modal').click();
					scroll 	= $('#previewframe').contents().scrollTop();
					var src 		= $('#previewframe').attr('src');
					$('#previewframe').attr('src', src);
				} else {
					$('#show-failure-modal').click();
				}
			}
		});
	});

});