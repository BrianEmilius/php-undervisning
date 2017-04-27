<?php

spl_autoload_register(function ($class_name) {
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class_name . '.php';
	if (file_exists($file)) {
		require_once $file;
	}
});

require_once 'functions.php';

if (!methodCheck('POST')) {
	die('BABY SKAL BARE DØ, SIGER JEG!');
}

$variables = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($variables['username']) && !empty($variables['username']) &&
		isset($variables['password']) && !empty($variables['password'])) {
	$user = new User();
	if (!$user->create($variables['username'], $variables['password'])) {
		header('Location: index.php');
		die();
	} else {
		doLogin($user->getLastUserId());
		header('Location: hemmeligosteside.php');
	}
}
