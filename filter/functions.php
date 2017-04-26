<?php

$pdo = new PDO('mysql:host=localhost;dbname=cheeseshop', 'root', '');

function methodCheck($method) {
	$requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD',
										FILTER_SANITIZE_SPECIAL_CHARS);
	if ($requestMethod === $method) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function doLogin($id) {
	session_start();
	$_SESSION['isLoggedIn'] = TRUE;
	$_SESSION['userId'] = $id;
}