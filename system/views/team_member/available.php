<div class="modal" id="availability" data-shift-id="<?= $shift_id?>" data-shift-date="<?= $date?>" data-team-name="<?=$teamName?>" data-shift-time="<?= $time ?>">
	<a href="#close" class="close-modal">Close</a>
	<div class="row"><h1>Availability on <?= $date ?> - <?= $time ?></h1></div>
	<div>
		<label for="group">Group:</label>
		<select name="group" id="group">
			<option value="none">None</option>
			<?php foreach($group_names as $group): ?>
			<option value="<?=$group['id']?>" <?php if(isset($current_group) && $current_group === $group['id']) echo "selected";?>><?=$group['name']?></option>
			<?php endforeach;?>
		</select>
	</div>
	<?php if(isset($pending) && $pending): ?>
		<h3>Pending Invites</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$pending) ?>
		</div>
	<?php endif;?>
	<?php if(isset($declined) && $declined): ?>
		<h3>Declined Invites</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$declined) ?>
		</div>
	<?php endif;?>
	<h3>Recommended</h3>
	<?php if(isset($recommened) && $recommened): ?>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$recommened) ?>
		</div>
	<?php else: ?>
		<p>Sorry we couldn't find any members to recommend for this opportunity</p>
	<?php endif;?>
	<?php if(isset($serving) && $serving): ?>
		<h3>Already Serving on <?= $date ?></h3>
		<div class="table">
			<?php View::render('team_member/_title',array("opportunities"=>true))?>
			<?php View::render('team_member/_member',$serving) ?>
		</div>
	<?php endif;?>
	<?php if(isset($sunday) && $sunday): ?>
		<h3>Don't Prefer This Sunday</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$sunday) ?>
		</div>
	<?php endif;?>
	<?php if(isset($max) && $max): ?>
		<h3>Already Served Preferred Amount of Weeks</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$max) ?>
		</div>
	<?php endif;?>
	<?php if(isset($archived) && $archived): ?>
		<h3>Archived</h3>
		<div class="table">
			<?php View::render('team_member/_title')?>
			<?php View::render('team_member/_member',$archived) ?>
		</div>
	<?php endif;?>
</div>
