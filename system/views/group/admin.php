<div class="row container">
	<div class="cols bucket">
		<h1>Teams</h1>
		<p>Below are all the teams and their members.</p>

	<ul class="row">
		<div class="col-3">
			<a href="<?php echo Asset::create_url('team','post')?>" class="button">Add New Team</a>
		</div>
		<h3>Jump to Team:</h3>
		<?php foreach($team_names as $team_name):?>
			<li><a href="#team-<?php echo $team_name['id']?>"><?php echo $team_name['name']?></a></li>
		<?php endforeach;?>
	</ul>

<?php foreach($teams as $team):?>
	<div class="row" id="team-<?php echo $team['Team']['id'] ?>"><h1><?php echo $team['Team']['name'] ?></h1></div>
	<?php if($team['Team']['team_type_id'] === "2"):?><a href="" class="add_member" data-name="<?php echo $team['Team']['name'] ?>" data-id="<?php echo $team['Team']['id'] ?>">Add Member To Team</a><?php endif;?>
	<div class="row">
		<div class="table">
			<div class="row">
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
			</div>
			<?php foreach($team['Member'] as $index=>$member): ?>
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
							<img src="<?php echo $member['profile_pic'] ?>" width="30" />
							<p><?php echo $member['name'] ?></p>
						<?php echo $closing_tag ?>
				</div>
				<div class='cols'><?php echo $member['email'] ?></div>
				<div class='cols'><?php Member::phone($member['phone']) ?></div>
				<div class='cols'>
					<select id="update-<?php echo $team['TeamMember'][$index]['id']?>" data-team-member-id="<?php echo $team['TeamMember'][$index]['id']?>" data-member-id="<?php echo $member['id']?>">
						<option data-member-type-id="1" data-team-member-type-id="1" <?php if($team['TeamMember'][$index]['team_member_type_id'] === "1")echo "selected"?>>Team Leader</option>
						<option data-team-member-type-id="2" <?php if($team['TeamMember'][$index]['team_member_type_id'] === "2") echo "selected" ?>>Shepherd</option>
						<option data-team-member-type-id="3" <?php if($team['TeamMember'][$index]['team_member_type_id'] === "3") echo "selected" ?>>Server</option>
						<option data-team-member-type-id="4" <?php if($team['TeamMember'][$index]['team_member_type_id'] === "4") echo "selected" ?>>Archive</option>
					</select>
					<a href="#update-<?php echo $team['TeamMember'][$index]['id']?>" class="update"><?php echo Asset::img("save.png",array("alt"=>"Save","height"=>15)) ?></a>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</div>

<?php endforeach; ?>

<?php if(isset($non_team_members)):?>
	<div class="row" id="team-none"><h1>Members Not On a Team</h1></div>
	<div class="table" id="non_members">
		<div class="row">
			<div class="cols title"><h2>name</h2></div>
			<div class="cols title"><h2>email</h2></div>
			<div class="cols title"><h2>phone</h2></div>
			<div class="cols title"><h2>add to team</h2></div>
		</div>
		<?php array_pop($team_names);foreach($non_team_members as $non_member):?>
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
<div class="modal" id="add_member">
	<a href="#close" class="close-modal">Close</a>
	<form class="" action="<?php echo Asset::create_url("TeamMember","post")?>" method="POST">
		<h1>Add Member to </h1>
		<div class="row">
			<div class="cols">
				<select name="member_id">
				<?php foreach($members as $member): ?>
					<option value="<?php echo $member['id']?>"><?php echo $member['name']?></option>
				<?php endforeach;?>
				</select>
			</div>

			<div class="cols">
				<input type="hidden" name="team_id" value="" id="team_id" />
				<input type="hidden" name="team_member_type_id" value="3" />
				<input type="submit" value="Add Member to Team" class="button"  id="member_add"/>
			</div>
		</div>
	</form>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<?php echo Asset::js("jquery.modal.min")?>

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

	$(".add_member").on('click',function(e)
	{
		e.preventDefault();

		var team_info = $(this).data();
		var modal =$("#add_member");
		modal.find("h1").text("Add Member to "+team_info.name);
		modal.find("#team_id").val(team_info.id);

		modal.modal();

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