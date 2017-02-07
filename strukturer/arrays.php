<?php

$billeder = array(
	"http://lorempixel.com/320/200/animals/1",
	"http://lorempixel.com/320/200/animals/2",
	"http://lorempixel.com/320/200/animals/3",
	"http://lorempixel.com/320/200/animals/4"
);

$antal = count($billeder);
$counter = 0;

foreach ($billeder as $key => $billede) {
	echo "<img src=\"$billede\">" . PHP_EOL;
}
