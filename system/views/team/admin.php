<div class="row">
	<div class="cols bucket">
		<h1>Teams</h1>
		<p>Below is all the teams with there members</p>

<?php $current_team = 0; $first = true;?>
<?php foreach($team_members as $team_member): ?>
	<?php if($current_team !== $team_member['Team']['id']): $new = true; $current_team = $team_member['Team']['id'] ?>
		<?php if($first): $first = false; else: ?>
				</div>
		</div>
		<?php endif;?>
		<div class="row"><h1><?php echo $team_member['Team']['name'] ?></h1></div>
		<div class="row">
			<div class="table">
				<div class="cols title"><h2>name</h2></div>
				<div class="cols title"><h2>email</h2></div>
				<div class="cols title"><h2>phone</h2></div>
				<div class="cols title"><h2>Position</h2></div>
				<div class="cols title"><h2></h2></div>
	<?php endif;?>
				<div class="row">
					<div class='cols name'>
						<img src="<?php echo $team_member['Member']['profile_pic'] ?>" width="30" /><?php echo $team_member['Member']['name'] ?>
					</div>
					<div class='cols'><?php echo $team_member['Member']['email'] ?></div>
					<div class='cols'><?php echo $team_member['Member']['phone'] ?></div>
					<div class='cols'><?php if($team_member['Member']['member_type_id'] === "1")echo "Team Leader/"; if($team_member['TeamMemberType']['id'] === "1") echo "Shepherd";else echo "Server"; ?></div>
					<div class="cols icons">
						<a href="<?php echo Asset::create_url("TeamMember","Update")?>">
							<?php echo Asset::img("edit.png",array("alt"=>"Edit","height"=>25)) ?>Edit Position
						</a>
						<a href="<?php echo Asset::create_url("TeamMember","Delete")?>">
								<?php echo  Asset::img("archive.png",array("alt"=>"archive")) ?> Archive
						</a>
					</div>
				</div>

<?php endforeach;?>
			</div>
		</div>
	</div>
</div>