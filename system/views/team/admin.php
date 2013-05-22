<div class="row container">
	<div class="cols bucket">
		<h1>Teams</h1>
		<p>Below are all the teams and their members.</p>

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
						$current = false;
						if($team_member['Member']['id'] === Auth::user('id'))
						{
							$current= true;
						}
						if($team_member['Member']['facebook_id'] && !$current)
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
							<img src="<?php echo $team_member['Member']['profile_pic'] ?>" width="30" /><?php echo $team_member['Member']['name'] ?>
						<?php echo $closing_tag ?>
					</div>
					<div class='cols'><?php echo $team_member['Member']['email'] ?></div>
					<div class='cols'><?php echo $team_member['Member']['phone'] ?></div>
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

		if(selected.data("team-member-type-id") === 4)
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
</script>