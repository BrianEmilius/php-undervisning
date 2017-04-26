<?php

require_once 'functions.php';

if (!methodCheck('POST')) {
	die('BABY SKAL BARE DØ, SIGER JEG!');
}

$variables = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($variables['username']) && !empty($variables['username']) &&
		isset($variables['password']) && !empty($variables['password'])) {

	$stmt = $pdo->prepare("SELECT id, password FROM brugere
												WHERE username = :username");
	$stmt->bindParam(':username', $variables['username']);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!password_verify($variables['password'], $result['password'])) {
		header('Location: index.php');
		die();
	} else {
		doLogin($result['id']);
		header('Location: hemmeligosteside.php');
	}
}
