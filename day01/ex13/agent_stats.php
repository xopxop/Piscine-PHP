#!/usr/bin/php
<?php

function average($total_grade, $total_number) {
	return ($total_grade / $total_number);
}

if ($argc == 2) {
	$lines = file('php://stdin');
	unset($lines[0]);
	if ($argv[1] == "average") {
		$total_grade = 0;
		$total_number = 0;
		foreach ($lines as $elem) {
			$array = explode(';', $elem);
			if ($array[1] != "" && $array[2] != "moulinette") {
				$total_grade += $array[1];
				$total_number++;
			}
		}
		if ($total_number > 0)
			echo average($total_grade, $total_number) . PHP_EOL;
	}
	else if ($argv[1] == "average_user") {
		foreach ($lines as $elem) {
			$array = explode(';', $elem);
			$user_list[$array[0]] = array("total_grade" => 0, "total_nbr" => 0);
		}
		foreach ($lines as $elem) {
			$array = explode(';', $elem);
			if ($array[1] != "" && $array[2] != "moulinette") {
				$user_list[$array[0]]['total_grade'] += $array[1];
				$user_list[$array[0]]['total_nbr']++;
			}
		}
		ksort($user_list, SORT_REGULAR);
		foreach ($user_list as $user => $value)
			if ($value['total_grade'] != 0)
				echo $user . ":" . average($value['total_grade'], $value['total_nbr']) . PHP_EOL;
	}
	else if ($argv[1] == "moulinette_variance") {
		foreach ($lines as $elem) {
			$array = explode(';', $elem);
			$user_list[$array[0]] = array("total_grade" => 0, "total_nbr" => 0, "total_moulinette_grade" => 0, "total_moulinette_nbr" => 0);
		}
		foreach ($lines as $elem) {
			$array = explode(';', $elem);
			if ($array[1] != "") {
				if ($array[2] == "moulinette") {
					$user_list[$array[0]]['total_moulinette_grade'] += $array[1];
					$user_list[$array[0]]['total_moulinette_nbr']++;
				}
				else {
					$user_list[$array[0]]['total_grade'] += $array[1];
					$user_list[$array[0]]['total_nbr']++;
				}
			}
		}
		ksort($user_list, SORT_REGULAR);
		foreach ($user_list as $user => $value)
			if ($value['total_nbr'] != 0 || $value['total_moulinette_nbr'] != 0)
				echo $user . ":" . (average($value['total_grade'], $value['total_nbr']) - average($value['total_moulinette_grade'], $value['total_moulinette_nbr'])) . PHP_EOL;
	}
}

?>