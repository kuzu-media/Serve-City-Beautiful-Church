<div class="row container">
	<div class="cols bucket">
		<h1>Teams</h1>
		<p>Below are all the teams and their members.</p>
<ul class="row">
	<h3>Jump to Team:</h3>
	<?php foreach($team_names as $team_name):?>
		<li><a href="#team-<?php echo $team_name['id']?>"><?php echo $team_name['name']?></a></li>
	<?php endforeach;?>
</ul>
<?php $current_team = 0; $first = true;?>
<?php foreach($team_members as $team_member): ?>
	<?php if($current_team !== $team_member['Team']['id']): $new = true; $current_team = $team_member['Team']['id'] ?>
		<?php if($first): $first = false; else: ?>
				</div>
		</div>
		<?php endif;?>
		<div class="row" id="team-<?php echo $team_member['Team']['id'] ?>"><h1><?php echo $team_member['Team']['name'] ?></h1></div>
		<div class="row">
			<div class="table">
				<div class="cols title"><h2>name</h2></div>
				<div class="cols title"><h2>email</h2></div>
				<div class="cols title"><h2>phone</h2></div>
				<div class="cols title">
					<div class="tooltip status">
						<h2>Status <?php echo Asset::img("info.png",array("class"=>"info"))?></h2>
						<div class="bucket">
							<h3>Team Leader</h3>
							<p>Has access to admin section where they can see member names, emails and phone numbers and schedule people</p>
							<h3>Shepard</h3>
							<p>Gets notified when a new member joins the team</p>
							<h3>Server</h3>
							<p>Basic member, can sign up to serve and modify settings</p>
						</div>
					</div>
				</div>
	<?php endif;?>
				<div class="row">
					<div class="cols">
					<?php
						if($team_member['Member']['facebook_id'])
						{
							$opening_tag = "<a href='http://facebook.com/".$team_member['Member']['facebook_id']."' class='name'>";
							$closing_tag = "</a>";
						}
						else
						{
							$opening_tag = "<div class='name'>";
							$closing_tag = "</div>";
						}
					?>
						<?php echo $opening_tag ?>
							<img src="<?php echo $team_member['Member']['profile_pic'] ?>" width="30" />
							<p><?php echo $team_member['Member']['name'] ?></p>
						<?php echo $closing_tag ?>
					</div>
					<div class='cols'><?php echo $team_member['Member']['email'] ?></div>
					<div class='cols'><?php Member::phone($team_member['Member']['phone']) ?></div>
					<div class='cols'>
						<select id="update-<?php echo $team_member['TeamMember']['id']?>" data-team-member-id="<?php echo $team_member['TeamMember']['id']?>" data-member-id="<?php echo $team_member['Member']['id']?>">

							<option data-member-type-id="1" data-team-member-type-id="1" <?php if( $team_member['TeamMemberType']['id'] === "1")echo "selected"?>>Team Leader</option>
							<option data-team-member-type-id="2" <?php if($team_member['TeamMemberType']['id'] === "2") echo "selected" ?>>Shepherd</option>
							<option data-team-member-type-id="3" <?php if($team_member['TeamMemberType']['id'] === "3") echo "selected" ?>>Server</option>
							<option data-team-member-type-id="4" <?php if($team_member['TeamMemberType']['id'] === "4") echo "selected" ?>>Archive</option>
						</select>
						<a href="#update-<?php echo $team_member['TeamMember']['id']?>" class="update"><?php echo Asset::img("save.png",array("alt"=>"Save","height"=>15)) ?></a>
					</div>
				</div>

<?php endforeach;?>
			</div>
		</div>

<?php if(isset($non_team_members)):?>
	<div class="row"><h1>Members Not On a Team</h1></div>
		<div class="table" id="non_members">
			<div class="row">
				<div class="cols title"><h2>name</h2></div>
				<div class="cols title"><h2>email</h2></div>
				<div class="cols title"><h2>phone</h2></div>
				<div class="cols title"><h2>add to team</h2></div>
			</div>
			<?php foreach($non_team_members as $non_member):?>
				<div class="row">
					<div class="cols">
						<?php
							if($non_member['facebook_id'])
							{
								$opening_tag = "<a href='http://facebook.com/".$non_member['facebook_id']."' class='name'>";
								$closing_tag = "</a>";
							}
							else
							{
								$opening_tag = "<div class='name'>";
								$closing_tag = "</div>";
							}
						?>
							<?php echo $opening_tag ?>
								<img src="<?php echo $non_member['profile_pic'] ?>" width="30" />
								<p><?php echo $non_member['name'] ?></p>
							<?php echo $closing_tag ?>
					</div>
					<div class='cols'><?php echo $non_member['email'] ?></div>
					<div class='cols'><?php Member::phone($non_member['phone']) ?></div>
					<div class='cols'>
						<select id="team-<?php echo $non_member['id']?>" data-member-id="<?php echo $non_member['id']?>">
							<?php foreach($team_names as $team_name):?>
								<option value="<?php echo $team_name['id']?>"><?php echo $team_name['name']?></option>
							<?php endforeach;?>
						</select>
						<a href="#team-<?php echo $non_member['id']?>" class="team_add"><?php echo Asset::img("save.png",array("alt"=>"Save","height"=>15)) ?></a>
					</div>
				</div>
			<?php endforeach;?>
		</div>
<?php endif;?>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script>
	$(".update").on('click',function(event)
	{
		event.preventDefault();
		var link = $(this);
		var select = $(link.attr('href'));
		var selected = select.find(":selected");

		var data = {id:selected.data("update-id")}
		data[selected.data("update")] = selected.val();

		if(selected.data("team-member-type-id") === 1)
		{
			$.ajax({
				url: '<?php echo Asset::relative_url() ?>'+"member/update/"+select.data("member-id")+".json",
				type: 'post',
				data: {
					id: select.data("member-id"),
					"member_type_id": selected.data("member-type-id")
				},
				success: function (data) {
					data
				}
			});
		}


		$.ajax({
				url: '<?php echo Asset::relative_url() ?>'+"teamMember/update/"+select.data("team-member-id")+".json",
				type: 'post',
				data: {
					id: select.data("team-member-id"),
					"team_member_type_id": selected.data("team-member-type-id")
				},
				success: function (data) {
					data
				}
			});

	});

	$(".team_add").on('click',function(event)
	{
		event.preventDefault();
		var link = $(this);
		var select = $(link.attr('href'));
		var team_id = select.find(":selected").val();
		var member_id = select.data("member-id");

		$.ajax({
				url: '<?php echo Asset::create_url("TeamMember","post")?>.json',
				type: 'post',
				data: {
					'team_id': team_id,
					'member_id': member_id,
					"team_member_type_id": 3
				},
				dataType:'json',
				success: function (data) {

					if(data.success)
					{
						select.parent().parent().remove()

					}
				}
			});

	});
</script>