<div class="row">
	<div class="bucket cols">
		<h1>Send Email</h1>
		<p>Use this tool to easily send emails to everyone or just your team</p>

		<form action="<?=$_SERVER['REQUEST_URI'] ?>">
			<div>
				<label for="team">To:</label>
				<select name="team" id="team">
					<option value="all">All Teams</option>
					<option value="leads">Team Leaders</option>
					<?php foreach($team_names as $team): ?>
					<option value="<?=$team['id']?>"><?=$team['name']?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div>
				<label for="subject">Subject:</label>
				<input type="text" id="subject" name="subject" />
			</div>
			<div>
				<label for="message">Message:</label>
				<textarea name="message" id="message" cols="28" rows="10"></textarea>
			</div>
			<div class="row">
				<div class="col-6">
					<input type="submit" value="Send Email" class="button">
				</div>
			</div>
		</form>
	</div>
</div>