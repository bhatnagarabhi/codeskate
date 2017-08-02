$(document).ready(function (){

	$.ajax({
		url: "lib/showpaginated-img.php",
		data: "page=",
		type: "POST",
		dataType: "html",
		success: function(response, status, http){
			$('#img-gallery').html(response);
		}
	});

	$('.btn-pagination').click(function(event) {
		var page 	= $(this).val();
		$.ajax({
			url: "lib/showpaginated-img.php",
			data: "page="+page,
			type: "POST",
			dataType: "html",
			success: function(response, status, http){
				$('#img-gallery').html(response);
			}
		});
	});

	$.ajaxSetup({
		cache: false
	});

	var linkid, linkname, linkhref, linktitle, linkglyph;

	var row, prevglyph, selectedglyph;

	refreshelements();

	$('.close-div').click(function(){
		$('.glyph-pallette').slideUp(200);
	});

	function refreshelements(){

		$('.confirmbtn').each(function (){
			var row = $(this).parents('tr');
			var cls = "fa fa-"+row.find('select[name="link_glyph"]').val();
			row.find('i[name="preview_glyph"]').addClass(cls+"");
		});

		$('.addbtn').each(function (){
			var row = $(this).parents('tr');
			var cls = "fa fa-"+row.find('select[name="link_glyph"]').val();
			row.find('i[name="preview_glyph"]').addClass(cls+"");
		});

		$('.deletebtn').each(function (){
			var row = $(this).parents('tr');
			var cls = "fa fa-"+row.find('select[name="link_glyph"]').val();
			row.find('i[name="preview_glyph"]').addClass(cls+"");
		});
	
	

	$('.dropglyph').change(function (){
		$('.confirmbtn').each(function (){
			var rw = $(this).parents('tr');
			rw.find('i[name="preview_glyph"]').removeClass();
			var cls = "fa fa-"+rw.find('select[name="link_glyph"]').val();
			rw.find('i[name="preview_glyph"]').addClass(cls+"");
		});
		$('.addbtn').each(function (){
			var rw = $(this).parents('tr');
			rw.find('i[name="preview_glyph"]').removeClass();
			var cls = "fa fa-"+rw.find('select[name="link_glyph"]').val();
			rw.find('i[name="preview_glyph"]').addClass(cls+"");
		});
		$('.deletebtn').each(function (){
			var rw = $(this).parents('tr');
			rw.find('i[name="preview_glyph"]').removeClass();
			var cls = "fa fa-"+rw.find('select[name="link_glyph"]').val();
			rw.find('i[name="preview_glyph"]').addClass(cls+"");
		});
	});

	$('i[name="preview_glyph"]').click(function(){
		row = $(this).parents('tr');
		var display = $('.glyph-pallette').css('display');
		prevglyph = row.find('select[name="link_glyph"]').val();
		$('.glyph-pallette .icons').each(function(){
			if($(this).hasClass("fa fa-"+prevglyph)){
				$(this).css('color','rgba(64,204,128,1)');
			} else {
				$(this).css('color','#444');
			}
		});
		var position = ($(this).position());
		$('.glyph-pallette').css('left', $('body').width()*0.6);
		if($('#img-preview').height()<5)
			$('.glyph-pallette').css('top', position.top+690-$('body').scrollTop());
		else 
			$('.glyph-pallette').css('top', position.top+$('#img-preview').height()+870-$('body').scrollTop());
		$('.glyph-pallette').css('min-height', '200px');
		if(display=="none")
			$('.glyph-pallette').slideDown(200);
	});

	$('i[name="icons"]').click(function(){
		$('.glyph-pallette .icons').each(function(){
			$(this).css('color','#444');
		});
		selectedglyph = $(this).attr('value');
		row.find('select[name="link_glyph"]').val(selectedglyph);
		$('.glyph-pallette .icons').each(function(){
			if($(this).hasClass("fa fa-"+selectedglyph)){
				$(this).css('color','rgba(64,204,128,1)');
			} else {
				$(this).css('color','#444');
			}
		});
		$('select[name="link_glyph"]').change();
		$('.close-div').click();
		//alert(row.find('select[name="link_glyph"]').val());
	});

	// Ajax call for updating the links
	$('.confirmbtn').click(function (){
		var row = $(this).parents('tr');
		linkid = row.find('input[name="link_id"]').val();
		linkname = row.find('input[name="link_name"]').val();
		linkhref = row.find('input[name="link_href"]').val();
		linktitle = row.find('input[name="link_title"]').val();
		linkglyph = row.find('select[name="link_glyph"]').val();
		//alert (linkid+" "+linkname+" "+linkhref+" "+linktitle+" "+linkglyph);
		$.ajax({
			url: "inc/update_links.php",
			data: "linkid="+linkid+"&linkname="+linkname+"&linkhref="+linkhref+"&linktitle="+linktitle+"&linkglyph="+linkglyph,
			type: "POST",
			dataType: "json",
			success: function (response, status, http){
				$.each(response, function(index, item){
					if(response[0]){
						$('#show-success-modal').click();
					} else {
						$('#show-failure-modal').click();
					}
				});	
			},
			error: function(http, status, error){
				
			}
		});
	});


	// Ajax call for adding the links
	$('.addbtn').click(function (){
		var row = $(this).parents('tr');
		linkname = row.find('input[name="link_name"]').val();
		linkhref = row.find('input[name="link_href"]').val();
		linktitle = row.find('input[name="link_title"]').val();
		linkglyph = row.find('select[name="link_glyph"]').val();
		//alert (linkid+" "+linkname+" "+linkhref+" "+linktitle+" "+linkglyph);
		$.ajax({
			url: "inc/add_link.php",
			data: "linkname="+linkname+"&linkhref="+linkhref+"&linktitle="+linktitle+"&linkglyph="+linkglyph,
			type: "POST",
			dataType: "json",
			success: function (response, status, http){
				$.each(response, function(index, item){
					if(response[0]) {
						$('#show-success-modal').click();
						location.reload();
					} else {
						$('#show-failure-modal').click();
					}
				});
			},
			error: function(http, status, error){
				
			}, complete: function(){

			}
		});
	});

	// AJAX call for deleting the links
	$('.deletebtn').click(function (evt){
		var status = confirm('Are you sure ? This can\'t be undone');
		if(status){
			var row = $(this).parents('tr');
			linkid = row.find('input[name="link_id"]').val();
			$.ajax({
				url: "inc/delete_link.php",
				data: "linkid="+linkid,
				type: "POST",
				dataType: "json",
				success: function (response, status, http){
					$.each(response, function(index, item){
						if(response[0]) {
							$('#show-success-modal').click();
							location.reload();
						} else {
							$('#show-failure-modal').click();
						}
					});	
				},
				error: function(http, status, error){
					
				}
			});
		} else {
			evt.preventDefault();
		}
		
	});

	}

	// AJAX call to the globals editing section
	$('.btn-globals').click(function (evt){
		var status = confirm('Do you want to confirm the changes ?');
		if(status) {
			var sitename = $('input[name="sitename"]').val();
			var sitedesc = $('textarea[name="sitedesc"]').val();
			var sitetitle = $('input[name="sitetitle"]').val();
			var footertext = $('input[name="footertext"]').val();
			var submit = $('.btn-globals').val();
			$.ajax({
				url:"inc/update_globals.php",
				data:"sitename="+sitename+"&sitedesc="+sitedesc+"&sitetitle="+sitetitle+"&footertext="+footertext+"&submit="+submit,
				type:"POST",
				dataType:"json",
				success: function(response, status, http){
					$.each(response, function(index, item){
						if(response[0]){
							$('#show-success-modal').click();
						} else {
							$('#show-failure-modal').click();
						}
					});
				}
			});
		} else {
			evt.preventDefault();
		}
		
	});

	// Logo updation form AJAX call
	$('.logo-submit').click(function (evt){
		var status = confirm('Do you want to confirm the changes ?');
		if(status) {
			var formData = new FormData(document.querySelector("form"));
			formData.append('logo',  $('#img-selector').val());
			formData.append('logo-submit', $('.logo-submit').val());
			$.ajax({
				url:"inc/update_logo.php",
				data: formData,
				dataType: "json",
				type:"POST",
				contentType: false,
				processData: false,
				success: function(response, status, http){
					$.each(response, function(index, item){
						if(response[0]){
							$('#show-success-modal').click();
						} else {
							$('#show-failure-modal').click();
						}
					});
				}
			});
		} else {
			evt.preventDefault();
		}
		
	});


	$(document).on("click",".submit-page",function (){
		var  pagename          = $('input[name="pagename"]').val();
		var filename 	         = $('input[name="filename"]').val();
		var submit                  = $('.submit-page').val();

		$.ajax({
			url:"inc/update_pageindex.php",
			data:"pagename="+pagename+"&filename="+filename+"&submit="+submit,
			type:"POST",
			dataType:"json",
			success: function(response, status, http){
				$.each(response, function(index, item){
					if(response[0]){
						$('#show-success-modal').click();
						$('#content').load(location.href+" #tbl-manage");
					} else {
						$('#show-failure-modal').click();
						$('#content').load(location.href+" #tbl-manage");
					}
				});
			}
		});
	});

	$(document).on("click",".btn-remove-content",function (){
		var  pagename          = $('input[name="pagename"]').val();
		var filename 	         = $('input[name="filename"]').val();
		var submit                  = $('.submit-page').val();
		var row 	        = $(this).parents('tr');
		var pageid                  = row.find('input[name="pageid"]').val();

		$.ajax({
			url:"inc/update_pageindex.php",
			data:"pageid="+pageid+"&submit=3",
			type:"POST",
			dataType:"json",
			success: function(response, status, http){
				$.each(response, function(index, item){
					if(response[0]){
						$('#show-success-modal').click();
						$('#tbl-manage').remove();
						$('#content').load(location.href+" #tbl-manage");
					} else {
						$('#show-failure-modal').click();
						$('#tbl-manage').remove();
						$('#content').load(location.href+" #tbl-manage");
					}
				});
			},
			error: function(http, status, error){
				$('#show-failure-modal').click();
			}
		});
	});


	$(document).on("click",".btn-edit-content",function (){
		var row 	        = $(this).parents('tr');
		var  pagename          = row.find('input[name="pagename_edit"]').val();
		var filename 	         = row.find('input[name="filename_edit"]').val();
		var submit                  = row.find('.submit-page').val();
		var pageid                  = row.find('input[name="pageid"]').val();

		$.ajax({
			url:"inc/update_pageindex.php",
			data:"pagename="+pagename+"&filename="+filename+"&submit=2&pageid="+pageid,
			type:"POST",
			dataType:"json",
			success: function(response, status, http){
				$.each(response, function(index, item){
					if(response[0]){
						$('#show-success-modal').click();
						$('#content').load(location.href+" #tbl-manage");
					} else {
						$('#globals_ajaxstatus').css('background-color', '#cc4040');
						$('#globals_ajaxstatus').hide().html('<h4>Bummer! There seems to be a problem. <i class="fa fa-delete"></i></h4>').slideDown("slow");
						$('#globals_ajaxstatus').delay(3500).slideUp(300);
						$('#content').load(location.href+" #tbl-manage");
					}
				});
			}
		});
	});
	
	$(document).on('click', 'button[name="img-submit"]' ,function(e){
		var row		= $(this).parents('tr');
		var imgfile 	= row.find('input[name="addimg-file"]').val();
		var imgtitle	= row.find('input[name="addimg-title"]').val();
		var imgalt	= row.find('input[name="addimg-alt"]').val();
		var submit 	= $('button[name="img-submit"]').val();
		var formData = new FormData(document.querySelector(".form-add-img"));
		formData.append('imgfile',  imgfile);
		formData.append('imgtitle', imgtitle);
		formData.append('imgalt', imgalt);
		formData.append('imgtitle', imgtitle);
		formData.append('submit', submit);
		$.ajax({
			url:"inc/update_images.php",
			data: formData,
			dataType: "json",
			type:"POST",
			contentType: false,
			processData: false,
			success: function(response, status, http){
				$.each(response, function(index, item){
					if(response[0]){
						$('#show-success-modal').click();
						row.find('input[name="addimg-file"]').val("");
						row.find('input[name="addimg-title"]').val("");
						row.find('input[name="addimg-alt"]').val("");
						$('.btn-pagination').click();
					} else {
						$('#show-failure-modal').click();
					}
				});
			},
			error: function(http, status, error){ 
				$('#show-failure-modal').click();
			}
		});
	});


	$(document).on('click', '.img-paginated-edit', function (e){
		var image 	= $(this).attr('src');
		var imgid 	= $(this).next('input[type="text"]').val();
		var imgtitle 	= $(this).next('input[type="text"]').next('input[type="text"]').val();
		var imgalt 	= $(this).next('input[type="text"]').next('input[type="text"]').next('input[type="text"]').val();
		$('#modal-imgtitle').val(imgtitle);
		$('#modal-imgalt').val(imgalt);
		$('#modal-img-preview').attr('src', image);
		$('#show-img-id').val(imgid);
	});

	$(document).on('click', 'button[name="modal-img-submit"]' ,function(e){
		var imgfile	= $('input[name="modal-imgfile"]').val();
		var imgtitle 	= $('#modal-imgtitle').val();
		var imgalt 	= $('#modal-imgalt').val();
		var submit 	= $(this).val();
		var id 		= $('#show-img-id').val();
		var formData = new FormData(document.querySelector(".modal-form-img"));
		formData.append('imgfile',  imgfile);
		formData.append('imgtitle', imgtitle);
		formData.append('imgalt', imgalt);
		formData.append('submit', submit);
		formData.append('imgid', id);
		$.ajax({
			url:"inc/update_images.php",
			data: formData,
			dataType: "json",
			type:"POST",
			contentType: false,
			processData: false,
			success: function(response, status, http){
				$.each(response, function(index, item){
					if(response[0]){
						$('#show-success-modal').click();
						if(submit==3){
							$('#modal-close').click();
						}
						$('.btn-pagination').click();
					} else {
						$('#show-failure-modal').click();
					}
				});
			},
			error: function(http, status, error){ 
				$('#show-failure-modal').click();
			}
		});
	});



});