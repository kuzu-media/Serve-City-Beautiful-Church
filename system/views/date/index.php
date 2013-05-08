<div class="row">
	<div class="table cols">
		<div class="row">
			<div class="cols col-3 title">
				<h2>Areas</h2>
			</div>
			<?php $last = count($dates) - 1; $empty_notes = true; foreach($dates as $index=>$date): if(!empty($date['Date']['notes'])) $empty_notes = false;?>
			<div class='cols col-3 title'>

				<h2><?php if($index === 0 && strtotime($date['Date']['date']) > strtotime('04/28/13')) echo "<a href='".Asset::create_url('date','index',array($page-1))."' class='arrow left'>Previous Month</a>" ?><?php echo $date['Date']['date'] ?><?php if($index ===  $last && strtotime($date['Date']['date']) < strtotime('05/25/14')) echo "<a href='".Asset::create_url('date','index',array($page+1))."' class='arrow right'>Next Month</a>" ?></h2>

			</div>
			<?php endforeach;?>
		</div>
		<?php if(!$empty_notes): ?>
		<div class="row">
			<div class="cols col-3"></div>

			<?php foreach($dates as $date):?>
			<div class="cols col-3 note">

				<?php echo $date['Date']['notes'] ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif;?>
		<?php foreach($teams as $team):?>
			<div class="row">
				<div class="cols col-3 team">
					<h3><a href="<?php echo  Asset::create_url("team","get",array($team['id']))?>"><?php echo $team['name']?></a></h3>
				</div>
				<?php foreach($dates as $date):?>
					<div class="cols col-3">
					<?php $shift_count = 0; foreach($date['Shift'] as $shift) :?>
						<?php if($shift['team_id'] === $team['id']):?>
							<div class="shift">
								<p class="time"><?php echo $shift['time']?></p>
								<?php $serving = false;?>

								<?php if($shift['members']): foreach($shift['members'] as $member): ?>
									<?php
										$current = false;
										if($logged_in && $member['Member']['id'] === Auth::user('id'))
										{
											$serving = true;
											$current= true;
										}
										if($member['Member']['facebook_id'] && !$current)
										{
											$opening_tag = "<a href='http://facebook.com/".$member['Member']['facebook_id']."' class='name'>";
											$closing_tag = "</a>";
										}
										else
										{
											$opening_tag = "<div class='name'>";
											$closing_tag = "</div>";
										}
									?>
									<?php echo $opening_tag ?>

										<img src="<?php echo $member['Member']['profile_pic']?>" />
										<p><?php echo $member['Member']['name'];?><?php if($current): ?><a class='cancel' href="<?php echo Asset::create_url('ShiftMember','delete',array($member['ShiftMember']['id']))?>">X</a><?php endif;?></p>
									<?php echo $closing_tag ?>
								<?php endforeach; endif;?>
								<?php if(!$serving):?><a href="#" class="button serve" data-shift_id="<?php echo $shift['id'] ?>">Serve</a><?endif?>
							</div>
						<?php $shift_count++ ;endif?>
					<?php endforeach;?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach;?>

	</div>
	<div id="fb-root"></div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<?php echo Asset::js("jquery.modal.min")?>
<script>

jQuery(document).ready(function($) {

	var logged_in = "<?php  var_export($logged_in) ?>";
	$(".serve").on('click',function(e){
		e.preventDefault();

		var button = $(this);

		// if we are logged in then save it as a shift_member
		if(logged_in === "true")
		{
			$.ajax({
				url: '<?php echo Asset::get_base()?>ShiftMember/post.json',
				type: 'post',
				data: {"shift_id": button.data("shift_id")},
				dataType: 'json',
				success: function (data) {
					var img = $("<img />").attr("src",data.member.profile_pic);
					var name = $("<p>").text(data.member.name);
					var link = "<?php echo Asset::create_url('ShiftMember','delete') ?>/"+data.shift_member_id;
					name.append("<a href='"+link+"' class='cancel'>X</a>");
					var div = $("<div>").addClass("name").append(img).append(name);

					button.replaceWith(div);
				}
			});
		}
		else
		{
			$('#login').modal();

			var href = "<?php echo $login_url ?>";
			var vars = {};
			var url = href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {vars[key] = decodeURIComponent(value); return "";});
			vars['redirect_uri'] += "/"+button.data("shift_id");
			$(".facebook a").attr("href",url+"?"+$.param(vars))
			$(".default a").each(function()
			{
				var link = $(this);
				var href = link.attr("href");
				link.attr("href",href+"/"+button.data("shift_id"));

			})

		}
	});

	<?php if($first):?>
		$("#first").modal();
	<?php endif;?>
});
</script>
<?php if($first):?>
<div class="modal" id="first">
	<a href="#close" class="close-modal">Close</a>
	<div class="row">
		<h1 class="cols">Thanks for Joining Us!</h1>
		<p class="cols">To learn more about us and keep up to date be sure to join the Ops Team Facebook Group!<br />&nbsp;<a href="https://www.facebook.com/groups/345282898925907/"><?php echo Asset::img('ops.png') ?></a></p>
	</div>
</div>
<?php endif;?>

<div class="modal" id="login">
	<a href="#close" class="close-modal">Close</a>
	<div class="row">
		<h1>Thank You!</h1>
		<p class="cols col-12">Thank you for choosing to serve our community. Please sign in or join so we can know more about you and your preferences.</p>
	</div>
	<div class="row">
		<div class="col-6 cols">
			<h2>Sign In</h2>
			<div class="facebook"><a href=""><?php echo Asset::img('login.png') ?></a></div>
			<p class="center default"><a href="<?php echo Asset::create_url("member","login")?>" class="center">Login without Facebook</a></p>
		</div>
		<div class="col-6 cols">
			<h2>Join Us</h2>
			<div class="facebook"><a href=""><?php echo Asset::img('register.png') ?></a></div>
			<p class="center default"><a href="<?php echo Asset::create_url("member","post") ?>" class="center">Signup without Facebook</a></p>
		</div>
	</div>
</div>
</div>
