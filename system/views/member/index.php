<div class="row" id="login">
	<div class="cols bucket">
		<h1>System Admins</h1>
		<p>Below are users who have global access to all teams/hidden and not</p>
		<form method='POST' action='<?php echo Asset::create_url('Member','update_admin',array(3))?>'>
			<div class="row">
				<div class="col-6">
					<h3>Promote Member to Admin</h3>
					<select name="member_id" class="col-12">
					<?php foreach($members as $member):?>
						<option value="<?php echo $member['id'] ?>"><?php echo $member['name'] ?></option>
					<?php endforeach;?>
					</select>
				</div>
				<div class="col-6">
					<input type="submit" class="button" value="promote"/>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="table" id="system_admin">
				<div class="row">
					<div class="cols title"><h2>name</h2></div>
					<div class="cols title"><h2>email</h2></div>
					<div class="cols title"><h2>phone</h2></div>
					<div class="cols title"><h2>Remove</h2></div>
				</div>
				<?php foreach($system_admins as $system_admin):?>
					<div class="row">
						<div class="cols">
							<?php
								$current = false;
								if($system_admin['id'] === Auth::user('id'))
								{
									$current= true;
								}
								if($system_admin['facebook_id'])
								{
									$opening_tag = "<a href='http://facebook.com/".$system_admin['facebook_id']."' class='name'>";
									$closing_tag = "</a>";
								}
								else
								{
									$opening_tag = "<div class='name'>";
									$closing_tag = "</div>";
								}
							?>
								<?php echo $opening_tag ?>
									<img src="<?php echo $system_admin['profile_pic'] ?>" width="30" />
									<p><?php echo $system_admin['name'] ?></p>
								<?php echo $closing_tag ?>
						</div>
						<div class='cols'><?php echo $system_admin['email'] ?></div>
						<div class='cols'><?php Member::phone($system_admin['phone']) ?></div>
						<div class="cols">
							<a href="<?php echo Asset::create_url('Member','update_admin',array(1,$system_admin['id']))?>">Demote Member</a>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

