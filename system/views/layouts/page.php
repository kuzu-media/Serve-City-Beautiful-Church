<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Serve | City Beautiful Church</title>
	<?php echo Asset::css("style") ?>
	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>

</head>
<body>
	<header>
		<?php if(Session::get('logged_in')):?>
		<div class="utility">
			<a href="<?php echo Asset::create_url("member","update",array( Auth::user('id') ) )?>">Update my Settings</a> | <a href="<?php echo Asset::create_url("member","logout")?>">Logout</a>
		</div>
		<?php else:?>
			<div class="utility">
				<a href="<?php echo Asset::create_url("member","login")?>">Login</a>
			</div>
		<?php endif;?>
		<?php echo Asset::img("logo.png")?>
	</header>
	<div class="nav_containter">
		<div class="row">
			<nav>
				<a href="<?php echo Asset::create_url("team","index")?>#areas">Areas to Serve</a>
				<a href="<?php echo Asset::create_url("date","index")?>">Calendar</a>
				<?php if(Session::get('logged_in') && Auth::user("member_type_id") !== "2"): ?>
					<a href="<?php echo Asset::create_url('team','admin')?>">Teams</a>
					<a href="<?php echo Asset::create_url('team','email')?>">Send Email</a>
					<a href="<?php echo Asset::create_url('group','get')?>">Groups</a>
					<a href="<?php echo Asset::create_url('pages','help')?>">Help</a>
				<?php endif;?>
				<?php if(Session::get('logged_in') && Auth::user("member_type_id") === "3"): ?>
					<a href="<?php echo Asset::create_url('member','index')?>">System Admins</a>
				<?php endif; ?>
				<?php if(!Session::get('logged_in')): ?><a href="<?php echo Asset::create_url("member","post")?>" class="button pull-right">I am interested in serving</a><?php endif;?>

			</nav>
		</div>
	</div>
	<?php if(isset($group_invite) && !Session::get('joined')):?>
	<div class="row">
		<div class="cols bucket">
			<h3 class="col-9 cols">Join <?php echo $group_invite['name'];?></h3>
			<a href="<?php echo Asset::create_url("groupingMember","post",array($group_invite['id']))?>" class="button col-3 cols" id="join_btn">Join Now</a>
		</div>
	</div>
	<?php endif;?>
	<?php echo $content_for_layout?>
	<img src="http://www.citybeautifulchurch.com/wp-content/themes/beautiful/images/bg_footer.png" id="footer_img" />
	<footer>

		<div class="row">
			<p class="cols col-6"><a href="http://citybeautifulchurch.com">www.citybeautifulchurch.com</a></p>
			<p class="cols col-6 right">&copy;<?php echo date("Y")?> City Beautiful Church</p>
		</div>
	</footer>
</body>
</html>