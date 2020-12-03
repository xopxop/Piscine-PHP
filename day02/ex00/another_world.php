#!/usr/bin/php
<?php

if ($argc > 1) {
	$output = (preg_replace("/\s+/", " ", trim($argv[1])));
	echo "$output\n";
}

?>