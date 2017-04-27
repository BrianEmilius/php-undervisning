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

function generateToken() {
	session_start();
	$_SESSION['token'] = md5(time()*rand(5,1000));
	$_SESSION['tokenTime'] = time();
}

function validateToken($token) {
	session_start();
	if ($token === $_SESSION['token']) {
		if ((time() - $_SESSION['tokenTime']) > 120) {
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}