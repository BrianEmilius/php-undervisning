<?php
session_start();
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != TRUE) {
	header('Location: index.php');
	die(); // en langsom og smertefuld død ved sløv træske i milten
}
?>
<h1>Du er logget ind! hurraaaa...</h1>
<p>Du har bruger-id <?=$_SESSION['userId']?></p>