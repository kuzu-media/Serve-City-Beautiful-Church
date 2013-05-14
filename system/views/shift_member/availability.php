<div class="modal" id="availability">
	<div class="row"><h1>Members Available on </h1></div>
	<?php if(isset($members) && $members): ?>
		<div class="table">
			<div class="row">
				<div class="cols title"><h2>name</h2></div>
				<div class="cols title"><h2>email</h2></div>
				<div class="cols title"><h2>phone</h2></div>
			</div>
			<?php foreach($members as $member): $member = $member['Member'] ?>
				<div class="row">
					<div class="cols">
						<?php
							if($member['facebook_id'])
							{
								$opening_tag = "<a href='http://facebook.com/".$member['facebook_id']."' class='name'>";
								$closing_tag = "</a>";
							}
							else
							{
								$opening_tag = "<div class='name'>";
								$closing_tag = "</div>";
							}
						?>
						<?php echo $opening_tag ?>
							<img src="<?php echo $member['profile_pic']?>" />
							<p><?php echo $member['name'];?></p>
						<?php echo $closing_tag ?>
					</div>
					<div class="cols">
						<?php echo $member['email'] ?>
					</div>
					<div class="cols">
						<?php echo $member['phone'] ?>
					</div>

				</div>
			<?php endforeach;?>
		</div>
	<?php else: ?>
		<p>We're Sorry but we couldn't find any available members for this date</p>
	<?php endif;?>
	<?php if(isset($working_members) && $working_members):?>
		<h3>Members Already Serving</h3>
		<div class="table">
			<div class="row">
				<div class="cols title" style="width: 25%"><h2>name</h2></div>
				<div class="cols title" style="width: 25%"><h2>email</h2></div>
				<div class="cols title" style="width: 25%"><h2>phone</h2></div>
				<div class="cols title" style="width: 25%"><h2>opportunity(s)</h2></div>
			</div>
			 <?php foreach($working_members as $working_member): $member = $working_member['Member']; ?>
				<div class="row">
					<div class="cols">
						<?php
							if($member['facebook_id'])
							{
								$opening_tag = "<a href='http://facebook.com/".$member['facebook_id']."' class='name'>";
								$closing_tag = "</a>";
							}
							else
							{
								$opening_tag = "<div class='name'>";
								$closing_tag = "</div>";
							}
						?>
						<?php echo $opening_tag ?>
							<img src="<?php echo $member['profile_pic']?>" />
							<p><?php echo $member['name'];?></p>
						<?php echo $closing_tag ?>
					</div>
					<div class="cols">
						<?php echo $member['email'] ?>
					</div>
					<div class="cols">
						<?php echo $member['phone'] ?>
					</div>
					<div class="cols">
						<?php
							foreach($working_member['Shift'] as $shift)
							{
								echo "<div>";
								foreach($team_names as $team)
								{
									if($team['id'] === $shift['team_id'])
									{
										echo $team['name'];
										break;
									}
								}
								echo " at ".$shift['time'];
								echo "</div>";
							}
						?>
					</div>

				</div>
			<?php endforeach;?>
		</div>
	<?php endif;?>
	<?php if(isset($achived_members) && $achived_members):?>
		<h3>Archived Members</h3>
		<div class="table">
			<div class="row">
				<div class="cols title" style="width: 33%"><h2>name</h2></div>
				<div class="cols title" style="width: 33%"><h2>email</h2></div>
				<div class="cols title" style="width: 33%"><h2>phone</h2></div>
			</div>
			<?php foreach($achived_members as $achived_member): $member = $achived_member['Member'] ?>
				<div class="row">
					<div class="cols">
						<?php
							if($member['facebook_id'])
							{
								$opening_tag = "<a href='http://facebook.com/".$member['facebook_id']."' class='name'>";
								$closing_tag = "</a>";
							}
							else
							{
								$opening_tag = "<div class='name'>";
								$closing_tag = "</div>";
							}
						?>
						<?php echo $opening_tag ?>
							<img src="<?php echo $member['profile_pic']?>" />
							<p><?php echo $member['name'];?></p>
						<?php echo $closing_tag ?>
					</div>
					<div class="cols">
						<?php echo $member['email'] ?>
					</div>
					<div class="cols">
						<?php echo $member['phone'] ?>
					</div>

				</div>
			<?php endforeach;?>
		</div>
	<?php endif;?>


</div>
