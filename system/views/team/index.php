<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>name</div>
		<div class='col'>photo</div>
		<div class='col'>summary</div>
		<div class='col'>video</div>
		<div class='col'>content</div>
	</div>
	<?php foreach($teams as $team):?>
		<div class='row'>
			<div class='col'>
				<?php echo $team['id'] ?>
			</div>
			<div class='col'>
				<?php echo $team['name'] ?>
			</div>
			<div class='col'>
				<?php echo $team['photo'] ?>
			</div>
			<div class='col'>
				<?php echo $team['summary'] ?>
			</div>
			<div class='col'>
				<?php echo $team['video'] ?>
			</div>
			<div class='col'>
				<?php echo $team['content'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>