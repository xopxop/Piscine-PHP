#!/usr/bin/php
<?php

function valid_character($string) {
	$char_set = "0123456789+-*/%";

	if (strlen($string) == 0)
		return false;
	for ($i = 0; $i < strlen($string); $i++)
		if (strpos($char_set, $string[$i]) === false)
			return (false);
	return (true);
}

function valid_position($string) {
	$i = 0;
	$number = "0123456789";

	if ($i == strlen($string) || strpos($number, $string[$i]) === false)
		return false;
	while ($i < strlen($string)){
		if (strpos($number, $string[$i]) === false)
			break ;
		$i++;
	}
	if ($i == strlen($string))
		return true;
	$i++;
	if ($i == strlen($string) || strpos($number, $string[$i]) === false)
		return false;
	while ($i < strlen($string)){
		if (strpos($number, $string[$i]) === false)
			break ;
		$i++;
	}
	if ($i == strlen($string))
		return true;
	return false;
}

function valid_set($string) {

	if (valid_character($string) === false)
		return (false);
	if (valid_position($string) === false)
		return (false);
	return (true);
}

function op($string) {
	$number = "0123456789";

	for ($i = 0; $i < strlen($string); $i++)
		if (strpos($number, $string[$i]) === false)
			break ;
	$op = $string[$i];
	$nbr = explode($op, $string);
	if ($op == "+")
		echo $nbr[0] + $nbr[1] . PHP_EOL;
	else if ($op == "-")
		echo $nbr[0] - $nbr[1] . PHP_EOL;
	else if ($op == "*")
		echo $nbr[0] * $nbr[1] . PHP_EOL;
	else if ($op == "/")
		echo $nbr[0] / $nbr[1] . PHP_EOL;
	else if ($op == "%")
		echo $nbr[0] % $nbr[1] . PHP_EOL;
}

if ($argc != 2)
	echo "Incorrect Parameters" . PHP_EOL;
else {
	$argv[1] = preg_replace('/\s+/', '', $argv[1]);
	if (valid_set($argv[1]) === true)
		op($argv[1]);
	else
		echo "Syntax Error" . PHP_EOL;
}

?>