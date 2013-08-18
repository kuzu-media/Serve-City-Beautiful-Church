<div class="row">
	<div class="bucket cols">
		<h1>Add New Team</h1>
		<?php
			$params = array("action"=>"post");
			if(isset($errors)) $params = array_merge($params, $errors);
			View::render('team/_form',$params);
		 ?>
	</div>
</div>