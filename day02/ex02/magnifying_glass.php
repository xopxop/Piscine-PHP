#!/usr/bin/php
<?php

function ft_replace($matches)
{
	return (str_replace($matches[1], strtoupper($matches[1]), $matches[0]));
}

if ($argc == 2) {
	$line = file_get_contents($argv[1]);

	$line = preg_replace_callback('/<a(.|\n)*?<\/a>/',
	function($matches) {
		$matches[0] = preg_replace_callback('/title="((.|\n)*?)"/', 'ft_replace', $matches[0]);
		$matches[0] = preg_replace_callback('/>((.|\n)*?)</', 'ft_replace', $matches[0]);
		return $matches[0];
	}, $line);
	echo $line;
}

?>