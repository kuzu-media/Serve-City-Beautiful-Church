<div class="row">
	<div class="cols bucket">
		<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
		<div class="row"><h1>New Shift</h1></div>
		<p>Setup a new shift for people to serve</p>
		<form method='POST' action='<?= Asset::create_url('Shift',$action,$params) ?>'>
			<?php if(isset($id)):?>
				<?php if(isset($fields) && isset($fields['id'])):?>
					<p class='error'><?php echo $fields['id']?></p>
				<?php endif;?>
				<div>
					<label for='id'>id</label>
					<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
				</div>
			<?php endif;?>
			<?php if(isset($fields) && isset($fields['date_id'])):?>
				<p class='error'><?php echo $fields['date_id']?></p>
			<?php endif;?>
			<div>
				<label for='date_id'>Date:</label>
				<select name="date_id" id="date_id">
					<?php foreach($dates as $date):?>
						<option value="<?php echo $date['id']?>"><?php echo $date['date']?></option>
					<?php endforeach;?>
				</select>
			</div>
			<?php if(isset($fields) && isset($fields['team_id'])):?>
				<p class='error'><?php echo $fields['team_id']?></p>
			<?php endif;?>
			<div>
				<label for='team_id'>Team:</label>
				<select name="team_id" id="team_id">
					<?php foreach($teams as $team):?>
						<option value="<?php echo $team['id']?>"><?php echo $team['name']?></option>
					<?php endforeach;?>
				</select>
			</div>
			<?php if(isset($fields) && isset($fields['time'])):?>
				<p class='error'><?php echo $fields['time']?></p>
			<?php endif;?>
			<div>
				<label for='time'>Time:</label>
				<input type='text' id='time' name='time' value='<?php if(isset($time)) echo $time; ?>' placeholder="ex. 5:45 pm" />
			</div>
			<?php if(isset($fields) && isset($fields['notes'])):?>
				<p class='error'><?php echo $fields['notes']?></p>
			<?php endif;?>
			<div>
				<label for='notes'>Notes:</label>
				<input type='text' id='notes' name='notes' value='<?php if(isset($notes)) echo $notes; ?>' />
			</div>
			<div class="row">
				<div class="col-6">
					<input type="submit" class="button" value="Save" />
				</div>
			</div>
		</form>
	</div>
</div>
