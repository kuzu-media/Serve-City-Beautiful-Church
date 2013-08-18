<div class="row" id="login">
	<div class="cols bucket">
		<?php if(isset($errors)):?>
			<p class="error"><strong>Oh No!</strong> Something went wrong. See below to find out what.</p>
		<?php endif;?>
		<h1>Reset Your Password!</h1>
		<!-- <p class="welcome">Please fill out your settings.</p> -->
		<form method='POST' action='<?=$_SERVER['REQUEST_URI'] ?>'>

			<?php if(isset($errors['fields']) && isset($errors['fields']['password'])):?>
				<p class='error'><?php echo $errors['fields']['password']?></p>
			<?php endif;?>
			<div>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" value="<?php if(isset($password)) echo $password; ?>" />
			</div>
			<?php if(isset($errors['fields']) && isset($errors['fields']['confirm'])):?>
				<p class='error'>Passwords do not match</p>
			<?php endif;?>
			<div>
				<label for="confirm">Confirm Password:</label>
				<input type="password" id="confirm" name="confirm" value="<?php if(isset($confirm)) echo $confirm; ?>" />
			</div>

			<div class="row">
				<div class="col-6">
					<input type="submit" class="button" />
				</div>
			</div>
		</form>
	</div>
</div>
