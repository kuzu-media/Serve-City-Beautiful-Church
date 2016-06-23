<div class="row">
	<div class="bucket cols">
		<h1>Add New Group</h1>
		<?php
			$params = array("action"=>"post");
			if(isset($errors)) $params = array_merge($params, $errors);
			View::render('group/_form',$params);
		 ?>
	</div>
</div>