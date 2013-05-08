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
				<?php if(Session::get('logged_in') && Auth::user("member_type_id") === "1"): ?>
					<a href="<?php echo Asset::create_url('team','admin')?>">Teams</a>
				<?php endif;?>
			</nav>
			<?php if(!Session::get('logged_in')): ?><a href="<?php echo Asset::create_url("member","post")?>" class="button">I am interested in serving</a><?php endif;?>
		</div>
	</div>
	<?php echo $content_for_layout?>
	<footer class="row">
		<p class="cols">&copy;<?php echo date("Y")?> City Beautiful Church</p>
	</footer>
</body>
</html>