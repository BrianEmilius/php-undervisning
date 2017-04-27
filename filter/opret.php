<?php
require_once 'functions.php';

if (!methodCheck('POST')) {
	die('BABY SKAL BARE DØ, SIGER JEG!');
}

$variables = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($variables['username']) && !empty($variables['username']) &&
		isset($variables['password']) && !empty($variables['password'])) {

	$stmt = $pdo->prepare("SELECT id FROM brugere
												WHERE username = :username");
	$stmt->bindParam(':username', $variables['username']);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		header('Location: index.php');
		die();
	} else {
		$options = [
			'cost' => 12
		];

		$hashedPassword = password_hash($variables['password'],
																		PASSWORD_BCRYPT, $options);
		
		$stmt = $pdo->prepare("INSERT INTO brugere (username, password) VALUES(:username, '$hashedPassword')");
		$stmt->bindParam(':username', $variables['username']);
		if (!$stmt->execute()) {
			header('Location: index.php');
			die();
		} else {
			doLogin($pdo->lastInsertId());
			header('Location: hemmeligosteside.php');
		}
	}
}
