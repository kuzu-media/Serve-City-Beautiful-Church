<div class="row">
	<div class="cols bucket">
		<h1>Groups</h1>
		<div class="utility">
			<a href="<?php echo Asset::create_url('group',"post")?>">Add Group</a> |
		</div>
		<p>
			<?php if($groups): foreach($groups as $group):?>
				<a href="<?php echo Asset::create_url('group','get',array($group['id']));?>"><?php echo $group['name']?></a> |
			<?php endforeach; endif;?>

	<div class="row" id="team-<?php echo $team['Team']['id'] ?>">
		<h1><?php echo $current_group['name'] ?></h1>
		<a href="<?php echo Asset::create_url('group',"update",array($current_group['id']))?>">Edit Group</a>

	</div>

<?php foreach($teams as $team):?>
	<div class="row" id="team-<?php echo $team['Team']['id'] ?>"><h3><?php echo $team['Team']['name'] ?></h3></div>
	<div class="row">
		<div class="table">
			<div class="row">
				<div class="cols title"><h2>name</h2></div>
				<div class="cols title"><h2>email</h2></div>
				<div class="cols title"><h2>phone</h2></div>
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
			</div>
			<?php endforeach;?>
		</div>
	</div>

<?php endforeach; ?>

	</div>
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