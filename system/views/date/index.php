<div class="row">
	<div id="calendar">
		<div class="row">
			<div class="cols col-3 title">
				<h2>Areas</h2>
			</div>
			<?php foreach($dates as $date):?>
			<div class='cols col-3 title'>
				<h2><?php echo $date['Date']['date'] ?></h2>
			</div>
			<?php endforeach;?>
		</div>
		<div class="row">
			<div class="cols col-3"></div>
			<?php foreach($dates as $date):?>
			<div class="cols col-3 note">
				<?php echo $date['Date']['notes'] ?>
			</div>
			<?php endforeach;?>
		</div>
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
									<?php if($logged_in && $member['Member']['id'] === Auth::user('id')) $serving = true;?>
									<img src="<?php echo $member['Member']['profile_pic']?>" />
									<p><?php echo $member['Member']['name'];?></p>
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
	var logged_in = "<?php  var_export($logged_in) ?>";
	console.log("logged_in",typeof logged_in);
	$(".serve").on('click',function(e){
		e.preventDefault();

		var button = $(this);

		// if we are logged in then save it as a shift_member
		if(logged_in === "true")
		{
			$.ajax({
				url: '<?php echo Asset::get_base()?>ShiftMember/post',
				type: 'post',
				data: {"shift_id": button.data("shift_id")},
				dataType: 'json',
				success: function (data) {
					var img = $("<img />").attr("src",data.member.profile_pic);
					var name = $("<p>").text(data.member.name);
					button.before(img).after(name).remove();
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
		}
	});

	window.fbAsyncInit = function() {

		// setup FB
		FB.init({
			appId      : '541318462573151', // App ID
			channelUrl : "<?php echo Asset::get_base();?>channel.php", // Channel File
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML,
		});


		 // Check Group Status
		var check_groups = function() {
			FB.api('/me/groups',function(response){
				var invite = true;
				$.each(response.data, function()
				{
					if(this.name === "Ops Team") {
						invite = false;
						return;
					}
				});

				console.log("invite",invite);
			});
		}


	};
	// Load the SDK Asynchronously
	(function(d){
		var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement('script'); js.id = id; js.async = true;
		js.src = "//connect.facebook.net/en_US/all.js";
		ref.parentNode.insertBefore(js, ref);
	}(document));

</script>

<div class="fb-login-button" data-show-faces="false" scope="email,user_groups" registration-url="<?php echo Asset::get_base()?>member/post"></div>
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
			<p class="center"><a href="" class="center">Login without Facebook</a></p>
		</div>
		<div class="col-6 cols">
			<h2>Join Us</h2>
			<div class="facebook"><a href=""><?php echo Asset::img('register.png') ?></a></div>
			<p class="center"><a href="" class="center">Signup without Facebook</a></p>
		</div>
	</div>
</div>
</div>
