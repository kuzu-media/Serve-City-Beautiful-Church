<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>name</div>
	</div>
	<?php foreach($login_types as $login_type):?>
		<div class='row'>
			<div class='col'>
				<?php echo $login_type['id'] ?>
			</div>
			<div class='col'>
				<?php echo $login_type['name'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>