#!/usr/bin/php
<?php

function ft_split($string) {
	return (array_filter(preg_split('/\s+/', trim($string))));
}

if ($argc > 1) {
	$my_array = ft_split($argv[1]);
	$size = count($my_array);
	if ($size > 1)
		for ($i = 1; $i < $size; $i++)
			echo "$my_array[$i] ";
	echo $my_array[0] . PHP_EOL;
}

?>