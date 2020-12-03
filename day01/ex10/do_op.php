#!/usr/bin/php
<?php

if ($argc != 4)
	echo "Incorrect Parameters" . PHP_EOL;
else {
	$argv[1] = preg_replace('/\s+/', '', $argv[1]);
	$argv[2] = preg_replace('/\s+/', '', $argv[2]);
	$argv[3] = preg_replace('/\s+/', '', $argv[3]);
	if ($argv[2] == "+")
		echo $argv[1] + $argv[3] . PHP_EOL;
	else if ($argv[2] == "-")
		echo $argv[1] - $argv[3] . PHP_EOL;
	else if ($argv[2] == "*")
		echo $argv[1] * $argv[3] . PHP_EOL;
	else if ($argv[2] == "/")
		echo $argv[1] / $argv[3] . PHP_EOL;
	else if ($argv[2] == "%")
		echo $argv[1] % $argv[3] . PHP_EOL;
}

?>