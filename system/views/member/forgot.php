<div class="row" id="login">
	<div class="cols bucket">
		<?php if(isset($errors)):?>
			<p class="error"><strong>Oh No!</strong> <?php echo $errors; ?></p>
		<?php endif;?>
		<h1>Forgot Password!</h1>
		<p>Enter your email and a reset link will be sent to you.</p>
		<form method='POST' action='<?=$_SERVER['REQUEST_URI'] ?>'>

			<?php if(isset($fields) && isset($fields['email'])):?>
				<p class='error'><?php echo $fields['email']?></p>
			<?php endif;?>
			<div>
				<label for='email'>Email:</label>
				<input type='text' id='email' name='email' value='<?php if(isset($email)) echo $email; ?>' />
			</div>

			<div class="row">
				<div class="col-6">
					<input type="submit" class="button" />
				</div>
			</div>
		</form>
	</div>
</div>
