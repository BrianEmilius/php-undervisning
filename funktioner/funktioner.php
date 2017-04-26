<?php

function bark($name) {
	return "Hunden $name gør";
}

function wag($name) {
	return "Hunden $name logrer med halen";
}

function miau($name) {
	return "Katten $name miaver";
}

function purr($name) {
	return "Katten $name spinder";
}

function animal($race, $name, $action) {
	if ($race === 'hund') {
		$race = 'Hunden';
	} else if ($race === 'kat') {
		$race = 'Katten';
	}
	if ($action === 'tis') {
		$action = 'tisser';
	}
	return "$race $name $action";
}
$variabel = animal('kat', 'Mogens', 'slikker sig i poten');
echo $variabel;
echo animal('hund', 'Gurli', 'tis');
