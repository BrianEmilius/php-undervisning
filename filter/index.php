<?php
require_once 'functions.php';
generateToken();
?>
<fieldset>
	<legend>Log ind</legend>
	<form action="login.php" method="post">
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
		<input type="text" name="username" placeholder="Brugernavn"><br>
		<input type="password" name="password" placeholder="Adgangskode"><br>
		<button type="submit">Log ind</button>
	</form>
</fieldset>

<fieldset>
	<legend>Ny bruger</legend>
	<form action="opret.php" method="post">
		<input type="text" name="username" placeholder="Brugernavn"><br>
		<input type="password" name="password" placeholder="Adgangskode"><br>
		<button type="submit">Opret ny bruger</button>
	</form>
</fieldset>