<?php
require_once 'sqlconfig.php';

if ($_POST) {
	$stmt = $conn->prepare("SELECT id FROM brugere WHERE brugernavn = ? AND adgangskode = ?");
	$stmt->bind_param('ss', $_POST['brugernavn'], $_POST['adgangskode']);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows == 1) {
		session_start();
		$_SESSION['isLoggedIn'] = true;
		header('Location: admin.php');
	} else {
		$errorMsg = 'Du har jokket i en l*ort';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUser" class="sr-only">Brugernavn</label>
        <input type="text" id="inputUser" class="form-control" placeholder="Brugernavn" name="brugernavn" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="adgangskode" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				<?=@$errorMsg;?>
      </form>

    </div> <!-- /container -->
  </body>
</html>
