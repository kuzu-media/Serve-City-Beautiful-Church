<div class="modal" id="availability">
	<h1>Members Available on </h1>
	<?php if($success): ?>
		<div class="row">
			<div class="table">
				<div class="cols title"><h2>name</h2></div>
				<div class="cols title"><h2>email</h2></div>
				<div class="cols title"><h2>phone</h2></div>
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

		</div>
	<?php else: ?>
		<p>We're Sorry but we couldn't find any available members for this date</p>
	<?php endif;?>
</div>
