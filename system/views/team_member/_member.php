<div class="row">
	<div class="cols">
		<?php
			if($Member['facebook_id'])
			{
				$opening_tag = "<a href='http://facebook.com/".$Member['facebook_id']."' class='name'>";
				$closing_tag = "</a>";
			}
			else
			{
				$opening_tag = "<div class='name'>";
				$closing_tag = "</div>";
			}
		?>
		<?php echo $opening_tag ?>
			<img src="<?php echo $Member['profile_pic']?>" />
			<p><?php echo $Member['name'];?></p>
		<?php echo $closing_tag ?>
	</div>
	<div class="cols">
		<?php echo $Member['email'] ?>
	</div>
	<div class="cols">
		<?php echo $Member['phone'] ?>
	</div>

	<?php if(isset($Team) && isset($Shift)):?>
		<div class="cols">
		<?php foreach($Shift as $shift):?>
			<div>
				<?= $Team[$shift['team_id']]['name'] ?> - <?= $shift['time'] ?>
			</div>
		<?php endforeach;?>
		</div>
	<?php endif; ?>

</div>