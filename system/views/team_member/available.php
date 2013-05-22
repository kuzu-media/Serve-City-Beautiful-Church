<div class="modal" id="availability">
	<div class="row"><h1>Availability on <?= $date ?></h1></div>
	<h3>Recommended Members</h3>
	<?php if(isset($recommened) && $recommened): ?>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$recommened) ?>
		</div>
	<?php else: ?>
		<p>Sorry we couldn't find any members to recommend for this opportunity</p>
	<?php endif;?>
	<?php if(isset($serving) && $serving): ?>
		<h3>Members Already Serving on <?= $date ?></h3>
		<div class="table">
			<?php View::render('team_member/_title',array("opportunities"=>true))?>
			<?php View::render('team_member/_member',$serving) ?>
		</div>
	<?php endif;?>
	<?php if(isset($sunday) && $sunday): ?>
		<h3>Members Who Don't Prefer This Sunday</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$sunday) ?>
		</div>
	<?php endif;?>
	<?php if(isset($max) && $max): ?>
		<h3>Members Who Have Already Served Preferred Amount of Weeks</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$max) ?>
		</div>
	<?php endif;?>
	<?php if(isset($archived) && $archived): ?>
		<h3>Archived Members</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$archived) ?>
		</div>
	<?php endif;?>


</div>
