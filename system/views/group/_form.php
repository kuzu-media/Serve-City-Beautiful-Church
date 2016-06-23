<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('Group',$action,$params) ?>' enctype="multipart/form-data">
	<?php if(isset($fields) && isset($fields['name'])):?>
		<p class='error'><?php echo $fields['name']?></p>
	<?php endif;?>
	<div>
		<label for='name'>Name:</label>
		<input type='text' id='name' name='name' value='<?php if(isset($name)) echo $name; ?>' />
	</div>

	<?php if(isset($fields) && isset($fields['start_invite'])):?>
		<p class='error'><?php echo $fields['start_invite']?></p>
	<?php endif;?>
	<div>
		<label for='start_invite'>Date to Start Showing Join Notification:</label>
		<input type='text' id='start_invite' name='start_invite' value='<?php if(isset($start_invite)) echo $start_invite; ?>' placeholder="mm/dd/yyyy"/>
	</div>


	<?php if(isset($fields) && isset($fields['end_invite'])):?>
		<p class='error'><?php echo $fields['end_invite']?></p>
	<?php endif;?>
	<div>
		<label for='end_invite'>Date to Stop Showing Join Notification:</label>
		<input type='text' id='end_invite' name='end_invite' value='<?php if(isset($end_invite)) echo $end_invite; ?>' placeholder="mm/dd/yyyy" />
	</div>


	<div class="row">
		<div class="col-6">
			<input type='submit' value='save' class="button" />
		</div>
	</div>
</form>