function changeEditorTheme(){
	var theme = document.getElementById('select_theme').value;
	editor.setTheme("ace/theme/"+theme.toLowerCase());
	//alert("Theme Changed");
}

function changeCodeLanguage(){
	var lang = document.getElementById('select_lang').value;
	editor.getSession().setMode("ace/mode/"+lang.toLowerCase());
	var index = document.getElementById('select_lang').selectedIndex;
	changeLanguageApi(index);
}

function changeLanguageApi(index){
	document.getElementById('select_lang_api').selectedIndex=index;
}

function changeTextSize(){
	document.getElementById('editor').style.fontSize = document.getElementById('select_textsize').value+"px";
}

function changeBoldState(){
	var isbold = document.getElementById('select_bold').checked;
	if(isbold){
		document.getElementById('editor').style.fontWeight = "bold";
	}
	else{
		document.getElementById('editor').style.fontWeight = "lighter";
	}
}

function changeWrapState(){
	var iswrap = document.getElementById('select_wrap').checked;
	if(iswrap)
		editor.getSession().setUseWrapMode(true);
	else
		editor.getSession().setUseWrapMode(false);
}

function warnForSave(){
	alert("Changes will not be saved");
}

function send(){
	var code = editor.getSession().getValue();
	return code;
}


$(document).ready(function() {

	// $('#select_lang_api').change(function(event) {
	// 	var sel_id = $(this).val();
	// 	alert(sel_id);
	// });

	$('#btn-editor-submit').click(function(event) {
		// event.preventDefault();
		var code 	= send();
		var lang_id = $('#select_lang_api').val();

		$('#spinner').removeClass('hidden');
		$('#output').addClass('hidden');

		$.ajax({
			url: 'check_compiler.php',
			type: 'POST',
			dataType: 'json',
			data: {
				"code" : code,
				"lang_id" : lang_id
			},
			success:function(result, status, http){
				$('#output').removeClass('hidden');
				$('#stdout').html(' <b>Output :</b> <pre>'+result["result"]["stdout"]+'</pre>');
				$('#stderr').html(' <b>Error : </b><pre>'+result["result"]["stderr"]+'</pre>');
				$('#memory').html(' <b>Memory : </b><pre>'+result["result"]["memory"]+'</pre>');
				$('#message').html(' <b>Message : </b><pre>'+result["result"]["message"]+'</pre>');
				$('#time').html(' <b>Time : </b><pre>'+result["result"]["time"]+'</pre>');
				$('#spinner').addClass('hidden');
			}
		})
	});
});