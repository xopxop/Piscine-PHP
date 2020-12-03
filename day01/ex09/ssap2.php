#!/usr/bin/php
<?php

function ft_split($string) {
	return (array_filter(explode(' ', $string)));
}

function cmp($a, $b) {
	$i = 0;

	$set = "abcdefghijklmnopqrstuvwxyz0123456789!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	while (($i < strlen($a)) && ($i < strlen($b)))
	{
		$posa = stripos($set, $a[$i]);
		$posb = stripos($set, $b[$i]);
		if ($posa < $posb)
			return (-1);
		else if ($posa > $posb)
			return (1);
		else
			$i++;
	}
}

if ($argc != 1) {
	$my_arr = [];
	for ($i = 1; $i < $argc; $i++) {
		$words = ft_split($argv[$i]);
		foreach ($words as $elem)
			$my_arr[] = $elem;
	}
	usort($my_arr, 'cmp');
	foreach ($my_arr as $elem)
		echo "$elem\n";
}

?>