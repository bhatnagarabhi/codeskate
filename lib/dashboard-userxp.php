<?php 
	$user 		= new Users(); 
	$user_pic 	= $user_arr['user_pic'];
?>
<div class="jumbotron">
	<h2 class="theme-fg" style="margin-bottom: 0px;">
		<?php if(!empty($user_pic)) { ?>
			<img style="display: inline-block; margin-right: 10px;" class="img-circle" height="60" width="60" src="data:image/png;base64,<?php echo base64_encode($user_pic); ?>"><?php echo $user_arr['user_username']; ?>
		<?php } else { ?>
			<img style="display: inline-block; margin-right: 10px;" height="60" width="60" src="images/ben.png"><?php echo $user_arr['user_username']; ?>
		<?php } ?>
	</h2><br><div class="font-bold arial-font"><?php $xp = $user_arr['user_xp']; echo $xp; ?> XP (<?php $rem_xp = $user->getRemainingXp($user_arr['user_xp']);echo $rem_xp; ?> XPs for the next level) <span class="pull-right" style="font-weight: bold">Level <?php echo $user->getUserLevel($user_arr['user_xp']); ?></span></div>
	<?php 
		$total_xp 		= $xp + $rem_xp;
		$rem_xp_per 		= ($xp/$total_xp)*100	;
	?>
	<div class="progress" style="border-radius: 10px;">
	  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $rem_xp_per; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_xp; ?>" style="width: <?php echo $user->getXpPercent($user_arr['user_xp']); ?>%"></div>
	</div><!-- progress -->

</div>