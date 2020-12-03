#!/usr/bin/php
<?php

while (true) {
	echo "Enter a number: ";
	$input = trim(fgets(STDIN));
	if (feof(STDIN))
	{
		echo "^D\n";
		break ;
	}
	if (is_numeric($input)) 
		echo ($input % 2 == 0) ? "The number $input is even\n" : "The number $input is odd\n";
	else
		echo "'$input' is not a number\n";
}

?>