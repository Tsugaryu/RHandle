<!--Auteur : Nicolas Reszka -->
<?php echo form_open('Connexion/login'); ?>
	<h1>S'identifier</h1>
	<input id="login_email" name="login_email" type="email" required>
	<label for="login_email">Email</label>
	<br>
	<input id="login_password" type="password" name="login_password" required>
	<label for="login_password">Mot de passe</label>
	<br>
	<button type="submit" name="submit">
    	Se connecter
	</button>
	<b><?php echo($login_error); ?></b>
<?php echo form_close(); ?>