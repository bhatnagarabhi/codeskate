<?php
	$db 		= new Database();
	$lang_res 	= $db->fetchAllContent(1, 'languages', 'dev_glyphs', 'glyph_id', 'dev_glyph_id');
?>
<section id="language-picker">
	<div class="container">
		<div class="row">
			<div class="col-sm-12"><h1 class="theme-fg">Pick the language of your choice</h1><hr></div>
		</div>
		<div class="row">
			<div class="col-sm-12" id="lang-select-panel">

				<form action="registration_quiz" method="post">
					<center><ul>
						<?php while($lang_arr	= mysqli_fetch_array($lang_res)) : ?>
							<button style="background:none; border: none;" name="language" value="<?php echo $lang_arr['dev_glyph_name']; ?>"><li><i class="devicon-<?php echo $lang_arr['dev_glyph_name']; ?>-plain"></i></li></button>
						<?php endwhile; ?>
					</ul></center>
				</form>
			</div>
		</div>
	</div><!-- container -->
</section>