<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Serve | City Beautiful Church</title>
	<?php echo Asset::css("style") ?>
	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
	<header>
		<?php echo Asset::img("logo.png")?>
	</header>
	<div class="nav_containter">
		<div class="row">
			<nav>

				<a href="<?php echo Asset::create_url("team","index")?>#areas">Areas to Serve</a>
				<a href="<?php echo Asset::create_url("date","index")?>">Current Schedule</a>
				<a href="">Update my Settings</a>
			</nav>
			<a href="<?php echo Asset::create_url("pages","join")?>" class="button">I am interested in serving</a>
		</div>
	</div>
</head>
<body>
	<?php echo $content_for_layout?>
	<footer class="row">
		<p class="cols">&copy;<?php echo date("Y")?> City Beautiful Church</p>
	</footer>
</body>
</html>