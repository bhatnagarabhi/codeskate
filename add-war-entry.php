<?php 
	
	session_start();

	require_once("classes/init.php");

	require_once("lib/header.php");

	$war_id=0;
	$user_id = 0;

	if($_SESSION['user_id']=='')
		header("Location:./");
	else 
		$user_id = $_SESSION['user_id'];

	if($_REQUEST['war_id']!='') {
		$war_id 	= $_REQUEST['war_id'];
		$db 		= new Database();
	}
?>
<body onbeforeunload="warnForSave()">

	<div class="container" style="margin-top: 80px;">
		<a href="wars.php"><i class="fa fa-arrow-left"></i> Back</a>

			<div class="col-sm-112" style="color: black !important; ">
				<?php 
	$themes = array(
		array("Ambiance","ambiance"),
		array("Chaos","chaos"),
		array("Chrome","chrome"),
		array("Clouds","clouds"),
		array("Clouds Midnight","clouds_midnight"),
		array("Cobalt","cobalt"),
		array("Crimson Editor","crimson_editor"),
		array("Dawn","dawn"),
		array("Dreamweaver","dreamweaver"),
		array("Eclipse","eclipse"),
		array("Github","github"),
		array("Idle Fingers","idle_fingers"),
		array("iPlastic","iplastic"),
		array("Katzenmilch","katzenmilch"),
		array("Kr Theme","kr_theme"),
		array("Kuroir","kuroir"),
		array("Merbivore","merbivore"),
		array("Merbivore Soft","merbivore_soft"),
		array("Mono Industrial","mono_industrial"),
		array("Monokai","monokai"),
		array("Pastel On Dark","pastel_on_dark"),
		array("Solarized Dark","solarized_dark"),
		array("Solarized Light","solarized_light"),
		array("Sql Server","sqlserver"),
		array("Terminal","terminal"),
		array("Textmate","textmate"),
		array("Tomorrow","tomorrow"),
		array("Tomorrow Night","tomorrow_night"),
		array("Tomorrow Night Blue","tomorrow_night_blue"),
		array("Tomorrow Night Bright","tomorrow_night_bright"),
		array("Tomorrow Night Eighties","tomorrow_night_eighties"),
		array("Twilight","twilight"),
		array("Vibrant Ink","vibrant_ink"),
		array("Xcode","xcode"),
	);

	$languages = array(
		array("C","objectivec",1),
		array("C++","c_cpp",2),
		array("Java","java",3),
		array("Python","python",5),
		array("Perl","perl",6),
		array("PHP","php",7),
		array("Ruby","ruby",8),
		array("C#","csharp",9),
		array("Mysql","mysql",10),
		array("Oracle", "oracle",11),
		array("Haskell Cabal","haskell_cabal",12),
		array("Clojure" ,"clojure",13),
		array("Bash", "bash",14),
		array("Scala", "scala",15),
		array("Erlang","erlang",16),
		array("Lua","lua",18),
		array("Javascript","javascript",20),
		array("Golang","golang",21),
		array("D","d",22),
		array("Ocaml", "ocaml",23),
		array("R", "r",24),
		array("Pascal", "pascal",25),
		array("Sbcl", "sbcl",26),
		array("Python3", "python3",30),
		array("Groovy","groovy",31),
		array("Objectivec", "objectivec",32),
		array("Fsharp", "fsharp",33),
		array("Cobol","cobol",36),
		array("VB Script","vbscript",37),
		array("Lolcode", "lolcode",38),
		array("Smalltalk", "smalltalk",39),
		array("Tcl", "tcl",40),
		array("Whitespace", "whitespace",41),
		array("TSQL", "tsql",42),
		array("JAVA8", "java8",43),
		array("DB2", "db2",44),
		array("Octave", "octave",46),
		array("Xquery", "xquery",48),
		array("Racket","racket",49),
		array("Rust", "rust",50),
		array("Swift", "swift",51),
		array("Fortran", "fortran",54)



		// array("Abap","abap"),
		// array("Abc","abc"),
		// array("Actionscript","actionscript"),
		// array("Ada","ada"),
		// array("Apache Conf","apache_conf"),
		// array("Applescript","applescript"),
		// array("ASCII Document","asciidoc"),
		// array("Assembly x86","assembly_x86"),
		// array("Auto Hotkey","autohotkey"),
		// array("Batchfile","batchfile"),
		// array("c9search","c9search"),
		// array("Cirru","cirru"),
		// array("Clojure","clojure"),
		
		// array("Coffee","coffee"),
		// array("Coldfusion","coldfusion"),
		
		// array("CSS","css"),
		// array("Curly","curly"),
		
		// array("Dart","dart"),
		// array("Diff","diff"),
		// array("Django","django"),
		// array("Dockerfile","dockerfile"),
		// array("Dot","dot"),
		// array("Drools","drools"),
		// array("Eiffel","eiffel"),
		// array("Ejs","ejs"),
		// array("Elixir","elixir"),
		// array("Elm","elm"),
		
		// array("Forth","forth"),
		// array("Fortran","fortran"),
		// array("Ftl","ftl"),
		// array("Gcode","gcode"),
		// array("Gherkin","gherkin"),
		// array("Gitignore","gitignore"),
		// array("Glsl","glsl"),
		// array("Gobstones","gobstones"),
		
		
		// array("Haml","haml"),
		// array("Handlebars","handlebars"),
		
		// array("Haxe","haxe"),
		// array("HTML","html"),
		// array("HTML Elixir","html_elixir"),
		// array("HTML Ruby","html_ruby"),
		// array("Ini","ini"),
		// array("Io","io"),
		// array("Jack","jack"),
		// array("Jade","jade"),
		
		
		// array("JSON","json"),
		// array("JSONIq","jsoniq"),
		// array("Jsp","jsp"),
		// array("Jsx","jsx"),
		// array("Julia","julia"),
		// array("Kotlin","kotlin"),
		// array("Latex","latex"),
		// array("Lean","lean"),
		// array("LESS","less"),
		// array("Liquid","liquid"),
		// array("Lisp","lisp"),
		// array("Livescript","live_script"),
		// array("Logiql","logiql"),
		
		// array("Lua Page","luapage"),
		// array("Lucene","lucene"),
		// array("Matlab","matlab"),
		// array("Maze","maze"),
		
		
		// array("Plain Text","plain_text"),
		
		
		// array("SASS","sass"),
		
		// array("XML","xml")
	);

?>




	<!-- CORE BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<!-- GENERIC CSS -->
	<link rel="stylesheet" type="text/css" href="css/generic.css">

	<!-- FONT-AWESOME -->
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">

	<section id="codeeditor">

				<form class="form-inline" method="post" action="inc/update-war-entry.php" id="frm-editor-submit">
					
					<div class="form-group small-padding">
						<label><i class="fa fa-text-height"></i> Font-size : </label>
						<select type="number" id="select_textsize" name="" onchange="changeTextSize()" value="<?php echo "17"; ?>" class="input border-thin input-sm" style="padding-top: 0px;">

						<?php for($i=8; $i<=72; $i++) : ?>

							<option <?php if($i==17){ echo "selected"; } ?> value="<?php echo $i; ?>"><?php echo "{$i} px"; ?></option>

						<?php endfor; ?>

						</select>
					</div><!-- form-group -->

					<div class="form-group small-padding">
						<label><i class="fa fa-paint-brush"></i> Theme : </label>
						<select class="input-sm" id="select_theme" onchange="changeEditorTheme();" style="padding-top: 0px;">


						<?php for($i=0; $i<sizeof($themes); $i++) :	?>

							<option <?php if($themes[$i][1]=="monokai"){ echo "selected"; } ?> value="<?php echo $themes[$i][1]; ?>"><?php echo $themes[$i][0]; ?></option>

						<?php endfor; ?>


						</select>

					</div><!-- form-group -->

					<div class="form-group small-padding">
						<label><i class="fa fa-keyboard-o"></i> Language : </label>
						<select id="select_lang" class="input input-sm border-thin" onchange="changeCodeLanguage();" style="padding-top: 0px;">


							<?php for($i=0; $i<sizeof($languages); $i++) : ?>
							
								<option <?php if($languages[$i][1]=="javascript"){ echo "selected"; } ?> value="<?php echo $languages[$i][1]; ?>"><?php echo $languages[$i][0]; ?></option>
							
							<?php endfor; ?>


						</select>


						<select id="select_lang_api" class="input input-sm border-thin hidden" style="padding-top: 0px;">


							<?php for($i=0; $i<sizeof($languages); $i++) : ?>
							
								<option <?php if($languages[$i][1]=="javascript"){ echo "selected"; } ?> value="<?php echo $languages[$i][2]; ?>"><?php echo $languages[$i][0]; ?></option>
							
							<?php endfor; ?>


						</select>

					</div><!-- form-group -->

					<div class="form-group small-padding">
						<input type="checkbox" style="margin-bottom: -4px;" id="select_bold" checked onchange="changeBoldState();" name="checkbold">
						<label> Bold </label>
					</div><!-- form-group -->

					<div class="form-group small-padding">
						<input type="checkbox" checked style="margin-bottom: -4px;" id="select_wrap" checked onchange="changeWrapState();" name="checkwrap">
						<label> Word Wrap </label>
					</div><!-- form-group -->

	
					<div class="form-group">
						<button type="button" onclick="send()" id="btn-editor-submit" class="btn small-margin btn-primary"><i class="fa fa-play"></i> Run</button>
					</div><!-- form-group -->

					<input type="hidden" name="code" id="code"/>

					<input type="hidden" name="war_id" id="war_id" value="<?php  echo $_REQUEST['war_id']; ?>" />

					<?php 
						$db 	= new Database();
						$sql 	= "SELECT * FROM war_entries WHERE war_id=  {$war_id} AND war_entry_user_id=  {$user_id}";
						$res 	= $db::executeQuery($sql);
						$num_rows = mysqli_num_rows($res);
						if($num_rows == 0) {
					?>					

					<button type="button" id="btn-answer-submit" onclick="if(confirm('The entry you provide, can\'t be edited. Do you want to continue ?')) { return true; } else { return false; } " class="btn small-margin btn-success"><i class="fa fa-upload"></i> Submit</button>

					<?php } else { ?>

					<span class="font-bold theme-fg">Entry already submitted</span>

					<?php } ?>

					<div id="editor"></div><!-- editor -->

				</form><!-- form-->

		
				<div class="col-md-12 no-padding">
					
					<div id="console" style="position: fixed; background-color: #222; color: white; margin: 0 auto; height:150px; padding: 5px;  z-index: 100; border: 2px solid #999; bottom: 0px;  width:100%; left: 0px; overflow-y: scroll; font-family: 'Consolas'">
						<p>Output : The code output will appear here </p>
						<div id="spinner" style="font-size: 50px; margin-top: 20px" class="theme-fg text-center hidden"><i class="fa fa-spin fa-spinner"></i></div>
						<div id="output" class="well hidden" style="margin-top: 20px; background-color: #222; color: white;">
							<div style="font-size: 12px; " id="stdout"></div>
							<div style="font-size: 12px; " id="stderr"></div>
							<div style="font-size: 12px; " id="memory"></div>
							<div style="font-size: 12px; " id="message"></div>
							<div style="font-size: 12px; " id="time"></div>
						</div><!-- output -->
					</div>
				</div>


			
	</section><!-- codeeditor -->

    
	<script src="code editor/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript" src="js/code-editor-config.js"></script>

	<script type="text/javascript" src="js/script.js"></script>

	<script type="text/javascript" src="vendor/jquery-ui.min.js"></script>

	<link rel="stylesheet" type="text/css" href="vendor/jquery-ui.min.css">

	<script type="text/javascript">
		$(document).ready(function() {
			$('#console').resizable({
			       handles: 'n'
			    }); 
			$('#console').resize(function(event) {
				$(this).css({
					"margin-bottom": "-5px"
				});
			});

			$('#btn-answer-submit').click(function(event) {
				var code = send();
				$('#code').val(code);
				$('#frm-editor-submit').submit();
			});

		});
	</script>

</html>
			</div><!-- col-sm-6 -->

		</div><!-- row -->

	</div><!-- container -->

<style type="text/css">
	#editor {
		min-height: 100px;
		max-height: 320px
	}
</style>
</body>