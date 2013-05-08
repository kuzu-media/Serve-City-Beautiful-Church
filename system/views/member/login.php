<div class="row" id="login">
	<div class="cols bucket">
		<?php if(isset($errors)):?>
			<p class="error"><strong>Oh No!</strong> <?php echo $errors; ?></p>
		<?php endif;?>
		<h1>Welcome!</h1>
		<!-- <p class="welcome">Please fill out your settings.</p> -->
		<div class="facebook"><a href="<?php echo $login_url ?>"><?php echo Asset::img('login.png') ?></a></div>
		<form method='POST' action='<?=$_SERVER['REQUEST_URI'] ?>'>

			<?php if(isset($fields) && isset($fields['email'])):?>
				<p class='error'><?php echo $fields['email']?></p>
			<?php endif;?>
			<div>
				<label for='email'>Email:</label>
				<input type='text' id='email' name='email' value='<?php if(isset($email)) echo $email; ?>' />
			</div>

			<?php if(isset($fields) && isset($fields['password'])):?>
				<p class='error'><?php echo $fields['password']?></p>
			<?php endif;?>
			<div>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" value="<?php if(isset($password)) echo $password; ?>" />
			</div>

			<div class="row">
				<div class="col-6">
					<input type="submit" class="button" />
				</div>
			</div>
		</form>
	</div>
</div>
