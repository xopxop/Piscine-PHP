#!/usr/bin/php
<?php

if ($argc > 2) {
	$argv = array_reverse($argv);
	for ($i = 0; $i < $argc - 2 ; $i++) {
		$array = explode(':', $argv[$i]);
		if ($argv[$argc - 2] === $array[0] && count($array) == 2) {
			echo $array[1] . PHP_EOL;
			break ;
		}
	}
}

?>